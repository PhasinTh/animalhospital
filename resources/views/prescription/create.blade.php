@extends('layout.app')

@section('content')
  <div class="">
    {!! Form::open(['route'=>['diagnose.store']]) !!}
    {!! Form::hidden('register_id', $register->id, []) !!}

  <div class="row bg-gray">
    <div class="col-md-12 py-2">
      ตรวจสัตว์เลี้ยง
    </div>
  </div>

      <div class="row pt-3">
        <div class="col-md-8">
          <div class="row ">
            <div class="col-md-2 text-right">
              เจ้าของ
            </div>
            <div class="col-md-10">
              <p>ชื่อ : {{ $register->pet->customer->name }}</p>
              <p>เบอร์โทรศัพท์ : {{ $register->pet->customer->tel }}</p>
            </div>
          </div>

          <div class="row ">
            <div class="col-md-2 text-right">
              สัตว์เลี้ยง
            </div>
            <div class="col-md-3">
              <p>ชื่อ : {{ $register->pet->name }}  เพศ: {{ $register->pet->sex }} </p>
              <p>พันธุ์ : {{ $register->pet->speies }}</p>
            </div>

            <div class="col-md-3">
              <p>อายุ :  {{ $register->pet->age }}</p>
              <p>ตำหนิ : {{ $register->pet->scar }} แพ้ยา : {{ $register->pet->allergy }}</p>
            </div>
          </div>

        </div>
        <div class="col-md-4">

        </div>
      </div>

      <div class="row bg-gray">
        <div class="col-md-12 py-2">
          สรุปอาการ
        </div>
      </div>

      <div class="container">
        <div class="row pt-5">
          <div class="col-md-3 text-right">
            วินิจฉัย :
          </div>
          <div class="col-md-5">
            {!! Form::textarea("diagnose", null, ['class' => 'form-control','rows'=>'5']) !!}
          </div>
        </div>

        <div class="row pt-3">
          <div class="col-md-2">
            {!! Form::radio("appointment", 'นัดหมาย', false, []) !!}
            นัดหมาย
            <br/>
            {!! Form::radio("appointment", 'ไม่ได้นัดหมาย', true, []) !!}
            ไม่นัดหมาย
          </div>
          <div class="col-md-10">
            <div class="row">
              <div class="col-md-2 text-right">
                วันที่ :
              </div>
              <div class="col-md-8">
                <div class="row">
                  <div class="col-md-4">
                    {!! Form::date("date", \Illuminate\Support\Carbon::now(), ['class' => 'w-100']) !!}
                  </div>
                  <div class="col-md-2 text-right">
                    {!! Form::label('fixture_time', 'เวลา : ') !!}
                  </div>
                  <div class="col-md-5">
                    {!! Form::text('fixture_time', null, array('class' => '')) !!} น.
                  </div>
                </div>

              </div>
            </div>

            <div class="row">
              <div class="col-md-2 text-right">
                นัดเพื่อ :
              </div>
              <div class="col-md-2">
                {!! Form::text('detail', null, array('class' => '')) !!}
              </div>
              <div class="col-md-2 text-right">
                {!! Form::label('employee2', 'ผู้นัด : ') !!}
              </div>
              <div class="col-md-2">
                {!! Form::text('employee2', Auth::user()->name, array('class' => '')) !!}
              </div>
              <div class="col-md-2 text-right">
                ชื่อสัตว์ :
              </div>
              <div class="col-md-2">
                {{$register->pet->name}}
              </div>

            </div>

            <div class="row">
              <div class="col-md-2 text-right">
              </div>
              <div class="col-md-2">
              </div>
              <div class="col-md-2 text-right">
                {!! Form::label('employee', 'นัดพบ : ') !!}
              </div>
              <div class="col-md-2">
                {!! Form::text('employee', Auth::user()->name, array('class' => '')) !!}
              </div>
              <div class="col-md-2 text-right">
                ชื่อเจ้าของ :
              </div>
              <div class="col-md-2">
                {{$register->pet->customer->name}}
              </div>

            </div>

          </div>
        </div>
      </div>


      <div class="row bg-gray mt-5">
        <div class="col-md-12 py-2">
          สั่งยา
        </div>
      </div>
      <div class="" ng-app="drugSearch" ng-controller="myCtrl">
        <div class="row">
          <div class="col-md-6">

            <table class="table">
              <tr ng-repeat="drug in drugs">
                <td>ชื่อ - ยา</td>
                <td>วิธีใช้</td>
                <td>หน่วย</td>
                <td>ราคา</td>
                <td></td>
              </tr>
              <tr ng-repeat="drug in drugs|filter:search | limitTo : 3  ">
                <td>@{{ drug.name }}</td>
                <td>@{{ drug.description }}</td>
                <td>@{{ drug.unit }}</td>
                <td>@{{ drug.price }}</td>
                <td><a ng-click="add(drug.id)" class="btn btn-success"><i class="fa fa-plus"></i></a></td>
              </tr>
            </table>
          </div>
          <div class="col-md-6">
            <div class="row justify-content-end py-5 pr-5">
              <form action="" class="search-form">
                <div class="row form-group has-feedback" style="width:600px;">
                <label for="search" class="sr-only">Search</label>
                <input type="text" class="form-control w-100" name="search" id="search" placeholder="search" ng-model="search">
                  <span class="glyphicon glyphicon-search form-control-feedback"></span>
                </div>
              </form>
            </div>
          </div>
        </div>


          <div class="row">
            <table class="table">
              <tr>
                <td>ลำดับ</td>
                <td>ชื่อรายการตรวจ</td>
                <td>วิธีใช้</td>
                <td>จำนวน</td>
                <td>หน่วย</td>
                <td>ราคา</td>
                <td></td>
              </tr>
              <tr ng-repeat="drug in temp">
                <td>@{{ $i + 1}}</td>
                <td>@{{ drug.drug.name }}</td>
                <td>@{{ drug.drug.description }}</td>
                <td>@{{ drug.quantity }}</td>
                <td>@{{ drug.drug.unit }}</td>
                <td>@{{ drug.drug.price }}</td>
                <td>
                  <button type="button" name="button" ng-click="del(drug.drug.id)" class="btn btn-danger">ลบ</button>
                </td>
              </tr>
              <tr>
                <td colspan="5"></td>
                <td class="text-right">ราคารวม</td>
                <td class="text-right">@{{ subtotal }}</td>
              </tr>
              <tr>
                <td colspan="5"></td>
                <td class="text-right">Tax 7 %</td>
                <td class="text-right">@{{ tax }}</td>
              </tr>
              <tr>
                <td colspan="5"></td>
                <td class="text-right">รวมทั้งสิ้น</td>
                <td class="text-right">@{{ total }}</td>
              </tr>

            </table>
          </div>

          <div class="row justify-content-end pt-4 pr-5 pb-4">
            <a href="" class="btn btn-xs btn-danger mx-2">ยกเลิก</a>
            {{-- <a href="" class="btn btn-xs btn-success mx-2">ส่งตรวจ/ยา</a> --}}
            {!! Form::submit("ส่งตรวจ/ยา", ['class'=>'btn btn-xs btn-success mx-2']) !!}
            {!! Form::close() !!}
          </div>

        </div>


      </div>


        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.10/angular.min.js"></script>
        <script type="text/javascript">

          var app = angular.module('drugSearch',[]);
          app.controller('myCtrl',function ($scope,$http) {
            $scope.subtotal = 0;
            $scope.total = 0;
            $scope.tax = 0;
            $scope.temp = [];

            $scope.cal = function () {
              $scope.subtotal = 0;
              $scope.total = 0;
              $scope.tax = 0;

              $scope.temp.forEach(function (element) {
                $scope.subtotal += element.drug.price * element.quantity;
              });

              $scope.tax = $scope.subtotal * 0.07;
              $scope.total = $scope.subtotal + $scope.tax;
              $scope.tax = $scope.tax.toFixed(2);
              $scope.total = $scope.total.toFixed(2);
            };

            $scope.update = function () {
              $http.get('{{url('api/gettemp')}}')
              .then(function (response) {
                $scope.temp = response.data;
                $scope.cal();

              });
            };



            $scope.update();

            $scope.add = function (id) {
              var quantity = prompt('ใส่จำนวนที่ต้องการ ');
              $http.post('{{url('api/drugtemp')}}',{'id':id,'qty':quantity})
              .then(function (response) {
                $scope.update();
              });
            };

            $scope.del = function (id) {
              $http.delete('{{url('api/deltemp')}}/'+id)
              .then(function (response) {
                // console.log(response);
                $scope.update();
              });
            };

            $http.get('{{url('api/getdrug')}}')
            .then(function (response) {
              $scope.drugs = response.data;
            });
          });
        </script>
@endsection
