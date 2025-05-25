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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('id_pelanggan');
            $table->string('no_meter', 10);
            $table->foreignId('user_id');
            $table->foreignId('alamat_id');
            $table->foreignId('tarif_id');
            $table->boolean('is_telat')->default(0);
            $table->boolean('is_rusak')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
