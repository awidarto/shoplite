@section('topnav')
	
<ul class="">

      <li>{{ HTML::link('content/public/general','General Information')}}</li>
      <li>{{ HTML::link('register','Visitor Registration')}}</li>
      <li>{{ HTML::link('payment','Payment Confirmation')}}</li>

      <li class="divider"></li>

      <li>{{ HTML::link('login', 'Login' ) }}</li>

</ul>
@endsection