<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
  <a class="navbar-brand" href="/">Animal Hospital</a>
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
      <li class="nav-item {{Request::is('/') ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Home">
        <a class="nav-link" href="{{ url('/') }}">
          <i class="fa fa-fw fa-home"></i>
          <span class="nav-link-text">Home</span>
        </a>
      </li>
      <li class="nav-item @if(preg_match("[^drug]",Request::path())) active @else '' @endif" href="{{ url('drug') }}" data-toggle="tooltip" data-placement="right" title="ยา">
        <a class="nav-link" href="{{ url('drug') }}">
          <i class="fa fa-fw fa-pills"></i>
          <span class="nav-link-text">ข้อมูลยา</span>
        </a>
      </li>

      <li class="nav-item @if(preg_match("[^pet]",Request::path())) active @else '' @endif" data-toggle="tooltip" data-placement="right" title="Pet">
        <a class="nav-link" href="{{ url('pet') }}">
          <i class="fa fa-fw fa-paw"></i>
          <span class="nav-link-text">ข้อมูลสัตว์เลี้ยงและเจ้าของ</span>
        </a>
      </li>
      <li class="nav-item @if(preg_match("[^employee]",Request::path())) active @else '' @endif" data-toggle="tooltip" data-placement="right" title="Personal">
        <a class="nav-link" href="{{ url('employee') }}">
          <i class="fa fa-fw fa-user"></i>
          <span class="nav-link-text">ข้อมูลพนักงาน</span>
        </a>
      </li>
      <li class="nav-item @if(preg_match("[^appointment]",Request::path())) active @else '' @endif" data-toggle="tooltip" data-placement="right" title="Appointment">
        <a class="nav-link" href="{{ url('appointment') }}" >
          <i class="far fa-fw fa-calendar-alt"></i>
          <span class="nav-link-text">ตารางนัดหมาย</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('schedule') ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Schedule">
        <a class="nav-link " href="{{ url('schedule') }}" >
          <i class="far fa-fw fa-calendar"></i>
          <span class="nav-link-text">ตารางวันทำงาน</span>
        </a>
      </li>
      <li class="nav-item {{Request::is('dailychart') ? 'active' : ''}}" data-toggle="tooltip" data-placement="right" title="Schedule">
        <a class="nav-link " href="{{ url('dailychart') }}" >
          <i class="far fa-fw fa-chart-bar"></i>
          <span class="nav-link-text">สถิติ</span>
        </a>
      </li>
      <li class="nav-item @if(preg_match("[^receipt]",Request::path())) active @else '' @endif" href="{{ url('receipt') }}" data-toggle="tooltip" data-placement="right" title="ห้องการเงิน">
        <a class="nav-link" href="{{ url('receipt') }}">
          <i class="fa fa-fw fa-money-check-alt"></i>
          <span class="nav-link-text">ห้องการเงิน</span> <span class="badge badge-pill badge-light my-1 float-right">{{ Helpers::waitingReceipt()}}</span>
        </a>
      </li>
      <li class="nav-item @if(preg_match("[^prescription]",Request::path())) active @else '' @endif" href="{{ url('receipt') }}" data-toggle="tooltip" data-placement="right" title="ห้องยา">
        <a class="nav-link" href="{{ url('prescription') }}">
          <i class="fas fa-fw fa-receipt"></i>
          <span class="nav-link-text">ห้องจ่ายยา</span> <span class="badge badge-pill badge-light my-1 float-right">{{ Helpers::waitingDrug()}}</span>
        </a>
      </li>
      <li class="nav-item @if(preg_match("[^diagnose]",Request::path())) active @else '' @endif" href="{{ url('receipt') }}" data-toggle="tooltip" data-placement="right" title="ห้องตรวจ">
        <a class="nav-link" href="{{ url('diagnose') }}">
          <i class="fas fa-fw fa-thermometer"></i>
          <span class="nav-link-text">ห้องตรวจ</span> <span class="badge badge-pill badge-light my-1 float-right">{{ Helpers::waitingDiagnose()}}</span>
        </a>
      </li>

      <li class="nav-item" data-toggle="tooltip" data-placement="right" title="ในห้องแพทย์">
        <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti" data-parent="#exampleAccordion">
          <i class="fas fa-fw fa-stethoscope"></i>
          <span class="nav-link-text">ในห้องแพทย์</span>
        </a>
        <ul class="sidenav-second-level collapse" id="collapseMulti">
          @if($waiting)
            @foreach ($waiting as $key => $value)
              <li>
                <a href="{{ url('siglediagnose').'/'.$value->id}}" >{{ mb_substr($value->name,0,15) }} <span class="badge badge-pill badge-light float-right">{{$value->registers_count}}</span></a>
                  @if ( mb_strlen($value->name) > 15)
                    ...
                  @else
                  @endif
                </a>
              </li>
            @endforeach
          @endif
        </ul>
      </li>
    </ul>
    <ul class="navbar-nav sidenav-toggler">
      <li class="nav-item">
        <a class="nav-link text-center" id="sidenavToggler">
          <i class="fa fa-fw fa-angle-left"></i>
        </a>
      </li>
    </ul>
    <ul class="navbar-nav ml-auto">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle mr-lg-2" id="alertsDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <i class="fa fa-fw fa-bell"></i>
          {{-- <span class="d-lg-none">Alerts
            <span class="badge badge-pill badge-warning">6 New</span>
          </span> --}}
          @if($queue && $queue->count())
            <span class="indicator text-warning d-none d-lg-block">
              <i class="fa fa-fw fa-circle"></i>
            </span>
          @endif
        </a>
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
          <h6 class="dropdown-header">คิว รอตรวจ:</h6>
          <div class="dropdown-divider"></div>
          @if($queue)
            @foreach ($queue as $key => $value)
              <a class="dropdown-item" href="{{ route('diagnose.show',$value) }}">
                <span class="text-success">
                  <strong>
                    <i class="fa fa-long-arrow-up fa-fw"></i>ชื่อ : {{$value->pet->name}}  ({{$value->pet->pettype->name}})</strong>
                </span>
                <span class="small float-right text-muted">{{\Carbon\Carbon::parse($value->created_at)->format('H:i a')}}</span>
                <div class="dropdown-message small">พันธุ์ : {{$value->pet->speies}} เจ้าของ : {{ $value->pet->customer->name }}</div>
              </a>
              <div class="dropdown-divider"></div>
            @endforeach
          @endif
      </li>
      @guest
          <li><a class="nav-link {{Request::is('login') ? 'active' : ''}}" href="{{ route('login') }}">เข้าสู่ระบบ</a></li>
      @else
          <li class="nav-item dropdown">
              <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                  <i class="fa fa-user-circle"></i>
                  {{ Auth::user()->name }}
                  {{-- <span class="caret"></span> --}}
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                  <a class="dropdown-item {{ Request::is('profile/'.Auth::user()->name, 'profile/'.Auth::user()->name . '/edit') ? 'active' : null }}" href="{{ route('employee.show',Auth::user()->id) }}">
                      ข้อมูลผู้ใช้
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
  </div>
</nav>
