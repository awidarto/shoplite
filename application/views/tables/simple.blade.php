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
	
   @if (Session::has('notify_operationalform'))
        <div class="alert alert-error">
             {{Session::get('notify_operationalform')}}
        </div>
    @endif

    <div class="row-fluid">
       <div class="span12">

          <table class="table table-condensed dataTable attendeeTable">

			    <thead>

			        <tr>
			        	@foreach($heads as $head)
			        		@if(is_array($head))
			        			<th 
			        				@foreach($head[1] as $key=>$val)
			        					@if(!is_array($val))
			        						{{ $key }}="{{ $val }}"
			        					@endif
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
			        @if(isset($secondheads) && !is_null($secondheads))
			        	<tr>
			        	@foreach($secondheads as $head)
			        		@if(is_array($head))
			        			<th 
			        				@foreach($head[1] as $key=>$val)
			        					@if($key != 'search')
				        					{{ $key }}="{{ $val }}"
			        					@endif
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
			        @endif
			    </thead>

				<?php
					$form = new Formly();
				?>

			    <thead id="searchinput">
				    <tr>
			    	@foreach($heads as $in)
			    		@if( $in[0] != 'select_all' && $in[0] != '')
				    		@if(isset($in[1]['search']) && $in[1]['search'] == true)
				    			@if(isset($in[1]['date']) && $in[1]['date'])
					        		<td>
										<div id="search_{{$in[0]}}" class="input-append datepickersearch">
										    <input name="search_{{$in[0]}}" data-format="dd-MM-yyyy" class="search_init dateinput" type="text" placeholder="Search {{$in[0]}}" ></input>
										    <span class="add-on">
												<i data-time-icon="icon-clock" data-date-icon="icon-calendar">
												</i>
										    </span>
										</div>
					        		</td>
				    			@elseif(isset($in[1]['datetime']) && $in[1]['datetime'])
					        		<td>
										<div id="search_{{$in[0]}}" class="input-append datetimepickersearch">
										    <input name="search_{{$in[0]}}" data-format="dd-MM-yyyy hh:mm:ss" class="search_init datetimeinput" type="text" placeholder="Search {{$in[0]}}" ></input>
										    <span class="add-on">
												<i data-time-icon="icon-clock" data-date-icon="icon-calendar">
												</i>
										    </span>
										</div>
					        		</td>
				    			@elseif(isset($in[1]['select']) && is_array($in[1]['select']))
				    				<td>
				    					<input type="text" name="search_{{$in[0]}}" id="search_{{$in[0]}}" placeholder="Search {{$in[0]}}" value="" style="display:none;" class="search_init {{ (isset($in[1]['class']))?$in[1]['class']:'filter'}}" />
				    					<div class="styled-select">
					    					{{ Form::select('select_'.$in[0],$in[1]['select'],null,array('class'=>'selector input-small'))}}
				    					</div>
				    				</td>
				    			@else
					        		<td><input type="text" name="search_{{$in[0]}}" id="search_{{$in[0]}}" placeholder="Search {{$in[0]}}" value="" class="search_init {{ (isset($in[1]['class']))?$in[1]['class']:'filter'}}" /></td>
				    			@endif
			    			@else
				    			@if(isset($in[1]['clear']) && $in[1]['clear'] == true)
				    				<td><span id="clearsearch">Clear Search</span></td>
				    			@else
					        		<td>&nbsp;</td>
				    			@endif
			    			@endif
				    			

			    		@elseif($in[0] == 'select_all')
		    				<td>{{ $form->checkbox('select_all','','',false,array('id'=>'select_all')) }}</td>				    		
			    		@elseif($in[0] == '')
			        		<td>&nbsp;</td>
			    		@endif
			    	@endforeach
				    </tr>
			    </thead>

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

		   	@if(isset($form))
	           <hr class="win-command" />

		   		<div class="row-fluid selectionCommandList">
		   			<div class="span3 text">
		   				Use selection for:
		   			</div>
		   			<div class="span5">
		   				<div class="styled-menu-select">
			   				@if(isset($ajaxexhibitorsendmail))
					   			{{ $form->select('action','',Config::get('kickstart.actionselectionexhibitor'))}}
					   		@else
					   			{{ $form->select('action','',Config::get('kickstart.actionselection'))}}
					   		@endif
		   				</div>
		   			</div>
						<a class="win-command" id="do_action">
							<span class="win-commandimage win-commandring">&#xe132;</span>
						</a>
		   			
		   			<!--<div class="span7">
		   				&nbsp;
		   			</div>-->
		   		</div>
			@endif

        </div>
        
     </div>
  </div>
</footer>

@yield('dialog')

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

		asInitVals = new Array();
        
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

		//header search

		$('thead input.filter').keyup( function () {
			console.log($('thead input').index(this));
			/* Filter on the column (the index) of this element */
			var search_index = $('thead input').index(this);
			oTable.fnFilter( this.value, search_index );
		} );

		$('thead input.dateinput').change( function () {
			/* Filter on the column (the index) of this element */
			console.log($('thead input').index(this));
			var search_index = $('thead input').index(this);
			oTable.fnFilter( this.value,  search_index  );
		} );

		$('thead input.datetimeinput').change( function () {
			/* Filter on the column (the index) of this element */
			console.log($('thead input').index(this));
			var search_index = $('thead input').index(this);
			oTable.fnFilter( this.value,  search_index  );
		} );

		eldatetime = $('.datetimepickersearch').datetimepicker({
			maskInput: false, 
		});

		eldate = $('.datepickersearch').datetimepicker({
			maskInput: false, 
			pickTime: false
		});


		eldate.on('changeDate', function(e) {
			console.log(this);
			var ins = $(this).find('input');
			console.log(ins);
			console.log($('thead input').index(ins));
			var search_index = $('thead input').index(ins);
			oTable.fnFilter( $(ins).val(),  search_index  );
		});

		eldatetime.on('changeDate', function(e) {
			console.log(this);
			var ins = $(this).find('input');
			console.log(ins);
			console.log($('thead input').index(ins));
			var search_index = $('thead input').index(ins);
			oTable.fnFilter( $(ins).val(),  search_index  );
		});

		$('thead select.selector').change( function () {
			/* Filter on the column (the index) of this element */
			var prev = $(this).prev('input');
			var search_index = $('thead input').index(prev);
			console.log(search_index);
			oTable.fnFilter( this.value,  search_index  );
		} );

		$('#clearsearch').click(function(){
			$('thead input').val('');
		});
		/*
		 * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
		 * the footer
		 */
		/*
		$('thead input').each( function (i) {
			asInitVals[i] = this.value;
		} );

		$('thead input.filter').focus( function () {
			
			console.log(this);

			if ( this.className == 'search_init' )
			{
				this.className = '';
				this.value = '';
			}
		} );

		$('thead input.filter').blur( function (i) {
			console.log(this);
			if ( this.value == '' )
			{
				this.className = 'search_init';
				this.value = asInitVals[$('thead input').index(this)];
			}
		} );
			
		*/

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