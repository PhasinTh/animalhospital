@extends('layout.app')

@section('content')
  <div class="row my-5 text-center ">
    <div class="col-md-3 px-0">
      <button class="btn btn-lg btn-info w-100 select" id="all" >
        <i class="fa  fa-2x">{{$prescriptions->count()}}</i>
        <p class="">ทั้งหมด</p>
      </button>
    </div>
    <div class="col-md-3 px-0">
      <button class="btn btn-lg btn-secondary w-100 select" id="daily" >
        <i class="fa fa-2x">{{  $prescriptions->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</i>
        <p class="">ประจำวัน</p>
      </button>
    </div>
    <div class="col-md-3 px-0">
      <button  class="btn btn-lg btn-dark w-100 select" id="waiting" >
        <i class="fa fa-2x">{{  $prescriptions->where('status','รอ')->count() }}</i>
        <p class="">รอ</p>
      </button>
    </div>

    <div class="col-md-3 px-0">
      <button  class="btn btn-lg btn-success w-100 select" id="done" >
        <i class="fa fa-2x">{{  $prescriptions->where('status','สำเร็จ')->count() }}</i>
        <p class="">เสร็จสิ้น</p>
      </button>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-info-circle"></i> ใบสั่งยา
        </div>
        <div class="card-body">
          <table class="table table-bordered text-center" id="myTable">
            <thead>
              <tr>
                <th>วันที่</th>
                <th>ทีมแพทย์</th>
                <th>ชื่อสัตว์</th>
                <th>เพศ</th>
                <th>ประเภท</th>
                <th>พันธุ์</th>
                <th>เจ้าของ</th>
                <th>status</th>
                <th></th>
              </tr>
            </thead>
            @foreach ($prescriptions as $prescription)
              <tr>
                <td>{{ \Carbon\Carbon::parse($prescription->updated_at)->format("m/d/Y") }}</td>
                <td>{{ $prescription->diagnose->employee->name }}</td>
                <td>{{ $prescription->diagnose->register->pet->name }}</td>
                <td>{{ $prescription->diagnose->register->pet->sex }}</td>
                <td>{{ $prescription->diagnose->register->pet->pettype->name }}</td>
                <td>{{ $prescription->diagnose->register->pet->speies }}</td>
                <td>{{ $prescription->diagnose->register->pet->customer->name }}</td>
                <td>{{ $prescription->status }}</td>
                <td><a href="{{route('prescription.show',$prescription->id)}}" class="btn btn-xs btn-info w-100" style="height:35px;">ดูคำสั่งยา</a></td>
                {{-- <td><a href="{{ route('veterinary.create') }}" class="btn btn-xs btn-success">ADD</a></td> --}}
              </tr>
            @endforeach
          </table>
        </div>
      </div>
    </div>
  </div>


  @section('scripts')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
    <script type="text/javascript">
    var table;
    $(document).ready( function () {
      var table = $('#myTable').DataTable({
        info:false
      });

      $(".select").click(function () {
        var type = $(this).attr('id');
        var filter = "";
        var done = false;
        switch (type) {
          case "all":
            $.fn.dataTableExt.afnFiltering.length = 0;
            table.draw();
            done = true;
            break;
          case "daily":
          $.fn.dataTableExt.afnFiltering.length = 0;
          $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
              var now = new Date();
              // var createtime = Date.parse(data[7]);
              var temp = data[0];
              // temp = temp.replace(/\//g,"-");
              var createtime = new Date(temp);
              return createtime.getDate() == now.getDate();
          });
          table.draw();
          done = true;

            break;
          case "waiting":
            filter = "รอ";
            break;
          case "done":
            filter = "สำเร็จ";
            break;
          default:
            filter = "รอ";
            done = false;
        }

        // alert(filter)
        if(!done){
          $.fn.dataTableExt.afnFiltering.length = 0;
          $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
              return data[7] == (filter);
          });
          table.draw();
        }
      });
    });




    </script>
  @endsection

@endsection
