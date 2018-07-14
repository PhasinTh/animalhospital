@extends('layout.app')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-plus"></i> เพิ่มข้อมูลยา
        </div>
        <div class="card-body">
          <div class="container pt-5">
            <div class="row justify-content-center">
              <div class="col-md-8 col-12">
                {!! Form::open(['route' => 'drug.store']) !!}
                <div class="row form-group">
                  {!! Form::label("drugname", "ชื่อยา *", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("drugname", "", ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("drugdetail", "วิธีใช้", ["class" => "col-2 text-right"]) !!}
                  {!! Form::textarea("drugdetail", "", ["class" => "col-8 form-control","rows"=>'5']) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("drugqty", "จำนวน", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("drugqty", "", ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("drugunit", "หน่วย", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("drugunit", "", ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("drugprice", "ราคา *", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("drugprice", "", ["class" => "col-8 form-control"]) !!}
                </div>
              </div>
            </div>

            <div class="row justify-content-center">
              <div class="col-md-8 col-12">
                <div class="row justify-content-center">
                  <a href="{{route('drug.index')}}" class="btn btn-xs btn-info">กลับ</a>
                  <a href="" class="btn btn-xs btn-danger">ยกเลิก</a>
                  {!! Form::submit("บันทึก", ["class" => "btn btn-xs btn-success"]) !!}
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
