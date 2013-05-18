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
            
            <div id="logged-in">
              @if(Auth::shoppercheck())
                Welcome {{ HTML::link('myprofile',Auth::shopper()->firstname.' '.Auth::shopper()->lastname) }}
                @if(isset(Auth::shopper()->activeCart) && Auth::shopper()->activeCart != '')
                  | <i class="icon-cart logo-type"></i> {{ HTML::link('shop/cart','Shopping Cart')}}
                @else
                  <span id="nocart">, you have no shopping cart, would you like to <span id="createcart">create one</span> ?</span>
                @endif
              @endif          
            </div>

          <div class="nav-collapse collapse navmainp2b">
            <ul class="nav">
    		      <li>{{ HTML::link('mixandmatch','Mix & Match')}}</li>
              <li>{{ HTML::link('pickoftheweek','Pick of The Week')}}</li>
              <li>{{ HTML::link('outofthebox','Out of The Box')}}</li>
              <li>{{ HTML::link('oneofakind','One of A Kind')}}</li>
              <li>{{ HTML::link('/','Home')}}</li>
              <li>{{ HTML::link('article/about','About Us')}}</li>

              @if(Auth::shoppercheck())
                    <li>{{ HTML::link('logout','Logout')}}</li>
              @else
                    <li>{{ HTML::link('signup','Sign Up')}}</li>
                    <li>{{ HTML::link('signin','Sign In')}}</li>
              @endif          
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<script type="text/javascript">
  $( document ).ready(function() {

    /*
    $('select').select2({
        width : 'resolve'
      });
    */
    
    $('#createcart').click(function(){
          $.post('{{ URL::to("shopper/newcart") }}',{}, function(data) {
            if(data.result == 'OK'){
              $('#nocart').html('| <i class="icon-cart logo-type"></i> {{ HTML::link('shopper/cart','Shopping Cart')}}');
              alert(data.message);              
            }else{
              alert(data.message);
            }
          },'json');
    });

  });

</script>


@endsection