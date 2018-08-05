@extends('layout.app')
@section('content')
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
          <div id="chartDiary" style="height: 480px; width: 100%;" class="pt-3"></div>
        </div>
      </div>
      <div class="row justify-content-center mt-5">

        <div class="col-10">
          <div class="row justify-content-center">
            <h3 class="pr-2">สถิติย้อนหลัง</h3>
            <select class="target" >
              <option value="1" selected="selected">1</option>
              @for ($i=2; $i <= 12; $i++)
                <option value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
            <h3 class="pl-2">เดือน</h3>
          </div>
          <div id="chartContainer" style="height: 480px; width: 100%;" class=""></div>
        </div>
      </div>
    </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
var currentdate = new Date();
var today = currentdate.getDate()+"/"+(currentdate.getMonth()+1)+"/"+currentdate.getFullYear();
window.onload = function () {
  var data = [];

    function addData(data) {
      // console.log(data);
      if(data == []){
        data =   <?php
              echo json_encode($data);
          ?>;
      }

      var temp = new CanvasJS.Chart("chartContainer", {
      	animationEnabled: true,
      	theme: "light2",
      	legend:{
      		cursor: "pointer",
      		verticalAlign: "center",
      		horizontalAlign: "right",
      		itemclick: toggleDataSeries
      	},
      	data:data
      });
      temp.render();

    }

  $(".target" ).change(function() {
    var number = $( ".target option:selected" ).text();
    $.getJSON("{{url('api/getchart')}}/"+number, addData);
  });

var chart = new CanvasJS.Chart("chartDiary", {
  animationEnabled: true,
	title: {
		text: "สถิติประจำวันที่ "+today
	},
	data:
  <?php
      echo json_encode($data2);
  ?>
});

var chart2 = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data:<?php
          echo json_encode($data);
      ?>

});

chart.render();
chart2.render();

function toggleDataSeries(e){
	if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
		e.dataSeries.visible = false;
	}
	else{
		e.dataSeries.visible = true;
	}
	chart.render();
}

}


</script>

@endsection
