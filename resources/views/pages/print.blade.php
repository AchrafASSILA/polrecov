@extends('layouts.master')
@section('css')
    <style>
        body{
            /* direction: rtl; */
        }
        @media print {
            #print_Button {
                display: none;
            }
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha256-ZosEbRLbNQzLpnKIkEdrPv7lOy9C27hHQ+Xp8a4MxAQ=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
    .total span:nth-child(2){
        padding-right: 10px;
    }

    .total span{
    padding: 5px 20px;
    border: 1px solid #e3e8f7;
    }</style>
@endsection
@section('title')
    
@stop
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">Relevé</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/
                    Print Relevé</span>
            </div>
        </div>
        @php

        @endphp
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row row-sm">
        <div class="col-md-12 col-xl-12">
            <div class=" main-content-body-invoice" id="print">
                <div class="card card-invoice">
                    <div class="card-body">
                        <img src="{{ asset('assets/img/brand/polassur.png')}}" width="180px" alt="dd">
                        <div class="billed-from"style="text-align: center;width: 100%;">
                        <h3 style="font-size: 20px;">RELEVÉ DES PRIMES NON RÉGLÉES</h3>
                    </div><!-- billed-from -->
                    
                    <div class="table-responsive mg-t-40">            
                                        @foreach ($receipts as $key => $recs)
                                            
                                        <table class="table table-invoice border text-md-nowrap mb-0">
                                            <h3 style="font-size: 15px;margin-left: 30px;margin-bottom: 30px;margin-top:30px;">Souscripteur: {{$key}}</h3>
                            <thead>
                                <tr>
                                        <th style="text-align: center" class="wd-15p border-bottom-0">N Quittance</th>
                                        <th style="text-align: center" class="wd-15p border-bottom-0">N Police</th>
                                        <th style="text-align: center" class="wd-15p border-bottom-0">Categorie/Branche/Risque</th>
                                        <th style="text-align: center" class="wd-20p border-bottom-0">Du</th>
                                        <th style="text-align: center" class="wd-15p border-bottom-0">Au</th>
                                        <th style="text-align: center" class="wd-10p border-bottom-0">Prime Total</th>
                                        <th style="text-align: center" class="wd-10p border-bottom-0"><input name="select_all" id="all" type="checkbox" onclick="CheckAll('box1', this)" ></th>
                                        
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    @php
                                        $total = 0;
                                    @endphp
                                    @foreach ($recs as $receipt)
                                        
                                    <tr>
                                        <td  style="text-align: center" >{{$receipt->quitance}}</td>
                                        <td style="text-align: center" >{{$receipt->police}}</td>
                                        <td >{{$receipt->categorie }}</td>
                                        <td style="text-align: center" >{{date('m/d/Y', strtotime( $receipt->du))}}</td>
                                        <td style="text-align: center" >{{date('m/d/Y', strtotime( $receipt->au))}}</td>
                                        <td style="text-align: right" >{{ number_format($receipt->prime_total, 2,'.',' ')}}</td> 
                                        @if (in_array( $receipt->quitance,$files_quittances))
                                        <td style="text-align: center" ><input type="checkbox"  value="{{'Q_'.$receipt->quitance.'.pdf'}}" class="box1" ></td> 
                                            
                                        @else
                                            
                                        <td style="text-align: center" ><input type="checkbox" disabled></td> 
                                        @endif
                                    </tr>
                                    @php
                                    $total += $receipt->prime_total;
                                    @endphp
                                    @endforeach
                                            </tbody>
                                        
                                            
                                            
                                        </tbody>
                                    </table>
                                    
                                    <div style="margin-top: 15px;text-align: right;" class="total">
                                        
                                        <span>total</span>
                                        <span>
                                            <?php echo number_format($total, 2)?>
                                        </span>
                                    </div>
                                    
                                    @endforeach
                                </div>
                                <hr class="mg-b-40">
                                
						<button class="btn " style="display: flex;
                        margin-left: auto;
                        background: #2196f3;color:white;" data-target="#modaldemo8" data-toggle="modal" style="text-align: center" id="generate" >Choisissez une methode d'envoi</button>
						<div class="modal" id="modaldemo8">
							<div class="modal-dialog modal-dialog-centered" role="document">
								<div class="modal-content modal-content-demo">
									<div class="modal-header">
										<h6 class="modal-title">Méthode d'envoi</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
									</div>
									<div class="modal-body">
										<h6>Choisissez une méthode d'envoi ?</h6>
										{{-- <p>Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</p> --}}
                                        <form action="{{route('printT')}}" method="post">
                                            <input type="text" name="files_to_send" hidden id="files_to_send">
                                            @csrf
                                            <div>
                                                <div class="form-control" style="display: flex;border: none;align-items: center;">
                                                    <input class="rdiobox"  required type="radio" id="Whatsaap" name="sendType" value="Whatsaap">
                                                    <label  for="Whatsaap" style="margin-left: 5px;margin-bottom: 0px;font-weight: bold;">Whatsapp</label><br>
                                                </div>
                                                {{-- <div class="form-control" style="display: flex;border: none;align-items: center;">
                                                    <label  for="number" style="margin-left: 5px;margin-bottom: 0px;font-weight: bold;">Whatsapp number :</label><br>
                                                    <input  required type="text" id="number" name="number" value="0634328147">
                                                </div> --}}
                                                
                                                <div class="form-control" style="display: flex;border: none;align-items: center;">
                                                    <input class="rdiobox" required  type="radio" id="Email" name="sendType" value="Email">
                                                    <label for="Email" style="margin-left: 5px;margin-bottom: 0px;font-weight: bold;">Email</label><br>
                                                </div>
                                            </div>
                                            <div class="show-email-type-send" style="display: none;margin-left: 20px;">
                                                <div class="form-control" style="display: flex;border: none;align-items: center;">
                                                    <input class="rdiobox"  type="radio" id="EmailM" name="sendEmailType" value="Now">
                                                    <label for="EmailM" style="margin-left: 5px;margin-bottom: 0px;">Envoyer Maintenant </label><br>
                                                </div>
                                                <div class="form-control" style="display: flex;border: none;align-items: center;">
                                                    <input class="rdiobox"  type="radio" id="EmailD" name="sendEmailType" value="Different">
                                                    <label for="EmailD" style="margin-left: 5px;margin-bottom: 0px;">Envoyer Differe </label><br>
                                                </div>
                                                <div style="display: none;margin-bottom: 5px;" id="different">
                                                    
                                                    <label for="" >Date d'envoi : </label><br>
                                                    <input class="form-control"  type="date"   name="dateToSend" >
                                                    <span id="error" style="text-align: center;
                                                    width: 100%;
                                                    display: none;
                                                    background: #DC4C64;
                                                    color: white;
                                                    padding: 5px 10px;
                                                    margin-top: 5px;
                                                    border-radius: 3px;">date invalid</span>
                                                </div>
                                                <label for="" >Email de Souscripteur : </label><br>
                                                
                                                    
                                                    <div >
                                                        <input class="form-control"  type="text" id="to" name="to" value="{{$subscriber_principale[0]->email}}">
                                                    </div>
                                                <label for="" >Emails Cc : </label><br>
                                                
                                                    
                                                    <div id="cc">
                                                        <div class="grp" style="display: flex;
                                                        justify-content: center;
                                                        align-items: center;">

                                                            <input class="form-control"  type="text" id="emails_cc" name="cc_email[]" >
                                                            <div style="margin-top: 10px;
                                                        margin-bottom: 10px;
                                                        text-align: right;">

                                                        <button type="button" class="btn btn-primary" style="margin-left: 5px" id="add_cc">ajouter</button>
                                                        </div>
                                                        </div>
                                                        <span id="error_add" style="text-align: center;
                                                    width: 100%;
                                                    display: none;
                                                    background: #DC4C64;
                                                    color: white;
                                                    padding: 5px 10px;
                                                    margin-top: 5px;
                                                    margin-bottom: 5px;
                                                    border-radius: 3px;">element deja existe</span>
                                                    <span id="error_empty" style="text-align: center;
                                                    width: 100%;
                                                    display: none;
                                                    background: #DC4C64;
                                                    color: white;
                                                    padding: 5px 10px;
                                                    margin-top: 5px;
                                                    margin-bottom: 5px;
                                                    border-radius: 3px;">entre un email</span>
                                                    
                                                    </div>
                                                    
                                                
                                                    <div >
                                                        <label style="margin-top: 10px;"  for="subject" >Objet : </label><br>
                                                        <input class="form-control"  type="text" id="subject"  name="message" >
                                                    </div>
                                                    <div >
                                                        <label style="margin-top: 10px;"  for="object" >Message (additionnel) : </label><br>
                                                        <input class="form-control"  type="text" id="object"  name="object" >
                                                    </div>
                                                    <div >
                                                        <label style="margin-top: 10px;"  for="default_object" >Default message : </label><br>
                                                        <div style="display: flex;
                                                        justify-content: center;
                                                        align-items: center;">

                                                            <textarea class="form-control"  id="default_object" style="display: none;height:40px" type="text"  id="default_object"  name="default_object" >Bonjour C'est Polassur Merci De Lire L'appel Suivante</textarea>
                                                        <button type="button" onclick="showDefaultObject()" class="btn btn-primary" id="show_default_object" style="margin-left: auto;padding: 7px 20px;"><i style="font-size: 24px;" class="la la-pencil"></i></button>
                                                        </div>
                                                    </div>
                                            </div>
                                            @foreach ($quitances as $impay)
                                                
                                            <input type="hidden"  name="subs_id[]" value="{{$impay}}">
                                            @endforeach
                                            <div style="text-align: center;">

                                                <button class="btn btn-primary mt-3 mr-2" type="submit" >Valider Tache</button>
                                            </div>
                                        </form>
									</div>
								</div>
							</div>
						</div>        
                            </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
    <style>
            .swal-overlay .swal-overlay--show-modal {
        z-index: {X};
    }
    </style>
@endsection
@section('js')
    <!-- Internal Modal js-->
    <script src="{{URL::asset('assets/js/modal.js')}}"></script>
    <script>
        $(document).ready(function() {
        $("input[name$='sendType']").click(function() {
        var test = $(this).val();
            if(test === "Email"){
                $("div.show-email-type-send").show();
                // $("#Cars" + test).show();
                $("input[name='sendEmailType']").prop('required',true);
                $("input[name='to']").prop('required',true);
                
                } else{
                    
                    $("div.show-email-type-send").hide();
                    $("input[name='sendEmailType']").prop('required',false);
                    $("input[name='to']").prop('required',false);
                
                }

        });
            $('input[name="dateToSend"]').change(function(){
                $("#error").css("display",'none');
                var value = this.value;
                var d = new Date();
                var strDate = d.getFullYear() + "-" + (d.getMonth()+1) + "-" + d.getDate();
                
                if(value < strDate){
                    $("#error").css("display",'block');
                    this.value = "";
                }
            })
                $("input[name$='sendEmailType']").click(function() {
                var test = $(this).val();
                    if(test === "Different"){
                        $("#different").show();
                        $("input[name='dateToSend']").prop('required',true);
                    } else{
                        
                        $("#different").hide();
                        $("input[name='dateToSend']").prop('required',false);
                    }

                });
            });
        $(function() {
        $("#generate").click(function() {
            var selected = new Array();
            $("input[class=box1]:checked").each(function() {
                if(this.value!== 'on'){
                    selected.push(this.value);
                }
            });
                $('input[id="files_to_send"]').val(selected);
        });
    });

            function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }
    var fields = [];
		$(function() {
			$("#add_cc").click(function() {
				
                $('#error_add').css("display","none");
                $('#error_empty').css("display","none");
                var input_email_cc = $('#emails_cc').val(); 
                // swal(input_email_cc);
                if(input_email_cc ){

                    if(jQuery.inArray(input_email_cc,fields) === -1 ){
                        $('#cc').append('<div  class="form-group" style="display: flex;align-items: center;"><input readonly type="text" class="form-control" name="cc_emails[]"  value="'+input_email_cc+'" /><span style="font-size: 25px;color: #ff6161;cursor: pointer;margin-left: 5px;font-weight: bold;" onclick="removeField(this)">x</span></div>');
						fields.push(input_email_cc);
                    }else{
                        
                        $('#error_add').css("display","block");
						
                    }
                }else{

                    $('#error_empty').css("display","block");
                }
				
           
		});
	});
    function showDefaultObject(){
        let btn = document.getElementById('show_default_object');
        let input = document.getElementById('default_object');
        input.style.display='block';
        btn.style.marginLeft='5px';
    }
    function removeField(element){
			var currentElementValue = element.parentElement.children[0].value;
			
			if(confirm('vous voulez vraiment supprimer cet email adress ?')){
				
				element.parentElement.remove();
				for(var i=0;i<fields.length;i++){
					
					if(fields[i] == currentElementValue){
						fields.splice(i,1);
					}
				}
			}
					
		
	}	
    </script>
@endsection