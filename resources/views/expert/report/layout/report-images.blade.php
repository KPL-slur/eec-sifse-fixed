@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => 'Dashboard'])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>Create New Preventive Maintenance Report</h1>
            <div class="row">
                <div class="col-md-12">
                    <form method="post" action="{{ url('/expert/pm/create') }}" class="form-horizontal" enctype="multipart/form-data">
                    @csrf
                    @livewire('attachments')
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
