<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function home()
    {
        return view('pages.setting.user', [
            'users' => User::where('role', 2)
               ->orWhere('role', 3)
               ->get(),
        ]);
    }

    public function store(Request $request)
    {
        // $validation = $request->validate([
        //     ''
        // ]);

        try {
            User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'pass_view' => Crypt::encrypt($request->password),
                'role' => $request->role,
                'no_telp' => $request->no_telp,
            ]);

            return back()->with('success', 'User berhasil di simpan');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal menyimpan user');
        }

    }

    public function update(Request $request)
    {
        try {
            User::where('id', $request->id)->update([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'pass_view' => Crypt::encrypt($request->password),
                'role' => $request->role,
                'no_telp' => $request->no_telp,
            ]);

            return back()->with('success', 'User berhasil diubah');
        } catch (\Exception $e) {
            return back()->with('fail', 'Gagal mengubah user');
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::find($id);
            $user->delete();

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}
