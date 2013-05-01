@section('identity')
<div class="top-info-block">
 	<h3>Welcome</h3>
 	<h4>{{ Auth::user()->fullname }}</h4>
</div>

@endsection