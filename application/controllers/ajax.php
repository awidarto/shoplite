<?php

class Ajax_Controller extends Base_Controller {

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
		$this->filter('before','auth');
	}

	public function get_index()
	{
	}

	public function post_index()
	{
	
	}

	public function get_product()
	{
		$q = Input::get('term');

		$user = new Product();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('name'=>$qemail),array('description'=>$qemail)) ));

		$result = array();

		foreach($res as $r){
			$display = HTML::image(URL::base().'/storage/products/'.$r['_id'].'/sm_pic0'.$r['defaultpic'].'.jpg?'.time(), 'sm_pic01.jpg', array('id' => $r['_id']));
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['name'],'link'=>$r['permalink'],'pic'=>$display,'description'=>$r['description'],'label'=>$r['name']);
		}

		return Response::json($result);		
	}

	public function get_productplain()
	{
		$q = Input::get('term');

		$user = new Product();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('name'=>$qemail),array('description'=>$qemail)) ));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['permalink'],'description'=>$r['description'],'label'=>$r['name']);
		}

		return Response::json($result);		
	}

	public function get_email()
	{
		$q = Input::get('term');

		$user = new User();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('email'=>$qemail),array('fullname'=>$qemail)) ),array('email','fullname'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['email'],'name'=>$r['fullname'],'label'=>$r['fullname'].' ( '.$r['email'].' )');
		}

		return Response::json($result);		
	}

	public function get_user()
	{
		$q = Input::get('term');

		$user = new User();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('email'=>$qemail),array('fullname'=>$qemail)) ),array('email','fullname'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['fullname'],'email'=>$r['email'],'label'=>$r['fullname'].' ( '.$r['email'].' )');
		}

		return Response::json($result);		
	}	

	public function get_group()
	{
		$q = Input::get('term');

		$user = new Group();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('email'=>$qemail),array('firstname'=>$qemail),array('lastname'=>$qemail)) ));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['groupname'],'email'=>$r['email'],'label'=>$r['groupname'].'<br />'.$r['firstname'].''.$r['lastname'].' ( '.$r['email'].' )<br />'.$r['company']);
		}

		return Response::json($result);		
	}

	public function get_hall()
	{
		$q = Input::get('term');

		$hall = new Hall();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $hall->find(array('name'=>$qemail));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['name']);
		}

		return Response::json($result);		
	}



	public function get_booth($id)
	{
		$q = Input::get('term');
		
		$booth = new Booth();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $booth->find(array('boothno'=>$qemail,'hall_id'=>$id));

		$result = array();
		
		
		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['boothno']);
		}
			
		

		

		return Response::json($result);		
	}

	public function get_exhibitor()
	{
		$q = Input::get('term');

		$hall = new Exhibitor();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $hall->find(array('company'=>$qemail));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['company']);
		}

		return Response::json($result);		
	}

	public function get_userdata()
	{
		$q = Input::get('term');

		$user = new User();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('email'=>$qemail),array('fullname'=>$qemail)) ));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['fullname'],'email'=>$r['email'],'label'=>$r['fullname'].' ( '.$r['email'].' )','userdata'=>$r);
		}

		return Response::json($result);		
	}		

	public function get_userdatabyemail()
	{
		$q = Input::get('term');

		$user = new User();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('email'=>$qemail),array('fullname'=>$qemail)) ));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['email'],'email'=>$r['email'],'label'=>$r['fullname'].' ( '.$r['email'].' )','userdata'=>$r);
		}

		return Response::json($result);		
	}		

	public function get_useridbyemail()
	{
		$q = Input::get('term');

		$user = new User();
		$qemail = new MongoRegex('/'.$q.'/i');

		$res = $user->find(array('$or'=>array(array('email'=>$qemail),array('fullname'=>$qemail)) ));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'value'=>$r['_id']->__toString(),'email'=>$r['email'],'label'=>$r['fullname'].' ( '.$r['email'].' )');
		}

		return Response::json($result);		
	}		

	public function get_rev()
	{
		$q = Input::get('term');

		$doc = new Document();
		$qdoc = new MongoRegex('/'.$q.'/i');

		$res = $doc->find(array('title'=>$qdoc),array('title'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['title'],'value'=>$r['_id']->__toString());
		}

		return Response::json($result);		
	}

	public function get_project()
	{
		$q = Input::get('term');

		$proj = new Project();
		$qproj = new MongoRegex('/'.$q.'/i');

		$res = $proj->find(array('$or'=>array(array('title'=>$qproj),array('projectNumber'=>$qproj)) ),array('title','projectNumber'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['projectNumber'].' - '.$r['title'],'title'=>$r['title'],'value'=>$r['projectNumber']);
		}

		return Response::json($result);		
	}

	public function get_projectname()
	{
		$q = Input::get('term');

		$proj = new Project();
		$qproj = new MongoRegex('/'.$q.'/i');

		$res = $proj->find(array('$or'=>array(array('title'=>$qproj),array('projectNumber'=>$qproj)) ),array('title','projectNumber'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['projectNumber'].' - '.$r['title'],'number'=>$r['projectNumber'],'value'=>$r['title']);
		}

		return Response::json($result);		
	}


	public function get_tender()
	{
		$q = Input::get('term');

		$proj = new Tender();
		$qproj = new MongoRegex('/'.$q.'/i');

		$res = $proj->find(array('$or'=>array(array('title'=>$qproj),array('tenderNumber'=>$qproj)) ),array('title','tenderNumber'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['tenderNumber'].' - '.$r['title'],'title'=>$r['title'],'value'=>$r['tenderNumber']);
		}

		return Response::json($result);		
	}

	public function get_tendername()
	{
		$q = Input::get('term');

		$proj = new Tender();
		$qproj = new MongoRegex('/'.$q.'/i');

		$res = $proj->find(array('$or'=>array(array('title'=>$qproj),array('tenderNumber'=>$qproj)) ),array('title','tenderNumber'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['tenderNumber'].' - '.$r['title'],'number'=>$r['tenderNumber'],'value'=>$r['title']);
		}

		return Response::json($result);		
	}

	public function get_opportunity()
	{
		$q = Input::get('term');

		$proj = new Opportunity();
		$qproj = new MongoRegex('/'.$q.'/i');

		$res = $proj->find(array('$or'=>array(array('title'=>$qproj),array('opportunityNumber'=>$qproj)) ),array('title','opportunityNumber'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['opportunityNumber'].' - '.$r['title'],'title'=>$r['title'],'value'=>$r['opportunityNumber']);
		}

		return Response::json($result);		
	}

	public function get_opportunityname()
	{
		$q = Input::get('term');

		$proj = new Opportunity();
		$qproj = new MongoRegex('/'.$q.'/i');

		$res = $proj->find(array('$or'=>array(array('title'=>$qproj),array('opportunityNumber'=>$qproj)) ),array('title','opportunityNumber'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['_id']->__toString(),'label'=>$r['opportunityNumber'].' - '.$r['title'],'number'=>$r['opportunityNumber'],'value'=>$r['title']);
		}

		return Response::json($result);		
	}	

	public function get_tag()
	{
		$q = Input::get('term');

		$tag = new Tag();
		$qtag = new MongoRegex('/'.$q.'/i');

		$res = $tag->find(array('tag'=>$qtag),array('tag'));

		$result = array();

		foreach($res as $r){
			$result[] = array('id'=>$r['tag'],'label'=>$r['tag'],'value'=>$r['tag']);
		}

		return Response::json($result);		
	}

	public function get_meta()
	{
		$q = Input::get('term');

		$doc = new Document();
		$id = new MongoId($q);

		$res = $doc->get(array('_id'=>$id));

		return Response::json($result);		
	}


}