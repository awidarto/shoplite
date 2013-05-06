@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('attendee/edit/'.$user['_id'],'POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}
    {{ $form->hidden('totalUSD','',array('id'=>'totalUSDInput','class'=>'paymentSettle'))}}
    {{ $form->hidden('totalIDR','',array('id'=>'totalIDRInput','class'=>'paymentSettle'))}}
    
<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row-fluid radioInput">
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr')}} 
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
                      @if($user['golf']=='Yes')
                        {{ $form->radio('golf','Yes','Yes',true,array('class'=>'paymentSettle field_golfType')) }} 
                      @else
                        {{ $form->radio('golf','Yes','Yes',false,array('class'=>'paymentSettle field_golfType')) }} 
                      @endif
                    </div>   
                    <div class="span2">
                      @if($user['golf']=='Yes')
                        {{ $form->radio('golf','No','No',false,array('class'=>'paymentSettle field_golfType')) }} 
                      @else
                        {{ $form->radio('golf','No','No',true,array('class'=>'paymentSettle field_golfType')) }} 
                      @endif
                    </div>   
                    <div class="span8"></div>
                </div>

        </fieldset>

        <fieldset>
            <legend><strong>Use Early Bird Rates</strong></legend>

                <div class="row-fluid">
                    <div class="span2">
                      @if(isset($user['overrideratenormal']) && $user['overrideratenormal']=='yes')
                        {{ $form->radio('overrideratenormal','Yes','yes',true) }} 
                      @else
                        {{ $form->radio('overrideratenormal','Yes','yes') }} 
                      @endif
                    </div>   
                    <div class="span2">
                      @if(isset($user['overrideratenormal']) && $user['overrideratenormal']=='yes')
                        {{ $form->radio('overrideratenormal','No','no') }} 
                      @else
                        {{ $form->radio('overrideratenormal','No','no',true) }} 
                      @endif
                    </div>   
                    <div class="span8"></div>
                </div>

        </fieldset>

        <fieldset>
            <legend>Notes</legend>

                {{ $form->textarea('notes','','',array('class'=>'text invAdress span10','id'=>'companyNameInv')) }}

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
                  
                    {{ $form->text('companyfaxcountry','','',array('class'=>'text countrycodePhone','id'=>'companyFaxCountry','placeholder'=>'Country Code')) }}
                  
                    {{ $form->text('companyfaxarea','','',array('class'=>'text areacodePhone','id'=>'companyFaxArea','placeholder'=>'Area Code')) }}
                  
                  
                    {{ $form->text('companyfax','','',array('class'=>'text codePhone','id'=>'companyFax','placeholder'=>'Phone Number')) }}
                  
                </div>

                {{ $form->text('address_1','Address.req','',array('class'=>'text span9','id'=>'address_1','placeholder'=>'Company Address')) }}
                {{ $form->text('address_2','','',array('class'=>'text span9','id'=>'address_2')) }}
                
                <div class="row-fluid inputInline">
                    
                        {{ $form->text('city','','',array('class'=>'text span12','id'=>'city','placeholder'=>'City')) }}
                    
                    
                        {{ $form->text('zip','','',array('class'=>'text span3','id'=>'zip','placeholder'=>'ZIP Code')) }}
                    
                </div>
                {{$form->select('country','Country of Origin',Config::get('country.countries'),null)}}
                
                <br/>
                

        </fieldset>
        <br/>
        @if ( isset($user['cache_obj']) && $user['cache_obj']!= '')
        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->textarea('invoice_address_conv','','',array('class'=>'text invAdress span10','id'=>'companyNameInv')) }}
        </fieldset>
        @else
        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->text('companyInvoice','Company / Institution.req','',array('class'=>'text span6 invAdress','id'=>'companyNameInv')) }}
                {{ $form->text('npwpInvoice','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text span6 invAdress','id'=>'companyNPWPInv')) }}
                
                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row-fluid inputInline">
                  {{ $form->text('companyphoneInvoiceCountry','','',array('class'=>'text countrycodePhone invAdress','id'=>'companyPhoneInvCountry','placeholder'=>'Country Code')) }}
                
                  {{ $form->text('companyphoneInvoiceArea','','',array('class'=>'text areacodePhone invAdress','id'=>'companyPhoneInvArea','placeholder'=>'Area Code')) }}
                
                  {{ $form->text('companyphoneInvoice','','',array('class'=>'text invAdress codePhone invAdress','id'=>'companyPhoneInv','placeholder'=>'Phone Number')) }}
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row-fluid inputInline">
                    {{ $form->text('companyfaxInvoiceCountry','','',array('class'=>'text countrycodePhone invAdress','id'=>'companyFaxInvCountry','placeholder'=>'Country Code')) }}
                    {{ $form->text('companyfaxInvoiceArea','','',array('class'=>'text areacodePhone invAdress','id'=>'companyFaxInvArea','placeholder'=>'Area Code')) }}
                    {{ $form->text('companyfaxInvoice','','',array('class'=>'text codePhone invAdress','id'=>'companyFaxInv','placeholder'=>'Phone Number')) }}
                  
                </div>

                {{ $form->text('addressInvoice_1','Address.req','',array('class'=>'text invAdress span9','id'=>'addressInv_1','placeholder'=>'Company Address')) }}
                {{ $form->text('addressInvoice_2','','',array('class'=>'text invAdress span9','id'=>'addressInv_2')) }}


                <div class="row-fluid inputInline">
                      {{ $form->text('cityInvoice','','',array('class'=>'text span12 invAdress','id'=>'cityInv','placeholder'=>'City')) }}
                      {{ $form->text('zipInvoice','','',array('class'=>'text span3 invAdress','id'=>'zipInv','placeholder'=>'ZIP Code')) }}
              
                </div>

                
                {{$form->select('countryInvoice','Country of Origin',Config::get('country.countries'),null)}}

        </fieldset>
        
        @endif

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ Form::reset('Reset',array('class'=>'button'))}}
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
</script>

<script type="text/javascript">
$(document).ready(function() {
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
  
  calculatefees();
  $('.paymentSettle').change(
      function(){
        calculatefees();
      }
  );

});
</script>

@endsection