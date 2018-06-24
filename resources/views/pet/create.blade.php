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
        {!! Form::open(['route' => 'pet.store','id'=>'form']) !!}
        <div class="row form-group">
          {!! Form::label("customername", "ชื่อ - สกุล", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("customername", "", ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("customeremail", "email", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("customeremail", "", ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("customeraddress", "ที่อยู่", ["class" => "col-2 text-right"]) !!}
          {!! Form::textarea("customeraddress", null, ["class" => "col-8 form-control","rows"=>"5"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("customertel", "เบอร์โทร", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("customertel", "", ["class" => "col-8 form-control"]) !!}
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
          {!! Form::label("petname", "ชื่อ", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("petname", "", ["class" => "col-5 form-control"]) !!}

          {!! Form::label("petage", "อายุ", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("petage", "", ["class" => "col-3 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("petspicies", "สายพันธุ์", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("petspicies", "", ["class" => "col-5 form-control"]) !!}

          {!! Form::label("petsex", "เพศ", ["class" => "col-2 text-right"]) !!}
          {{ Form::select('petsex',["ผู้"=>"ผู้",'เมีย'=>'เมีย'],null,array('class'=>'col-3 form-control')) }}

        </div>

        <div class="row form-group">
          {{ Form::label('pettype_id','ประเภท :',["class" => "col-2 text-right"]) }}
          {{ Form::select('pettype_id',$pettypes,null,array('class'=>'col-8 form-control')) }}
          <a class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-plus-circle"></i></a>
        </div>

        <div class="row form-group">
          {!! Form::label("petscar", "ตำหนิ", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("petscar", "", ["class" => "col-8 form-control"]) !!}
        </div>

        <div class="row form-group">
          {!! Form::label("petallergy", "แพ้ยา", ["class" => "col-2 text-right"]) !!}
          {!! Form::text("petallergy", "", ["class" => "col-8 form-control"]) !!}
        </div>


        <div class="row">
          <div class="col-md-12">
            <div class="row justify-content-center">
              <a href="#" class="btn btn-xs btn-danger">ยกเลิก</a>
              {!! Form::submit("บันทึก", ['class' => 'btn btn-xs btn-success']) !!}
              {!! Form::close() !!}
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>


  <!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" ng-app="savepettype" ng-controller="myCtrl">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">เพิ่มประเภทสัตว์เลี้ยง</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            {{-- {!!Form::open(['url' => 'savepettype']) !!} --}}
            <div class="row form-group">
              {!! Form::label("name", "ชื่อประเภท", ["class" => "col-3 text-right"]) !!}
              {{-- {!! Form::text("name", "", ["class" => "col-8 form-control","id"=>"name","ng-model"=>"name"]) !!} --}}
              <input type="text" name="" value="" ng-model="name" class="col-8 form-control">
            </div>

          </div>

        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-success" id="save" ng-click="save()">บันทึก</button>

        {{-- {!! Form::submit('บันทึก',['class'=>'btn btn-primary','id'=>'save']) !!} --}}
        {{-- {!! Form::close() !!} --}}
      </div>
    </div>
  </div>
</div>

@endsection

@section('scripts')
  <script src="{!! asset('js/angular.min.js') !!}"></script>
  <script type="text/javascript">
    var app = angular.module('savepettype',[]);
    app.controller('myCtrl',function ($scope,$http) {
      $scope.save = function () {
        $http.post('{{url('api/savepettype')}}',{"name": $scope.name}).then(function (response) {
          // console.log(response);
          if(response.data == "success"){
            location.reload();
          }
        });
      };
    });

  </script>

@endsection
