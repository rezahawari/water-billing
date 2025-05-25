<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use Illuminate\Http\Request;

class AlamatController extends Controller
{
    public function home()
    {
        return view('pages.setting.alamat', [
            'alamat' => Alamat::all(),
        ]);
    }

    public function store(Request $request)
    {
        try {
            Alamat::create([
                'nama_alamat' => $request->nama,
                'lat' => $request->lat,
                'long' => $request->long,
                'alamat_lengkap' => $request->lengkap
            ]);

            return back()->with('success', 'Berhasil menyimpan alamat');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal menyimpan alamat');
        }
    }

    public function update(Request $request)
    {
        try {
            Alamat::where('id', $request->id)->update([
                'nama_alamat' => $request->nama,
                'lat' => $request->lat,
                'long' => $request->long,
                'alamat_lengkap' => $request->lengkap
            ]);

            return back()->with('success', 'Berhasil mengubah alamat');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal mengubah alamat');
        }
    }

    public function destroy($id)
    {
        try {
            $alamat = Alamat::find($id);
            $alamat->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
