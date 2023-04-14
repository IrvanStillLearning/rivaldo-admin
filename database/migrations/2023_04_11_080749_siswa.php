<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Siswa extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nik')->unique();
            $table->string('alamat');
            $table->string('asal_sekolah');
            $table->string('tempat_lahir');
            $table->string('tanggal_lahir');
            $table->string('jurusan');
            $table->foreignId('tempat_magang_id');
            $table->timestamp('masuk_magang')->nullable();
            $table->timestamp('keluar_magang')->nullable();
            $table->string('no_telp');
            $table->string('foto');
            $table->rememberToken();
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
        Schema::dropIfExists('siswas');
    }
}
