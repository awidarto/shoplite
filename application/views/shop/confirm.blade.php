@layout('public')

@section('content')
<div class="row">
  
  {{-- print_r($cart['items'])}}
{{ $form->open('shop/confirm','POST',array('class'=>'horizontal','id'=>'shoppingcartform'))}}
  <div class="span12">
    <h3>Confirm Payment</h3>
    <div class="paymentmethod span12">
      <div class="method1 span6">

        {{ $form->text('confirmationCode','Confirmation Code','')}}<br />
          <a class="btn primary" href="{{ URL::to('shop/commit')}}" ><i class="icon-checkmark"></i> Confirm</a>
          <a class="btn primary" href="{{ URL::base();}}"><i class="icon-shopping"></i> Cancel</a>
      </div>

      <div class="method3 span5">

        <p class="buttonshopcart">
        </p>
      </div>
      
    </div>
  
  </div>
{{ $form->close() }}  
</div>

<style type="text/css">
input.currency-display{
  text-align: right;

}
</style>

<script type="text/javascript">
$(document).ready(function(){

});

</script>


@endsection