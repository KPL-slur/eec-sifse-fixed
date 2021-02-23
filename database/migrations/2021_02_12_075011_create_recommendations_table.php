<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ===== hasil rancangan erd =====
        Schema::create('recommendations', function (Blueprint $table) {
            $table->bigIncrements('rec_id');
            $table->foreignId('head_id'); // id of the head of current report. ex: if the id is 5 it means this report has the head reports of 5
            $table->foreignId('stock_id');
            $table->integer('jumlah_unit_needed');
            $table->integer('year');
            $table->timestamps();
        });
        // ===== hasil rancangan erd =====
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommendations');
    }
}
