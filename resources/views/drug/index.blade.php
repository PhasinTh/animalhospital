@extends('layout.app')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-info-circle"></i> ข้อมูลยา
        </div>
        <div class="card-body">
          <table class="table table-bordered text-center" id="drugtable">
            <thead>
              <tr>
                <th>ชื่อยา</th>
                <th>วิธีใช้</th>
                <th>จำนวน</th>
                <th>หน่วย</th>
                <th>ราคา</th>
                <th><a href="{{ route('drug.create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i></a></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($drugs as $drug)
                <tr>
                  <td>{{ $drug->name }}</td>
                  <td>{{ $drug->description }}</td>
                  <td>{{ $drug->qty }}</td>
                  <td>{{ $drug->unit}}</td>
                  <td>{{ $drug->price}}</td>
                  <td>
                    <div class="row justify-content-center">
                      <a href="{{ route('drug.edit',$drug->id)}}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>แก้ไข</a>
                      {{ Form::open(['route' => ['drug.destroy', $drug->id], 'method' => 'DELETE']) }}
                      {{-- {{ Form::submit('ลบ', ['class' => 'btn btn-xs btn-danger']) }} --}}
                      <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-minus-circle"></i> ลบ</button>
                    </div>
                    {{ Form::close() }}
                 </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-info-circle"></i> ข้อมูลค่าใช้จ่ายเพิ่มเติม
        </div>
        <div class="card-body">
          <table class="table table-bordered text-center" id="chargetable">
            <thead>
              <tr>
                <th>ชื่อ</th>
                <th>คำอธิบาย</th>
                <th>ราคา</th>
                <th><a href="{{ url('charge/create')}}" class="btn btn-xs btn-success"><i class="fa fa-plus-circle"></i></a></th>
              </tr>
            </thead>
            <tbody>
              @foreach ($charges as $charge)
                <tr>
                  <td>{{ $charge->name }}</td>
                  <td>{{ $charge->description }}</td>
                  <td>{{ $charge->price}}</td>
                  <td>
                    <div class="row justify-content-center">
                      <a href="{{ route('charge.edit',$charge->id)}}" class="btn btn-xs btn-info"><i class="fa fa-edit"></i>แก้ไข</a>
                      {{ Form::open(['route' => ['drug.destroy', $charge->id], 'method' => 'DELETE']) }}
                      {{-- {{ Form::submit('ลบ', ['class' => 'btn btn-xs btn-danger']) }} --}}
                      <button type="submit" class="btn btn-xs btn-danger"><i class="fa fa-minus-circle"></i> ลบ</button>

                    </div>
                    {{ Form::close() }}
                 </td>
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
      $('#chargetable').DataTable({
        info:false,
      });

      $('#drugtable').DataTable({
        info:false,
      });
    });
    </script>
  @endsection

@endsection
