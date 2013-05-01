@layout('public')


@section('content')
<div class="tableHeader">

</div>
{{ HTML::image('images/locked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}
<h3>Sorry</h3>
<p>Online Operational Form has been closed.
<br/>Please contact your PIC Hall for the detail</p>
<p>{{ HTML::link('exhibition/profile','Back to My Profile',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>

@endsection