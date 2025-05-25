<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    use SoftDeletes;

    protected $guarded= ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function alamat()
    {
        return $this->belongsTo(Alamat::class, 'alamat_id', 'id');
    }

    public function tarif()
    {
        return $this->belongsTo(Tarif::class, 'tarif_id', 'id');
    }

    public function tagihans()
    {
        return $this->hasMany(Tagihan::class, 'customer_id', 'id');
    }
}
