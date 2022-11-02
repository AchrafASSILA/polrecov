@extends('layouts.master2')

@section('title')
تسجيل الدخول - مورا سوفت للادارة القانونية
@stop


@section('css')
<!-- Sidemenu-respoansive-tabs css -->
<link href="{{URL::asset('assets/plugins/sidemenu-responsive-tabs/css/sidemenu-responsive-tabs.css')}}" rel="stylesheet">
@endsection
@section('content')
		<div class="container-fluid">
			<div class="row no-gutter"  style="flex-direction: row-reverse;">
				<!-- The image half -->
				<!-- The content half -->
				<div class="col-md-6 col-lg-6 col-xl-5 bg-white">
					<div class="login d-flex align-items-center py-2">
						<!-- Demo content-->
						<div class="container p-0">
							<div class="row">
								<div class="col-md-10 col-lg-10 col-xl-9 mx-auto">
									<div class="card-sigin">
										<div class="mb-5 d-flex"> <a href="{{ url('/' . $page='Home') }}">
                                            <img height="80px" src="{{URL::asset('assets/img/brand/polassur.png')}}" class="sign-favicon " alt="logo"></a><h1 class="main-logo1 ml-1 mr-0 my-auto tx-28"></h1>
                                        </div>
										<div class="card-sigin">
											<div class="main-signup-header">
												{{-- <h2>Bonjour</h2> --}}
												<h5 class="font-weight-semibold mb-4" style="color: navy;
                                                font-size: 25px;">Login</h5>
                                                <form method="POST" action="{{ route('login') }}">
                                                 @csrf
													<div class="form-group">
														<label>Username</label>
														<input id="username" autocomplete="off" type="text" class="form-control @error('username') is-invalid @enderror" style="text-align: left" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>
														 @error('username')
														 <span class="invalid-feedback" role="alert">
                                                     <strong>{{ $message }}</strong>
                                                     </span>
                                                     @enderror
													</div>

												 <div class="form-group">
											 	 <label>Password</label> 
                                                
                                                  <input style="text-align: left" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                                  @error('password')
                                                  <span class="invalid-feedback" role="alert">
                                                  <strong>{{ $message }}</strong>
                                                  </span>
												  @enderror
												  </div>
                                                    <button type="submit" style="background: navy;color:white; " class="btn  btn-block">
                                                    {{ __('Login') }}
                                                    </button>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div><!-- End -->
					</div>
				</div><!-- End -->

                <div class="col-md-6 col-lg-6 col-xl-7 d-none d-md-flex " style="background: white">
					<div class="row wd-100p mx-auto text-center" >
						<div class="col-md-12 col-lg-12 col-xl-12 my-auto mx-auto wd-100p" >
							<img src="{{URL::asset('assets/img/media/login2.jpg')}}" height="100%"  class="my-auto ht-xl-80p wd-md-100p wd-xl-80p mx-auto" alt="logo">
						</div>
					</div>
				</div>

			</div>
		</div>
@endsection
@section('js')
@endsection