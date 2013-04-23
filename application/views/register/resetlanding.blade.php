@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}
<p>Congratulations! You have successfully reset your password
<br/>Please check your email for details</p>
<p>{{ HTML::link('register/login','Go to login page',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>


@endsection