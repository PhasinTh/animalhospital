@extends('layout.app')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-edit"></i> แก้ไขค่าใช้จ่าย
        </div>
        <div class="card-body">
          <div class="container pt-5">
            <div class="row justify-content-center">
              <div class="col-md-8 col-12">
                {!! Form::model($drug,['route' => ['charge.update',$drug->id],'method' => 'PUT']) !!}
                <div class="row form-group">
                  {!! Form::label("name", "ชื่อค่าใช้จ่าย", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("name", null, ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("description", "รายละเอียด", ["class" => "col-2 text-right"]) !!}
                  {!! Form::textarea("description", null, ["class" => "col-8 form-control","rows"=>'5']) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("qty", "จำนวน", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("qty", null, ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("unit", "หน่วย", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("unit", null, ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("price", "ราคา", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("price", null, ["class" => "col-8 form-control"]) !!}
                </div>
              </div>

            </div>

            <div class="row justify-content-center">
              <div class="col-md-8 col-12">
                <div class="row justify-content-center">
                  <a href="{{route('drug.index')}}" class="btn btn-xs btn-danger">ยกเลิก</a>
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
