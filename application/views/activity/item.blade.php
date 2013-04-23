<?
$doc_photo = getavatar($doc['creator_id'],$doc['creator_name'],'ten');
//$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'ten');

$class = str_replace('.', '-', $doc['event']);

if($doc['event'] == 'document.create'){
	$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'twelve');
	$body = $doc['creator_name'].' have created '.$doc['doc_title'];

}
elseif($doc['event'] == 'document.upload'){
	$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'twelve');
	$body = $doc['creator_name'].' have created '.$doc['doc_title'];
}
elseif($doc['event'] == 'document.share'){
	$main_photo = getavatar($doc['sharer_id'],$doc['sharer_name'],'twelve');
	$body = $doc['sharer_name'].' have shared '.$doc['doc_title'];
}
elseif($doc['event'] == 'document.update'){
	$main_photo = getavatar($doc['updater_id'],$doc['updater_name'],'twelve');	
	$body = $doc['updater_name'].' have updated '.$doc['doc_title'];
}

elseif($doc['event'] == 'project.create'){
	$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'twelve');
	$body = $doc['creator_name'].' have created '.$doc['doc_title'];

}
elseif($doc['event'] == 'project.upload'){
	$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'twelve');
	$body = $doc['creator_name'].' have created '.$doc['doc_title'];
}
elseif($doc['event'] == 'project.share'){
	$main_photo = getavatar($doc['sharer_id'],$doc['sharer_name'],'twelve');
	$body = $doc['sharer_name'].' have shared '.$doc['doc_title'];
}
elseif($doc['event'] == 'project.update'){
	$main_photo = getavatar($doc['updater_id'],$doc['updater_name'],'twelve');	
	$body = $doc['updater_name'].' have updated '.$doc['doc_number'].' - '.$doc['doc_title'];
}
elseif($doc['event'] == 'request.approval'){
	
	$main_photo = getavatar($doc['requester_id'],$doc['requester_name'],'twelve');

	if($doc['approvalby'] == Auth::user()->email){
		$body = $doc['requester_name'].' have requested document approval from you, please review : <span class="approvalview" id="'.$doc['doc_id'].'">'.$doc['doc_title'].'</span>';
	}else{
		$body = 'You have requested document approval to '.$doc['approvalby'].' for document : <span class="fileview" id="'.$doc['doc_id'].'">'.$doc['doc_filename'].'</span>';
	}
}else{
	$main_photo = getavatar($doc['creator_id'],$doc['creator_name'],'twelve');
	$body = $doc['creator_name'].' have done '.eventtitle($doc['event']);
}

?>


<div class="event-item {{ $class }}">
	<div class="one columns">{{ $main_photo }}</div>
	<div class="eleven columns">
	  <p>
	  	<span class="timestamp">{{date('Y-m-d H:i:s',$doc['timestamp']->sec)}}</span> <strong>{{$doc['title']}}</strong><br />
	  	{{ $body }}<hr />
	  <div class="row">
	    <div class="one columns">{{ $doc_photo }}</div>
	    <div class="eleven columns">
	    	<p>
				Document Title : <span class="metaview" id="{{$doc['doc_id']}}">{{$doc['doc_title']}}</span><br />
				Attachment : <span class="fileview" id="{{$doc['doc_id']}}">{{$doc['doc_filename']}}</span>
	    	</p>
	    </div>
	  </div>
	  </p>
	  <ul class="inline-list">
	    <li><a href="">Reply</a></li>
	    <li><a href="">Share</a></li>
	  </ul>

	<!--
	  <h6>2 Comments</h6>
	  <div class="row">
	    <div class="two columns"><img src="http://placehold.it/50x50&text=[img]" /></div>
	    <div class="ten columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
	  </div>
	  <div class="row">
	    <div class="two columns"><img src="http://placehold.it/50x50&text=[img]" /></div>
	    <div class="ten columns"><p>Bacon ipsum dolor sit amet nulla ham qui sint exercitation eiusmod commodo, chuck duis velit. Aute in reprehenderit</p></div>
	  </div>

	-->
	</div>
</div>

