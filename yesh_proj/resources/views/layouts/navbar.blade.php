<nav class="main-nav--bg">
    <div class="container-fluid main-nav">
      @if(
        Request::route()->getActionName() == 'App\Http\Controllers\ProjectController@index' or
        Request::route()->getActionName() == 'App\Http\Controllers\ProjectController@show'
      )
      @include('navbar.project')
      @else
      @include('navbar.default')
      @endif
      <div class="main-nav-end">
        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
          <span class="sr-only">Toggle menu </span>
          <span class="icon menu-toggle--gray" aria-hidden="true"></span>
        </button>
        <button id="switchTheme" class="theme-switcher gray-circle-btn" type="button" title="Switch theme" >
          <span class="sr-only">Switch theme</span>
          <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
          <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
        </button>
        <div class="notification-wrapper">
          <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
            <span class="sr-only">To messages</span>
            <span class="icon notification active" aria-hidden="true"></span>
          </button>
          <ul class="users-item-dropdown notification-dropdown dropdown">
            <li>
              <a href="#">
                <div class="notification-dropdown-icon info">
                  <i data-feather="check"></i>
                </div>
                <div class="notification-dropdown-text">
                  <span class="notification-dropdown__title">System just updated</span>
                  <span class="notification-dropdown__subtitle">The system has been successfully upgraded. Read more
                    here.</span>
                </div>
              </a>
            </li>
            <li>
              <a href="#">
                <div class="notification-dropdown-icon danger">
                  <i data-feather="info" aria-hidden="true"></i>
                </div>
                <div class="notification-dropdown-text">
                  <span class="notification-dropdown__title">The cache is full!</span>
                  <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of memory space and
                    interfere ...</span>
                </div>
              </a>
            </li>
            <li>
              <a href="#">
                <div class="notification-dropdown-icon info">
                  <i data-feather="check" aria-hidden="true"></i>
                </div>
                <div class="notification-dropdown-text">
                  <span class="notification-dropdown__title">New Subscriber here!</span>
                  <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
                </div>
              </a>
            </li>
            <li>
              <a class="link-to-page" href="#">Go to Notifications page</a>
            </li>
          </ul>
        </div>
        <div class="nav-user-wrapper">
          <button  class="nav-user-btn dropdown-btn" title="My profile" type="button">
            <span class="sr-only">My profile</span>
            <span class="nav-user-img">
            @if($SesionInfo->islogged())
              <picture>
                <source srcset="data:image/jpeg;base64,{{auth()->guard($SesionInfo->getSesionGuard())->user()->img}}" type="image/webp">
                <img src="data:image/jpeg;base64,{{auth()->guard($SesionInfo->getSesionGuard())->user()->img}}" alt="{{auth()->guard($SesionInfo->getSesionGuard())->user()->name}}">
              </picture>
            @endif
            </span>
          </button>
          <ul class="users-item-dropdown nav-user-dropdown dropdown">
            <li><a id="btn_settings" href="#" data-bs-toggle="modal" data-bs-target="#settings_modal"  >
                <i data-feather="settings" aria-hidden="true"></i>
                <span>Account settings</span>
              </a></li>
            <li><a class="danger" href="{{ route('logout') }}"  onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">
                <i data-feather="log-out" aria-hidden="true"></i>
                <span>Log out</span>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              </a></li>
          </ul>
        </div>
      </div>
    </div>
  </nav>