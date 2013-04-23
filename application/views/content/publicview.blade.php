@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<div class="row">
	<div class="twelve columns">
		{{$body}}
	</div>
</div>

@endsection