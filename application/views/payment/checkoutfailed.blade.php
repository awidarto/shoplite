@layout('public')


@section('content')
<div class="tableHeader">

</div>
{{ HTML::image('images/cross.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}
<h3>{{$title}}</h3>
<p>Theres something error on your submission, please try again!</p>
<p>{{ HTML::link('register/profile','Back to My Profile',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>

@endsection