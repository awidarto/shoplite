@layout('public')

@section('content')
<div class="row">
  
  {{-- print_r($cart['items'])}}
{{ $form->open('shop/commit','POST',array('id'=>'shoppingcartform'))}}
  <div class="span12">
    <h3>check out</h3>
    {{ $form->hidden('cartId',$cart['_id'])}}
    <table class='dataTable' id="shoppingcart">
      <thead>
        <tr class="headshoppingcart">
          <th class="span2"></th>
          <th class="span4">ITEM DESCRIPTION</th>
          <th class="span2">SIZE / COLOR / QTY</th>
          <th class="span2">UNIT PRICE</th>
          <th class="span2">PRICE TOTAL</th>
        </tr>
      </thead>
      <tbody>

      <?php

      $totalPrice = 0;

      ?>
      @foreach($cart['items'] as $key=>$val)

          <?php
            $i = $products[$key]['defaultpic'];

            $product_prefix = $key;

          ?>

          <tr>
            <td class="span2 image">
                @if(file_exists(realpath('public/storage/products/'.$key).'/sm_pic0'.$i.'.jpg'))
                    {{ HTML::image(URL::base().'/storage/products/'.$key.'/sm_pic0'.$i.'.jpg?'.time(), 'sm_pic0'.$i.'.jpg', array('id' => $key)) }}
                @endif
            </td>
            <td class="span4"><h5>{{ $products[$key]['name'];}}</h5>{{ $products[$key]['description'];}}</td>
            <td class="span2">
              <table class="var-box">
                <?php $qty = 0;?>
                @foreach($val as $k=>$v)
                  <tr>
                    <td>
                      {{ $v['size'] }}
                    </td>
                    <td>
                      <span class="color-chip" style="background-color: {{ $v['color'] }}; ">&nbsp;</span>
                    </td>
                    <td>
                      <?php $qty += $postdata[$product_prefix.'_'.$k.'_qty'] ;?>
                      {{  $postdata[$product_prefix.'_'.$k.'_qty'] }}
                      {{ Form::hidden($product_prefix.'_'.$k.'_qty',$v['ordered'],array('class'=>'qty-box')) }}<br />
                    </td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td class="span2 price">
              {{ $products[$key]['priceCurrency'].' '.number_format($products[$key]['retailPrice'],2,',','.') ;}}
              <input type="hidden" name="{{$key}}_retailPrice" value="{{$products[$key]['retailPrice']}}" />
            </td>
            <td class="span2 price">{{ $products[$key]['priceCurrency'].' '.number_format($qty * $products[$key]['retailPrice'],2,',','.') ;}}</td>
              <input type="hidden" name="{{$key}}_subTotalPrice" value="{{$qty * $products[$key]['retailPrice']}}" />
          </tr>

          <?php
            $totalPrice += $qty * (double) $products[$key]['retailPrice'];
          ?>
      @endforeach

      </tbody>
    </table>
    <div class="clear"></div>
    <div class="paymentmethod span12">
      <div class="method1 span3">
        <h4>payment method</p>  
        @if($postdata['paymentmethod'] == 'mandiri')
          <img src="{{ URL::base() }}/images/mandiri.png">
        @elseif($postdata['paymentmethod'] == 'bca')
          <img src="{{ URL::base() }}/images/bca.png">
        @endif
        <input type="hidden" value="{{$postdata['paymentmethod']}}" name="paymentmethod">
      </div>

      <div class="method2 span3">
        <h4>shipping method</p>
        @if($postdata['shippingmethod'] == 'jex')
          <img src="{{ URL::base() }}/images/jexcod.png">
        @elseif( $postdata['shippingmethod'] == 'jne')
          <img src="{{ URL::base() }}/images/jne.png">
        @elseif($postdata['shippingmethod'] == 'gojek')
          <img src="{{ URL::base() }}/images/gojek.png">
        @endif
        <input type="hidden" value="{{$postdata['shippingmethod']}}" name="shippingmethod">
      </div>

      <div class="method3 span5">
        <p><h4 class="titleselectbox">sub-total</h4>&nbsp;&nbsp; <input class="currency-display" disabled="disabled" id="field_fromDate" type="text" name="totalPriceDisplay" value="{{ $products[$key]['priceCurrency'].' '.number_format($totalPrice,2,',','.') ;}}">
          <input name="totalPrice" type="hidden" value="{{ $totalPrice }}">
        </p>

        <p><h4 class="titleselectbox">shipping</h4>&nbsp;&nbsp; <input class="currency-display" disabled="disabled" id="field_fromDate" type="text" name="shippingFeeDisplay" value="{{ $products[$key]['priceCurrency'].' '.number_format($shippingFee,2,',','.') ;}}"></p>
          <input name="shippingFee" type="hidden" value="{{ $shippingFee }}">

        <p><h4 class="titleselectbox">total</h4>&nbsp;&nbsp; <input class="currency-display" disabled="disabled" id="field_fromDate" type="text" name="totalDueDisplay" value="{{ $products[$key]['priceCurrency'].' '.number_format($totalPrice + $shippingFee,2,',','.') ;}}"></p>
          <input name="totalDue" type="hidden" value="{{ $totalPrice + $shippingFee }}">

        <p class="buttonshopcart">
          <a class="btn primary" id="commitnow" href="{{ URL::to('shop/commit')}}" ><i class="icon-checkmark"></i> Check Out Now</a><br /><br />
          <a class="btn primary" href="{{ URL::to('shop/cart')}}" ><i class="icon-cart"></i> Go Back & Update Cart</a><br /><br />
          <a class="btn primary" href="{{ URL::base();}}"><i class="icon-shopping"></i> Continue Shopping</a></p>
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
  $('#commitnow').click(function(){
      $('#shoppingcartform').submit();
      return false;
  });
});

</script>


@endsection