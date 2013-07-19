@layout('public')


@section('content')
@if (Session::has('notify_result'))
    <div class="alert alert-error">
         {{Session::get('notify_result')}}
    </div>
@endif
{{$form->open('myprofile/edit','POST')}}

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

                {{ Form::label('email','Email')}}<br />
                <h4 style="margin-top: -15px">{{ $user['email']}}</h4>

                {{ $form->text('address_1','Address.req','',array('class'=>'text','id'=>'address_1','placeholder'=>'Address line 1')) }}<br />
                {{ $form->text('address_2','','',array('class'=>'text','id'=>'address_2','placeholder'=>'Address line 2')) }}
                {{ $form->text('city','City','',array('class'=>'text','id'=>'city')) }}
                {{ $form->text('zip','ZIP','',array('class'=>'text','id'=>'zip')) }}

                {{$form->select('country','Country',Config::get('country.countries'),null,array('class'=>'four'))}}

                {{ $form->text('shippingphone','Phone Number','',array('class'=>'text','id'=>'mobile')) }}

                {{ $form->text('mobile','Mobile Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>
    </div>

    <div class="span6">

        <fieldset>
            <legend>Bank Transfer Payment Information</legend>
                {{ $form->text('fullname','Full Name','',array('class'=>'text','id'=>'fullname')) }}
                {{ $form->text('bankname','Bank Name','',array('class'=>'text','id'=>'bankname')) }}
                {{ $form->text('branch','Branch','',array('class'=>'text','id'=>'branch')) }}
                {{ $form->text('accountnumber','Account Number','',array('class'=>'text','id'=>'accountnumber')) }}
        </fieldset>

        <?php
        /*
        <fieldset>
            <legend>Credit Card</legend>

                {{ $form->text('ccname','Name on Card','',array('class'=>'text','id'=>'ccname')) }}
                {{ $form->text('cardnumber','Card Number','',array('class'=>'text','id'=>'cardnumber')) }}
                {{ $form->text('branch','CVS / CVC','',array('class'=>'text','id'=>'branch')) }}
                {{ $form->text('expiremonth','Expiration date','',array('class'=>'text','id'=>'cardnumber','placeholder'=>'mm')) }}

                {{ $form->text('expireyear','','',array('class'=>'text','id'=>'cardnumber','placeholder'=>'yyyy')) }}
        </fieldset>

        */
        ?>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Update Profile</button>
          <a type="button" class="btn" href="{{ URL::to('myprofile') }}" >Cancel</a>
        </div>

    </div>
</div>

{{$form->close()}}

<script type="text/javascript">
  $( document ).ready(function() {

  });
</script>

@endsection