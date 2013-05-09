@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

{{$form->open('booth/edit/'.$data['_id'],'POST',array('class'=>'custom'))}}

    {{ $form->hidden('id',$data['_id'])}}
    
    
<div class="row-fluid formNewAttendee">
    <div class="span6">
        <fieldset>
            <legend>Personal Information</legend>
            
                {{ $form->text('boothno','Booth No.req','',array('class'=>'text span8','id'=>'firstname')) }}                
                {{ $form->text('width','Width.req','',array('class'=>'text span8','id'=>'lastname')) }}
                {{ $form->text('length','Length.req','',array('class'=>'text span8','id'=>'positionname')) }}
                {{ $form->text('freepassslot','Free Pass Slot','',array('class'=>'text span8','id'=>'mobile')) }}

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