@layout('blank')

@section('content')


	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<br/>
		<br/>
		
		<h3 id="myModalLabel">Input New Attendee:</h3>
	</div>

	<div class="modal-body" id="loaddata">
		{{$form->open('attendee/add','POST',array('class'=>'custom addAttendeeForm'))}}

		<div class="row-fluid formNewAttendee">
		    <div class="span6">
		        <fieldset>
		            @if(Auth::user()->role == 'onsite')
		              {{ $form->hidden('registonsite','true')}}
		              {{ $form->hidden('mobile','-')}}
		              {{ $form->hidden('address','-')}}
		              {{ $form->hidden('address_1','-')}}
		              {{ $form->hidden('address_2','-')}}
		              {{ $form->hidden('addressInvoice','-')}}
		              {{ $form->hidden('addressInvoice_2','-')}}
		              {{ $form->hidden('invoice_address_conv','-')}}
		              {{ $form->hidden('city','-')}}
		              {{ $form->hidden('cityInvoice','-')}}
		              {{ $form->hidden('companyInvoice','-')}}
		              {{ $form->hidden('companyfaxcountry','-')}}
		              {{ $form->hidden('companyfaxarea','-')}}
		              {{ $form->hidden('companyfax','-')}}
		              {{ $form->hidden('companyphonecountry','-')}}
		              {{ $form->hidden('companyphonearea','-')}}
		              {{ $form->hidden('companyphone','-')}}
		              {{ $form->hidden('companyphoneInvoiceCountry','-')}}
		              {{ $form->hidden('companyphoneInvoiceArea','-')}}
		              {{ $form->hidden('companyphoneInvoice','-')}}
		            {{ $form->hidden('companyfaxInvoiceCountry','-')}}
		            {{ $form->hidden('companyfaxInvoiceArea','-')}}
		            {{ $form->hidden('companyfaxInvoice','-')}}
		            {{ $form->hidden('confirmation','none')}}
		            {{ $form->hidden('country','none')}}
		            {{ $form->hidden('countryInvoice','none')}}
		            {{ $form->hidden('countryInvoice','none')}}
		            {{ $form->hidden('npwp','none')}}
		            {{ $form->hidden('npwpInvoice','none')}}
		            {{ $form->hidden('golfPaymentStatus','unpaid')}}
		            {{ $form->hidden('conventionPaymentStatus','unpaid')}}
		            {{ $form->hidden('paymentStatus','-')}}
		            {{ $form->hidden('position','-')}}
		            {{ $form->hidden('role','attendee')}}
		            {{ $form->hidden('zip','-')}}
		            {{ $form->hidden('zipInvoice','-')}}


		           
		            @endif
		            <legend>Personal Information</legend>

		                {{ Form::label('salutation','Salutation')}}

		                <div class="row-fluid radioInput">
		                    <div class="span2">
		                      {{ $form->radio('salutation','Mr','Mr',true)}} 
		                    </div>   
		                    <div class="span2">
		                      {{ $form->radio('salutation','Mrs','Mrs')}} 
		                    </div>   
		                    <div class="span2">
		                      {{ $form->radio('salutation','Ms','Ms')}} 
		                    </div>
		                    <div class="span6"></div>
		                </div>

		                
		                {{ $form->text('firstname','First Name.req','',array('class'=>'text span8','id'=>'firstname')) }}
		                
		                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span8','id'=>'lastname')) }}
		                {{ $form->text('email','Email.req','',array('class'=>'text span8','id'=>'email')) }}
		                {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'companyName')) }}


		                <fieldset>
		                <legend>Will attend the Industrial Dinner on 16 May 2013</legend>

		                    <div class="row-fluid">
		                        <div class="span2">
		                          {{ $form->radio('attenddinner','Yes','Yes',true) }} 
		                        </div>   
		                        <div class="span2">
		                          {{ $form->radio('attenddinner','No','No') }} 
		                        </div>   
		                        <div class="span8"></div>
		                    </div>

		            </fieldset>

		            <fieldset>
		                <legend>Golf Tournament on 12 May 2013</legend>

		                    <div class="row-fluid">
		                        <div class="span2">
		                          {{ $form->radio('golf','Yes','Yes',false,array('class'=>'paymentSettle field_golfType')) }} 
		                        </div>   
		                        <div class="span2">
		                          {{ $form->radio('golf','No','No',true,array('class'=>'paymentSettle field_golfType')) }} 
		                        </div>   
		                        <div class="span8"></div>
		                    </div>

		            </fieldset>
		        </fieldset>
		    </div>
		    <div class="span6">
		        <fieldset>
		            <legend>Registration Type</legend>
		                <small>Normal rate</small>
		                <div class="row-fluid">
		                    <div class="span6">
		                        Professional / Delegate Domestic
		                    </div>   
		                    <div class="span6">
		                      {{ $form->radio('regtype','IDR 5.000.000','PD',true,array('class'=>'paymentSettle regType')) }} 
		                    </div>   
		                </div>

		                <div class="row-fluid">
		                    <div class="span6">
		                        Professional / Delegate Overseas
		                    </div>   
		                    <div class="span6">
		                      {{ $form->radio('regtype','USD 550','PO',false,array('class'=>'paymentSettle regType')) }} 
		                    </div>   
		                </div>

		                <div class="row-fluid">
		                    <div class="span6">
		                        Student Domestic
		                    </div>   
		                    <div class="span6">
		                      {{ $form->radio('regtype','IDR 400.000','SD',false,array('class'=>'paymentSettle regType')) }} 
		                    </div>   
		                </div>

		                <div class="row-fluid">
		                    <div class="span6">
		                        Student Overseas
		                    </div>   
		                    <div class="span6">
		                      {{ $form->radio('regtype','USD 120','SO',false,array('class'=>'paymentSettle regType')) }} 
		                    </div>   
		                </div>
		        </fieldset>
		        
		        <fieldset>
		            <legend>FOC (Free Of Charge)</legend>

		                <div class="row-fluid">
		                    <div class="span2">
		                      {{ $form->radio('foc','Yes','Yes') }} 
		                    </div>   
		                    <div class="span2">
		                      {{ $form->radio('foc','No','No',true) }} 
		                    </div>   
		                    <div class="span8"></div>
		                </div>

		        </fieldset>
		        <fieldset>
		            <legend><strong>Use Early Bird Rates</strong></legend>

		                <div class="row-fluid">
		                    <div class="span2">
		                      {{ $form->radio('overrideratenormal','Yes','yes') }} 
		                    </div>   
		                    <div class="span2">
		                      {{ $form->radio('overrideratenormal','No','no',true) }} 
		                    </div>   
		                    <div class="span8"></div>
		                </div>

		        </fieldset>
		    </div>
		</div>

		<hr />

		<div class="row right">
		{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
		{{ Form::reset('Reset',array('class'=>'button'))}}
		</div>
		{{$form->close()}}
	</div> <!--End body loader-->
	
	

</div>
<script type="text/javascript">
  $('select').select2({
    width : 'resolve'
  });

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });

  $("#s2id_field_countryInvoice").select2("val", "ID");
  $("#s2id_field_country").select2("val", "ID");

</script>

<script type="text/javascript">
$(document).ready(function() {

  $("#s2id_field_countryInvoice").select2("val", "Indonesia");
  $("#s2id_field_country").select2("val", "Indonesia");
  
  function fillsame(){
    var companyName = $("#companyName").val();
    var companyNPWP = $("#companyNPWP").val();
    
    var companyPhoneCountry = $("#companyPhoneCountry").val();
    var companyPhoneArea = $("#companyPhoneArea").val();
    var companyPhone = $("#companyPhone").val();


    var companyFaxCountry = $("#companyFaxCountry").val();
    var companyFaxArea = $("#companyFaxArea").val();
    var companyFax = $("#companyFax").val();

    var companyAddress_1 = $("#address_1").val();
    var companyAddress_2 = $("#address_2").val();
    
    var companyCity = $("#city").val();
    var companyZip = $("#zip").val();
    var companyCountry = $("#s2id_field_country").select2("val");




    $("#companyNameInv").val(companyName);
    $("#companyNPWPInv").val(companyNPWP);
    
    $("#companyPhoneInvCountry").val(companyPhoneCountry);
    $("#companyPhoneInvArea").val(companyPhoneArea);
    $("#companyPhoneInv").val(companyPhone);


    $("#companyFaxInvCountry").val(companyFaxCountry);
    $("#companyFaxInvArea").val(companyFaxArea);
    $("#companyFaxInv").val(companyFax);

    $("#addressInv_1").val(companyAddress_1);
    $("#addressInv_2").val(companyAddress_2);
    
    $("#cityInv").val(companyCity);
    $("#zipInv").val(companyZip);
    $("#s2id_field_countryInvoice").select2("val", companyCountry);
  }

  function resetinput(){
    $('.invAdress')
     .not(':button, :submit, :reset, :hidden')
     .val('')
     .removeAttr('checked')
     .removeAttr('selected');
      $("#s2id_field_countryInvoice").select2("val", "");
  }

    $("#invoiceSameCheckbox").change(function() {
        if($(this).is(":checked")) {
            $(this).addClass("checked");
            fillsame();

        } else {
            $(this).removeClass("checked");
            resetinput();
        }
    });


  function calculatefees(){
    var regfeeIDR = '400';
    var regfeeUSD = '';
    var Golffee   = '2.500.000';
    var totalUSD   = '';
    var totalIDR   = '';
    if($('.regType:checked').val() == 'PO'){
      //alert($('.field_golfType:checked').val());
      if($('.field_golfType:checked').val() == 'No'){
        $('#totalUSDInput').val('500');
        $('#totalIDRInput').val('-');
      }else{
        //alert($('.field_golfType:checked').val());

        $('#totalUSDInput').val('500');
        $('#totalIDRInput').val('2.500.000');
        
      }
    }

    if($('.regType:checked').val() == 'PD'){
      //alert($('.field_golfType:checked').val());
      if($('.field_golfType:checked').val() == 'No'){
        $('#totalUSDInput').val('-');
        $('#totalIDRInput').val('4.500.000');

      }else{
        // /alert($('.field_golfType:checked').val());

        $('#totalUSDInput').val('-');
        $('#totalIDRInput').val('7.000.000');
      }
    }

    if($('.regType:checked').val() == 'SD'){
      $('#totalUSDInput').val('-');
      $('#totalIDRInput').val('400.000');
    }

    if($('.regType:checked').val() == 'SO'){

      $('#totalUSDInput').val('120');
      $('#totalIDRInput').val('');
    }

  }
  //first total

  $('#totalUSDInput').val('');
  $('#totalIDRInput').val('4.500.000');

  $('.paymentSettle').change(
      function(){
        calculatefees();
      }
  );

  
});

</script>
@endsection