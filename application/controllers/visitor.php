<?php

class Visitor_Controller extends Base_Controller {

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
		$this->crumb->add('visitor','Visitors');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{
		//$this->crumb->add('visitor','Master Data');

		//print_r(Auth::user());

		$heads = array('#','Reg Number','First Name','Last Name','Email','Company','Role','Mobile','Created','Last Update','Action');

		$searchinput = array(false,'Reg Number','First Name','Last Name','Email','Company','Position','Role','Mobile','Created','Last Update',false);

		$colclass = array('','span2','span1','span1','span3','span3','span1','span1','span1','span1','');

		$searchinput = false; // no searchinput form on footer

		if(Auth::user()->role == 'root' || Auth::user()->role == 'super' || Auth::user()->role == 'onsite'|| Auth::user()->role == 'exhibitionadmin'){
			return View::make('tables.simple')
				->with('title','Visitors')
				->with('newbutton','New Visitor')
				->with('disablesort','0,5,6')
				->with('addurl','visitor/add')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('visitor'))
				->with('ajaxdel',URL::to('visitor/del'))
				->with('ajaxpay',URL::to('visitor/paystatus'))
				->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('attendee/paystatusgolf'))
				->with('printsource',URL::to('visitor/printbadge'))
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','visitor.rowdetail');
		}else{
			return View::make('visitor.restricted')
							->with('title','Visitors');			
		}
	}

	public function post_index()
	{


		$fields = array('registrationnumber','firstname','lastname','email','company','role','mobile','createdDate','lastUpdate');

		$rel = array('like','like','like','like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
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

		$visitor = new Visitor();

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

		$count_all = $visitor->count();

		if(count($q) > 0){
			$visitors = $visitor->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $visitor->count($q);
		}else{
			$visitors = $visitor->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $visitor->count();
		}

		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($visitors as $doc) {

			$extra = $doc;

			$aadata[] = array(
				$counter,
				(isset($doc['registrationnumber']))?$doc['registrationnumber']:'',
				'<span class="expander" id="'.$doc['_id'].'">'.$doc['firstname'].'</span>',
				$doc['lastname'],
				$doc['email'],
				$doc['company'],
				$doc['role'],
				$doc['mobile'],
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				isset($doc['lastUpdate'])?date('Y-m-d H:i:s', $doc['lastUpdate']->sec):'',
				'<a class="action icon-"  href="'.URL::to('visitor/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				'<a class="action icon-"  ><i>&#xe14c;</i><span class="action pbadge" id="'.$doc['_id'].'" >Print Badge</span>'.
				'<a class="action icon-"><i>&#xe001;</i><span class="action del" id="'.$doc['_id'].'" >Delete</span>',
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

		$user = new Visitor();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('visitor.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('visitor.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function get_add($type = null){

		$this->crumb->add('visitor/add','New Visitor');

		$form = new Formly();
		return View::make('visitor.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Visitor');

	}


	public function post_add(){
		$data = Input::get();
		//print_r(Session::get('permission'));
		if($data['role'] == 'VIP' || $data['role'] == 'VVIP'){
		    $rules = array(
		        'firstname' => 'required'
		    );
		    
		}else{
			$rules = array(
		        'firstname' => 'required',
		    	
		        'company' => 'required',
		        
		    );
		}

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('visitor/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			
	    	
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$data['paymentStatus'] = 'unpaid';

			$reg_number[0] = 'A';
			$reg_number[1] = $data['role'];
			// /$reg_number[2] = '00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'visitor'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);

			$user = new Visitor();

			if($obj = $user->insert($data)){
				if(Auth::user()->role == 'onsite'){
					$_id = $obj['_id']->__toString();
					return Redirect::to('visitor/printbadgeonsitedoprint/'.$_id)->with('notify_success',Config::get('site.register_success'));
				}else{
					return Redirect::to('visitor')->with('notify_success',Config::get('site.register_success'));
				}
		    	
			}else{
		    	return Redirect::to('visitor')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}



	public function get_edit($id){

		$this->crumb->add('visitor/edit','Edit',false);

		$user = new Visitor();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);

		$this->crumb->add('visitor/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('visitor.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Visitor');

	}


	public function post_edit($id){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('visitor/edit/'.$id)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Visitor();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);			

				$reg_number[0] = 'A';
				$reg_number[1] = $data['role'];
				$reg_number[2] = '00';


			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'visitor'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

				$reg_number[0] = 'A';
				$reg_number[1] = $data['role'];
				$reg_number[2] = '00';

				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}


			$data['registrationnumber'] = implode('-',$reg_number);
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('visitor')->with('notify_success','Attendee saved successfully');
			}else{
		    	return Redirect::to('visitor')->with('notify_success','Attendee saving failed');
			}
			
	    }

		
	}

	public function post_paystatus(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatus');

		$user = new Visitor();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->update(array('_id'=>$id),array('$set'=>array('paymentStatus'=>$paystatus)))){
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('paymentstatus.update',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function get_printbadge($id){
		$id = new MongoId($id);

		$attendee = new Visitor();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.visitorbadge')->with('profile',$doc);
	}

	public function get_view($id){
		$id = new MongoId($id);

		$visitor = new Document();

		$doc = $visitor->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}

	public function get_fileview($id){
		$_id = new MongoId($id);

		$visitor = new Document();

		$doc = $visitor->get(array('_id'=>$_id));

		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];

		return View::make('pop.fileview')->with('doc',$doc)->with('href',$file);
	}

	public function get_approve($id){
		$id = new MongoId($id);

		$visitor = new Document();

		$doc = $visitor->get(array('_id'=>$id));

		$form = new Formly();

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];
		
		return View::make('pop.approval')->with('doc',$doc)->with('form',$form)->with('href',$file);
	}

	public function get_printbadgeonsite($id){
		$id = new MongoId($id);

		$attendee = new Visitor();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.visitorbadgeonsite')
		
		->with('profile',$doc);
	}

	public function get_printbadgeonsitedoprint($id){
		$id = new MongoId($id);

		$attendee = new Visitor();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.visitorbadgeonsitedoprint')
		->with('profile',$doc);
	}

}