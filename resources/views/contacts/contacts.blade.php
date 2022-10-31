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
					.dataTables_filter, .dataTables_info { display: none; }
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
										<div class="form-group">
											<input type="text" aria-controls="example1" class="form-control" style="width: 50%" id="sub" placeholder="Name">
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
                                                <td><a href="{{route('contacts',$contact->id)}}">{{$contact->raisonsociale}}</a></td>
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
 <script>
	 $("#sub").keyup(function () {
		 $('input[type="checkbox"]').prop("checked", false);
		 $("#example1").DataTable().column(0).search($(this).val()).draw();
		});
	</script>
@endsection
