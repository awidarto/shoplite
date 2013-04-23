<?php

class Exhibitor_Controller extends Base_Controller {

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
		$this->crumb->add('exhibitor','Exhibitors');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{


		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$action_selection = $form->select('action','',Config::get('kickstart.actionselection'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">'.$action_selection.'</span>';

		$heads = array('#',$select_all,'Reg. Number','Reg. Date','Email','Hall','Booth No','First Name','Last Name','Company','Country','Form Status','Indv Form Status','');

		$searchinput = array(false,false,'Reg Number','Reg. Date','Email','Hall',false,'First Name','Last Name','Company','Country',false,false,false);

		$colclass = array('','span1','span3','span1','span3','span3','span1','span1','span1','','','','','');

		if(Auth::user()->role == 'root' || Auth::user()->role == 'super' || Auth::user()->role == 'onsite' || Auth::user()->role == 'exhibitionadmin'){
			return View::make('tables.simple')
				->with('title','Exhibitors')
				->with('newbutton','New Exhibitors')
				->with('disablesort','0,1,6,10')
				->with('addurl','exhibitor/add')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('exhibitor'))
				->with('ajaxdel',URL::to('exhibitor/del'))
				->with('ajaxpay',URL::to('exhibitor/paystatus'))
				->with('ajaxformstatus',URL::to('exhibitor/setformstatus'))
				->with('ajaxformstatusindividual',URL::to('exhibitor/setformstatusindividual'))
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


		$fields = array('registrationnumber','createdDate','email','hall','firstname','lastname','company','country','formstatus','formstatus','formstatus');

		$rel = array('like','like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both','both');

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

		$exhibitor = new Exhibitor();

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

			$extra = $doc;

			//find operational form
			$opform = new Operationalform();

			$iduser = $doc['_id']->__toString();
			$user_form = $opform->get(array('userid'=>$iduser));

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

			if(isset($doc['formstatus'])){
				if($doc['formstatus'] == 'submitted'){
					$formstatus = '<span class="fontRed fontBold paymentStatusTable">'.$doc['formstatus'].'</span>';
					
				}elseif ($doc['formstatus'] == 'approved') {
					$formstatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['formstatus'].'</span>';
				}else{
					$formstatus = '<span class="fontGray fontBold paymentStatusTable">'.$doc['formstatus'].'</span>';
					
				}
			}else{
				$formstatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['formstatus'].'</span>';
			}

			if(isset($user_form)){
				if(isset($user_form['submitform1']) && $user_form['submitform1']=='true'){
					$form1='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form1='open';
				}
				if(isset($user_form['submitform2']) && $user_form['submitform2']=='true'){
					$form2='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form2='open';
				}
				if(isset($user_form['submitform3']) && $user_form['submitform3']=='true'){
					$form3='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form3='open';
				}
				if(isset($user_form['submitform4']) && $user_form['submitform4']=='true'){
					$form4='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form4='open';
				}
				if(isset($user_form['submitform5']) && $user_form['submitform5']=='true'){
					$form5='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form5='open';
				}
				if(isset($user_form['submitform6']) && $user_form['submitform6']=='true'){
					$form6='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form6='open';
				}
				if(isset($user_form['submitform7']) && $user_form['submitform7']=='true'){
					$form7='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form7='open';
				}
				if(isset($user_form['submitform8']) && $user_form['submitform8']=='true'){
					$form8='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form8='open';
				}
				if(isset($user_form['submitform9']) && $user_form['submitform9']=='true'){
					$form9='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form9='open';
				}
				if(isset($user_form['submitform10']) && $user_form['submitform10']=='true'){
					$form10='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form10='open';
				}
				if(isset($user_form['submitform11']) && $user_form['submitform11']=='true'){
					$form11='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form11='open';
				}
				if(isset($user_form['submitform12']) && $user_form['submitform12']=='true'){
					$form12='<span style="color:#bc1c48;">submitted</span>';
				}else{
					$form12='open';
				}
			}else{
				$form1 ='open';
				$form2 ='open';
				$form3 ='open';
				$form4 ='open';
				$form5 ='open';
				$form6 ='open';
				$form7 ='open';
				$form8 ='open';
				$form9 ='open';
				$form10 ='open';
				$form11 ='open';
				$form12 ='open';
			}
				

			if(isset($doc['emailregsent']) && ($doc['emailregsent']!=0)){
				$rowResendMessage = '<a class="icon-"  ><i style="color:#bc1c48;">&#xe165;</i><span class="sendexhibitregistmail" id="'.$doc['_id'].'" style="color:#bc1c48;">Send Email Reg</span>';
			}else{
				$rowResendMessage = '<a class="icon-"  ><i>&#xe165;</i><span class="sendexhibitregistmail" id="'.$doc['_id'].'" >Send Email Reg</span>';
			}

			if($doc['formstatus']=='open'){
				//if(Auth::user()->email == 'taufiq.ridha@gmail.com'){
					$rowEditform = '<a class="icon-"  ><i>&#x0025;</i><span class="fillform" id="'.$doc['_id'].'" rel="fillform"> Fill Form</span>';
				//}else{
				//	$rowEditform='';
				//}
			}else{
				$rowEditform = '<a class="icon-"  ><i>&#x0025;</i><span class="editform" id="'.$doc['_id'].'" rel="editform"> Edit Form</span>';
			}

			//both no
			$boothid = $doc['boothid'];

			$booth_id = new MongoId($boothid);

			//find booth
			$booth = new Booth();

			$boothno = $booth->get(array('_id'=>$booth_id));
			$boothname = $boothno['boothno'];

			$aadata[] = array(
				$counter,
				$select,
				(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
				date('Y-m-d', $doc['createdDate']->sec),
				$doc['email'],
				$doc['hall'],
				$boothname,
				'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
				$doc['lastname'],
				$doc['company'],
				$doc['country'],
				$formstatus,
				'#1:&nbsp;'.$form1.'</br>'.
				'#2:&nbsp;'.$form2.'</br>'.
				'#3:&nbsp;'.$form3.'</br>'.
				'#4:&nbsp;'.$form4.'</br>'.
				'#5:&nbsp;'.$form5.'</br>'.
				'#6:&nbsp;'.$form6.'</br>'.
				'#7:&nbsp;'.$form7.'</br>'.
				'#8:&nbsp;'.$form8.'</br>'.
				'#9:&nbsp;'.$form9.'</br>'.
				'#10:&nbsp;'.$form10.'</br>'.
				'#11:&nbsp;'.$form11.'</br>'.
				'#12:&nbsp;'.$form12.'</br>',

				$rowResendMessage.
				'<a class="icon-"  ><i>&#xe1b0;</i><span class="formstatus" id="'.$doc['_id'].'" > Set Form Status</span>'.
				'<a class="icon-"  ><i>&#x0038;</i><span class="formstatusindiv" id="'.$doc['_id'].'" > Set Ind. Form Stat.</span>'.
				'<a class="icon-"  ><i>&#x0035;</i><span class="viewform" id="'.$doc['_id'].'" rel="viewform"> View Form</span>'.
				$rowEditform.
				'<a class="icon-"  href="'.URL::to('exhibitor/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				'<a class="icon-"  href="'.URL::to('exhibitor/importbothassistant/'.$doc['_id']).'"><i>&#xe1dd;</i><span>Import Exh. pass.</span>'.
				'<a class="icon-"  href="'.URL::to('import/exhibitor/'.$doc['_id']).'"><i>&#x0052;</i><span>Import Worker</span>'.
				'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>',
				
				'extra'=>$extra
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

		$user = new Exhibitor();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('exhibitor.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('exhibitor.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function post_paystatus(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatus');

		$user = new Exhibitor();

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

		$user = new Exhibitor();

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

		$user = new Exhibitor();

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

	public function post_setformstatusindividual(){
		
		$id = Input::get('id');
		$formstatus = Input::get('formstatus');
		$formno = Input::get('formno');

		$user = new Operationalform();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			//get first 
			$data = $user->get(array('userid'=>$id));

			if(isset($data)){
				if($user->update(array('userid'=>$id),array('$set'=>array('submitform'.$formno=>$formstatus)))){
					
					$result = array('status'=>'OK','data'=>'CONTENTDELETED');
					
				}else{
					
					$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
				}
			}else{
				$result = array('status'=>'NODATA','data'=>'There\'s no data to set');
			}
		}

		print json_encode($result);
	}
	


	public function post_paystatusgolfconvention(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatusgolfconvention');

		$user = new Exhibitor();

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
			$this->crumb->add('exhibitor/add','New Exhibitor');
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('exhibitor/type/'.$type,'Exhibitor');

			$this->crumb->add('exhibitor/type/'.$type,depttitle($type));
			$this->crumb->add('exhibitor/add','New Exhibitor');
		}


		$form = new Formly();
		return View::make('exhibitor.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Exhibitor');

	}


	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	    	'position' => 'required',
	        'email' => 'required|email|unique:exhibitor',
	        
	        'company' => 'required',
	        'companyphone' => 'required',
	        'address_1' => 'required',
	        'city' => 'required',
	        'country' => 'required',
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('exhibitor/add')->with_errors($validation)->with_input(Input::all());

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

			if(isset($data['alsosendemail'])){
				$data['sendemaillater']='no';
				$data['emailregsent']=1;
			}else{
				$data['sendemaillater']='yes';
				$data['emailregsent']=0;
			}

			$user = new Exhibitor();

			if($obj = $user->insert($data)){

				if($data['sendemaillater']=='no'){
					Event::fire('exhibitor.logmessage',array($obj['_id'],$passwordRandom));
					Event::fire('exhibitor.createformadmin',array($obj['_id'],$passwordRandom));
				}else{
					Event::fire('exhibitor.logmessage',array($obj['_id'],$passwordRandom));
				}
				
		    	return Redirect::to('exhibitor')->with('notify_success',Config::get('site.register_success'));
			}else{
		    	return Redirect::to('exhibitor')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}


	public function get_edit($id){

		$this->crumb->add('exhibitor/edit','Edit',false);

		$user = new Exhibitor();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);

		$this->crumb->add('exhibitor/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('exhibitor.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Exhibitor');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('exhibitor/edit')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();
			$data['role'] = 'EXH';
			
			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Exhibitor();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);			

				$reg_number[0] = 'E';
				$reg_number[1] = $data['role'];
				$reg_number[2] = '00';


			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'visitor'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

				$reg_number[0] = 'E';
				$reg_number[1] = $data['role'];
				$reg_number[2] = '00';

				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}


			$data['registrationnumber'] = implode('-',$reg_number);
			
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('exhibitor')->with('notify_success','Exhibitor saved successfully');
			}else{
		    	return Redirect::to('exhibitor')->with('notify_success','Exhibitor saving failed');
			}
			
	    }

		
	}

	public function get_viewform($id){

		$this->crumb->add('exhibitor','Form Submission',false);

		//$this->crumb->add('user/edit','Edit',false);
		$user = new Exhibitor();

		$formData = new Operationalform();



	
		

		$_id = new MongoId($id);

		$userdata = $user->get(array('_id'=>$_id));


		$booths = new Booth();
		
		
		$booth = '';


		if(isset($userdata['boothid'])){
			$_boothID = new MongoId($userdata['boothid']);
			$booth = $booths->get(array('_id'=>$_boothID));
		}

		
		

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

		return View::make('exhibitor.viewform')
					->with('form',$form)
					->with('userdata',$userdata)
					->with('data',$user_form)
					->with('booth',$booth)
					->with('id',$id)
					->with('crumb',$this->crumb)
					->with('title','Operational Form Submission');

		

	}


	public function get_importbothassistant($id){

		$this->crumb->add('exhibitor','Import Booth Assistant',false);

		//$this->crumb->add('user/edit','Edit',false);
		$user = new Exhibitor();

		$formData = new Operationalform();


		$_id = new MongoId($id);

		$userdata = $user->get(array('_id'=>$_id));


		$booths = new Booth();
		
		
		$booth = '';


		if(isset($userdata['boothid'])){
			$_boothID = new MongoId($userdata['boothid']);
			$booth = $booths->get(array('_id'=>$_boothID));
		}

		
		

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

		$boothassistant = new Boothassistant;



		$boothassistantdata = $boothassistant->get(array('exhibitorid'=>$id));

		if(isset($boothassistantdata)){
			$boothassistantdata = $boothassistantdata;
		}else{
			$boothassistantdata = '';
		}


		//$form = Formly::make($user_profile);

		//$form->framework = 'zurb';

		return View::make('exhibitor.importbothassistant')
					->with('form',$form)
					->with('userdata',$userdata)
					->with('data',$user_form)
					->with('booth',$booth)
					->with('boothassistantdata',$boothassistantdata)
					->with('id',$id)
					->with('ajaxImportBoothAssistant',URL::to('boothassistant/individual'))
					->with('crumb',$this->crumb)
					->with('title','Import Exhibitor\'s Pass for '.$userdata['company'].', '.$userdata['registrationnumber']);

	}


	public function get_fillform($iduser){
		

		$exhibitor = new Exhibitor();
		$booths = new Booth();
		
		//$userid = Auth::exhibitor()->id;

		$_id = new MongoId($iduser);
		
		$booth = '';

		$userdata = $exhibitor->get(array('_id'=>$_id));

		if(isset($userdata['boothid'])){
			$_boothID = new MongoId($userdata['boothid']);
			$booth = $booths->get(array('_id'=>$_boothID));
		}

		$this->crumb->add('exhibition','Operational Form');

		$form = new Formly();
		return View::make('exhibitor.fillform')
					->with('booth',$booth)
					->with('userdata',$userdata)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Operational Form');

	}


	public function post_fillform(){


		$data = Input::get();

		$exhibitor = new Exhibitor();
		
    	if (isset($data['programdate1']) && $data['programdate1']!='') {$data['programdate1'] = new MongoDate(strtotime($data['programdate1']." 00:00:00")); }
		if (isset($data['programdate2']) && $data['programdate2']!='') {$data['programdate2'] = new MongoDate(strtotime($data['programdate2']." 00:00:00")); }
		if (isset($data['programdate3']) && $data['programdate3']!='') {$data['programdate3'] = new MongoDate(strtotime($data['programdate3']." 00:00:00")); }
		if (isset($data['programdate4']) && $data['programdate4']!='') {$data['programdate4'] = new MongoDate(strtotime($data['programdate4']." 00:00:00")); }
		if (isset($data['programdate5']) && $data['programdate5']!='') {$data['programdate5'] = new MongoDate(strtotime($data['programdate5']." 00:00:00")); }
		if (isset($data['programdate6']) && $data['programdate6']!='') {$data['programdate6'] = new MongoDate(strtotime($data['programdate6']." 00:00:00")); }

		if (isset ($data['cocktaildate1'])&& $data['cocktaildate1']!='') { $data['cocktaildate1'] = new MongoDate(strtotime($data['cocktaildate1']." 00:00:00")); }
		if (isset ($data['cocktaildate2'])&& $data['programdate2']!='') { $data['cocktaildate2'] = new MongoDate(strtotime($data['cocktaildate2']." 00:00:00")); }
		if (isset ($data['cocktaildate3'])&& $data['programdate3']!='') { $data['cocktaildate3'] = new MongoDate(strtotime($data['cocktaildate3']." 00:00:00")); }
		if (isset ($data['cocktaildate4'])&& $data['programdate4']!='') { $data['cocktaildate4'] = new MongoDate(strtotime($data['cocktaildate4']." 00:00:00")); }

		unset($data['csrf_token']);

		$userid = $data['idexhibitor'];


		$_id = new MongoId($userid);

		$userdata = $exhibitor->get(array('_id'=>$_id));
		$data['userid'] = $userdata['_id']->__toString();

		$data['createdDate'] = new MongoDate();
		$data['lastUpdate'] = new MongoDate();

		unset($data['idexhibitor']);


		$exhibitor = new Exhibitor();

		$submitdata = new Operationalform();

		$savebtn = $data['btnSave'];
		$formstatus = $data['formstatus'];
		
		

		

		if(isset($data['submitform1'])){
			$submitform1 = $data['submitform1'];
		}else{
			$submitform1 ='';
		}

		if(isset($data['submitform2'])){
			$submitform2 = $data['submitform2'];
		}else{
			$submitform2 ='';
		}

		if(isset($data['submitform3'])){
			$submitform3 = $data['submitform3'];
		}else{
			$submitform3 ='';
		}
		if(isset($data['submitform4'])){
			$submitform4 = $data['submitform4'];
		}else{
			$submitform4 ='';
		}
		if(isset($data['submitform5'])){
			$submitform5 = $data['submitform5'];
		}else{
			$submitform5 ='';
		}
		if(isset($data['submitform6'])){
			$submitform6 = $data['submitform6'];
		}else{
			$submitform6 ='';
		}
		if(isset($data['submitform7'])){
			$submitform7 = $data['submitform7'];
		}else{
			$submitform7 ='';
		}
		if(isset($data['submitform8'])){
			$submitform8 = $data['submitform8'];
		}else{
			$submitform8 ='';
		}
		if(isset($data['submitform9'])){
			$submitform9 = $data['submitform9'];
		}else{
			$submitform9 ='';
		}
		if(isset($data['submitform10'])){
			$submitform10 = $data['submitform10'];
		}else{
			$submitform10 ='';
		}
		if(isset($data['submitform11'])){
			$submitform11 = $data['submitform11'];
		}else{
			$submitform11 ='';
		}
		if(isset($data['submitform12'])){
			$submitform12 = $data['submitform12'];
		}else{
			$submitform12 ='';
		}


		if($savebtn == 'true' && $submitform1 != 'true' && $submitform2 != 'true' && $submitform3 != 'true' && $submitform4 != 'true' && $submitform5 != 'true' && $submitform6 != 'true' && $submitform7 != 'true' && $submitform8 != 'true' && $submitform9 != 'true' && $submitform10 != 'true' && $submitform11 != 'true' && $submitform12 != 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form has been saved";
		}else if($submitform1 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 1 has been sumbitted";

		}else if($submitform2 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 2 has been sumbitted";

		}else if($submitform3 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 3 has been sumbitted";

		}else if($submitform4 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 4 has been sumbitted";

		}else if($submitform5 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 5 has been sumbitted";

		}else if($submitform6 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 6 has been sumbitted";

		}else if($submitform7 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 7 has been sumbitted";

		}else if($submitform8 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 8 has been sumbitted";

		}else if($submitform9 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 9 has been sumbitted";

		}else if($submitform10 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 10 has been sumbitted";

		}else if($submitform11 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 11 has been sumbitted";

		}else if($submitform12 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 12 has been sumbitted";


		}else{
			$formstatus = 'submitted';
			$messagedisplay ="All form has been sumbitted";
			
		}

		unset($savebtn);

		if($obj = $submitdata->insert($data)){
			
			$exhibitor->update(array('_id'=>$_id),array('$set'=>array('formstatus'=>$formstatus)));
			$user_id = $_id;

			$ex = $exhibitor->get(array('_id'=>$_id));

			if(isset($data['submitform1'])){
				Event::fire('exhibition.postoperationalform',array(1,$obj['_id'],$user_id));

			}else if (isset($data['submitform2'])) {
				Event::fire('exhibition.postoperationalform',array(2,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform3'])) {
				Event::fire('exhibition.postoperationalform',array(3,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform4'])) {
				Event::fire('exhibition.postoperationalform',array(4,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform5'])) {
				Event::fire('exhibition.postoperationalform',array(5,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform6'])) {
				Event::fire('exhibition.postoperationalform',array(6,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform7'])) {
				Event::fire('exhibition.postoperationalform',array(7,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform8'])) {
				Event::fire('exhibition.postoperationalform',array(8,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform9'])) {
				Event::fire('exhibition.postoperationalform',array(9,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform10'])) {
				Event::fire('exhibition.postoperationalform',array(10,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform11'])) {
				Event::fire('exhibition.postoperationalform',array(11,$obj['_id'],$user_id));
				
			}else if (isset($data['submitform12'])) {
				Event::fire('exhibition.postoperationalform',array(12,$obj['_id'],$user_id));
				
			}
			else if ($ex['formstatus']!='saved') {
				Event::fire('exhibition.postoperationalform',array('all',$obj['_id'],$user_id));
				
			}
			

			return Redirect::to('exhibitor')->with('notify_operationalform',$messagedisplay);
			//return Redirect::to($redirectto)->with('notify_success',Config::get('site.register_success'));
			
			//Event::fire('exhibitor.createformadmin',array($obj['_id'],$passwordRandom));
			
	    	
		}else{
	    	return Redirect::to('exhibitor')->with('notify_operationalform','Error data while submitted, please try again!');
		}

	    

		
	}

	public function get_editform($id){

		$this->crumb->add('exhibitor','Form Submission',false);

		//$this->crumb->add('user/edit','Edit',false);
		$user = new Exhibitor();

		$formData = new Operationalform();



	
		

		$_id = new MongoId($id);

		$userdata = $user->get(array('_id'=>$_id));


		$booths = new Booth();
		
		
		$booth = '';


		if(isset($userdata['boothid'])){
			$_boothID = new MongoId($userdata['boothid']);
			$booth = $booths->get(array('_id'=>$_boothID));
		}

		
		

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

		return View::make('exhibitor.editform')
					->with('form',$form)
					->with('userdata',$userdata)
					->with('data',$user_form)
					->with('booth',$booth)
					->with('id',$id)
					->with('crumb',$this->crumb)
					->with('title','Operational Form Submission');

		

	}

	public function post_editform(){

		
		$data = Input::get();

		$id = new MongoId($data['id']);
		$data['lastUpdate'] = new MongoDate();
		
		
		unset($data['csrf_token']);
		unset($data['id']);

		$operationalform = new Operationalform();
		
		if (isset($data['programdate1']) && $data['programdate1']!='') {$data['programdate1'] = new MongoDate(strtotime($data['programdate1']." 00:00:00")); }
		if (isset($data['programdate2']) && $data['programdate2']!='') {$data['programdate2'] = new MongoDate(strtotime($data['programdate2']." 00:00:00")); }
		if (isset($data['programdate3']) && $data['programdate3']!='') {$data['programdate3'] = new MongoDate(strtotime($data['programdate3']." 00:00:00")); }
		if (isset($data['programdate4']) && $data['programdate4']!='') {$data['programdate4'] = new MongoDate(strtotime($data['programdate4']." 00:00:00")); }
		if (isset($data['programdate5']) && $data['programdate5']!='') {$data['programdate5'] = new MongoDate(strtotime($data['programdate5']." 00:00:00")); }
		if (isset($data['programdate6']) && $data['programdate6']!='') {$data['programdate6'] = new MongoDate(strtotime($data['programdate6']." 00:00:00")); }

		if (isset ($data['cocktaildate1'])&& $data['cocktaildate1']!='') { $data['cocktaildate1'] = new MongoDate(strtotime($data['cocktaildate1']." 00:00:00")); }
		if (isset ($data['cocktaildate2'])&& $data['programdate2']!='') { $data['cocktaildate2'] = new MongoDate(strtotime($data['cocktaildate2']." 00:00:00")); }
		if (isset ($data['cocktaildate3'])&& $data['programdate3']!='') { $data['cocktaildate3'] = new MongoDate(strtotime($data['cocktaildate3']." 00:00:00")); }
		if (isset ($data['cocktaildate4'])&& $data['programdate4']!='') { $data['cocktaildate4'] = new MongoDate(strtotime($data['cocktaildate4']." 00:00:00")); }

		$exhibitor = new Exhibitor();


		$savebtn = $data['btnSave'];

		if(isset($data['submitform1'])){
			$submitform1 = $data['submitform1'];
		}else{
			$submitform1 ='';
		}

		if(isset($data['submitform2'])){
			$submitform2 = $data['submitform2'];
		}else{
			$submitform2 ='';
		}

		if(isset($data['submitform3'])){
			$submitform3 = $data['submitform3'];
		}else{
			$submitform3 ='';
		}
		if(isset($data['submitform4'])){
			$submitform4 = $data['submitform4'];
		}else{
			$submitform4 ='';
		}
		if(isset($data['submitform5'])){
			$submitform5 = $data['submitform5'];
		}else{
			$submitform5 ='';
		}
		if(isset($data['submitform6'])){
			$submitform6 = $data['submitform6'];
		}else{
			$submitform6 ='';
		}
		if(isset($data['submitform7'])){
			$submitform7 = $data['submitform7'];
		}else{
			$submitform7 ='';
		}
		if(isset($data['submitform8'])){
			$submitform8 = $data['submitform8'];
		}else{
			$submitform8 ='';
		}
		if(isset($data['submitform9'])){
			$submitform9 = $data['submitform9'];
		}else{
			$submitform9 ='';
		}
		if(isset($data['submitform10'])){
			$submitform10 = $data['submitform10'];
		}else{
			$submitform10 ='';
		}
		if(isset($data['submitform11'])){
			$submitform11 = $data['submitform11'];
		}else{
			$submitform11 ='';
		}
		if(isset($data['submitform12'])){
			$submitform12 = $data['submitform12'];
		}else{
			$submitform12 ='';
		}



		if($savebtn == 'true' && $submitform1 != 'true' && $submitform2 != 'true' && $submitform3 != 'true' && $submitform4 != 'true' && $submitform5 != 'true' && $submitform6 != 'true' && $submitform7 != 'true' && $submitform8 != 'true' && $submitform9 != 'true' && $submitform10 != 'true' && $submitform11 != 'true' && $submitform12 != 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form has been saved";
		}else if($submitform1 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 1 has been sumbitted";

		}else if($submitform2 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 2 has been sumbitted";

		}else if($submitform3 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 3 has been sumbitted";

		}else if($submitform4 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 4 has been sumbitted";

		}else if($submitform5 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 5 has been sumbitted";

		}else if($submitform6 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 6 has been sumbitted";

		}else if($submitform7 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 7 has been sumbitted";

		}else if($submitform8 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 8 has been sumbitted";

		}else if($submitform9 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 9 has been sumbitted";

		}else if($submitform10 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 10 has been sumbitted";

		}else if($submitform11 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 11 has been sumbitted";

		}else if($submitform12 == 'true'){
			$formstatus = 'saved';
			$messagedisplay ="Form 12 has been sumbitted";


		}else{
			$formstatus = 'submitted';
			$messagedisplay ="All form has been sumbitted";
			
		}



		unset($savebtn);

		if($obj = $operationalform->update(array('_id'=>$id),array('$set'=>$data))){

			$form = $operationalform->get(array('_id'=>$id));
			
			$userid = $form['userid'];

			$_id = new MongoId($userid);


			$exhibitor->update(array('_id'=>$_id),array('$set'=>array('formstatus'=>$formstatus)));

			$ex = $exhibitor->get(array('_id'=>$_id));

			if(isset($data['submitform1'])){
				Event::fire('exhibition.postoperationalform',array(1,$id,$_id));

			}else if (isset($data['submitform2'])) {
				Event::fire('exhibition.postoperationalform',array(2,$id,$_id));
				
			}else if (isset($data['submitform3'])) {
				Event::fire('exhibition.postoperationalform',array(3,$id,$_id));
				
			}else if (isset($data['submitform4'])) {
				Event::fire('exhibition.postoperationalform',array(4,$id,$_id));
				
			}else if (isset($data['submitform5'])) {
				Event::fire('exhibition.postoperationalform',array(5,$id,$_id));
				
			}else if (isset($data['submitform6'])) {
				Event::fire('exhibition.postoperationalform',array(6,$id,$_id));
				
			}else if (isset($data['submitform7'])) {
				Event::fire('exhibition.postoperationalform',array(7,$id,$_id));
				
			}else if (isset($data['submitform8'])) {
				Event::fire('exhibition.postoperationalform',array(8,$id,$_id));
				
			}else if (isset($data['submitform9'])) {
				Event::fire('exhibition.postoperationalform',array(9,$id,$_id));
				
			}else if (isset($data['submitform10'])) {
				Event::fire('exhibition.postoperationalform',array(10,$id,$_id));
				
			}else if (isset($data['submitform11'])) {
				Event::fire('exhibition.postoperationalform',array(11,$id,$_id));
				
			}else if (isset($data['submitform12'])) {
				Event::fire('exhibition.postoperationalform',array(12,$id,$_id));
				
			}
			else if ($ex['formstatus']!='saved') {
				Event::fire('exhibition.postoperationalform',array('all',$id,$_id));
				
			}

			
			return Redirect::to('exhibitor')->with('notify_operationalform',$messagedisplay);

		}else{
	    	return Redirect::to('exhibitor')->with('notify_operationalform','Error data while submitted, please try again!');
		}
		
	}

	public function get_printbadge($id){
		$id = new MongoId($id);

		$exhibitor = new Exhibitor();

		$doc = $exhibitor->get(array('_id'=>$id));

		return View::make('print.exhibitorbadge')->with('profile',$doc);
	}

	public function get_view($id){
		$id = new MongoId($id);

		$exhibitor = new Document();

		$doc = $exhibitor->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}


	public function get_fileview($id){
		$_id = new MongoId($id);

		$exhibitor = new Document();

		$doc = $exhibitor->get(array('_id'=>$_id));

		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];

		return View::make('pop.fileview')->with('doc',$doc)->with('href',$file);
	}

	public function get_approve($id){
		$id = new MongoId($id);

		$exhibitor = new Document();

		$doc = $exhibitor->get(array('_id'=>$id));

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



	public function get_updateField(){
		$exhibitor = new Exhibitor();

		$exhibitors = $exhibitor->find();
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

		foreach($exhibitors as $att){

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

				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$updateCount++;	
				}
				
			}

			if(!isset($att['cache_id'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('cache_id'=>'')))){
					$caheIDCount++;	
				}
			}

			if(!isset($att['cache_obj'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('cache_obj'=>'')))){
					$caheOBJCount++;	
				}
				
			}

			if(!isset($att['companys_npwp'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('companys_npwp'=>'')))){
					$companyNPWPCount++;	
				}
				
			}

			if(!isset($att['groupId'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('groupId'=>'')))){
					$groupIDCount++;	
				}
				
			}
			if(!isset($att['groupName'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('groupName'=>'')))){
					$groupNameCount++;	
				}
				
			}

			if(!isset($att['inv_letter'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('inv_letter'=>'')))){
					$invLetterCount++;	
				}
				
			}

			if(!isset($att['invoice_address_conv'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('invoice_address_conv'=>'')))){
					$invCompanyAddCount++;	
				}
				
			}
			if(!isset($att['paymentStatus'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('paymentStatus'=>'')))){
					$paymentStatCount++;	
				}
				
			}
			

			if(!isset($att['address'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('address'=>'')))){
					$AddCount++;	
				}
				
			}

			if(!isset($att['addressInvoice'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('addressInvoice'=>'')))){
					$AddCountInvoice++;	
				}
				
			}

			if(!isset($att['confirmation'])){
				$_id = $att['_id'];
				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('confirmation'=>'none')))){
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

				if($exhibitor->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$normalRate++;	
				}
				
			}

			


		}
		
		return View::make('exhibitor.updateField')
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


	public function post_sendmail(){
		$id = Input::get('id');
		$mailtype = Input::get('type');


		$user = new Exhibitor();
		$log = new Logmessage();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);

			//find user first
			$data = $user->get(array('_id'=>$_id));
			$logs = $log->get(array('user'=>$_id));
			$currentlog = $data['emailregsent']+1;
			

			if($logs!=null){
				if($mailtype == 'exhibitor.regsuccess'){
					if($user->update(array('_id'=>$_id),
						array('$set'=>array('emailregsent'=>$currentlog))
					)){
						Event::fire('exhibitor.createformadmin',array($data['_id'],$logs['passwordRandom']));
						$result = array('status'=>'OK','data'=>'CONTENTDELETED','message'=>'Successfully sent mail');
					}
					/*$body = View::make($mailtype)
						->with('data',$data)
						->with('fromadmin','yes')
						->with('passwordRandom',$logs['passwordRandom'])
						->render();

					Message::to($logs['emailto'])
					    ->from($logs['emailfrom'], $logs['emailfromname'])
					    ->cc($logs['emailcc1'], $logs['emailcc1name'])
					    ->subject($logs['emailsubject'])
					    ->body( $body )
					    ->html(true)
					    ->send();*/
					
				}
			}else{
				$result = array('status'=>'NOTFOUND','data'=>'CONTENTDELETED','message'=>'Can\'t Found Email to send');
			}
		}

		print json_encode($result);
	}

	public function get_printbadgeonsite($regnumber,$name,$companyname,$type){
		$data['name'] = $name;
		$data['registrationnumber'] = $regnumber;
		$data['companyname'] = $companyname;
		$data['type'] = $type;

		return View::make('print.exhibitorbadgeonsite')
		
		->with('profile',$data);
	}

	public function get_printbadgeall($boothassistantdata_id,$exhibitorid){
		
		$boothassistantdata = new Boothassistant();
		$ex = new Exhibitor();
		$booths = new Booth();
		$formData = new Operationalform();
		
		$_id = new MongoId($boothassistantdata_id);
		$_exhibitorid = new MongoId($exhibitorid);

		//find user first
		$data = $boothassistantdata->get(array('_id'=>$_id));
		$exhibitor = $ex->get(array('_id'=>$_exhibitorid));
		$user_form = $formData->get(array('userid'=>$exhibitorid));

		$booth = '';


		if(isset($exhibitor['boothid'])){
			$_boothID = new MongoId($exhibitor['boothid']);
			$booth = $booths->get(array('_id'=>$_boothID));
		}

		return View::make('print.exhibitorbadgeall')
		
		->with('profile',$data)
		->with('booth',$booth)
		->with('user_form',$user_form)
		->with('exhibitorid',$exhibitorid)
		->with('exhibitor',$exhibitor);
	}

	

	public function get_newprintbadgeonsite($registrationnumber,$name,$companyname,$type){
		$data = Input::get();
		$data['name'] = $name;
		$data['registrationnumber'] = $registrationnumber;
		$data['companyname'] = $companyname;
		$data['type'] = $type;
		return View::make('print.newexhibitorbadgeonsite')
		
		->with('profile',$data);
	}

	public function get_printbadgeonsite2($regnumber,$name,$companyname){
		$data['name'] = $name;
		$data['registrationnumber'] = $regnumber;
		$data['companyname'] = $companyname;

		return View::make('print.exhibitorbadgeonsite2')
		
		->with('profile',$data);
	}

	public function post_editboothassname(){
		$bootdataid = Input::get('bootdataid');
		$operationalformid = Input::get('operationalformid');
		$name = Input::get('new_value');
		$boothid = Input::get('elementid');
		
		//$displaytax = Input::get('foo');

		$boothdata = new Boothassistant();

		$operationalform = new Operationalform();

		if(is_null($bootdataid)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_operationalid = new MongoId($operationalformid);
			$_boothid = new MongoId($bootdataid);

			
			

			if($obj = $operationalform->update(array('_id'=>$_operationalid),array('$set'=>array($boothid=>$name)))){
				if($bootdataid!=''){
					$boothdata->update(array('_id'=>$_boothid),array('$set'=>array($boothid=>$name)));
				}
				$result = $name;
				
			}else{
				
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		return $result;
	}


	public function post_addboothassname(){
		$bootdataid = Input::get('bootdataid');
		$operationalformid = Input::get('operationalformid');
		$name = Input::get('new_value');
		$boothid = Input::get('elementid');
		
		//$displaytax = Input::get('foo');

		$boothdata = new Boothassistant();

		$operationalform = new Operationalform();

		if(is_null($bootdataid)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_operationalid = new MongoId($operationalformid);
			$_boothid = new MongoId($bootdataid);

			if($obj = $operationalform->update(array('_id'=>$_operationalid),array('$set'=>array($boothid=>$name)))){
				
				$result = $name;
				
			}else{
				
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		return $result;
	}

	public function get_generatepdfoperationalform($exhid,$formno){



		$data = Input::get();
		
		$data['exhbid'] = $exhid;
		$data['formno'] = $formno;

		$ex = new Exhibitor();
		$op = new Operationalform();

		$_id = new MongoId($exhid);
		
		$user = $ex->get(array('_id'=>$_id));
		$data = $op->get(array('userid'=>$exhid));

		$regnumber = $user['registrationnumber'];

	    if($formno == 'all'){
	        $doc = View::make('pdf.confirmexhibitor')
	                ->with('data',$data)
	                ->with('user',$user)
	                ->render();
	    }else{
	        $doc = View::make('pdf.confirmexhibitor-individual')
	                ->with('data',$data)
	                ->with('user',$user)
	                ->with('formnumber',$formno)
	                ->render();
	    }
	    
	    $pdf = new Pdf();

	    $pdf->make($doc);

	    $newdir = realpath(Config::get('kickstart.storage'));

	    $path = $newdir.'/operationalforms/confirmexhibitor'.$regnumber.'form-'.$formno.'.pdf';

	    $pdf->render();

	    $pdf->save($path);

	    return View::make('adminnotif')
	    ->with('title','Success')
		->with('data','Successfully created <strong>form-'.$formno.'</strong> for <strong>'.$regnumber.'</strong><br/> Now you can download the form in admin area');
	}


	public function get_generatepdfoperationalformbyid($idform,$exhid,$formno){



		$data = Input::get();
		
		$data['exhbid'] = $exhid;
		$data['idform'] = $idform;
		$data['formno'] = $formno;

		$ex = new Exhibitor();
		$op = new Operationalform();

		$_id = new MongoId($exhid);
		
		$user = $ex->get(array('_id'=>$_id));

		$_idform = new MongoId($idform);

		$data = $op->get(array('_id'=>$_idform));

		$regnumber = $user['registrationnumber'];

	    if($formno == 'all'){
	        $doc = View::make('pdf.confirmexhibitor')
	                ->with('data',$data)
	                ->with('user',$user)
	                ->render();
	    }else{
	        $doc = View::make('pdf.confirmexhibitor-individual')
	                ->with('data',$data)
	                ->with('user',$user)
	                ->with('formnumber',$formno)
	                ->render();
	    }
	    
	    $pdf = new Pdf();

	    $pdf->make($doc);

	    $newdir = realpath(Config::get('kickstart.storage'));

	    $path = $newdir.'/operationalforms/confirmexhibitor'.$regnumber.'form-'.$formno.'-'.$idform.'.pdf';

	    $pdf->render();

	    $pdf->save($path);

	    return View::make('adminnotif')
	    ->with('title','Success')
		->with('data','Successfully created <strong>form-'.$formno.'</strong> for <strong>'.$regnumber.'</strong><br/> Now you can download the form in admin area');
	}

}