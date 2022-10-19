<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSdmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_sdms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_wilayah')->unsigned();
            $table->string('total')->nullable();
            $table->string('pns')->nullable();
            $table->string('non_pns')->nullable();
            $table->string('jafung_damkaar')->nullable();
            $table->string('jafung_analis')->nullable();
            $table->string('diklat_apbd')->nullable();
            $table->string('diklat_apbn')->nullable();
            $table->string('jenis')->nullable();
            $table->foreign('id_wilayah')->references('id')->on('tb_wilayahs');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->dateTime('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_sdms');
    }
}
