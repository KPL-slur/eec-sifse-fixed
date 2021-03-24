<div class="wrapper ">
  @include('layouts.navbars.sidebars.expert')
  <div class="main-panel no-sidebar">
    @include('layouts.navbars.navs.expert')
    @yield('content')
    {{-- @include('layouts.footers.auth') --}}
  </div>
</div>