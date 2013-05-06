<?php

class Payment_Controller extends Base_Controller {

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

		$this->crumb->add('register','Visitor Registration');

		$form = new Formly();
		$form->framework = 'zurb';
		
		return View::make('register.new')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Convention Registration');

	}

	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email' => 'required|email|unique:attendee',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('register')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$data['pass'] = Hash::make($data['pass']);

			unset($data['repass']);
			unset($data['csrf_token']);
			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['role'] = 'attendee';
			$data['paymentStatus'] = 'unpaid';


			$reg_number[0] = 'A';
			$reg_number[1] = $data['regtype'];
			$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);

			$user = new Attendee();

			if($obj = $user->insert($data)){

				$body = View::make('email.regsuccess')->with('data',$data)->render();

				Message::to($data['email'])
				    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
				    ->subject('Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
				    ->body( $body )
				    ->html(true)
				    ->send();
				    
		    	return Redirect::to('register-success')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('register')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}

	public function get_confirm(){

		$this->crumb->add('register','Payment Confirmation');

		$form = new Formly();

		$form->framework = 'zurb';

		return View::make('register.payment')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Payment Confirmation');

	}

	public function post_confirm(){

	}

	public function get_success(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.success')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Successfully Registered');

	}

	

	public function get_landing(){

		$this->crumb->add('register','Register');

		$form = new Formly();
		return View::make('register.landing')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','');

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
	        'email'  => 'required'
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

			if(isset($data['registrationnumber'])){
				$reg_number = explode('-',$data['registrationnumber']);			
			}else{
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));
				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}

			$reg_number[0] = 'A';
			$reg_number[1] = $data['regtype'];
			$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$data['registrationnumber'] = implode('-',$reg_number);
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('myprofile')->with('notify_success','User saved successfully');
			}else{
		    	return Redirect::to('myprofile')->with('notify_success','User saving failed');
			}
			
	    }

		
	}




}
?>