<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_barang')->unique();
            $table->string('nama_barang');
            $table->bigInteger('id_lokasi');
            $table->bigInteger('jml_barang')->nullable();
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
        });
        Schema::table('barangs', function (Blueprint $table){
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
        Schema::dropIfExists('barangs');
    }
}
