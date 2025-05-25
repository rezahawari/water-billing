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
        Schema::create('tagihans', function (Blueprint $table) {
            $table->id();
            $table->integer('id_pelanggan');
            $table->foreignId('customer_id');
            $table->foreignId('catat_id');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->string('penggunaan', 10);
            $table->string('tagihan', 20);
            $table->integer('status')->default(1);
            $table->foreignId('process_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tagihans');
    }
};
