@extends('layout.app')
@section('styles')
  {{-- <link rel="stylesheet" href="{{asset('css/fullcalendar.min.css')}}"> --}}
  {{-- <link rel="stylesheet" href="{{asset('css/fullcalendar.print.min.css')}}"> --}}
@endsection

@section('content')
  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-info-circle"></i> ตารางการทำงาน
    </div>
    <div class="card-body">
      <div class="container">
        <table class="table table-borderless">
            @foreach ($dayofweek as $key => $value)
              <tr>
                <th style="width:10%;" class="bg-gray text-white text-center">{{ $value->name }}</th>
                @foreach ($value->employees as $key => $value)
                  <td>
                    <a href="{{route('employee.show',$value->id)}}" class="btn btn-info">{{ $value->name }}</a>
                  </td>
                @endforeach
              </tr>
            @endforeach
        </table>
      </div>
    </div>
  </div>



@endsection
