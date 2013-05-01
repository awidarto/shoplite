<?php

class Message_Controller extends Base_Controller {

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
		$this->crumb->add('message','Messages');

		$this->filter('before','auth');
	}

	public function get_index()
	{

	    $heads = array('Message','Action');
	    //$searchinput = array(false,'title','created','last update','creator','project manager','tags',false);
	    $searchinput = array(false,'project','tags',false);

	    return View::make('tables.message')
	        ->with('title','Messages')
	        ->with('newbutton','New Message')
			->with('addurl','message/new')
	        ->with('disablesort','0')
	        ->with('crumb',$this->crumb)
	        ->with('searchinput',$searchinput)
	        ->with('ajaxsource',URL::to('message'))
	        ->with('ajaxsourceoutbox',URL::to('message/outbox'));

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

		$document = new Message();

		$count_all = $document->count();

		$sort_col = 'createdDate';
		$sort_dir = -1;

		//print_r(Auth::user());

		$self_id = new MongoId(Auth::user()->id);

		$self_email_regex = new MongoRegex('/'.Auth::user()->email.'/i');

		//$q = array('$or'=>array(
		//	array('to'=>$self_email_regex)
		//	));

		$q = array('to'=>$self_email_regex);

		//$q = array();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}

		$aadata = array();

		foreach ($documents as $doc) {

			$item = View::make('message.item')->with('doc',$doc)->with('popsrc','message/view')->render();

			$item = str_replace($hilite, $hilite_replace, $item);

			$aadata[] = array(
				$item,
				'<a href="'.URL::to('message/view/'.$doc['_id']).'"><i class="foundicon-clock action"></i></a>&nbsp;'.
				'<a href="'.URL::to('message/edit/'.$doc['_id']).'"><i class="foundicon-edit action"></i></a>&nbsp;'.
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


	public function post_outbox(){


		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$search = Input::get('sSearch');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		$document = new Message();

		$count_all = $document->count();

		$sort_col = 'createdDate';
		$sort_dir = -1;

		//print_r(Auth::user());

		$self_id = new MongoId(Auth::user()->id);

		$self_email_regex = new MongoRegex('/'.Auth::user()->email.'/i');

		if($search != ''){
			$search = new MongoRegex('/'.$search.'/i');
			$q['from'] = $self_email_regex;
			$q['$or'] = array(
				array('from'=>$search),
				array('to'=>$search),
				array('subject'=>$search),
				array('body'=>$search)
			);
		}else{
			$q = array('from'=>$self_email_regex);
		}



		//$q = array();

		if(count($q) > 0){
			$documents = $document->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count($q);
		}else{
			$documents = $document->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $document->count();
		}

		$aadata = array();

		foreach ($documents as $doc) {

			$item = View::make('message.item')->with('doc',$doc)->with('popsrc','message/view')->render();

			$item = str_replace($hilite, $hilite_replace, $item);

			$aadata[] = array(
				$item,
				'<a href="'.URL::to('message/view/'.$doc['_id']).'"><i class="foundicon-clock action"></i></a>&nbsp;'.
				'<a href="'.URL::to('message/edit/'.$doc['_id']).'"><i class="foundicon-edit action"></i></a>&nbsp;'.
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


	public function get_new()
	{
		$form = new Formly();

		return View::make('message.new')
			->with('form',$form)
			->with('title','Compose Message');
	}

	public function post_new(){

		$rules = array(
	        'subject'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('message/new')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
	    	//print_r($data);

			//pre save transform
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['creatorName'] = Auth::user()->fullname;
			$data['creatorId'] = Auth::user()->id;

			$data['from'] = Auth::user()->email;
			
			//$docupload = Input::file('docupload');

			$data['recipients'] = explode(',',$data['to']);

			$status = explode(',',$data['to']);

			$data['status'] = array();

			foreach ($status as $st) {
				$data['status'][$st] = 'Delivered';
			}

			$document = new Message();

			$newobj = $document->insert($data);

			if($newobj){

				/*
				if($docupload['name'] != ''){

					$newid = $newobj['_id']->__toString();

					$newdir = realpath(Config::get('kickstart.storage')).'/'.$newid;

					Input::upload('docupload',$newdir,$docupload['name']);
					
				}

				$sharedto = explode(',',$data['docShare']);

				if(count($sharedto) > 0  && $data['docShare'] != ''){
					foreach($sharedto as $to){
						Event::fire('document.share',array('id'=>$newobj['_id'],'sharer_id'=>Auth::user()->id,'shareto'=>$to));
					}
				}
				*/


				Event::fire('message.send',array('id'=>$newobj['_id'],'result'=>'OK','department'=>Auth::user()->department,'creator'=>Auth::user()->id));

		    	return Redirect::to('message')->with('notify_success','Message sent successfully');
			}else{
				Event::fire('message.send',array('id'=>$id,'result'=>'FAILED'));
		    	return Redirect::to('message')->with('notify_success','Message sending failed');
			}

	    }

		
	}	


	public function get_view($id){
		$id = new MongoId($id);

		$document = new Message();

		$doc = $document->get(array('_id'=>$id));

		return View::make('pop.message')->with('doc',$doc);
	}

}