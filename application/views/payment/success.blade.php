@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}
@if($data['typenotify'] == 'paymentsubmitted'){
<p>Congratulations! You have successfully registered with The 37th IPA Convention and Exhibition
<br/>Please check your email for details</p>
<p>{{ HTML::link('http://www.ipaconvex.com/index.php','Back to home',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>
@else
<p>Thanks for your payment confirmation
<br/>Please allow us to proccess your request</p>
<p>{{ HTML::link('http://www.ipaconvex.com/index.php','Back to home',array('class'=>'backtohome'))}}
<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-left:5px ">
</p>

@endsection