<div class="sidenav bg-dark collapse show navbar-collapse" id="navbarSupportedContent" >
  <a class="{{Request::is('/') ? 'active' : ''}}" href="{{ url('/') }}">
    <i class="fa fa-home"></i>
    Home
  </a>
  <a class="@if(preg_match("[^pet]",Request::path())) active @else '' @endif" href="{{ url('pet') }}">
    <i class="fa fa-paw"></i>
    Pet
  </a>
  {{-- <a class="" href="{{ url('prescription') }}">
    <i class="fas fa-receipt"></i>
    Prescription
  </a> --}}
  <a class="@if(preg_match("[^employee]",Request::path())) active @else '' @endif" href="{{ url('employee') }}"><i class="fa fa-user"></i> Personal</a>
  <a class="@if(preg_match("[^appointment]",Request::path())) active @else '' @endif"  href="{{ url('appointment') }}"><i class="far fa-calendar-alt"></i> Appointment</a>
  <a class="{{Request::is('schedule') ? 'active' : ''}}" href="{{ url('schedule') }}"><i class="far fa-calendar-alt"></i> schedule</a>
  <a class="{{Request::is('dailychart') ? 'active' : ''}}"  href="{{ url('dailychart') }}"><i class="fa fa-chart-bar"></i> Chart</a>


  <a class="@if(preg_match("[^drug]",Request::path())) active @else '' @endif" href="{{ url('drug') }}"><i class="fa fa-pills"></i> Drug</a>
  <a class="@if(preg_match("[^receipt]",Request::path())) active @else '' @endif"  href="{{ url('receipt') }}"><i class="fa fa-money-check-alt"></i> ห้องการเงิน <span class="badge badge-light">{{Helpers::waitingReceipt()}}</span></a>
  <a class="@if(preg_match("[^prescription]",Request::path())) active @else '' @endif"  href="{{ url('prescription') }}"><i class="fas fa-receipt"></i> ห้องยา <span class="badge badge-light">{{Helpers::waitingDrug()}}</span></a>
  <a class="@if(preg_match("[^diagnose]",Request::path())) active @else '' @endif"  href="{{ url('diagnose') }}"><i class="fas fa-stethoscope"></i> ห้องตรวจ <span class="badge badge-light">{{Helpers::waitingDiagnose()}}</span></a>


  <button class="dropdown-btn">
    <i class="fas fa-stethoscope"></i>
      ห้องตรวจ <span class="badge badge-light">{{Helpers::waitingDiagnose()}}</span>
    <i class="fa fa-angle-down arrow pt-2"></i>
  </button>
  <div class="dropdown-container">
    @foreach ($data as $key => $value)
      <a href="#">{{ mb_substr($value->name,0,15) }}
      @if ( mb_strlen($value->name) > 15)
        ...
      @else
      @endif
        <span class="badge badge-light">{{$value->registers_count}}</span>
      </a>
    @endforeach
  </div>


  <div class="container text-center">

  </div>
</div>
{{-- end sidebar --}}
