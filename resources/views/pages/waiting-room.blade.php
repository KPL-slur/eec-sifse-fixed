@extends('layouts.app', ['class' => 'off-canvas-sidebar off-canvas-sidebar-custom', 'activePage' => 'dashboard', 'titlePage' => __('Waiting Room')])

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary text-center">
              <p class="card-title"><strong>{{ __('Contact Admin') }}</strong></p>
            </div>
            <div class="card-body">
              <p class="card-description text-center"></p>
              <p>{{ __('Your account has not been approved by the admin, contact your admin to approve your account.') }}</p>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection