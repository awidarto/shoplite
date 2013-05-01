@layout('public')

@section('content')
<div class="row">
	<div class="span4">
		<img src="{{ URL::base() }}/storage/mm/mm01.jpg" alt="mm01" class="mixmatch"  />
		<br />
		<img src="{{ URL::base() }}/storage/pow/pow01.jpg" alt="mm01" />
	</div>
	<div class="span4">
		<img src="{{ URL::base() }}/storage/mm/mm02.jpg" alt="mm01" class="mixmatch"  />
		<br />
		<img src="{{ URL::base() }}/storage/otb/otb01.jpg" alt="mm01" />
	</div>
	<div class="span4">
		<img src="{{ URL::base() }}/storage/mm/mm03.jpg" alt="mm01" class="mixmatch" />
		<br />
		<img src="{{ URL::base() }}/storage/kind/kin01.jpg" alt="mm01" />
	</div>

</div>


@endsection