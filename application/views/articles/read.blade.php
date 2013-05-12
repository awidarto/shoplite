@layout('public')

@section('content')

<h3>{{$article['title']}}</h3>
<div class="row-fluid">
	<div class="span12">
		{{ $article['bodycopy']}}
	</div>
</div>

@endsection
