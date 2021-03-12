@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                </div>
                <div class="card-body ">
                    {{-- <div class="sticky-top"> --}}
                        <a type="button" class="btn btn-info" href="{{ route('expert') }}">BACK</a>
                        <a type="button" class="btn btn-primary"
                            href="{{ route($maintenance_type.".create") }}">ADD NEW</a>
                    {{-- </div> --}}
                    
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Radar Name</th>
                                        <th>Station ID</th>
                                        <th>Date</th>
                                        <th>Expertises</th>
                                        <th class="text-right">Actions</th>
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
                                                    {{-- href="{{ url('/expert/' . $maintenance_type . '/' . $hr->head_id) }}"> --}}
                                                    href="{{ route($maintenance_type.".show", ['id' => $hr->head_id]) }}">
                                                    <i class="material-icons">visibility</i>
                                                </a>
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalPrint">
                                                    <i class="material-icons">print</i>
                                                </button>
                                                <a type="button" rel="tooltip" class="btn btn-warning"
                                                    {{-- href="{{ url('/report/' . $hr->id . '/edit') }}" --}}
                                                    href="{{ route($maintenance_type.".edit", ['id' => $hr->head_id]) }}"
                                                    >
                                                    <i class="material-icons">edit</i>
                                                </a>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete">
                                                    <i class="material-icons">close</i>
                                                </button>
                                                {{-- <form action="{{ route('pm.delete', ['id' => $hr->head_id]) }}" method="post"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('delete')
                                                    <button type="submit" rel="tooltip" class="btn btn-danger">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form> --}}
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
    <x-ui.btn-float-group>
        <li>   
            <a href="{{ route($maintenance_type.'.create') }}" class="btn btn-primary btn-fab btn-round">
                <i class="material-icons">create</i>
            </a>
        </li>
    </x-ui.btn-float-group>

    @if ($headReports->isNotEmpty())
        {{-- Modal Delete --}}
        <x-ui.modal-confirm id="modalDelete">
            <x-slot name="body">
                <p>Are You Sure Want To Delete This Rerport?</p>
            </x-slot>
            <x-slot name="footer">
                <form action="{{ route('pm.delete', ['id' => $hr->head_id]) }}" method="post"
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
                <form action="{{ route("pm.print.show", ["id" => $hr->head_id]) }}" method="GET">
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
                <button class="btn btn-success" type="submit">Print</button>
            </form>
            </x-slot>
        </x-ui.modal-confirm>
    @endif
    
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
