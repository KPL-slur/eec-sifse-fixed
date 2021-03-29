<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('GENERAL') }}</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('expert.report.layout.report-row', ['namaKolom'=>'general_visual', 'label' => 'Visual Inspection'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'rcms', 'label' => 'RCMS Control And Monitoring Test'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'wipe_down', 'label' => 'Wipe down external surface'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'inspect_all', 'label' => 'Inspect inside all cabinets for vermin ingres'])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('COMPRESSOR') }}</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('expert.report.layout.report-row', ['namaKolom'=>'compressor_visual', 'label' => 'Visual Inspection'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'duty_cycle', 'label' => 'Duty Cycle'])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('TRANSMITTER') }}</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('expert.report.layout.report-row',
                        ['namaKolom'=>'transmitter_visual', 'label' => 'Visual Inspection'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'running_time',
                        'satuan'=>'hrs', 'label' => 'Running Time'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'radiate_time',
                        'satuan'=>'hrs', 'label' => 'Radiate Time'])

                        <th>Pulse Width</th>
                        <th></th>
                        <th>HVPS V</th>
                        <th>HVPS I</th>
                        <th>Mag I</th>
                        @include('expert.report.layout.report-pulse-row',
                        ['namaKolom'=>'0_4us', 'label' => '0.4 us'])
                        @include('expert.report.layout.report-pulse-row',
                        ['namaKolom'=>'0_8us', 'label' => '0.8 us'])
                        @include('expert.report.layout.report-pulse-row',
                        ['namaKolom'=>'1_0us', 'label' => '1.0 us'])
                        @include('expert.report.layout.report-pulse-row',
                        ['namaKolom'=>'2_0us', 'label' => '2.0 us'])

                        @include('expert.report.layout.report-row', ['namaKolom'=>'forward_power',
                        'satuan'=>'dBm', 'label' => 'Forward Power'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'reverse_power',
                        'satuan'=>'dBm', 'label' => 'Reverse Power'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'vswr',
                        'satuan'=>':1', 'label' => 'VSWR'])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('RECEIVER') }}</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('expert.report.layout.report-row',
                        ['namaKolom'=>'receiver_visual', 'label' => 'Visual Inspection'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'stalo_check', 'label' => 'Stalo Check'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'afc_check', 'label' => 'AFC Check'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'mrp_check', 'label' => 'MRP Check'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'rcu_check', 'label' => 'RCU Check'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'iq2_check', 'label' => 'IQ2 Check'])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="card ">
    <div class="card-header card-header-primary">
        <h4 class="card-title">{{ __('ANTENNA / PEDESTAL') }}</h4>
    </div>
    <div class="card-body ">
        <div class="row">
            <div class="col table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Activity</th>
                            <th>Status</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody>
                        @include('expert.report.layout.report-row', ['namaKolom'=>'antenna_visual', 'label' => 'Visual Inspection'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'inspect_motor', 'label' => 'Inspect Motor Drive'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'clean_slip', 'label' => 'Clean Slip-rings'])
                        @include('expert.report.layout.report-row', ['namaKolom'=>'grease_gear', 'label' => 'Grease Gears and Bearing'])
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>