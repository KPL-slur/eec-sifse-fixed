@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Edit Corrective Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    @livewire('cm-report', ['id' => $id])
                </div>
            </div>
        </div>
    </div>
@endsection