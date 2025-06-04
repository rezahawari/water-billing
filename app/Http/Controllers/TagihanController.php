<?php

namespace App\Http\Controllers;

use App\Models\InvoiceCounter;
use Carbon\Carbon;
use App\Models\Tagihan;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravolt\Avatar\Avatar;

class TagihanController extends Controller
{
    public function home()
    {
        $avatar = new Avatar();
        $avatar->create(Auth::user()->nama)->toBase64();
        return view('pages.tagihan', [
            'tagihan' => Tagihan::with('customer.user', 'customer.tarif', 'customer.alamat')->get(),
        ]);
    }

    public function show(Tagihan $tagihan)
    {
        // Data waktu & tarif denda
        $currentMonth = Carbon::now()->month;
        $currentYear  = Carbon::now()->year;
        $currentDay   = Carbon::now()->day;
        $denda20K     = 20000;
        $denda10K     = 10000;

        $tgh = Tagihan::where('id', $tagihan->id)->with('customer.user', 'customer.tarif', 'customer.alamat', 'catat')->first();
        $totalDenda = 0;
        if ($tgh->tahun < $currentYear || ($tgh->tahun == $currentYear && $tgh->bulan < $currentMonth)) {
            $totalDenda = $denda20K;
        }
        if ($tgh->tahun == $currentYear && $tgh->bulan == $currentMonth && $currentDay > 21) {
            $totalDenda = $denda10K;
        }

        $tgh->total_denda = $totalDenda;

        $invnum = InvoiceCounter::where('tagihan_id', $tagihan->id)->first();

        if(!$invnum){
            $allinnv = InvoiceCounter::max('counter');
            if($allinnv == null){
                $inv = InvoiceCounter::create([
                    'counter' => 1,
                    'tagihan_id' => $tgh->id,
                    'date' => Carbon::now()->format('Y-m-d'),
                ]);
            }else {
                $inv = InvoiceCounter::create([
                    'counter' => $allinnv + 1,
                    'tagihan_id' => $tgh->id,
                    'date' => Carbon::now()->format('Y-m-d'),
                ]);
            }

            $numinv = $inv;
        }else {
            $numinv = $invnum;
        }

        // // Muat Tagihan + relasi 'catat'
        // $tgh = $tagihan->load('catat');

        // // Hitung total denda
        // $totalDenda = $tgh->catat->sum(function($item) use (
        //     $currentYear, $currentMonth, $currentDay, $denda20K, $denda10K
        // ) {
        //     if ($item->tahun < $currentYear
        //         || ($item->tahun == $currentYear && $item->bulan < $currentMonth)
        //     ) {
        //         return $denda20K;
        //     }
        //     if ($item->tahun == $currentYear
        //         && $item->bulan == $currentMonth
        //         && $currentDay > 21
        //     ) {
        //         return $denda10K;
        //     }
        //     return 0;
        // });

        // Kembalikan ke view
        return view('pages.findtagihan', [
            'tagihan' => $tgh,
            'invoice' => $numinv
        ]);
    }

    public function payment(Request $request)
    {
        $tagihan = Tagihan::find($request->id);
        $tagihan->status = 2;
        $tagihan->save();

        return redirect()->route('tagihan')->with('success', 'Tagihan berhasil dibayar');
    }

}
