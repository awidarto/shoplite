@layout('master')

@section('content')

<div class="row-fluid">
	@if(Auth::user()->role == 'onsite')
	<div class="span10" id="onsite-table">
	@else
	<div class="span12" id="onsite-table">
	@endif

          <table class="table onsite table-condensed dataTable attendeeTable" id="onsite">

			    <thead>
			        <tr>
			        	@foreach($heads as $head)
			        		@if(is_array($head))
			        			<th 
			        				@foreach($head[1] as $key=>$val)
			        					{{ $key }}="{{ $val }}"

			        				@endforeach
			        			>
			        			{{ $head[0] }}
			        			</th>
			        		@else
			        		<th>
			        			{{ $head }}
			        		</th>
			        		@endif
			        	@endforeach
			        </tr>
			    </thead>

				<?php
					$form = new Formly();
				?>

		    	@if($searchinput)
				    <thead id="searchinput">
					    <tr>
				    	@foreach($searchinput as $in)
				    		@if($in)
				    			@if($in == 'select_all')
				    				<td>{{ $form->checkbox('select_all','','',false,array('id'=>'select_all')) }}</td>
				    			@else
					        		<td><input type="text" name="search_{{$in}}" id="search_{{$in}}" value="Search {{$in}}" class="search_init" /></td>
				    			@endif
				    		@else
				        		<td>&nbsp;</td>
				    		@endif
				    	@endforeach
					    </tr>
				    </thead>
			    @endif

             <tbody>
             	<!-- will be replaced by ajax content -->
             </tbody>

          </table>

	</div>
	@if(Auth::user()->role == 'onsite')
	<div class="span2">

		<div class="metro row-fluid">
			<div class="metro-sections span12">

			   <div id="section2" class="metro-section tile-span-1">
			      <h2>Quick Access</h2>
				<!--
			      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('attendee')}}">
			         <div class="image-wrapper">
			         	{{ HTML::image('content/img/My Apps.png') }}
			         </div>
			         <div class="column-text">
			            <div class="text">Attendees</div>
			         </div>
			      </a>
				-->

			      <a class="tile app bg-color-blueDark" href="#" id="attendeeaddnew">
			         <div class="image-wrapper">
			            <span class="icon icon-user-2"></span>
			         </div>
			         <span class="app-label">Register New Attendee</span>
			      </a>
				<!--

			      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('visitor')}}">
			         <div class="image-wrapper">
			         	{{ HTML::image('content/img/My Apps.png') }}
			         </div>
			         <div class="column-text">
			            <div class="text">Visitors</div>
			         </div>
			      </a>
				-->
				  <a class="tile app bg-color-redDark" href="{{ URL::to('official/add') }}">
			         <div class="image-wrapper">
			            <span class="icon icon-user-3"></span>
			         </div>
			         <span class="app-label">Register New Official</span>
			      </a>
			      <a class="tile app bg-color-greenDark" href="{{ URL::to('visitor/add') }}">
			         <div class="image-wrapper">
			            <span class="icon icon-user"></span>
			         </div>
			         <span class="app-label">Register New Visitor</span>
			      </a>

				<!--
			      <a class="tile app imagetext bg-color-greenDark" href="{{ URL::to('official')}}">
			         <div class="image-wrapper">
			         	{{ HTML::image('content/img/My Apps.png') }}
			         </div>
			         <div class="column-text">
			            <div class="text">Officials</div>
			         </div>
			      </a>
				-->

			      

			      <a id="boothaddnew" class="tile app bg-color-orange boothadd" href="#">
			         <div class="image-wrapper">
			            <span class="icon icon-users"></span>
			         </div>
			         <span class="app-label">Register  Exhibitor Pass</span>
			      </a>

			      <a class="tile app bg-color-red" href="{{ URL::to('onsite/report') }}">
			         <div class="image-wrapper">
			            <span class="icon icon-stats-up"></span>
			         </div>
			         <span class="app-label">On site Report</span>
			      </a>

			   </div>
			</div>
		</div>
	</div>
	@endif
</div>

<div id="viewformModal" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Detail</h3>
		
	</div>
	<div class="modal-body" id="loaddata">
		
	</div>
	
	

</div>

<div id="ajax-modal" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Register New Booth assistant</h3>
		
	</div>
	<div class="modal-body" id="loaddata">
		
	</div>
	
	

</div>


<div id="ajax-modal2" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Register New Booth assistant</h3>
		
	</div>
	<div class="modal-body" id="loaddata">
		
	</div>
	
	

</div>


<script type="text/javascript">

	var oTable;
	var vTable;

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

	function vfnFormatDetails ( nTr )
	{
	    var aData = vTable.fnGetData( nTr );

	    console.log(aData);

	    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';

	    @yield('row')

	    sOut += '</table>';
	     
	    return sOut;
	}

    $(document).ready(function(){

    	/*
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
		*/
		$('.activity-list').tooltip();

		

		var asInitVals = new Array();
        
        oTable = $('.dataTable.attendeeTable').DataTable(
			{
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{$ajaxsource}}",
				"oLanguage": { "sSearch": "Search "},
				"sPaginationType": "full_numbers",
				"iDisplayLength": 5,
				"sDom": 'lrpt',
				"aoColumnDefs": [ 
				    { "bSortable": false, "aTargets": [ {{ $disablesort }} ] }
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

        vTable = $('.dataTable.visitorTable').DataTable(
			{
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{$ajaxvisitorsource}}",
				"oLanguage": { "sSearch": "Search "},
				"sPaginationType": "full_numbers",
				"iDisplayLength": 5,
				"sDom": 'tr',
				"aoColumnDefs": [ 
				    { "bSortable": false, "aTargets": [ {{ $disablesort }} ] }
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

		$('.dataTable.attendeeTable tbody td .expander').live( 'click', function () {


		    var xTr = $(this).parents('tr')[0];

			console.log(xTr);

		    if ( oTable.fnIsOpen(xTr) )
		    {
		        /* This row is already open - close it */
		        //this.src = "../examples_support/details_open.png";
		        oTable.fnClose( xTr );
		    }
		    else
		    {
		        /* Open this row */
		        //this.src = "../examples_support/details_close.png";
		        oTable.fnOpen( xTr, fnFormatDetails(xTr), 'details-expand' );
		    }
		} );        

		$('.dataTable.visitorTable tbody td .expander').live( 'click', function () {

		    var nTr = $(this).parents('tr')[0];

			//console.log(nTr);

		    if ( vTable.fnIsOpen(nTr) )
		    {
		        /* This row is already open - close it */
		        //this.src = "../examples_support/details_open.png";
		        vTable.fnClose( nTr );
		    }
		    else
		    {
		        /* Open this row */
		        //this.src = "../examples_support/details_close.png";
		        vTable.fnOpen( nTr, vfnFormatDetails(nTr), 'details-expand' );
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
			oTable.fnFilter( this.value, $('thead input').index(this) );
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


		$('#do_action').click( function(){
			alert($('#field_action').val());


		});

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
		

		

		$('#savepaystatus').click(function(){
			var paystat = $('#paystatusselect').val();
			$('#savepaystatus').text('Processing..');
			$('#savepaystatus').attr("disabled", true);	

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpay) }}',{'id':current_pay_id,'paystatus': paystat}, function(data) {
				if(data.status == 'OK'){
					//redraw table
					oTable.fnStandingRedraw();
					
					$('#paystatusindicator').html('Payment status updated');
					$('#savepaystatus').text('Save');
					$('#savepaystatus').attr("disabled", false);	
					
					$('#paystatusselect').val('unpaid');

					$('#updatePayment').modal('toggle');

				}
			},'json');
		});


		$('#saveformstatus').click(function(){
			var paystat = $('#formstatusselect').val();
			$('#saveformstatus').text('Processing..');
			$('#saveformstatus').attr("disabled", true);	

			<?php

				$ajaxformstatus = (isset($ajaxformstatus))?$ajaxformstatus:'/';
			?>

			$.post('{{ URL::to($ajaxformstatus) }}',{'id':current_pay_id,'formstatus': paystat}, function(data) {
				if(data.status == 'OK'){
					//redraw table
					oTable.fnStandingRedraw();
					
					//$('#paystatusindicator').html('Payment status updated');
					$('#saveformstatus').text('Save');
					$('#saveformstatus').attr("disabled", false);	
					
					$('#formstatusselect').val('open');

					$('#updateFormStatus').modal('toggle');

				}
			},'json');
		});

		$('#savepaystatusGolf').click(function(){
			var paystat = $('#paystatusselectgolf').val();
			$('#savepaystatusGolf').text('Processing..');
			$('#savepaystatusGolf').attr("disabled", true);	

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpaygolf) }}',{'id':current_pay_id,'paystatusgolf': paystat}, function(data) {
				if(data.status == 'OK'){
					//redraw table

					oTable.fnStandingRedraw();
					$('#paystatusindicator').html('Payment status updated');
					$('#savepaystatusGolf').text('Save');
					$('#savepaystatusGolf').attr("disabled", false);	

					$('#paystatusselectgolf').val('unpaid');

					$('#updatePaymentGolf').modal('toggle');

				}
			},'json');
		});


		$('#savepaystatusGolfConvention').click(function(){
			var paystat = $('#paystatusselectgolfconvention').val();
			$('#savepaystatusGolfConvention').text('Processing..');
			$('#savepaystatusGolfConvention').attr("disabled", true);	

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpaygolfconvention) }}',{'id':current_pay_id,'paystatusgolfconvention': paystat}, function(data) {
				if(data.status == 'OK'){
					//redraw table

					oTable.fnStandingRedraw();
					$('#paystatusindicator').html('Payment status updated');
					$('#savepaystatusGolfConvention').text('Save');
					$('#savepaystatusGolfConvention').attr("disabled", false);	

					$('#paystatusselectgolfconvention').val('unpaid');

					$('#updatePaymentGolfConvention').modal('toggle');

				}
			},'json');
		});


		$('#submitresend').click(function(){
			var emailtype = $('#resendemailtype').val();
			$('#submitresend').text('Processing..');
			$('#submitresend').attr("disabled", true);	

			<?php

				$ajaxresendmail = (isset($ajaxresendmail))?$ajaxresendmail:'/';
			?>

			$.post('{{ URL::to($ajaxresendmail) }}',{'id':current_pay_id,'type': emailtype}, function(data) {
				if(data.status == 'OK'){
					//redraw table

					
					oTable.fnStandingRedraw();

					//$('#paystatusindicator').html('Payment status updated');
					$('#submitresend').text('Sumbit');
					$('#submitresend').attr("disabled", false);	

					$('#resendemailtype').val('email.regsuccess');
					$('#errormessagemodal').text('');
					$('#successmessagemodal').text(data.message);
					
					setTimeout(function() {
					      $('#updateResendmail').modal('toggle');
					}, 2000);
					

				}else if(data.status == 'NOTFOUND'){

					//$('#paystatusindicator').html('Payment status updated');
					$('#submitresend').text('Sumbit');
					$('#submitresend').attr("disabled", false);	
					$('#errormessagemodal').text(data.message);
					$('#resendemailtype').val('email.regsuccess');

					
				}
			},'json');
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

		$('#add_to_group').click(function(){

				$('#addToGroup').modal();

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

		   	if ($(e.target).is('.viewform')) {
				
				var _id = e.target.id;
				var _rel = $(e.target).attr('rel');
				var url = '{{ URL::base() }}' + '/exhibitor/' + _rel + '/' + _id;
				

				//var url = $(this).attr('url');
			    //var modal_id = $(this).attr('data-controls-modal');
			    $("#viewformModal .modal-body").load(url);
				
				
				$('#viewformModal').modal();

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
				if($(e.target).is('.attendee')){
					var _rel = 'onsite/attendee';
				}else if($(e.target).is('.exhibitorview')){
					var _rel = 'onsite/exhibitor';
				}else if($(e.target).is('.visitor')){
					var _rel = 'onsite/visitor';

				}


				var url = '{{ URL::base() }}' + '/' + _rel + '/' + _id;
				$("#viewformModal .modal-body .row-fluid").remove();
			    $("#viewformModal .modal-body").load(url);
				$('#viewformModal').modal();

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
		
		<?php

			$ajaxexhibitorcheck = (isset($ajaxexhibitorcheck))?$ajaxexhibitorcheck:'/';
		?>

		var $modal = $('#ajax-modal');
 
		$('#boothaddnew').on('click', function(){
		  // create the backdrop and wait for next modal to be triggered
		  $('body').modalmanager('loading');
		 
		  setTimeout(function(){
		     $modal.load('{{ URL::base() }}' + '/onsite/newboothassist', '', function(){
		      $modal.modal();
		    });
		  }, 1000);
		});


		var $modal2 = $('#ajax-modal2');
 
		$('#attendeeaddnew').on('click', function(){
		  // create the backdrop and wait for next modal to be triggered
		  $('body').modalmanager('loading');
		 
		  setTimeout(function(){
		     $modal2.load('{{ URL::base() }}' + '/onsite/addattendee', '', function(){
		      $modal2.modal();
		    });
		  }, 1000);
		});
		 
		/*$modal.on('click', '.update', function(){
			var current_exhibitor_id = $('#exhibitorid').val();
		  	$modal.modal('loading');
		  	setTimeout(function(){
		    	$modal.modal('loading');
		      	$.post('{{ URL::to($ajaxexhibitorcheck) }}',{'id':current_exhibitor_id}, function(data) {
					if(data.status == 'OK'){
						$modal.find('.modal-body').prepend('<div class="alert alert-info fade in">' +
		          		'Updated!<button type="button" class="close" data-dismiss="alert">&nbsp;</button>' +
		        		'</div>');
					}
				},'json');
		  	}, 1000);
		});*/
		

    });
	
  </script>



@endsection