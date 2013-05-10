@layout('public')

@section('content')

<div class="row productlist">
	<div class="span3">
		<?php print_r($mixmatch);?>
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
		<h3>Title Product</h3>
		<p>IDR 50,000</p>
	</div>
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>

</div>

<div class="clear"></div>

<div class="row productlist">
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>
	<div class="span3">
		<img src="{{ URL::base() }}/images/kind/kin01.jpg" alt="mm01" />
	</div>

</div>

@endsection