<?php

class Requests_Controller extends Base_Controller {

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
		$this->crumb->add('requests','Requests',false);

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{

		$heads = array('#','Title','Created','Requester','Requesting','Attachment','Tags','Action');
		$searchinput = array(false,'title','created','creator','approval from','filename','tags',false);

		//if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
			return View::make('tables.simple')
				->with('title','Incoming Requests')
				->with('newbutton','New Document')
				->with('disablesort','0,5,6')
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('approval'))
				->with('ajaxdel',URL::to('approval/del'))
				->with('crumb',$this->crumb)
				->with('heads',$heads);
		/*
		}else{
			return View::make('document.restricted')
							->with('title',$title);			
		}
		*/
	}

	public function post_index()
	{

		$fields = array('title','createdDate','creatorName','docApproval','docFilename','docTag');

		$rel = array('like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$self_id = new MongoId(Auth::user()->id);

		$q['$or'] = array(
			array('approvalRequestIds.id'=>$self_id),
			array('docApproval'=> new MongoRegex('/'.Auth::user()->email.'/i'))
		);

		$q = array('approvalRequestIds._id'=>$self_id);

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

		$document = new Document();

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

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}

		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($documents as $doc) {

			if(isset($doc['tags'])){
				$tags = array();

				foreach($doc['tags'] as $t){
					$tags[] = '<span class="tagitem">'.$t.'</span>';
				}

				$tags = implode('',$tags);

			}else{
				$tags = '';
			}

			$requestTo = '<ol>';

			foreach ($doc['approvalRequestIds'] as $r) {
				if($r['_id'] == $self_id){
					//$requestTo .= '<li><span class="approvalview" id="'.$doc['_id'].'">'.$r['fullname'].'</span></li>';
					$requestTo .= '<li><strong>'.$r['fullname'].' (You)</strong></li>';
				}else{
					$requestTo .= '<li>'.$r['fullname'].'</li>';
				}
			}

			$requestTo .= '</ol>';

			if(count($doc['approvalRequestIds']) > 0){
				$request_type = 'Approval';
			}else{
				$request_type = 'General';
			}

			$doc['title'] = str_ireplace($hilite, $hilite_replace, $doc['title']);
			$doc['creatorName'] = str_ireplace($hilite, $hilite_replace, $doc['creatorName']);

			$aadata[] = array(
				$counter,
				'<span class="metaview" id="'.$doc['_id'].'">'.$doc['title'].'</span>',
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				$doc['creatorName'],
				//$requestTo,
				$request_type,
				isset($doc['docFilename'])?'<span class="fileview" id="'.$doc['_id'].'">'.$doc['docFilename'].'</span>':'',
				$tags,
				'<i class="foundicon-checkmark action approvalview" id="'.$doc['_id'].'"></i>&nbsp;'.
				'<i class="foundicon-right-arrow action forwardview" id="'.$doc['_id'].'"></i>'
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

// incoming

	public function get_incoming()
	{

		$this->crumb->add('requests/incoming','Incoming',false);

		$heads = array('#','Title','Created','Requester','Requesting','Attachment','Tags','Action');
		$searchinput = array(false,'title','created','creator','approval from','filename','tags',false);

		//if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
			return View::make('tables.simple')
				->with('title','Incoming Requests')
				->with('newbutton','')
				->with('disablesort','0,5,6')
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('requests/incoming'))
				->with('ajaxdel',URL::to('requests/del'))
				->with('crumb',$this->crumb)
				->with('heads',$heads);
		/*
		}else{
			return View::make('document.restricted')
							->with('title',$title);			
		}
		*/
	}

	public function post_incoming()
	{

		$fields = array('title','createdDate','creatorName','docApproval','docFilename','docTag');

		$rel = array('like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$self_id = new MongoId(Auth::user()->id);

		$q['$or'] = array(
			array('approvalRequestIds.id'=>$self_id),
			array('docApproval'=> new MongoRegex('/'.Auth::user()->email.'/i'))
		);

		$q = array('approvalRequestIds._id'=>$self_id);

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

		$document = new Document();

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

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}

		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($documents as $doc) {

			if(isset($doc['tags'])){
				$tags = array();

				foreach($doc['tags'] as $t){
					$tags[] = '<span class="tagitem">'.$t.'</span>';
				}

				$tags = implode('',$tags);

			}else{
				$tags = '';
			}

			$requestTo = '<ol>';

			foreach ($doc['approvalRequestIds'] as $r) {
				if($r['_id'] == $self_id){
					//$requestTo .= '<li><span class="approvalview" id="'.$doc['_id'].'">'.$r['fullname'].'</span></li>';
					$requestTo .= '<li><strong>'.$r['fullname'].' (You)</strong></li>';
				}else{
					$requestTo .= '<li>'.$r['fullname'].'</li>';
				}
			}

			$requestTo .= '</ol>';

			if(count($doc['approvalRequestIds']) > 0){
				$request_type = 'Approval';
			}else{
				$request_type = 'General';
			}

			$doc['title'] = str_ireplace($hilite, $hilite_replace, $doc['title']);
			$doc['creatorName'] = str_ireplace($hilite, $hilite_replace, $doc['creatorName']);

			$aadata[] = array(
				$counter,
				'<span class="metaview" id="'.$doc['_id'].'">'.$doc['title'].'</span>',
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				$doc['creatorName'],
				//$requestTo,
				$request_type,
				isset($doc['docFilename'])?'<span class="fileview" id="'.$doc['_id'].'">'.$doc['docFilename'].'</span>':'',
				$tags,
				'<i class="foundicon-checkmark action approvalview" id="'.$doc['_id'].'"></i>&nbsp;'.
				'<i class="foundicon-right-arrow action forwardview" id="'.$doc['_id'].'"></i>'
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

//outgoing

	public function get_outgoing()
	{

		$this->crumb->add('requests/outgoing','Outgoing',false);

		$heads = array('#','Title','Created','Requester','Requesting','Attachment','Tags','Action');
		$searchinput = array(false,'title','created','creator','approval from','filename','tags',false);

		//if(Auth::user()->role == 'root' || Auth::user()->role == 'super'){
			return View::make('tables.simple')
				->with('title','Outgoing Requests')
				->with('newbutton','')
				->with('disablesort','0,5,6')
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('requests/outgoing'))
				->with('ajaxdel',URL::to('requests/del'))
				->with('crumb',$this->crumb)
				->with('heads',$heads);
		/*
		}else{
			return View::make('document.restricted')
							->with('title',$title);			
		}
		*/
	}

	public function post_outgoing()
	{

		$fields = array('title','createdDate','creatorName','docApproval','docFilename','docTag');

		$rel = array('like','like','like','like','like','like');

		$cond = array('both','both','both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$self_id = new MongoId(Auth::user()->id);

		$q['$or'] = array(
			array('approvalRequestIds.id'=>$self_id),
			array('docApproval'=> new MongoRegex('/'.Auth::user()->email.'/i'))
		);

		$q = array('approvalRequestIds._id'=>$self_id);

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

		$document = new Document();

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

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}

		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($documents as $doc) {

			if(isset($doc['tags'])){
				$tags = array();

				foreach($doc['tags'] as $t){
					$tags[] = '<span class="tagitem">'.$t.'</span>';
				}

				$tags = implode('',$tags);

			}else{
				$tags = '';
			}

			$requestTo = '<ol>';

			foreach ($doc['approvalRequestIds'] as $r) {
				if($r['_id'] == $self_id){
					//$requestTo .= '<li><span class="approvalview" id="'.$doc['_id'].'">'.$r['fullname'].'</span></li>';
					$requestTo .= '<li><strong>'.$r['fullname'].' (You)</strong></li>';
				}else{
					$requestTo .= '<li>'.$r['fullname'].'</li>';
				}
			}

			$requestTo .= '</ol>';

			if(count($doc['approvalRequestIds']) > 0){
				$request_type = 'Approval';
			}else{
				$request_type = 'General';
			}

			$doc['title'] = str_ireplace($hilite, $hilite_replace, $doc['title']);
			$doc['creatorName'] = str_ireplace($hilite, $hilite_replace, $doc['creatorName']);

			$aadata[] = array(
				$counter,
				'<span class="metaview" id="'.$doc['_id'].'">'.$doc['title'].'</span>',
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				$doc['creatorName'],
				//$requestTo,
				$request_type,
				isset($doc['docFilename'])?'<span class="fileview" id="'.$doc['_id'].'">'.$doc['docFilename'].'</span>':'',
				$tags,
				'<i class="foundicon-checkmark action approvalview" id="'.$doc['_id'].'"></i>&nbsp;'.
				'<i class="foundicon-right-arrow action forwardview" id="'.$doc['_id'].'"></i>'
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

		$user = new Document();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('document.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('document.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}


	public function get_add($type = null){

		if(is_null($type)){
			$this->crumb->add('document/add','New Document');
		}else{
			$this->crumb->add('document/type/'.$type,depttitle($type));
			$this->crumb->add('document/add','New Document');
		}


		$form = new Formly();
		return View::make('document.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Document');

	}

	public function post_add($type = null){

		//print_r(Session::get('permission'));

		if(is_null($type)){
			$back = 'document';
		}else{
			$back = 'document/type/'.$type;
		}

	    $rules = array(
	        'title'  => 'required|max:50'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('document/add/'.$type)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
	    	//print_r($data);

			//pre save transform
			unset($data['csrf_token']);

			$data['effectiveDate'] = new MongoDate(strtotime($data['effectiveDate']." 00:00:00"));
			$data['expiryDate'] = new MongoDate(strtotime($data['expiryDate']." 00:00:00"));

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['creatorName'] = Auth::user()->fullname;
			$data['creatorId'] = Auth::user()->id;
			
			$docupload = Input::file('docupload');

			$data['docFilename'] = $docupload['name'];

			$data['docFiledata'] = $docupload;

			$data['tags'] = explode(',',$data['docTag']);

			$document = new Document();

			$newobj = $document->insert($data);

			if($newobj){


				if($docupload['name'] != ''){

					$newid = $newobj['_id']->__toString();

					$newdir = realpath(Config::get('kickstart.storage')).'/'.$newid;

					Input::upload('docupload',$newdir,$docupload['name']);
					
				}

				if(count($data['tags']) > 0){
					$tag = new Tag();
					foreach($data['tags'] as $t){
						$tag->update(array('tag'=>$t),array('$inc'=>array('count'=>1)),array('upsert'=>true));
					}
				}

				$sharedto = explode(',',$data['docShare']);

				if(count($sharedto) > 0  && $data['docShare'] != ''){
					foreach($sharedto as $to){
						Event::fire('document.share',array('id'=>$newobj['_id'],'sharer_id'=>Auth::user()->id,'shareto'=>$to));
					}
				}

				$approvalby = explode(',',$data['docApproval']);

				if(count($approvalby) > 0 && $data['docApproval'] != ''){
					foreach($approvalby as $to){
						Event::fire('request.approval',array('id'=>$newobj['_id'],'approvalby'=>$to));
					}
				}

				Event::fire('document.create',array('id'=>$newobj['_id'],'result'=>'OK','department'=>Auth::user()->department,'creator'=>Auth::user()->id));

		    	return Redirect::to($back)->with('notify_success','Document saved successfully');
			}else{
				Event::fire('document.create',array('id'=>$id,'result'=>'FAILED'));
		    	return Redirect::to($back)->with('notify_success','Document saving failed');
			}

	    }

		
	}

	public function get_edit($id = null,$type = null){

		if(is_null($type)){
			$this->crumb->add('document/add','Edit Document');
		}else{
			$this->crumb->add('document/type/'.$type,depttitle($type),false);
			$this->crumb->add('document/edit/'.$id,'Edit',false);
		}


		$doc = new Document();

		$id = (is_null($id))?Auth::user()->id:$id;

		$id = new MongoId($id);

		$doc_data = $doc->get(array('_id'=>$id));

		$doc_data['oldTag'] = $doc_data['docTag'];

		$doc_data['effectiveDate'] = date('Y-m-d', $doc_data['effectiveDate']->sec);
		$doc_data['expiryDate'] = date('Y-m-d', $doc_data['expiryDate']->sec);


		if(is_null($type)){
			$this->crumb->add('document/edit/'.$id,$doc_data['title']);
		}else{
			$this->crumb->add('document/edit/'.$id.'/'.$type,$doc_data['title']);
		}

		$form = Formly::make($doc_data);

		return View::make('document.edit')
					->with('doc',$doc_data)
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','Edit Document');

	}


	public function post_edit($id,$type = null){

		//print_r(Session::get('permission'));

		if(is_null($type)){
			$back = 'document';
		}else{
			$back = 'document/type/'.$type;
		}

	    $rules = array(
	        'title'  => 'required|max:50'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('document/edit/'.$id.'/'.$type)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);

			$data['effectiveDate'] = new MongoDate(strtotime($data['effectiveDate']." 00:00:00"));
			$data['expiryDate'] = new MongoDate(strtotime($data['expiryDate']." 00:00:00"));
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$sharelist = explode(',', $data['docShare']);
			if(is_array($sharelist)){
				$usr = new User();
				$shd = array();
				foreach($sharelist as $sh){
					$shd[] = array('email'=>$sh);
				}
				$shared_ids = $usr->find(array('$or'=>$shd),array('id'));

				$data['sharedIds'] = array_values($shared_ids) ;
			}

			$data['tags'] = explode(',',$data['docTag']);

			$doc = new Document();

			//print_r($data);
			$oldtags = explode(',',$data['oldTag']);

			if(count($data['tags']) > 0){
				$tag = new Tag();
				foreach($data['tags'] as $t){
					if(in_array($t, $oldtags)){
						$add = 0;
					}else{
						$add = 1;
					}
					$tag->update(array('tag'=>$t),array('$inc'=>array('count'=>$add)),array('upsert'=>true));
				}
			}

			unset($data['oldTag']);
<<<<<<< HEAD

			// upload new file , additive

			$docupload = Input::file('docupload');

			$withfile = false;

			if($docupload['name'] != ''){

				$docupload['uploadTime'] = new MongoDate();

				$dirname = $docId;

				$dirname = realpath(Config::get('kickstart.storage')).'/'.$dirname;

				$uploadresult = Input::upload('docupload',$dirname,$docupload['name']);

				if($uploadresult){

					$data['docFilename'] = $docupload['name'];

					$data['docFiledata'] = $docupload;

					$withfile = true;

				}

			}

			if($withfile == true){
				$updatequery = array('$set'=>$data,'$push'=>array('docFileList'=>$docupload));
			}else{
				$updatequery = array('$set'=>$data);
			}

			//print_r($data);

			if($doc->update(array('_id'=>$id),$updatequery)){
=======
			
			if($doc->update(array('_id'=>$id),array('$set'=>$data))){
>>>>>>> 5891233d3b31fa74cf95400c4fd4ccfb43d310f7

				Event::fire('document.update',array('id'=>$id,'result'=>'OK'));

				$sharedto = explode(',',$data['docShare']);

				if(count($sharedto) > 0  && $data['docShare'] != ''){
					foreach($sharedto as $to){
						Event::fire('document.share',array('id'=>$id,'sharer_id'=>Auth::user()->id,'shareto'=>$to));
					}
				}

				$approvalby = explode(',',$data['docApproval']);

				if(count($approvalby) > 0 && $data['docApproval'] != ''){
					foreach($approvalby as $to){
						Event::fire('request.approval',array('id'=>$id,'approvalby'=>$to));
					}
				}				

		    	return Redirect::to($back)->with('notify_success','Document saved successfully');
			}else{

				Event::fire('document.update',array('id'=>$id,'result'=>'FAILED'));

		    	return Redirect::to($back)->with('notify_success','Document saving failed');
			}

	    }

		
	}


	public function get_type($type = null)
	{
		$this->crumb->add('document/type/'.$type,depttitle($type));

		$heads = array('#','Title','Created','Last Update','Creator','Attachment','Tags','Action');
		$searchinput = array(false,'title','created','last update','creator','filename','tags',false);

		$dept = Config::get('kickstart.department');

		$title = $dept[$type];

		$doc = new Document();

		$sharecriteria = new MongoRegex('/'.Auth::user()->email.'/i');

		$shared = $doc->count(array('docShare'=>$sharecriteria));

		$permissions = Auth::user()->permissions;

		$can_open = false;

		if(Auth::user()->role == 'root' || 
			Auth::user()->role == 'super' || 
			Auth::user()->department == $title || 
			$permissions->{$type} == true
		){
			return View::make('tables.simple')
				->with('title',$title)
				->with('newbutton','New Document')
				->with('disablesort','0,5,6')
				->with('addurl','document/add/'.$type)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('document/type/'.$type))
				->with('ajaxdel',URL::to('document/del'))
				->with('crumb',$this->crumb)
				->with('heads',$heads);			
		}else{
			return View::make('document.restricted')
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

		$document = new Document();

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

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}




		$aadata = array();

		$counter = 1 + $pagestart;
		foreach ($documents as $doc) {
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

			$aadata[] = array(
				$counter,
				'<span class="metaview" id="'.$doc['_id'].'">'.$doc['title'].'</span>',
				date('Y-m-d H:i:s', $doc['createdDate']->sec),
				isset($doc['lastUpdate'])?date('Y-m-d H:i:s', $doc['lastUpdate']->sec):'',
				$doc['creatorName'],
				isset($doc['docFilename'])?'<span class="fileview" id="'.$doc['_id'].'">'.$doc['docFilename'].'</span>':'',
				$tags,
				'<a href="'.URL::to('document/edit/'.$doc['_id'].'/'.$type).'">'.
				'<i class="foundicon-edit action"></i></a>&nbsp;'.
				'<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>'
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
			->with('addurl','document/add')
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('document/type/'.$type))
			->with('ajaxdel',URL::to('document/del'))
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

		$document = new Document();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		$fidx = ($fidx > 0)?$fidx - 1:$fidx;
		$sort_col = $fields[$fidx];
		$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;

		$count_all = $document->count();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir));
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir));
			$count_display_all = $document->count();
		}




		$aadata = array();

		$counter = 1;
		foreach ($documents as $doc) {
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


	public function get_view($id){
		$id = new MongoId($id);

		$document = new Document();

		$doc = $document->get(array('_id'=>$id));

		return View::make('document.view')->with('doc',$doc);
	}

	public function get_fileview($id){
		$_id = new MongoId($id);

		$document = new Document();

		$doc = $document->get(array('_id'=>$_id));

<<<<<<< HEAD
		//$file = URL::to(Config::get('kickstart.storage').$id.'/'.$doc['docFilename']);

		$file = URL::base().'/storage/'.$id.'/'.$doc['docFilename'];
=======
		$file = URL::to(Config::get('parama.storage').$id.'/'.$doc['docFilename']);
>>>>>>> 5891233d3b31fa74cf95400c4fd4ccfb43d310f7

		return View::make('document.fileview')->with('doc',$doc)->with('href',$file);
	}

}