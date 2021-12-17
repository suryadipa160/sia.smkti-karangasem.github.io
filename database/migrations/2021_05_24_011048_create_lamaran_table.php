<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLamaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lamaran', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('alumni_id', 5);
            $table->string('lowongan_id', 5);
            $table->string('perusahaan_id', 5);
            $table->string('lamaran');
            $table->string('cv');
            $table->string('ijazah');
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
        Schema::dropIfExists('lamaran');
    }
}
