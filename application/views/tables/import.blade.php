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

    <!--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>-->

    <div class="row-fluid">
       <div class="span12">
    @if (Session::has('notify_success'))
        <div class="alert alert-error">
             {{Session::get('notify_success')}}
        </div>
    @endif


{{$form->open('import/commit/'.$importid,'POST',array('class'=>'custom','id'=>'commit_form'))}}

			{{ $form->hidden('importid',$importid)}}
			{{ $form->hidden('head_count',$head_count)}}

			{{ $form->hidden('type',$type)}}

			@if($type == 'exhibitor')

				{{ $form->hidden('exhibitor_id','')}}
				{{ $form->hidden('salutation','')}}
                {{ $form->hidden('firstname','')}}
                {{ $form->hidden('lastname','') }}
                {{ $form->hidden('position','') }}
                {{ $form->hidden('email','') }}
                {{ $form->hidden('mobile','') }}
                {{ $form->hidden('company','') }}

			@else
			<div class="row-fluid">
				<div class="span1"><strong>Choose option :</strong></div>
				<!--<div class="span3">
			        <fieldset>
			            <legend>Send Notification to PIC</legend>

			                <div class="row-fluid">
			                    <div class="span4">
			                      {{ $form->radio('sendpic','Yes','Yes',true) }}
			                    </div>
			                    <div class="span4">
			                      {{ $form->radio('sendpic','No','No') }}
			                    </div>
			                    <div class="span4"></div>
			                </div>

			        </fieldset>
				</div>-->

				<div class="span3">
			        <fieldset>
			            <legend>Include attendee summary in PIC notification</legend>

			                <div class="row-fluid">
			                    <div class="span4">
			                      {{ $form->radio('attendeesummary','Yes','Yes',true) }}
			                    </div>
			                    <div class="span4">
			                      {{ $form->radio('attendeesummary','No','No') }}
			                    </div>
			                    <div class="span4"></div>
			                </div>

			        </fieldset>
				</div>

				<!--<div class="span3">
			        <fieldset>
			            <legend>Send Notification to each attendee</legend>

			                <div class="row-fluid">
			                    <div class="span4">
			                      {{ $form->radio('sendattendee','Yes','Yes') }}
			                    </div>
			                    <div class="span4">
			                      {{ $form->radio('sendattendee','No','No',true) }}
			                    </div>
			                    <div class="span4"></div>
			                </div>

			        </fieldset>

				</div>-->
				<div class="span3">
			        <fieldset>
			            <legend>Update password for existing attendee</legend>

			                <div class="row-fluid">
			                    <div class="span4">
			                      {{ $form->radio('updatepass','Yes','Yes') }}
			                    </div>
			                    <div class="span4">
			                      {{ $form->radio('updatepass','No','No',true) }}
			                    </div>
			                    <div class="span4"></div>
			                </div>

			        </fieldset>

				</div>

				<div class="span3">
			        <fieldset>
			            <legend>Use Early Bird Rate</legend>

			                <div class="row-fluid">
			                    <div class="span4">
			                      {{ $form->radio('earlybird','Yes','Yes') }}
			                    </div>
			                    <div class="span4">
			                      {{ $form->radio('earlybird','No','No',true) }}
			                    </div>
			                    <div class="span4"></div>
			                </div>

			        </fieldset>

				</div>
				<div class="span2">&nbsp;</div>

			</div>
			<div class="row-fluid">
				<div class="span1">&nbsp;</div>
				<div class="span3">
			        <fieldset>
			            <legend>FOC</legend>

			                <div class="row-fluid">
			                    <div class="span4">
			                      {{ $form->radio('foc','Yes','Yes') }}
			                    </div>
			                    <div class="span4">
			                      {{ $form->radio('foc','No','No',true) }}
			                    </div>
			                    <div class="span4"></div>
			                </div>

			        </fieldset>

				</div>
			</div>

			@endif

			<hr />
			<div class="row-fluid">
				<div class="span1"><strong>Legend :</strong></div>
				<div class="span2"><span class="invalidhead">invalid heads</span></div>
				<div class="span2"><span class="duplicateemail">email already exists</span></div>
				<div class="span7"></div>
			</div>
			<hr />

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

		    	@if($searchinput)
				    <thead id="searchinput">
					    <tr>
				    	@foreach($searchinput as $in)
				    		@if($in)
				        		<td>{{ $in }}</td>
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

             <!--
		    	@if($searchinput)
				    <tfoot>
					    <tr>
				    	@foreach($searchinput as $in)
				    		@if($in)
				        		<td><input type="text" name="search_{{$in}}" id="search_{{$in}}" value="Search {{$in}}" class="search_init" /></td>
				    		@else
				        		<td>&nbsp;</td>
				    		@endif
				    	@endforeach
					    </tr>
				    </tfoot>
			    @endif
			-->
          </table>

{{$form->close()}}

       </div>
    </div>

 </div>
<footer class="win-ui-dark win-commandlayout navbar-fixed-bottom">
  <div class="container">
     <div class="row">
        <div class="span6 align-left">
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
				<a class="win-command" id="commit-trigger">
					<span class="win-commandimage win-commandring">&#x0056;&#x0054;</span>
					<span class="win-label">Commit</span>
				</a>

				<script type="text/javascript">
					$('#commit-trigger').click(function(){
						$('#commit_form').submit();
					});
				</script>
			@endif

        </div>

     </div>
  </div>
</footer>

<div id="updatePayment" class="modal message hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<h3 id="myModalLabel">Payment Status</h3>
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

		$('.activity-list').tooltip();

		var asInitVals = new Array();

        oTable = $('.dataTable').DataTable(
			{
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{$ajaxsource}}",
				"oLanguage": { "sSearch": "Search "},
				"sPaginationType": "full_numbers",
				"sDom": 'lrpi<"tabscroll" t>T',
				"oTableTools": {
					"sSwfPath": "assets/swf/copy_csv_xls_pdf.swf"
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


		$('#select_all').click(function(){
			if($('#select_all').is(':checked')){
				$('.selector').attr('checked', true);
			}else{
				$('.selector').attr('checked', false);
			}
		});

		$('#override_all').click(function(){
			if($('#override_all').is(':checked')){
				$('.overselector').attr('checked', true);
			}else{
				$('.overselector').attr('checked', false);
			}
		});

		$('#savepaystatus').click(function(){
			var paystat = $('#paystatusselect').val();

			<?php

				$ajaxpay = (isset($ajaxpay))?$ajaxpay:'/';
			?>

			$.post('{{ URL::to($ajaxpay) }}',{'id':current_pay_id,'paystatus': paystat}, function(data) {
				if(data.status == 'OK'){
					//redraw table

					oTable.fnDraw();
					$('#paystatusindicator').html('Payment status updated');

					$('#paystatusselect').val('unpaid');

					$('#updatePayment').modal('toggle');

				}
			},'json');
		});


		$('table.dataTable').click(function(e){

			if ($(e.target).is('._del')) {
				var _id = e.target.id;
				var answer = confirm("Are you sure you want to delete this item ?");
				if (answer){
					$.post('{{ URL::to($ajaxdel) }}',{'id':_id}, function(data) {
						if(data.status == 'OK'){
							//redraw table
							oTable.fnDraw();
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

		//function to show add attendee to group
		/*$(".selector").live("click", function(){
			if ($('.selector').is(':checked')) {
			    $(".add_to_group").show();
			} else {
			    $(".add_to_group").hide();
			}
		});
		$("#select_all").live("click", function(){
			if ($('.selector').is(':checked')) {
			    $(".add_to_group").show();
			} else {
			    $(".add_to_group").hide();
			}
		});*/



    });
  </script>

@endsection