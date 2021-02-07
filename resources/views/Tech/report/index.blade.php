@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                </div>
                <div class="card-body ">
                    <a type="button" class="btn btn-info" href="{{ url('tech') }}">BACK</a>
                    <a type="button" class="btn btn-primary" href="{{ url('report/create') }}?entry_id={{ $maintenance_type }}">ADD NEW</a>
                    <div class="row">
                        <div class="col table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Station ID</th>
                                        <th>Date</th>
                                        <th>Expertises</th>
                                        <th class="text-right">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($HeadReport as $hr)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $hr->radar_name }}</td>
                                        <td>{{ $hr->report_date_start }} - {{ $hr->report_date_end }}</td>
                                        <td>{{ $hr->expertise1 }}; {{ $hr->expertise2 }}; {{ $hr->expertise3 }}</td>
                                        <td class="td-actions text-right">
                                            <a type="button" rel="tooltip" class="btn btn-info" href="{{ url('/report/'.$maintenance_type.'/'.$hr->id) }}">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a type="button" rel="tooltip" class="btn btn-success"  href="{{ url('/report/'.$maintenance_type.'/'.$hr->id.'/edit') }}">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <button type="button" rel="tooltip" class="btn btn-danger">
                                                <i class="material-icons">close</i>
                                            </button>
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
@endsection
