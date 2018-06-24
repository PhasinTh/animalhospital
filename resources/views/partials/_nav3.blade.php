<nav class="navbar navbar-expand navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Animal Hospital</a>
      <ul class="navbar-nav ml-auto mr-3">
        <li class="nav-item">
          <a class="nav-link notification " href="#"><i class="fa fa-bell"></i></a>
        </li>
        @guest
            <li><a class="nav-link {{Request::is('login') ? 'active' : ''}}" href="{{ route('login') }}">Login</a></li>
        @else
            <li class="nav-item dropdown">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                    <i class="fa fa-user-circle"></i>
                    {{ Auth::user()->name }}
                    <span class="caret"></span>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ route('employee.show',Auth::user()->id) }}">
                        ประวัติ
                    </a>
                    <a class="dropdown-item" href="{{route('setting.index')}}">
                        ตั้งค่าระบบ
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                        ออกจากระบบ
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </li>
        @endguest
      </ul>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle">
        <span class="navbar-toggler-icon"></span>
      </button>
</nav>
