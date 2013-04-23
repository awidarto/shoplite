@layout('public')


@section('content')
<div class="tableHeader">
<h3>{{$title}}</h3>
</div>
<!--{{ HTML::image('images/checked.png','checked',array('class'=>'check-icon','style'=>'float:left;')) }}-->
<p>Please select registration type :</p>

<p>{{ HTML::link('register','Individual Registration',array('class'=>'registIndividuType registType')).' '.HTML::link('register/group','Group Registration',array('class'=>'groupIndividuType registType')) }}

</p>
<br/>
<br/>
<h4 class="headIpaSite">Convention Login Form</h4>
<div class="row">
    {{ Form::open('attendee/login') }}
    <!-- check for login errors flash var -->
    @if (Session::has('login_errors'))
        <div class="alert alert-error">
             Email or password incorrect.
        </div>
    @endif
    <!-- username field -->
    {{ Form::label('username', 'Email') }}
    {{ Form::text('username') }}
    <!-- password field -->
    {{ Form::label('password', 'Password') }}
    {{ Form::password('password') }}
    <!-- submit button -->
    {{ Form::submit('Login',array('class' => 'button')) }}
    &nbsp;&nbsp;&nbsp;<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-right:5px ">{{ HTML::link('reset','Forgot your password ? ',array('class'=>'backtohome'))}}
    {{ Form::close() }}
	


    
</div>

<?php echo Request::server('http_referer');?>
@endsection