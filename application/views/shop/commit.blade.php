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
                              <?php $qty += $postdata[$product_prefix.'_'.$k.'_qty'];?>
                              {{  $postdata[$product_prefix.'_'.$k.'_qty'] }}
                              {{ Form::hidden($k.'_qty',$v['ordered'],array('class'=>'qty-box')) }}<br />
                            </td>
                          </tr>
                        @endforeach
                      </table>
                    </td>
                    <td class="span2 price">{{ $products[$key]['priceCurrency'].' '.number_format($postdata[$key.'_retailPrice'],2,',','.') ;}}</td>
                    <td class="span1 price">{{ $products[$key]['priceCurrency'].' '.number_format($postdata[$key.'_subTotalPrice'],2,',','.') ;}}</td>
                  </tr>

                  <?php
                    $totalPrice += $qty * (double) $products[$key]['retailPrice'];
                  ?>
                @endforeach
                <tr>
                    <td class="span2">PAYMENT METHOD</td>
                    <td class="span4">SHIPPING METHOD</td>
                    <td class="span1"></td>
                    <td class="span2 currency-display">SUB TOTAL</td>
                    <td class="span2 currency-display">{{ $products[$key]['priceCurrency'].' '.number_format($postdata['totalPrice'],2,',','.') ;}}</td>
                </tr>
                <tr>
                    <td class="span2">
                        @if($postdata['paymentmethod'] == 'mandiri')
                            <img src="{{ URL::base() }}/images/mandiri.png">
                        @elseif($postdata['paymentmethod'] == 'bca')
                            <img src="{{ URL::base() }}/images/bca.png">
                        @endif
                    </td>
                    <td class="span4">
                        @if($postdata['shippingmethod'] == 'jex')
                            <img src="{{ URL::base() }}/images/jexcod.png">
                        @elseif( $postdata['shippingmethod'] == 'jne')
                            <img src="{{ URL::base() }}/images/jne.png">
                        @elseif($postdata['shippingmethod'] == 'gojek')
                            <img src="{{ URL::base() }}/images/gojek.png">
                        @endif
                    </td>
                    <td class="span1"></td>
                    <td class="span2 currency-display">SHIPPING FEE</td>
                    <td class="span2 currency-display">{{ $products[$key]['priceCurrency'].' '.number_format($postdata['shippingFee'],2,',','.') ;}}</td>
                </tr>
                <tr>
                    <td colspan="3"></td>
                    <td class="span2 currency-display">TOTAL PRICE</td>
                    <td class="span2 currency-display">{{ $products[$key]['priceCurrency'].' '.number_format($totalPrice + $postdata['totalDue'],2,',','.') ;}}</td>
                </tr>
                <tr>
                    <td colspan="4"></td>
                    <td class="span2 currency-display">
                        <a class="btn primary" href="{{ URL::base();}}"><i class="icon-shopping"></i> Shop for more</a></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<style type="text/css">
.currency-display{
  text-align: right;
}

table.dataTable thead tr{
    border-bottom: 1px solid #ccc;
}

table.dataTable td{
    border:none;
}

</style>

</script>


@endsection