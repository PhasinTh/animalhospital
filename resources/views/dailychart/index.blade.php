@extends('layout.app')
@section('content')
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-10">
          <div id="chartContainer" style="height: 480px; width: 100%;" class="pt-3"></div>
        </div>
      </div>
    </div>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  <script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2",
	title:{
		text: "สถิติการรักษา"
	},
	legend:{
		cursor: "pointer",
		verticalAlign: "center",
		horizontalAlign: "right",
		itemclick: toggleDataSeries
	},
	data:
    <?php
        echo json_encode($data);
    ?>
});

chart.render();

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
