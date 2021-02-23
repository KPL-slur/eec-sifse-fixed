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
            $table->smallInteger('group');
            $table->string('part_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('expired')->nullable();
            $table->integer('kurs_beli')->nullable();
            $table->integer('jumlah_unit')->nullable();
            $table->smallInteger('status')->nullable();
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
