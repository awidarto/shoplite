<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <!-- Mobile viewport optimized: h5bp.com/viewport -->
    <meta name="viewport" content="width=device-width">

    <title>{{ Config::get('site.title') }}</title>



    <!-- remove or comment this line if you want to use the local fonts -->
    {{ HTML::style('css/spectrum.css') }}
    {{ HTML::style('css/colorPicker.css') }}

    {{ HTML::style('content/css/opensans.css') }}
    {{ HTML::style('content/css/bootstrap.css') }}
    {{ HTML::style('content/css/bootstrap-responsive.css') }}
    {{ HTML::style('content/css/bootmetro.css') }}
    {{ HTML::style('content/css/bootmetro-tiles.css') }}
    {{ HTML::style('content/css/bootmetro-charms.css') }}
    {{ HTML::style('content/css/metro-ui-light.css') }}
    {{ HTML::style('content/css/icomoon.css') }}
    {{ HTML::style('css/smart_wizard.css') }}
    {{ HTML::style('css/jquery.tagsinput.css') }}
    @if(Auth::user()->role == 'onsite' || Auth::user()->role == 'cashier')
      {{ HTML::style('content/css/bootstrap-modal.css') }}
    @endif


    {{ HTML::style('css/jquery-datatables/TableTools.css')}}

    <!--  these two css are to use only for documentation -->
    {{ HTML::style('css/jquery.appendGrid-1.1.0.css') }}

    {{ HTML::style('css/select2.css') }}
    {{ HTML::style('content/css/demo.css') }}

    {{ HTML::style('css/jquery-ui-1.10.3.custom.css') }}

    {{ HTML::style('css/bootstrap-timepicker.css') }}

    {{ HTML::style('css/bootstrap-datetimepicker.min.css') }}

    {{ HTML::style('content/css/app.css') }}

    <link rel="stylesheet" type="text/css" href="{{URL::base()}}/scripts/google-code-prettify/prettify.css" >

    <!-- Le fav and touch icons -->


    <!-- All JavaScript at the bottom, except for Modernizr and Respond.
      Modernizr enables HTML5 elements & feature detects; Respond is a polyfill for min/max-width CSS3 Media Queries
      For optimal performance, use a custom Modernizr build: www.modernizr.com/download/ -->

    {{ HTML::script('scripts/modernizr-2.6.1.min.js') }}
    {{ HTML::script('js/jquery-1.8.3.min.js') }}
    {{ HTML::script('js/jquery-ui-1.9.2.custom.min.js') }}
    {{ HTML::script('js/jquery.jeditable.mini.js') }}

    {{ HTML::script('js/jquery.appendGrid-1.1.0.js') }}

    {{ HTML::script('js/select2.min.js') }}   
    {{ HTML::script('js/bootstrap-filestyle.min.js') }}   

    
</head>

<body>

  <!-- Header and Nav -->
  
  <header id="nav-bar" class="container-fluid">
      <div class="row-fluid">
         <div class="span8">
            <div id="header-container">
              <h5><i class="icon-cart logo-type"></i>{{ Config::get('site.title')}}</h5>
              @yield('topnav')
            </div>
         </div>
         <div id="top-info" class="pull-right">
           <a href="{{ URL::to('user/profile') }}" class="pull-left">
              @yield('identity')
              <div class="top-info-block">
                 <b class="icon-user"></b>
              </div>
           </a>
           <hr class="separator pull-left"/>
           <a id="settings" class="pull-left" href="#">
              <b class="icon-settings"></b>
           </a>
        </div>
    </div>
  </header>

  <div class="container-fluid">
      @if(isset($crumb))
        {{ $this->crumb->generate('bootstrap') }}
      @endif

      <div class="row-fluid">
        @yield('content')
      </div>
  </div>
  
  <!--<div id="charms" class="win-ui-dark">
    <div id="theme-charms-section" class="charms-section">
       <div class="charms-header">
          <a href="#" class="close-charms win-command">
             <span class="win-commandimage win-commandring">&#xe05d;</span>
          </a>
          <h2>Settings</h2>
       </div>
 
       <div class="row-fluid">
          <div class="span12">
 
             <form class="">
                <label for="win-theme-select">Change theme:</label>
                <select id="win-theme-select" class="">
                   <option value="metro-ui-semilight">Semi-Light</option>
                   <option value="metro-ui-light">Light</option>
                   <option value="metro-ui-dark">Dark</option>
                </select>
             </form>
          </div>
       </div>
    </div>
  </div>-->

  {{ HTML::script('js/jquery.dataTables.min.js') }}

  {{ HTML::script('js/jquery-datatables/TableTools.min.js')}}

  {{ HTML::script('js/underscore-1.1.5.js') }}

  {{ HTML::script('js/jquery.tagsinput.min.js') }}
  

  {{ HTML::script('js/jquery.fancybox.js') }}

  {{ HTML::script('scripts/google-code-prettify/prettify.js') }}
  {{ HTML::script('scripts/jquery.mousewheel.js') }}
  {{ HTML::script('scripts/jquery.scrollTo.js') }}
  {{ HTML::script('js/jquery.colorpicker.js') }}

  {{ HTML::script('js/bootstrap-timepicker.js') }}   
  {{ HTML::script('js/bootstrap-datetimepicker.min.js') }}   

  {{ HTML::script('js/spectrum.js') }}
  {{ HTML::script('scripts/bootstrap.min.js') }}
  {{ HTML::script('scripts/bootmetro.js') }}
  {{ HTML::script('scripts/bootmetro-charms.js') }}
  {{ HTML::script('scripts/demo.js') }}
  {{ HTML::script('scripts/holder.js') }}
  {{ HTML::script('js/pnu.js') }}
  
  @if(Auth::user()->role == 'onsite' || Auth::user()->role == 'cashier'){
    {{ HTML::script('js/bootstrap-modalmanager.js') }}
    {{ HTML::script('js/bootstrap-modal.js') }}
  @endif;
 
 <script type="text/javascript">
    $(".metro").metro();
    base = '{{ URL::base() }}/';
 </script>


</body>
</html>
