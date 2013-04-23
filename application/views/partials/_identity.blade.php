@section('identity')
<div class="panel sidepanel">
	<div class=" row">
	  <div class="eight columns">
	    <p>Logged in as, <br/><br/><strong>{{ Auth::user()->fullname }}</strong>
	      <br/>{{ (isset(Auth::user()->employee_jobtitle))?Auth::user()->employee_jobtitle:'no title' }}
	      <br/><br/>Last Login: Tuesday, Nov 20 2012
	      <br/>from <i>Office</i>
	    </p>
	    <p>{{Auth::user()->email}}
	      <br/><a href="{{URL::to('user/profile')}}">Profile</a> 
	    <!--
	      <br/><span class="pop" id="{{Auth::user()->id}}" rel="user/popprofile" >Profile</span> 
		-->
	      | {{ HTML::link('logout', 'Logout') }}
	    </p>
	  </div>
	  <div class="four columns">
	    <a href="#"><img src="http://placehold.it/80x80&text=[img]" /></a>
	  </div>
	</div>
</div>
@endsection