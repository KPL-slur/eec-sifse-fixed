<div class="sidebar" data-color="orange" data-background-color="white">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="" class="simple-text logo-normal">
      {{-- {{ __('EEC ID') }} --}}
      <img class="logos" src="{{ asset('user') }}/img/eecidfix.png" alt="EECID LOGO"/>
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
            <li class="nav-item{{ $activePage == 'user-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('userManagement') }}">
                <span class="sidebar-mini"> UM </span>
                <span class="sidebar-normal"> {{ __('User Management') }} </span>
              </a>
            </li>
            <li class="nav-item{{ $activePage == 'expert-management' ? ' active' : '' }}">
              <a class="nav-link" href="{{ route('expertManagement') }}">
                <span class="sidebar-mini"> FM </span>
                <span class="sidebar-normal">{{ __('FSE Management') }} </span>
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
          <i class="material-icons">radar</i>
            <p>{{ __('Sites Monitor') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'activity' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('expertActivity') }}">
          <i class="material-icons">content_paste</i>
            <p>{{ __('FSE Activity') }}</p>
        </a>
      </li>
      <li class="nav-item{{ $activePage == 'stock_currency' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('stocks') }}">
          <i class="material-icons">inventory_2</i>
            <p>{{ __('Stocks & Currencies') }}</p>
        </a>
      </li>
    </ul>
  </div>
</div>
