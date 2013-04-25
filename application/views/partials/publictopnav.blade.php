@section('topnav')
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="#"><img src="{{ URL::base()}}/images/p2blogo.jpg"></a>
          <div class="nav-collapse collapse">
            <ul class="nav">
		      <li>{{ HTML::link('mixmatch','General Information')}}</li>
		      <li>{{ HTML::link('signup','Sign Up')}}</li>

		      <li class="divider"></li>

		      <li>{{ HTML::link('login', 'Login' ) }}</li>
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
@endsection