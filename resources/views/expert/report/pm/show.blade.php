@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Preventive Maintenance Report') }}</h4>
                </div>
                <div class="card-body ">
                    {{-- <div class="sticky-top"> --}}
                        <a type="button" class="btn btn-info"
                            href="{{ route("$headReport->maintenance_type.index") }}">BACK</a>
                        <button type="button" rel="tooltip" class="btn btn-default" data-toggle="modal" data-target="#modalUpload">
                            UPLOAD</button>
                        <button type="button" rel="tooltip" class="btn btn-primary" data-toggle="modal" data-target="#modalPrint">
                            PRINT</button>
                        <a type="button" class="btn btn-warning" href="{{ route('pm.edit', ['id' => $headReport->head_id]) }}">EDIT</a>
                        <button type="submit" rel="tooltip" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
                            DELETE</button>
                    {{-- </div> --}}

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
                                                <th>Nip</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($headReport->experts as $expert)
                                                <tr>
                                                    <td>{{ $expert->name }}</td>
                                                    <td>{{ $expert->expert_company }}</td>
                                                    <td>{{ $expert->nip }}</td>
                                                    <td>{{ $expert->pivot->role }}</td>
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
                                            'satuan'=>'dBm'])
                                            @include('expert.report.layout.report-row', ['namaKolom'=>'reverse_power',
                                            'satuan'=>'dBm'])
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
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Recoomendation') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="col table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Spare Part Name</th>
                                                <th>Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($recommendations as $recommendation)
                                                <tr>
                                                    <td>{{ $recommendation->name }}</td>
                                                    <td>{{ $recommendation->jumlah_unit_needed }}</td>
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
                            <h4 class="card-title">{{ __('Report Image') }}</h4>
                        </div>
                        <div class="card-body ">

                            <div class="row image-grid">
                                @foreach ($reportImages as $reportImage)
                                <div class="col-sm-4 col-md-4">
                                    <div class="panel panel-default">
                                        <div class="panel-body">
                                            <a href="{{ asset('storage/' . $reportImage->image) }}" target="_blank">
                                                <img alt="" class="img-responsive center-block" 
                                                width="250px" height="100%" 
                                                src="{{ asset('storage/' . $reportImage->image) }}">
                                            </a>
                                        </div>
                                        <div class="panel-footer">{{ $reportImage->caption }}</div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    {{-- FLOATING MENU --}}
    <x-ui.btn-float-group>
        <li>
            <button class="btn btn-danger btn-fab btn-round" data-toggle="modal" data-target="#modalDelete">
                <i class="material-icons">close</i>
            </button>
        </li>
        <li>   
            <a href="{{ route('pm.edit', ['id' => $headReport->head_id]) }}" class="btn btn-warning btn-fab btn-round">
                <i class="material-icons">edit</i>
            </a>
        </li>
        <li>
            <button class="btn btn-primary btn-fab btn-round" data-toggle="modal" data-target="#modalPrint">
                <i class="material-icons">print</i>
            </button>
        </li>
    </x-ui.btn-float-group>

    {{-- Modal Delete --}}
    <x-ui.modal-confirm id="modalDelete">
        <x-slot name="body">
            <p>Are You Sure Want To Delete This Rerport?</p>
        </x-slot>
        <x-slot name="footer">
            <form action="{{ route('pm.delete', ['id' => $headReport->head_id]) }}" method="post"
                class="d-inline">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                @csrf
                @method('delete')
                <button type="submit" rel="tooltip" class="btn btn-secondary">Yes</button>
            </form>
        </x-slot>
    </x-ui.modal-confirm>

    <x-ui.modal-confirm id="modalPrint">
        <x-slot name="title">
            Print PM REPORT to PDF
        </x-slot>
        <x-slot name="body">
            <P>Silahkan masukan nama dan nip dari kepala statsiun untuk diisikan pada kolom tanda tangan</P>
            <br>
            <form action="{{ route("pm.pdf.print", ["id" => $headReport->head_id]) }}" method="GET">
            <div class="form-group">
                <label for="kasatName">Nama Kepala Statsiun</label>
                <input class="form-control" type="text" name="kasatName" id="kasatName" placeholder="Nama Kepala Statsiun">
            </div>
            <div class="form-group">
                <label for="kasatName">Nip Kepala Statsiun</label>
                <input class="form-control" type="text" name="kasatNip" id="kasatNip" placeholder="Nip Kepala Statsiun">
            </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" type="submit">Print</button>
        </form>
        </x-slot>
    </x-ui.modal-confirm>

    <x-ui.modal-confirm id="modalUpload">
        <x-slot name="title">
            Upload PM REPORT to PDF
        </x-slot>
        <x-slot name="body">
            <form action="{{ route("pm.pdf.store", ["id" => $headReport->head_id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="fileinput fileinput-new text-center" data-provides="fileinput">
                        <div class="">
                            <span class="btn btn-raised btn-round btn-default btn-file">
                                <input type="file" name="uploadedPdf" class="fileinput-new"/>
                            </span>
                        </div>
                    </div>
                </div>
        </x-slot>
        <x-slot name="footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            <button class="btn btn-success" type="submit">Upload</button>
        </form>
        </x-slot>
    </x-ui.modal-confirm>

    @if (session('upload_success'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'success', "<?php echo session('upload_success'); ?>");
            };
        </script>
    @endif

    @error('uploadedPdf')
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "<?php echo $message; ?>");
            };
        </script>
    @enderror
    @error('kasatNip')
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "Nip Kepala Statsiun Wajib Diisi");
            };
        </script>
    @enderror
    @error('kasatName')
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "Nama Kepala Statsiun Wajib Diisi");
            };
        </script>
    @enderror

@endsection
