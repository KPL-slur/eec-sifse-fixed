<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrintedReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('printed_reports', function (Blueprint $table) {
            $table->bigIncrements('printed_report_id');
            $table->foreignId('head_id')->constrained('head_reports', 'head_id')->onDelete('cascade');
            $table->string('file')->unique();
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
        Schema::dropIfExists('printed_reports');
    }
}
