<div class="wrapper ">
  @include('layouts.navbars.sidebars.expert')
  <div class="main-panel no-sidebar">
    @include('layouts.navbars.navs.expert')
    <div class="no-margin">
      @yield('content')
    </div>
    {{-- @include('layouts.footers.auth') --}}
  </div>
</div>