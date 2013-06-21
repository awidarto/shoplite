@section('publictopnav')
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
                Welcome {{ HTML::link('myprofile',se(Auth::shopper()->firstname).' '.se(Auth::shopper()->lastname)) }} 
                @if(isset(Auth::shopper()->activeCart) && Auth::shopper()->activeCart != '')
                  | <i class="icon-cart logo-type"></i> {{ HTML::link('shop/cart','Shopping Cart')}}
                <?php
                  /*
                  @else
                    <span id="nocart">, you have no shopping cart, would you like to <span id="createcart">create one</span> ?</span>
                  */
                ?>
                @endif
                  | {{ HTML::link('shop/confirm','Confirm Payment')}}
                  | {{ HTML::link('logout','Logout')}}
              @else
                Hello, what would you like to do ?  
                &nbsp;{{ HTML::link('shop/confirm','Confirm Payment')}}
                | {{ HTML::link('signup','Sign Up')}}
                | {{ HTML::link('signin','Sign In')}}
              @endif

            </div>

          <div class="nav-collapse collapse navmainp2b">
            <ul class="nav">
              <li>{{ HTML::link('collections','Collections',array('class'=>is_active('collections')) )}}</li>
    		      <li>{{ HTML::link('mixandmatch','Mix & Match',array('class'=>is_active('mixandmatch')) )}}</li>
              <li>{{ HTML::link('pickoftheweek','Pick of The Week',array('class'=>is_active('pickoftheweek')) )}}</li>
              <li>{{ HTML::link('outofthebox','Out of The Box',array('class'=>is_active('outofthebox')) ) }}</li>
              <li>{{ HTML::link('oneofakind','One of A Kind',array('class'=>is_active('oneofakind')) ) }}</li>
              <li>{{ HTML::link('/','Home',array('class'=>is_active('/')))}}</li>
              <li>{{ HTML::link('about','About Us',array('class'=>is_active('about')) )}}</li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<?php

function is_active($r){
  $active = (Request::route()->uri == $r)?true:false;

  //print_r(Request::route());

  return ($active)?'active':'inactive';
}

?>

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