<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    public function home()
    {
        return view('pages.setting.tarif', [
            'tarif' => Tarif::all(),
            'alamat' => Alamat::all()
        ]);
    }

    public function store(Request $request)
    {
        // $validation = $request->validate([
        //     ''
        // ]);

        try {
            Tarif::create([
                'kode' => $request->golongan . '/' . $request->tarif,
                'golongan' => $request->golongan,
                'alamat_id' => $request->alamat,
                'abonemen' => $request->abonemen,
                'tarif' => $request->tarif
            ]);

            return back()->with('success', 'Tarif berhasil di simpan');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal menyimpan tarif'. $e->getMessage());
        }

    }

    public function update(Request $request)
    {
        try {
            Tarif::where('id', $request->id)->update([
                'kode' => $request->golongan . '/' . $request->tarif,
                'golongan' => $request->golongan,
                'alamat_id' => $request->alamat,
                'abonemen' => $request->abonemen,
                'tarif' => $request->tarif
            ]);

            return back()->with('success', 'Tarif berhasil diubah');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal mengubah tarif');
        }
    }

    public function destroy($id)
    {
        try {
            $user = Tarif::find($id);
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
