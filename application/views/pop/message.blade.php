@layout('dialog')

@section('content')

<?php
	$main_photo = getavatar($doc['fromId'],$doc['from'],'twelve');
?>
<div class="row">
	<div class="one columns">{{ $main_photo }}</div>
	<div class="eleven columns">
	  <p>
	  	<span class="timestamp">{{date('Y-m-d H:i:s',$doc['createdDate']->sec)}}</span><br />
	  	<span class="from">From : <strong>{{$doc['from']}}</strong></span><br />
	  	<span class="to">To : <strong>{{$doc['to']}}</strong></span><br />

	  	<span class="subject">Subject : <strong>{{$doc['subject']}}</strong></span>
	  	<hr />
	  </p>
	  	<div id="message-body">
		  	{{ $doc['body'] }}
	  	</div>
	</div>
</div>


@endsection

