<?php

class Activity_Controller extends Base_Controller {

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
	public $controller = 'activity';

	public $crumb;

	public function __construct(){
		$this->crumb = new Breadcrumb();

		$this->filter('before','auth');
	}

	public function get_index()
	{
		$heads = array('#','Project','Tags','Action');
		$colclass = array('one','','two','one');
		//$searchinput = array(false,'title','created','last update','creator','project manager','tags',false);
		$searchinput = array(false,'project','tags',false);

		return View::make('tables.simple')
			->with('title','Project')
			->with('newbutton','New Project')
			->with('disablesort','0,3')
			->with('addurl','project/add')
			->with('colclass',$colclass)
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('project'))
			->with('ajaxdel',URL::to('project/del'))
	        ->with('crumb',$this->crumb)
			->with('heads',$heads);
	}

	public function post_index(){


		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		$document = new Activity();

		$count_all = $document->count();

		$sort_col = 'timestamp';
		$sort_dir = -1;

		//print_r(Auth::user());

		$self_id = new MongoId(Auth::user()->id);

		$q = array('$or'=>array(
			array('user_id'=>$self_id),
			array('updater_id'=>$self_id),
			array('requester_id'=>$self_id),
			array('department'=>Auth::user()->department),
			array('shareto'=>Auth::user()->email),
			array('approvalby'=>Auth::user()->email),
			));

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}

		$aadata = array();

		//print_r($documents);

		foreach ($documents as $doc) {

			$eventtitle = Config::get('kickstart.eventtitle');

			$doc['title'] = $eventtitle[$doc['event']];

			$item = View::make('activity.item')->with('doc',$doc)->with('popsrc','project/view')->render();

			$item = str_replace($hilite, $hilite_replace, $item);

			$aadata[] = array(
				$item,
				'<a href="'.URL::to('project/view/'.$doc['_id']).'"><i class="foundicon-clock action"></i></a>&nbsp;'.
				'<a href="'.URL::to('project/edit/'.$doc['_id']).'"><i class="foundicon-edit action"></i></a>&nbsp;'.
				'<i class="foundicon-trash action del" id="'.$doc['_id'].'"></i>'
			);
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

	public function _post_index()
	{
		$fields = array(array('title','body'));

		$rel = array('like','like');

		$cond = array('both','both');

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
					if(is_array($field)){
						$q = array('$or'=>'');
						$sub = array();
						foreach($field as $f){
							if($cond[$idx] == 'both'){
								$sub[] = array($f=> new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i') );
							}else if($cond[$idx] == 'before'){
								$sub[] = array($f=> new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i') );						
							}else if($cond[$idx] == 'after'){
								$sub[] = array($f=> new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i') );						
							}
						}
						$q['$or'] = $sub;
					}else{
						if($cond[$idx] == 'both'){
							$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i');
						}else if($cond[$idx] == 'before'){
							$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i');						
						}else if($cond[$idx] == 'after'){
							$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i');						
						}						
					}
				}else if($rel[$idx] == 'equ'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}
			}
			$idx++;
		}


		$document = new Activity();

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

			$item = View::make('project.item')->with('doc',$doc)->with('popsrc','project/view')->with('tags',$tags)->render();

			$item = str_replace($hilite, $hilite_replace, $item);

			$aadata[] = array(
				$item,
				'<a href="'.URL::to('project/view/'.$doc['_id']).'"><i class="foundicon-clock action"></i></a>&nbsp;'.
				'<a href="'.URL::to('project/edit/'.$doc['_id']).'"><i class="foundicon-edit action"></i></a>&nbsp;'.
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

	public function get_download()
	{
		$heads = array('#','Timestamp','User','Document','Action');
		$searchinput = array(false,'timestamp','user','document',false);

		return View::make('tables.simple')
			->with('title','File Downloads')
			->with('newbutton','New Document')
			->with('disablesort','')
			->with('addurl','')
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to($this->controller.'/download'))
			->with('ajaxdel','')
			->with('heads',$heads);
	}

	public function post_download()
	{
		$fields = array('timestamp');

		$rel = array('like');

		$cond = array('both');

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

		$q['event'] = 'document.download';

		//print_r($q)

		$document = new Activity();

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
				(isset($doc['timestamp']))?date('Y-m-d H:i:s',$doc['timestamp']->sec):'no time record',
				$this->name_of_user($doc['user_id']->__toString()),
				(isset($doc['doc_id']))?$this->title_of_doc($doc['doc_id']->__toString()):'',
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

	public function get_upload()
	{
		$heads = array('#','Timestamp','User','Document','Action');
		$searchinput = array(false,'timestamp','user','document',false);

		return View::make('tables.simple')
			->with('title','File Uploads')
			->with('newbutton','New Document')
			->with('disablesort','')
			->with('addurl','')
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to($this->controller.'/upload'))
			->with('ajaxdel','')
			->with('heads',$heads);
	}

	public function post_upload()
	{
		$fields = array('timestamp');

		$rel = array('like');

		$cond = array('both');

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

		$q['event'] = 'document.upload';

		//print_r($q)

		$document = new Activity();

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
				(isset($doc['timestamp']))?date('Y-m-d H:i:s',$doc['timestamp']->sec):'no time record',
				$this->name_of_user($doc['user_id']->__toString()),
				(isset($doc['doc_id']))?$this->title_of_doc($doc['doc_id']->__toString()):'',
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

	public function get_add()
	{
		return View::make('document.add')
					->with('title','New Document');
	}

	protected function title_of_doc($id){
		$doc = new Document();
		$_id = new MongoId($id);
		$document = $doc->get(array('_id'=>$_id));
		return $document['title'];
	}

	protected function name_of_user($id){
		$usr = new User();
		$_id = new MongoId($id);
		$user = $usr->get(array('_id'=>$_id));
		return $user['fullname'];
	}

}
