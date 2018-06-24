@extends('layout.app')
@section('content')
  <div class="row">
    <div class="container-fluid px-0">
      <div class="row py-5 text-center ">
        <div class="col-md-3 px-0">
          <a href="{{route('employee.index')}}" class="btn btn-lg btn-info w-100">
            <i class="fa fa-users fa-2x"></i>
            <p class="">พนักงานทั้งหมด</p>
          </a>
        </div>
        <div class="col-md-3 px-0">
          <a href="{{route('veterinary.index')}}" class="btn btn-lg btn-secondary w-100">
            <i class="fa fa-user-md fa-2x"></i>
            <p class="">สัตวแพทย์</p>
          </a>
        </div>
        <div class="col-md-3 px-0">
          <a href="{{route('finance.index')}}" class="btn btn-lg btn-dark w-100">
            <i class="fa fa-user-tie fa-2x"></i>
            <p class="">การเงิน</p>
          </a>
        </div>

        <div class="col-md-3 px-0">
          <a href="{{route('service.index')}}" class="btn btn-lg btn-success w-100">
            <i class="fa fa-user fa-2x"></i>
            <p class="">พนักงานบริการ</p>
          </a>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-tie"></i> {{ $title }}
    </div>
    <div class="card-body">
      <div class="row">
        <table class="table table-bordered text-center">
          <tr>
            <td>ชื่อ - นามสกุล</td>
            <td>เบอร์โทร</td>
            <td>ตำแหน่ง</td>
            <td>วันทำงาน</td>
            <td><a href="{{ route($url.'.create') }}" class="btn btn-xs btn-success" style="height:35px;"><i class="fa fa-plus-circle"></i></a></td>
          </tr>
          @foreach ($veterinaries as $veterinary)
            <tr>
              <td>{{ $veterinary->name }}</td>
              <td>{{ $veterinary->tel }}</td>
              <td>{{ $veterinary->emptype->name }}</td>
              <td>
                @foreach ($veterinary->workdays as $workdays)
                  {{ $workdays->name."," }}
                @endforeach
              </td>
              <td><a href="{{ route($url.'.show',$veterinary->id) }}" class="btn btn-xs btn-info" style="height:35px;">เพิ่มเติม</a></td>
              {{-- <td><a href="{{ route('veterinary.create') }}" class="btn btn-xs btn-success">ADD</a></td> --}}
            </tr>
          @endforeach
        </table>
      </div>
    </div>
  </div>


@endsection
