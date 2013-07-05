<?php
/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
|
*/

View::composer('public',function($view){

	$cartcount = '';

	if(Auth::guest()){
		$cartcount = '';
	}else{
		if(Auth::shopper()->activeCart != ''){
			$cart = new Cart();
			$c_id = new MongoId(Auth::shopper()->activeCart);

			$c = $cart->get(array('_id'=>$c_id));

			$qty = 0;

			foreach($c['items'] as $key=>$val){
				foreach($val as $k=>$v)
				{
					$qty += $v['actual'];
				}
			}

			$cartcount = $qty;

		}else{
			$cartcount = '';
		}
	}
    $view->nest('publictopnav','partials.publictopnav',array('cartcount'=>$cartcount) );

});

View::composer('publichome',function($view){

    $view->nest('publictopnav','partials.publictopnav');

});

View::composer('master',function($view){


    $view->nest('topnav','partials.topnav');
    $view->nest('sidenav','partials.sidenav');
    $view->nest('identity','partials.identity');

});

View::composer('noaside',function($view){

    $view->nest('topnav','partials.topnav');
    $view->nest('sidenav','partials.sidenav');
    $view->nest('identity','partials.identity');

});

?>