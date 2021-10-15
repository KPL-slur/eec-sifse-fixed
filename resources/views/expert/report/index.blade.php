@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __(($maintenance_type == 'pm' ? 'Preventive Maintenance' : 'Corrective Maintenance'))])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                </div>
                <div class="card-body ">
                    <div class="d-sm-flex">
                        <a type="button" class="btn btn-info" href="{{ route('expert') }}">BACK</a>
                        <a type="button" class="btn btn-primary"
                            href="{{ route("report.create", $maintenance_type) }}">ADD NEW</a>
                        <a type="button" class="btn btn-secondary ml-auto" href="{{ route('report.trash.index', $maintenance_type) }}">Trash</a>
                    </div>
                    
                    <div class="row">
                        <div class="col material-datatables">
                            @if ($headReports->isEmpty())
                            <h4 class="text-center text-danger"> There are no report(s) yet. </h4>
                            @else
                            <x-ui.spinner id="spinner" className="spinner-center"/>
                            <table class="table table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width:100%" id="report">
                                <thead>
                                    <tr>
                                        <th class="disabled-sorting">#</th>
                                        <th>Radar Name</th>
                                        <th>Station ID</th>
                                        <th>Date</th>
                                        <th>Field Service Engineer</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($headReports as $hr)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>{{ $hr->site->radar_name }}</td>
                                            <td>{{ $hr->site->station_id }}</td>
                                            <td>{{ $hr->report_date_start }} - {{ $hr->report_date_end }}</td>
                                            <td>
                                                @foreach ($hr->experts as $expert)
                                                    {{ $expert->name }};
                                                @endforeach
                                            </td>
                                            <td class="td-actions text-right">
                                                <a type="button" rel="tooltip" class="btn btn-info"
                                                    href="{{ route("report.show", ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                @foreach ($hr->experts as $expert)
                                                    @can('update', $hr)
                                                        <div class="d-inline">
                                                            <a type="button" rel="tooltip" class="btn btn-warning"
                                                                href="{{ route("report.edit", ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}"
                                                                >
                                                                <i class="material-icons">edit</i>
                                                            </a>
                                                            <x-confirmation.btn-delete
                                                                    route="{{ route('report.delete', ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}">
                                                                {{ $hr->head_id }}
                                                            </x-confirmation.btn-delete>
                                                        </div>
                                                        @break
                                                    @endcan
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation.mdl-delete>
        <p>Are You Sure Want To Delete This Report ? <strong class="text-danger">Deleted Report Can Be Restored At The Trash Page</strong></p>
    </x-confirmation.mdl-delete>

    {{-- Floating Menu --}}
    {{-- <x-ui.btn-float-group>
        <li>   
            <a href="{{ route('report.create', $maintenance_type) }}" class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">create</i>
            </a>
        </li>
    </x-ui.btn-float-group> --}}
    
    @if (session('status_success'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'success', '{{ session(\'status_success\'); }}');
            };
        </script>
    @endif
    @if (session('status_edit'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'warning', '{{ session(\'status_edit\'); }}');
            };
        </script>
    @endif
    @if (session('status_delete'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', '{{ session(\'status_delete\'); }}');
            };
        </script>
    @endif

    @if (!($headReports->isEmpty()))
        @push('scripts')
            <script>
                $(document).ready( function () {
                    $('#report').DataTable({
                        "pagingType": "numbers",
                        "lengthMenu": [
                            [10, 25, 50, 100, 250, 500],
                            [10, 25, 50, 100, 250, 500]
                        ],
                        responsive: true,
                        language: {
                        searchPlaceholder: "Search records",
                        }
                    });
                    $('#spinner').addClass('d-none');
                    $('#report').removeClass('d-none');
                });
            </script>
        @endpush
    @endif

@endsection
