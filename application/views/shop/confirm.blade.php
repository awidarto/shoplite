@layout('public')

@section('content')
<div class="row">
  
  {{-- print_r($cart['items'])}}
{{ $form->open('shop/confirm','POST',array('class'=>'horizontal','id'=>'shoppingcartform'))}}
  <div class="span12">
    <h3>Confirm Payment</h3>
    <div class="confirm-form span12">
      {{ $form->text('confirmationCode','Confirmation Code','')}}<br />

      {{ $form->text('email','Email','')}}<br />

      {{ $form->select('destinationBank','Transfer to ',Config::get('shoplite.banks'))}}<br />

      {{ $form->text('transferDate','Date of Transfer','', array('class'=>'date') )}}<br />

      {{ $form->text('transferAmount','Amount of Transfer','', array('class'=>'currency-display') )}}<br />

      {{ $form->text('sourceBank','Bank Name','')}}<br />

      {{ $form->text('sourceAcc','Transfer from Account Number','')}}<br />

      {{ $form->text('sourceAccName','Account Holder Name','')}}<br />

        <button class="btn primary" ><i class="icon-checkmark"></i> Confirm</button>
        <a class="btn primary" href="{{ URL::base();}}"><i class="icon-shopping"></i> Cancel</a>

    </div>
  
  </div>
{{ $form->close() }}  
</div>

<style type="text/css">

.confirm-form input[type=text]{
  width:350px;
}

input.currency-display{
  text-align: right;

}
</style>

<script type="text/javascript">
$(document).ready(function(){

});

</script>


@endsection