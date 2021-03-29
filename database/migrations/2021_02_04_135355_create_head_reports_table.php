<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_reports', function (Blueprint $table) {
            $table->bigIncrements('head_id');
            $table->foreignId('site_id');
            $table->char('maintenance_type',2);
            $table->string('kasat_name');
            $table->string('kasat_nip');
            $table->date('report_date_start');
            $table->date('report_date_end');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('head_reports');
    }
}
