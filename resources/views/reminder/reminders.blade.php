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
							<h4 class="content-title mb-0 my-auto">HISTORIQUE</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Historique des releves</span>
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
								<div class="d-flex justify-content-between">
									<h4 class="card-title mg-b-0">L'Historique</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								</div>
							<div class="card-body">
								<div class="table-responsive">
									<table style="table-layout: fixed;
									word-wrap: break-word;width: 100%;" class="table text-md-nowrap table-striped" id="example1">
										<thead>
											<tr>
												<th class="set-display  wd-15p border-bottom-0" style="display: none"><span> Souscripteur</span></th>
												<th class="set-display  wd-15p border-bottom-0"><span> Souscripteur</span></th>
												<th class="set-display  border-bottom-0"><span> Type d'envoi</span></th>
												<th class="set-display wd-15p border-bottom-0"><span> Date D'envoi</span></th>
												<th class="set-display wd-15p border-bottom-0"><span> Email</span></th>
												<th class="set-display wd-15p border-bottom-0"><span> User</span></th>
												<th class="set-display wd-15p border-bottom-0"><span> Releve</span></th>
												<th class="wd-15p border-bottom-0"><span> Ouvrir relevé</span></th>
												</thead>
										<tbody id="tbImpayes">
											@foreach ($reminders as $reminder)
											<tr>
                                                <td class="ellipsis" style="display: none"><span> {{$reminder->send_to}}</span></td>
                                                <td class="ellipsis"><span> {{$reminder->send_to}}</span></td>
												<td class="ellipsis"><span> {{$reminder->isSendToMail ? 'Par Email' : 'Par Whatsapp'}}</span></td>
												
												<td class="ellipsis"> {{date('d/m/Y', strtotime( $reminder->dateSend))  . ' ' . \Carbon\Carbon::parse(explode(' ', $reminder->dateSend)[1])->addHour()->toTimeString()}}</td>
												<td class="ellipsis"><span> {{$reminder->email_to}}</span></td>
												
												<td class="ellipsis"><span> {{$reminder->user}}</span></td>
												@php
													$name = implode(' / ', array_diff( explode('_',$reminder->fileName),array('Q' , explode('_',$reminder->fileName)[count(explode('_',$reminder->fileName))-1])));
												@endphp
												<td class="ellipsis"><span> {{  $name}}</span></td>
												<td >
													@php
													$path = public_path() . '/storage/releve/' .  $reminder->fileName;
													$files = array_diff(scandir($path), array('.', '..'));
													@endphp
														<div class="dropdown">
															<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button">operations<i class="fas fa-caret-down ml-1"></i></button>
															<div  class="dropdown-menu tx-13">
																
																@foreach($files as $file)

																	@php
																$file_path = asset( "../storage/releve") ."/"  . $reminder->fileName . '/'.$file ;
																@endphp
																<a style="margin-left:10px; display:block; width: 60px;" title="{{explode('.pdf', $file)[0]}}" class="" style="padding: 8px 15px;width:100%;height:43px;text-decoration:none;" target="_blank"  href="{{$file_path}}">
																	<i class="far fa-eye"></i></a>
																
																@endforeach;
															</div></div>
													</td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<style>
							tr:nth-child(even) {background: rgb(255, 0, 0)}
							tr:nth-child(odd) {background: #FFF}
						</style>
						
						
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
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script src="{{URL::asset('assets/js/resize.js')}}"></script>


@endsection
