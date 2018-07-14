@extends('layout.app')

@section('content')
      <div class="row my-5 text-center ">
        <div class="col-md-3 px-0">
          <button class="btn btn-lg btn-info w-100 select" id="all" >
            <i class="fa  fa-2x">{{$receipts->count()}}</i>
            <p class="">บิลทั้งหมด</p>
          </button>
        </div>
        <div class="col-md-3 px-0">
          <button class="btn btn-lg btn-secondary w-100 select" id="daily" >
            <i class="fa  fa-2x">{{  $receipts->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</i>
            <p class="">ประจำวัน</p>
          </button>
        </div>
        <div class="col-md-3 px-0">
          <button  class="btn btn-lg btn-dark w-100 select" id="waiting" >
            <i class="fa  fa-2x">{{  $receipts->where('status','รอ')->count() }}</i>
            <p class="">ยังไม่ชำระ</p>
          </button>
        </div>

        <div class="col-md-3 px-0">
          <button  class="btn btn-lg btn-success w-100 select" id="done" >
            <i class="fa fa-2x">{{  $receipts->where('status','ชำระแล้ว')->count() }}</i>
            <p class="">ชำระแล้ว</p>
          </button>
        </div>
      </div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-dollar-sign"></i> รายการจ่ายเงิน</div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-12">
          <table class="table text-center table-hover" id="myTable">
            <thead>
              <tr>
                <th>ทีมแพทย์</th>
                <th>ชื่อสัตว์</th>
                <th>เพศ</th>
                <th>ประเภท</th>
                <th>พันธุ์</th>
                <th>เจ้าของ</th>
                <th>status</th>
                <th>วันที่</th>
                <th></th>
              </tr>
            </thread>
            <tbody>
              @foreach ($receipts as $receipt)
                <tr>
                  <td>{{ $receipt->prescription->diagnose->employee->name }}</td>
                  <td>{{ $receipt->prescription->diagnose->register->pet->name }}</td>
                  <td>{{ $receipt->prescription->diagnose->register->pet->sex }}</td>
                  <td>{{ $receipt->prescription->diagnose->register->pet->pettype->name }}</td>
                  <td>{{ $receipt->prescription->diagnose->register->pet->speies }}</td>
                  <td>{{ $receipt->prescription->diagnose->register->pet->customer->name }}</td>
                  <td>{{ $receipt->status }}</td>
                  <td>{{ \Carbon\Carbon::parse($receipt->created_at)->format("m/d/Y") }}</td>
                  <td>
                    @if ($receipt->status == "ชำระแล้ว")
                      <a href="{{route('receipt.show',$receipt->id)}}" class="btn btn-xs btn-danger w-100" style="height:35px;">ดูข้อมูล</a>
                    @else
                      <a href="{{route('receipt.show',$receipt->id)}}" class="btn btn-xs btn-info w-100" style="height:35px;">ชำระ</a>
                    @endif

                  </td>
                  {{-- <td><a href="{{ route('veterinary.create') }}" class="btn btn-xs btn-success">ADD</a></td> --}}
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    {{ $receipts->links() }}
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
              var temp = data[7];
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
            filter = "ชำระแล้ว";
            break;
          default:
            done = false;
        }

        // alert(filter)
        if(!done){
          $.fn.dataTableExt.afnFiltering.length = 0;
          $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
              return data[6] == (filter);
          });
          table.draw();
        }
      });
    });

    // var pull = function(element) {
    //   $.fn.dataTable.ext.search.push(
    //     function(settings, data, dataIndex ) {
    //       var status = data[6] || "";
    //     }
    //   );
    // }


    </script>
  @endsection
@endsection
