@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Preventive Maintenance Report') }}</h4>
                </div>
                <div class="card-body ">
                    <a type="button" class="btn btn-info" href="{{ url("expert/$headReport->maintenance_type") }}">BACK</a>
                    <a type="button" class="btn btn-primary" href="{{ url('expert') }}">EDIT</a>
                    <a type="button" class="btn btn-danger" href="{{ url('expert') }}">DELETE</a>
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ $headReport->site->radar_name }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>Station Id</td>
                                                <td colspan="3">{{ $headReport->site->station_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>{{ $headReport->report_date_start }}</td>
                                                <td>s.d</td>
                                                <td>{{ $headReport->report_date_end }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Expertise') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Company</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($headReport->experts as $expert)
                                                <tr>
                                                    <td>{{ $expert->name }}</td>
                                                    <td>{{ $expert->expert_company }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'general_visual'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'rcms'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'wipe_down'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'inspect_all'])
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
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'compressor_visual'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'duty_cycle'])
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
                                            ['namaKolom'=>'transmitter_visual'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'running_time',
                                            'satuan'=>'hrs'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'radiate_time',
                                            'satuan'=>'hrs'])

                                            <th>Pulse Width</th>
                                            <th></th>
                                            <th>HVPS V</th>
                                            <th>HVPS I</th>
                                            <th>Mag I</th>
                                            @include('expert.report.layout.report-pulse-row',
                                            ['namaKolom'=>'0_4us'])
                                            @include('expert.report.layout.report-pulse-row',
                                            ['namaKolom'=>'0_8us'])
                                            @include('expert.report.layout.report-pulse-row',
                                            ['namaKolom'=>'1_0us'])
                                            @include('expert.report.layout.report-pulse-row',
                                            ['namaKolom'=>'2_0us'])

                                            @include('expert.report.layout.report-row', ['namaKolom'=>'forward_power',
                                            'satuan'=>'mBm'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'reverse_power',
                                            'satuan'=>'mBm'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'vswr',
                                            'satuan'=>':1'])
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
                                            ['namaKolom'=>'receiver_visual'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'stalo_check'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'afc_check'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'mrp_check'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'rcu_check'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'iq2_check'])
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
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'antenna_visual'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'inspect_motor'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'clean_slip'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'grease_gear'])
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('REMARK') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="container">
                                    <?php echo $pmBodyReport->remark; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
