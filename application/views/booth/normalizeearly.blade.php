@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>
<?php if(isset($changecount) ):?>
<p>{{ $changecount }} Total data updated for Normalize</p>

<?php endif; ?>

@endsection