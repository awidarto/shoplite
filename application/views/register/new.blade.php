@layout('public')


@section('content')
@if (Session::has('notify_result'))
    <div class="alert alert-error">
         {{Session::get('notify_result')}}
    </div>
@endif
{{$form->open('register','POST')}}

<div class="row">
    <div class="span6">

        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row">
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


                {{ $form->text('firstname','First Name.req','',array('class'=>'text','id'=>'firstname')) }}
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text','id'=>'lastname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

                {{ $form->password('pass','Password (required to access your registration profile).req','',array('class'=>'text')) }}
                {{ $form->password('repass','Repeat Password.req','',array('class'=>'text')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>

    </div>

    <div class="span6">

        <fieldset>
            <legend>Shipping Information</legend>

                {{ $form->text('shippingphone','Shipping Phone Number','',array('class'=>'text','id'=>'mobile')) }}

                {{ $form->text('address_1','Address.req','',array('class'=>'text','id'=>'address_1','placeholder'=>'Company Address')) }}
                {{ $form->text('address_2','','',array('class'=>'text','id'=>'address_2')) }}
                {{ $form->text('city','City','',array('class'=>'text','id'=>'city')) }}
                {{ $form->text('zip','ZIP','',array('class'=>'text','id'=>'zip')) }}

                {{$form->select('country','Country of Origin',Config::get('country.countries'),array('class'=>'four'))}}

        </fieldset>
    </div>
</div>

<div class="form-actions">
  <button type="submit" class="btn btn-primary">Sign Up</button>
  <button type="button" class="btn">Cancel</button>
</div>
{{$form->close()}}

<script type="text/javascript">
  $( document ).ready(function() {
    $('select').select2({
        width : 'resolve'
      });
  });
</script>

<script type="text/javascript">

<?php 
  $dateA = date('Y-m-d G:i'); 
  $earlybirddate = Config::get('eventreg.earlybirdconventiondate'); 
?>
$(function() {

  $("#s2id_field_countryInvoice").select2("val", "Indonesia");
  $("#s2id_field_country").select2("val", "Indonesia");

  function fillsame(){
    var shippingName = $("#shippingName").val();
    var shippingNPWP = $("#shippingNPWP").val();
    var shippingPhoneCountry = $("#shippingPhoneCountry").val();
    var shippingPhoneArea = $("#shippingPhoneArea").val();
    var shippingPhone = $("#shippingPhone").val();


    var shippingFaxCountry = $("#shippingFaxCountry").val();
    var shippingFaxArea = $("#shippingFaxArea").val();
    var shippingFax = $("#shippingFax").val();
    var shippingAddress_1 = $("#address_1").val();
    var shippingAddress_2 = $("#address_2").val();
    var shippingCity = $("#city").val();
    var shippingZip = $("#zip").val();
    var shippingCountry = $("#s2id_field_country").select2("val");

    $("#shippingNameInv").val(shippingName);
    $("#shippingNPWPInv").val(shippingNPWP);

    $("#shippingPhoneInvCountry").val(shippingPhoneCountry);
    $("#shippingPhoneInvArea").val(shippingPhoneArea);
    $("#shippingPhoneInv").val(shippingPhone);


    $("#shippingFaxInvCountry").val(shippingFaxCountry);
    $("#shippingFaxInvArea").val(shippingFaxArea);
    $("#shippingFaxInv").val(shippingFax);

    $("#addressInv_1").val(shippingAddress_1);
    $("#addressInv_2").val(shippingAddress_2);
    $("#cityInv").val(shippingCity);
    $("#zipInv").val(shippingZip);
    $("#s2id_field_countryInvoice").select2("val", shippingCountry);
  }

  function resetinput(){
    $('.invAdress')
     .not(':button, :submit, :reset, :hidden')
     .val('')
     .removeAttr('checked')
     .removeAttr('selected');
      $("#s2id_field_countryInvoice").select2("val", "");
  }

  $("#invoiceSame").live("click", function(){
    if($('#invoiceSame').hasClass('checked')){
      fillsame();

    }else{
      resetinput();
    }
  });
  $(".disableRadio").next('span').addClass('radioDisable');

  $(".radioDisable").live("click", function(){
    $(this).removeClass('checked');
  });


});

</script>

@endsection