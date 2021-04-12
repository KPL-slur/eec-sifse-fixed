@include('layouts.navbars.navs.guest')
<div class="wrapper wrapper-full-page">
  <div class="backgrounds login-page page-header" filter-color="black" style="background-image: url('{{ asset('user') }}/img/background.jpg');  background-position: bottom ;align-items: center;" data-color="purple">
  <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')
    @include('layouts.footers.guest')
  </div>
</div>
