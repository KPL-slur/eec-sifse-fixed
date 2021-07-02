<div class="wrapper wrapper-full-page" style="background-image: url('{{ asset('user') }}/img/background.jpg');  background-position: bottom ;align-items: center;  height: auto;" >
  <div class="backgrounds login-page page-header" filter-color="black" data-color="purple">
  <!--   you can change the color of the filter page using: data-color="blue | purple | green | orange | red | rose " -->
    @yield('content')
  </div>
  @include('layouts.footers.guest')
</div>
