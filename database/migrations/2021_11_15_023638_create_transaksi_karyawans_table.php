<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_karyawans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik_karyawan');
            $table->bigInteger('id_barang');
            $table->timestamp('tgl_pinjam');
            $table->dateTime('tgl_kembali')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('transaksi_karyawans', function(Blueprint $table){
            $table->foreign('nik_karyawan')->references('nik_karyawan')->on('karyawans')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_barang')->references('id_barang')->on('barangs')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi_karyawans');
    }
}
