@extends('layout.app')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-search"></i> รายการรอตรวจ
        </div>
        <div class="card-body">
          <table class="table table-bordered text-center" id="myTable">
            <thead>
              <tr>
                <th>ทีมแพทย์</th>
                <th>ชื่อสัตว์</th>
                <th>เพศ</th>
                <th>ประเภท</th>
                <th>พันธุ์</th>
                <th>เจ้าของ</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($registers as $register)
                <tr>
                  <td>{{ $register->employee->name }}</td>
                  <td>{{ $register->pet->name }}</td>
                  <td>{{ $register->pet->sex }}</td>
                  <td>{{ $register->pet->pettype->name }}</td>
                  <td>{{ $register->pet->speies }}</td>
                  <td>{{ $register->pet->customer->name }}</td>
                  <td><a href="{{route('diagnose.show',$register->id)}}" class="btn btn-xs btn-info" style="height:35px;">ตรวจ</a></td>
                  {{-- <td><a href="{{ route('veterinary.create') }}" class="btn btn-xs btn-success">ADD</a></td> --}}
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  @section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    $(document).ready( function () {
      $('#myTable').DataTable({
        info:false,
      });
    });
    </script>
  @endsection


@endsection
