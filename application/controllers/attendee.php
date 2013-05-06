<?php

class Attendee_Controller extends Base_Controller {

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
		$this->crumb->add('attendee','Attendees');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{


		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$action_selection = $form->select('action','',Config::get('kickstart.actionselection'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">'.$action_selection.'</span>';


		$heads = array('#',$select_all,'Reg. Number','Registered Date','Email','First Name','Last Name','Company','Reg. Type','Country','Conv. Status','Golf. Status','');

		$searchinput = array(false,false,'Reg Number','Reg. Date','Email','First Name','Last Name','Company',false,'Country',false,false,false);


		$colclass = array('','span1','span3','span1','span3','span3','span1','span1','span1','','','','','','','','','');



		if(Auth::user()->role == 'root' || Auth::user()->role == 'super' || Auth::user()->role == 'onsite'){
			return View::make('tables.simple')
				->with('title','Master Data')
				->with('newbutton','New Visitor')
				->with('disablesort','0,1,9,12')
				->with('addurl','attendee/add')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('attendee'))
				->with('ajaxdel',URL::to('attendee/del'))
				->with('ajaxpay',URL::to('attendee/paystatus'))
				->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('attendee/paystatusgolfconvention'))
				->with('ajaxresendmail',URL::to('attendee/resendmail'))
				->with('printsource',URL::to('attendee/printbadge'))
				->with('form',$form)
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','attendee.rowdetail');
		}else{
			return View::make('attendee.restricted')
							->with('title','Master Data');
		}
	}

	public function get_groups()
	{
		$this->crumb->add('attendee','Groups');

		//print_r(Auth::user());

		$form = new Formly();

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$action_selection = $form->select('action','',Config::get('kickstart.actionselection'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">'.$action_selection.'</span>';

		$heads = array('#','','Import Date','Email','First Name','Last Name','Company','Country','Total Att.');

		$searchinput = array(false,false,'Import Date','Email','First Name','Last Name','Company','Country',false,false);

		$colclass = array('','span1','span3','span1','span3','span3','span1','span1');


		if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
			return View::make('tables.simple')
				->with('title','Master Data')
				->with('newbutton','New Visitor')
				->with('disablesort','0,1')
				->with('addurl','import')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('attendee/groups'))
				->with('ajaxdel',URL::to('attendee/del'))
				->with('ajaxpay',URL::to('attendee/paystatus'))
				->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('attendee/paystatusgolfconvention'))
				->with('printsource',URL::to('attendee/printbadge'))
				->with('form',$form)
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','attendee.rowdetailgroups');
		}else{
			return View::make('attendee.restricted')
							->with('title',$title);
		}
	}

	public function post_index()
	{


		$fields = array('registrationnumber','createdDate','email','firstname','lastname','company','regtype','country','conventionPaymentStatus','golfPaymentStatus','golfPaymentStatus');

		$rel = array('like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both');

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

		$attendee = new Attendee();

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

		$count_all = $attendee->count();

		if(count($q) > 0){
			$attendees = $attendee->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $attendee->count($q);
		}else{
			$attendees = $attendee->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $attendee->count();
		}

		$aadata = array();

		$form = new Formly();

		$messagelog = new Logmessage();

		$counter = 1 + $pagestart;
		foreach ($attendees as $doc) {

			$extra = $doc;

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

			if(isset($doc['conventionPaymentStatus'])){
				if($doc['conventionPaymentStatus'] == 'unpaid'){
					$paymentStatus = '<span class="fontRed fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}elseif ($doc['conventionPaymentStatus'] == 'pending') {
					$paymentStatus = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}elseif ($doc['conventionPaymentStatus'] == 'cancel') {
					$paymentStatus = '<span class="fontGray fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';

				}else{
					$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['conventionPaymentStatus'].'</span>';
				}
			}else{
				$paymentStatus = '<span class="fontGreen fontBold paymentStatusTable">-</span>';
			}

			if(isset($doc['golfPaymentStatus'])){
				if($doc['golfPaymentStatus'] == 'unpaid' && $doc['golf'] == 'Yes'){
					$paymentStatusGolf = '<span class="fontRed fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golfPaymentStatus'] == 'pending') {
					$paymentStatusGolf = '<span class="fontOrange fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golfPaymentStatus'] == 'cancel') {
					$paymentStatusGolf = '<span class="fontGray fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}elseif ($doc['golf'] == 'No') {
					$paymentStatusGolf = '<span class="fontGray fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}else{
					$paymentStatusGolf = '<span class="fontGreen fontBold paymentStatusTable">'.$doc['golfPaymentStatus'].'</span>';
				}
			}else{
				$paymentStatusGolf = '<span class="fontGreen fontBold paymentStatusTable">-</span>';
			}

			if(isset($doc['golf'])){
				if($doc['golf'] == 'Yes'){
					$rowGolfAction = '<a class="icon-"  ><i>&#xe146;</i><span class="paygolf" id="'.$doc['_id'].'" >Golf Status</span>';
				}else{
					$rowGolfAction = '';
				}
			}else{
				$rowGolfAction = '';
			}

			if(isset($doc['golfPaymentStatus']) && isset($doc['conventionPaymentStatus'])){

				if(($doc['golfPaymentStatus'] == 'pending' && $doc['conventionPaymentStatus'] == 'pending') || ($doc['golfPaymentStatus'] == 'unpaid' && $doc['conventionPaymentStatus'] == 'unpaid')){
					$rowBoothAction = '<a class="icon-"  ><i>&#xe1e9;</i><span class="paygolfconvention" id="'.$doc['_id'].'" >Conv & Golf</span>';
				}else{
					$rowBoothAction = '';
				}
			}else{
				$rowGolfAction = '';
			}

			//find message log

			//$rowResendMessage = '';
			//$messagelogs = $messagelog->find(array('user'=>$doc['_id']),array(),array(),array());
			//if(count($messagelogs)>0){

				$rowResendMessage = '<a class="icon-"  ><i>&#xe165;</i><span class="resendmail" id="'.$doc['_id'].'" >Resend Email</span>';
			//}
			if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
				$aadata[] = array(
					$counter,
					$select,
					(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
					date('Y-m-d', $doc['createdDate']->sec),
					$doc['email'],
					'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
					$doc['lastname'],
					$doc['company'],
					$doc['regtype'],
					$doc['country'],
					$paymentStatus,
					$paymentStatusGolf,
					$rowBoothAction.
					'<a class="icon-"  ><i>&#xe1b0;</i><span class="pay" id="'.$doc['_id'].'" >Convention Status</span>'.
					$rowGolfAction.
					
					'<a class="icon-"  ><i>&#xe14c;</i><span class="pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
					'<a class="icon-"  href="'.URL::to('attendee/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
					
					$rowResendMessage.
					'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>',
					

					'extra'=>$extra
				);
			}else{
				$aadata[] = array(
					$counter,
					$select,
					(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
					date('Y-m-d', $doc['createdDate']->sec),
					$doc['email'],
					'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
					$doc['lastname'],
					$doc['company'],
					$doc['regtype'],
					$doc['country'],
					$paymentStatus,
					$paymentStatusGolf,
					
					
					'<a class="icon-"  ><i>&#xe14c;</i><span class="pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
					'<a class="icon-"  href="'.URL::to('attendee/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>',
					

					'extra'=>$extra
				);
			}
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


	public function post_groups()
	{


		//$fields = array('email','firstname','lastname','company','country',);
		$fields = array('createdDate','email','firstname','lastname','company','country','');

		$rel = array('like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both');

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

		$pic = new Import();
		$attendee = new Attendee();

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

		$count_all = $pic->count();

		if(count($q) > 0){
			$pics = $pic->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $pic->count($q);
		}else{
			$pics = $pic->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $pic->count();
		}

		$aadata = array();

		$form = new Formly();

		$counter = 1 + $pagestart;
		foreach ($pics as $doc) {

			$id = $doc['_id']->__toString();
			$condition  = array('cache_id'=>$id);
			$peoples = $attendee->find($condition, array(), array(),array());
			$extra = $peoples;

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selectorAll'));

			$aadata[] = array(
				$counter,
				$select,
				date('Y-m-d', $doc['createdDate']->sec),
				$doc['email'],
				'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
				$doc['lastname'],
				$doc['company'],
				$doc['country'],
				count($peoples),
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

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('attendee.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('attendee.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		print json_encode($result);
	}

	public function post_paystatus(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatus');
		$displaytax = Input::get('taxdisplaystatus');

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('conventionPaymentStatus'=>$paystatus)))){
				//Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'OK'));
				
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					if($displaytax == 'printtax' ){
						$body = View::make('email.confirmpaymenttax')->with('data',$data)->render();
					}else{
						$body = View::make('email.confirmpayment')->with('data',$data)->render();
					}


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
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
		$displaytax = Input::get('taxdisplaystatus');

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('golfPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'OK'));
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					if($displaytax == 'printtax' ){
						$body = View::make('email.confirmpaymentgolftax')->with('data',$data)->render();
					}else{
						$body = View::make('email.confirmpaymentgolf')->with('data',$data)->render();
					}

					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION (GOLF)- Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		print json_encode($result);
	}


	public function post_paystatusgolfconvention(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatusgolfconvention');
		$displaytax = Input::get('taxdisplaystatus');

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('golfPaymentStatus'=>$paystatus,'conventionPaymentStatus'=>$paystatus)))){
				Event::fire('paymentstatusgolf.update',array('id'=>$id,'result'=>'OK'));
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'OK'));
				
				//mail to registrant about payment updated
				//if only set to paid to send email
				if($paystatus == 'paid'){
					$data = $user->get(array('_id'=>$_id));

					if($displaytax == 'printtax' ){
						$body = View::make('email.confirmpaymentalltax')->with('data',$data)->render();
					}else{
						$body = View::make('email.confirmpaymentall')->with('data',$data)->render();
					}


					Message::to($data['email'])
					    ->from(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->cc(Config::get('eventreg.reg_admin_email'), Config::get('eventreg.reg_admin_name'))
					    ->subject('CONFIRMATION OF REGISTRATION - Indonesia Petroleum Association – 37th Convention & Exhibition (Registration – '.$data['registrationnumber'].')')
					    ->body( $body )
					    ->html(true)
					    ->send();
				}
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('paymentstatusgolfconvention.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		print json_encode($result);
	}


	public function post_paystatusconvonsite(){
		$id = Input::get('userid');
		$paystatus = Input::get('new_value');
		$displaytax = Input::get('foo');

		$user = new Attendee();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);


			if($user->update(array('_id'=>$_id),array('$set'=>array('conventionPaymentStatus'=>$paystatus)))){
				$result = $paystatus;
				
			}else{
				Event::fire('paymentstatusgolfconvention.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		print json_encode($result);
	}

	public function post_resendmail(){
		$id = Input::get('id');
		$mailtype = Input::get('type');

		$user = new Attendee();
		$log = new Logmessage();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$_id = new MongoId($id);

			//find user first
			$data = $user->get(array('_id'=>$_id));
			$logs = $log->get(array('user'=>$_id));
			if($logs!=null){
				if($mailtype == 'email.regsuccess'){
					$body = View::make($mailtype)
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
					    ->send();
					$result = array('status'=>'OK','data'=>'CONTENTDELETED','message'=>'Successfully resend email');
				}
			}else{
				$result = array('status'=>'NOTFOUND','data'=>'CONTENTDELETED','message'=>'Not Found Email to resend');
			}
		}

		print json_encode($result);
	}

	



	public function get_add($type = null){

		if(is_null($type)){
			$this->crumb->add('attendee/add','New Attendee');
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('attendee/type/'.$type,'Attendee');

			$this->crumb->add('attendee/type/'.$type,depttitle($type));
			$this->crumb->add('attendee/add','New Attendee');
		}

		$attendee = new Attendee();
		$golfcount = $attendee->count(array('golf'=>'Yes'));

		$form = new Formly();
		return View::make('attendee.new')
					->with('form',$form)
					->with('golfcount',$golfcount)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Attendee');

	}


	public function post_add(){

		//print_r(Session::get('permission'));
		$data = Input::get();

		if(isset($data['registonsite'])){

		    $rules = array(
		    	'firstname' => 'required',
		    	'lastname' => 'required',
		    	'email' => 'required|email|unique:attendee',
		        'company' => 'required',
		    );
		}else{

			$rules = array(
		    	'firstname' => 'required',
		    	'lastname' => 'required',
		    	'position' => 'required',
		        'email' => 'required|email|unique:attendee',

		        'company' => 'required',
		        'companyphone' => 'required',
		        'address_1' => 'required',
		        'city' => 'required',
		        'zip' => 'required',
		        'country' => 'required',
		        'companyInvoice' => 'required',
		        'companyphoneInvoice' => 'required',
		        'addressInvoice_1' => 'required',
		        'cityInvoice' => 'required',
		        'zipInvoice' => 'required',
		        'countryInvoice' => 'required'
		    );

		}


	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('attendee/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			//$data = Input::get();

			$passwordRandom = rand_string(8);

			$data['pass'] = Hash::make($passwordRandom);

			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$data['role'] = 'attendee';
			$data['paymentStatus'] = 'unpaid';

			//set number types into string 

			foreach($data as $key=>$val){
				if((is_integer($val) || is_float($val) || is_long($val) || is_double($val)) && ( $key != 'golfSequence')){
					$data[$key] = strval($data[$key]);
				}
			}


			if($data['foc'] == 'Yes'){
				$data['conventionPaymentStatus'] = 'free';
				$data['golfPaymentStatus'] = 'free';

			}else{
				$data['conventionPaymentStatus'] = 'unpaid';


			}
			if($data['golf'] == 'Yes' && $data['foc'] == 'No'){
				$data['golfPaymentStatus'] = 'unpaid';
			}elseif ($data['golf'] == 'Yes' && $data['foc'] == 'Yes'){
				$data['golfPaymentStatus'] = 'free';

			}else{
				$data['golfPaymentStatus'] = '-';
			}

			unset($data['foc']);

			$reg_number[0] = 'C';
			$reg_number[1] = $data['regtype'];
			$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'attendee'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$regsequence = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			//$reg_number[] = $regsequence;

			$data['regsequence'] = $regsequence;

			$data['registrationnumber'] = implode('-',$reg_number);

			$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
			}

			//normalize
			$data['confirmation'] = 'none';
			$data['address'] = '';
			$data['cache_id'] = '';
			$data['cache_obj'] = '';
			$data['companys_npwp'] = '';
			$data['groupId'] = '';
			$data['groupName'] = '';
			$data['invoice_address_conv'] = '';
			$data['addressInvoice'] = '';

			//check date first
			$dateA = date('Y-m-d G:i'); 
			
			$earlybirddate = Config::get('eventreg.earlybirdconventiondate'); 
			$conventionrate = Config::get('eventreg.conventionrate');
			$golfrate = Config::get('eventreg.golffee');

			if(strtotime($dateA) > strtotime($earlybirddate)){ 
				//normal rate valid
				if($data['overrideratenormal'] == 'no'){
					if($data['regtype'] == 'PD' && $data['golf'] == 'No'){
						$data['totalIDR'] = $conventionrate['PD-normal'];
						$data['totalUSD'] = '';
						$data['regPD'] = $conventionrate['PD-normal'];
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PD' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $conventionrate['PD-normal']+$golfrate;
						$data['totalUSD'] = '';
						$data['regPD'] = $conventionrate['PD-normal'];
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'No'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['PO-normal'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-normal'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $golfrate;
						$data['totalUSD'] = $conventionrate['PO-normal'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-normal'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SD'){
						$data['totalIDR'] = $conventionrate['SD'];
						$data['totalUSD'] = '';
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = $conventionrate['SD'];
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SO'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['SO'];
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = $conventionrate['SO'];;

					}
				}else{

					//back using early bird rate
					if($data['regtype'] == 'PD' && $data['golf'] == 'No'){
					$data['totalIDR'] = $conventionrate['PD-earlybird'];
					$data['totalUSD'] = '';
					$data['regPD'] = $conventionrate['PD-earlybird'];
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PD' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $conventionrate['PD-earlybird']+$golfrate;
						$data['totalUSD'] = '';
						$data['regPD'] = $conventionrate['PD-earlybird'];
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'No'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['PD-earlybird'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-earlybird'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $golfrate;
						$data['totalUSD'] = $conventionrate['PD-earlybird'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-earlybird'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SD'){
						$data['totalIDR'] = $conventionrate['SD'];
						$data['totalUSD'] = '';
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = $conventionrate['SD'];
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SO'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['SO'];
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = $conventionrate['SO'];;

					}
				}
			}else{

				if($data['regtype'] == 'PD' && $data['golf'] == 'No'){
					$data['totalIDR'] = $conventionrate['PD-earlybird'];
					$data['totalUSD'] = '';
					$data['regPD'] = $conventionrate['PD-earlybird'];
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'PD' && $data['golf'] == 'Yes'){
					$data['totalIDR'] = $conventionrate['PD-earlybird']+$golfrate;
					$data['totalUSD'] = '';
					$data['regPD'] = $conventionrate['PD-earlybird'];
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'No'){
					$data['totalIDR'] = '';
					$data['totalUSD'] = $conventionrate['PD-earlybird'];
					$data['regPD'] = '';
					$data['regPO'] = $conventionrate['PO-earlybird'];
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'Yes'){
					$data['totalIDR'] = $golfrate;
					$data['totalUSD'] = $conventionrate['PD-earlybird'];
					$data['regPD'] = '';
					$data['regPO'] = $conventionrate['PO-earlybird'];
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'SD'){
					$data['totalIDR'] = $conventionrate['SD'];
					$data['totalUSD'] = '';
					$data['regPD'] = '';
					$data['regPO'] = '';
					$data['regSD'] = $conventionrate['SD'];
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'SO'){
					$data['totalIDR'] = '';
					$data['totalUSD'] = $conventionrate['SO'];
					$data['regPD'] = '';
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = $conventionrate['SO'];;

				}
			}


			$user = new Attendee();

			if($obj = $user->insert($data)){

				Event::fire('attendee.createformadmin',array($obj['_id'],$passwordRandom,$obj['conventionPaymentStatus']));
				
				if(Auth::user()->role == 'onsite'){
					$_id = $obj['_id']->__toString();
					return Redirect::to('attendee/printbadgeonsitedoprint/'.$_id)->with('notify_success',Config::get('site.register_success'));
				}else{
					return Redirect::to('attendee')->with('notify_success',Config::get('site.register_success'));
				}

		    	
			}else{
		    	return Redirect::to('attendee')->with('notify_success',Config::get('site.register_failed'));
			}

	    }


	}


	public function get_edit($id){

		$this->crumb->add('attendee/edit','Edit',false);

		$user = new Attendee();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);

		$this->crumb->add('attendee/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('attendee.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Attendee');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('attendee/edit')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();

			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			//check date first
			$dateA = date('Y-m-d G:i'); 
			
			$earlybirddate = Config::get('eventreg.earlybirdconventiondate'); 
			$conventionrate = Config::get('eventreg.conventionrate');
			$golfrate = Config::get('eventreg.golffee');

			if(strtotime($dateA) > strtotime($earlybirddate)){ 
				//normal rate valid

				if(isset($data['overrideratenormal']) && $data['overrideratenormal'] == 'no'){
					if($data['regtype'] == 'PD' && $data['golf'] == 'No'){
						$data['totalIDR'] = $conventionrate['PD-normal'];
						$data['totalUSD'] = '';
						$data['regPD'] = $conventionrate['PD-normal'];
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PD' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $conventionrate['PD-normal']+$golfrate;
						$data['totalUSD'] = '';
						$data['regPD'] = $conventionrate['PD-normal'];
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'No'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['PO-normal'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-normal'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $golfrate;
						$data['totalUSD'] = $conventionrate['PO-normal'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-normal'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SD'){
						$data['totalIDR'] = $conventionrate['SD'];
						$data['totalUSD'] = '';
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = $conventionrate['SD'];
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SO'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['SO'];
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = $conventionrate['SO'];;

					}
				}else{

					
					if($data['regtype'] == 'PD' && $data['golf'] == 'No'){
					$data['totalIDR'] = $conventionrate['PD-earlybird'];
					$data['totalUSD'] = '';
					$data['regPD'] = $conventionrate['PD-earlybird'];
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PD' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $conventionrate['PD-earlybird']+$golfrate;
						$data['totalUSD'] = '';
						$data['regPD'] = $conventionrate['PD-earlybird'];
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'No'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['PD-earlybird'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-earlybird'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'Yes'){
						$data['totalIDR'] = $golfrate;
						$data['totalUSD'] = $conventionrate['PD-earlybird'];
						$data['regPD'] = '';
						$data['regPO'] = $conventionrate['PO-earlybird'];
						$data['regSD'] = '';
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SD'){
						$data['totalIDR'] = $conventionrate['SD'];
						$data['totalUSD'] = '';
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = $conventionrate['SD'];
						$data['regSO'] = '';

					}elseif ($data['regtype'] == 'SO'){
						$data['totalIDR'] = '';
						$data['totalUSD'] = $conventionrate['SO'];
						$data['regPD'] = '';
						$data['regPO'] = '';
						$data['regSD'] = '';
						$data['regSO'] = $conventionrate['SO'];;

					}

				}
			}else{

				if($data['regtype'] == 'PD' && $data['golf'] == 'No'){
					$data['totalIDR'] = $conventionrate['PD-earlybird'];
					$data['totalUSD'] = '';
					$data['regPD'] = $conventionrate['PD-earlybird'];
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'PD' && $data['golf'] == 'Yes'){
					$data['totalIDR'] = $conventionrate['PD-earlybird']+$golfrate;
					$data['totalUSD'] = '';
					$data['regPD'] = $conventionrate['PD-earlybird'];
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'No'){
					$data['totalIDR'] = '';
					$data['totalUSD'] = $conventionrate['PD-earlybird'];
					$data['regPD'] = '';
					$data['regPO'] = $conventionrate['PO-earlybird'];
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'PO' && $data['golf'] == 'Yes'){
					$data['totalIDR'] = $golfrate;
					$data['totalUSD'] = $conventionrate['PD-earlybird'];
					$data['regPD'] = '';
					$data['regPO'] = $conventionrate['PO-earlybird'];
					$data['regSD'] = '';
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'SD'){
					$data['totalIDR'] = $conventionrate['SD'];
					$data['totalUSD'] = '';
					$data['regPD'] = '';
					$data['regPO'] = '';
					$data['regSD'] = $conventionrate['SD'];
					$data['regSO'] = '';

				}elseif ($data['regtype'] == 'SO'){
					$data['totalIDR'] = '';
					$data['totalUSD'] = $conventionrate['SO'];
					$data['regPD'] = '';
					$data['regPO'] = '';
					$data['regSD'] = '';
					$data['regSO'] = $conventionrate['SO'];;

				}
			}

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

				$regsequence = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

				$reg_number[3] = $regsequence;

				$data['regsequence'] = $regsequence;

			}

			//golf sequencer
			$data['golfSequence'] = 0;

			if($data['golf'] == 'Yes'){
				$seq = new Sequence();
				$gseq = $seq->find_and_modify(array('_id'=>'golf'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true,'upsert'=>true));
				$data['golfSequence'] = $gseq['seq'];
				$data['golfPaymentStatus'] = 'unpaid';
			}

			if($data['golf'] == 'No'){
				$data['golfPaymentStatus'] = '-';
			}
			$data['registrationnumber'] = implode('-',$reg_number);

			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('attendee')->with('notify_success','Attendee saved successfully');
			}else{
		    	return Redirect::to('attendee')->with('notify_success','Attendee saving failed');
			}

	    }


	}

	public function get_printbadge($id){
		$id = new MongoId($id);

		$attendee = new Attendee();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.attendeebadge')->with('profile',$doc);
	}

	public function get_printbadgeonsite($id){
		$id = new MongoId($id);

		$attendee = new Attendee();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.attendeebadgeonsite')
		->with('ajaxpaymentupdateonsite',URL::to('attendee/edit'))
		->with('profile',$doc);
	}

	public function get_printbadgeonsitedoprint($id){
		$id = new MongoId($id);

		$attendee = new Attendee();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.attendeebadgeonsitedoprint')
		->with('ajaxpaymentupdateonsite',URL::to('attendee/edit'))
		->with('profile',$doc);
	}

	public function get_printreceipt($id){
		$id = new MongoId($id);

		$attendee = new Attendee();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.attendeereceipt')
		->with('data',$doc);
	}

	public function get_view($id){
		$id = new MongoId($id);

		$attendee = new Document();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}


	public function get_fileview($id){
		$_id = new MongoId($id);

		$attendee = new Document();

		$doc = $attendee->get(array('_id'=>$_id));

		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];

		return View::make('pop.fileview')->with('doc',$doc)->with('href',$file);
	}

	public function get_approve($id){
		$id = new MongoId($id);

		$attendee = new Document();

		$doc = $attendee->get(array('_id'=>$id));

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

	public function get_normalTotal(){
		$attendee = new Attendee();

		$attendees = $attendee->find();
		foreach($attendees as $att){
			$_id = $att['_id'];
			if($att["totalIDR"]=='-'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>'')));
			}
			if($att["totalUSD"]=='-'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>'')));
			}
			if($att["totalIDR"]=='4.500.000'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>'4500000')));
			}
			if($att["totalUSD"]=='4.500.000'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>'')));
			}


		}

	}

	//
	public function get_normalizeEarlybird(){
		$attendee = new Attendee();

		$attendees = $attendee->find();
		$changecount = 0;

		foreach($attendees as $att){
			$_id = $att['_id'];
			$type = $att['regtype'];


			if(!isset($att['regPD']) && $type == 'PD'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPD'=>4500000)));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPO'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSD'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSO'=>'')));
				$changecount ++;
			}
			else if(!isset($att['regPO']) && $type == 'PO'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPO'=>500)));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPD'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSD'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSO'=>'')));
				$changecount ++;
			}
			else if(!isset($att['regSD']) && $type == 'SD'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSD'=>400000)));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPO'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPD'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSO'=>'')));
				$changecount ++;	
			}
			else if(!isset($att['regSO']) && $type == 'SO'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSO'=>120)));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPO'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regSD'=>'')));
				$attendee->update(array('_id'=>$_id),array('$set'=>array('regPD'=>'')));	
				$changecount ++;
			}

		}

		return View::make('attendee.normalizeearly')
				->with('changecount',$changecount)
				->with('title','Normalize Early');

	}

	public function get_addTotalpayment(){

		$attendee = new Attendee();

		$attendees = $attendee->find();
		$changecount = 0;

		foreach($attendees as $att){
			$_id = $att['_id'];
			$type = $att['regtype'];
			$golf = $att['golf'];
			$payment = $att['conventionPaymentStatus'];
			$changecount = 0;



			if(!isset($att['totalIDR'])){
				if($payment!='free'){
					$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>'')));
					$changecount++;
				}
			}

			if(!isset($att['totalUSD'])){
				if($payment!='free'){
					$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>'')));
					$changecount++;
				}
			}
			

		}

		return View::make('attendee.normalizeearly')
				->with('changecount',$changecount)
				->with('title','Normalize Early');
	}

	public function get_removeTotalFree(){

		$attendee = new Attendee();

		$attendees = $attendee->find();
		$changecount = 0;

		foreach($attendees as $att){
			$_id = $att['_id'];
			$type = $att['regtype'];
			$payment = $att['conventionPaymentStatus'];
			$changecount = 0;

			if($payment=='free'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>'-','totalIDR'=>'-')));
				
			}
			$changecount++;

		}

		return View::make('attendee.normalizeearly')
				->with('changecount',$changecount)
				->with('title','Normalize Early');
	}


	public function get_normalrate(){

		$attendee = new Attendee();

		$attendees = $attendee->find();
		$changecount = 0;

		foreach($attendees as $att){
			$_id = $att['_id'];
			$type = $att['regtype'];
			$payment = $att['conventionPaymentStatus'];
			$changecount = 0;
			$golf = $att['golf'];
			$totalidr = $att['totalIDR'];
			$totalusd = $att['totalIDR'];

			if($totalidr=='400'){
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>400000)));
				$changecount++;
				
			}elseif ($totalidr=='4.500.000') {
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>4500000)));
				$changecount++;
			
			}elseif ($totalidr=='7.000.000') {
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>7000000)));
				$changecount++;
			}elseif ($totalidr =='' && $type == 'PD') {
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>4500000)));
				$changecount++;
			}elseif ($totalusd =='' && $type == 'PO') {
				$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>500)));
				$changecount++;
			}
			

		}

		return View::make('attendee.normalizeearly')
				->with('changecount',$changecount)
				->with('title','Normalize Early');
	}


	public function get_normalizeTotalpayment(){

		$attendee = new Attendee();

		$attendees = $attendee->find();
		$changecount = 0;

		foreach($attendees as $att){
			$_id = $att['_id'];
			$type = $att['regtype'];
			$golf = $att['golf'];
			$payment = $att['conventionPaymentStatus'];
			$changecount = 0;



			if($att['totalIDR']=='' && $payment!='free' && ($type!='PO' || $type!='SO') ){
				if($payment!='free'){
					if($type = 'PD' && $golf='No'){
						$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>4500000)));
						$changecount  ++;
					}elseif ($type = 'PD' && $golf='Yes') {
						$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>7000000)));
						$changecount  ++;
					}elseif ($type = 'SD' ) {
						$attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>400000)));
						$changecount  ++;
					}else{

					}
				}
			}

			if($att['totalUSD']='' && $payment!='free' && ($type!='PD' || $type!='SD')){
				if($payment!='free'){
					if($type = 'PO' && $golf='No'){
						$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>500)));
						$changecount  ++;
					}elseif ($type = 'PO' && $golf='Yes') {
						$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>500,'totalIDR'=>2500000)));
						$changecount  ++;
					}elseif ($type = 'SO' ) {
						$attendee->update(array('_id'=>$_id),array('$set'=>array('totalUSD'=>120)));
						$changecount  ++;
					}else{

					}
				}
			}
			

		}

		return View::make('attendee.normalizeearly')
				->with('changecount',$changecount)
				->with('title','Normalize Early');
	}

	public function get_addSequencetoCollection(){
		$attendee = new Attendee();
		$countSeq = 0;
		$attendees = $attendee->find();
		foreach($attendees as $att){
			$_id = $att['_id'];
			$reg_number = explode('-',$att['registrationnumber']);
			$reg_seq = $reg_number[3];
			$attendee->update(array('_id'=>$_id),array('$set'=>array('regsequence'=>$reg_seq)));
			$countSeq ++;
		}
		return View::make('attendee.updateField')
				->with('countSeq',$countSeq)
				->with('title','Update Field');

	}

	public function get_updateField(){
		$attendee = new Attendee();

		$attendees = $attendee->find();
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

		foreach($attendees as $att){

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

				if($attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$updateCount++;
				}

			}

			if(!isset($att['cache_id'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('cache_id'=>'')))){
					$caheIDCount++;
				}
			}

			if(!isset($att['cache_obj'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('cache_obj'=>'')))){
					$caheOBJCount++;
				}

			}

			if(!isset($att['companys_npwp'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('companys_npwp'=>'')))){
					$companyNPWPCount++;
				}

			}

			if(!isset($att['groupId'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('groupId'=>'')))){
					$groupIDCount++;
				}

			}
			if(!isset($att['groupName'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('groupName'=>'')))){
					$groupNameCount++;
				}

			}

			if(!isset($att['inv_letter'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('inv_letter'=>'')))){
					$invLetterCount++;
				}

			}

			if(!isset($att['invoice_address_conv'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('invoice_address_conv'=>'')))){
					$invCompanyAddCount++;
				}

			}
			if(!isset($att['paymentStatus'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('paymentStatus'=>'')))){
					$paymentStatCount++;
				}

			}


			if(!isset($att['address'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('address'=>'')))){
					$AddCount++;
				}

			}

			if(!isset($att['addressInvoice'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('addressInvoice'=>'')))){
					$AddCountInvoice++;
				}

			}

			if(!isset($att['confirmation'])){
				$_id = $att['_id'];
				if($attendee->update(array('_id'=>$_id),array('$set'=>array('confirmation'=>'none')))){
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

				if($attendee->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$normalRate++;
				}

			}




		}

		return View::make('attendee.updateField')
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

	public function get_action_sample(){
		\Laravel\CLI\Command::run(array('notify'));
	}

}