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
									<h4 class="card-title mg-b-0">Les Impayes Table</h4>
									<i class="mdi mdi-dots-horizontal text-gray"></i>
								</div>
								</div>
							<div style="text-align: right;margin-bottom: 10px;" class="card-body mb-20">
								<div style="display: flex;
								align-items: center;
								justify-content: center;margin-bottom: 10px;">
									<div class="form-group" style="margin-bottom: 0px;margin-right: 10px;" >
										<div class="dropdown">
											<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary" data-toggle="dropdown" id="dropdownMenuButton" type="button">Les Champs<i class="fas fa-caret-down ml-1"></i></button>
											<div  class="dropdown-menu tx-13">
												<div class="form-control"  style="border: none">
													
													<input type="checkbox" name="cells" id="" value="1">
													<label for="">Exercice</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="2">
													<label for="">Quittance</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="3">
													<label for="">Cie</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="4">
													<label for="">Souscripteur</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="6">
													<label for="">Branche</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="7">
													<label for="">Categorie</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="8">
													<label for="">Risque</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="9">
													<label for="">Police</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="10">
													<label for="">Du</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="11">
													<label for="">Au</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="12">
													<label for="">Prime</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="13">
													<label for="">Mt Encaiss</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="14">
													<label for="">Ref Encaiss</label>
												</div>
												<div class="form-control" style="border: none">
													<input type="checkbox" name="cells" id="" value="15">
													<label for="">Aperiteur</label>
												</div>
												
											</div>
										</div>
									</div>
									<button class="btn btn-primary" style="margin-right: 10px;" id="show_all">voir les champ sélectionnez</button>
									<button class="btn btn-primary" style="margin-right: 10px;" id="hide_all">masquer les champ sélectionnez</button>
								</div>
								<div class="table-responsive">
									<div class="mb-4" >
										<div class="form-group">
											<label style="width: 100%;text-align: left;" >Souscripteur Nom :</label>
											<input type="text" aria-controls="example1" class="form-control" style="width: 50%" id="sub" placeholder="Name">
										</div>
										<div class="form-group">
											
											<label style="width: 100%;text-align: left;" for="impayes">Souscripteurs</label>
											<select name="impayes" id="impayes" style="width:50%" class="form-control select2">
												
											</select>
										</div>
										<div class="form-group">
											<label style="width: 100%;text-align: left;" for="subscribers">Groupement</label>
											<select name="subscribers" id="subscribers" style="width:50%" class="form-control select2">
												<p class="mg-b-10">Subscribers</p>
											</select>
										</div>
									</div>
									
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th  style="    text-align: left;"   class="wd-15p border-bottom-0"><input onClick="toggle(this)"  type="checkbox" name="" id="all"></th>
												<th    class="wd-15p border-bottom-0">Exercice</th>
												<th    class="wd-15p border-bottom-0">N*Quittance</th>
												<th    class="wd-15p border-bottom-0">Cie</th>
												<th    class="wd-15p border-bottom-0">Souscripteur</th>
													<th style="display: none">Souscripteur</th>
												<th   class="wd-20p border-bottom-0">Branche</th>
												<th    class="wd-15p border-bottom-0">Categorie</th>
												<th    class="wd-10p border-bottom-0">Risque</th>
												<th    class="wd-10p border-bottom-0">Police</th>
												<th   class="wd-10p border-bottom-0">Du</th>
												<th    class="wd-10p border-bottom-0">Au</th>
												<th    class="wd-10p border-bottom-0">Prime</th>
												<th    class="wd-10p border-bottom-0">Mt Encaiss</th>
												<th    class="wd-10p border-bottom-0">Ref Encaiss</th>
												<th class="wd-10p border-bottom-0">Aperiteur</th>
												</thead>
										<tbody id="tbImpayes">
											@foreach ($impayes as $impaye)
											<tr>
                                                <td  style="text-align: left;" ><input  type="checkbox"  name="quitance_id" value="{{$impaye->quitance}}/{{$impaye->souscripteur}}"></td>
												<td      >{{$impaye->exercice}}</td>
												<td     >{{$impaye->quitance}}</td>
												<td    >{{$impaye->cie}}</td>
												<td  style="white-space: nowrap; overflow: hidden;width: 180px;height: 30px;text-overflow: ellipsis;" title="{{$impaye->souscripteur}}" >{{ \Illuminate\Support\Str::limit($impaye->souscripteur, 15, $end='...') }}</td>
												<td  style="display: none">{{$impaye->souscripteur}}</td>
												<td    >{{$impaye->branche}}</td>
												<td    >{{$impaye->categorie}}</td>
												<td    >{{$impaye->risque}}</td>
												<td    >{{$impaye->police}}</td>
												<td    >{{date('d/m/Y', strtotime( $impaye->du))}}</td>
												<td    >{{date('d/m/Y', strtotime($impaye->au))}}</td>
												<td    >{{ number_format($impaye->prime_total, 2)}}</td>
												<td    >{{$impaye->mtt_ancaiss}}</td>
												<td     >{{$impaye->ref_encaiss}}</td>
												<td   >{{$impaye->aperiteur}}</td>
                                                </tr>
                                            @endforeach
										</tbody>
									</table>
									<a target="_blank" href='https://wa.me/212682297143'>Share to WhatsApp </a>
								</div>
							</div>
						</div>
						
						<form style="width: 100%;margin-bottom: 10px;display: flex;
						flex-direction: column-reverse;padding: 10px;
    border-radius: 5px;background: white;"  action="{{route('impayes.store')}}" method="POST" >
							@csrf
							{{-- <input type="text" name="impayes_ids" id="generate_all_id"> --}}
							<div >

								<button  class="btn btn-primary" type="button" style="text-align: center" id="generate" >Ajouter a l'etat</button>
								<button  class="btn btn-primary" type="submit">Générer</button>
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

    <script>

		function toggle(source) {
		checkboxes = document.getElementsByName('quitance_id');
		checkboxAll = document.getElementById('all');
		
		for(var i=0, n=checkboxes.length;i<n;i++) {
			checkboxes[i].checked = source.checked;
		}
		
		}
	</script>
	<script>
		$(document).ready(function(){
		// $('#subscribers').hide();
				$("#sub").on('input', function() {
				var search =  $(this).val();
				// alert(search);
				if(search==""){
					// $('#subscribers').hide();
				}else{
					let parent = search;
					// $('#subscribers').show();
					if (search) {
					$.ajax({
                        url: "{{ URL::to('admin/get-names') }}/" + parent,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
							$('select[name="impayes"]').empty();
							$('select[name="impayes"]').append('<option value="'+ parent+'">Choisir Un Souscripteur</option>');
							$.each(data, function(key, value) {
								$('select[name="impayes"]').append('<option value="' +
								value + '">' + value + '</option>');
								
                            });
						},
                    });
					
					}else {
                    console.log('AJAX load did not work');
                }
				} 
				});
				
		});
				$("#impayes").change( function() {
				var search =  $(this).val();
					if (search) {
					$.ajax({
                        url: "{{ URL::to('admin/subscribers') }}/" + search,
                        type: "GET",
                        dataType: "json",
                        success: function(data) {
							$('select[name="subscribers"]').empty();
							$('select[name="subscribers"]').append('<option value="'+ search+'">Choisir Le Pere</option>');
							$.each(data, function(key, value) {
								$('select[name="subscribers"]').append('<option value="' +
								value + '">' + value + '</option>');
								
                            });
						},
                    });
					
					}else {
                    console.log('AJAX load did not work');
                }
				});
				
	</script>
	
	<script>
		
		var fields = [];
		$(function() {
			$("#generate").click(function() {
				$("#example1 input[type=checkbox]:checked").each(function() {
					if(this.value !== 'on' && jQuery.inArray(this.value,fields) === -1 ){
						$('form').append('<div  class="form-group" style="display: flex;align-items: center;"><input readonly type="text" class="form-control" name="subs_id[]" id="subs" value="'+this.value+'" /><span style="font-size: 25px;color: #ff6161;cursor: pointer;margin-left: 5px;font-weight: bold;" onclick="removeField(this)">x</span></div>');
						fields.push(this.value);
						}else{
						if(this.value !=='on'){
							alert('cet élément existe déjà !!');
						}
						}
				
            });
		});
	});
	$(function() {
		var checked_cells ;
			$("#show_all").click(function() {
				 checked_cells =$('input[name="cells"]:checked');
				// console.log($('#example1').DataTable().columns().names().length)
				 if(checked_cells.length>0){
					
					$('#example1').DataTable().columns().visible(false);
					$('#example1').DataTable().column(0).visible(true);
					checked_cells.each(function() {
						$('#example1').DataTable().column(this.value).visible(true);
						
					});
				}else{
					alert('vous devez sélectionner des champs premièrement !!');
				}
			});
			$("#hide_all").click(function() {
				 checked_cells =$('input[name="cells"]:checked');
				 if(checked_cells.length>0){
					 
					 
					 $('#example1').DataTable().columns().visible(true);
					 $('#example1').DataTable().column(0).visible(true);
					checked_cells.each(function() {
						
						$('#example1').DataTable().column(this.value).visible(false);
					});
				}else{
					alert('vous devez sélectionner des champs premièrement !!');
				}
			});
		});
	function removeField(element){
			var currentElementValue = element.parentElement.children[0].value;
			
			if(confirm('vous voulez vraiment supprimer cet élément ?')){
				
				element.parentElement.remove();
				for(var i=0;i<fields.length;i++){
					
					if(fields[i] == currentElementValue){
						fields.splice(i,1);
					}
				}
			}
					
		
	}	
</script>
// <!-- Internal Data tables -->
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
	$('select[name="subscribers"]').on('change', function() {
	$('input[type="checkbox"]').prop('checked', false)
                var subsVal = $(this).val();
                $('#example1').DataTable().search(subsVal).draw();
            });
	$('select[name="impayes"]').on('change', function() {
                var subsVal = $(this).val();
                $('#example1').DataTable().search(subsVal).draw();
            });
</script>
@endsection
