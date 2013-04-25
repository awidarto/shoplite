@layout('public')
@section('content')

@if (Session::has('login_errors'))
    <div class="alert alert-error">
         {{Session::get('notify_result')}}
    </div>
@endif
{{$form->open('shopper/login','POST')}}

<div class="row">
    <div class="span6">

        <fieldset>
            <legend>Login</legend>

                {{ $form->text('username','Email.req','',array('class'=>'text','id'=>'username')) }}

                {{ $form->password('password','Password.req','',array('class'=>'text')) }}
        </fieldset>

        <div class="form-actions">
          <button type="submit" class="btn btn-primary">Sign In</button>
          <button type="button" class="btn">Cancel</button>
        </div>

    </div>
</div>

 @endsection