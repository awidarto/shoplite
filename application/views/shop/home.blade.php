@layout('public')

@section('content')
<div class="row">
	@foreach($mixmatch as $m)
	<div class="span4">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/lar_port_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" class="mixmatch"  /></a>
	</div>

	@endforeach
</div>

<div class="row">
	@foreach($pow as $m)
	<div class="span4">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/lar_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" class="mixmatch"  /></a>
	</div>
	
	@endforeach
</div>

<div class="row">

	@for($i = 0;$i < 3;$i++)

		<div class="articlesetionhome span4" style="display:block;">
		
			@for($a = 0;$a < 2;$a++)

				@if($article = array_pop($articles))
					@if(isset($article))

						<div class="articlehome">
							<h2 class="titlehome">{{ $article['title']}}</h2>
							<p>
								{{ $article['shorts']}}						
							</p>
							<a class="readmore" href="{{ URL::to('reader/article/'.$article['slug']) }}" >readmore ></a>
						</div>
					@else
						<div class="articlehome">
							&nbsp;
						</div>
					@endif
				@else
					<div class="articlehome">
							&nbsp;
					</div>
				@endif

			@endfor

		</div>

	@endfor

</div>


@endsection