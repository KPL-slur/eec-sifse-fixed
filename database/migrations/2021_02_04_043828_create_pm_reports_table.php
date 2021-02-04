<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePmReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pm_reports', function (Blueprint $table) {
            $table->id();
            $table->string('stationId', 50);
            $table->date('date');

            // $table->string('expertise1', 50);
            // $table->string('expertise2', 50);
            // $table->string('expertise3', 50);
            // $table->string('expertise4', 50);
            // $table->string('expertise5', 50);
            // $table->string('expertise6', 50);
            // $table->string('expertise7', 50);
            // $table->string('expertise8', 50);
            // $table->string('expertise9', 50);
            // $table->string('expertise10', 50);
            // $table->string('expertiseCompany1', 50);
            // $table->string('expertiseCompany2', 50);
            // $table->string('expertiseCompany3', 50);
            // $table->string('expertiseCompany4', 50);
            // $table->string('expertiseCompany5', 50);
            // $table->string('expertiseCompany6', 50);
            // $table->string('expertiseCompany7', 50);
            // $table->string('expertiseCompany8', 50);
            // $table->string('expertiseCompany9', 50);
            // $table->string('expertiseCompany10', 50);

            $table->boolean('radio_generalVisual');
            $table->string('generalVisual', 50);

            $table->boolean('radio_RCMS');
            $table->string('RCMS', 50);

            $table->boolean('radio_wipeDown');
            $table->string('wipeDown', 50);

            $table->boolean('radio_inspectAll');
            $table->string('inspectAll', 50);

            // 

            $table->boolean('radio_compressorVisual');
            $table->string('compressorVisual', 50);

            $table->boolean('radio_runningTime');
            $table->string('runningTime', 50);

            $table->boolean('radio_radiateTime');
            $table->string('radiateTime', 50);

            $table->boolean('radio_0_4us');
            $table->string('0_4us', 10);

            $table->boolean('radio_0_8us');
            $table->string('0_8us', 10);

            $table->boolean('radio_1_0us');
            $table->string('1_0us', 10);

            $table->boolean('radio_2_0us');
            $table->string('2_0us', 10);

            $table->boolean('radio_forwardPower');
            $table->string('forwardPower', 50);

            $table->boolean('radio_reversePower');
            $table->string('reversePower', 50);

            $table->boolean('radio_VSWR');
            $table->string('VSWR', 50);

            // 

            $table->boolean('radio_receiverVisual');
            $table->string('receiverVisual', 50);

            $table->boolean('radio_STALOCheck');
            $table->string('STALOCheck', 50);

            $table->boolean('radio_AFCCheck');
            $table->string('AFCCheck', 50);

            $table->boolean('radio_MRPCheck');
            $table->string('MRPCheck', 50);

            $table->boolean('radio_RCUCheck');
            $table->string('RCUCheck', 50);

            $table->boolean('radio_IQ2Check');
            $table->string('IQ2Check', 50);

            // 

            $table->boolean('radio_antennaVisual');
            $table->string('antennaVisual', 50);

            $table->boolean('radio_inspectMotor');
            $table->string('inspectMotor', 50);

            $table->boolean('radio_cleanSlip');
            $table->string('cleanSlip', 50);

            $table->boolean('radio_greaseGear');
            $table->string('greaseGear', 50);

            //

            $table->text('remark');

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
        Schema::dropIfExists('pm_reports');
    }
}
