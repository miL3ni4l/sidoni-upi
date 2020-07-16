<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kode_transaksi');
            $table->integer('anggota_id')->unsigned();
            $table->foreign('anggota_id')->references('id')->on('anggota')->onDelete('cascade');
            $table->integer('acara_id')->unsigned();
            $table->foreign('acara_id')->references('id')->on('acara')->onDelete('cascade');
            $table->date('tgl_transaksi');
            $table->string('bank');
            $table->string('rek');
            $table->string('jml_donasi');
            $table->string('total_donasi');
            $table->enum('status', ['belum', 'lunas']);
            $table->text('ket')->nullable();
            $table->timestamps();        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksi');
    }
}
