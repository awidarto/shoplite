<?php
/*
|--------------------------------------------------------------------------
| View Composers
|--------------------------------------------------------------------------
|
*/

View::composer('public',function($view){

    $view->nest('publictopnav','partials.publictopnav');

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