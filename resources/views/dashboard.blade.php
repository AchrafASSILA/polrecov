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
{{-- SELECT SUM(impayes.prime_total) ptt FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 3 MONTH); --}}

    @php
				$data = \DB::select("select count(*) as impayes_total , SUM(impayes.prime_total) prime_tot , impayes.branche  FROM impayes 
                where impayes.branche = 'D.I.M' 
                or impayes.branche = 'accidents de travail' 
                or impayes.branche = 'AUTO CYCLO' 
                or impayes.branche = 'AUTO FLOTTE'
                or impayes.branche = 'AUTO PARTICULIERS'
                or impayes.branche = 'AUTO SOCIETES'
                or impayes.branche = 'AUTO SOCIETES'
                or impayes.branche = 'CARTE VERTE AUTO' 
                or impayes.branche = 'A.M.C' 
                or impayes.branche = 'MULTIRISQUE HABITATIONS' 
                or impayes.branche = 'ASSISTANCE ETUDIANT À L\'ETRANGER'
                or impayes.branche = 'ASSISTANCE SCOLAIRE' GROUP BY impayes.branche  ORDER BY prime_tot DESC;") ;
				// dd ($data[3]);
                $data_values ="";
				$values = [];
				foreach ($data as $dt) {
          // $num = number_format($dt->prime_tot, 2,'.', ' ');
					$data_values .= '["' . $dt->branche .'",' . $dt->prime_tot .'],';
				}
				$chart_data = $data_values;
       
       
        $data_1 = \DB::select('select sum(impayes.prime_total) as "total_prime" , subscribers.raisonsociale from impayes INNER JOIN subscribers on subscribers.raisonsociale = impayes.souscripteur GROUP BY subscribers.raisonsociale ORDER BY total_prime DESC LIMIT 10;');
        $values_1 = [];
        $data_values_1 =''; 
        foreach (array_reverse( $data_1) as $dt) {
					$data_values_1 .= '["' . $dt->raisonsociale  .'",   '.$dt->total_prime.'],';
				}
				$chart_data_1 = $data_values_1;
        $last_month = \DB::select('select SUM(impayes.prime_total) ptt , "month 1" as "m1" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 1 MONTH);');
        $last_two_month = \DB::select('select SUM(impayes.prime_total) ptt , "month 2" as "m2" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 2 MONTH);');
        $last_three_month = \DB::select('select SUM(impayes.prime_total) ptt , "month 3" as "m3" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 3 MONTH);');
        $last_six_month = \DB::select('select SUM(impayes.prime_total) ptt , "month 6" as "m6" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 6 MONTH);');
        $last_nine_month = \DB::select('select SUM(impayes.prime_total) ptt , "month 9" as "m9" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 9 MONTH);');
        $last_twelve_month = \DB::select('select SUM(impayes.prime_total) ptt , "month 12" as "m12" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 12 MONTH);');
				$data_3 ='["' . $last_month[0]->m1 .'",   '.$last_month[0]->ptt.'],';
				$data_3 .='["' . $last_two_month[0]->m2 .'",   '.$last_two_month[0]->ptt.'],';
				$data_3 .='["' . $last_three_month[0]->m3 .'",   '.$last_three_month[0]->ptt.'],';
				$data_3 .='["' . $last_six_month[0]->m6 .'",   '.$last_six_month[0]->ptt.'],';
				$data_3 .='["' . $last_nine_month[0]->m9 .'",   '.$last_nine_month[0]->ptt.'],';
				$data_3 .='["' . $last_twelve_month[0]->m12 .'",   '.$last_twelve_month[0]->ptt.'],';
        // dd($data_3)
        @endphp
				<!-- row -->
        <div style="display: flex;justify-content:space-around">

          <div id="piechart" style="width: 48%; height: 500px;margin-rigth:10px"></div>
          <div id="top_x_div" style="width: 48%; height: 500px"></div>	
        </div><br><br>
        <div id="top_x_div_" style="width: 100%; height: 500px"></div>	
      </div>
      {{-- <button id="hide" onclick="hideMe()">hide</button> --}}
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
          title: '',
          sliceVisibilityThreshold: 0

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
          bars: 'horizontal', // Required for Material Bar Charts.
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
   <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawStuff);

      function drawStuff() {
        var data = new google.visualization.arrayToDataTable([
          ['Opening Move', 'Percentage'],
          <?php echo $data_3; ?>
        ]);

        var options = {
          // title: 'Chess opening moves',
          // width: 900,
          legend: { position: 'none' },
          chart: { title: '',
                   subtitle: '' },
          bars: 'horizontal', // Required for Material Bar Charts.
          axes: {
            x: {
              0: { side: 'top', label: 'Percentage'} // Top x-axis.
            }
          },
          bar: { groupWidth: "90%" }
        };

        var chart = new google.charts.Bar(document.getElementById('top_x_div_'));
        chart.draw(data, options);
      };
    </script>

   
@endsection