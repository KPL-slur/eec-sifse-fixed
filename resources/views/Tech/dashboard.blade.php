@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
    <div class="content">
        <div class="container-fluid">
            <h1>HI, {{ $loggedName }} here</h1>

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
                            <a class="btn btn-success" data-id="1" href="{{ url('/report/create') }}?entry_id=pm">NEW</a>
                            <a class="btn btn-info" href="{{ url('/report/pm') }}">VIEW</a>
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
                            <h3 class="card-title">Corective Maintenance</h3>
                        </div>
                        <div class="card-footer">
                            <a class="btn btn-success" href="{{ url('/report/create') }}?entry_id=cm">NEW</a>
                            <a class="btn btn-info" href="{{ url('/report/pm') }}">VIEW</a>
                        </div>
                    </div>
                </div>
                {{--  --}}
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-info card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">person</i>
                            </div>
                            <h3 class="card-title">PROFIL</h3>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-info">MORE</button>
                        </div>
                    </div>
                </div>
                {{--  --}}
            </div>
        </div>
    </div>
@endsection


{{-- Gatau ini buat apa --}}
{{-- @push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush --}}
