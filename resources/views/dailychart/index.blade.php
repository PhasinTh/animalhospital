@extends('layout.app')
@section('content')
  <?php
    $dataPoints1 = array(
    	array("label"=> "มกราคม", "y"=> 36.12),
    	array("label"=> "กุมภาพันธ์", "y"=> 34.87),
    	array("label"=> "มีนาคม", "y"=> 40.30),
    	array("label"=> "เมษายน", "y"=> 35.30),
    	array("label"=> "มกราคม", "y"=> 39.50),
    	array("label"=> "มกราคม", "y"=> 50.82),
    	array("label"=> "มกราคม", "y"=> 74.70)
    );
    $dataPoints2 = array(
    	array("label"=> "มกราคม", "y"=> 64.61),
    	array("label"=> "กุมภาพันธ์", "y"=> 70.55),
    	array("label"=> "มีนาคม", "y"=> 72.50),
    	array("label"=> "เมษายน", "y"=> 81.30),
    	array("label"=> "มกราคม", "y"=> 63.60),
    	array("label"=> "มกราคม", "y"=> 69.38),
    	array("label"=> "มกราคม", "y"=> 105.0)
    );
    ?>
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

  // TODO: fetch data
  // $dataPoints1 = array(
  //   array("label"=> "มกราคม", "y"=> 36.12),
  //   array("label"=> "กุมภาพันธ์", "y"=> 34.87),
  //   array("label"=> "มีนาคม", "y"=> 40.30),
  //   array("label"=> "เมษายน", "y"=> 35.30),
  //   array("label"=> "มกราคม", "y"=> 39.50),
  //   array("label"=> "มกราคม", "y"=> 50.82),
  //   array("label"=> "มกราคม", "y"=> 74.70)
  // );
	data:
  //   {
	// 	type: "column",
	// 	name: "หมา",
	// 	indexLabel: "{y}",
	// 	yValueFormatString: "#0",
	// 	showInLegend: true,
	// 	dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
	// },{
	// 	type: "column",
	// 	name: "แมว",
	// 	indexLabel: "{y}",
	// 	yValueFormatString: "#0",
	// 	showInLegend: true,
	// 	dataPoints: <?php echo json_encode($dataPoints2, JSON_NUMERIC_CHECK); ?>
	// }

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
