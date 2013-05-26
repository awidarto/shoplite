@layout('public')

@section('content')
<div class="row">
  
  {{-- print_r($cart['items'])}}

  <div class="span12">
    <h3>shopping cart</h3>
    <table class='dataTable' id="shoppingcart">
      <thead>
        <tr class="headshoppingcart">
          <th class="span2"></th>
          <th class="span4">ITEM DESCRIPTION</th>
          <th class="span1">SIZE / COLOR / QTY</th>
          <th class="span2">UNIT PRICE</th>
          <th class="span2">PRICE TOTAL</th>
          <th class="span1">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
      @foreach($cart['items'] as $key=>$val)

          <?php
            $i = $products[$key]['defaultpic'];
          ?>

          <tr>
            <td class="span2 image">
                @if(file_exists(realpath('public/storage/products/'.$key).'/sm_pic0'.$i.'.jpg'))
                    {{ HTML::image(URL::base().'/storage/products/'.$key.'/sm_pic0'.$i.'.jpg?'.time(), 'sm_pic0'.$i.'.jpg', array('id' => $key)) }}
                @endif
            </td>
            <td class="span4"><h5>{{ $products[$key]['name'];}}</h5>{{ $products[$key]['description'];}}</td>
            <td class="span1">
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
                      <?php $qty += $v['ordered'];?>
                      {{ Form::text($k.'_qty',$v['ordered'],array('class'=>'qty-box')) }}<br />
                    </td>
                    <td class="span1"><i class="icon-remove"></i></td>
                  </tr>
                @endforeach
              </table>
            </td>
            <td class="span2 price">{{ $products[$key]['priceCurrency'].' '.number_format($products[$key]['retailPrice'],2,',','.') ;}}</td>
            <td class="span2 price">{{ $products[$key]['priceCurrency'].' '.number_format($qty * $products[$key]['retailPrice'],2,',','.') ;}}</td>
            <td class="span1"><i class="icon-remove"></i></td>
          </tr>
      @endforeach

      </tbody>
    </table>
    <div class="clear"></div>
    <div class="paymentmethod span12">
      <div class="method1 span3">
        <h4>payment method</p>  
        <input id="field_daterange" checked="checked" type="radio" name="paymentmethod" value="bca">&nbsp;&nbsp;<img src="{{ URL::base() }}/images/bca.png"><br/><br/>
        <input id="field_daterange"  type="radio" name="paymentmethod" value="mandiri">&nbsp;&nbsp;<img src="{{ URL::base() }}/images/mandiri.png"><br/>
      </div>

      <div class="method2 span3">
        <h4>shipping method</p>  
        <input id="field_daterange" checked="checked" type="radio" name="shippingmethod" value="jex">&nbsp;&nbsp;<img src="{{ URL::base() }}/images/jexcod.png"><br/><br/>
        <input id="field_daterange"  type="radio" name="shippingmethod" value="jne">&nbsp;&nbsp;<img src="{{ URL::base() }}/images/jne.png"><br/><br/>
        <input id="field_daterange"  type="radio" name="shippingmethod" value="gojek">&nbsp;&nbsp;<img src="{{ URL::base() }}/images/gojek.png"><br/><br/>
      </div>

      <div class="method3 span5">
        <p><h4 class="titleselectbox">sub-total</h4>&nbsp;&nbsp; <input class="" disabled="disabled" id="field_fromDate" type="text" name="fromDate" value="IDR 2,459,000"></p>
        <p><h4 class="titleselectbox">shipping</h4>&nbsp;&nbsp; <input class="" disabled="disabled" id="field_fromDate" type="text" name="fromDate" value="IDR 30,000"></p>
        <p><h4 class="titleselectbox">total</h4>&nbsp;&nbsp; <input class="" disabled="disabled" id="field_fromDate" type="text" name="fromDate" value="IDR 2,489,000"></p>
        <p class="buttonshopcart"><a class="checkoutnow" href="#"></a><br/><br/>
        <a class="continueshopping" href="#"></a></p>
      </div>
      
    </div>
  
  </div>
  
</div>


@endsection