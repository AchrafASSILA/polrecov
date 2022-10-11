@extends('layouts.master')
@section('css')
<!-- Internal Nice-select css  -->
<link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
@section('title')
@stop


@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">Users</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ Users
                </span>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


    <div class="col-lg-12 col-md-12">

        @if (count($errors) > 0)
        <div class="alert alert-danger">
            <button aria-label="Close" class="close" data-dismiss="alert" type="button">
                <span aria-hidden="true">&times;</span>
            </button>
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card">
            <div class="card-body">
                <form class="parsley-style-1" id="selectForm2" autocomplete="off" name="selectForm2"
                    action="{{route('users.store')}}" method="post">
                    @csrf

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>Name : <span class="tx-danger">*</span></label>
                                <input class="form-control type mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="name"  type="text">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>Email : <span class="tx-danger">*</span></label>
                                <input class="form-control type mg-b-20"
                                    data-parsley-class-handler="#lnWrapper" name="email" type="email">
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>Password : <span class="tx-danger">*</span></label>
                            <input class="form-control type mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="password"  type="password">
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>Confirm Password : <span class="tx-danger">*</span></label>
                            <input class="form-control type mg-b-20" data-parsley-class-handler="#lnWrapper"
                                name="confirm-password"  type="password">
                        </div>
                    </div>

                    <div class="row row-sm mg-b-20">
                        <div class="col-12">
                            <label class="form-label">Type : </label>
                            <select name="type_user" id="select-beast" class="form-control  nice-select  custom-select">
                                <option value="1">Viewer</option>
                                <option value="2">Consulter</option>
                            </select>
                        </div>
                    </div>

                    
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button class="btn btn-main-primary pd-x-20" type="submit">Ajouter</button>
                    </div>
                </form>
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


<!-- Internal Nice-select js-->
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
<script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

<!--Internal  Parsley.min js -->
<script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
<!-- Internal Form-validation js -->
{{-- <script src="{{URL::asset('assets/js/form-validation.js')}}"></script> --}}
@endsection