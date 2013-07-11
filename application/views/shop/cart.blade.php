@layout('public')

@section('content')
<div class="row-fluid">

  {{-- print_r($cart['items'])}}
{{ $form->open('shop/checkout','POST',array('id'=>'shoppingcartform','class'=>'horizontal'))}}

@if(is_null($cart))
    <div class="span12">
        <h3>shopping cart</h3>
        <p>
            Belum ada barang di shopping cart anda, silakan lihat {{ HTML::link('collections','koleksi')}} kami untuk berbelanja.
        </p>
    </div>
@else

  <div class="span12">
    <h3>shopping cart</h3>
    {{ $form->hidden('cartId',$cart['_id'])}}



    <table class='dataTable' id="shoppingcart">
      <thead>
        <tr class="headshoppingcart">
          <th class="span2"></th>
          <th class="span4">ITEM DESCRIPTION</th>
          <th class="span1">SIZE</th>
          <th class="span1">COLOR</th>
          <th class="span1">QTY</th>
          <th class="span2">UNIT PRICE</th>
          <th class="span2">PRICE TOTAL</th>
          <th class="span1" style="min-width:35px;">&nbsp;</th>
        </tr>
      </thead>
      <tbody>

          @foreach($cart['items'] as $key=>$val)

              <?php
                $i = $products[$key]['defaultpic'];
                $product_prefix = $key;
              ?>

              @foreach($val as $k=>$v)
                <?php
                  $kx = str_replace('#', '', $k);
                ?>
                <tr id="{{$product_prefix.'_'.$kx.'_del_row'}}">
                  <td class="span2 image" style="padding-top:0px;">
                      @if(file_exists(realpath('public/storage/products/'.$key).'/sm_pic0'.$i.'.jpg'))
                          {{ HTML::image(URL::base().'/storage/products/'.$key.'/sm_pic0'.$i.'.jpg?'.time(), 'sm_pic0'.$i.'.jpg', array('id' => $key)) }}
                      @endif
                  </td>
                  <td class="span4"><h5>{{ $products[$key]['name'];}}</h5>{{ $products[$key]['description'];}}</td>
                    <?php
                        $qty = 0;
                        $vx = explode('_',$k);
                        $size = $vx[0];
                        $color = $vx[1];
                    ?>
                  <td class="span1 central" >
                    {{ $size }}
                  </td>
                  <td class="span1 central" >
                    <span class="color-chip" style="background-color: {{ $color }}; ">&nbsp;</span>
                  </td>
                  <td class="span2 central">
                    {{ $v['actual'] }}

                    <?php $qty += $v['ordered'];
                        /*
                            {{ Form::text($product_prefix.'_'.$k.'_qty',$v['actual'],array('class'=>'qty-box', 'style'=>'margin-bottom:0px' ,'id'=>$product_prefix.'_'.$k.'_qty')) }}
                            &nbsp;&nbsp;<i class="icon-reload-CW refresh-qty" style="font-size:20px;font-weight:bold;" data-toggle="tooltip" title="update quantity" ></i>
                        */
                    ?>
                  </td>
                  <td class="span2 price">{{ $products[$key]['priceCurrency'].' '.number_format($products[$key]['retailPrice'],2,',','.') ;}}</td>
                  <td class="span2 subtotal" id="{{$product_prefix.'_'.$kx.'_sub'}}">{{ $products[$key]['priceCurrency'].' '.number_format($qty * $products[$key]['retailPrice'],2,',','.') ;}}</td>
                  <td class="span1 removebox"><i class="icon-remove remove-item" id="{{$product_prefix.'_'.$k.'_del'}}" ></i></td>
                </tr>

            @endforeach
          @endforeach
          <tr>
            <td colspan="6" style="text-align:right;padding-top:4px;"><h4 class="titleselectbox">total</h4></td>
            <td id='total_billing' class="span2 subtotal" >{{ $prices['total_billing_fmt'] }}</td>
            <td></td>
          </tr>
          <tr style="border:none">
            <td colspan="8" style="text-align:right;padding-top:4px;">
                <a class="btn primary" href="{{ URL::base()}}"><i class="icon-shopping"></i> Continue Shopping</a>
                <a class="btn primary" id="checkoutnow" href="{{ URL::to('shop/checkout')}}" ><i class="icon-checkmark"></i> Go To Check Out</a>
            </td>
          </tr>
      </tbody>
    </table>

  </div>


{{ $form->close() }}
</div>

@endif

<script type="text/javascript">
$(document).ready(function(){
  $('#checkoutnow').click(function(){
      $('#shoppingcartform').submit();
      return false;
  });

  $('.remove-item').click(function(){
      var answer = confirm("Are you sure you want to delete this item ?");
      if (answer){

        var _id = this.id;
        $.post('{{ URL::to('shop/removeitem') }}',{'id':_id}, function(data) {
          if(data.result == 'OK'){
            alert("Item deleted");
            $('#'+data.row).remove();
            //$('#'+data.row).parent().parent().remove();
            console.log($('#'+data.row));
            console.log($('#'+data.row).parent().parent());

            $('.subtotal').each(function(i){
                //console.log(this.id);
                var si = this.id;
                var subt = data.prices[si];
                console.log(subt.sub_total_price_fmt);
                $(this).html(subt.sub_total_price_fmt);
            });

            $('#total_due').val(data.prices.total_due_fmt);
            $('#shipping').val(data.prices.shipping_fmt);
            $('#total_billing').html(data.prices.total_billing_fmt);


            if(data.cartcount == 0){
                $('#shopping-badge').html('');
                window.location = '{{ URL::to('shop/cart') }}';
            }else{
                $('#shopping-badge').html(data.cartcount);
            }


          }
        },'json');

      }else{
        alert("Deletion cancelled");
      }
  });

  $('.refresh-qty').click(function(){
        var prev = $(this).prev();
        var _id = prev[0].id;
        var qty = prev.val();

        $.post('{{ URL::to('shop/updateqty') }}',{'id':_id,'qty':qty}, function(data) {
          if(data.result == 'OK:ITEMADDED' || data.result == 'OK:ITEMREMOVED'){
              alert(data.message);


              $('.subtotal').each(function(i){
                  //console.log(this.id);
                  var si = this.id;
                  var subt = data.prices[si];
                  console.log(subt.sub_total_price_fmt);
                  $(this).html(subt.sub_total_price_fmt);
              });


              $('#total_due').val(data.prices.total_due_fmt);
              $('#shipping').val(data.prices.shipping_fmt);
              $('#total_billing').html(data.prices.total_billing_fmt);

                if(data.cartcount == 0){
                    $('#shopping-badge').html('');
                }else{
                    $('#shopping-badge').html(data.cartcount);
                }


          }
        },'json');

  });


});

</script>


@endsection