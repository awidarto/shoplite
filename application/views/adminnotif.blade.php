@layout('master')


@section('content')
<div class="tableHeader">
<h3 class="formHead">{{$title}}</h3>
</div>

<p>{{ $data }} </p>

<p>{{ HTML::link('/','Back to Home',array('class'=>'backtohome'))}}</p>

@endsection