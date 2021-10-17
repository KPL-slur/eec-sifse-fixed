@extends('layouts.app', ['class' => 'off-canvas-sidebar off-canvas-sidebar-custom', 'activePage' => 'home', 'titlePage' => __('Email Verification')])

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-lg-7 col-md-8">
          <div class="card card-login card-hidden mb-3">
            <div class="card-header card-header-primary text-center">
              <p class="card-title"><strong>{{ __('Verify Your Email Address') }}</strong></p>
            </div>
            <div class="card-body">
              <p class="card-description text-center"></p>
              <p>
                
                {{ __('Before proceeding, please check your email for a verification link.') }}
                
                @if (Route::has('verification.send'))
                    {{ __('If you did not receive the email') }},  
                    <form class="d-inline" method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
                    </form>
                @endif
              </p>
            </div>
          </div>
      </div>
  </div>
</div>
@endsection

@if (session('message'))
    <script>
       window.onload = () => {
         showNotification('top', 'right', 'success' ,"{{ session('message') }}");
       };
     </script>
@endif
