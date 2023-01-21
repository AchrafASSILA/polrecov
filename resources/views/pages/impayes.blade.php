@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Liste des impayés</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0"></span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
				<style>
					.dataTables_filter, .dataTables_info { display: none; }
					table.dataTable thead .sorting_desc::after , table.dataTable thead .sorting_asc::after{
						display: none
					}
					.first {
						width: 100%;
					}
					.ellipsis {
						position: relative;
						width: 70px;
					}
					.ellipsis:before {
						content: ' ';
						visibility: hidden;
					}
					.ellipsis span {
						position: absolute;
						left:0;
						text-align: left;
						padding-left: 10px;
						right: 0;
						white-space: nowrap;
						overflow: hidden;
						text-overflow: ellipsis;
					}
					.set-display{
						position: relative;
						white-space: nowrap;
						overflow: hidden;
						text-overflow: ellipsis;
						width: 60px;
						text-align: left;
					}
					.set-display span{
						/* display: inline-block; */
					}
					table.dataTable thead th[data-is-resizable=true] {
					border-left: 1px solid transparent;
					border-right: 1px dashed #bfbfbf;
					}
					table.dataTable thead th.dt-colresizable-hover {
					cursor: col-resize;
					background-color: #eaeaea;
					border-left: 1px solid #bfbfbf;
					}
					table.dataTable thead th.dt-colresizable-bound-min, 
					table.dataTable thead th.dt-colresizable-bound-max {
					opacity: 0.2;
					cursor: not-allowed !important;
					}
				</style>
				
@endsection
@section('content')

				@if (session()->has('success'))
					<div class="alert alert-success alert-dismissible fade show" role="alert">
						<strong>{{ session()->get('success') }}</strong>
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				@endif
				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif	
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								</div>
							<div style="text-align: right;margin-bottom: 10px;" class="card-body mb-20">
								<div style="display: flex;
								align-items: center;
								justify-content: center;margin-bottom: 10px;">
									
									<button class="btn btn-primary" style="margin-right: 10px;" id="show_all">Vue détaillée</button>
									<button class="btn btn-primary" style="margin-right: 10px;" id="hide_all">Vue condensée</button>
									<div class="form-group" style="margin-bottom: 0px;margin-right: 10px;" >
										<div class="dropdown">
											<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button">Champs<i class="fas fa-caret-down ml-1"></i></button>
											<div  class="dropdown-menu tx-13">
												<form class="dr" id="dr">


												<div class="form-control"  style="border: none">
													
													<input type="checkbox" name="cells" id="ex" value="1">
													
													<label for="ex">Exercice</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="qu" value="2">
													<label for="qu">Quittance</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="ci" value="3">
													<label for="ci">Cie</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="sou" value="4">
													<label for="sou">Souscripteur</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="br" value="5">
													<label for="br">Branche</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="ca" value="6">
													<label for="ca">Categorie</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="ri" value="7">
													<label for="ri">Risque</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="po" value="8">
													<label for="po">Police</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="du" value="9">
													<label for="du">Du</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="au" value="10">
													<label for="au">Au</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="pr" value="11">
													<label for="pr">Prime</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="mt" value="12">
													<label for="mt">Mt Encaiss</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="re" value="13">
													<label for="re">Ref Encaiss</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="ap" value="14">
													<label for="ap">Aperiteur</label>
												</div>
											</form>
											
											</div>
										</div>
									</div>
									<button class="btn btn-primary" style="margin-right: 10px;" id="reset">Reset</button>
								</div>
								<div class="table-responsive">
									<div class="mb-4" >
											
										<div class="form-group" style="width: 100%;text-align: left;">
											<label style="width: 100%;text-align: left;" >Souscripteur Nom :</label>
											<input type="text" aria-controls="example1" class="form-control" style="width: 50%;border-bottom: none" id="sub" placeholder="Name">
											<select  name="impayes" size="5" id="impayes" style="width:50%;border-top: none;" class="form-control">
												
											</select>
										</div>
										<div class="form-group"  style="width: 100%;text-align: left;">
											<label style="width: 100%;text-align: left;" for="subscribers">Groupement</label>
											<select name="subscribers" disabled  id="subscribers" style="width:50%" class="form-control select2">
												<p class="mg-b-10">Subscribers</p>
											</select>
										</div>
									</div>
									
									<table style="table-layout: fixed;
									word-wrap: break-word;width: 100%;" class="table text-md-nowrap table-striped" id="example1">
										<thead>
											<tr>
												<th  class="set-display" style="width: 13px;text-align:left;padding-left: 10px;padding-right: 0px;background:#FFF"   class=" border-bottom-0"><span> <input onClick="toggle(this)"   type="checkbox" name="" style="width:13px" id="all"></span></th>
												<th   class="set-display  border-bottom-0"><span> Exercice</span></th>
												<th   class= "set-display border-bottom-0"><span> N*Quittance</span></th>
												<th    class="set-display  border-bottom-0"><span> Cie</span></th>
												<th   class="set-display border-bottom-0"><span> Souscripteur</span></th>
												<th   class="set-display border-bottom-0"><span> Branche</span></th>
												<th   class="set-display border-bottom-0"><span> Categorie</span></th>
												<th   class="set-display border-bottom-0"><span> Risque</span></th>
												<th   class="set-display border-bottom-0"><span> Police</span></th>
												<th   class="set-display border-bottom-0"><span> Du</span></th>
												<th   class="set-display border-bottom-0"><span> Au</span></th>
												<th   class="set-display border-bottom-0" style="display: none"><span> Prime Order</span></th>
												<th   class="set-display border-bottom-0" ><span> Prime</span></th>
												<th   class="set-display border-bottom-0"><span> Mt Encaiss</span></th>
												<th   class="set-display border-bottom-0"><span> Ref Encaiss</span></th>
												<th   class="set-display border-bottom-0"><span> Aperiteur</span></th>
												</thead>
										<tbody id="tbImpayes">
											@foreach ($impayes as $impaye)
											<tr>
                                                <td  style="text-align: left;background:none ; vertical-align: middle;text-align: initial;" ><input  type="checkbox"  name="quitance_id" value="{{$impaye->quitance}}/{{$impaye->souscripteur}}"></td>
												<td  class="ellipsis"  ><span>{{$impaye->exercice}}</span></td>
												<td  class="ellipsis"  ><span>{{$impaye->quitance}}</span></td>
												<td  class="ellipsis"  ><span>{{$impaye->cie}}</span></td>
												<td  class="ellipsis"  title="{{$impaye->souscripteur}}" ><span>{{$impaye->souscripteur}}</span></td>
												<td  class="ellipsis"  ><span> {{$impaye->branche}}</span></td>
												<td  class="ellipsis"  ><span> {{$impaye->categorie}}</span></td>
												<td  class="ellipsis" ><span>{{$impaye->risque}}</span></td>
												<td  class="ellipsis"  ><span>{{$impaye->police}}</span></td>
												<td  class="ellipsis"  ><span>{{date('d/m/Y', strtotime( $impaye->du))}}</span></td>
												<td  class="ellipsis" ><span>{{date('d/m/Y', strtotime($impaye->au))}}</span></td>
												<td  class="ellipsis"  style="display: none" ><span style="text-align: right"> {{$impaye->prime_total}}</span></td>
												<td  class="ellipsis"  ><span style="text-align: right"> {{(number_format($impaye->prime_total, 2,'.', ' '))}}</span></td>
												<td  class="ellipsis" ><span>{{$impaye->mtt_ancaiss}}</span></td>
												<td  class="ellipsis"  ><span>{{$impaye->ref_encaiss}}</span></td>
												<td  class="ellipsis" ><span> {{$impaye->aperiteur}}</span></td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
									<div style="margin-bottom: 5px;text-align: left">

										<button  class="btn btn-primary" type="button" style="text-align: center" id="generate" >Ajouter a l'etat</button>
									</div>
								</div>
							</div>
						</div>
						<style>
							tr:nth-child(even) {background: rgb(255, 0, 0)}
							tr:nth-child(odd) {background: #FFF}
						</style>
						<form style="width: 100%;margin-bottom: 10px;display: flex;
						flex-direction: column;padding: 10px;
    border-radius: 5px;background: white;" class="data"  action="{{route('impayes.store')}}" method="POST" >
							@csrf
							
							<div id="data" style="display: flex;
							flex-direction: column-reverse;">

								<button  style="width: fit-content;margin:auto" class="btn btn-primary" disabled id="generate_btn" type="submit">Générer</button>
							</div>
								
						</form>
					</div>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
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




{{-- app js file  --}}
<script src="{{URL::asset('assets/js/app.js')}}"></script>
<script src="{{URL::asset('assets/js/resize.js')}}"></script>



<script>

	
	// $(document).ready(function () {
	// 	$('#example').dataTable({
	// 	"columnDefs": [
	// 		{ 
	// 			targets: 11 , 
	// 			"type": "sType",
	// 		}
	// 	]
	// 	});
    $("#sub").on("input", function () {
        var search = $(this).val();
        if (search == "") {
		$('select[name="impayes"]').empty();
		$('select[name="subscribers"]').empty();
		$('#subscribers').prop("disabled", true);
		$("#example1").DataTable().search("").draw();
        } else {
            let parent = search;
            if (search) {
                $.ajax({
                    url: "{{ URL::to('admin/get-names') }}/" + parent,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="impayes"]').empty();
                        
                        $.each(data, function (key, value) {
                            $('select[name="impayes"]').append(
                                '<option value="' +
                                    value +
                                    '">' +
                                    value +
                                    "</option>"
                            );
                        });
                    },
                });
            } else {
                console.log("AJAX load did not work here");
            }
        }
    });
	$('#impayes').on('change',function(){

	
    var search = $(this).val();
    if (search) {
		$('#subscribers').prop("disabled", false);
        $.ajax({
            url: "{{ URL::to('admin/subscribers') }}/" + search,
            type: "GET",
            dataType: "json",
            success: function (data) {
                $('select[name="subscribers"]').empty();
                $('select[name="subscribers"]').append(
                    '<option value="' + search + '">Choisir Le Pere</option>'
                );
                $.each(data, function (key, value) {
                    $('select[name="subscribers"]').append(
                        '<option value="' + value + '">' + value + "</option>"
                    );
                });
            },
        });
    } else {
		$('#subscribers').prop("disabled", true);
        console.log("AJAX load did not work");
    }
});

</script>
@endsection
