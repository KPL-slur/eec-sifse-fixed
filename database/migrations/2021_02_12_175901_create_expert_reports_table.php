<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpertReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // ===== hasil rancangan erd =====
        Schema::create('expert_reports', function (Blueprint $table) {
            $table->bigIncrements('expert_report_id');
            $table->foreignId('head_id');
            $table->foreignId('expert_id');
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
        Schema::dropIfExists('expert_reports');
    }
}
