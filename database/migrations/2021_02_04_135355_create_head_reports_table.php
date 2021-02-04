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
            $table->id();

            $table->string('radar_name', 20);
            $table->string('station_id', 50);
            $table->date('report_date_start');
            $table->date('report_date_end');

            //nanti ini dibuat tabel sendiri aja
            $table->string('expertise1');
            $table->string('expertise2')->nullable();
            $table->string('expertise3')->nullable();
            $table->string('expertise4')->nullable();
            $table->string('expertise5')->nullable();
            $table->string('expertise6')->nullable();
            $table->string('expertise7')->nullable();
            $table->string('expertise8')->nullable();
            $table->string('expertise9')->nullable();
            $table->string('expertise10')->nullable();

            $table->string('expertise_company1');
            $table->string('expertise_company2')->nullable();
            $table->string('expertise_company3')->nullable();
            $table->string('expertise_company4')->nullable();
            $table->string('expertise_company5')->nullable();
            $table->string('expertise_company6')->nullable();
            $table->string('expertise_company7')->nullable();
            $table->string('expertise_company8')->nullable();
            $table->string('expertise_company9')->nullable();
            $table->string('expertise_company10')->nullable();

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
        Schema::dropIfExists('head_reports');
    }
}
