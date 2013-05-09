@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
  <div class="attendeeNav">
    <span><strong>Notes:</strong></span>
    <br/>
    <br/>
    <ul style="margin-left:20px;">
      <li style="padding-bottom:3px;;">Credit card charge: 3% + 2,200 IDR</li>
      <li>Payment by credit card is normally charged in local currency. The exchange rate used for The 37th IPA Convex is USD 1 = IDR 9,800.</li>
    </ul>
  </div>
</div>
<div id="notifier">
</div>
    @if (Session::has('notify_result'))
        <div class="alert alert-error">
             {{Session::get('notify_result')}}
        </div>
    @endif
{{$form->open('','POST',array('class'=>'custom attendeeRegistForm','id'=>'checkOutform'))}}

<div class="row">
    <div class="twelve columns">

      <fieldset>
          <legend>Payment Information</legend>

              {{ $form->text('name_on_card','Name on Card.req','',array('class'=>'text','id'=>'firstname')) }}

              {{ $form->text('first_name','First Name.req','',array('class'=>'text','id'=>'firstname')) }}
              {{ $form->text('last_name','Last Name.req','',array('class'=>'text','id'=>'lastname')) }}

              {{ $form->text('date_birth','Date of Birth','',array('class'=>'text date','id'=>'date_birth')) }}

              {{ $form->textarea('address','Card Address.req','',array('class'=>'text','id'=>'address','placeholder'=>'Address')) }}

              <div class="row">
                  <div class="eight columns">
                      {{ $form->text('city','','',array('class'=>'text','id'=>'city','placeholder'=>'City')) }}
                  </div>
                  <div class="three columns">
                      {{ $form->text('zip','','',array('class'=>'text','id'=>'zip','placeholder'=>'ZIP Code')) }}
                  </div>
              </div>

              {{ $form->text('contact_phone','Contact Phone Number.req','',array('class'=>'text','id'=>'contact_phone')) }}

              <div class="row">
                <label for="checkbox2"><input type="checkbox" style="display: none;"><span class="custom checkbox" id="invoiceSame" ></span> Billing Address same with Card Address</label>
              </div>

              {{ $form->textarea('billing_address','Billing Address.req','',array('class'=>'text billingaddr','id'=>'address_1','placeholder'=>'Billing Address')) }}

              <div class="row">
                  <div class="eight columns">
                      {{ $form->text('billing_city','','',array('class'=>'text billingaddr','id'=>'billing_city','placeholder'=>'City')) }}
                  </div>
                  <div class="three columns">
                      {{ $form->text('billing_zip','','',array('class'=>'text billingaddr','id'=>'billing_zip','placeholder'=>'ZIP Code')) }}
                  </div>
              </div>


              {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

              {{ $form->text('mobile_phone','Mobile Phone Number.req','',array('class'=>'text','id'=>'mobile_phone')) }}

              {{ $form->text('home_phone','Home Phone Number.req','',array('class'=>'text','id'=>'home_phone')) }}

              {{ $form->text('work_phone','Work Phone Number.req','',array('class'=>'text','id'=>'work_phone')) }}


      </fieldset>

      <hr />

      <div class="row right">
      {{ Form::submit('Submit Payment',array('class'=>'button','id'=>'doaction'))}}&nbsp;&nbsp;
      {{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
      </div>

    </div>
</div>

{{$form->close()}}

<script type="text/javascript">

  $(document).ready(function() { 
      var options = { 
          target:        '#notifier',   // target element(s) to be updated with server response 
          beforeSubmit:  preSubmission,  // pre-submit callback 
          success:       postSubmission,  // post-submit callback 
          url: '{{ URL::to($ajaxpost) }}',
          dataType:  'json'
   
          // other available options: 
          //url:       url         // override for form's 'action' attribute 
          //type:      type        // 'get' or 'post', override for form's 'method' attribute 
          //dataType:  'json',        // 'xml', 'script', or 'json' (expected server response type) 
          //clearForm: true        // clear all form fields after successful submit 
          //resetForm: true        // reset the form after successful submit 
   
          // $.ajax options can be used here too, for example: 
          //timeout:   3000 
      }; 
   
      // bind to the form's submit event 
      $('#checkOutform').submit(function() { 
          // inside event callbacks 'this' is the DOM element so we first 
          // wrap it in a jQuery object and then invoke ajaxSubmit 

          $('.error').remove();

          $(this).ajaxSubmit(options); 
   
          // !!! Important !!! 
          // always return false to prevent standard browser submit and page navigation 
          return false; 
      }); 

    $('select').select2();

    $('#field_role').change(function(){
        //alert($('#field_role').val());
        // load default permission here
    });

    function preSubmission(formData, jqForm, options){
        var queryString = $.param(formData); 
     
        // jqForm is a jQuery object encapsulating the form element.  To access the 
        // DOM element for the form do this: 
        // var formElement = jqForm[0]; 
      
      $('#notifier').html('Processing...');  
         
        // here we could return false to prevent the form from being submitted; 
        // returning anything other than false will allow the form submit to continue 
        return true; 

    }
     
    // post-submit callback 
    function postSubmission(responseObj, statusText, xhr, $form)  { 
        // for normal html responses, the first argument to the success callback 
        // is the XMLHttpRequest object's responseText property 
     
        // if the ajaxSubmit method was passed an Options Object with the dataType 
        // property set to 'xml' then the first argument to the success callback 
        // is the XMLHttpRequest object's responseXML property 
     
        // if the ajaxSubmit method was passed an Options Object with the dataType 
        // property set to 'json' then the first argument to the success callback 
        // is the json data object returned by the server 
        var data = responseObj;

      if(data.status == 'OK'){
        $('#notifier').html(data.description);

        window.location = data.redirect;

      }else if(data.status == 'ERR:VALIDATION'){

        //console.log(data.description.messages);
        for(var prop in data.description.messages){
          //console.log(prop);
          //console.log(data.description.messages[prop]);

          var err = data.description.messages[prop][0];

          $('input[name='+prop+']').after('<span class="error">' + err + '</span>');
          $('textarea[name='+prop+']').after('<span class="error">' + err + '</span>');

        }

        $('#notifier').html('');
      }else{
        $('#notifier').html(data.description);
      }

    } 

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
    
    var cardaddress = $("#address").val();
    var companyCity = $("#city").val();
    var companyZip = $("#zip").val();
    

    $("#address_1").val(cardaddress);
    $("#billing_city").val(companyCity);
    $("#billing_zip").val(companyZip);
    
  }

  function resetinput(){
    $('.billingaddr')
     .not(':button, :submit, :reset, :hidden')
     .val('')
     .removeAttr('checked')
     .removeAttr('selected');
     
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

  $(".regType").next('span').addClass('regTypeRecord');
  $('.field_golfType').next('span').addClass('golfCheckBox');
  $('.golfNo').next('span').addClass('golfNoCheckBox');
  $('.golfYes').next('span').addClass('golfYesCheckBox');

  $(".professional").next('span').addClass('professional');
  $(".student").next('span').addClass('student');

  $('.regType').change(
      function(){
        golfDisable();
          //alert($('.paymentSettle:checked').val());   
      }
  );

  function golfDisable(){

    if($('.regType:checked').val() == 'SD'){
      $('.golfYes').attr("disabled", true);
      
      if($('.field_golfType:checked').val() == 'Yes'){
        $('.golfYes').attr('checked',false);
        $('.golfNo').attr('checked',true);
        $('.golfYesCheckBox').removeClass('checked');
        $('.golfNoCheckBox').addClass('checked');
      }

    }else if($('.regType:checked').val() == 'SO'){
      $('.golfYes').attr("disabled", true);
      
      if($('.field_golfType:checked').val() == 'Yes'){
        $('.golfYes').attr('checked',false);
        $('.golfNo').attr('checked',true);
        $('.golfYesCheckBox').removeClass('checked');
        $('.golfNoCheckBox').addClass('checked');
      }


    }else if($('.regType:checked').val() == 'PD'){
      $(".golfYes").removeAttr('disabled');
    }else if($('.regType:checked').val() == 'PO'){
      $(".golfYes").removeAttr('disabled');
    }

    
  }

  
  function calculatefees(){
    var regfeeIDR = '400';
    var regfeeUSD = '';
    var Golffee   = '2.500.000';
    var totalUSD   = '';
    var totalIDR   = '';
    

    if($('.regType:checked').val() == 'PO'){
      <?php //check date first
      if(strtotime($dateA) > strtotime($earlybirddate)):
      ?>
        //alert($('.field_golfType:checked').val());
        if($('.field_golfType:checked').val() == 'No'){
          $('#feeRegUSD').text('550');
          $('#feeRegIDR').text('-');
          $('#feeGolf').text('-');
          $('#totalUSD').text('550');
          $('#totalIDR').text('-');
          $('#totalUSDInput').val('550');
          $('#totalIDRInput').val('-');
        }else{
          //alert($('.field_golfType:checked').val());
          $('#feeRegUSD').text('550');
          $('#feeRegIDR').text('-');
          $('#feeGolf').text('2.500.000');
          $('#totalUSD').text('550');
          $('#totalIDR').text('2.500.000');
          $('#totalUSDInput').val('550');
          $('#totalIDRInput').val('2.500.000');
          
        }
      <?php else:?>
        //alert($('.field_golfType:checked').val());
        if($('.field_golfType:checked').val() == 'No'){
          $('#feeRegUSD').text('500');
          $('#feeRegIDR').text('-');
          $('#feeGolf').text('-');
          $('#totalUSD').text('500');
          $('#totalIDR').text('-');
          $('#totalUSDInput').val('500');
          $('#totalIDRInput').val('-');
        }else{
          //alert($('.field_golfType:checked').val());
          $('#feeRegUSD').text('500');
          $('#feeRegIDR').text('-');
          $('#feeGolf').text('2.500.000');
          $('#totalUSD').text('500');
          $('#totalIDR').text('2.500.000');
          $('#totalUSDInput').val('500');
          $('#totalIDRInput').val('2.500.000');
          
        }
      <?php endif;?>
    }

    if($('.regType:checked').val() == 'PD'){
      <?php //check date first
      if(strtotime($dateA) > strtotime($earlybirddate)):
      ?>
        if($('.field_golfType:checked').val() == 'No'){
          $('#feeRegUSD').text('-');
          $('#feeRegIDR').text('5.000.000');
          $('#feeGolf').text('-');
          $('#totalUSD').text('-');
          $('#totalIDR').text('5.000.000');
          $('#totalUSDInput').val('-');
          $('#totalIDRInput').val('5.000.000');

        }else{
          // /alert($('.field_golfType:checked').val());
          $('#feeRegIDR').text('5.000.000');
          $('#feeRegUSD').text('-');
          $('#feeGolf').text('2.500.000');
          $('#totalUSD').text('-');
          $('#totalIDR').text('7.500.000');
          $('#totalUSDInput').val('-');
          $('#totalIDRInput').val('7.500.000');
        }
      <?php else:?>
        if($('.field_golfType:checked').val() == 'No'){
          $('#feeRegUSD').text('-');
          $('#feeRegIDR').text('4.500.000');
          $('#feeGolf').text('-');
          $('#totalUSD').text('-');
          $('#totalIDR').text('4.500.000');
          $('#totalUSDInput').val('-');
          $('#totalIDRInput').val('4.500.000');

        }else{
          // /alert($('.field_golfType:checked').val());
          $('#feeRegIDR').text('4.500.000');
          $('#feeRegUSD').text('-');
          $('#feeGolf').text('2.500.000');
          $('#totalUSD').text('-');
          $('#totalIDR').text('7.000.000');
          $('#totalUSDInput').val('-');
          $('#totalIDRInput').val('7.000.000');
        }
      <?php endif;?>
    }

    if($('.regType:checked').val() == 'SD'){
      $('#feeRegUSD').text('-');
      $('#feeRegIDR').text('400.000');
      $('#feeGolf').text('-');
      $('#totalUSD').text('-');
      $('#totalIDR').text('400.000');
      $('#totalUSDInput').val('-');
      $('#totalIDRInput').val('400.000');
    }

    if($('.regType:checked').val() == 'SO'){
      $('#feeRegUSD').text('120');
      $('#feeRegIDR').text('-');
      $('#feeGolf').text('-');
      $('#totalUSD').text('120');
      $('#totalIDR').text('-');
      $('#totalUSDInput').val('120');
      $('#totalIDRInput').val('');
    }

  }
  //first total

  <?php //check date first
    
    if(strtotime($dateA) > strtotime($earlybirddate)):
  ?>
    
    $('#feeRegUSD').text('-');
    $('#feeRegIDR').text('5.000.000');
    $('#feeGolf').text('-');
    $('#totalUSD').text('-');
    $('#totalIDR').text('5.000.000');
    $('#totalUSDInput').val('');
    $('#totalIDRInput').val('5.000.000');
  <?php else:?>
    $('#feeRegUSD').text('-');
    $('#feeRegIDR').text('4.500.000');
    $('#feeGolf').text('-');
    $('#totalUSD').text('-');
    $('#totalIDR').text('4.500.000');
    $('#totalUSDInput').val('');
    $('#totalIDRInput').val('4.500.000');

  <?php endif;?> 

  $('.paymentSettle').change(
      function(){
        calculatefees();
      }
  );







});

</script>

@endsection