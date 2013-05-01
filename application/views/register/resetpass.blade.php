@layout('public')
@section('content')

<h4 class="headIpaSite">{{$title}}</h4>
<div class="row">
    {{ Form::open('reset') }}
    <!-- check for login errors flash var -->
    @if (Session::has('notify_result'))
        <div class="alert alert-error">
             {{Session::get('notify_result')}}
        </div>
    @endif
    <!-- username field -->
    {{ $form->text('email','Email.req','',array('class'=>'text','id'=>'email')) }}
    <!-- password field -->
    <!-- submit button -->
    {{ Form::submit('Reset Password',array('class' => 'button')) }}
    {{ Form::close() }}

    
</div>
@endsection