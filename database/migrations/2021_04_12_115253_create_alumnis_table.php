<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumnis', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 5);
            $table->char('nis', 4)->unique();
            $table->string('nama');
            $table->string('alamat');
            $table->date('tanggal_lahir');
            $table->string('agama', 20);
            $table->string('jenis_kelamin', 15);
            $table->string('jurusan');
            $table->string('lulusan', 4);
            $table->string('status');
            $table->text('pesan');
            $table->string('gambar');
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
        Schema::dropIfExists('alumnis');
    }
}
