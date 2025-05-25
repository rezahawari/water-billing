<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('catats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('user_id');
            $table->integer('month');
            $table->string('meter_awal');
            $table->string('meter_akhir');
            $table->date('tgl_cek');
            $table->foreignId('petugas_id');
            $table->boolean('is_rusak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catats');
    }
};
