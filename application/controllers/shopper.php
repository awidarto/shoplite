<?php

class Shopper_Controller extends Base_Controller {

	/*
	|--------------------------------------------------------------------------
	| The Default Controller
	|--------------------------------------------------------------------------
	|
	| Instead of using RESTful routes and anonymous functions, you might wish
	| to use controllers to organize your application API. You'll love them.
	|
	| This controller responds to URIs beginning with "home", and it also
	| serves as the default controller for the application, meaning it
	| handles requests to the root of the application.
	|
	| You can respond to GET requests to "/home/profile" like so:
	|
	|		public function action_profile()
	|		{
	|			return "This is your profile!";
	|		}
	|
	| Any extra segments are passed to the method as parameters:
	|
	|		public function action_profile($id)
	|		{
	|			return "This is the profile for user {$id}.";
	|		}
	|
	*/

	public $restful = true;

	public function __construct(){

		$this->crumb = new Breadcrumb();

		date_default_timezone_set('Asia/Jakarta');
	}


	public function get_index(){

		$this->crumb->add('register','Member Registration');

		$form = new Formly();
		$form->set_options(array(
			'framework'=>'bootstrap',
			'form_class'=>'form-horizontal'
			));

		$attendee = new Shopper();


		return View::make('register.new')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Member Registration');

	}

	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	        'email' => 'required|email|unique:shopper',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required',
	        'address_1' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        'country' => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('signup')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
			$password = $data['pass'];
			$data['pass'] = Hash::make($data['pass']);


			unset($data['repass']);
			unset($data['csrf_token']);
			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['role'] = 'shopper';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'shopper'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$regsequence = str_pad($rseq['seq'], 10, '0',STR_PAD_LEFT);

			$data['shopperseq'] = $regsequence;

			$user = new Shopper();

			if($obj = $user->insert($data)){

				/*
				//log message 
				$message = new Logmessage();

				$messagedata['user'] = $data['_id'];
				$messagedata['type'] = 'email.regsuccess';
				$messagedata['emailto'] = $data['email'];
				$messagedata['emailfrom'] = Config::get('eventreg.reg_admin_email');
				$messagedata['emailfromname'] = Config::get('eventreg.reg_admin_name');
				$messagedata['passwordRandom'] = $password;
				$messagedata['emailcc1'] = Config::get('eventreg.reg_dyandra_admin_email');
				$messagedata['emailcc1name'] = Config::get('eventreg.reg_dyandra_admin_name');
				$messagedata['emailcc2'] = '';
				$messagedata['emailcc2name'] = '';
				$messagedata['emailsubject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
				$messagedata['createdDate'] = new MongoDate();
				
				if($message->insert($messagedata)){


					$body = View::make('email.regsuccess')
						->with('data',$data)
						->with('fromadmin','yes')
						->with('passwordRandom',$password)
						->render();

					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_dyandra_admin_email'), Config::get('eventreg.reg_dyandra_admin_name'))
					    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();

					//saveto outbox
					$outbox = new Outbox();

					$outboxdata['from'] = Config::get('eventreg.reg_admin_email');
					$outboxdata['to'] = $data['email'];
					$outboxdata['cc'] = Config::get('eventreg.reg_admin_email');
					$outboxdata['bcc'] = '';
					$outboxdata['subject'] = 'Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')';
					$outboxdata['body'] = $body;
					$outboxdata['status'] = 'unsent';

					$outboxdata['createdDate'] = new MongoDate();
					$outboxdata['lastUpdate'] = new MongoDate();

					$outbox->insert($outboxdata);
					
				}

			*/
		    	return Redirect::to('register-success')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('register')->with('notify_result',Config::get('site.register_failed'));
			}

	    }


	}

	public function get_checkout(){

		if(isset(Auth::attendee()->id)){
			$type = 'attendee';

			$this->crumb->add('register/payment/'.$type,'Convention Payment Checkout');

			$form = new Formly();
			$form->framework = 'zurb';

			$attendee = new Attendee();

			$golfcount = $attendee->count(array('golf'=>'Yes'));

			return View::make('register.checkout')
				->with('form',$form)
				->with('type','attendee')
				->with('ajaxpost','register/checkout')
				->with('crumb',$this->crumb)
				->with('golfcount',$golfcount)
				->with('title',ucfirst($type).' Payment Checkout');
		}

	}

	public function post_checkout(){

	    $rules = array(
	    	'name_on_card' => 'required',
	    	'first_name' => 'required',
	    	'last_name' => 'required',
	        'email' => 'required|email',
	        'contact_phone' => 'required',
	        'mobile_phone' => 'required',
	        'address' => 'required',
	        'billing_address' => 'required',
	        'billing_zip' => 'required',
	        'city' => 'required',
	        'zip' => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Response::json(array('status'=>'ERR:VALIDATION','description'=>$validation->errors));

	    }else{
	    	$co = new Checkout();

	    	$data = Input::get();



	    	$paydata = $data;

	    	$data['attendee_id'] = Auth::attendee()->id;
	    	$data['createdDate'] = new MongoDate();

	    	if($sess = $co->insert($data)){

	    		//print_r($sess); this is an array

	    		// namaitem, unit price, quantity, sub-total;
	    		$items = array();

	    		$conv = Config::get('eventreg.currencyconversion');

	    		$golffee = Config::get('eventreg.golffee');

	    		$totalamount = 0;

	    		switch(Auth::attendee()->regtype){
	    			case 'PO':
						$convfee = Auth::attendee()->regPO * $conv;
	    				$item[] = 'Convention Type : Professional Overseas,'.$convfee.',1,'.$convfee;

	    				$totalamount = $convfee;

	    				if(Auth::attendee()->golf == 'Yes'){
		    				$item[] = 'Golf Attendance,'.$golffee.',1,'.$golffee;
	    					$totalamount += $golffee;
	    				}

	    				//$itemline = implode(';',$item);

	    				break;

	    			case 'SO':

						$convfee = Auth::attendee()->regSO * $conv;
	    				$item = 'Convention Type : Student Overseas,'.$convfee.',1,'.$convfee;

	    				$totalamount = $convfee;

	    				$itemline = $item;

	    				break;

	    			case 'PD':

						$convfee = Auth::attendee()->regPD;
	    				$item[] = 'Convention Type : Professional Domestic,'.$convfee.',1,'.$convfee;
	    				$totalamount = $convfee;

	    				if(Auth::attendee()->golf == 'Yes'){
		    				$item[] = 'Golf Attendance,'.$golffee.',1,'.$golffee;
	    					$totalamount += $golffee;
	    				}

	    				$vat = Auth::attendee()->totalIDR * 0.1;

    					$totalamount += $vat;

	    				$item[] = 'VAT 10%,'.$vat.',1,'.$vat;

	    				//$itemline = implode(';',$item);

	    				break;

	    			case 'SD':

						$convfee = Auth::attendee()->regSD;
	    				$item[] = 'Convention Type : Student Domestic,'.$convfee.',1,'.$convfee;
	    				$totalamount = $convfee;

	    				$vat = Auth::attendee()->totalIDR * 0.1;
    					$totalamount += $vat;

	    				$item[] = 'VAT 10%,'.$vat.',1,'.$vat;


	    				break;
	    		}

	    		$paymentcharges = ($convfee * 0.03) + 2200;

	    		$item[] = 'Payment Charges,'.$paymentcharges.',1,'.$paymentcharges;

	    		$totalamount += $paymentcharges;

				$itemline = implode(';',$item);

	    		$paydata['item_list'] = $itemline;
	    		$paydata['amount'] = $totalamount;
	    		$paydata['invoice_no'] = Auth::attendee()->regsequence;
	    		$paydata['session_id'] = $sess['_id']->__toString();

				$gw_url = Config::get('kickstart.paymentgw_url');

				$params = array();

				foreach($paydata as $key=>$val){
					$params[] = $key.'='.$val;
				}

				$params = implode('&',$params);

				$gw_url = $gw_url.'?'.$params;


				/*

	    		// 1. initialize
				$curl = curl_init();

				// 2. set the options, including the url
				curl_setopt($curl, CURLOPT_URL, $gw_url);
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($curl, CURLOPT_HEADER, 0);

				// 3. execute and fetch the resulting HTML output
				
				if($output = curl_exec($curl)){
					$co->update(array('_id'=>$sess['_id']),array('$set'=>array('curl_out'=>$output,'out_url'=>$gw_url)));

					$result = array('status'=>'OK','description'=>'Payment Accepted');
				}else{
					$co->update(array('_id'=>$sess['_id']),array('$set'=>array('curl_out'=>$output,'out_url'=>$gw_url,'curl_err'=>curl_error($curl))));

					$result = array('status'=>'ERR:CONN','description'=>'Connection Error');

				}

				// 4. free up the curl handle
				curl_close($curl);

				*/

		    	return Response::json(array('status'=>'OK','description'=>'Payment Accepted','redirect'=>$gw_url));

	    	}else{
		    	return Response::json(array('status'=>'ERR:UNSAVED','description'=>'Payment Can Not Be Saved'));
	    	}
	    }

	}

	public function get_pg(){
		$data = Input::get();
		//no_invoice=123123&amount=10000.00&statuscode=00

		$no_invoice = $data['no_invoice']; // sementara ini isinya attendee _id dalam bentuk string
		$amount = $data['amount'];
		$statuscode = $data['statuscode']; // 00 = OK, selain itu Error

	}

	public function get_payment($type){

		if(!Auth::attendee()){
			return Redirect::to('/');
		}

		$this->crumb->add('register/payment/'.$type,ucfirst($type).' Payment Confirmation');

		$att = new Attendee();

		//print_r(Auth::attendee());

		$confirm = new Confirmation();

		$confirmdata = $confirm->get(array('type'=>$type,'id'=>Auth::attendee()->id));

		$_id = new MongoId(Auth::attendee()->id);

		$attendee = $att->get(array('_id'=>$_id));

		if(is_null($confirmdata) || count($confirmdata) < 0 || !isset($confirmdata) || !is_array($confirmdata)){

		}else{

			$attendee = array_merge($attendee,$confirmdata);

		}

		$form = new Formly($attendee);

		$golfcount = $att->count(array('golf'=>'Yes','golfPaymentStatus'=>'paid'));

		$form->framework = 'zurb';

		return View::make('register.payment')
					->with('form',$form)
					->with('type',$type)
					->with('user',$attendee)
					->with('crumb',$this->crumb)
					->with('golfcount',$golfcount)
					->with('title',ucfirst($type).' Payment Confirmation');

	}

	public function post_payment($type = 'convention'){

		$data = Input::get();

	    $rules = array(
	        $type.'transferdate' => 'required',
	        $type.'totalpayment' => 'required',
	        $type.'fromaccountname' => 'required',
	        $type.'fromaccnumber' => 'required',
	        $type.'frombank' => 'required',
	        'docupload' => 'required',
	    );

	    $type = $data['type'];

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('payment/'.$type)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			unset($data['repass']);
			unset($data['csrf_token']);

			$data[$type.'transferdate'] = new MongoDate(strtotime($data[$type.'transferdate']." 00:00:00"));

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$confirm = new Confirmation();


			// uploaded receipt
			$docupload = Input::file('docupload');
			$docupload[$type.'DocUploadTime'] = new MongoDate();

			$fileExt = File::extension( $docupload['name']);

			$docName = $type.'PaymentProof.'.$fileExt;

			$data[$type.'DocFilename'] = $docName;

			$data[$type.'DocFiledata'] = $docupload;


			if($obj = $confirm->insert($data)){


				if($docupload['name'] != ''){

					$newid = $obj['_id']->__toString();

					$newdir = realpath(Config::get('kickstart.storage')).'/payments/'.$newid;

					Input::upload('docupload',$newdir,$docName);

					$email_attachment = $newdir.'/'.$docName;
				}else{
					$email_attachment = false;
				}


				$attendee = new Attendee();

				$id = Auth::attendee()->id;

				$_id = new MongoId($id);

				$userdata = $attendee->get(array('_id'=>$_id));

				$userdata = array_merge($userdata,$data);

				//check first if booth payment selected
				if(isset($data['confirmbooth'])){

					

					$attendee->update(array('_id'=>$_id),array('$set'=>array('golfPaymentStatus'=>'pending')));
					$attendee->update(array('_id'=>$_id),array('$set'=>array('conventionPaymentStatus'=>'pending')));
					
					
					$userdata[$type.'transferdate'] = date('d-m-Y',$userdata[$type.'transferdate']->sec);
					$data['confirmbooth'] = 'yes';

					$userdata['address'] = $userdata['address_1'].'<br />'.$userdata['address_2'];

					$body = View::make('email.regpayment')
						->with('type',$type)
						->with('confirmAll','yes')
						->with('data',$userdata)
						->render();

					if($email_attachment == false){
						Message::to($userdata['email'])
						    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
						    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->subject('Convention & Golf Payment Confirmation – '.$userdata['registrationnumber'])
						    ->body( $body )
						    ->html(true)
						    ->send();
					}else{
						Message::to($userdata['email'])
						    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
						    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->subject('Convention & Golf Payment Confirmation – '.$userdata['registrationnumber'])
						    ->body( $body )
						    ->html(true)
						    ->attach($email_attachment)
						    ->send();
					}

				}else{
					$attendee->update(array('_id'=>$_id),array('$set'=>array($type.'PaymentStatus'=>'pending')));
				
					$userdata[$type.'transferdate'] = date('d-m-Y',$userdata[$type.'transferdate']->sec);

					$userdata['address'] = $userdata['address_1'].'<br />'.$userdata['address_2'];

					$body = View::make('email.regpayment')
						->with('type',$type)
						->with('data',$userdata)
						->render();

					if($email_attachment == false){
						Message::to($userdata['email'])
						    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
						    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->subject(ucfirst($type).' Payment Confirmation – '.$userdata['registrationnumber'])
						    ->body( $body )
						    ->html(true)
						    ->send();
					}else{
						Message::to($userdata['email'])
						    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->cc(Config::get('eventreg.reg_finance_email'), Config::get('eventreg.reg_finance_name'))
						    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
						    ->subject(ucfirst($type).' Payment Confirmation – '.$userdata['registrationnumber'])
						    ->body( $body )
						    ->html(true)
						    ->attach($email_attachment)
						    ->send();
					}
				}
					



		    	return Redirect::to('paymentsubmitted')->with('notify_success',Config::get('site.payment_success'));
			}else{
		    	return Redirect::to('register')->with('notify_success',Config::get('site.payment_failed'));
			}
		}

	}

	public function get_success(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.success')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Successfully Registered');

	}

	public function get_paymentsubmitted(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.paymentsubmitted')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Thank you for your payment confirmation!');

	}

	public function get_checkoutsuccess(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('payment.checkoutsuccess')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Thank you for your payment!');

	}

	public function get_checkoutfailed(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('payment.checkoutfailed')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Error');

	}

	public function get_login(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		$form->set_options(array(
			'framework'=>'bootstrap',
			'form_class'=>'form-horizontal'
			));
		return View::make('register.login')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Login Form');

	}

	public function get_landing(){

		$this->crumb->add('register','Register');

		return View::make('register.landing')
					->with('crumb',$this->crumb)
					->with('title','');
	}

	public function get_reset(){

		$this->crumb->add('register/reset','Reset Password');

		$form = new Formly();
		return View::make('register.resetpass')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Reset Password Form');

	}

	public function post_reset(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email' => 'required|email',
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('reset')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$newpass = rand_string(8);

			$data['pass'] = Hash::make($newpass);


			unset($data['csrf_token']);

			$data['lastUpdate'] = new MongoDate();

			$user = new Attendee();

			$ex = $user->get(array('email'=>$data['email']));

			if(isset($ex['email']) && $ex['email'] == $data['email']){

				if($obj = $user->update(array('email'=>$data['email']),array('$set'=>$data))){

					$userdata = $user->get(array('email'=>$data['email']));


					$body = View::make('email.resetpass')
						->with('data',$data)
						->with('userdata',$userdata)
						->with('newpass',$newpass)
						->render();

					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('Password Reset - Indonesia Petroleum Association – 37th Convention & Exhibition)')
					    ->body( $body )
					    ->html(true)
					    ->send();

			    	return Redirect::to('resetlanding')->with('notify_success',Config::get('site.reset_success'));
				}else{
			    	return Redirect::to('reset')->with('notify_result',Config::get('site.reset_failed'));
				}

			}else{

		    	return Redirect::to('reset')->with('notify_result',Config::get('site.reset_email_not_found'));

			}



	    }


	}


	public function get_resetlanding(){

		$this->crumb->add('register/reset','Reset Password');

		return View::make('register.resetlanding')
					->with('crumb',$this->crumb)
					->with('title','Reset Password Success');
	}

	public function get_group(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.group')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Group/Bulk Registration');

	}

	public function get_profile($id = null){

		if(is_null($id)){
			$this->crumb = new Breadcrumb();
		}

		$user = new Attendee();

		$id = (is_null($id))?Auth::attendee()->id:$id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));
		//$user_type = $user_profile['regtype'];

		$this->crumb->add('project/profile','Profile',false);
		$this->crumb->add('project/profile',$user_profile['firstname'].' '.$user_profile['lastname']);

		return View::make('register.profile')
			->with('crumb',$this->crumb)
			->with('profile',$user_profile);
			//->with('type',$this->user_type);
	}

	public function get_edit(){

		$this->crumb->add('user/edit','Edit',false);

		$user = new Attendee();

		$id = Auth::attendee()->id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));

		//print_r($user_profile);

		$form = Formly::make($user_profile);

		$form->framework = 'zurb';

		return View::make('register.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit My Profile');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	    	'position' => 'required',
	        'email' => 'required|email',
	        'company' => 'required',
	        'companyphone' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('myprofile/edit')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Attendee();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);

				$reg_number[0] = 'C';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';


			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

				$reg_number[0] = 'C';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}

			//golf sequencer
			/*$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
			}*/

			$data['registrationnumber'] = implode('-',$reg_number);

			if($user->update(array('_id'=>$id),array('$set'=>$data))){

				$ex = $user->get(array('_id'=>$id));

				$body = View::make('email.regupdate')
					->with('data',$ex)
					->render();

				Message::to($data['email'])
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->cc(Config::get('eventreg.reg_dyandra_admin_email'), Config::get('eventreg.reg_dyandra_admin_name'))
				    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Profile Updated – '.$data['registrationnumber'].')')
				    ->body( $body )
				    ->html(true)
				    ->send();

		    	return Redirect::to('myprofile')->with('notify_success','Attendee saved successfully');

			}else{
		    	return Redirect::to('myprofile')->with('notify_success','Attendee saving failed');
			}

	    }


	}


}
?>