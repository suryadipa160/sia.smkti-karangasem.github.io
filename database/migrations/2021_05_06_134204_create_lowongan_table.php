<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLowonganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lowongan', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('perusahaan_id', 5);
            $table->string('nama');
            $table->string('kategori_id', 5);
            $table->text('deskripsi');
            $table->text('persyaratan');
            $table->date('tanggal_dibuat');
            $table->date('tanggal_akhir');
            $table->int('tersedia');
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
        Schema::dropIfExists('lowongan');
    }
}
