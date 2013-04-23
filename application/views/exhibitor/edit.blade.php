@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('exhibitor/edit/'.$user['_id'],'POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$user['_id'])}}
    {{ $form->hidden('registrationnumber',$user['registrationnumber'])}}
<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Booth Detail</legend>
            
            {{ $form->hidden('hallid','',array('id'=>'hallid'))}}
            {{ $form->text('hall','Hall ( autocomplete, use Hall name to search ).req','',array('id'=>'hallName','class'=>'auto_hall span8'))}}
            {{-- $form->text('hall','Hall.req','',array('class'=>'text span8','id'=>'firstname')) --}}
            
            {{ $form->hidden('boothid','',array('id'=>'boothid'))}}
            {{ $form->text('booth','Booth No. (autocomplete).req','',array('id'=>'boothName','class'=>'auto_booth'))}}
            
        </fieldset>
        <fieldset>
            <legend>Person in Charge Details</legend>
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
    </div>
    <div class="span6">
      <legend>Company Information</legend>
      {{ $form->text('company','Company.req','',array('class'=>'text span8','id'=>'positionname')) }}

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
    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Save',array('class'=>'button'))}}&nbsp;&nbsp;
{{ Form::reset('Reset',array('class'=>'button'))}}
</div>

<script type="text/javascript">
  $('select').select2({
    width : 'resolve'
  });

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>



@endsection