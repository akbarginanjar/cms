<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbKelembagaansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_kelembagaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_wilayah')->unsigned();
            $table->string('dinas_mandiri')->nullable();
            $table->string('satpol_pp')->nullable();
            $table->string('bpbd')->nullable();
            $table->string('tipologi_kelembagaan')->nullable();
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
        Schema::dropIfExists('tb_kelembagaans');
    }
}
