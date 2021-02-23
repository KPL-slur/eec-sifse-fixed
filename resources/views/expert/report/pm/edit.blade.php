@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Preventive Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    @livewire('pm-report', ['id' => $id])
                </div>
            </div>
        </div>
    </div>
@endsection
