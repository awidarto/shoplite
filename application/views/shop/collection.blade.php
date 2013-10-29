@layout('public')

@section('content')
<div class="row">
	<div class="span3">
		<h5 style="margin-left:60px;margin-top:26px;">Showing {{ $showcount }} items of {{ $totalfound }}</h5>
	</div>
	<div class="span6" style="text-align:right">
		 {{ $pagination }}
	</div>
	<div class="span3 pull-right">
		<div class="styled-select">
			{{ Form::select('category',Config::get('shoplite.front_categories'),$category,array('id'=>'cat-select')) }}
		</div>
	</div>
</div>
<div class="row productlist">

	@foreach($products as $m)
	<div class="productpanel">
		<a href="{{ URL::base() }}/shop/detail/{{$m['_id']}}"><img src="{{ URL::base().'/storage/products/'.$m['_id'].'/med_pic0'.$m['defaultpic'].'.jpg' }}" alt="{{ $m['name']}}" /></a>
		<h3>{{$m['name']}}</h3>
		<p>{{$m['priceCurrency']}} {{idr($m['retailPrice'])}}</p>
	</div>
	@endforeach


</div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#cat-select').change(function(){

			window.location.assign('{{ URL::to('collections')}}/1/' + $('#cat-select').val() + '/{{ $search }}');
		});
	});

</script>

@endsection