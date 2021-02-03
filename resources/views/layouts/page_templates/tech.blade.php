<div class="wrapper ">
  {{-- @include('layouts.navbars.sidebar') --}}
  <div class="main-panel no-sidebar">
    @include('layouts.navbars.navs.auth')
    @yield('content')
    @include('layouts.footers.auth')
  </div>
</div>