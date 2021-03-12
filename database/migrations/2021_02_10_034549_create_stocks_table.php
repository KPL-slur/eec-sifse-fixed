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
            $table->string('nama_barang');
            $table->string('group');
            $table->string('part_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('expired')->nullable();
            $table->float('kurs_beli', 24, 2)->nullable();
            $table->integer('jumlah_unit')->nullable();
            $table->string('status')->nullable();
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
