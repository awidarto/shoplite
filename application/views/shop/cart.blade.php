@layout('public')

@section('content')
<div class="row">
  
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

    var current_pay_id = 0;
    var current_del_id = 0;
    var current_print_id = 0;

    

    function toggle_visibility(id) {
        $('#' + id).toggle();
    }

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
        
        //display tax print
        $('.payselect').on('change', function() {
            if(this.value == 'paid'){
                $('.taxdisplaystatus').show();
                $('.taxdisplaystatus').val('dontprinttax');
            }else{
                $('.taxdisplaystatus').hide();
            }
        });



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

        $('.activity-list').tooltip();

        

        var asInitVals = new Array();
        
        oTable = $('.dataTable').DataTable(
            {
                "bProcessing": true,
                "bServerSide": true,
                "sAjaxSource": "{{$ajaxsource}}",
                "oLanguage": { "sSearch": "Search "},
                "sPaginationType": "full_numbers",
                "aLengthMenu": [15, 30, 60, "All"],
                "sDom": 't',
                "aoColumnDefs": [ 
                    { "bSortable": false, "aTargets": [ 0,1,2,3,4,5,6 ] }
                 ],
                "fnServerData": function ( sSource, aoData, fnCallback ) {
                    $.ajax( {
                        "dataType": 'json', 
                        "type": "POST", 
                        "url": sSource, 
                        "data": aoData, 
                        "success": fnCallback
                    } );
                }
            }
        );

        $('.dataTable tbody td .expander').live( 'click', function () {

            var nTr = $(this).parents('tr')[0];
            if ( oTable.fnIsOpen(nTr) )
            {
                /* This row is already open - close it */
                //this.src = "../examples_support/details_open.png";
                oTable.fnClose( nTr );
            }
            else
            {
                /* Open this row */
                //this.src = "../examples_support/details_close.png";
                oTable.fnOpen( nTr, fnFormatDetails(nTr), 'details-expand' );
            }
        } );        

        $('tfoot input').keyup( function () {
            /* Filter on the column (the index) of this element */
            oTable.fnFilter( this.value, $('tfoot input').index(this) );
        } );

        /*
         * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
         * the footer
         */
        $('tfoot input').each( function (i) {
            asInitVals[i] = this.value;
        } );

        $('tfoot input').focus( function () {
            if ( this.className == 'search_init' )
            {
                this.className = '';
                this.value = '';
            }
        } );

        $('tfoot input').blur( function (i) {
            if ( this.value == '' )
            {
                this.className = 'search_init';
                this.value = asInitVals[$('tfoot input').index(this)];
            }
        } );



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
        

        $('#confirmdelete').click(function(){

            $.post('{{ URL::to($ajaxdel) }}',{'id':current_del_id}, function(data) {
                if(data.status == 'OK'){
                    //redraw table

                    
                    oTable.fnStandingRedraw();

                    $('#delstatusindicator').html('Payment status updated');

                    $('#deleteWarning').modal('toggle');

                }
            },'json');
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

            if ($(e.target).is('.pbadge')) {
                var _id = e.target.id;

                current_print_id = _id;

                $('#print_id').val(_id);

                <?php

                    $printsource = (isset($printsource))?$printsource.'/': '/';

                ?>

                var src = '{{ $printsource }}' + _id;

                $('#print_frame').attr('src',src);

                $('#printBadge').modal();
            }

            if ($(e.target).is('.pay')) {
                var _id = e.target.id;

                current_pay_id = _id;

                $('#updatePayment').modal();

            }

            if ($(e.target).is('.formstatus')) {
                var _id = e.target.id;

                current_pay_id = _id;

                $('#updateFormStatus').modal();

            }

            if ($(e.target).is('.formstatusindiv')) {
                var _id = e.target.id;

                current_pay_id = _id;

                $('#updateFormStatusindividual').modal();

            }

            if ($(e.target).is('.paygolf')) {
                var _id = e.target.id;

                current_pay_id = _id;

                $('#updatePaymentGolf').modal();

            }

            if ($(e.target).is('.paygolfconvention')) {
                var _id = e.target.id;

                current_pay_id = _id;

                $('#updatePaymentGolfConvention').modal();

            }

            if ($(e.target).is('.resendmail')) {
                var _id = e.target.id;

                current_pay_id = _id;
                $('#errormessagemodal').text('');
                $('#successmessagemodal').text('');
                $('#updateResendmail').modal();

            }

            if ($(e.target).is('.sendexhibitregistmail')) {
                var _id = e.target.id;

                current_pay_id = _id;
                $('#exhbitor_errormessagemodal').text('');
                $('#exhbitor_successmessagemodal').text('');
                $('#exhibitorResendmail').modal();

            }

            

            if ($(e.target).is('.viewform')) {
                
                var _id = e.target.id;
                var _rel = $(e.target).attr('rel');
                var url = '{{ URL::base() }}' + '/exhibitor/' + _rel + '/' + _id;
                

                //var url = $(this).attr('url');
                //var modal_id = $(this).attr('data-controls-modal');
                $("#viewformModal .modal-body").load(url);
                
                
                $('#viewformModal').modal();

            }

            if ($(e.target).is('.editform')) {
                
                var _id = e.target.id;
                var _rel = $(e.target).attr('rel');
                var url = '{{ URL::base() }}' + '/exhibitor/' + _rel + '/' + _id;
                

                //var url = $(this).attr('url');
                //var modal_id = $(this).attr('data-controls-modal');
                setTimeout(function() {
                    $("#editformModal .modal-body").load(url);
                }, 1000);
                
                
                
                $('#editformModal').modal();

            }


            if ($(e.target).is('.fillform')) {
                
                var _id = e.target.id;
                var _rel = $(e.target).attr('rel');
                var url = '{{ URL::base() }}' + '/exhibitor/' + _rel + '/' + _id;
                

                //var url = $(this).attr('url');
                //var modal_id = $(this).attr('data-controls-modal');
                setTimeout(function() {
                    $("#editformModal .modal-body").load(url);
                }, 1000);
                
                
                
                $('#editformModal').modal();

            }

            



            if ($(e.target).is('.del')) {
                var _id = e.target.id;

                current_del_id = _id;

                $('#deleteWarning').modal({
                    keyboard:true
                });
            }

            if ($(e.target).is('.pop')) {
                var _id = e.target.id;
                var _rel = $(e.target).attr('rel');

                $.fancybox({
                    type:'iframe',
                    href: '{{ URL::base() }}' + '/' + _rel + '/' + _id,
                    autosize: true
                });

            }

            /*if ($(e.target).is('.viewform')) {
                var _id = e.target.id;
                var _rel = $(e.target).attr('rel');

                $.fancybox({
                    type:'iframe',
                    href: '{{ URL::base() }}' + '/' + _rel + '/' + _id,
                    autosize: true
                });

            }*/ 

            if ($(e.target).is('.fileview')) {
                var _id = e.target.id;

                console.log(e);

                $.fancybox({
                    type:'iframe',
                    href: '{{ URL::base().'/storage/' }}' + _id + '/' + e.target.innerHTML,
                    autosize: true
                });

            }                       

            if ($(e.target).is('.metaview')) {
                var doc_id = e.target.id;

                $.fancybox({
                    type:'iframe',
                    href: '{{ URL::to("document/view/") }}' + doc_id,
                    autosize: true
                });
            }

            if ($(e.target).is('.approvalview')) {
                var doc_id = e.target.id;

                $.fancybox({
                    type:'iframe',
                    width:'1000',
                    href: '{{ URL::to("document/approve/") }}' + doc_id,
                    autosize: false
                });
            }

        });

        

    });
  </script>



@endsection