<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Simply tell Laravel the HTTP verbs and URIs it should respond to. It is a
| breeze to setup your application using Laravel's RESTful routing and it
| is perfectly suited for building large applications and simple APIs.
|
| Let's respond to a simple GET request to http://example.com/hello:
|
|       Route::get('hello', function()
|       {
|           return 'Hello World!';
|       });
|
| You can even respond to more than one URI:
|
|       Route::post(array('hello', 'world'), function()
|       {
|           return 'Hello World!';
|       });
|
| It's easy to allow URI wildcards using (:num) or (:any):
|
|       Route::put('hello/(:any)', function($name)
|       {
|           return "Welcome, $name.";
|       });
|
*/

Route::controller(array('register','shop','seo','shoppers','shopper','merchants','reader','sponsors','news','articles','carts','auctions','promotions','products','report','import','export','dashboard','user','users','message','search','activity','category','content','ajax'));

Route::get('shop',array('uses'=>'shop@home'));

Route::get('/',function(){
    if(Auth::check()){
        if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
            //return Redirect::to('dashboard');
            return Route::forward('get','dashboard');
        }else{
            //return Redirect::to('shop');
            return Route::forward('get','shop');
        }
    }else{
        //return Redirect::to('shop');
        return Route::forward('get','shop');
    }
});


Route::get('signup',array('uses'=>'shopper@add'));
Route::post('register',array('uses'=>'shopper@add'));

Route::get('myprofile/edit',array('uses'=>'shopper@edit'));
Route::post('myprofile/edit',array('uses'=>'shopper@edit'));

Route::get('reset',array('uses'=>'shopper@reset'));
Route::post('reset',array('uses'=>'shopper@reset'));

Route::get('myprofile',array('uses'=>'shopper@profile'));

Route::get('paymentsubmitted',array('uses'=>'shopper@paymentsubmitted'));
Route::get('register-success',array('uses'=>'shopper@success'));
Route::get('register-landing',array('uses'=>'shopper@landing'));

Route::get('article/(:any)',array('uses'=>'reader@article'));
Route::get('news/(:any)',array('uses'=>'reader@news'));
Route::get('sponsor/(:any)',array('uses'=>'reader@sponsor'));

Route::get('hashme/(:any)',function($mypass){

    print Hash::make($mypass);
});

// Auth routes

Route::get('commander/login', function()
{
    return View::make('auth.commanderlogin');
});

Route::post('commander/login', function()
{
    // get POST data
    $username = Input::get('username');
    $password = Input::get('password');

    if ( $userdata = Auth::attempt(array('username'=>$username, 'password'=>$password)) )
    {
        //print_r($userdata);
        // we are now logged in, go to home
        return Redirect::to('dashboard');

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('commander/login')
            ->with('login_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});

Route::get('signin',array('uses'=>'shopper@login'));

Route::post('signin', function()
{
    // get POST data
    $username = Input::get('username');
    $password = Input::get('password');

    if ( $userdata = Auth::shopperattempt(array('username'=>$username, 'password'=>$password)) )
    {
        //print_r($userdata);
        // we are now logged in, go to home
        return Redirect::to('/');

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('signin')
            ->with('login_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});

Route::get('collections/(:any?)/(:any?)/(:any?)/(:any?)',array('uses'=>'shop@collections'));
Route::get('outofthebox',array('uses'=>'shop@otb'));
Route::get('pickoftheweek',array('uses'=>'shop@pow'));
Route::get('oneofakind',array('uses'=>'shop@kind'));
Route::get('mixandmatch',array('uses'=>'shop@mixmatch'));

//Route::get('about',array('uses'=>'reader@article(about)'));

Route::get('about',function(){
    //Redirect::to('reader/article/about');
    return Route::forward('get','reader/article/about');
});


Route::get('passwd', array('before'=>'auth',function(){
    return View::make('auth.password');
}));

Route::post('passwd', function()
{
    // get POST data
    $newpass = Input::get('pass');
    $chkpass = Input::get('chkpass');

    if ($newpass == $chkpass)
    {

        if(Auth::changepass($newpass)){
            return Redirect::to('user')->with('notify_success','Password changed.');            
        }

    }
    else
    {
        // auth failure! lets go back to the login
        return Redirect::to('passwd')
            ->with('newpass_errors', true);
        // pass any error notification you want
        // i like to do it this way  
    }

});


Route::get('logout',function(){
    Auth::logout();
    return Redirect::to('/');
});

Route::get('commander/logout',function(){
    Auth::logout();
    return Redirect::to('commander/login');
});

Route::get('user/profile',array('before'=>'auth','uses'=>'user@profile'));



