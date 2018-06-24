<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    @include('partials._style')
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <img src="{!! asset('images/default_logo.png') !!}" class="" alt="" style="width:150px;height:150px;">
      </div>
      <div class="row justify-content-center">
        <h3>ชื่อโรงพยาบาล</h3>
      </div>
      <div class="row justify-content-center mt-2">
        <div class="col-md-10 text-center address">
          <p>52/343 ม.7 ต.หลัก อ.เมืองปทุมธานี จ.ปทุมธานี 12000</p>
          <p>029353535</p>
        </div>
      </div>
    </div>

    <div class="container-fluid mt-5">
      <div class="row justify-content-center">
        <div class="col-10 text-center">
          <b>ใบเสร็จรับเงิน</b>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 py-3">
          <table class="table table-bordered">
            <tr>
              <td colspan="3">ชื่อเจ้าของ : {{$receipt->prescription->diagnose->register->pet->customer->name}}</td>
              <td>วันนัด:</td>
              <td style="width:20%; " colspan="2">
                @php
                  $dd = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$receipt->prescription->diagnose->appointment->date);
                  if($dd->format('H') > 0)
                    echo $dd->format('d/m/Y เวลา H:i น.');
                  else {
                    echo $dd->format('d/m/Y');
                  }
                @endphp</td>
            </tr>
            <tr>
              <td colspan="3">ชื่อสัตว์ : {{$receipt->prescription->diagnose->register->pet->name}}</td>
              <td>นัดเพื่อ:</td>
              <td colspan="2">{{$receipt->prescription->diagnose->appointment->detail}}</td>
            </tr>
            <tr>
              <td colspan="3"></td>
              <td>ผู้นัด:</td>
              <td colspan="2">{{$receipt->prescription->diagnose->appointment->employee->name}}</td>
            </tr>
            <tr>
              <td colspan="6"></td>
            </tr>
            <tr class="text-center">
              <td>ลำดับ</td>
              <td style="width:40%;">รายการ</td>
              <td>ราคา</td>
              <td>จำนวน</td>
              <td>หน่วย</td>
              <td>รวม</td>
            </tr>
            @foreach ($receipt->prescription->prescriptioneetail as $key => $value)
              <tr class="text-center">
                <td>{{ $key+1 }}</td>
                <td>{{ $value->drug->name }}</td>
                <td>{{ $value->drug->price }}</td>
                <td>{{ $value->quantity }}</td>
                <td>{{ $value->drug->unit }}</td>
                <td>{{ $value->drug->price * $value->quantity}}</td>
              </tr>
            @endforeach
            <tr class="text-right">
              <td colspan="4" rowspan="4"></td>
              <td>ราคารวม</td>
              <td>{{ $receipt->total }}</td>
            </tr>
            <tr class="text-right">
              {{-- <td colspan="3"></td> --}}
              <td>Tax 7%</td>
              <td>{{ $receipt->total*0.07 }}</td>
            </tr>
            <tr class="text-right">
              {{-- <td colspan="3"></td> --}}
              <td>รวมทั้งสิน</td>
              <td>{{ $receipt->total + ($receipt->total*0.07) }}</td>
            </tr>

          </table>
        </div>
      </div>

      <div class="container-fluid mt-5">
        <div class="row justify-content-center">
          <div class="col-md-5 text-center">
            <hr width="50%">
            ชำระโดย
          </div>
          <div class="col-md-5 text-center">
            <hr width="50%">
            ผู้รับเงิน
          </div>
        </div>
      </div>

    </div>
  </body>
</html>
