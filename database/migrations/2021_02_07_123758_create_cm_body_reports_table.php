<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmBodyReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cm_body_reports', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('head_id'); // id of the head of current report. ex: if the id is 5 it means this report has the head reports of 5
            $table->longText('remark');

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
        Schema::dropIfExists('cm_body_reports');
    }
}
