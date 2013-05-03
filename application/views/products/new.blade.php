@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open_for_files($submit,'POST',array('class'=>'custom addAttendeeForm'))}}

<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Product Information</legend>
                
                {{ $form->text('name','Product Name.req','',array('class'=>'text span8','id'=>'name')) }}
                
                {{ $form->text('productcode','Product Code / SKU.req','',array('class'=>'text span8','id'=>'productcode')) }}
                {{ $form->text('permalink','Permalink.req','',array('class'=>'text span8','id'=>'permalink')) }}
                {{ $form->textarea('description','Description.req','',array('class'=>'text span8','id'=>'description')) }}

        </fieldset>
        <fieldset>
            <legend>Publishing</legend>

                {{ $form->select('publishStatus','Publish Status',Config::get('kickstart.publishstatus'),'online',array('id'=>'publishStatus'))}}<br />

                {{ $form->text('publishFrom','','',array('class'=>'text codePhone date','id'=>'publishFrom','placeholder'=>'From')) }}
                {{ $form->text('publishUntil','','',array('class'=>'text codePhone date','id'=>'publishUntil','placeholder'=>'To')) }}

        </fieldset>
        
    </div>

    <div class="span6">

        <fieldset>
            <legend>Product Details</legend>
                {{ $form->select('section','Default Section',Config::get('shoplite.sections'),null,array('class'=>'span2','id'=>'priceCurrency'))}}<br />

                {{ $form->text('category','Category.req','',array('class'=>'text span6','id'=>'category')) }}

                {{ $form->text('tags','Tags.req','',array('class'=>'text span6','id'=>'tags')) }}



                {{ Form::label('price','Default Price Set *')}}
                <div class="row-fluid inputInline">
                  
                    {{$form->select('priceCurrency','',Config::get('shoplite.currency'),null,array('class'=>'areacodePhone','id'=>'priceCurrency'))}}<br />
                    {{ $form->text('retailPrice','','',array('class'=>'text codePhone','id'=>'retailPrice','placeholder'=>'Retail Price')) }}                  
                    {{ $form->text('salePrice','','',array('class'=>'text codePhone','id'=>'salePrice','placeholder'=>'Sale Price')) }}
                    {{ $form->text('effectiveFrom','','',array('class'=>'text codePhone date','id'=>'effectiveFrom','placeholder'=>'From')) }}
                    {{ $form->text('effectiveUntil','','',array('class'=>'text codePhone date','id'=>'effectiveUntil','placeholder'=>'To')) }}
                  
                </div>
        </fieldset>

        <fieldset>
            <legend>Product Main Pictures</legend>

              @for($i=1;$i<6;$i++)
                  <div class="row-fluid">
                    <div class="span8">
                      {{ $form->file('pic0'.$i,'Picture #'.$i)}}
                   </div>
                    <div class="span4">
                      @if($i == 1)
                        {{ $form->radio('defaultpic','Set As Default',$i,true)}}
                      @else
                        {{ $form->radio('defaultpic','Set As Default',$i)}}
                      @endif
                    </div>
                  </div>
              @endfor

        </fieldset>

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