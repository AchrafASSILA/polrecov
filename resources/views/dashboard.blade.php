@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">

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
        $last_month = \DB::select('select COUNT(impayes.id) "countImpayes" , SUM(impayes.prime_total) ptt , "month 1" as "m1" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 1 MONTH);');
        $last_two_month = \DB::select('select COUNT(impayes.id) "countImpayes" , SUM(impayes.prime_total) ptt , "month 2" as "m2" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 2 MONTH);');
        $last_three_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 3" as "m3" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 3 MONTH);');
        $last_fourth_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 4" as "m4" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 4 MONTH);');
        $last_five_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 5" as "m5" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 5 MONTH);');
        $last_six_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 6" as "m6" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 6 MONTH);');
        $last_seven_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 7" as "m7" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 7 MONTH);');
        $last_eigth_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 8" as "m8" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 8 MONTH);');
        $last_nine_month = \DB::select('select  COUNT(impayes.id) "countImpayes" , SUM(impayes.prime_total) ptt , "month 9" as "m9" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 9 MONTH);');
        $last_ten_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 10" as "m10" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 10 MONTH);');
        $last_eleven_month = \DB::select('select COUNT(impayes.id) "countImpayes" ,  SUM(impayes.prime_total) ptt , "month 11" as "m11" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 11 MONTH);');
        $last_twelve_month = \DB::select('select  COUNT(impayes.id) "countImpayes" , SUM(impayes.prime_total) ptt , "month 12" as "m12" FROM impayes WHERE month(impayes.du) = month(NOW() - INTERVAL 12 MONTH);');
			
        @endphp
				<!-- row -->
        <div style="display: flex;justify-content:space-around">

          <div id="piechart" style="width: 48%; height: 500px;margin-rigth:10px"></div>
          <div id="top_x_div" style="width: 48%; height: 500px"></div>	
        </div><br><br>	
      </div>
      {{-- <button id="hide" onclick="hideMe()">hide</button> --}}
		<!-- Container closed -->
    <!-- row -->
<div class="row" id="tw" >
	<div  style="    margin: 10px auto;
  width: 97% !important;">
		<div class="card" id="basic-alert">
			<div class="card-body">
							
							
							<div class="text-wrap" >
								{{-- <div class="example"> --}}
									<div class="panel panel-primary tabs-style-1">
										<div class=" tab-menu-heading">
											<div class="tabs-menu1">
												<!-- Tabs -->
												<ul class="nav panel-tabs main-nav-line">
													<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">1 mois</a></li>
													<li class="nav-item"><a href="#tab2" id="tabF" class="nav-link" data-toggle="tab">2 mois</a></li>
													<li class="nav-item"><a href="#tab3" id="tabF" class="nav-link" data-toggle="tab">3 mois</a></li>
													<li class="nav-item"><a href="#tab6" id="tabF" class="nav-link" data-toggle="tab">6 mois</a></li>
													<li class="nav-item"><a href="#tab9" id="tabF" class="nav-link" data-toggle="tab">9 mois</a></li>
													<li class="nav-item"><a href="#tab12" id="tabF" class="nav-link" data-toggle="tab">1 année</a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
											<div class="tab-content">
                          <div class="tab-pane active" id="tab1">
                              
                            <div style="text-align: center;">
                              <h5>Cumul des primes non encaissées sur le dernier mois</h3> <br>
                              <span style="    padding: 10px 15px;
                                border: 1px solid navy;
                                border-radius: 5px;    display: block;
                                width: fit-content;
                                margin: auto;">
                                
                                {{(number_format($last_month[0]->ptt, 2,'.', ' ')) }} DH</span> <br>
                                                          <h5>Nombre des primes non encaissées sur le dernier mois</h5> <br>
                                                          <span style="    padding: 10px 15px;
                                border: 1px solid navy;
                                border-radius: 5px;    display: block;
                                width: fit-content;
                                margin: auto;">{{$last_month[0]->countImpayes}}</span> <br>
                            </div>
                        </div>
                        <div class="tab-pane" id="tab2">
                          <div style="text-align: center;">
                            <h5>Cumul des primes non encaissées sur les 2 derniers mois</h3> <br>
                                                    <span style="    padding: 10px 15px;
                          border: 1px solid navy;
                          border-radius: 5px;    display: block;
                          width: fit-content;
                          margin: auto;">{{(number_format($last_two_month[0]->ptt + $last_month[0]->ptt , 2,'.', ' ')) }} DH</span> <br>
                                                    <h5>Nombre des primes non encaissées sur les 2 derniers mois</h5> <br>
                                                    <span style="    padding: 10px 15px;
                          border: 1px solid navy;
                          border-radius: 5px;    display: block;
                          width: fit-content;
                          margin: auto;">{{$last_two_month[0]->countImpayes + $last_month[0]->countImpayes}}</span> <br>
                                                  </div>
                        </div>
                        <div class="tab-pane" id="tab3">
                          <div style="text-align: center;">
                            <h5>Cumul des primes non encaissées sur les 3 derniers mois</h3> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{(number_format($last_three_month[0]->ptt + $last_two_month[0]->ptt + $last_month[0]->ptt, 2,'.', ' ')) }} DH</span> <br>
                            <h5>Nombre des primes non encaissées sur les 3 derniers mois</h5> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{$last_three_month[0]->countImpayes + $last_two_month[0]->countImpayes + $last_month[0]->countImpayes}}</span> <br>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab6">
                          <div style="text-align: center;">
                            <h5>Cumul des primes non encaissées sur les 6 derniers mois</h3> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{(number_format($last_six_month[0]->ptt + $last_three_month[0]->ptt + $last_two_month[0]->ptt + $last_month[0]->ptt + $last_fourth_month[0]->ptt + $last_five_month[0]->ptt , 2,'.', ' ')) }} DH</span> <br>
                            <h5>Nombre des primes non encaissées sur les 6 derniers mois</h5> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">
{{$last_six_month[0]->countImpayes + $last_three_month[0]->countImpayes + $last_two_month[0]->countImpayes + $last_month[0]->countImpayes + $last_fourth_month[0]->countImpayes + $last_five_month[0]->countImpayes}}</span> <br>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab9">
                          <div style="text-align: center;">
                            <h5>Cumul des primes non encaissées sur les 9 derniers mois</h3> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{(number_format($last_nine_month[0]->ptt + $last_six_month[0]->ptt + $last_three_month[0]->ptt + $last_two_month[0]->ptt + $last_month[0]->ptt + $last_fourth_month[0]->ptt + $last_five_month[0]->ptt + $last_eigth_month[0]->ptt + $last_seven_month[0]->ptt, 2,'.', ' ')) }} DH</span> <br>
                            <h5>Nombre des primes non encaissées sur les 9 derniers mois</h5> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{$last_nine_month[0]->countImpayes + $last_six_month[0]->countImpayes + $last_three_month[0]->countImpayes + $last_two_month[0]->countImpayes + $last_month[0]->countImpayes + $last_fourth_month[0]->countImpayes + $last_five_month[0]->countImpayes + $last_eigth_month[0]->countImpayes + $last_seven_month[0]->countImpayes}}</span> <br>
                          </div>
                        </div>
                        <div class="tab-pane" id="tab12">
                          <div style="text-align: center;">
                            <h5>Cumul des primes non encaissées sur les 12 derniers mois</h3> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{(number_format($last_twelve_month[0]->ptt + $last_nine_month[0]->ptt + $last_six_month[0]->ptt + $last_three_month[0]->ptt + $last_two_month[0]->ptt + $last_month[0]->ptt + $last_fourth_month[0]->ptt + $last_five_month[0]->ptt + $last_eigth_month[0]->ptt + $last_seven_month[0]->ptt + $last_eleven_month[0]->ptt + $last_ten_month[0]->ptt , 2,'.', ' ')) }} DH</span> <br>
                            <h5>Nombre des primes non encaissées sur les 12 derniers mois</h5> <br>
                            <span style="    padding: 10px 15px;
  border: 1px solid navy;
  border-radius: 5px;    display: block;
  width: fit-content;
  margin: auto;">{{$last_twelve_month[0]->countImpayes + $last_nine_month[0]->countImpayes + $last_six_month[0]->countImpayes + $last_three_month[0]->countImpayes + $last_two_month[0]->countImpayes + $last_month[0]->countImpayes + $last_fourth_month[0]->countImpayes + $last_five_month[0]->countImpayes + $last_eigth_month[0]->countImpayes + $last_seven_month[0]->countImpayes + $last_eleven_month[0]->countImpayes + $last_ten_month[0]->countImpayes}}</span> <br>
                          </div>
                        </div>
										</div>
												
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
							</div></div></div></div></div> 
		<!-- main-content closed -->
@endsection
@section('js')
 <!-- Internal Data tables -->
 <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
 
 <script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
 
 
 <!--Internal  Datatable js -->
 <script src="{{URL::asset('assets/js/table-data.js')}}"></script>
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
   
@endsection