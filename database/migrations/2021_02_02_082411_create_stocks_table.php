<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->bigIncrements('stock_id');
            $table->foreignId('site_id');
            $table->string('nama_barang');
            $table->string('part_number');
            $table->string('serial_number');
            $table->date('tgl_masuk');
            $table->date('expired');
            $table->integer('kurs_beli');
            $table->integer('jumlah_unit');
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
        Schema::dropIfExists('stocks');
    }
}
