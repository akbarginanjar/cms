<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbSpmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_spms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_wilayah')->unsigned();
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
        Schema::dropIfExists('tb_spms');
    }
}
