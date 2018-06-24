@extends('layout.app')
@section('content')
  <div class="row bg-gray">
    <div class="container-fluid py-2">
      <h5>ข้อมูลเจ้าของสัตว์</h5>
    </div>
  </div>

  <div class="container pt-3">
    <div class="row justify-content-center">
      <div class="col-md-8 col-12">
        {!! Form::model($pet,['route' => ['pet.update',$pet->id],'method' => 'put']) !!}
        <div class="row form-group">
          {!! Form::label("customername", "ชื่อ - สกุล", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("customername", $pet->customer->name, ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("customeremail", "email", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("customeremail", $pet->customer->email, ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("customeraddress", "ที่อยู่", ["class" => "col-2 text-right"]) !!}
          {!! Form::textarea("customeraddress", $pet->customer->address, ["class" => "col-8 form-control","rows"=>"5"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("customertel", "เบอร์โทร", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("customertel", $pet->customer->tel, ["class" => "col-8 form-control"]) !!}
        </div>
      </div>
    </div>
  </div>

  <div class="row bg-gray">
    <div class="container-fluid py-2">
      <h5>ข้อมูลสัตว์เลี้ยง</h5>
    </div>
  </div>

  <div class="container pt-3">
    <div class="row justify-content-center">
      <div class="col-md-8 col-12">
        {{-- {!! Form::open(['route' => 'pet.store']) !!} --}}
        <div class="row form-group">
          {!! Form::label("name", "ชื่อ", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("name", null, ["class" => "col-5 form-control"]) !!}

          {!! Form::label("age", "อายุ", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("age", null, ["class" => "col-3 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("spicies", "สายพันธุ์", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("spicies", null, ["class" => "col-5 form-control"]) !!}

          {!! Form::label("sex", "เพศ", ["class" => "col-2 text-right"]) !!}
          {{ Form::select('sex',["ผู้"=>"ผู้",'เมีย'=>'เมีย'],null,array('class'=>'col-3 form-control')) }}

        </div>

        <div class="row form-group">
          {{ Form::label('type_id','ประเภท :',["class" => "col-2 text-right"]) }}
          {{ Form::select('type_id',$pettypes,null,array('class'=>'col-8 form-control')) }}
        </div>

        <div class="row form-group">
          {!! Form::label("scar", "ตำหนิ", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("scar", null, ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("allergy", "แพ้ยา", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("allergy", null, ["class" => "col-8 form-control"]) !!}
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="row justify-content-center">
              <a href="#" class="btn btn-xs btn-danger">ยกเลิก</a>
              {!! Form::submit("บันทึก", ['class' => 'btn btn-xs btn-success']) !!}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

@endsection
