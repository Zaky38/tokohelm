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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('kode_pesanan');
            $table->dateTime('tanggal');
            $table->string('nama_penerima');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('kurir');
            $table->integer('ongkir');
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran');
            $table->string('status');
            $table->integer('total_harga');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
