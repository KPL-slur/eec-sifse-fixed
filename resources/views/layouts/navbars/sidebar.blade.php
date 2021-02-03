<div class="sidebar" data-color="orange" data-background-color="white" data-image="{{ asset('material') }}>
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="https://creative-tim.com/" class="simple-text logo-normal">
      {{ __('Creative Tim') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item {{ ($activePage == 'profile' || $activePage == 'user-management') ? ' active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#manageTask" aria-expanded="true">
          <i class="material-icons">assignment</i>
          <p>{{ __('Manage Task') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="manageTask">
          <ul class="nav">
            <li class="nav-item{{ $activePage == 'profile' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <span class="sidebar-mini"> UP </span>
                <span class="sidebar-normal">{{ __('User profile') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('user.index') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'distribution-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('distribution') }}">
                <span class="sidebar-mini"> DM </span>
                <span class="sidebar-normal"> {{ __('Distribution Management') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item{{ $activePage == 'site' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('site') }}">
          <i class="material-icons">S</i>
            <p>{{ __('Sites') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'table' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('table') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('Table List') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'stock_currency' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('stock_currency') }}">
          <i class="material-icons">inventory_2</i>
            <p>{{ __('Stocks & Currencies') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
