@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@foreach ($HeadReport as $hr)

    @section('content')
        <div class="content">
            <div class="container-fluid">
                <div class="card ">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                    </div>
                    <div class="card-body ">
                        <a type="button" class="btn btn-info" href="{{ url('tech') }}">BACK</a>
                        <a type="button" class="btn btn-primary" href="{{ url('tech') }}">EDIT</a>
                        <a type="button" class="btn btn-danger" href="{{ url('tech') }}">DELETE</a>
                        <div class="card ">
                            <div class="card-header card-header-primary">
                                <h4 class="card-title">{{ $hr->radar_name }}</h4>
                            </div>
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col table-responsive">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>Station Id</td>
                                                    <td>{{ $hr->station_id }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>{{ $hr->report_date_start }}</td>
                                                    <td>s.d</td>
                                                    <td>{{ $hr->report_date_end }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Internal Expertise</td>
                                                    <td>{{ $hr->expertise1 }} </td>
                                                    <td>{{ $hr->expertise2 }}</td>
                                                    <td>{{ $hr->expertise3 }}</td>
                                                </tr>
                                                <tr>
                                                    <td>External Expertise</td>
                                                    @for ($i = 4; $i <= 10; $i++)
                                                        @php
                                                            $externalExpertise = 'expertise' . $i;
                                                        @endphp
                                                        <td>{{ $hr->$externalExpertise }}</td>
                                                    @endfor
                                                </tr>
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
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'general_visual'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'rcms'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'wipe_down'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'inspect_all'])
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
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'compressor_visual'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'duty_cycle'])
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
                                                @include('tech.report.layout.report-row',
                                                ['namaKolom'=>'transmitter_visual'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'running_time'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'radiate_time'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'forward_power'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'reverse_power'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'vswr'])
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
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'receiver_visual'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'stalo_check'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'afc_check'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'mrp_check'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'rcu_check'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'iq2_check'])
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
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'antenna_visual'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'inspect_motor'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'clean_slip'])
                                                @include('tech.report.layout.report-row', ['namaKolom'=>'grease_gear'])
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
                                        <?php echo $pmBodyReport->remark ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

@endforeach
