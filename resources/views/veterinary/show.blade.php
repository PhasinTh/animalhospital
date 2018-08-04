@extends('layout.app')
@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-tie"></i> ข้อมูลสัตว์แพทย์
    </div>
    <div class="card-body">
      <div class="row pt-3">
        <div class="container">
          <div class="row">
            <div class="col-md-9">
              <p>ชื่อ : {{ $veterinary->name }}</p>
              <p>ที่อยู่ : {{ $veterinary->address }} </p>
              <p>e-mail : {{ $veterinary->email }}</p>
              <p>เบอร์โทร : {{ $veterinary->tel }}</p>
            </div>
            <div class="col-md-3">
              <div class="row">
                @if ($veterinary->id == Auth::user()->id)
                  <a href="{{route($url.'.edit',$veterinary->id)}}" class="btn btn-xs btn-info">แก้ไข</a>
                  {!! Form::open(['route' => [$url.'.destroy',$veterinary->id],'method'=>'DELETE' ]) !!}
                  {!! Form::submit("ลบ", ['class' => 'btn btn-xs btn-danger','style'=>'width:80px']) !!}
                  {!! Form::close() !!}
                @endif
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-tie"></i> วันทำงาน
    </div>
    <div class="card-body">
      <div class="row pt-3 justify-content-center">
        @foreach ($veterinary->workdays as $day)
          <button type="button" name="button" class="btn btn-lg {{ Helpers::randomstyle() }}">{{$day->name}}</button>
        @endforeach
      </div>
    </div>
  </div>



@endsection
