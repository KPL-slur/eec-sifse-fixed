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
                            <x-ui.spinner id="spinner" className="spinner-center"/>
                            <table class="table table-no-bordered table-hover d-none" cellspacing="0" width="100%" style="width:100%" id="report">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Radar Name</th>
                                        <th>Station ID</th>
                                        <th>Date</th>
                                        <th>Expertises</th>
                                        <th class="disabled-sorting text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($headReports->isEmpty())
                                        <tr>
                                            <td colspan="6">
                                                <p class="text-danger">No Report(s) Yet</p>
                                            </td>
                                        </tr>
                                    @endif
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
                                                <a type="button" rel="tooltip" class="btn btn-warning"
                                                    href="{{ route("report.edit", ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}"
                                                    >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <form action="{{ route('report.delete', ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" rel="tooltip" class="btn btn-danger" onclick="return confirm('Apakah yakin ingin menghapus data?')">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                showNotification('top', 'right', 'success', "<?php echo session('status_success'); ?>");
            };
        </script>
    @endif
    @if (session('status_edit'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'warning', "<?php echo session('status_edit'); ?>");
            };
        </script>
    @endif
    @if (session('status_delete'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "<?php echo session('status_delete'); ?>");
            };
        </script>
    @endif

    @push('scripts')
        <script>
            window.onload = () => {
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
            };
        </script>
    @endpush

@endsection
