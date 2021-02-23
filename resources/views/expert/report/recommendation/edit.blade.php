@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Recommendation Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">{{ __('Weather Radar Service Report') }}</h4>
                        </div>
                        <div class="card-body">
                            @livewire('edit-recommends', ['headId' => $headId])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
