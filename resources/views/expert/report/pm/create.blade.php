@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Preventive Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ url('/expert/pm/create') }}" class="form-horizontal">
                        @csrf
                        <div class="row setup-content" id="step-1">
                            @include('expert.report.layout.forms.head.create')
                        </div>
                        <div class="row setup-content" id="step-2">
                            @include('expert.report.layout.forms.pm.create')
                        </div>
                        <div class="row setup-content" id="step-3">
                            @include('expert.report.layout.forms.ck-editor')
                        </div>
                        
                        <button class="btn btn-success nextBtn btn-lg pull-right" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
