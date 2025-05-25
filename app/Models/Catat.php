<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catat extends Model
{
    use SoftDeletes;

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }
}
