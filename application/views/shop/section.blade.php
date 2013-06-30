@layout('public')

@section('content')

<div class="row productlist">

	@foreach($products as $m)
	<div class="productpanel">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/med_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" /></a>
		<h3>{{$m['name']}}</h3>
		<p>{{$m['priceCurrency']}} {{idr($m['retailPrice'])}}</p>
	</div>
	@endforeach
	

</div>

@endsection