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
        ->render();

    Message::to($userdata['email'])
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

    print_r($userdata);

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


});

Event::listen('attendee.create',function($id,$newpass,$picemail,$picname){
    $attendee = new Attendee();
    $_id = $id;
    $data = $attendee->get(array('_id'=>$_id));

    //log message 
    $message = new Logmessage();

    $messagedata['user'] = $data['_id'];
    $messagedata['type'] = 'email.regsuccess';
    $messagedata['emailto'] = $data['email'];
    $messagedata['emailfrom'] = Config::get('eventreg.reg_admin_email');
    $messagedata['emailfromname'] = Config::get('eventreg.reg_admin_name');
    $messagedata['passwordRandom'] = $newpass;
    $messagedata['emailcc1'] = Config::get('eventreg.reg_dyandra_admin_email');
    $messagedata['emailcc1name'] = Config::get('eventreg.reg_dyandra_admin_name');
    $messagedata['emailcc2'] = $picemail;
    $messagedata['emailcc2name'] = $picname;
    $messagedata['emailsubject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
    $messagedata['createdDate'] = new MongoDate();
    
    if($message->insert($messagedata)){
        
        $body = View::make('email.regsuccess')
            ->with('data',$data)
            ->with('passwordRandom',$newpass)
            ->with('fromadmin','yes')
            ->render();

        //saveto outbox
        /*$outbox = new Outbox();

        $outboxdata['from'] = Config::get('eventreg.reg_admin_email');
        $outboxdata['to'] = $data['email'];
        $outboxdata['cc'] = Config::get('eventreg.reg_admin_email').','.$picemail;
        $outboxdata['bcc'] = '';
        $outboxdata['subject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
        $outboxdata['body'] = $body;
        $outboxdata['status'] = 'unsent';
        $outboxdata['createdDate'] = new MongoDate();
        $outboxdata['lastUpdate'] = new MongoDate();

        $outbox->insert($outboxdata);*/

        Message::to($data['email'])
            ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
            ->cc($picemail, $picname)
            ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
            ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
            ->body( $body )
            ->html(true)
            ->send();
    }

});



?>