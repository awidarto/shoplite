<?php
/*
|--------------------------------------------------------------------------
| Application 404 & 500 Error Handlers
|--------------------------------------------------------------------------
|
| To centralize and simplify 404 handling, Laravel uses an awesome event
| system to retrieve the response. Feel free to modify this function to
| your tastes and the needs of your application.
|
| Similarly, we use an event to handle the display of 500 level errors
| within the application. These errors are fired when there is an
| uncaught exception thrown in the application.
|
*/

Event::listen('404', function()
{
    return Response::error('404');
});

Event::listen('500', function()
{
    return Response::error('500');
});

Event::listen('commit.checkout',function($shopper,$cart){
    $shoppers = new Shopper();

    $s_id = new MongoId($shopper);
    $c_id = new MongoId($cart);

    $userdata = $shoppers->get(array('_id'=>$s_id));

    $carts = new Cart();

    $cartdata = $carts->get(array('_id'=>$c_id));

    $body = View::make('email.checkout')
        ->with('user',$userdata)
        ->with('cart',$cartdata)
        ->with('ordertable','')
        ->with('shippingaddress','')
        ->render();

    //Message::to($userdata['email'])
    Message::to(Config::get('shoplite.admin_email'))
        ->from(Config::get('shoplite.admin_email'), Config::get('shoplite.admin_name'))
        ->subject(Config::get('site.title'))
        ->body( $body )
        ->html(true)
        ->send();

});

Event::listen('shopper.signup',function($id){

    $shoppers = new Shopper();

    $_id = new MongoId($id);

    $userdata = $shoppers->get(array('_id'=>$_id));

    //print_r($userdata);

    $body = View::make('email.signupsuccess')
        ->with('user',$userdata)
        ->render();

    Message::to($userdata['email'])
        ->from(Config::get('shoplite.admin_email'), Config::get('shoplite.admin_name'))
        ->subject(Config::get('site.title'))
        ->body( $body )
        ->html(true)
        ->send();

});

Event::listen('payment.confirm',function($confirmcode){

    $confirms = new Confirmation();

    $carts = new Cart();

    $confirm = $confirms->get(array('confirmationCode'=>$confirmcode));

    $cart = $carts->get(array('confirmationCode'=>$confirmcode));

    $body = View::make('email.paymentconfirmed')
        ->with('cart',$cart)
        ->with('confirmation',$confirm)
        ->render();

    Message::to($confirm['email'])
        ->from(Config::get('shoplite.admin_email'), Config::get('shoplite.admin_name'))
        ->subject(Config::get('site.title'))
        ->cc($cart['buyerDetail']['email'])
        ->body( $body )
        ->html(true)
        ->send();
});


?>