<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    {{-- <meta charset="utf-8"> --}}
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/master.css')}}">
  </head>
  <body>
    <style media="print">
      .btn{
        display: none;
      }
      .sidenav{
        display: none;
      }
    </style>
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

    <div class="container-fluid">
      <div class="row justify-content-end">
        <div class="col-3">
          <b>ใบนัดตรวจทั่วไป</b>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="col-md-10 border py-3 pl-5">
          <p>เลขที่นัดหมาย : <b>{{ $appointment->id }}</b></p>
          <p>สัตว์เลี้ยง: <b>{{ $appointment->diagnose->register->pet->name }}</b></p>
          <p>ชื่อเจ้าของ: <b>{{ $appointment->diagnose->register->pet->customer->name }}</b> เบอร์ติดต่อ: <b>{{ $appointment->diagnose->register->pet->customer->tel }}</b></p>
          <p>วันที่นัดหมาย:
            <b>
              @php
                $dd = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$appointment->date);
                if($dd->format('H') > 0)
                  echo $dd->format('d/m/Y เวลา H:i น.');
                else {
                  echo $dd->format('d/m/Y (ไม่ระบุเวลา)');
                }
              @endphp
            </b>
          </p>
          <p>พบสัตวแพทย์: <b>{{ $appointment->employee->name}}</b></p>
          <p>นัดเพื่อ : <b>{{ $appointment->detail }}</b></p>
        </div>
      </div>

      <div class="row mt-3 justify-content-center">
        <div class="col-md-10">
          <h3>ข้อแนะนำ</h3>
          <ul>
            <li>1</li>
            <li>2</li>
          </ul>
        </div>
      </div>
    </div>

    <div class="row justify-content-center">
      <button href="" class="btn btn-info" onclick="window.print()">พิมพ์เอกสาร</button>
    </div>
  </body>
</html>
