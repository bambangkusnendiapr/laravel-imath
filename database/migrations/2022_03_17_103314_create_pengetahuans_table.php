<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengetahuansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengetahuans', function (Blueprint $table) {
            $table->id();
            $table->integer('materi_id');
            $table->text('isi');
            $table->date('tgl_aktif')->nullable();
            $table->string('status')->nullable();
            $table->string('bobot')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('pengetahuans');
    }
}
