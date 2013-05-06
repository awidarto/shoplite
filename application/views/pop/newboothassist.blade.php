@layout('blank')

@section('content')


	
	<div class="modal-header">
		<button type="button" id="removeviewform" class="close" data-dismiss="modal" aria-hidden="true"></button>
		<br/>
		<br/>
		<br/>
		<br/>
		<h3 id="myModalLabel">Please Input data:</h3>
		
		{{ $form->hidden('exhibitorid','',array('id'=>'exhibitorid'))}}
		{{ $form->text('code','Voucher Code.req','',array('id'=>'codebooth','class'=>'span4'))}}
        {{ $form->text('exhibitor','Company Name ( autocomplete, use company name to search ).req','',array('id'=>'exhibitorName','class'=>'auto_exhibitor span8'))}}
        {{ $form->text('name','Input Full Name.req','',array('id'=>'boothnameinput','class'=>' span8'))}}
        <button class="btn update" id="submitaddassistant">Submit</button>
		
	</div>
	<div class="modal-body" id="loaddata">
		
	</div>
	
	

</div>
<script type="text/javascript">
$(document).ready(function(){
	$('.auto_exhibitor').autocomplete({
		source: base + 'ajax/exhibitor',
		select: function(event, ui){
			$('#exhibitorid').val(ui.item.id);
			hallId = $('#exhibitorid').val();
		}
	});
});


$('#submitaddassistant').click(function(){
    var current_pass_name = $('#boothnameinput').val();
    var companyname = $('#exhibitorName').val();
    var exhibitorid = $('#exhibitorid').val();
    var codebooth = $('#codebooth').val().toUpperCase();

    
    
    <?php
      $ajaxonsitefreeadd = (isset($ajaxonsitefreeadd))?$ajaxonsitefreeadd:'/';
    ?>
    if(current_pass_name==''){
    	
	    alert('Error, cannot proccess data, please try again');

	}else if(codebooth !='K' && codebooth!='M' && codebooth!='H'){
		alert('Error, wrong voucher code, please try again');
	}else{
		if(codebooth == 'K'){
			var current_type = 'addboothname';
		}else if(codebooth == 'M'){

			var current_type = 'freepassname';

		}else if(codebooth == 'H'){
			var current_type = 'boothassistant';
		}

	 	$.post('{{ URL::to($ajaxonsitefreeadd) }}',{'exhibitorid':exhibitorid,'companyname':companyname,'passname':current_pass_name,'type':current_type}, function(data) {
	    	
	    	

	    	$('#submitaddassistant').text('Processing..');
			$('#submitaddassistant').attr("disabled", true);
	      	
	    	if(data.status == 'OK'){
	        	$('#submitaddassistant').text('Submit');
				$('#submitaddassistant').attr("disabled", false);
				//add iframe
    			$('<iframe />', {
				    name: 'myFrame',
				    id:   'printbadgenewfree',
				    style: 'display:none;',
				    src: '{{ URL::to("exhibitor/newprintbadgeonsite") }}/'+data.regnumber+'/'+current_pass_name+'/'+companyname+'/'+current_type
				}).appendTo('#ajax-modal');
    			//print

    			setTimeout(function() {
				    var pframe = document.getElementById('printbadgenewfree');
					var pframeWindow = pframe.contentWindow;
					pframeWindow.print();
				}, 1500);
    			

	        	$('#ajax-modal').modal('hide');
    			

	      	}else{
	    		alert('Error, cannot proccess data, please try again');  		
	      	}
	    },'json');
	 	
	}
	return false;
  
});
</script>
@endsection