@extends('layout.app')

@section('content')
  <div class="row justify-content-center">
    <div class="col-md-6">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-info-circle"></i> ตั้งค่าระบบ
        </div>
        <div class="card-body">
          {{ Form::open(['route' => 'setting.store']) }}
          <div class="row form-group">
            <div class="col-md-5 text-right">
              {{ Form::label("name","ชื่อ บริษัท","",[]) }}
            </div>
            <div class="col-md-5">
              @if ($setting)
                {{ Form::text("name",$setting->name,['class'=>'form-control']) }}
              @else
                {{ Form::text("name",null,['class'=>'form-control']) }}
              @endif
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-5 text-right">
              {{ Form::label("address","ที่อยู่ บริษัท",null,[]) }}
            </div>
            <div class="col-md-5">
              @if ($setting)
                {{ Form::textarea("address",$setting->address,['class'=>'form-control','rows'=>'5']) }}
              @else
                {{ Form::textarea("address",null,['class'=>'form-control','rows'=>'5']) }}
              @endif
            </div>
          </div>

          <div class="row form-group">
            <div class="col-md-5 text-right">
              {{ Form::label("tel","เบอร์โทรศัพท์",null,[]) }}
            </div>
            <div class="col-md-5">
              @if ($setting)
                {{ Form::text("tel",$setting->tel,['class'=>'form-control']) }}
              @else
                {{ Form::text("tel",null,['class'=>'form-control']) }}
              @endif
            </div>
          </div>

          <div class="row justify-content-center py-3">
            <button class="btn btn-success px-5" type="submit" name="button">บันทึก</button>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
