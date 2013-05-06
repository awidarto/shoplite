@layout('public')


@section('content')
<div class="tableHeader">
<h3>Sorry!</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}
<p>This site will be open shortly.
<br/>We apologize for the interuption</p>
<p>{{ HTML::link('exhibitor/profile','Back to my profile',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>


@endsection