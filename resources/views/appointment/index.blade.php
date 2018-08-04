@extends('layout.app')
@section('title')
  | ตารางการนัดหมาย
@endsection
@section('content')
    <div class="row my-5 text-center ">
      <div class="col-md-3 px-0">
        <button class="btn btn-lg btn-info w-100 select" id="all" >
          <i class="fa  fa-2x">{{$appointments->count()}}</i>
          <p class="">นัดหมายทั้งหมด</p>
        </button>
      </div>
      <div class="col-md-3 px-0">
        <button class="btn btn-lg btn-secondary w-100 select" id="daily" >
          <i class="fa fa-2x">{{  $appointments->where('created_at', '>=', \Carbon\Carbon::today())->count() }}</i>
          <p class="">นัดวันนี้</p>
        </button>
      </div>
      <div class="col-md-3 px-0">
        <button  class="btn btn-lg btn-dark w-100 select" id="waiting" >
          <i class="fa  fa-2x">{{$appointments->where('status', 'สำเร็จ')->count()}}</i>
          <p class="">มาตามนัด</p>
        </button>
      </div>

      <div class="col-md-3 px-0">
        <button  class="btn btn-lg btn-success w-100 select" id="done" >
          <i class="fa  fa-2x">{{$appointments->where('status', 'ยกเลิก')->count()}}</i>
          <p class="">ยกเลิก</p>
        </button>
      </div>
    </div>

      <div class="card mb-3">
        <div class="card-header">
          <i class="far fa-calendar-alt"></i> ข้อมูลการนัดหมาย</div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-12">
              <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th>วันนัด</th>
                    <th>เวลา</th>
                    <th>ทีมแพทย์</th>
                    <th>ชื่อสัตว์เลี้ยง</th>
                    <th>ประเภท</th>
                    <th>พันธุ์</th>
                    <th>เจ้าของ</th>
                    <th>โทรศัพท์</th>
                    <th>status</th>
                    <th class="text-center">#</th>
                    <th class="text-center"></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($appointments as $key => $value)
                    @if ($value->diagnose)
                      <tr>
                        <td>{{ \Carbon\Carbon::parse($value->date)->format('m/d/Y') }} </td>
                        <td>{{ \Carbon\Carbon::parse($value->date)->format('H:i') }}</td>
                        <td>{{ $value->employee->name}}</td>
                        <td>{{ $value->diagnose->register->pet->name}}</td>
                        <td>{{ $value->diagnose->register->pet->pettype->name}}</td>
                        <td>{{ $value->diagnose->register->pet->speies}}</td>
                        <td>{{ $value->diagnose->register->pet->customer->name}}</td>
                        <td>{{ $value->diagnose->register->pet->customer->tel}}</td>
                        <td>
                          {{ $value->status}}
                        </td>
                        <td class="text-center">
                          @if ($value->status == "นัดหมาย")
                            <a href="{{route('appointment.show',$value->id)}}" class="btn btn-info">พิมพ์</a>
                            <button type="button" name="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal" onclick="setdata('{{$value->id}}','{{$value->diagnose->register->pet->id}}')">ส่งตรวจ</button>
                          @else
                            <a href="{{route('appointment.show',$value->id)}}" class="btn btn-info">ดูรายละเอียด</a>
                          @endif
                        </td>
                        <td>
                          @if ($value->status == "นัดหมาย")
                          {{Form::open(['route'=>['appointment.destroy',$value->id],'method'=>'DELETE'])}}
                          {{Form::submit('ยกเลิก',['class'=>'btn btn-danger'])}}
                          {{Form::close()}}
                          @endif
                        </td>
                      </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>



      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">ส่งตรวจ</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row justify-content-center">
                <div class="col-md-3 text-right">
                  ทีมแพทย์
                </div>
                <div class="col-md-5">
                  {{ Form::select("doctor",$doctor,null,['id'=>'docID','class'=>'form-control']) }}
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
              <button type="button" class="btn btn-primary" id="submit">ส่งตรวจ</button>
            </div>
          </div>
        </div>
      </div>


      @section('scripts')
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js" charset="utf-8"></script>
        <script type="text/javascript">
          var id = $("#docID").val();
          var petId;
          var appId;
          $("#submit").click(function () {
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });
            $.post("{{url('api/register')}}",{"appid":appId,"petid":petId,"docid":id},function (response) {
              // console.log(response);
              location.reload();
            });
          });

          function setdata(appid,petid) {
            petId = null;
            appId = null;
            petId = petid;
            appId = appid;
          };
        </script>

        <script type="text/javascript">
        var table;
        $(document).ready( function () {
          var table = $('#myTable').DataTable({
            info:false
          });

          $.fn.dataTableExt.afnFiltering.length = 0;
          $.fn.dataTable.ext.search.push(
            function( settings, data, dataIndex ) {
              var now = new Date();
              // var createtime = Date.parse(data[7]);
              var temp = data[0];
              // temp = temp.replace(/\//g,"-");
              var createtime = new Date(temp);
              return createtime.getDate() == now.getDate() && data[8] == "นัดหมาย";
          });
          table.draw();

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
                filter = "สำเร็จ";
                break;
              case "done":
                filter = "ยกเลิก";
                break;
              default:
                done = false;
            }
            if(!done){
              $.fn.dataTableExt.afnFiltering.length = 0;
              $.fn.dataTable.ext.search.push(
                function( settings, data, dataIndex ) {
                  return data[8] == (filter);
              });
              table.draw();
            }
          });
        });

        </script>
      @endsection


@endsection
