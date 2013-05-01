@section('tagcloud')
	<div class="panel sidepanel">
	    <h4><span class="foundicon-heart"></span>&nbsp;&nbsp;Tags</h4>
		@if(isset($tags))
			@foreach($tags as $t)
				<span class="tagitem">{{$t['tag']}}</span>
			@endforeach
		@endif
	</div>
@endsection