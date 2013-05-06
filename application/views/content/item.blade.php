<h5 class="_pop" rel="{{$popsrc}}" id="{{$doc['_id']}}">{{HTML::link('content/view/'.$doc['section'].'/'.$doc['category'].'/'.$doc['slug'],$doc['title']) }}</h5>
<span class="label">Created :</span> {{date('Y-m-d H:i:s', $doc['createdDate']->sec)}} <span class="label">Last Update :</span> 
{{isset($doc['lastUpdate'])?date('Y-m-d H:i:s', $doc['lastUpdate']->sec):''}}
<br />
<span class="label">Created by :</span> {{$doc['creatorName']}}<br />
<p>
{{$doc['description']}}
</p>
