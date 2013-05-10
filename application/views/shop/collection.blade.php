@layout('public')

@section('content')

<div class="row productlist">

	@foreach($mixmatch as $m)
	<div class="span3">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/med_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" class="mixmatch"  /></a>
		<h3>{{$m['name']}}</h3>
		<p>{{$m['priceCurrency']}} {{$m['retailPrice']}}</p>
	</div>
	@endforeach
	

</div>

@endsection