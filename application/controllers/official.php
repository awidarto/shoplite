<?php

class Official_Controller extends Base_Controller {

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
		$this->crumb->add('official','Officials');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{
		//$this->crumb->add('official','Master Data');

		//print_r(Auth::user());

		$heads = array('#','Reg Number','First Name','Last Name','Email','Company','Role','Mobile','Created','Last Update','Action');

		$searchinput = array(false,'Reg Number','First Name','Last Name','Email','Company','Position','Role','Mobile','Created','Last Update',false);

		$colclass = array('','span1','span1','span1','span3','span3','span1','span1','span1','span1','');

		$searchinput = false; // no searchinput form on footer

		if(Auth::user()->role == 'root' || Auth::user()->role == 'super' || Auth::user()->role == 'onsite' || Auth::user()->role == 'exhibitionadmin'){
			return View::make('tables.simple')
				->with('title','Officials')
				->with('newbutton','New Official')
				->with('disablesort','0,5,6')
				->with('addurl','official/add')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('official'))
				->with('ajaxdel',URL::to('official/del'))
				->with('ajaxpay',URL::to('official/paystatus'))
				->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('attendee/paystatusgolf'))
				->with('printsource',URL::to('official/printbadge'))
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','official.rowdetail');
		}else{
			return View::make('official.restricted')
							->with('title','Officials');			
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

		$official = new Official();

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

		$count_all = $official->count();

		if(count($q) > 0){
			$officials = $official->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $official->count($q);
		}else{
			$officials = $official->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $official->count();
		}

		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($officials as $doc) {

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
				'<a class="action icon-"  href="'.URL::to('official/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
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

		$user = new Official();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('official.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('official.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function get_add($type = null){

		$this->crumb->add('official/add','New Official');

		$form = new Formly();
		return View::make('official.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Official');

	}


	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'firstname'  => 'required|max:150',
	        'email' => 'required|email'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('official/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			$data['paymentStatus'] = 'unpaid';

			$reg_number[0] = 'A';
			$reg_number[1] = $data['role'];
			$reg_number[2] = '00';

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'officials'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$reg_number[] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			$data['registrationnumber'] = implode('-',$reg_number);

			$user = new Official();



			if($obj = $user->insert($data)){

				if(Auth::user()->role == 'onsite'){
					$_id = $obj['_id']->__toString();
					return Redirect::to('official/printbadgeonsitedoprint/'.$_id)->with('notify_success',Config::get('site.register_success'));
				}else{
					return Redirect::to('official')->with('notify_success',Config::get('site.register_success'));
				}

			}else{
		    	return Redirect::to('official')->with('notify_success',Config::get('site.register_failed'));
			}

	    }

		
	}


	public function get_edit($id){

		$this->crumb->add('official/edit','Edit',false);

		$user = new Official();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);

		$this->crumb->add('official/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('official.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Official');

	}


	public function post_edit($id){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('official/edit/'.$id)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new Official();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);			

				$reg_number[0] = 'O';
				$reg_number[1] = $data['role'];
				$reg_number[2] = '00';


			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'officials'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

				$reg_number[0] = 'O';
				$reg_number[1] = $data['role'];
				$reg_number[2] = '00';

				$reg_number[3] = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);
			}


			$data['registrationnumber'] = implode('-',$reg_number);
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('official')->with('notify_success','Official saved successfully');
			}else{
		    	return Redirect::to('official')->with('notify_success','Official saving failed');
			}
			
	    }

		
	}



	public function get_type($type = null)
	{
		$this->crumb = new Breadcrumb();
		$this->crumb->add('official/type/'.$type,'Document');
		$this->crumb->add('official/type/'.$type,depttitle($type));

		$heads = array('#','Title','Created','Last Update','Creator','Access','Attachment','Tags','Action');
		$searchinput = array(false,'title','created','last update','creator','access','filename','tags',false);

		$dept = Config::get('kickstart.department');

		$title = $dept[$type];

		$doc = new Document();

		//check is shared
		$sharecriteria = new MongoRegex('/'.Auth::user()->email.'/i');
		$shared = $doc->count(array('docDepartment'=>$type,'docShare'=>$sharecriteria));

		//check if creator
		$created = $doc->count(array('docDepartment'=>$type,'creatorId'=>Auth::user()->id));

		$permissions = Auth::user()->permissions;

		$can_open = false;

		if(	Auth::user()->role == 'root' || 
			Auth::user()->role == 'super' || 
			Auth::user()->department == $title || 
			$permissions->{$type}->read == true ||
			$shared > 0 ||
			$created > 0
		){
			$can_open = true;
		}

		if( $can_open == true ){


			if($permissions->{$type}->create == 1 || Auth::user()->department == $type ){
				$addurl = 'official/add/'.$type;
			}else{
				$addurl = '';
			}

			return View::make('tables.simple')
				->with('title',$title)
				->with('newbutton','New Document')
				->with('disablesort','0,5,6')
				->with('addurl',$addurl)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('official/type/'.$type))
				->with('ajaxdel',URL::to('official/del'))
				->with('crumb',$this->crumb)
				->with('heads',$heads);			
		}else{
			return View::make('official.restricted')
				->with('crumb',$this->crumb)
				->with('title',$title);
		}

	}

	public function post_type($type = null)
	{

		$fields = array('title','createdDate','lastUpdate','creatorName','docFilename','docTag');

		$rel = array('like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both');

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
		if(!is_null($type)){
			$q['docDepartment'] = $type;
		}

		$sharecriteria = new MongoRegex('/'.Auth::user()->email.'/i');
		
		if(Auth::user()->department == $type){
			$q['$or'] = array(
				array('access'=>'general'),
				array('docShare'=>$sharecriteria)
			);
		}else{
			$q['docShare'] = $sharecriteria;
		}

		$permissions = Auth::user()->permissions;

		$official = new Document();

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

		$count_all = $official->count();

		if(count($q) > 0){
			$officials = $official->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $official->count($q);
		}else{
			$officials = $official->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $official->count();
		}




		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($officials as $doc) {


			if(isset($doc['tags'])){
				$tags = array();

				foreach($doc['tags'] as $t){
					$tags[] = '<span class="tagitem">'.$t.'</span>';
				}

				$tags = implode('',$tags);

			}else{
				$tags = '';
			}

			$doc['title'] = str_ireplace($hilite, $hilite_replace, $doc['title']);
			$doc['creatorName'] = str_ireplace($hilite, $hilite_replace, $doc['creatorName']);


			if($doc['creatorId'] == Auth::user()->id || $doc['docDepartment'] == Auth::user()->department){
				$edit = '<a href="'.URL::to('official/edit/'.$doc['_id'].'/'.$type).'">'.
						'<i class="foundicon-edit action"></i></a>&nbsp;';
				$del = '<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>';
			}else{
				if($permissions->{$type}->edit == 1){
					$edit = '<a href="'.URL::to('official/edit/'.$doc['_id'].'/'.$type).'">'.
							'<i class="foundicon-edit action"></i></a>&nbsp;';
				}else{
					$edit = '';
				}

				if($permissions->{$type}->delete == 1){
					$del = '<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>';
				}else{
					$del = '';
				}
			}

			$aadata[] = array(
				$counter,
				'<span class="metaview" id="'.$doc['_id'].'">'.$doc['title'].'</span>',
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				isset($doc['lastUpdate'])?date('Y-m-d H:i:s', $doc['lastUpdate']->sec):'',
				$doc['creatorName'],
				isset($doc['access'])?ucfirst($doc['access']):'',
				isset($doc['docFilename'])?'<span class="fileview" id="'.$doc['_id'].'">'.$doc['docFilename'].'</span>':'',
				$tags,
				$edit.$del
				/*
				'<a href="'.URL::to('official/edit/'.$doc['_id'].'/'.$type).'">'.
				'<i class="foundicon-edit action"></i></a>&nbsp;'.
				'<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>'
				*/
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


	public function __get_type($type = null)
	{
		$menutitle = array(
			'opportunity'=>'Opportunity',
			'tender'=>'Tender',
			'commbid'=>'Commercial Bid',
			'proposal'=>'Tech Proposal',
			'techbid'=>'Tech Bid',
			'contract'=>'Contracts',
			'legal'=>'Legal Docs',
			'qc'=>'QA / QC',
			'warehouse'=>'Warehouse'
			);

		$heads = array('#','Title','Created','Creator','Owner','Tags','Action');
		$fields = array('seq','title','created','creator','owner','tags','action');
		$searchinput = array(false,'title','created','creator','owner','tags',false);

		return View::make('tables.simple')
			->with('title',(is_null($type))?'Document - All':'Document - '.$menutitle[$type])
			->with('newbutton','New Document')
			->with('disablesort','0,5,6')
			->with('addurl','official/add')
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('official/type/'.$type))
			->with('ajaxdel',URL::to('official/del'))
			->with('heads',$heads);
	}

	public function __post_type($type = null)
	{
		$fields = array('title','createdDate','creatorName','creatorName','tags');

		$rel = array('like','like','like','like','equ');

		$cond = array('both','both','both','both','equ');

		$idx = 0;
		$q = array();
		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{
				if($rel[$idx] == 'like'){
					if($cond[$idx] == 'both'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/');
					}else if($cond[$idx] == 'before'){
						$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/');						
					}else if($cond[$idx] == 'after'){
						$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/');						
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}

		//print_r($q)

		$official = new Document();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		$fidx = ($fidx > 0)?$fidx - 1:$fidx;
		$sort_col = $fields[$fidx];
		$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;

		$count_all = $official->count();

		if(count($q) > 0){
			$officials = $official->find($q,array(),array($sort_col=>$sort_dir));
			$count_display_all = $official->count($q);
		}else{
			$officials = $official->find(array(),array(),array($sort_col=>$sort_dir));
			$count_display_all = $official->count();
		}




		$aadata = array();

		$counter = 1;
		foreach ($officials as $doc) {
			$aadata[] = array(
				$counter,
				$doc['title'],
				date('Y-m-d h:i:s',$doc['createdDate']),
				$doc['creatorName'],
				$doc['creatorName'],
				implode(',',$doc['tag']),
				'<i class="foundicon-edit action"></i>&nbsp;<i class="foundicon-trash action"></i>'
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

		print json_encode($result);
	}

	public function post_paystatus(){
		$id = Input::get('id');
		$paystatus = Input::get('paystatus');

		$user = new Official();

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

		$attendee = new Official();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.officialbadge')->with('profile',$doc);
	}


	public function get_view($id){
		$id = new MongoId($id);

		$official = new Document();

		$doc = $official->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}

	public function get_printbadgeonsitedoprint($id){
		$id = new MongoId($id);

		$attendee = new Official();

		$doc = $attendee->get(array('_id'=>$id));

		return View::make('print.officialbadgeonsitedoprint')
		->with('profile',$doc);
	}


}