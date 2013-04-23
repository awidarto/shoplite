<?php

Autoloader::map(array(
    'Mongovel\\Model'    => path('bundle').'mongovel/model.php',
    'Mongovel\\MongoDB'  => path('bundle').'mongovel/mongodb.php',
//    'Mongovel\\Hydrator' => path('bundle').'mongovel/hydrator.php',
    'Mongovel\\MongoAuth'=> path('bundle').'mongovel/mongoauth.php',
));


Auth::extend('mongoauth', function() {
    return new Mongovel\MongoAuth(Config::get('auth.model'));
});


?>