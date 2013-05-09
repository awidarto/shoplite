@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('attendee/add','POST',array('class'=>'custom addAttendeeForm'))}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
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
                {{ $form->text('position','Position / Division.req','',array('class'=>'text span8','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text span8','id'=>'email')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text span8','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Registration Type</legend>
                <div class="row-fluid">
                    <div class="span6">
                        Professional / Delegate Domestic
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','IDR 4.500.000','PD',true) }} 
                    </div>   
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        Professional / Delegate Overseas
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','USD 500','PO') }} 
                    </div>   
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        Student Domestic
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','IDR 400.000','SD') }} 
                    </div>   
                </div>

                <div class="row-fluid">
                    <div class="span6">
                        Student Overseas
                    </div>   
                    <div class="span6">
                      {{ $form->radio('regtype','USD 120','SO') }} 
                    </div>   
                </div>
        </fieldset>
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
                      {{ $form->radio('golf','Yes','Yes',false) }} 
                    </div>   
                    <div class="span2">
                      {{ $form->radio('golf','No','No',true) }} 
                    </div>   
                    <div class="span8"></div>
                </div>

        </fieldset>

    </div>

    <div class="span6">

        <fieldset>
            <legend>Company Information</legend>
            {{ $form->text('company','Company / Institution.req','',array('class'=>'text span6','id'=>'companyName')) }}
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text span6','id'=>'companyNPWP')) }}

                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row-fluid inputInline">
                  
                    {{ $form->text('companyphonecountry','','',array('class'=>'text countrycodePhone','id'=>'companyPhoneCountry','placeholder'=>'Country Code')) }}
                  
                    {{ $form->text('companyphonearea','','',array('class'=>'text areacodePhone','id'=>'companyPhoneArea','placeholder'=>'Area Code')) }}
                  
                  
                    {{ $form->text('companyphone','','',array('class'=>'text codePhone','id'=>'companyPhone','placeholder'=>'Phone Number')) }}
                  
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row-fluid inputInline">
                  
                    {{ $form->text('companyfaxcountry','','',array('class'=>'text countrycodePhone','id'=>'companyPhoneCountry','placeholder'=>'Country Code')) }}
                  
                    {{ $form->text('companyfaxarea','','',array('class'=>'text areacodePhone','id'=>'companyPhoneArea','placeholder'=>'Area Code')) }}
                  
                  
                    {{ $form->text('companyfax','','',array('class'=>'text codePhone','id'=>'companyPhone','placeholder'=>'Phone Number')) }}
                  
                </div>

                {{ $form->text('address_1','Address.req','',array('class'=>'text span9','id'=>'address_1','placeholder'=>'Company Address')) }}
                {{ $form->text('address_2','','',array('class'=>'text span9','id'=>'address_2')) }}
                
                <div class="row-fluid inputInline">
                    
                        {{ $form->text('city','','',array('class'=>'text span12','id'=>'city','placeholder'=>'City')) }}
                    
                    
                        {{ $form->text('zip','','',array('class'=>'text span3','id'=>'zip','placeholder'=>'ZIP Code')) }}
                    
                </div>

                {{$form->select('country','Country of Origin',Config::get('country.countries'),array('class'=>'span12'))}}
                <br/>
                <div class="row-fluid">
                    <label class="checkbox">
                     <input type="checkbox" id="invoiceSameCheckbox"><span id="invoiceSame" class="metro-checkbox">Invoice address same with Company Address</span>
                   </label>
                </div>

        </fieldset>
        <br/>
        <fieldset>
            <legend>Invoice Address</legend>
               {{ $form->text('companyInvoice','Company / Institution.req','',array('class'=>'text span6 invAdress','id'=>'companyNameInv')) }}
                {{ $form->text('npwpInvoice','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text span6 invAdress','id'=>'companyNPWPInv')) }}
                
                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row-fluid inputInline">
                  {{ $form->text('companyphoneInvoiceCountry','','',array('class'=>'text countrycodePhone','id'=>'companyPhoneInvCountry','placeholder'=>'Country Code')) }}
                
                  {{ $form->text('companyphoneInvoiceArea','','',array('class'=>'text areacodePhone','id'=>'companyPhoneInvArea','placeholder'=>'Area Code')) }}
                
                  {{ $form->text('companyphoneInvoice','','',array('class'=>'text invAdress codePhone','id'=>'companyPhoneInv','placeholder'=>'Phone Number')) }}
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row-fluid inputInline">
                    {{ $form->text('companyfaxInvoiceCountry','','',array('class'=>'text countrycodePhone','id'=>'companyFaxInvCountry','placeholder'=>'Country Code')) }}
                    {{ $form->text('companyfaxInvoiceArea','','',array('class'=>'text areacodePhone','id'=>'companyFaxInvArea','placeholder'=>'Area Code')) }}
                    {{ $form->text('companyfaxInvoice','','',array('class'=>'text codePhone','id'=>'companyFaxInv','placeholder'=>'Phone Number')) }}
                  
                </div>

                {{ $form->text('addressInvoice_1','Address.req','',array('class'=>'text invAdress span9','id'=>'addressInv_1','placeholder'=>'Company Address')) }}
                {{ $form->text('addressInvoice_2','','',array('class'=>'text invAdress span9','id'=>'addressInv_2')) }}


                <div class="row-fluid inputInline">
                      {{ $form->text('cityInvoice','','',array('class'=>'text span12 invAdress','id'=>'cityInv','placeholder'=>'City')) }}
                      {{ $form->text('zipInvoice','','',array('class'=>'text span3 invAdress','id'=>'zipInv','placeholder'=>'ZIP Code')) }}
              
                </div>

                
                {{$form->select('countryInvoice','Country of Origin',Config::get('country.countries'),null)}}

        </fieldset>

        

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
</div>
{{$form->close()}}

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

  $("#s2id_field_countryInvoice").select2("val", "ID");
  $("#s2id_field_country").select2("val", "ID");
  
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
  
});

</script>

@endsection