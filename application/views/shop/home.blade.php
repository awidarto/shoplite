@layout('public')

@section('content')
<div class="row">
	@foreach($mixmatch as $m)
	<div class="span4">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/lar_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" class="mixmatch"  /></a>
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
	<div class="articlesetionhome">
		<div class="span4">
			<div class="articlehome">
				<h2 class="titlehome">Mix and Match 01</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin fringilla dolor, eu fringilla libero iaculis in. 
					
				</p>
				<a class="readmore">readmore ></a>
			</div>
			<div class="articlehome">
				<h2 class="titlehome">Mix and Match 02</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin fringilla dolor, eu fringilla libero iaculis in. Nunc sodales laoreet purus, et pharetra orci venenatis ut. Vestibulum nisi arcu, porta ut aliquet id, accumsan ut dui. 
					
				</p>
				<a class="readmore">readmore ></a>
			</div>
		</div>

		<div class="span4">
			<div class="articlehome">
				<h2 class="titlehome">PICK OF THE WEEK: March 1 2013</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin 
					
				</p>
				<a class="readmore">readmore ></a>
			</div>
			<div class="articlehome">
				<h2 class="titlehome">PICK OF THE WEEK: February 21 2013</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
					
				</p>
				<a class="readmore">readmore ></a>
			</div>
		</div>

		<div class="span4">
			<div class="articlehome">
				<h2 class="titlehome">ONE OF A KIND</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin fringilla dolor, eu fringilla libero iaculis in. 
					
				</p>
				
			</div>
			<div class="articlehome">
				<h2 class="titlehome">FASHION TIPS OF THE WEEK</h2>
				<p>
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla sollicitudin fringilla dolor, eu fringilla libero iaculis in. Nunc sodales laoreet purus, et pharetra orci venenatis ut. 
					
				</p>
				
			</div>
		</div>
	</div>

</div>


@endsection