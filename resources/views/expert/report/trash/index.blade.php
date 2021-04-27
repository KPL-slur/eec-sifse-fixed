@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Discarded '.strtoupper($maintenance_type).' Reports')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-danger">
                    <h4 class="card-title">{{ __('Discarded Weather Radar Service Report') }}</h4>
                </div>
                <div class="card-body ">
                    <a type="button" class="btn btn-info" href="{{ route('report.index', $maintenance_type) }}">BACK</a>
                    
                    <div class="row">
                        <div class="col material-datatables">
                            @if ($headReports->isEmpty())
                            <h4 class="text-center text-danger"> There are no deleted report(s) yet. </h4>
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
                                                    href="{{ route("report.trash.show", ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                @foreach ($hr->experts as $expert)
                                                    @can('update', $hr)
                                                        <div class="d-inline">
                                                            <x-confirmation.btn-restore
                                                                    route="{{ route('report.trash.restore', ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}">
                                                                {{ $hr->head_id }}
                                                            </x-confirmation.btn-restore>
                                                            <x-confirmation.btn-delete
                                                                    route="{{ route('report.trash.perm_delete', ['id' => $hr->head_id, 'maintenance_type' => $maintenance_type]) }}">
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

    <x-confirmation.mdl-restore>
        <p>Are You Sure Want To Restore This Report ?</p>
    </x-confirmation.mdl-restore>
    <x-confirmation.mdl-delete>
        <p>Are You Sure Want To Permanently Delete This Report ? <strong class="text-danger">Keep In Mind This Action Cannot Be Undone</strong></p>
    </x-confirmation.mdl-delete>

    {{-- Floating Menu --}}
    {{-- <x-ui.btn-float-group></x-ui.btn-float-group> --}}

    {{-- @if ($headReports->isNotEmpty())
        <x-ui.modal-confirm id="modalRestore">
            <x-slot name="body">
                <p>Are You Sure Want To Restore This Report?</p>
            </x-slot>
            <x-slot name="footer">
                <form action="{{ route('pm.trash.restore', ['id' => $hr->head_id]) }}" method="post"
                    class="d-inline">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    @csrf
                    <button type="submit" rel="tooltip" class="btn btn-secondary">Yes</button>
                </form>  
            </x-slot>
        </x-ui.modal-confirm>

        <x-ui.modal-confirm id="modalDelete">
            <x-slot name="body">
                <p>Are You Sure Want To Permanently Delete This Report?</p>
            </x-slot>
            <x-slot name="footer">
                <form action="{{ route('pm.trash.perm_delete', ['id' => $hr->head_id]) }}" method="post"
                    class="d-inline">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    @csrf
                    @method('delete')
                    <button type="submit" rel="tooltip" class="btn btn-secondary">Yes</button>
                </form>
            </x-slot>
        </x-ui.modal-confirm>
    @endif --}}
    
    @if (session('status_restore'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'success', "<?php echo session('status_restore'); ?>");
            };
        </script>
    @endif
    @if (session('status_perm_delete'))
        <script>
            window.onload = () => {
                showNotification('top', 'right', 'danger', "<?php echo session('status_perm_delete'); ?>");
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
                    $('#report').removeClass('d-none');
                    $('#spinner').addClass('d-none');
                });
            </script>
        @endpush
    @endif

@endsection