@extends('layout.app')

@section('content')
    {!! Form::open(['route'=>['receipt.store']]) !!}
    {!! Form::hidden('prescription_id', $prescription->id, []) !!}

    <div class="card mb-3">
      <div class="card-header">
         ตรวจสัตว์เลี้ยง
      </div>
      <div class="card-body">
        <div class="row pt-3">
          <div class="col-md-8">
            <div class="row ">
              <div class="col-md-2 text-right">
                เจ้าของ
              </div>
              <div class="col-md-10">
                <p>ชื่อ : {{ $prescription->diagnose->register->pet->customer->name }}</p>
                <p>เบอร์โทรศัพท์ : {{ $prescription->diagnose->register->pet->customer->tel }}</p>
              </div>
            </div>

            <div class="row ">
              <div class="col-md-2 text-right">
                สัตว์เลี้ยง
              </div>
              <div class="col-md-3">
                <p>ชื่อ : {{ $prescription->diagnose->register->pet->name }}  เพศ: {{ $prescription->diagnose->register->pet->sex }} </p>
                <p>พันธุ์ : {{ $prescription->diagnose->register->pet->speies }}</p>
              </div>

              <div class="col-md-3">
                <p>อายุ :  {{ $prescription->diagnose->register->pet->age }}</p>
                <p>ตำหนิ : {{ $prescription->diagnose->register->pet->scar }} แพ้ยา : {{ $prescription->diagnose->register->pet->allergy }}</p>
              </div>
            </div>

          </div>
          <div class="col-md-4">

          </div>
        </div>
      </div>
    </div>

    <div class="card mb-3">
      <div class="card-header">
         สั่งยา
      </div>
      <div class="card-body">
        <div class="" ng-app="drugSearch" ng-controller="myCtrl">
            <div class="row">
              <table class="table table-bordered">
                <tr>
                  <td>ลำดับ</td>
                  <td>ชื่อรายการตรวจ</td>
                  <td>วิธีใช้</td>
                  <td>จำนวน</td>
                  <td>หน่วย</td>
                  <td>ราคา</td>
                </tr>
                  @foreach ($prescription->prescriptioneetail as $index =>$prescriptionc)
                  <tr>
                    <td>{{ ++$index }}</td>
                    <td>{{ $prescriptionc->drug->name }}</td>
                    <td>{{ $prescriptionc->drug->description  }}</td>
                    <td>{{ $prescriptionc->quantity }}</td>
                    <td>{{ $prescriptionc->drug->unit }}</td>
                    <td>{{ $prescriptionc->drug->price }}</td>
                  </tr>
                  @endforeach
                <tr>
                  <td colspan="4" rowspan="3"></td>
                  <td class="text-center">ราคารวม</td>
                  <td >{{ $total }}</td>
                </tr>
                <tr>
                  <td  class="text-center">Tax 7 %</td>
                  <td >{{ number_format(( $total )*0.07,2) }}</td>
                </tr>
                <tr>
                  <td  class="text-center">รวมทั้งสิ้น</td>
                  <td >{{ number_format($total + ($total*0.07),2) }}</td>
                </tr>

              </table>
            </div>

            <div class="row justify-content-end pt-4 pr-5 pb-4">
              @if ($prescription->status == "สำเร็จ")
                @if ($prescription->recript)
                  <a href="{{ route('receipt.show', $prescription->recript->id ) }}" class="btn btn-xs btn-success mx-2">ดูรายละเอียด</a>
                @endif
              @else
              {{-- <a href="" class="btn btn-xs btn-danger mx-2">ยกเลิก</a> --}}
              {{-- <a href="" class="btn btn-xs btn-success mx-2">ส่งตรวจ/ยา</a> --}}
              {!! Form::submit("ส่งห้องการเงิน", ['class'=>'btn btn-xs btn-success mx-2']) !!}
              {!! Form::close() !!}
              @endif
            </div>
          </div>
      </div>
    </div>






@endsection
