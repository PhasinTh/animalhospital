<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <!-- Navbar content -->
  <a class="navbar-brand" href="{{ url('/') }}">Animal Hospital</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item px-3 {{Request::is('/') ? 'active' : ''}}">
        <a class="nav-link text-center" href="{{ url('/') }}"><i class="fa fa-home"></i><br>Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item px-3 @if(preg_match("[^pet]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('pet') }}"><i class="fa fa-paw"></i><br>Pet</a>
      </li>
      <li class="nav-item px-3 @if(preg_match("[^prescription]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('prescription') }}"><i class="fas fa-receipt"></i><br>Prescription</a>
      </li>
      <li class="nav-item px-3 @if(preg_match("[^appointment]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('appointment') }}"><i class="far fa-calendar-alt"></i><br>Appointment</a>
      </li>
      <li class="nav-item px-3  @if(preg_match("[^schedule]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('schedule') }}"><i class="far fa-calendar-alt"></i><br>schedule</a>
      </li>
      <li class="nav-item px-3 @if(preg_match("[^dailychart]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('dailychart') }}"><i class="fa fa-chart-bar"></i><br>Chart</a>
      </li>

      <li class="nav-item px-3 @if(preg_match("[^employee]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('employee') }}"><i class="fa fa-user"></i><br>Personal</a>
      </li>

      <li class="nav-item px-3 @if(preg_match("[^drug]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('drug') }}"><i class="fa fa-pills"></i><br>Drug</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto mr-0">
      <li class="nav-item px-2  @if(preg_match("[^prescription]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('prescription') }}">{{Helpers::waitingDrug()}}<br>ห้องยา</a>
      </li>
      <li class="nav-item px-2  @if(preg_match("[^receipt]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('receipt') }}">{{Helpers::waitingReceipt()}}<br>ห้องการเงิน</a>
      </li>
      <li class="nav-item px-2  @if(preg_match("[^diagnose]",Request::path())) active @else '' @endif">
        <a class="nav-link text-center" href="{{ url('diagnose') }}">{{Helpers::waitingHelper()}}<br>ห้องตรวจ</a>
      </li>
    </ul>
    <ul class="navbar-nav ml-2 pr-3">
      {{-- Authentication Links --}}
      @guest
          <li><a class="nav-link {{Request::is('login') ? 'active' : ''}}" href="{{ route('login') }}">Login</a></li>
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" href="" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <div class="user-circle"></div>
                  {{ Auth::user()->name }} <span class="caret"></span>
              </a>
              <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ route('employee.show',Auth::user()->id) }}">
                      ประวัติ
                  </a>
                  <a class="dropdown-item" href="">
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
  </div>
</nav>
