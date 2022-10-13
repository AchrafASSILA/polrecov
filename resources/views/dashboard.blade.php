@extends('layouts.master')
@section('css')
<!--  Owl-carousel css-->
<link href="{{URL::asset('assets/plugins/owl-carousel/owl.carousel.css')}}" rel="stylesheet" />
<!-- Maps css -->
<link href="{{URL::asset('assets/plugins/jqvmap/jqvmap.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="left-content">
						<div>
						  <h2 class="main-content-title tx-24 mg-b-1 mg-b-lg-1">Dashboard \ Statistics
							</h2>
						</div>
					</div>
					
				</div>
				<!-- /breadcrumb -->
@endsection
@section('content')
{{-- select count(impayes.id) as "total_count" , subscribers.raisonsociale from impayes INNER JOIN subscribers on subscribers.raisonsociale = impayes.souscripteur GROUP BY subscribers.raisonsociale ORDER BY total_count DESC LIMIT 10; --}}
{{-- select sum(impayes.prime_total) as "total_prime" , subscribers.raisonsociale from impayes INNER JOIN subscribers on subscribers.raisonsociale = impayes.souscripteur GROUP BY subscribers.raisonsociale ORDER BY total_prime DESC LIMIT 10; --}}
      @php
				$data = \App\Models\Impayes\Impayes::select('branche', \DB::raw('count(*) as impayes_total'))
				->groupBy('branche')
				->get();
				$data_values ="";
				$values = [];
				foreach ($data as $dt) {
					$data_values .= '["' . $dt->branche .'",   '.$dt->impayes_total.'],';
				}
				$chart_data = $data_values;
       
       
        $data_1 = \DB::select('select sum(impayes.prime_total) as "total_prime" , subscribers.raisonsociale from impayes INNER JOIN subscribers on subscribers.raisonsociale = impayes.souscripteur GROUP BY subscribers.raisonsociale ORDER BY total_prime DESC LIMIT 10;');
        $values_1 = [];
        $data_values_1 =''; 
        foreach ($data_1 as $dt) {
					$data_values_1 .= '["' . $dt->raisonsociale  .'",   '.$dt->total_prime.'],';
				}
				$chart_data_1 = $data_values_1;
				@endphp
				<!-- row -->
				<div id="piechart" style="width: 100%; height: 500px;display:block"></div><br><br>
        <div id="top_x_div" style="width: 100%; height: 500px"></div><br><br>	
      </div>
		<!-- Container closed -->
@endsection
@section('js')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);
	function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php echo $data_values; ?>
        ]);
        var options = {
          title: ''
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      };
		
      
</script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Opening Move', 'Percentage'],
          <?php echo $data_values_1; ?>
        ]);

        var options = {
          // title: 'Chess opening moves',
          // width: 900,
          legend: { position: 'none' },
          chart: { title: '',
                   subtitle: '' },
          bars: 'vertical', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div'));
        chart.draw(data, options);
      };
    </script>
@endsection