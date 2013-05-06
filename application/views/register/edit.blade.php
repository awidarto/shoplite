@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>

{{$form->open('myprofile/edit','POST',array('class'=>'custom'))}}

{{ $form->hidden('id',$user['_id'])}}
    
<div class="row">
    <div class="span6">

        <fieldset>
            <legend>Billing & Shipping Information</legend>


                <div class="row">
                    <div class="span6">
                      Salutation
                    </div>
                    <div class="span2">
                      {{ $form->radio('salutation','Mr','Mr',true)}}
                    </div>
                    <div class="span2">
                      {{ $form->radio('salutation','Mrs','Mrs')}}
                    </div>
                    <div class="span2">
                      {{ $form->radio('salutation','Ms','Ms')}}
                    </div>
                </div>


                {{ $form->text('firstname','First Name.req','',array('class'=>'text','id'=>'firstname')) }}
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text','id'=>'lastname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

                {{ $form->password('pass','Password.req','',array('class'=>'text')) }}
                {{ $form->password('repass','Repeat Password.req','',array('class'=>'text')) }}

                {{ $form->text('address_1','Address.req','',array('class'=>'text','id'=>'address_1','placeholder'=>'Address line 1')) }}
                {{ $form->text('address_2','','',array('class'=>'text','id'=>'address_2','placeholder'=>'Address line 2')) }}
                {{ $form->text('city','City','',array('class'=>'text','id'=>'city')) }}
                {{ $form->text('zip','ZIP','',array('class'=>'text','id'=>'zip')) }}

                {{$form->select('country','Country',Config::get('country.countries'),array('class'=>'four'))}}

                {{ $form->text('shippingphone','Phone Number','',array('class'=>'text','id'=>'mobile')) }}

                {{ $form->text('mobile','Mobile Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>
    </div>

    <div class="span6">

        <fieldset>
            <legend>Transfer Payment Information</legend>
                {{ $form->text('fullname','Full Name','',array('class'=>'text','id'=>'fullname')) }}
                {{ $form->text('bankname','Bank Name','',array('class'=>'text','id'=>'bankname')) }}
                {{ $form->text('branch','Branch','',array('class'=>'text','id'=>'branch')) }}
                {{ $form->text('cardnumber','Card Number','',array('class'=>'text','id'=>'cardnumber')) }}
        </fieldset>

        <fieldset>
            <legend>Credit Card</legend>

                {{ $form->text('ccname','Name on Card','',array('class'=>'text','id'=>'ccname')) }}
                {{ $form->text('cardnumber','Card Number','',array('class'=>'text','id'=>'cardnumber')) }}
                {{ $form->text('branch','CVS / CVC','',array('class'=>'text','id'=>'branch')) }}
                {{ $form->text('expiremonth','Expiration date','',array('class'=>'text','id'=>'cardnumber','placeholder'=>'mm')) }}

                {{ $form->text('expireyear','','',array('class'=>'text','id'=>'cardnumber','placeholder'=>'yyyy')) }}


        </fieldset>

        <fieldset>
            <legend>Paypal</legend>



        </fieldset>

        <fieldset>
            <legend>Terms & Conditions</legend>
          {{ $form->checkbox('agreetnc','I Agree to the Peach to Black terms and conditions ',false,false,array('id'=>'agreetnc'))}}

          {{ $form->checkbox('saveinfo','Save my payment info and preference for future purchase',false,false,array('id'=>'agreetnc'))}}


        </fieldset>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Sign Up</button>
          <button type="button" class="btn">Cancel</button>
        </div>

    </div>
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