@layout('public')

@section('content')

<div class="row">
	<div class="span3 pull-right">
	{{ Form::select('category',Config::get('shoplite.search_categories')) }}
	</div>
</div>
<div class="row productlist">

	@foreach($products as $m)
	<div class="span3">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/med_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" class="mixmatch"  /></a>
		<h3>{{$m['name']}}</h3>
		<p>{{$m['priceCurrency']}} {{$m['retailPrice']}}</p>
	</div>
	@endforeach
	

</div>

@endsection