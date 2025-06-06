<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Str;

class CustomerImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $nama = Str::lower(
                Str::of($row['nama'])
                    ->trim()
                    ->replaceMatches('/\s+/', '') // Hapus semua whitespace
            );
        $micro = microtime(true);
        $id = str_replace('.', '', sprintf("%.4f", $micro));
        $user = User::create([
            'nama'=> $row['nama'],
            'username' => $nama,
            'password' => Hash::make($nama . '123'),
            'pass_view' => Crypt::encrypt($nama . '123'),
            'role' => 4,
        ]);
        return new Customer([
            'id_pelanggan' => $id,
            'no_meter' => $row['no_meter'],
            'user_id' => $user->id,
            'alamat_id' => $row['alamat'],
            'tarif_id' => $row['tarif'],
            'is_telat' => 0,
            'is_rusak' => 0,
        ]);
    }
}
