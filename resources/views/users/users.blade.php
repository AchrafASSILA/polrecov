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
							<h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Users</span>
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
									<h4 class="card-title mg-b-0">Users Table</h4>
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
                                    <div style="text-align: right;margin-bottom: 10px;"><a href="{{route('users.create')}}" class="btn btn-primary"> Creer</a></div>
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-10p border-bottom-0">Name</th>
												<th class="wd-10p border-bottom-0">Email</th>
												<th class="wd-10p border-bottom-0">Username</th>
												<th class="wd-10p border-bottom-0">Type</th>
												<th class="wd-10p border-bottom-0">Creer Le</th>
												<th class="wd-10p border-bottom-0">Operations</th>
												</thead>
										<tbody id="tbImpayes">
											@foreach ($users as $user)
											<tr>
                                                <td>{{$user->name}}</td>
												<td>{{$user->email}}</td>
												<td>{{$user->username}}</td>
                                                @if ($user->type === 0)
												<td>Admin</td>
                                                
                                                @elseif($user->type === 2)
												<td>User</td>
                                                @else
                                                    
												<td>Consulter</td>
                                                @endif
												<td>{{$user->created_at}}</td>
												<td style="display: flex">
                                                    <a href="{{route('users.edit',$user->id)}}" style="margin-right:5px;background:#009688;" class="btn btn-success">Modifier</a>
                                                    <form action="{{route('users.destroy',$user->id)}}" method="post">@csrf @method('DELETE')<button onclick="return confirm('vous voulez vraiment supprimez cet user ?')" class="btn btn-danger">supprimer</button></form></td>
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
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>

<!--Internal  jquery.maskedinput js -->
<script src="{{URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>
<!--Internal  spectrum-colorpicker js -->
<script src="{{URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js')}}"></script>
<!-- Internal Modal js-->
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
<script>
    $('#sub').keyup(function(){
		$('input[type="checkbox"]').prop('checked', false)
	$('#example1').DataTable().search($(this).val()).draw();
});
</script>
@endsection
