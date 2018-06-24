@extends('layout.app')
@section('content')

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-paw"></i> ข้อมูลเจ้าของสัตว์
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="row container justify-content-center">
            <div class="py-3 pl-3">
              <p>ชื่อ : {{ $pet->customer->name }}</p>
              <p>ที่อยู่ : {{ $pet->customer->address }} </p>
              <p>e-mail : {{ $pet->customer->email }}</p>
              <p>เบอร์โทร : {{ $pet->customer->tel }}</p>
            </div>
          </div>
        </div>
        <div class="col-md-3 pt-3">
          <div class="row justify-content-end">
            {{-- <a href="#" class="btn btn-xs btn-info">ประวัติการรักษา</a> --}}
            <div class="col-md-12">
              <div class="row form-row justify-content-end">
                <a href="{{route('pet.edit',$pet->id)}}" class="btn btn-xs btn-success" >แก้ไข</a>
                {{ Form::open(['route' => ['pet.destroy', $pet->id], 'method' => 'DELETE']) }}
                {{ Form::submit('ลบ', ['class' => 'btn btn-xs btn-danger']) }}
                {{ Form::close() }}
              </div>
            </div>
          </div>

          <div class="row justify-content-end pt-5">
            {{-- <a href="#" class="btn btn-xs btn-info">ส่งตรวจ</a> --}}
            {!! Form::open(['route'=>'registation.store']) !!}
            {!! Form::hidden('pet_id', $pet->id, []) !!}
              <div class="row form-row">
                <div class="form-group col-md-9">
                  {!! Form::select('employee_id',$veterinaries,null,["class"=>"form-control"]) !!}
                </div>
                <div class="form-group col-md-3">
                  {!! Form::submit("ส่งตรวจ", ['class'=>'btn btn-xs btn-info']) !!}
                </div>
            {{-- </div> --}}
            </div>
          {!! Form::close() !!}
        </div>

      </div>
    </div>
  </div>

  <div class="card mb-3">
    <div class="card-header">
      <i class="fa fa-paw"></i> ข้อมูลสัตว์เลี้ยง
    </div>
    <div class="card-body">
      <div class="container">
        <div class="row">
          <div class="col-md-2">
            ชื่อ : {{$pet->name}}
          </div>
          <div class="col-md-2">
            เพศ : {{$pet->sex}}
          </div>
          <div class="col-md-2">
            พันธุ์ : {{$pet->speies}}
          </div>
          <div class="col-md-2">
            ตำหนิ : {{$pet->scar}}
          </div>
          <div class="col-md-2">
            แพ้ยา : {{$pet->allergy}}
          </div>
          <div class="col-md-2">
            อายุ : {{$pet->age}}
          </div>
        </div>
      </div>
    </div>
  </div>

    {{-- History  --}}
    {{-- <div class="toggle"> --}}
    <div class="" ng-app="petApp" ng-controller="myCtrl">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-paw"></i> ประวัติการรักษา
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="container">
                  <div class="row">
                    <div class="col-md-6">
                      <h3>ประวัติการรักษา</h3>
                    </div>
                    <div class="col-md-6">
                          <div class="row form-group has-feedback" style="width:600px;">
                          <input type="text" class="form-control w-100" name="search" id="search" placeholder="ค้นหา..." ng-model="historysearch">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                          </div>
                    </div>
                  </div>
                  <div class="row my-3">
                    <div class="col-md-12">
                      <table class="table">
                        <tr>
                          <td>วันที่</td>
                          <td>วินจิฉัยโรค</td>
                          <td>อาการ</td>
                          <td>แพทย์</td>
                          <td class="text-center">#</td>
                        </tr>
                        <tr ng-repeat="history in historys | filter:historysearch | limitTo:10">
                          <td>@{{ history.diagnose.created_at.substring(0,10) }}</td>
                          <td>@{{ history.diagnose.diagnose }}</td>
                          <td>อาการ</td>
                          <td>@{{ history.veterinary.name }}</td>
                          <td  class="text-center">
                            <button type="button" name="button" class="btn btn-success" ng-click="info(history.diagnose.id)">ข้อมูลสั่งยา</button>
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


    <div class="toggle2" style="display: none">
      <div class="card mb-3">
        <div class="card-header">
          <i class="fa fa-paw"></i> ประวัติการสั่งยา
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <div class="row justify-content-center">
              <div class="col-md-12">
                <div class="container">
                  <div class="row my-3">
                    <div class="col-md-12">
                      <table class="table">
                        <tr>
                          <td>#</td>
                          <td>ชื่อยา</td>
                          <td>วิธีใช้</td>
                          <td>ราคาต่อหน่วย</td>
                          <td>จำนวน</td>
                          <td>รวม</td>
                        </tr>
                        <tr ng-repeat="presc in prescription" ng-init="total = 0">
                          <td>@{{ $index+1 }}</td>
                          <td>@{{ presc.drug.name }}</td>
                          <td>@{{ presc.drug.detail }}</td>
                          <td>@{{ presc.drug.price }}</td>
                          <td>@{{ presc.quantity }}</td>
                          <td>
                            @{{ (presc.drug.price *  presc.quantity).toFixed() }}
                          </td>
                        </tr>

                        <tr>
                          <td colspan="5" class="text-right">รวม</td>
                          <td>
                            @{{ total.toFixed()}}
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" class="text-right">ภาษีมูลค่าเพิ่ม 7 %</td>
                          <td>
                            @{{ (total*0.07).toFixed() }}
                          </td>
                        </tr>
                        <tr>
                          <td colspan="5" class="text-right">ยอดเงินรวมทั้งสิน</td>
                          <td>
                            @{{ ((total*0.07) + total).toFixed() }}
                          </td>
                        </tr>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>

@endsection

@section('scripts')
  <script src="{{asset('js/angular.min.js')}}"></script>
  <script type="text/javascript">
    var app = angular.module('petApp',[]);
    app.controller('myCtrl',function ($scope,$http) {
      $scope.total = 0;
      $scope.historys = [];
      $scope.prescription = [];

      var id = '{{$pet->id}}';
      $scope.history = function (id) {
        $(".toggle2").hide();
        if($scope.oldHisID == id && $(".toggle").css('display')=="block")
          $(".toggle").hide();
        else {
          $(".toggle").show();
          $http.get('{{url('api/getregister')}}/'+id)
          .then(function (response) {
            $scope.historys = response.data;
            // console.log(response.data);
          });
          $scope.oldHisID = id;
      }
      };
      $scope.history(id);


      $scope.info = function (id) {
        if($scope.oldHisID == id && $(".toggle2").css('display')=="block")
          $(".toggle2").hide();
        else {
          $(".toggle2").show();
          console.log(id);

          $http.get('{{url('api/getinfo')}}/'+id)
          .then(function (response) {
            $scope.prescription = response.data;
              var total = 0;
              for(var i = 0; i < $scope.prescription.length; i++){
                  var product = $scope.prescription[i];
                  total += ($scope.prescription[i].drug.price * $scope.prescription[i].quantity);
              }
              $scope.total = total;
              // alert($scope.total);
            // console.log(response.data);
          });

          $scope.oldHisID = id;
      }
      };

      $scope.redirect = function (id) {
        window.location = '{{url('pet')}}/'+id;
      };

    });
  </script>

@endsection
