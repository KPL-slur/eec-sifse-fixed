@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __(strtoupper($maintenance_type).' '. $headReport->site->station_id)])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Preventive Maintenance Report') }}</h4>
                </div>
                <div class="card-body ">
                    <div class="">
                        <a type="button" class="btn btn-info"
                            href="{{ route("report.index", $maintenance_type) }}">BACK</a>
                        <button type="button" rel="tooltip" class="btn btn-primary" data-toggle="modal" data-target="#modalPrint">
                            GENERATE PDF</button>
                        @can('update', $headReport)
                        <a type="button" class="btn btn-warning" href="{{ route('report.edit', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}">EDIT</a>
                        <button type="submit" rel="tooltip" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
                            DELETE</button>
                        @endcan
                    </div>

                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Scanned Hard File</h4>
                        </div>
                        <div class="card-body ">
                            @if ($headReport->printedReport)
                            <div class="row">
                                <div class="col table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <td>File Name</td>
                                                <td>{{ $fileName }}</td>
                                            </tr>
                                            <tr>
                                                <td>Action</td>
                                                <td>
                                                    <a type="button" href="{{ route('report.pdf.download', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" class="btn btn-success">Download</a>
                                                    <a type="button" href="{{ route('report.pdf.show', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" target="_blank" class="btn btn-info">View</a>
                                                    <button type="button" rel="tooltip" class="btn btn-warning" data-toggle="modal" data-target="#modalUpload">Change File</button>
                                                    <button type="button" rel="tooltip" class="btn btn-danger" data-toggle="modal" data-target="#modalDeleteUpload">Remove File</button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            @else
                            <button type="button" rel="tooltip" class="btn btn-default" data-toggle="modal" data-target="#modalUpload">
                                UPLOAD</button>
                            @endif
                        </div>
                    </div>
                    
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
                                                <td>{{ $headReport->site->station_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td>{{ $date }}</td>
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
                    @if ($headReport->maintenance_type == 'pm')
                        @include('expert.report.layout.pm-show', ['pmBodyReport' => $bodyReport])
                    @endif
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('REMARK') }}</h4>
                        </div>
                        <div class="card-body ">
                            <div class="row">
                                <div class="container">
                                    <?php echo $bodyReport->remark; ?>
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
                                <div class="col-md-6 col-lg-4">
                                    <div class="card card-profile ml-auto mr-auto" style="max-width: 360px">
                                        <div class="card-header card-header-image">
                                            <img class="img" src="{{ asset('storage/' . $reportImage->image) }}">   
                                        </div>
                                      
                                        <div class="card-body d-flex justify-content-between">
                                            <h4 class="card-title d-inline">
                                                {{ $reportImage->caption }}
                                            </h4>
                                            <a href="{{ asset('storage/' . $reportImage->image) }}" target="_blank" class="material-icons d-inline">
                                                open_in_new
                                            </a>
                                        </div>
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
        @can('update', $headReport)
        <li>
            <button class="btn btn-danger btn-fab btn-round" data-toggle="modal" data-target="#modalDelete">
                <i class="material-icons">close</i>
            </button>
        </li>
        <li>   
            <a href="{{ route('report.edit', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" class="btn btn-warning btn-fab btn-round">
                <i class="material-icons">edit</i>
            </a>
        </li>
        @endcan
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
            <form action="{{ route('report.delete', ['id' => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" method="post"
                class="d-inline">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                @csrf
                @method('delete')
                <button type="submit" rel="tooltip" class="btn btn-secondary">Yes</button>
            </form>
        </x-slot>
    </x-ui.modal-confirm>

    <x-ui.modal-confirm id="modalDeleteUpload">
        <x-slot name="body">
            <p>Are You Sure Want To Remove This File?</p>
        </x-slot>
        <x-slot name="footer">
            <form action="{{ route("report.pdf.delete", ["id" => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" method="POST">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-secondary">Yes</button>
            </form>
        </x-slot>
    </x-ui.modal-confirm>

    <x-ui.modal-confirm id="modalPrint">
        <x-slot name="title">
            Print CM REPORT to PDF
        </x-slot>
        <x-slot name="body">
            <P>Silahkan masukan nama dan nip dari kepala statsiun untuk diisikan pada kolom tanda tangan</P>
            <br>
            <form target="_blank" action="{{ route("report.pdf.print", ["id" => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" method="GET">
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
            Upload CM REPORT to PDF
        </x-slot>
        <x-slot name="body">
            <form action="{{ route("report.pdf.store", ["id" => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="container">
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
    @if (session('delete_success'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "<?php echo session('delete_success'); ?>");
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