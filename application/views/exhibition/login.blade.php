@layout('public')
@section('content')

<h4 class="headIpaSite">Exhibitor Login Form</h4>
<div class="row">
    {{ Form::open('exhibitor/login') }}
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
    &nbsp;&nbsp;&nbsp;<img src="http://www.ipaconvex.com/images/arrow1.jpg" border="0" align="absmiddle" style="margin-right:5px ">{{ HTML::link('exhibitor/reset','Forgot your password ? ',array('class'=>'backtohome'))}}
    {{ Form::close() }}



    
</div>
@endsection