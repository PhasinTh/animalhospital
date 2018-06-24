@extends('layout.app')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-paw"></i> ข้อมูลเจ้าของสัตว์และสัตว์เลี้ยง
        </div>
        <div class="card-body">
              <table class="table table-bordered text-center" id="myTable">
                <thead>
                  <tr>
                    <th>สัตว์เลี้ยง</th>
                    <th>เพศ</th>
                    <th>ประเภท</th>
                    <th>พันธุ์</th>
                    <th>เจ้าของ</th>
                    <th>เบอร์โทรศัพท์</th>
                    <th>สถานะ</th>
                    <th colspan=""><a href="{{ route('pet.create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i></a></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($pets as $pet)
                    <tr>
                      <td>{{ $pet->name }}</td>
                      <td>{{ $pet->sex }}</td>
                      <td>{{ $pet->pettype->name }}</td>
                      <td>{{ $pet->speies }}</td>
                      <td>{{ $pet->customer->name }}</td>
                      <td>{{ $pet->customer->tel }}</td>
                      @if(($pet->registers->where('status','ส่งตรวจ')->count()) > 0)
                        <td class="text-white bg-success">
                        ส่งตรวจ
                      @else
                        <td>
                      @endif
                      </td>
                      <td colspan=""><a href="{{ route('pet.show',$pet->id)}}" class="btn btn-xs btn-info">ดูเพิ่มเติม</a></td>

                    </tr>
                  @endforeach
                </tbody>
              </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row justify-content-center">
    {{ $pets->links() }}
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
