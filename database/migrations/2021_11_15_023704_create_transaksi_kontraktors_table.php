<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksiKontraktorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi_kontraktors', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kontraktor');
            $table->string('perusahaan');
            $table->string('penanggung_jawab');
            $table->bigInteger('id_barang');
            $table->timestamp('tgl_pinjam');
            $table->dateTime('tgl_kembali')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('transaksi_kontraktors', function(Blueprint $table){
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
        Schema::dropIfExists('transaksi_kontraktors');
    }
}
