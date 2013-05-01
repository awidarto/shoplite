@layout('noaside')


@section('content')
<div class="tableHeader">
	@if($title != '')
		<h3>{{$title}}</h3>
	@endif
	@if(isset($addurl))
		<a class="foundicon-add-doc button right newdoc action clearfix" href="{{URL::to($addurl)}}">&nbsp;&nbsp;<span>{{$newbutton}}</span></a>
	@endif
</div>
<div class="row">
	<table class="dataTable">
	    <thead>
	        <tr>
	        	@foreach($heads as $head)
	        		<th>
	        			{{ $head }}
	        		</th>
	        	@endforeach
	        </tr>
	    </thead>
	    <tbody>
	    </tbody>
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
	</table>
</div>

<div id="view_dialog" title="Order Detail" style="overflow:hidden;padding:8px;">
	<input type="hidden" value="" id="print_id" />
	<iframe id="view_frame" name="print_frame" width="100%" height="100%"
    marginWidth="0" marginHeight="0" frameBorder="0" scrolling="auto"
    title="Dialog Title">Your browser does not suppr</iframe>
</div>

  <script type="text/javascript">
    $(document).ready(function(){
		var asInitVals = new Array();
        var oTable = $('.dataTable').DataTable(
			{
				"bProcessing": true,
		        "bServerSide": true,
		        "sAjaxSource": "{{$ajaxsource}}",
				"oLanguage": { "sSearch": "Search "},
				"sPaginationType": "full_numbers",
				"sDom": 'T<"clear">lfrtip',
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

		$('table.dataTable').click(function(e){

			if ($(e.target).is('.del')) {
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

			if ($(e.target).is('.fileview')) {
				var _id = e.target.id;

				$.fancybox({
					type:'iframe',
					href: '{{ URL::to("document/fileview/") }}' + _id,
					autosize: true
				});

		   	}		   			   	

			if ($(e.target).is('.metaview')) {
				var doc_id = e.target.id;
				var src = '{{ URL::to('document/view/')}}' + doc_id;

				$.fancybox({
					type:'iframe',
					href: '{{ URL::to("document/view/") }}' + _id,
					autosize: true
				});
			}

		});


		$('#view_dialog').dialog({
			autoOpen: false,
			height: 600,
			width: 900,
			modal: true,
			buttons: {
				Save: function(){
					var nframe = document.getElementById('view_frame');
					var nframeWindow = nframe.contentWindow;
					nframeWindow.submitorder();
				}, 
				Print: function(){
					var pframe = document.getElementById('print_frame');
					var pframeWindow = pframe.contentWindow;
					pframeWindow.print();
				}, 
				Close: function() {
					oTable.fnDraw();
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
		});
    });
  </script>

@endsection