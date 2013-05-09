@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
    @if (Session::has('notify_result'))
        <div class="alert alert-error">
             {{Session::get('notify_result')}}
        </div>
    @endif
{{$form->open('register','POST',array('class'=>'custom attendeeRegistForm'))}}

<div class="row">
    <div class="twelve columns">

        <fieldset>
            <legend>Personal Information</legend>

                {{ Form::label('salutation','Salutation')}}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('salutation','Mr','Mr',true)}}
                    </div>
                    <div class="two columns">
                      {{ $form->radio('salutation','Mrs','Mrs')}}
                    </div>
                    <div class="two columns">
                      {{ $form->radio('salutation','Ms','Ms')}}
                    </div>
                    <div class="six columns"></div>
                </div>


                {{ $form->text('firstname','First Name.req','',array('class'=>'text','id'=>'firstname')) }}
                {{ $form->text('lastname','Last Name.req','',array('class'=>'text','id'=>'lastname')) }}
                {{ $form->text('position','Position / Division.req','',array('class'=>'text','id'=>'positionname')) }}
                {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}

                {{ $form->password('pass','Password (required to access your registration profile).req','',array('class'=>'text')) }}
                {{ $form->password('repass','Repeat Password.req','',array('class'=>'text')) }}

                {{ $form->text('mobile','Mobile Phone Number','',array('class'=>'text','id'=>'mobile')) }}

        </fieldset>

        <fieldset>
            <legend>Company Information</legend>
                {{ $form->text('company','Company / Institution.req','',array('class'=>'text','id'=>'companyName')) }}
                {{ $form->text('npwp','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text','id'=>'companyNPWP')) }}

                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyphonecountry','','',array('class'=>'text','id'=>'companyPhoneCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyphonearea','','',array('class'=>'text','id'=>'companyPhoneArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyphone','','',array('class'=>'text','id'=>'companyPhone','placeholder'=>'Phone Number')) }}
                  </div>
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyfaxcountry','','',array('class'=>'text','id'=>'companyFaxCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyfaxarea','','',array('class'=>'text','id'=>'companyFaxArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyfax','','',array('class'=>'text','id'=>'companyFax','placeholder'=>'Phone Number')) }}
                  </div>
                </div>


                {{ $form->text('address_1','Address.req','',array('class'=>'text','id'=>'address_1','placeholder'=>'Company Address')) }}
                {{ $form->text('address_2','','',array('class'=>'text','id'=>'address_2')) }}

                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('city','','',array('class'=>'text','id'=>'city','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zip','','',array('class'=>'text','id'=>'zip','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>

                {{$form->select('country','Country of Origin',Config::get('country.countries'),array('class'=>'four'))}}

                <!--{{ Form::label('invoiceaddress','Invoice address same with Company Address ?') }}

                <div class="row">
                    <div class="two columns">
                      {{ $form->radio('invoiceaddress','Yes','Yes',true) }}
                    </div>
                    <div class="two columns">
                      {{ $form->radio('invoiceaddress','No','No') }}
                    </div>
                    <div class="eight columns"></div>
                </div>-->
                <div class="row">
                  <label for="checkbox2"><input type="checkbox" style="display: none;"><span class="custom checkbox" id="invoiceSame" ></span> Invoice address same with Company Address</label>
                </div>



        </fieldset>

        <fieldset>
            <legend>Invoice Address</legend>
                {{ $form->text('companyInvoice','Company / Institution.req','',array('class'=>'text invAdress','id'=>'companyNameInv')) }}
                {{ $form->text('npwpInvoice','Company NPWP ( only for Indonesian company ).req','',array('class'=>'text invAdress','id'=>'companyNPWPInv')) }}


                {{ Form::label('companyphone','Phone Number *')}}
                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyphoneInvoiceCountry','','',array('class'=>'text invAdress','id'=>'companyPhoneInvCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyphoneInvoiceArea','','',array('class'=>'text invAdress','id'=>'companyPhoneInvArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyphoneInvoice','','',array('class'=>'text invAdress','id'=>'companyPhoneInv','placeholder'=>'Phone Number')) }}
                  </div>
                </div>

                {{ Form::label('companyphone','Fax Number *')}}

                <div class="row">
                  <div class="one columns">
                    {{ $form->text('companyfaxInvoiceCountry','','',array('class'=>'text invAdress','id'=>'companyFaxInvCountry','placeholder'=>'Country Code')) }}
                  </div>
                  <div class="one columns">
                    {{ $form->text('companyfaxInvoiceArea','','',array('class'=>'text invAdress','id'=>'companyFaxInvArea','placeholder'=>'Area Code')) }}
                  </div>
                  <div class="ten columns">
                    {{ $form->text('companyfaxInvoice','','',array('class'=>'text invAdress','id'=>'companyFaxInv','placeholder'=>'Phone Number')) }}
                  </div>
                </div>

                {{ $form->text('addressInvoice_1','Address.req','',array('class'=>'text invAdress','id'=>'addressInv_1','placeholder'=>'Company Address')) }}
                {{ $form->text('addressInvoice_2','','',array('class'=>'text invAdress','id'=>'addressInv_2')) }}


                <div class="row">
                    <div class="eight columns">
                        {{ $form->text('cityInvoice','','',array('class'=>'text invAdress','id'=>'cityInv','placeholder'=>'City')) }}
                    </div>
                    <div class="three columns">
                        {{ $form->text('zipInvoice','','',array('class'=>'text invAdress','id'=>'zipInv','placeholder'=>'ZIP Code')) }}
                    </div>
                </div>

                {{$form->select('countryInvoice','Country of Origin',Config::get('country.countries'),array('class'=>'four'))}}




        </fieldset>

        <fieldset>
            <legend>Registration Type</legend>
                <div class="row">
                    <div class="four columns">
                        &nbsp;
                    </div>
                    <div class="three columns">
                      <span><strong>EARLY BIRD</strong></span></br>
                      <span>Until 15 March 2013</span>
                    </div>
                    <div class="three columns">
                      <span><strong>NORMAL RATE</strong></span></br>
                      <span>After 15 March 2013</span>
                    </div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Professional / Delegate Domestic
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtype','IDR 4.500.000','PD',true,array('class'=>'regType professional paymentSettle')) }}
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','IDR 5.000.000','PD',false,array('class'=>'disableRadio')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Professional / Delegate Overseas
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtype','USD 500','PO',false,array('class'=>'regType professional paymentSettle')) }}
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','USD 550','PD',false,array('class'=>'disableRadio')) }}
                    </div>

                </div>

                <div class="row">
                    <div class="four columns">
                        Student Domestic
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtype','IDR 400.000','SD',false,array('class'=>'regType student paymentSettle')) }}
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','IDR 400.000','PD',false,array('class'=>'disableRadio')) }}
                    </div>
                </div>

                <div class="row">
                    <div class="four columns">
                        Student Overseas
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtype','USD 120','SO',false,array('class'=>'regType student paymentSettle')) }}
                    </div>
                    <div class="three columns">
                      {{ $form->radio('regtypeNormal','USD 120','PD',false,array('class'=>'disableRadio')) }}
                    </div>
                </div>
        </fieldset>

        <fieldset>
          <legend>The registration fee includes:</legend>
          <div class="row">
              <p>Admission to all Plenary and Technical sessions, Conference Kits, entrance to exhibition area, Opening Ceremony, Lunches, Coffee Breaks, Exhibition Cocktail, Industry Dinner, and Closing Ceremony.</p>
          </div>

        </fieldset>

        <fieldset>
          <legend>I will attend the Industrial Dinner on 16 May 2013</legend>
          <div class="row">
              <div class="two columns">
                {{ $form->radio('attenddinner','Yes','Yes',true) }}
              </div>
              <div class="two columns">
                {{ $form->radio('attenddinner','No','No') }}
              </div>
              <div class="eight columns"></div>
          </div>

        </fieldset>

        <fieldset>
          <legend>I need Invitation Letter from IPA Committee for Visa arrangement<br/>(for international participants only)  </legend>
          <div class="row">
              <div class="two columns">
                {{ $form->radio('inv_letter','Yes','Yes') }}
              </div>
              <div class="two columns">
                {{ $form->radio('inv_letter','No','No',true) }}
              </div>
              <div class="eight columns"></div>
          </div>

        </fieldset>



      @if($golfcount < Config::get('eventreg.golfquota'))


        <fieldset id="golfEvent">
          <legend>Golf Tournament</legend>


            <div class="row">
                <div class="four columns">
                    PONDOK INDAH GOLF<br/>
                    (12 May 2013)<br/><br/>
                    IDR 2.500.000,-/person<br/>
                    <br/>
                    Golf quota remaining: <strong>{{ Config::get('eventreg.golfquota') - $golfcount }}</strong>
                    <br/>
                    <br/>
                </div>

                <div class="three columns">
                  {{ $form->radio('golf','Yes','Yes',false,array('class'=>'field_golfType golfYes paymentSettle')) }}
                </div>
                <div class="three columns">
                  {{ $form->radio('golf','No','No',true,array('class'=>'field_golfType golfNo paymentSettle')) }}
                </div>

            </div>
        </fieldset>

      @endif

      <fieldset>
          <legend>Payment Settlement</legend>
          <div class="four columns"><span>REGISTRATION FEE TOTAL</span></div>
          <div class="three-small columns">
            <span style="width:30%;position:relative;display:inline-block;border-bottom:1px solid #959595;padding-bottom:5px;">USD</span><span style="width:70%;position:relative;display:inline-block;text-align:right;border-bottom:1px solid #959595;padding-bottom:5px;font-weight:bold;" id="feeRegUSD">&nbsp;</span>
          </div>
          <div class="three-small columns">
            <span style="width:30%;position:relative;display:inline-block;border-bottom:1px solid #959595;padding-bottom:5px;">IDR</span><span style="width:70%;position:relative;display:inline-block;text-align:right;border-bottom:1px solid #959595;padding-bottom:5px;font-weight:bold;" id="feeRegIDR">&nbsp;</span>
          </div>
          <br/>
          <br/>
          <div class="four columns" style="margin-top:10px;"><span>GOLF TOTAL</span></div>
          <div class="three-small columns" style="margin-top:10px;">
            <span style="width:30%;position:relative;display:inline-block;padding-bottom:5px;">&nbsp;</span><span style="width:70%;position:relative;display:inline-block;text-align:right;padding-bottom:5px;font-weight:bold;">&nbsp;</span>
          </div>
          <div class="three-small columns" style="margin-top:10px;">
            <span style="width:30%;position:relative;display:inline-block;border-bottom:1px solid #959595;padding-bottom:5px;">IDR</span><span style="width:70%;position:relative;display:inline-block;text-align:right;border-bottom:1px solid #959595;padding-bottom:5px;font-weight:bold;"id="feeGolf">&nbsp;</span>
          </div>

          <div class="four columns" style="margin-top:10px;font-weight:bold;text-align:right;"><span>GRAND TOTAL&nbsp;&nbsp;&nbsp;</span></div>
          <div class="three-small columns" style="margin-top:10px;">
            <span style="width:30%;position:relative;display:inline-block;border-bottom:1px solid #232323;padding-bottom:5px;">USD</span><span style="width:70%;position:relative;display:inline-block;text-align:right;border-bottom:1px solid #232323;padding-bottom:5px;font-weight:bold;" id="totalUSD">&nbsp;</span>
          </div>
          <div class="three-small columns" style="margin-top:10px;">
            <span style="width:30%;position:relative;display:inline-block;border-bottom:1px solid #232323;padding-bottom:5px;">IDR</span><span style="width:70%;position:relative;display:inline-block;text-align:right;border-bottom:1px solid #232323;padding-bottom:5px;font-weight:bold;" id="totalIDR">&nbsp;</span>
          </div>
          
          <div class="clear" style="clear:both;margin:0;padding:0;"></div>
          <p style="display:block;margin-top:20px;"><strong><i>*Fees above exclude VAT 10%</i></strong></p>
          <!--<table class="row">
            <tr>
              <td colspan="4" class="columns">REGISTRATION FEE TOTAL</td>
              <td class="columns">USD</td>
              <td class="columns">500</td>

              <td class=" columns">IDR</td>
              <td class=" columns">500</td>
            </tr>

            <tr>
              <td colspan="4" class="four columns">GOLF TOTAL</td>
              <td class=" columns">&nbsp;</td>
              <td class=" columns">&nbsp;</td>

              <td class=" columns">IDR</td>
              <td class=" columns">500</td>
            </tr>

            <tr>
              <td colspan="4" class="four columns">GRAND TOTAL</td>
              <td class=" columns">&nbsp;</td>
              <td class=" columns">&nbsp;</td>

              <td class=" columns">IDR</td>
              <td class=" columns">500</td>

              <td colspan="4" style="text-align:right;">GRAND TOTAL</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>&nbsp;</td>
              <td>IDR</td>
              <td>2.500.000</td>
            </tr>

          </table>-->

        </fieldset>

        <fieldset>


              <h4>PAYMENT METHOD</h4>
              <span><strong>Bank Transfer</strong></span>
              <div class="row">
                <div class="six columns mobile-six">
                  <strong>IDR Account:</strong><br/>
                  <ul id="accountBankDetails">
                  <li>BCA - Mangga Dua Branch<br/>
                  Acc. No. : 335.302.7677<br/>
                  Acc. Name : PT Dyandra Promosindo<br/></li>
                  <li>Mandiri - Wisma Nusantara Branch<br/>
                  Acc. No.  : 103.000.1065180<br/>
                  Acc. Name : PT Dyandra Promosindo<br/></li>

                </div>

                <div class="six columns mobile-six" style="padding-left:15px;">
                  <p><strong>USD Account:</strong><br/>
                  BCA - Wisma Nusantara Branch<br/>
                  Acc. No. : 734.038.5700<br/>
                  Acc. Name : PT Dyandra Promosindo<br/>
                  Swiftcode : CENAIDJA
                  </p>
                </div>

                <div class="twelve columns">
                  
                  <p><strong><i>Payment should be made in FULL AMOUNT. Please change your payment status and upload copy of your bank transfer once the payment settled.</i></strong></p>
                  <p><strong><i>Payment by credit card (VISA/MASTER CARD) accepted on-site </i></strong></p>
                </div>
              </div>
              <hr/>
              <h4>IMPORTANT NOTES</h4>
              <ol>
                <li><strong>Early Bird scheme applies to those who have registered and have settled payment by 15 March 2013 at the latest.</strong> Normal rate will be applied for the registration payment after 15 March 2013.</li>
                <li>Registration Forms received without registration fees will not be processed. </li>
                <li><strong>No refund will be granted for cancellation after 14 April 2013.</strong> All cancellations must be made in writing to the Convention Secretariat and the refund for cancellations before 14 April 2013 will be made after the convention.</li>
                <li><strong>Convention registration payment deadline is 30 April 2013.</strong></li>
                <li>For those who <strong>participate in golf tournament, the payment must be settled before 14 April 2013.</strong></li>
              </ol>

        </fieldset>

    </div>
</div>

<hr />

<div class="row right">
{{ Form::submit('Submit',array('class'=>'button'))}}&nbsp;&nbsp;
{{ HTML::link($back,'Cancel',array('class'=>'btn'))}}
</div>
{{$form->close()}}

<script type="text/javascript">
  $('select').select2();

  $('#field_role').change(function(){
      //alert($('#field_role').val());
      // load default permission here
  });
</script>

<script type="text/javascript">
$(function() {

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
    }

    if($('.regType:checked').val() == 'PD'){
      //alert($('.field_golfType:checked').val());
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
  $('#feeRegUSD').text('-');
  $('#feeRegIDR').text('4.500.000');
  $('#feeGolf').text('-');
  $('#totalUSD').text('-');
  $('#totalIDR').text('4.500.000');
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