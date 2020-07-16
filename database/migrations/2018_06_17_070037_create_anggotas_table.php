<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAnggotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->Integer('jns_donatur_id')->references('id')->on('jenisdonaturs')->onDelete('restrict');
            $table->integer('nid');
            $table->string('nama');
            // $table->string('tempat_lahir')->nullable();
            // $table->date('tgl_lahir')->nullable();
            // $table->enum('jk', ['L', 'P']);
            // $table->string('agama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('hp')->nullable();
            $table->string('email')->nullable();
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
        Schema::dropIfExists('anggota');
    }
}
