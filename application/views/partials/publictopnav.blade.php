@section('topnav')
    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>

          <a class="brand" href="{{ URL::base()}}"><img src="{{ URL::base()}}/images/p2blogo.png"></a>

          <div class="nav-collapse collapse navmainp2b">
            <ul class="nav">
		      <li>{{ HTML::link('mixmatch','Mix & Match')}}</li>
          <li>{{ HTML::link('pow','Pick of The Week')}}</li>
          <li>{{ HTML::link('otb','Out of The Box')}}</li>
          <li>{{ HTML::link('kind','One of A Kind')}}</li>
          <li>{{ HTML::link('/','Home')}}</li>
          <li>{{ HTML::link('about','About Us')}}</li>
		      <li>{{ HTML::link('signup','Sign Up')}}</li>

		      <li class="divider"></li>
          <li>{{ HTML::link('signin','Sign In')}}</li>

          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
@endsection