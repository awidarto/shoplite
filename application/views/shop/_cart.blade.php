@layout('public')

@section('content')
<div class="row">
  
  {{ print_r($cart)}}

  <div class="span12">
    <h3>shopping cart</h3>
    <table class='dataTable' id="shoppingcart">
      <thead>
        <tr class="headshoppingcart">
          <th class="span3"></th>
          <th class="span3">ITEM DESCRIPTION</th>
          <th class="span1">SIZE</th>
          <th class="span2">QTY</th>
          <th class="span2">UNIT PRICE</th>
          <th class="span2">PRICE TOTAL</th>
          <th class="span1">&nbsp;</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic2.jpg"></td>
          <td class="span3">Dazel And Angle Orange Long Sleeve Shirt</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
          <td class="span1">[x]</td>
        </tr>

        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic1.jpg"></td>
          <td class="span3">ZARA Sporty Fall Jacket</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
          <td class="span1">[x]</td>
        </tr>

        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic3.jpg"></td>
          <td class="span3">Dazel And Angle Orange Long Sleeve Shirt</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
          <td class="span1">[x]</td>
        </tr>
        <tr>
          <td class="span3 image"><img src="{{ URL::base() }}/images/pic4.jpg"></td>
          <td class="span3">Peach To Black Black Top</td>
          <td class="span1">XL</td>
          <td class="span2"><select class="span1" size="1" name="DataTables_Table_0_length" aria-controls="DataTables_Table_0"><option value="1" selected="selected">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></td>
          <td class="span2">IDR 350,000</td>
          <td class="span2">IDR 350,000</td>
          <td class="span1">[x]</td>
        </tr>
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


<script type="text/javascript">

    var oTable;

    /* Formating function for row details */
    function fnFormatDetails ( nTr )
    {
        var aData = oTable.fnGetData( nTr );

        console.log(aData);

        var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

        @yield('row')

        sOut += '</table>';
         
        return sOut;
    }

    $(document).ready(function(){

        $.fn.dataTableExt.oApi.fnStandingRedraw = function(oSettings) {
            if(oSettings.oFeatures.bServerSide === false){
                var before = oSettings._iDisplayStart;
         
                oSettings.oApi._fnReDraw(oSettings);
         
                // iDisplayStart has been reset to zero - so lets change it back
                oSettings._iDisplayStart = before;
                oSettings.oApi._fnCalculateEnd(oSettings);
            }
              
            // draw the 'current' page
            oSettings.oApi._fnDraw(oSettings);
        };

        var asInitVals = new Array();
        
        oTable = $("#shoppingcart"kjkjqij).DataTable(disvivi{
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{$ajaxsource}}",
                "sDom": 't'
            }
        );

        //header search

        $('thead input').keyup( function () {
            /* Filter on the column (the index) of this element */
            console.log($('thead input').index(this));

            oTable.fnFilter( this.value, $('thead input').index(this) );
        } );

        $('thead input.date').change( function () {
            /* Filter on the column (the index) of this element */
            console.log($('thead input').index(this));

            oTable.fnFilter( this.value, $('thead input.date').index(this) );
        } );

        /*
         * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
         * the footer
         */
        $('thead input').each( function (i) {
            asInitVals[i] = this.value;
        } );

        $('thead input').focus( function () {
            if ( this.className == 'search_init' )
            {
                this.className = '';
                this.value = '';
            }
        } );

        $('thead input').blur( function (i) {
            if ( this.value == '' )
            {
                this.className = 'search_init';
                this.value = asInitVals[$('thead input').index(this)];
            }
        } );


        $('.filter input').keyup( function () {
            /* Filter on the column (the index) of this element */

            oTable.fnFilter( this.value, $('.filter input').index(this) );
        } );

        /*
         * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
         * the footer
         */
        $('.filter input').each( function (i) {
            asInitVals[i] = this.value;
        } );

        $('.filter input').focus( function () {
            if ( this.className == 'search_init' )
            {
                this.className = '';
                this.value = '';
            }
        } );

        $('.filter input').blur( function (i) {
            if ( this.value == '' )
            {
                this.className = 'search_init';
                this.value = asInitVals[$('.filter input').index(this)];
            }
        } );



        $('#select_all').click(function(){
            if($('#select_all').is(':checked')){
                $('.selector').attr('checked', true);
            }else{
                $('.selector').attr('checked', false);
            }
        });

        $(".selectorAll").live("click", function(){
            var id = $(this).attr("id");
            if($(this).is(':checked')){
                $('.selector_'+id).attr('checked', true);
            }else{
                $('.selector_'+id).attr('checked', false);
            }
        });
        

        $('#printstart').click(function(){

            var pframe = document.getElementById('print_frame');
            var pframeWindow = pframe.contentWindow;
            pframeWindow.print();

        });

        $('table.dataTable').click(function(e){

            if ($(e.target).is('._del')) {
                var _id = e.target.id;
                var answer = confirm("Are you sure you want to delete this item ?");
                if (answer){
                    $.post('{{ URL::to($ajaxdel) }}',{'id':_id}, function(data) {
                        if(data.status == 'OK'){
                            //redraw table
                            
                            oTable.fnStandingRedraw();
                            alert("Item id : " + _id + " deleted");
                        }
                    },'json');
                }else{
                    alert("Deletion cancelled");
                }
            }

        });

        

    });
  </script>



@endsection