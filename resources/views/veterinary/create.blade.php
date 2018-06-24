@extends('layout.app')
@section('content')
  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('css/select2.min.css') !!}


  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-tie"></i> {{ $title }}
    </div>
    <div class="card-body">
      <div class="row justify-content-center">
        <div class="col-md-8 col-12">
          {!! Form::open(['route' => 'veterinary.store']) !!}
          <div class="row form-group">
            {!! Form::label("name", "ชื่อ - สกุล", ["class" => "col-2 text-right"]) !!}
            {!! Form::text("name", "", ["class" => "col-8 form-control"]) !!}
          </div>

          <div class="row form-group">
            {!! Form::label("email", "email", ["class" => "col-2 text-right"]) !!}
            {!! Form::text("email", "", ["class" => "col-8 form-control"]) !!}
          </div>

          <div class="row form-group">
            {!! Form::label("password", "รหัสผ่าน", ["class" => "col-2 text-right"]) !!}
            {{-- {!! Form::text("password", "", ["class" => "col-8 form-control","type"=>"password"]) !!} --}}
            {!! Form::password("password", ["class" => "col-8 form-control","type"=>"password"]) !!}
          </div>

          <div class="row form-group">
            {!! Form::label("address", "ที่อยู่", ["class" => "col-2 text-right"]) !!}
            {!! Form::textarea("address", null, ["class" => "col-8 form-control","rows"=>"5"]) !!}
          </div>

          <div class="row form-group">
            {!! Form::label("tel", "เบอร์โทร", ["class" => "col-2 text-right"]) !!}
            {!! Form::text("tel", "", ["class" => "col-8 form-control"]) !!}
          </div>

          <div class="row form-group">
            {{ Form::label('emptypeId','ประเภทพนักงาน :',["class" => "col-2 text-right"]) }}
            {{ Form::select('emptypeId',$emptypes,null,array('class'=>'col-8 form-control select2-multi')) }}
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-tie"></i> วันทำงาน
    </div>
    <div class="card-body">
      <div class="container pt-3">
        <div class="row justify-content-center">
          <div class="col-md-8">
            <div class="row form-group">
              {{ Form::label('dayID','วันทำงาน :',["class" => "col-2 text-right"]) }}
              {{ Form::select('dayID[]',$dayofweek,null,array('class'=>'col-8 form-control select2-multi','multiple'=>'multiple')) }}
            </div>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <a href="" class="btn btn-xs btn-danger">ยกเลิก</a>
        {!! Form::submit("บันทึก", ["class" => "btn btn-xs btn-success"]) !!}
        {!! Form::close() !!}
      </div>
    </div>
  </div>


@endsection

@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2();
  </script>

@endsection
