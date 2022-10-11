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
							<h4 class="content-title mb-0 my-auto">Les Impayes</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Generer Les Impayes</span>
						</div>
					</div>
					
				</div>
				<!-- breadcrumb -->
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
                    <div class="col-lg-12 col-md-12">
                        <div class="card" id="basic-alert">
                            <div class="card-body">
                                            
                                            
                                            <div class="text-wrap">
                                                {{-- <div class="example"> --}}
                                                    <div class="panel panel-primary tabs-style-1">
                                                        <div class=" tab-menu-heading">
                                                            <div class="tabs-menu1">
                                                                <!-- Tabs -->
                                                                <ul class="nav panel-tabs main-nav-line">
                                                                    <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">Contact Principale</a></li>
                                                                    <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">Groupement</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                                            <div class="tab-content">
                                                                <div class="tab-pane active" id="tab1">
                                                                    <div class="table-responsive">
                                                                        <table id="example2" class="table key-buttons text-md-nowrap">
                                                                            <thead>
                                                                                <tr>
                                                                                    <th class="wd-15p border-bottom-0">Raisonsociale</th>
                                                                                    <th class="wd-15p border-bottom-0">ste_part</th>
                                                                                    <th class="wd-15p border-bottom-0">Responsable</th>
                                                                                    <th class="wd-15p border-bottom-0">Telephone</th>
                                                                                    <th class="wd-15p border-bottom-0">EmaiL</th>
                                                                                    </thead>
                                                                            <tbody id="tbImpayes">
                                                                                <tr>
                                                                                    <td>{{$contact->raisonsociale}}</td>
                                                                                    <td>{{$contact->ste_part}}</td>
                                                                                    <td>{{$contact->responsable}}</td>
                                                                                    <td>{{$contact->telephone}}</td>
                                                                                    <td>{{$contact->email}}</td>
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
                                                                        <tbody id="tbImpayes">
                                                                            @foreach ($contacts as $con)
                                                                            @if (!($con->raisonsociale === $contact->raisonsociale))
                                                                                
                                                                            <tr>
                                                                                <td>{{$con->raisonsociale}}</td>
                                                                                <td>{{$con->ste_part}}</td>
                                                                                <td>{{$con->responsable}}</td>
                                                                                <td>{{$con->telephone}}</td>
                                                                                <td>{{$con->email}}</td>
                                                                            </tr>
                                                                            @endif
                                                                            @endforeach
                                                                        </tbody>

                                                                        </table>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div></div></div></div></div></div></div></div>
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

@endsection
