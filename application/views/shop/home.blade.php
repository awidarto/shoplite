@layout('publichome')

@section('content')

<div class="row-fluid">
	@for($idx = 0;$idx < 3;$idx++)
		<?php
			$mm = array_pop($mixmatch);
		?>
		<div class="span4">
			@if(isset($mm) && isset($mm['homepic']))
				<a href="{{ URL::base() }}/shop/detail/{{$mm['_id']}}"><img src="{{ URL::base().'/storage/products/'.$mm['_id'].'/lar_port_pic0'.$mm['homepic'].'.jpg' }}" alt="{{ $mm['name']}}"  /></a>
			@else
				<a href="#"><img src="http://placehold.it/335x632&text=Placeholder Image" /></a>
			@endif
		</div>

	@endfor
</div>
<div class="clear"></div>
<div class="row-fluid" style="margin-top:8px;">
		<div class="span4">
			<?php
				$mm = array_pop($pow);
			?>
			@if(isset($mm)  && isset($mm['homepic']) )
				<a href="{{ URL::base() }}/shop/detail/{{$mm['_id']}}"><img src="{{ URL::base().'/storage/products/'.$mm['_id'].'/lar_sq_pic0'.$mm['homepic'].'.jpg' }}" alt="{{ $mm['name']}}"  /></a>
			@else
				<a href="#"><img src="http://placehold.it/335x335&text=Placeholder Image" /></a>
			@endif
		</div>
		<div class="span4">
			<?php
				$mm = array_pop($otb);
			?>
			@if(isset($mm) && isset($mm['homepic']) )
				<a href="{{ URL::base() }}/shop/detail/{{$mm['_id']}}"><img src="{{ URL::base().'/storage/products/'.$mm['_id'].'/lar_sq_pic0'.$mm['homepic'].'.jpg' }}" alt="{{ $mm['name']}}"  /></a>
			@else
				<a href="#"><img src="http://placehold.it/335x335&text=Placeholder Image" /></a>
			@endif
		</div>
		<div class="span4">
			<?php
				$mm = array_pop($kind);
			?>
			@if(isset($mm) && isset($mm['homepic']) )
				<a href="{{ URL::base() }}/shop/detail/{{$mm['_id']}}"><img src="{{ URL::base().'/storage/products/'.$mm['_id'].'/lar_sq_pic0'.$mm['homepic'].'.jpg' }}" alt="{{ $mm['name']}}"  /></a>
			@else
				<a href="#"><img src="http://placehold.it/335x335&text=Placeholder Image" /></a>
			@endif
		</div>

</div>

<div class="clear"></div>

<div class="row-fluid">

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