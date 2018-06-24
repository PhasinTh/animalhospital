@extends('layout.app')
@section('content')
  {!! Html::style('css/parsley.css') !!}
  {!! Html::style('css/select2.min.css') !!}


  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-user-tie"></i> {{ $title }}
    </div>
    <div class="card-body">
      <div class="row">
        <div class="container pt-5">
          <div class="row justify-content-center">
            <div class="col-md-8 col-12">
              {{ Form::model($employee,['route' => [$url.'.update',$employee->id], 'method' => 'PUT']) }}
              <div class="row form-group">
                {!! Form::label("veterinaryname", "ชื่อ - สกุล", ["class" => "col-2 text-right"]) !!}
                {!! Form::text("name", null, ["class" => "col-8 form-control"]) !!}
              </div>

              <div class="row form-group">
                {!! Form::label("veterinaryemail", "email", ["class" => "col-2 text-right"]) !!}
                {!! Form::text("email", null, ["class" => "col-8 form-control"]) !!}
              </div>

              <div class="row form-group">
                {!! Form::label("veterinaryaddress", "ที่อยู่", ["class" => "col-2 text-right"]) !!}
                {!! Form::textarea("address", null, ["class" => "col-8 form-control","rows"=>"5"]) !!}
              </div>

              <div class="row form-group">
                {!! Form::label("veterinarytel", "เบอร์โทร", ["class" => "col-2 text-right"]) !!}
                {!! Form::text("tel", null, ["class" => "col-8 form-control"]) !!}
              </div>

              <div class="row form-group">
                {{ Form::label('emptypeId','ประเภทพนักงาน :',["class" => "col-2 text-right"]) }}
                {{ Form::select('emptypeId',$emptypes,null,array('class'=>'col-8 form-control')) }}
              </div>
            </div>
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
      <div class="row">
        <div class="container pt-5">
          <div class="container pt-3">
            <div class="row justify-content-center">
              <div class="col-md-8">
                <div class="row form-group">
                  {{ Form::label('dayID','วันทำงาน :',["class" => "col-2 text-right"]) }}
                  {{ Form::select('dayID[]',$dayofweek,null,array('class'=>'col-8 form-control select2-multi','multiple'=>'multiple','size'=>'7','name'=>'dayID[]')) }}
                </div>
              </div>
            </div>
          </div>

          <div class="row justify-content-center">
            <a href="{{route($url.'.index')}}" class="btn btn-xs btn-danger">ยกเลิก</a>
            {!! Form::submit("บันทึก", ["class" => "btn btn-xs btn-success"]) !!}
            {!! Form::close() !!}
          </div>

        </div>
      </div>
    </div>
  </div>


@endsection

@section('scripts')
  {!! Html::script('js/parsley.min.js') !!}
  {!! Html::script('js/select2.min.js') !!}
  <script type="text/javascript">
    $('.select2-multi').select2();
    $('.select2-multi').select2().val({!! json_encode($employee->workdays()->allRelatedIds()) !!}).trigger('change');
  </script>

@endsection
