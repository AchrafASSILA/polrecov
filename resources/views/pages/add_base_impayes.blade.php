@extends('layouts.master')
@section('css')
<!---Internal Fileupload css-->
<link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">Les Bases</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Ajouter la base impayes</span>
						</div>
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
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
                    <div class="col-sm-12 col-md-12">
                        <form action="{{route('storeBaseImpayes')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="file"  required name="excelFile" class="dropify" accept=".xlsx , .xls"
                            data-height="70" />
                            <div class="d-flex justify-content-center mt-2">
                                <button type="submit" class="btn btn-primary">ajouter base</button>
                            </div>
                        </form>
                        </div><br>
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal Fileuploads js-->
<script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
@endsection