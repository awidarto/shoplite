@layout('blank')

@section('content')


<div class="row-fluid">
	
			<h2>{{ $profile['firstname'].' '.$profile['lastname'] }}</h2>
			<table class="profile-info profilepopup">
				<tr>
					<td class="detail-title">Registration Number</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['registrationnumber'] }}
						
					</td>
				</tr>
				<tr>
					<td class="detail-title">Email</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['email'] }}</td>
				</tr>
				
				<tr>
					<td class="detail-title">Mobile Phone Number</td>
					<td>:&nbsp;</td>
					<td class="detail-info">
						{{ $profile['mobile'] }}
					</td>
				</tr>
				
			</table>
			<table class="secondtable">
				<tr><td colspan="3"><h4>Company Information</h4></td></tr>

				<tr>
					<td class="detail-title">Company Name</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['company'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Visitor Type</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['role'] }}</td>
				</tr>

				<tr>
					<td class="detail-title">Country</td>
					<td>:&nbsp;</td>
					<td class="detail-info">{{ $profile['country'] }}</td>
				</tr>

				
				
			</table>

			
			<div class="clear"></div>
			
			@if(Auth::user()->role == 'onsite')
				@if(isset($profile['printbadge']) && ($profile['printbadge']!=''))
					<br/>
					<p>This user already {{$profile['printbadge']}} printed the badge, please input PIN for re-print</p>
					<input type="password" id="supervisorpin"></input><br/><button class="btn btn-info" value="Submit" id="submitpin">Submit for reprint</button>
					<!--<button class="printonsite btn btn-info" id="printstart" disabled="disabled"><i class="icon-">&#xe14c;</i>&nbsp;&nbsp;PRINT BADGE</button>-->
					<iframe src="{{ URL::to('visitor/printbadgeonsite/') }}{{ $profile['_id']}}" id="print_frame" style="display:none;" class="span12"></iframe>
				@else
					<button class="printonsite btn btn-info" id="printstart"><i class="icon-">&#xe14c;</i>&nbsp;&nbsp;PRINT BADGE</button>
					<iframe src="{{ URL::to('visitor/printbadgeonsite/') }}{{ $profile['_id']}}" id="print_frame" style="display:none;" class="span12"></iframe>
				@endif

			@elseif(Auth::user()->role == 'cashier')
				
			@endif
			</div>

	
</div>
<script type="text/javascript">
<?php
	
	
	$ajaxprintbadge = (isset($ajaxprintbadge))?$ajaxprintbadge:'/';
	$userid = $profile['_id']->__toString();
	
?>



$('#printstart').click(function(){
	$.post('{{ URL::to($ajaxprintbadge) }}',{'id':'{{$userid}}'}, function(data) {
		if(data.status == 'OK'){
			var pframe = document.getElementById('print_frame');
			var pframeWindow = pframe.contentWindow;
			pframeWindow.print();
		}
	},'json');

});

$('#submitpin').click(function(){
	var pintrue = '{{ Config::get("eventreg.pinsupervisorconvention") }}';
	var pinvalue = $('#supervisorpin').val();
	if(pinvalue == pintrue){
		$.post('{{ URL::to($ajaxprintbadge) }}',{'id':'{{$userid}}'}, function(data) {
			if(data.status == 'OK'){
				var pframe = document.getElementById('print_frame');
				var pframeWindow = pframe.contentWindow;
				pframeWindow.print();
				$('#supervisorpin').val('');
			}
		},'json');
	}else{
		alert("Wrong PIN, please try again");
	}

});

$('#printstartcashier').click(function(){
	var pframe = document.getElementById('print_frame');
	var pframeWindow = pframe.contentWindow;
	pframeWindow.print();

});

</script>
@endsection