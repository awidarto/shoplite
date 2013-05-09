@layout('public')

@section('content')
<div class="row">
  
  <div class="span12">
    <h3>shopping cart</h3>
    <table class='shoppingcart'>
        <tr class="headshoppingcart">
          <th class="span3"></th>
          <th class="span3">ITEM DESCRIPTION</th>
          <th class="span1">SIZE</th>
          <th class="span2">QTY</th>
          <th class="span2">UNIT PRICE</th>
          <th class="span2">PRICE TOTAL</th>
        </tr>
        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic2.jpg"></td>
          <td class="span3">Dazel And Angle Orange Long Sleeve Shirt</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
        </tr>

        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic1.jpg"></td>
          <td class="span3">ZARA Sporty Fall Jacket</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
        </tr>

        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic3.jpg"></td>
          <td class="span3">Dazel And Angle Orange Long Sleeve Shirt</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
        </tr>

        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic4.jpg"></td>
          <td class="span3">Peach To Black Black Top</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
        </tr>
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