<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ===== hasil rancangan erd =====
        Schema::create('report_images', function (Blueprint $table) {
            $table->bigIncrements('image_id');
            $table->foreignId('head_id')->onDelete('cascade');
            $table->string('image');
            $table->string('caption');
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
        Schema::dropIfExists('report_images');
    }
}
