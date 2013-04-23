@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}
<p></p>
<p>{{ HTML::link('exhibition/profile','Back to My Profile',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>

@endsection