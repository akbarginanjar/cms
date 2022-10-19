<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbJenisTerbakarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_jenis_terbakars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_kejadian_kebakaran')->unsigned();
            $table->string('nama')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('penyebab')->nullable();
            $table->integer('asumsi_kerugian')->nullable();
            $table->integer('asumsi_pemadaman')->nullable();
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
        Schema::dropIfExists('tb_jenis_terbakars');
    }
}
