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

    $data = $shoppers->get(array('_id'=>$s_id));

    $carts = new Cart();

    $body = View::make('email.checkout')->render();

    Message::to($data['email'])
        ->from(Config::get('shoplite.admin_email'), Config::get('shoplite.admin_name'))
        ->subject(Config::get('site.title'))
        ->body( $body )
        ->html(true)
        ->send();
    
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

Event::listen('attendee.update',function($id,$newpass,$picemail,$picname){
    $attendee = new Attendee();
    $_id = $id;
    $data = $attendee->get(array('_id'=>$_id));

    $body = View::make('email.regsuccess')
        ->with('data',$data)
        ->with('passwordRandom',$newpass)
        ->with('fromadmin','yes')
        ->render();

    Message::to($data['email'])
        ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
        ->cc($picemail, $picname)
        ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
        ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
        ->body( $body )
        ->html(true)
        ->send();

});

Event::listen('attendee.createformadmin',function($id,$newpass,$paymentstatus){
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
    $messagedata['emailcc2'] = '';
    $messagedata['emailcc2name'] = '';
    $messagedata['emailsubject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
    $messagedata['createdDate'] = new MongoDate();
    
    if($message->insert($messagedata)){

        if(isset($data['registonsite'])){
            //donothing
        }else{

            $body = View::make('email.regsuccess')
            ->with('data',$data)
            ->with('passwordRandom',$newpass)
            ->with('fromadmin','yes')
            ->with('paymentstatus',$paymentstatus)
            ->render();

            //saveto outbox
            /*$outbox = new Outbox();

            $outboxdata['from'] = Config::get('eventreg.reg_admin_email');
            $outboxdata['to'] = $data['email'];
            $outboxdata['cc'] = Config::get('eventreg.reg_admin_email');
            $outboxdata['bcc'] = '';
            $outboxdata['subject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
            $outboxdata['body'] = $body;
            $outboxdata['status'] = 'unsent';

            $outboxdata['createdDate'] = new MongoDate();
            $outboxdata['lastUpdate'] = new MongoDate();

            $outbox->insert($outboxdata);*/


            Message::to($data['email'])
                ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
                ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
                ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
                ->body( $body )
                ->html(true)
                ->send();
        }
        
    }

});




Event::listen('attendee.update',function($id,$newpass){
    $attendee = new Attendee();
    $_id = $id;
    $data = $attendee->get(array('_id'=>$_id));

    $body = View::make('email.regsuccess')
        ->with('data',$data)
        ->with('passwordRandom',$newpass)
        ->with('fromadmin','yes')
        ->render();

    /*$outbox = new Outbox();

    $outboxdata['from'] = Config::get('eventreg.reg_admin_email');
    $outboxdata['to'] = $data['email'];
    $outboxdata['cc'] = '';
    $outboxdata['bcc'] = '';
    $outboxdata['subject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
    $outboxdata['body'] = $body;
    $outboxdata['status'] = 'unsent';

    $outboxdata['createdDate'] = new MongoDate();
    $outboxdata['lastUpdate'] = new MongoDate();*/

    Message::to($data['email'])
        ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
        ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
        ->body( $body )
        ->html(true)
        ->send();

});

//EXHIBITOR

Event::listen('exhibitor.createformadmin',function($id,$newpass){
    $exhibitor = new Exhibitor();
    $_id = $id;
    $data = $exhibitor->get(array('_id'=>$_id));

    $hallname = $data['hall'];
    $piccontact = Config::get('eventreg.emailpichall');


    if($hallname == 'Main Lobby'){
        $cc1 = $piccontact['mainlobby1'];
        $cc2 = $piccontact['mainlobby2'];
    }elseif ($hallname == 'Hall A') {
        $cc1 = $piccontact['halla1'];
        $cc2 = $piccontact['halla2'];
    }elseif ($hallname == 'Assembly Hall') {
        $cc1 = $piccontact['assembly1'];
        $cc2 = $piccontact['assembly2'];
    }elseif ($hallname == 'Cendrawasih Hall') {
        $cc1 = $piccontact['cendrawasih1'];
        $cc2 = $piccontact['cendrawasih2'];
    }elseif ($hallname == 'Hall B') {
        $cc1 = $piccontact['hallb1'];
        $cc2 = $piccontact['hallb2'];
    }else{
        $cc1 = '';
        $cc2 = '';
    }

    $body = View::make('email.regsuccessexhib')
        ->with('data',$data)
        ->with('passwordRandom',$newpass)
        ->with('fromadmin','yes')
        ->render();

    Message::to($data['email'])
        ->from(Config::get('eventreg.reg_exhibitor_admin_email'), Config::get('eventreg.reg_exhibitor_admin_name'))
        ->cc($cc1['email'],$cc1['name'])
        ->cc($cc2['email'],$cc2['name'])
        ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Exhibitor – '.$data['registrationnumber'].')')
        ->body( $body )
        ->html(true)
        ->send();

    
    

});

Event::listen('exhibitor.logmessage',function($id,$newpass){

    //log message 
    $exhibitor = new Exhibitor();
    $_id = $id;
    $data = $exhibitor->get(array('_id'=>$_id));

    $message = new Logmessage();

    $messagedata['user'] = $data['_id'];
    $messagedata['type'] = 'email.regsuccessexhibit';
    //$messagedata['emailto'] = $data['email'];
    //$messagedata['emailfrom'] = Config::get('eventreg.reg_admin_email');
    //$messagedata['emailfromname'] = Config::get('eventreg.reg_admin_name');
    $messagedata['passwordRandom'] = $newpass;
    //$messagedata['emailcc1'] = Config::get('eventreg.reg_dyandra_admin_email');
    //$messagedata['emailcc1name'] = Config::get('eventreg.reg_dyandra_admin_name');
    //$messagedata['emailsubject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Exhibitor – '.$data['registrationnumber'].')';
    $messagedata['createdDate'] = new MongoDate();
    $message->insert($messagedata);

});


Event::listen('exhibition.postoperationalform',function($type,$id,$exhibitorid){

    $operationalform = new Operationalform();
    $exhibitor = new Exhibitor();

    $_id = $id;
    $data = $operationalform->get(array('_id'=>$_id));

    $user = $exhibitor->get(array('_id'=>$exhibitorid));

    $hallname = $user['hall'];
    $piccontact = Config::get('eventreg.emailpichall');


    if($hallname == 'Main Lobby'){
        $cc1 = $piccontact['mainlobby1'];
        $cc2 = $piccontact['mainlobby2'];
    }elseif ($hallname == 'Hall A') {
        $cc1 = $piccontact['halla1'];
        $cc2 = $piccontact['halla2'];
    }elseif ($hallname == 'Assembly Hall') {
        $cc1 = $piccontact['assembly1'];
        $cc2 = $piccontact['assembly2'];
    }elseif ($hallname == 'Cendrawasih Hall') {
        $cc1 = $piccontact['cendrawasih1'];
        $cc2 = $piccontact['cendrawasih2'];
    }elseif ($hallname == 'Hall B') {
        $cc1 = $piccontact['hallb1'];
        $cc2 = $piccontact['hallb2'];
    }else{
        $cc1 = '';
        $cc2 = '';
    }


    $regnumber = $user['registrationnumber'];

    if($type == 'all'){
        $doc = View::make('pdf.confirmexhibitor')
                ->with('data',$data)
                ->with('user',$user)
                ->render();
    }else{
        $doc = View::make('pdf.confirmexhibitor-individual')
                ->with('data',$data)
                ->with('user',$user)
                ->with('formnumber',$type)
                ->render();
    }
    
    $pdf = new Pdf();

    $pdf->make($doc);

    $newdir = realpath(Config::get('kickstart.storage'));

    $path = $newdir.'/operationalforms/confirmexhibitor'.$regnumber.'form-'.$type.'.pdf';

    $pdf->render();

    //$pdf->stream();

    $pdf->save($path);
    
    if($type == 'all'){
        $body = View::make('email.confirmpaymentexhibitor')
            ->with('data',$data)
            ->with('user',$user)
            ->render();
    }else{
        $body = View::make('email.confirmpaymentexhibitor-individual')
            ->with('data',$data)
            ->with('user',$user)
            ->with('formnumber',$type)
            ->render();
    }

    if($type == 'all'){
        Message::to($user['email'])
            ->from(Config::get('eventreg.reg_exhibitor_admin_email'), Config::get('eventreg.reg_exhibitor_admin_name'))
            ->cc($cc1['email'],$cc1['name'])
            ->cc($cc2['email'],$cc2['name'])
            ->subject('CONFIRMATION OF OPERATIONAL FORMS - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$user['registrationnumber'].')')
            ->body( $body )
            ->html(true)
            ->attach($path)
            ->send();
    }else{
        Message::to($user['email'])
            ->from(Config::get('eventreg.reg_exhibitor_admin_email'), Config::get('eventreg.reg_exhibitor_admin_name'))
            ->cc($cc1['email'],$cc1['name'])
            ->cc($cc2['email'],$cc2['name'])
            ->subject('CONFIRMATION OF OPERATIONAL FORM #'.$type.' - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$user['registrationnumber'].')')
            ->body( $body )
            ->html(true)
            ->attach($path)
            ->send();
    }
    

});



?>