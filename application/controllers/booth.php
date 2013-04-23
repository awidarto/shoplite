<?php

class Booth_Controller extends Base_Controller {

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

	public $crumb;


	public function __construct(){
		$this->crumb = new Breadcrumb();
		$this->crumb->add('booth','Booths');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{


		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$action_selection = $form->select('action','',Config::get('kickstart.actionselection'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">'.$action_selection.'</span>';

		$heads = array('#',$select_all,'Booth No.','Length','Width','Size','Hall','Free exhibitor pass','','','');

		$searchinput = array(false,false,'Booth No.',false,false,false,'Hall',false,false,false,false,false);

		$colclass = array('','span1','span3','span3','span3','span3','','');

		if(Auth::user()->role == 'root' || Auth::user()->role == 'super' || Auth::user()->role == 'onsite' || Auth::user()->role == 'exhibitionadmin'){
			return View::make('tables.simple2')
				->with('title','Exhibitors')
				->with('newbutton','New Exhibitors')
				->with('disablesort','0,1,8,9,10')
				->with('addurl','exhibitor/add')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('booth'))
				->with('ajaxdel',URL::to('exhibitor/del'))
				->with('ajaxpay',URL::to('exhibitor/paystatus'))
				->with('ajaxformstatus',URL::to('exhibitor/setformstatus'))
				->with('ajaxpaygolf',URL::to('exhibitor/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('exhibitor/paystatusgolfconvention'))
				->with('printsource',URL::to('exhibitor/printbadge'))
				->with('ajaxexhibitorsendmail',URL::to('exhibitor/sendmail'))
				->with('form',$form)
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','exhibitor.rowdetail');
		}else{
			return View::make('exhibitor.restricted')
							->with('title','Exhibitors');			
		}
	}



	public function post_index()
	{


		$fields = array('boothno','hallname','length','width','size','hallname','freepassslot');

		$rel = array('like','like','like','like');

		$cond = array('both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 1;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{

				$hilite_item = Input::get('sSearch_'.$idx);

				$hilite[] = $hilite_item;
				$hilite_replace[] = '<span class="hilite">'.$hilite_item.'</span>';

				if($rel[$idx] == 'like'){
					if($cond[$idx] == 'both'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i');
					}else if($cond[$idx] == 'before'){
						$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i');						
					}else if($cond[$idx] == 'after'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i');						
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}

		//print_r($q)

		$exhibitor = new Booth();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		if($fidx == 0){
			$fidx = $defsort;			
			$sort_col = $fields[$fidx];
			$sort_dir = $defdir;
		}else{
			$fidx = ($fidx > 0)?$fidx - 1:$fidx;
			$sort_col = $fields[$fidx];
			$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;
		}

		$count_all = $exhibitor->count();

		if(count($q) > 0){
			$exhibitors = $exhibitor->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $exhibitor->count($q);
		}else{
			$exhibitors = $exhibitor->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $exhibitor->count();
		}

		$aadata = array();

		$form = new Formly();

		$counter = 1 + $pagestart;

		foreach ($exhibitors as $doc) {

			
			
			

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

			

			

			$aadata[] = array(
				$counter,
				$select,
				
				
				$doc['boothno'],
				$doc['length'],
				$doc['width'],
				$doc['size'],
				$doc['hallname'],
				$doc['freepassslot'],
				'',
				'',
				'<a class="icon-"  href="'.URL::to('booth/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Booth</span>'
				
				
			);
			$counter++;
		}

		
		$result = array(
			'sEcho'=> Input::get('sEcho'),
			'iTotalRecords'=>$count_all,
			'iTotalDisplayRecords'=> $count_display_all,
			'aaData'=>$aadata,
			'qrs'=>$q
		);

		return Response::json($result);
	}

	public function post_del(){
		$id = Input::get('id');

		$user = new Booth();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('booth.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('booth.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function post_paystatus(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatus');

		$user = new Booth();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('conventionPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					$body = View::make('email.confirmpayment')->with('data',$data)->render();


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
			}else{
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function post_paystatusgolf(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatusgolf');

		$user = new Booth();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('golfPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					$body = View::make('email.confirmpaymentgolf')->with('data',$data)->render();


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION (GOLF)- Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
			}else{
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function post_setformstatus(){
		$id = Input::get('id');
		$paystatus = Input::get('formstatus');

		$user = new Booth();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('formstatus'=>$paystatus)))){
				//Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
				//mail to registrant about payment updated
				//if only set to paid to send email
				/*if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					$body = View::make('email.confirmpaymentgolf')->with('data',$data)->render();


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION (GOLF)- Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}*/
			}else{
				//Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	


	public function post_paystatusgolfconvention(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatusgolfconvention');

		$user = new Booth();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('golfPaymentStatus'=>$paystatus,'conventionPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'OK'));
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					$body = View::make('email.confirmpaymentall')->with('data',$data)->render();


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
			}else{
				Event::fire('paymentstatusgolfconvention.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function get_add($type = null){

		if(is_null($type)){
			$this->crumb->add('booth/add','New Booth');
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('booth/type/'.$type,'Booth');

			$this->crumb->add('booth/type/'.$type,depttitle($type));
			$this->crumb->add('booth/add','New Booth');
		}


		$form = new Formly();
		return View::make('booth.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Booth');

	}


	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	    	'position' => 'required',
	        'email' => 'required|email|unique:booth',
	        
	        'company' => 'required',
	        'companyphone' => 'required',
	        'address_1' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        'country' => 'required',
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('booth/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$passwordRandom = rand_string(8);

			$data['pass'] = Hash::make($passwordRandom);
	    	
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$data['role'] = 'EXH';
			

			$reg_number[0] = 'E';
			$reg_number[1] = $data['role'];
			$reg_number[2] = '00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'official'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);

			//normalize
			$data['confirmation'] = 'none';
			$data['formstatus'] = 'open';
			$data['address'] = '';
			$data['cache_id'] = '';
			$data['cache_obj'] = '';
			$data['groupId'] = '';
			$data['groupName'] = '';


			$user = new Booth();

			if($obj = $user->insert($data)){

				Event::fire('booth.createformadmin',array($obj['_id'],$passwordRandom));
				
		    	return Redirect::to('booth')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('booth')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}


	public function get_edit($id){

		$this->crumb->add('booth/edit','Edit',false);

		$user = new Booth();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);

		$this->crumb->add('booth/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('booth.edit')
					->with('data',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Booth');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'boothno'  => 'required',
	        'width'  => 'required',
	        'length'  => 'required',
	        'freepassslot'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('booth/edit')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();
			
			
			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Booth();

			$data['size'] = $data['length']*$data['width'];
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('booth')->with('notify_success','Booth saved successfully');
			}else{
		    	return Redirect::to('booth')->with('notify_success','Booth saving failed');
			}
			
	    }

		
	}

	public function get_viewform($id){

		$this->crumb->add('booth','Form Submission',false);

		//$this->crumb->add('user/edit','Edit',false);
		$user = new Booth();

		$formData = new Operationalform();

		
		

		$user_form = $formData->get(array('userid'=>$id));

		if (isset($user_form['programdate1']) && $user_form['programdate1']!='') {$user_form['programdate1'] = date('d-m-Y', $user_form['programdate1']->sec); }
		if (isset($user_form['programdate2']) && $user_form['programdate2']!='') {$user_form['programdate2'] = date('d-m-Y', $user_form['programdate2']->sec); }
		if (isset($user_form['programdate3']) && $user_form['programdate3']!='') {$user_form['programdate3'] = date('d-m-Y', $user_form['programdate3']->sec); }
		if (isset($user_form['programdate4']) && $user_form['programdate4']!='') {$user_form['programdate4'] = date('d-m-Y', $user_form['programdate4']->sec); }
		if (isset($user_form['programdate5']) && $user_form['programdate5']!='') {$user_form['programdate5'] = date('d-m-Y', $user_form['programdate5']->sec); }
		if (isset($user_form['programdate6']) && $user_form['programdate6']!='') {$user_form['programdate6'] = date('d-m-Y', $user_form['programdate6']->sec); }

		if (isset ($user_form['cocktaildate1'])&& $user_form['cocktaildate1']!='') { $user_form['cocktaildate1'] = date('d-m-Y', $user_form['cocktaildate1']->sec);; }
		if (isset ($user_form['cocktaildate2'])&& $user_form['programdate2']!='') { $user_form['cocktaildate2']  = date('d-m-Y', $user_form['cocktaildate2']->sec);; }
		if (isset ($user_form['cocktaildate3'])&& $user_form['programdate3']!='') { $user_form['cocktaildate3']  = date('d-m-Y', $user_form['cocktaildate3']->sec);; }
		if (isset ($user_form['cocktaildate4'])&& $user_form['programdate4']!='') { $user_form['cocktaildate4']  = date('d-m-Y', $user_form['cocktaildate4']->sec);; }


		$form = Formly::make($user_form);


		//$form = Formly::make($user_profile);

		//$form->framework = 'zurb';

		return View::make('booth.viewform')
					->with('form',$form)
					->with('data',$user_form)
					->with('id',$id)
					->with('crumb',$this->crumb)
					->with('title','Operational Form Submission');

		

	}

	public function get_printbadge($id){
		$id = new MongoId($id);

		$booth = new Booth();

		$doc = $booth->get(array('_id'=>$id));

		return View::make('print.boothbadge')->with('profile',$doc);
	}

	public function get_view($id){
		$id = new MongoId($id);

		$booth = new Document();

		$doc = $booth->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}


	public function get_fileview($id){
		$_id = new MongoId($id);

		$booth = new Document();

		$doc = $booth->get(array('_id'=>$_id));

		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];

		return View::make('pop.fileview')->with('doc',$doc)->with('href',$file);
	}

	public function get_approve($id){
		$id = new MongoId($id);

		$booth = new Document();

		$doc = $booth->get(array('_id'=>$id));

		$form = new Formly();

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];
		
		return View::make('pop.approval')->with('doc',$doc)->with('form',$form)->with('href',$file);
	}

	public function rand_string( $length ) {
		$chars = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ0123456789";	

		$size = strlen( $chars );
		$str = '';
		for( $i = 0; $i < $length; $i++ ) {
			$str .= $chars[ rand( 0, $size - 1 ) ];
		}

		return $str;
	}

	public function get_makeidhall() {
		$booth = new Booth;

		$booths = $booth->find();

		foreach ($booths as $n) {
			$_id = $n['_id'];
			$idhall = $n['hall_id'];
			$hallidmongo = new MongoId($idhall);
			$booth->update(array('_id'=>$_id),array('$set'=>array('hall_id'=>$hallidmongo)));
		}
		

		return true;
	}

	public function get_makehallname() {
		$booth = new Booth;
		$hall = new Hall;

		$booths = $booth->find();

		foreach ($booths as $n) {
			$_id = $n['_id'];
			$idhall = $n['hall_id'];
			$hallidmongo = new MongoId($idhall);
			$hallselected = $hall->get(array('_id'=>$hallidmongo));
			$hallname = $hallselected['name'];
			$booth->update(array('_id'=>$_id),array('$set'=>array('hallname'=>$hallname)));
		}
		

		return true;
	}


	public function get_slotfreeid() {
		$booth = new Booth;


		$booths = $booth->find();

		foreach ($booths as $n) {
			$_id = $n['_id'];
			$idhall = $n['size'];

			$freeslot = round(($n['size']/9)*2);

			if($freeslot>10){
				$freeslot =10;
			}else{
				$freeslot =$freeslot;
			}

			$booth->update(array('_id'=>$_id),array('$set'=>array('freepassslot'=>$freeslot)));
		}
		

		return true;
	}

	public function get_updateField(){
		$booth = new Booth();

		$booths = $booth->find();
		$updateCount = 0;
		$caheIDCount = 0;
		$caheOBJCount = 0;
		$companyNPWPCount = 0;
		$groupIDCount = 0;
		$groupNameCount = 0;
		$invLetterCount = 0;
		$invCompanyAddCount = 0;
		$paymentStatCount = 0;
		$AddCount = 0;
		$AddCountInvoice = 0;
		$ConfCount = 0;
		$normalRate =0;

		foreach($booths as $att){

			if(!isset($att['totalIDR'])){
				$_id = $att['_id'];
				//check type and golf status
				$regtype = $att['regtype'];
				$golf = $att['golf'];
				
				if($regtype == 'PD' && $golf == 'No'){
					$totalIDR = '4500000';
					$totalUSD = '';
				}elseif ($regtype == 'PD' && $golf == 'Yes'){
					$totalIDR = '7000000';
					$totalUSD = '';
				}elseif ($regtype == 'PO' && $golf == 'No'){
					$totalIDR = '';
					$totalUSD = '500';
				}elseif ($regtype == 'PO' && $golf == 'Yes'){
					$totalIDR = '2500000';
					$totalUSD = '500';
				}elseif ($regtype == 'SD'){
					$totalIDR = '400000';
					$totalUSD = '';
				}elseif ($regtype == 'SO'){
					$totalIDR = '';
					$totalUSD = '120';
				}

				if($booth->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$updateCount++;	
				}
				
			}

			if(!isset($att['cache_id'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('cache_id'=>'')))){
					$caheIDCount++;	
				}
			}

			if(!isset($att['cache_obj'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('cache_obj'=>'')))){
					$caheOBJCount++;	
				}
				
			}

			if(!isset($att['companys_npwp'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('companys_npwp'=>'')))){
					$companyNPWPCount++;	
				}
				
			}

			if(!isset($att['groupId'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('groupId'=>'')))){
					$groupIDCount++;	
				}
				
			}
			if(!isset($att['groupName'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('groupName'=>'')))){
					$groupNameCount++;	
				}
				
			}

			if(!isset($att['inv_letter'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('inv_letter'=>'')))){
					$invLetterCount++;	
				}
				
			}

			if(!isset($att['invoice_address_conv'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('invoice_address_conv'=>'')))){
					$invCompanyAddCount++;	
				}
				
			}
			if(!isset($att['paymentStatus'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('paymentStatus'=>'')))){
					$paymentStatCount++;	
				}
				
			}
			

			if(!isset($att['address'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('address'=>'')))){
					$AddCount++;	
				}
				
			}

			if(!isset($att['addressInvoice'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('addressInvoice'=>'')))){
					$AddCountInvoice++;	
				}
				
			}

			if(!isset($att['confirmation'])){
				$_id = $att['_id'];
				if($booth->update(array('_id'=>$_id),array('$set'=>array('confirmation'=>'none')))){
					$ConfCount++;	
				}
				
			}

			if($att['totalIDR']=='-' || $att['totalUSD']=='-'){
				$_id = $att['_id'];
				//check type and golf status
				$regtype = $att['regtype'];
				$golf = $att['golf'];
				
				if($regtype == 'PD' && $golf == 'No'){
					$totalIDR = '4500000';
					$totalUSD = '';
				}elseif ($regtype == 'PD' && $golf == 'Yes'){
					$totalIDR = '7000000';
					$totalUSD = '';
				}elseif ($regtype == 'PO' && $golf == 'No'){
					$totalIDR = '';
					$totalUSD = '500';
				}elseif ($regtype == 'PO' && $golf == 'Yes'){
					$totalIDR = '2500000';
					$totalUSD = '500';
				}elseif ($regtype == 'SD'){
					$totalIDR = '400000';
					$totalUSD = '';
				}elseif ($regtype == 'SO'){
					$totalIDR = '';
					$totalUSD = '120';
				}

				if($booth->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$normalRate++;	
				}
				
			}

			


		}
		
		return View::make('booth.updateField')
				->with('updateCount',$updateCount)
				->with('caheIDCount',$caheIDCount)
				->with('caheOBJCount',$caheOBJCount)
				->with('companyNPWPCount',$companyNPWPCount)
				->with('groupIDCount',$groupIDCount)
				->with('groupNameCount',$groupNameCount)
				->with('invLetterCount',$invLetterCount)
				->with('invCompanyAddCount',$invCompanyAddCount)
				->with('paymentStatCount',$paymentStatCount)
				->with('AddCount',$AddCount)
				->with('AddCountInvoice',$AddCountInvoice)
				->with('ConfCount',$ConfCount)
				->with('normalRate',$normalRate)
				->with('title','Update Field');
	}

}