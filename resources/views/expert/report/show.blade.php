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
                        <a type="button" class="btn btn-primary" target="_blank"
                            href="{{ route("report.pdf.print", ["id" => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}">
                            GENERATE PDF</a>
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
                            @livewire('printed-report', ['headReport' => $headReport, 'maintenance_type' => $maintenance_type])
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
                                                <td>Station ID</td>
                                                <td colspan="2">{{ $headReport->site->station_id }}</td>
                                            </tr>
                                            <tr>
                                                <td>Station Master</td>
                                                <td>{{ $headReport->kasat_name }}</td>
                                                <td>{{ $headReport->kasat_nip }}</td>
                                            </tr>
                                            <tr>
                                                <td>Date</td>
                                                <td colspan="2">{{ $date }}</td>
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
            <a class="btn btn-primary btn-fab btn-round" target="_blank"
                href="{{ route("report.pdf.print", ["id" => $headReport->head_id, 'maintenance_type' => $maintenance_type]) }}">
                <i class="material-icons">print</i>
            </a>
        </li>
    </x-ui.btn-float-group>

    {{-- Modal Delete --}}
    <x-ui.modal-confirm id="modalDelete">
        <x-slot name="body">
            <p>Are You Sure Want To Delete This Report ? <strong class="text-danger">Deleted Report Can Be Restored At The Trash Page</strong></p>
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
                showNotification('top', 'right', 'danger', "<?php echo $message; ?>");
            };
        </script>
    @enderror
    @error('kasatName')
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "<?php echo $message; ?>");
            };
        </script>
    @enderror

@endsection