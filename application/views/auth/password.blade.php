@layout('master')

@section('content')
<h3>Change Password</h3>
<div id="login-form" class="container clearfix">
    <div class="five columns" id="auth-left">
            {{ Form::open('passwd') }}
                <!-- check for login errors flash var -->
                @if (Session::has('newpass_errors'))
                    <span class="error">New password & repeat password should match</span>
                @endif
                <!-- username field -->
                <p>{{ Form::label('pass', 'New Password') }}</p>
                <p>{{ Form::text('pass') }}</p>
                <!-- password field -->
                <p>{{ Form::label('chkpass', 'Repeat Password') }}</p>
                <p>{{ Form::text('chkpass') }}</p>
                <!-- submit button -->
                <p>{{ Form::submit('Save') }}</p>
            {{ Form::close() }}
    </div>
</div>

@endsection