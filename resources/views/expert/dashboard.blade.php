@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Welcome, {{ $loggedName }} </h1>

            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-warning card-header-icon">
                            <div class="card-icon">
                                <i class="sidebar-mini">PM</i>
                            </div>
                            <h3 class="card-title">Preventive Maintenance</h3>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" data-id="1" href="{{ route("report.create", ['maintenance_type' => 'pm']) }}">NEW</a>
                            <a class="btn btn-info" href="{{ route("report.index", ['maintenance_type' => 'pm']) }}">VIEW</a>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-danger card-header-icon">
                            <div class="card-icon">
                                <i class="sidebar-mini">CM</i>
                            </div>
                            <h3 class="card-title">Corrective Maintenance</h3>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ route("report.create", ['maintenance_type' => 'cm']) }}">NEW</a>
                            <a class="btn btn-info" href="{{ route("report.index", ['maintenance_type' => 'cm']) }}">VIEW</a>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">inventory_2</i>
                            </div>
                            <h3 class="card-title">Stocks</h3>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-info ml-auto" href="{{ route('expert_stocks') }}">VIEW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection