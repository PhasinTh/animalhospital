@extends('layout.app')
@section('content')
  <div class="row bg-gray">
    <div class="container-fluid py-2">
      <h5>แก้ไขยา</h5>
    </div>
  </div>

  <div class="container pt-5">
    <div class="row justify-content-center">
      <div class="col-md-8 col-12">
        {!! Form::model($drug,['route' => ['drug.update',$drug->id],'method' => 'PUT']) !!}
        <div class="row form-group">
          {!! Form::label("name", "ชื่อยา", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("name", null, ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("description", "วิธีใช้", ["class" => "col-2 text-right"]) !!}
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

    <div class="row ">
      <div class="col-md-8 col-12">
        <div class="row justify-content-end">
          <a href="{{ route('drug.index') }}" class="btn btn-xs btn-danger">ยกเลิก</a>
          {!! Form::submit("บันทึก", ["class" => "btn btn-xs btn-success"]) !!}
        </div>

      </div>

    </div>

  </div>
@endsection
