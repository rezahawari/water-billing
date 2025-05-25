<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Tagihan;

class TunggakanController extends Controller
{
    public function home()
    {
        $currentMonth = Carbon::now()->month;  // Bulan saat ini
        $currentYear = Carbon::now()->year;    // Tahun saat ini
        $currentDay = Carbon::now()->day;      // Tanggal hari ini

        // Tentukan denda per bulan
        $denda20K = 20000;  // Denda untuk bulan yang terlewat
        $denda10K = 10000;  // Denda untuk bulan berjalan setelah tanggal 21

        // Ambil data pelanggan yang menunggak tagihan
        $pelangganMenunggak = Customer::with(['tagihans' => function ($query) use ($currentMonth, $currentYear) {
            $query->where('status', '=', 1);  // Status belum terbayar
        }, 'user', 'alamat', 'tarif'])->get();

        // Iterasi untuk setiap pelanggan
        $pelangganMenunggak->map(function ($pelanggan) use ($currentMonth, $currentYear, $denda20K, $denda10K, $currentDay) {
            // Menghitung total bulan tunggakan
            $totalBulanTunggakan = $pelanggan->tagihans->filter(function ($tagihan) use ($currentMonth, $currentYear) {
                return $tagihan->status == 1;
            })->count();

            // Menghitung total tagihan yang belum dibayar
            $totalTagihanTunggakan = $pelanggan->tagihans->filter(function ($tagihan) use ($currentMonth, $currentYear) {
                return $tagihan->status == 1;
            })->sum('tagihan'); // Menghitung jumlah tagihan yang belum dibayar

            // Menghitung total penggunaan yang belum dibayar
            $totalPenggunaanTunggakan = $pelanggan->tagihans->filter(function ($tagihan) use ($currentMonth, $currentYear) {
                return $tagihan->status == 1;
            })->sum('penggunaan'); // Menghitung jumlah penggunaan yang belum dibayar

            // Menghitung total denda berdasarkan ketentuan
            $totalDenda = $pelanggan->tagihans->map(function ($tagihan) use ($currentMonth, $currentYear, $currentDay, $denda20K, $denda10K) {
                if ($tagihan->tahun < $currentYear || ($tagihan->tahun == $currentYear && $tagihan->bulan < $currentMonth)) {
                    // Jika bulan dan tahun tagihan sudah lewat
                    return $denda20K;  // Denda 20.000
                } elseif ($tagihan->tahun == $currentYear && $tagihan->bulan == $currentMonth) {
                    // Jika bulan dan tahun tagihan sama dengan bulan sekarang
                    if ($currentDay > 21) {
                        return $denda10K;  // Denda 10.000 jika tanggal lebih dari 21
                    }
                    return 0;  // Tidak ada denda jika tanggal masih sebelum 21
                }
                return 0;  // Tidak ada denda jika tagihan belum lewat
            })->sum();  // Menjumlahkan total denda

            // Menambahkan total bulan tunggakan, total tagihan, total penggunaan, dan total denda ke data pelanggan
            $pelanggan->total_bulan_tunggakan = $totalBulanTunggakan;
            $pelanggan->total_tagihan_tunggakan = $totalTagihanTunggakan;
            $pelanggan->total_penggunaan_tunggakan = $totalPenggunaanTunggakan;
            $pelanggan->total_denda = $totalDenda;

            return $pelanggan;
        });

        // dd($pelangganMenunggak->toArray());

        return view('pages.laporan.tunggakan', compact('pelangganMenunggak'));
    }
}
