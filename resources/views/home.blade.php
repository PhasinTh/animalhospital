@extends('layout.app')
@section('title')
  | หน้าแรก
@endsection
@section('content')
  <div class="" ng-app="petSearch" ng-controller="myCtrl">
  <div class="container ">
    {{-- Card menu --}}
    <div class="row pt-5">
      <div class="col-md-3">
          <div class="card card-red">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <i class="fa fa-calendar fa-5x"></i>
              </div>
              <div class="col-md-9 text-right">
                <a href="{{route('appointment.index')}}">
                  <div class="huge">{{$stats->veterinary}}</div>
                  <div class="title">นัดหมายวันนี้</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
          <div class="card card-green">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <i class="fa fa-dollar-sign fa-5x"></i>
              </div>
              <div class="col-md-9 text-right">
                <a href="{{route('receipt.index')}}">
                  <div class="huge">{{Helpers::waitingReceipt()}}</div>
                  <div class="title">ห้องการเงิน</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
          <div class="card card-yellow">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <i class="fa fa-receipt fa-5x"></i>
              </div>
              <div class="col-md-9 text-right">
                <a href="{{route('prescription.index')}}">
                  <div class="huge">{{$stats->prescription}}</div>
                  <div class="title">ใบสั่งยา</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
          <div class="card card-blue">
          <div class="card-header">
            <div class="row">
              <div class="col-md-3">
                <i class="fa fa-user fa-5x"></i>
              </div>
              <div class="col-md-9 text-right">
                <a href="{{route('diagnose.index')}}">
                  <div class="huge">{{Helpers::waitingDiagnose()}}</div>
                  <div class="title">คิวรอบริการ</div>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
    {{-- end row cardmenu --}}

    {{-- Content --}}
    <div class="pt-5" >
      <div class="row">
        <div class="col-md-6">
          <h3>ข้อมูลสัตว์เลี้ยง</h3>
        </div>
        <div class="col-md-6">
              <div class="row form-group has-feedback" style="width:600px;">
              <input type="text" class="form-control w-100" name="search" id="search" placeholder="ค้นหา..." ng-model="search">
                <span class="glyphicon glyphicon-search form-control-feedback"></span>
              </div>
        </div>
      </div>

        <div class="row">
          <table class="table" id="dataTable">
            <tr>
              <td>ชื่อ</td>
              <td>ประเภท</td>
              <td>เจ้าของ</td>
              <td>Email</td>
              <td>โทรศัพท์</td>
              <td class="text-center">สถานะ</td>
              <td class="text-center">
                @if (Auth::user()->emptypeId == 1)
                  <a href="" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-plus-circle fa-2x"></i></a>
                @endif
              </td>
            </tr>
            <tr ng-repeat="pet in pets|filter : search|limitTo:5">
              <td>@{{ pet.name }}</td>
              <td>@{{ pet.pettype.name }}</td>
              <td>@{{ pet.customer.name }}</td>
              <td>@{{ pet.customer.email }}</td>
              <td>@{{ pet.customer.tel }}</td>
              <td class="text-center">
                <a href="" class="btn btn-success" ng-if="pet.registers_count">ส่งตรวจแล้ว</a>
              </td>
              <td class="text-left">
                <button type="button" name="button" ng-click="history(pet.id)" class="btn btn-info">ประวัติการรักษา </button>
                @if (Auth::user()->emptypeId == 1)
                  <button type="button" name="button" class="btn btn-danger" ng-click="redirect(pet.id)" ng-if="pet.registers_count == 0">ส่งตรวจ</button>
                @endif
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>



  {{-- History  --}}
  {{-- <div class="toggle"> --}}
  <div class="toggle" style="display: none">
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
                        <td>โรค</td>
                        <td>อาการ</td>
                        <td>สัตว์แพทย์</td>
                        <td></td>
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

  {{-- Modal --}}
  <div class="modal fade"  id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">กรอกข้อมูล</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row bg-gray">
            <div class="container-fluid py-2">
              <h5>ข้อมูลเจ้าของสัตว์</h5>
            </div>
          </div>

          <div class="container pt-3">
            <div class="row justify-content-center">
              <div class="col-md-8 col-12">
                {!! Form::open(['route' => 'pet.store']) !!}
                <div class="row form-group">
                  {!! Form::label("customername", "ชื่อ - สกุล", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("customername", "", ["class" => "col-8 form-control","required"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("customeremail", "email", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("customeremail", "", ["class" => "col-8 form-control","required"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("customeraddress", "ที่อยู่", ["class" => "col-2 text-right"]) !!}
                  {!! Form::textarea("customeraddress", null, ["class" => "col-8 form-control","rows"=>"5"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("customertel", "เบอร์โทร", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("customertel", "", ["class" => "col-8 form-control","required"]) !!}
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
                {{-- {!! Form::open(['route' => 'customer.store']) !!} --}}
                <div class="row form-group">
                  {!! Form::label("petname", "ชื่อ", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("petname", "", ["class" => "col-5 form-control","required"]) !!}

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
                </div>

                <div class="row form-group">
                  {!! Form::label("petscar", "ตำหนิ", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("petscar", "", ["class" => "col-8 form-control"]) !!}
                </div>

                <div class="row form-group">
                  {!! Form::label("petallergy", "แพ้ยา", ["class" => "col-2 text-right"]) !!}
                  {!! Form::text("petallergy", "", ["class" => "col-8 form-control"]) !!}
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          {!! Form::submit("บันทึก", ['class' => 'btn btn-xs btn-success','style'=>'width:100px']) !!}
        </div>
      </div>
    </div>
  </div>
@endsection

@section('scripts')
  <script src="js/angular.min.js"></script>

  <script type="text/javascript">
    var app = angular.module('petSearch',[]);
    app.controller('myCtrl',function ($scope,$http) {
      $scope.total = 0;
      $scope.pets = [];
      $scope.historys = [];
      $scope.prescription = [];

      $scope.update = function () {
        $http.get('{{url('api/getPet')}}')
        .then(function (response) {
          $scope.pets = response.data;
          // console.log($scope.pets);
        });
      };
      $scope.update();

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
