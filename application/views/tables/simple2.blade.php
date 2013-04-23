@layout('master')

@section('content')

<!--<div class="tableHeader">
	@if($title != '')
		<h3>{{$title}}</h3>
	@endif
	@if(isset($addurl) && $addurl != '')
		<a class="foundicon-add-doc button right newdoc action clearfix" href="{{URL::to($addurl)}}">&nbsp;&nbsp;<span>{{$newbutton}}</span></a>
	@endif
</div>
-->
<div class="span12">
   

    <div class="row-fluid">
       <div class="span12">

          <table class="table table-condensed dataTable attendeeTable">

			    <thead>
			        <tr>
			        	<?php
				        	if(!isset($colclass)){
				        		$colclass = array();
				        	}
			        		$hid = 0;
			        	?>
			        	@foreach($heads as $head)
			        		<th 
			        			@if(isset($colclass[$hid]))
			        				class="{{$colclass[$hid]}}"
			        			@endif
			        			<?php $hid++ ?>
			        		>
			        			{{ $head }}
			        		</th>
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
    </div>

 </div>
<footer class="win-ui-dark win-commandlayout navbar-fixed-bottom">
  <div class="container">
     <div class="row-fluid">
        <div class="span12 align-left">
           <a class="win-command" href="{{ URL::base()}}">
              <span class="win-commandimage win-commandring">!</span>
              <span class="win-label">Home</span>
           </a>

           <hr class="win-command" />

		   	@if(isset($addurl) && $addurl != '')
				<a class="win-command" href="{{URL::to($addurl)}}">
					<span class="win-commandimage win-commandring">&#xe03e;</span>
					<span class="win-label">Add</span>
				</a>
			@endif

		   	@if(isset($reimporturl) && $reimporturl != '')
				<a class="win-command" href="{{URL::to($reimporturl)}}">
					<span class="win-commandimage win-commandring">&#x0055;</span>
					<span class="win-label">Re-Import</span>
				</a>
			@endif

		   	@if(isset($commiturl) && $commiturl != '')
				<a class="win-command" href="{{URL::to($commiturl)}}">
					<span class="win-commandimage win-commandring">&#x0056;&#x0054;</span>
					<span class="win-label">Commit</span>
				</a>
			@endif

		   

        </div>
        
     </div>
  </div>
</footer>

<div id="updatePayment" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Convention Status</h3>
	</div>
	<div class="modal-body">

		{{ Form::select('paystatus', Config::get('eventreg.paystatus'),null,array('id'=>'paystatusselect','class'=>'payselect'))}}
		<br/>
		<br/>
		{{ Form::select('printtax', array('dontprinttax'=>'Dont display tax','printtax'=>'Display tax'),null,array('class'=>'taxdisplaystatus','id'=>'taxdisplaystatusConv','style'=>'display:none;'))}}
		<br/>
		<span id="paystatusindicator"></span>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="savepaystatus">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="updateFormStatus" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Operational Form Status</h3>
	</div>
	<div class="modal-body">

		{{ Form::select('formstatus', Config::get('eventreg.formstatus'),null,array('id'=>'formstatusselect'))}}
		

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="saveformstatus">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="updatePaymentGolf" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Golf Status</h3>
	</div>
	<div class="modal-body">

		{{ Form::select('paystatusgolf', Config::get('eventreg.paystatus'),null,array('id'=>'paystatusselectgolf','class'=>'payselect'))}}
		<br/>
		<br/>
		{{ Form::select('printtax', array('dontprinttax'=>'Dont display tax','printtax'=>'Display tax'),null,array('class'=>'taxdisplaystatus','id'=>'taxdisplaystatusGolf','style'=>'display:none;'))}}
		<br/>
		<span id="paystatusindicator"></span>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="savepaystatusGolf">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>


<div id="updateResendmail" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Resend Email</h3>
	</div>
	<div class="modal-body">
		<label>Select email type to resend:</label>
		{{ Form::select('resendemailtype', Config::get('eventreg.resendemailtype'),null,array('id'=>'resendemailtype'))}}
		<br/><span id="errormessagemodal" class="fontRed"></span><span id="successmessagemodal" class="fontGreen"></span>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="submitresend">Submit</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="exhibitorResendmail" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Send Email</h3>
	</div>
	<div class="modal-body">

		<label>Select email type to resend:</label>
		{{ Form::select('resendemailtype', Config::get('eventreg.exhibitoremailtype'),null,array('id'=>'sendemailtypeexhibitor'))}}
		<br/><span id="exhbitor_errormessagemodal" class="fontRed"></span><span id="exhbitor_successmessagemodal" class="fontGreen"></span>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="submitemailexhibitor">Submit</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>


<div id="viewformModal" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Form Submission</h3>
		
	</div>
	<div class="modal-body" id="loaddata">
		
	</div>
	
	

</div>

<div id="editformModal" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Edit Form</h3>
		
	</div>
	<div class="modal-body" id="loaddata">
		
	</div>
	
	

</div>


<div id="updatePaymentGolfConvention" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Golf & Convention Status</h3>
	</div>
	<div class="modal-body">

		{{ Form::select('paystatusgolfconvention', Config::get('eventreg.paystatus'),null,array('id'=>'paystatusselectgolfconvention','class'=>'payselect'))}}
		<br/>
		<br/>
		{{ Form::select('printtax', array('dontprinttax'=>'Dont display tax','printtax'=>'Display tax'),null,array('class'=>'taxdisplaystatus','id'=>'taxdisplaystatusAll','style'=>'display:none;'))}}
		<br/>
		<span id="paystatusindicator"></span>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="savepaystatusGolfConvention">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>


<div id="addToGroup" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Add Selected to Group</h3>
	</div>
	<div class="modal-body">

		{{ Form::select('paystatus', Config::get('eventreg.paystatus'),null,array('id'=>'paystatusselect'))}}
		<span id="paystatusindicator"></span>

	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="savepaystatus">Save</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>


<div id="printBadge" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Print Badge</h3>
	</div>
	<div class="modal-body">
		<iframe src="{{ URL::base().'/print/badge' }}" id="print_frame" class="span12"></iframe>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="printstart">Print</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
	</div>
</div>

<div id="deleteWarning" class="modal warning hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Confirm Delete</h3>
	</div>
	<div class="modal-body">
		<p id="delstatusindicator" >Are you sure you want to delete this item ?</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-primary" id="confirmdelete">Yes</button>
		<button class="btn" data-dismiss="modal" aria-hidden="true">No</button>
	</div>
</div>

<div id="infodata" class="modal warning hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
	</div>
	<div class="modal-body">
		<p id="statusdata" ></p>
	</div>
	<div class="modal-footer">
		
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
				"sDom": 'Tlrpit',
				@if(isset($excludecol) && $excludecol != '')
				"oColVis": {
					"aiExclude": [ {{ $excludecol }} ]
				},
				@endif
				"oTableTools": {
					"sSwfPath": "{{ URL::base() }}/swf/copy_csv_xls_pdf.swf"
				},
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
			var idtoprocess = [];
			var totalSelected = 0;
			var totalSuccess = 0;	
			var dothat = 0;
			var totalFailure = 0;
			var value = $("#field_action").val();

			$('.selector:checked').each(function() {
				var idRecord = $(this).attr('id');
				idtoprocess.push(idRecord);
				totalSelected++;
			});

			if(value == 'exhibitor.regsuccess'){

				<?php

					$ajaxsendmailexhibitor = (isset($ajaxexhibitorsendmail))?$ajaxexhibitorsendmail:'/';
				?>

				for (var i = 0; i < totalSelected; i++) {
				  	element = idtoprocess[i];
				  	// Do something with element i.
				  	dothat++;
				  	
					$.post('{{ URL::to($ajaxsendmailexhibitor) }}',{'id':element,'type': value}, function(data) {
						if(data.status == 'OK'){

						}else if(data.status == 'NOTFOUND'){
							totalFailure++;
						}else{
							totalFailure++;
						}
					},'json');
				}

				var totalSuccess = totalSelected-totalFailure;
				console.log(totalFailure);

				var datainfo ='Successfully sent mail to '+totalSuccess+' from '+totalSelected+' selected data';
				alert(datainfo);
				oTable.fnStandingRedraw();
				$("#field_action").val('none');
			
			}else{
				alert(value);
			}
			
			

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
			var taxdisplaystatus = $('#taxdisplaystatusConv').val();
			$('#savepaystatus').text('Processing..');
			$('#savepaystatus').attr("disabled", true);	

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpay) }}',{'id':current_pay_id,'paystatus': paystat,'taxdisplaystatus':taxdisplaystatus}, function(data) {
				if(data.status == 'OK'){
					//redraw table
					oTable.fnStandingRedraw();
					
					$('#paystatusindicator').html('Payment status updated');
					$('#savepaystatus').text('Save');
					$('#savepaystatus').attr("disabled", false);	
					
					$('#paystatusselect').val('unpaid');
					$('.taxdisplaystatus').hide();
					$('.taxdisplaystatus').val('dontprinttax');

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
			var taxdisplaystatus = $('#taxdisplaystatusGolf').val();
			$('#savepaystatusGolf').text('Processing..');
			$('#savepaystatusGolf').attr("disabled", true);	

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpaygolf) }}',{'id':current_pay_id,'paystatusgolf': paystat,'taxdisplaystatus':taxdisplaystatus}, function(data) {
				if(data.status == 'OK'){
					//redraw table

					oTable.fnStandingRedraw();
					$('#paystatusindicator').html('Payment status updated');
					$('#savepaystatusGolf').text('Save');
					$('#savepaystatusGolf').attr("disabled", false);	

					$('#paystatusselectgolf').val('unpaid');
					$('.taxdisplaystatus').hide();
					$('.taxdisplaystatus').val('dontprinttax');
					$('#updatePaymentGolf').modal('toggle');

				}
			},'json');
		});


		$('#savepaystatusGolfConvention').click(function(){
			var paystat = $('#paystatusselectgolfconvention').val();
			var taxdisplaystatus = $('#taxdisplaystatusAll').val();
			$('#savepaystatusGolfConvention').text('Processing..');
			$('#savepaystatusGolfConvention').attr("disabled", true);	

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpaygolfconvention) }}',{'id':current_pay_id,'paystatusgolfconvention': paystat,'taxdisplaystatus':taxdisplaystatus}, function(data) {
				if(data.status == 'OK'){
					//redraw table

					oTable.fnStandingRedraw();
					$('#paystatusindicator').html('Payment status updated');
					$('#savepaystatusGolfConvention').text('Save');
					$('#savepaystatusGolfConvention').attr("disabled", false);	

					$('#paystatusselectgolfconvention').val('unpaid');
					$('.taxdisplaystatus').hide();
					$('.taxdisplaystatus').val('dontprinttax');

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


		$('#submitemailexhibitor').click(function(){
			var emailtype = $('#sendemailtypeexhibitor').val();
			$('#submitemailexhibitor').text('Processing..');
			$('#submitemailexhibitor').attr("disabled", true);	

			<?php

				$ajaxsendmailexhibitor = (isset($ajaxexhibitorsendmail))?$ajaxexhibitorsendmail:'/';
			?>

			$.post('{{ URL::to($ajaxsendmailexhibitor) }}',{'id':current_pay_id,'type': emailtype}, function(data) {
				if(data.status == 'OK'){
					//redraw table
					
					oTable.fnStandingRedraw();

					//$('#paystatusindicator').html('Payment status updated');
					$('#submitemailexhibitor').text('Success');
					

					$('#sendemailtypeexhibitor').val('exhibitor.regsuccess');
					$('#exhbitor_errormessagemodal').text('');
					$('#exhbitor_successmessagemodal').text(data.message);
					
					setTimeout(function() {
					    $('#exhibitorResendmail').modal('toggle');
					    $('#submitemailexhibitor').text('Sumbit');
						$('#submitemailexhibitor').attr("disabled", false);	
					}, 2000);
					

				}else if(data.status == 'NOTFOUND'){

					//$('#paystatusindicator').html('Payment status updated');
					$('#submitemailexhibitor').text('Sumbit');
					$('#submitemailexhibitor').attr("disabled", false);	
					$('#exhbitor_errormessagemodal').text(data.message);
					$('#sendemailtypeexhibitor').val('exhibitor.regsuccess');

					
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