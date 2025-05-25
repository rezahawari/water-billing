<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Catat;
use App\Models\Customer;
use App\Models\Tagihan;
use App\Models\Tarif;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
    public function all()
    {
        return view('pages.pelanggan.all', [
            'customer' => Customer::with('user', 'alamat', 'tarif')->get(),
            'alamat' => Alamat::all(),
        ]);
    }

    public function getTarif($alamat)
    {
        $tarif = Tarif::where('alamat_id', $alamat)->get()->toArray();
        return $tarif;
    }

    public function store(Request $request)
    {
        try {
            $nama = Str::lower(
                Str::of($request->nama)
                    ->trim()
                    ->replaceMatches('/\s+/', '') // Hapus semua whitespace
            );
            if($request->input('idpel')){
                $micro = microtime(true);
                $id = str_replace('.', '', sprintf("%.4f", $micro));

            }else {
                $id = $request->idpel;
            }
            $user = User::create([
                'nama'=> $request->nama,
                'username' => $nama,
                'password' => Hash::make($nama . '123'),
                'pass_view' => Crypt::encrypt($nama . '123'),
                'role' => 4,
            ]);

            $customer = Customer::create([
                'id_pelanggan' => $id,
                'no_meter' => $request->no_meter,
                'user_id' => $user->id,
                'alamat_id' => $request->alamat,
                'tarif_id' => $request->tarif,
            ]);

            return back()->with('success', 'Berhasil menyimpan pelanggan');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal menyimpan pelanggan');
        }
    }

    public function update(Request $request)
    {
        try {
            Customer::where('id', $request->id)->update([
                'no_meter' => $request->no_meter,
                'alamat_id' => $request->alamatedit,
                'tarif_id' => $request->tarif,
            ]);

            return back()->with('success', 'Berhasil menyimpan pelanggan');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal menyimpan pelanggan');
        }
    }

    public function destroy($id)
    {
        try {
            $user = Customer::find($id);
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }

    public function show(Customer $customer)
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
        $cust = Customer::where('id', $customer->id)->with('user', 'alamat', 'tarif')->first();
        $catat = Catat::where('customer_id', $customer->id)->with('customer', 'user', 'petugas')->get();
        return view('pages.pelanggan.show', [
            'customer' => $cust,
            'catat' => $catat,
            'months' => $months,
            'tagihan' => Tagihan::with('customer.user')->get(),
        ]);
    }
}
