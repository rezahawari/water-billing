<?php

namespace App\Http\Controllers;

use App\Models\Catat;
use App\Models\Customer;
use App\Models\Tagihan;
use App\Models\Tarif;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CatatController extends Controller
{
    public function home()
    {
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        if(Auth::user()->role == 3) {
            $catat = Catat::where('petugas_id', Auth::user()->id)->with('customer', 'user', 'petugas')->get();
        }else{
            $catat = Catat::with('customer', 'user', 'petugas')->get();
        }

        return view('pages.catat', [
            'months' => $months,
            'catat' =>$catat,
        ]);
    }

    public function caripelanggan($id)
    {
        try {
            // $pelanggan = Customer::with('user', 'alamat', 'tarif')
            //     ->findOrFail($id);
            $pelanggan = Customer::where('id_pelanggan', $id)->with('user', 'alamat', 'tarif')
                ->first();

            return response()->json([
                'id' => $pelanggan->id_pelanggan,
                'nama' => $pelanggan->user->nama,
                'alamat' => $pelanggan->alamat->nama_alamat,
                'tarif' => $pelanggan->tarif->kode,
                // 'tagihan' => number_format($pelanggan->tagihanTerakhir->jumlah, 0, ',', '.')
            ]);

        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
        }
    }

    public function getFilledMonths(Request $request)
    {
        $tahun = $request->query('tahun');
        $idPelanggan = $request->query('id_pelanggan');

        // Validasi input
        if (!$tahun || !$idPelanggan) {
            return response()->json([
                'error' => 'Tahun dan ID pelanggan diperlukan',
                'filledMonths' => []
            ], 400);
        }

        $custid = Customer::where('id_pelanggan', $idPelanggan)->first();

        // Query untuk mencari bulan yang sudah diisi
        $filledMonths = DB::table('catats') // Sesuaikan dengan nama tabel Anda
            ->where('customer_id', $custid->id)
            ->where('year', $tahun) // Asumsi ada kolom tanggal
            ->where('deleted_at', NULL)
            ->pluck('month') // Sesuaikan dengan nama kolom bulan pada tabel Anda
            ->toArray();

        return response()->json([
            'filledMonths' => $filledMonths
        ]);
    }

    public function searchpelanggan(Request $request)
    {
        $query = $request->get('query');

        // Menggunakan relationship dan whereHas
        $pelanggan = Customer::where('id_pelanggan', 'LIKE', "%{$query}%")
            ->orWhereHas('user', function($q) use ($query) {
                $q->where('nama', 'LIKE', "%{$query}%");
            })
            ->with('user') // Eager load user data
            ->get();

        $data = [];
        foreach ($pelanggan as $p) {
            // Format untuk ditampilkan: "ID Pelanggan - Nama User"
            $label = $p->id_pelanggan . " - " . $p->user->nama;

            // Data yang akan digunakan saat item dipilih (hanya ID Pelanggan)
            $data[] = [
                'label' => $label,
                'value' => $p->id_pelanggan
            ];
        }

        return response()->json($data);
    }

    public function ceklastcatat($id)
    {
        try {
            $catat = Catat::where('id_pelanggan', $id)->with('user')->latest('tgl_cek')->first();
            $customer = Customer::where('id_pelanggan', $id)->with('user')->first();
            $meter = 0;
            if($catat) {
                $meter = $catat->meter_akhir;
            }

            if(!$catat) {
                $catat = $customer;

                $catat->meter_akhir = 0;
                $catat->month = Carbon::now()->month - 1;
                $catat->year = Carbon::now()->year;
            }
            return response()->json([
                // 'meterawal' => $meter
                'catat' => $catat,
            ]);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Pelanggan tidak ditemukan'], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'bulan' => [
                'required',
                'numeric',
                'between:1,12',
                function ($attribute, $value, $fail) use ($request) {
                    $tahun = $request->input('tahun');
                    if($request->input('meterawal') != 0){
                        // Hitung bulan dan tahun sebelumnya
                        if($value == 1) {
                            $bulanSebelumnya = 12;
                            $tahunSebelumnya = $tahun - 1;
                        } else {
                            $bulanSebelumnya = $value - 1;
                            $tahunSebelumnya = $tahun;
                        }

                        // Cek data sebelumnya di database
                        $dataSebelumnya = Catat::where([
                            ['month', $bulanSebelumnya],
                            ['year', $tahunSebelumnya]
                        ])->exists();

                        if(!$dataSebelumnya) {
                            $fail("Data untuk ".$this->namaBulan($bulanSebelumnya)." $tahunSebelumnya belum diinput");
                        }
                    }
                }
            ],
            'tahun' => [
                'required',
                'numeric',
                'digits:4',
                'min:2000',
                'max:'.(date('Y')+1)
            ]
        ]);

        if ($validator->fails()) {
            return back()->with('fail', 'Data gagal disimpan, Silahkan input bulan sebelumnya terlebih dahulu');
        }

        //cek data pada bulan itu
        $cek = Catat::where([
            ['month', $request->bulan],
            ['year', $request->tahun]
        ])->exists();
        if($cek) {
            return back()->with('fail', 'Data untuk bulan ini sudah terinput');
        }

        try {
            $cust = Customer::where('id_pelanggan', $request->idpel)->first();
            $isrusak = 0;

            if($request->has('isrusak')){
                $isrusak = 1;
            }

            $catat = Catat::create([
                'id_pelanggan' => $request->idpel,
                'customer_id' => $cust->id,
                'alamat_id' => $cust->alamat_id,
                'user_id' => $cust->user_id,
                'month' => $request->bulan,
                'year' => $request->tahun,
                'meter_awal' => $request->meterawal,
                'meter_akhir' => $request->meterakhir,
                'tgl_cek' => $request->tglcek,
                'petugas_id' => Auth::user()->id,
                'is_rusak' => $isrusak,
            ]);

            $penggunaan = $request->meterakhir - $request->meterawal;

            $customer = Customer::where('id_pelanggan', $catat->id_pelanggan)->first();
            $tarif = Tarif::where('id', $customer->tarif_id)->first();

            $subtotal = $penggunaan * $tarif->tarif;
            $total = $subtotal + $tarif->abonemen;
            // dd($request->idpel);
            $tagihan = Tagihan::create([
                'id_pelanggan' => $request->idpel,
                'customer_id' => $cust->id,
                'catat_id' => $catat->id,
                'bulan' => $request->bulan,
                'tahun' => $request->tahun,
                'penggunaan' => $penggunaan,
                'tagihan' => $total,
                'status' => 1, //1 belum terbayar
                'process_by' => Auth::user()->id
            ]);

            // Proses simpan data jika validasi berhasil
            return back()->with('success', 'Berhasil menyimpan catat meter');
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('fail', 'Gagal menyimpan data');
        }


    }

    public function update(Request $request, $id)
    {
        try {
            $catat = Catat::findOrFail($id);

            // $validator = Validator::make($request->all(), [
            //     'meterawal' => 'required|numeric',
            //     'meterakhir' => 'required|numeric',
            //     'tgl_cek' => 'required|date',
            // ]);

            // if ($validator->fails()) {
            //     return back()->with('fail', $validator->getMessageBag());
            // }

            $isrusak = $request->has('isrusak') ? 1 : 0;

            $catat->update([
                'meter_awal' => $request->meterawal,
                'meter_akhir' => $request->meterakhir,
                'tgl_cek' => $request->tgl_cek,
                'is_rusak' => $isrusak,
                'petugas_id' => Auth::user()->id, // Update petugas yang mengedit
            ]);

            return back()->with('success', 'Data berhasil diupdate');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal mengupdate data ' . $e->getMessage());
        }
    }

    // Tambahkan fungsi untuk mendapatkan detail catat meter
    public function getDetail($id)
    {
        try {
            $catat = Catat::with(['customer.user', 'customer.alamat', 'customer.tarif'])
                ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => [
                    'id' => $catat->id,
                    'id_pelanggan' => $catat->id_pelanggan,
                    'nama' => $catat->customer->user->nama,
                    'alamat' => $catat->customer->alamat->nama_alamat,
                    'tarif' => $catat->customer->tarif->kode,
                    'meter_awal' => $catat->meter_awal,
                    'meter_akhir' => $catat->meter_akhir,
                    'tgl_cek' => $catat->tgl_cek,
                    'bulan' => $catat->month,
                    'tahun' => $catat->year,
                    'is_rusak' => $catat->is_rusak
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data tidak ditemukan'
            ], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $user = Catat::find($id);
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    private function namaBulan($angkaBulan) {
        $bulan = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
            // ... sampai desember
        ];
        return $bulan[$angkaBulan] ?? 'Bulan Tidak Valid';
    }
}
