@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<!--{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}-->
<p>Please select registration type :</p>

<p>{{ HTML::link('register','Individual',array('class'=>'registIndividuType registType')).' '.HTML::link('register/group','Group/Bulk Register',array('class'=>'groupIndividuType registType')) }}

</p>


@endsection