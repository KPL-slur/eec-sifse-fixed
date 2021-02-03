@extends('layouts.app', ['activePage' => 'site', 'titlePage' => __('Site & Inventories')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        {{--  --}}
        <div class="col-lg-4 col-md-6 col-sm-6">
          <div class="card card-stats">
              <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                      <img id="towerA" src="{{ asset('material') }}/img/towerA.jpg" alt="towerA">
                  </div>
                  <h3 class="card-title"><b>Banjarmasin<b></h3>
              </div>
              <div class="card-footer">
                  <a href="inventorie" class="btn btn-info" >VIEW</a>
              </div>
          </div>
        </div>
        {{--  --}}
      </div>
  </div>
</div>

@endsection