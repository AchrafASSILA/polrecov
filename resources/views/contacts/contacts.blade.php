@extends('layouts.master')
@section('css')
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">

<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Les Clients</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Les Clients Avec Ses Groups</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
				<style>
					/* .dataTables_filter, .dataTables_info { display: none; } */
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
				<!-- row -->
				<div class="row">
                    <div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">Les Contacts Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								</div>
							<div class="card-body">
								<div class="table-responsive">
									<div class="mb-4" >
										<div class="form-group" style="width: 100%;
										display: flex;">
											<input type="text" aria-controls="example1" class="form-control" style="width: 50%" id="sub" placeholder="Name">
											<button class="btn btn-primary" style="margin-left: 5px" id="reset">Reset</button>
										</div>
									</div>
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">Raisonsociale</th>
												<th class="wd-15p border-bottom-0">ste_part</th>
												<th class="wd-15p border-bottom-0">Responsable</th>
												<th class="wd-15p border-bottom-0">Telephone</th>
												<th class="wd-15p border-bottom-0">EmaiL</th>
												</thead>
										<tbody id="tbImpayes">
											@foreach ($contacts as $contact)
											<tr>
                                                <td style="    cursor: pointer;
												color: #2196f3;" rais={{$contact->id}}>{{$contact->raisonsociale}}</td>
												<td style={{$contact->ste_part === 1 ? "color:green" : "color:red"}}>{{ $contact->ste_part === 1 ? "oui" : "non"}}</td>
												<td>{{$contact->responsable}}</td>
												<td>{{$contact->telephone}}</td>
												<td>{{$contact->email}}</td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div></div>	
									<style>
										tr:nth-child(even) {background: #ecf0fa !important}
										tr:nth-child(odd) {background: #FFF}
										table.dataTable tbody td.sorting_1{
											background: none;
										}
										table.dataTable thead .sorting_asc, table.dataTable thead .sorting_desc{
											background: none;
										}
									</style>
<!-- row closed -->
<!-- row -->
<div class="row" id="tw" style="display: none">
	<div class="col-lg-12 col-md-12">
		<div class="card" id="basic-alert">
			<div class="card-body">
							
							
							<div class="text-wrap" >
								{{-- <div class="example"> --}}
									<div class="panel panel-primary tabs-style-1">
										<div class=" tab-menu-heading">
											<div class="tabs-menu1">
												<!-- Tabs -->
												<ul class="nav panel-tabs main-nav-line">
													<li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">Contact Principale</a></li>
													<li class="nav-item"><a href="#tab3" id="tabF" class="nav-link" data-toggle="tab">Groupement</a></li>
												</ul>
											</div>
										</div>
										<div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
											<div class="tab-content">
												<div class="tab-pane active" id="tab1">
													<div class="table-responsive">
														<table id="example2" class="table key-buttons text-md-nowrap" style="width: 100%">
															<thead>
																<tr>
																	<th class="wd-15p border-bottom-0">Raisonsociale</th>
																	<th class="wd-15p border-bottom-0">ste_part</th>
																	<th class="wd-15p border-bottom-0">Responsable</th>
																	<th class="wd-15p border-bottom-0">Telephone</th>
																	<th class="wd-15p border-bottom-0">EmaiL</th>
																	</thead>
															<tbody id="cntS">
																<tr>
																	
																</tr>
															</tbody>
														</table>

											</div>
										</div>
												
												<div class="tab-pane" id="tab3">
													<div class="table-responsive">
														
														<table id="example1" class="table key-buttons text-md-nowrap">
															
														<thead>
															<tr>
																<th class="wd-15p border-bottom-0">Raisonsociale</th>
																<th class="wd-15p border-bottom-0">ste_part</th>
																<th class="wd-15p border-bottom-0">Responsable</th>
																<th class="wd-15p border-bottom-0">Telephone</th>
																<th class="wd-15p border-bottom-0">EmaiL</th>
																</thead>
														<tbody id="cntF">
															<tr>
																
															</tr>
														</tbody>

														</table>
														<style>
															tr:nth-child(even) {background-color: rgb(255, 0, 0)}
															tr:nth-child(odd) {background-color: #FFF}
														</style>
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
 <script>
	 $("#sub").keyup(function () {
		 $("#example1").DataTable().column(0).search($(this).val()).draw();
		 $('#tw').hide();
		});
	$("#tbImpayes tr td").click(function(e){     //function_td
	var search  = ($(this).attr('rais'));
	$.ajax({
		url: "{{ URL::to('admin/contacts/') }}/" + search,
		type: "GET",
		dataType: "json",
		success: function (data) {
				$('#tw').show();
                $('#cntS').empty();
				// console.log(data);
                    $('#cntS').append(
                        `<tr >
							<td>  ${data[0].raisonsociale !== null ?  data[0].raisonsociale: " " }  </td>
							<td style=${data[0].ste_part === 1 ? "color:green" : "color:red"}>  ${data[0].ste_part === 1 ? "oui" : "non"}  </td>
							<td>  ${data[0].responsable !== null ?  data[0].responsable : " " }  </td>
							<td>  ${data[0].telephone !== null ?  data[0].telephone : " " }  </td>
							<td>  ${data[0].email !== null ?  data[0].email : " "}  </td>
							</tr>`
							);
							if(data[0].id ){
								console.log(data);
								$('#tabF').css('pointer-events','');
								$('#tabF').css('opacity','1');
								$('#tabF').css('cursor','pointer');
								$('#cntF').empty();
								if(data[1] != null ){
									
									$('#cntF').append(
										`<tr >
									<td>  ${data[1].raisonsociale !== null ?  data[1].raisonsociale: " " }  </td>
									<td style=${data[1].ste_part === 1 ? "color:green" : "color:red"}>  ${data[1].ste_part === 1 ? "oui" : "non"}  </td>
									<td>  ${data[1].responsable !== null ?   data[1].responsable : " "}  </td>
									<td>  ${data[1].telephone !== null ?  data[1].telephone : " " }  </td>
									<td>  ${data[1].email !== null ?  data[1].email : " " }  </td>
									</tr>`
								);

								}else if(!data[1] && data[2].length === 0){
									$('#tabF').css('pointer-events',' none');
							$('#tabF').css('opacity',' 0.5');
							$('#tabF').css('cursor','not-allowed');
							
								}
								else {
									for(let i=0;i<data[2].length;i++){
										$('#cntF').append(
										`<tr >
									<td>  ${data[2][i].raisonsociale !== null ?  data[2][i].raisonsociale: " " }  </td>
									<td style=${data[2][i].ste_part === 1 ? "color:green" : "color:red"}>  ${data[2][i].ste_part === 1 ? "oui" : "non"}  </td>
									<td>  ${data[2][i].responsable !== null ?   data[2][i].responsable : " "}  </td>
									<td>  ${data[2][i].telephone !== null ?  data[2][i].telephone : " " }  </td>
									<td>  ${data[2][i].email !== null ?  data[2][i].email : " " }  </td>
									</tr>`
							);
									}
								}
						}else{
							
						}
				}
        });
	});
	$('#reset').click(function(){
		$("#example1").DataTable().column(0).search("").draw();
		$('#sub').val("");
		$('#tw').hide();
	})
	</script>
@endsection
