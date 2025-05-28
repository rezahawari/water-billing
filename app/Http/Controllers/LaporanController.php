<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Catat;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function penggunaan() {
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
        $catat = Catat::with('customer', 'user', 'petugas')->get();
        return view('pages.laporan.penggunaan', [
            'catat' => $catat,
            'months' => $months,
            'alamat' => Alamat::all(),
        ]);
    }

    public function cetakpenggunaan(Request $request)
    {
        $catat = Catat::where('month', $request->bulan)->where('year', $request->tahun)->where('alamat_id', $request->alamat)->with('customer', 'user', 'alamat')->get();
        $alamat = Alamat::where('id', $request->alamat)->first();
        return view('pages.laporan.cetakPenggunaan', [
            'catat' => $catat,
            'request' => $request,
            'alamat' => $alamat
        ]);
    }
}
