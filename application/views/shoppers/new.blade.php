@layout('master')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open_for_files($submit,'POST',array('class'=>'custom addAttendeeForm'))}}

<div class="row-fluid">
  <div class="span6 left">

            <h4>Billing & Shipping Information</h4>

                <div class="row-fluid">
                    <div class="span2">
                      Salutation
                    </div>
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr',true)}}
                    </div>
                    <div class="span2">
                      {{ $form->radio('salutation','Mrs','Mrs')}}
                    </div>
                    <div class="span6">
                      {{ $form->radio('salutation','Ms','Ms')}}
                    </div>
                </div>


                {{ $form->text('firstname','First Name.req','',array('class'=>'text span8','id'=>'firstname')) }}
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text span8','id'=>'lastname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text span8','id'=>'email')) }}

                {{ $form->password('pass','Password.req','',array('class'=>'text span8')) }}
                {{ $form->password('repass','Repeat Password.req','',array('class'=>'text span8')) }}

                {{ $form->text('address_1','Address.req','',array('class'=>'text span8','id'=>'address_1','placeholder'=>'Address line 1')) }}
                {{ $form->text('address_2','','',array('class'=>'text span8','id'=>'address_2','placeholder'=>'Address line 2')) }}
                {{ $form->text('city','City','',array('class'=>'text span8','id'=>'city')) }}
                {{ $form->text('zip','ZIP','',array('class'=>'text span8','id'=>'zip')) }}

                {{$form->select('country','Country',Config::get('country.countries'),array('class'=>'four'))}}

                {{ $form->text('shippingphone','Phone Number','',array('class'=>'text span8','id'=>'mobile')) }}

                {{ $form->text('mobile','Mobile Number','',array('class'=>'text span8','id'=>'mobile')) }}

  </div>
  <div class="span5 right">

        <fieldset>
            <legend>Transfer Payment Information</legend>
                {{ $form->text('fullname','Full Name','',array('class'=>'text span8','id'=>'fullname')) }}
                {{ $form->text('bankname','Bank Name','',array('class'=>'text span8','id'=>'bankname')) }}
                {{ $form->text('branch','Branch','',array('class'=>'text span8','id'=>'branch')) }}
                {{ $form->text('cardnumber','Card Number','',array('class'=>'text span8','id'=>'cardnumber')) }}
        </fieldset>

        <fieldset>
            <legend>Credit Card</legend>

                {{ $form->text('ccname','Name on Card','',array('class'=>'text span8','id'=>'ccname')) }}
                {{ $form->text('cardnumber','Card Number','',array('class'=>'text input-xlarge','id'=>'cardnumber')) }}
                {{ $form->text('branch','CVS / CVC','',array('class'=>'text input-small','id'=>'branch')) }}
                <div class="row-fluid">
                  <div class="span3">
                    {{ $form->text('expiremonth','Expiration Month','',array('class'=>'text input-small','id'=>'cardnumber','placeholder'=>'mm')) }}
                  </div>
                  <div class="span3">
                    {{ $form->text('expireyear','Year','',array('class'=>'text input-small','id'=>'cardnumber','placeholder'=>'yyyy')) }}
                  </div>
                </div>


        </fieldset>

        <fieldset>
            <legend>Paypal</legend>



        </fieldset>

        <fieldset>
            <legend>Terms & Conditions</legend>
          {{ $form->checkbox('agreetnc','I Agree to the '.Config::get('site.title').' terms and conditions ','Yes',false,array('id'=>'agreetnc'))}}

          {{ $form->checkbox('saveinfo','Save my payment info and preference for future purchase','Yes',false,array('id'=>'agreetnc'))}}



  </div>
</div>
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

@endsection