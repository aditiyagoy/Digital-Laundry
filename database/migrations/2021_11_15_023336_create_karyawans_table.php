<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('nik_karyawan')->unique();
            $table->String('nama_karyawan');
            $table->bigInteger('status_peminjaman');
            $table->bigInteger('id_lokasi');
            $table->String('ukuran_baju');
            $table->String('grup');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('karyawans', function (Blueprint $table){
            $table->foreign('id_lokasi')->references('id_lokasi')->on('lokasis')
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
        Schema::dropIfExists('karyawans');
    }
}
