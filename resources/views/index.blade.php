@extends('layout.app')
@section('title')
  | หน้าหลัก
@endsection

@section('content')
    <div class="container text-center pt-5">
      <h1>โรงพยาบาลสัตว์รังสิต</h1>
      <a href="{{route('login')}}" class="nav-link" >
        <h3 class="text-info">กรุณาเข้าสู่ระบบ</h3>
      </a>
    </div>
@endsection
