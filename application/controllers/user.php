<?php

class User_Controller extends Base_Controller {

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
		$this->crumb->add('users','Users');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}	

	public function get_index()
	{
		$user = new User();

		$user_profile = $user->get(array('email'=>Auth::user()->email));

		return View::make('user.profile')->with('profile',$user_profile);
	}

	public function post_index()
	{
		return View::make('user.index');
	}

	public function get_profile($id = null){

		if(is_null($id)){
			$this->crumb = new Breadcrumb();
		}

		$user = new User();

		$id = (is_null($id))?Auth::user()->id:$id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));

		$this->crumb->add('project/profile','Profile',false);
		$this->crumb->add('project/profile',$user_profile['fullname']);

		return View::make('user.profile')
			->with('crumb',$this->crumb)
			->with('profile',$user_profile);
	}

	public function get_popprofile($id = null){

		$user = new User();

		$id = (is_null($id))?Auth::user()->id:$id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));

		return View::make('pop.userprofile')->with('profile',$user_profile);
	}

	public function post_profile(){
		
	}

	public function post_del(){
		$id = Input::get('id');

		$user = new User();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);

			if($user->delete(array('_id'=>$id))){
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');				
			}
		}

		print json_encode($result);
	}

	public function get_users()
	{

		$heads = array('#','','Full Name','Email','Department','Role','Action');
		$searchinput = array(false,false,'fullname','email','department','role',false);
		$colclass = array('','two','','','','','');

		$tag = new Tag();
		$tags = $tag->find(array(), array(),array('count'=>-1));

		return View::make('tables.simple')
			->with('title','User Management')
			->with('newbutton','New User')
			->with('disablesort','0,1,4,5')
			->with('addurl','user/add')
			->with('searchinput',$searchinput)
			->with('tags',$tags)
			->with('colclass',$colclass)
			->with('ajaxsource',URL::to('users'))
			->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
			->with('ajaxpaygolfconvention',URL::to('attendee/paystatusgolfconvention'))
			->with('ajaxdel',URL::to('user/del'))
			->with('crumb',$this->crumb)
			->with('heads',$heads);
	}

	public function post_users()
	{
		$fields = array('fullname','username','email','department','role');

		$rel = array('like','like','like','like');

		$cond = array('both','both','both','both');

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();
		foreach($fields as $field){
			if(Input::get('sSearch_'.$idx))
			{
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

		$document = new User();

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

			/*
			if(file_exists(Config::get('kickstart.avatarstorage').$doc['_id'].'/avatar.jpg')){
				$photo = HTML::image('avatar/'.$doc['_id'].'/avatar.jpg', $doc['fullname'], array('class' => 'avatar-list'));
			}else{
				$photo = HTML::image('images/no-avatar.jpg', $doc['fullname'], array('class' => 'avatar-list'));				
			}
			*/

			$photo = getavatar($doc['_id'],$doc['fullname'],'twelve');

			$aadata[] = array(
				$counter,
				$photo,
				'<span class="pop" rel="user/popprofile" id="'.$doc['_id'].'" >'.$doc['fullname'].'</span>',
				//HTML::link('user/profile/'.$doc['_id'],$doc['fullname']),
				//$doc['username'],
				$doc['email'],
				isset($doc['department'])?depttitle($doc['department']):'',
				roletitle($doc['role']),
				//'<a href="'.URL::to('user/pass/'.$doc['_id']).'"><i class="foundicon-lock action"></i></a>&nbsp;'.
				//'<a href="'.URL::to('user/picture/'.$doc['_id']).'"><i class="foundicon-smiley action"></i></a>&nbsp;'.
				'<a class="icon-"  href="'.URL::to('user/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update User</span>'.
				'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>'
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

	public function get_picture($id = null){

		if(is_null($id)){
			$this->crumb = new Breadcrumb();
			$this->crumb->add('user/profile','Profile');
		}

		$this->crumb->add('user/picture','Change Picture',false);

		$_id = (is_null($id))?Auth::user()->id:$id;

		$_id = new MongoId($_id);

		$emp = new User();

		$employee = $emp->get(array('_id'=>$_id));

		$this->crumb->add('user/picture',$employee['fullname'],false);

		$form = Formly::make();

		return View::make('user.pic')
					->with('form',$form)
					->with('id',$id)
					->with('doc',$employee)
					->with('crumb',$this->crumb)
					->with('title','Change Photo');
	}

	public function post_picture($id = null){

		if(is_null($id)){
			$back = 'user/profile';
		}else{
			$back = 'users';
		}

		//$id = (is_null($id))?Auth::user()->id:$id;
		$id = (is_null($id))?Auth::user()->id:$id;

		$picupload = Input::file('picupload');

		$data = Input::get();

		if($picupload['name'] != ''){

			$newdir = realpath(Config::get('kickstart.avatarstorage')).'/'.$id;

			if(!file_exists($newdir)){
				mkdir($newdir,0777);
			}

			$success = Resizer::open( $picupload )
        		->resize( 200 , 200 , 'crop' )
        		->save( Config::get('kickstart.avatarstorage').$id.'/avatar.jpg' , 90 );

			Input::upload('picupload',$newdir,$picupload['name']);

			
		}

		$user = new User();

		$_id = new MongoId($data['id']);
		$data['lastUpdate'] = new MongoDate();

		unset($data['csrf_token']);
		unset($data['id']);		

		
		if($user->update(array('_id'=>$_id),array('$set'=>$data))){
	    	return Redirect::to($back)->with('notify_success','Picture saved successfully');
		}else{
	    	return Redirect::to($back)->with('notify_success','Picture saving failed');
		}

	}

	public function get_pass($id = null){

		if(is_null($id)){
			$this->crumb = new Breadcrumb();
			$this->crumb->add('user/profile','Profile');
		}

		$this->crumb->add('user/pass','Change Password',false);

		$id = (is_null($id))?Auth::user()->id:$id;

		$doc['_id'] = $id;

		$form = Formly::make();

		$_id = new MongoId($id);

		$user = new User();

		$user_profile = $user->get(array('_id'=>$_id));

		$this->crumb->add('user/picture',$user_profile['fullname'],false);

		return View::make('user.pass')
					->with('form',$form)
					->with('doc',$doc)
					->with('crumb',$this->crumb)
					->with('title','Change Password');

	}

	public function post_pass($id = null){

		//if(is_null($id)){
		//	$back = '/';
		//}else{
			$back = 'users';
		//}

	    $rules = array(
	        'pass' => 'same:repass',
	        'repass'=> 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('user/pass/'.$id)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	

			$data['pass'] = Hash::make($data['pass']);

			unset($data['repass']);
			unset($data['csrf_token']);

			$_id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			$user = new User();

			if($user->update(array('_id'=>$_id),array('$set'=>$data))){
		    	return Redirect::to($back)->with('notify_success','Password changed successfully');
			}else{
		    	return Redirect::to($back)->with('notify_success','Password change failed');
			}
			

	    }		

	}

	public function get_editprofile(){

		$user = new User();

		$id = Auth::user()->id;

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));


		$this->crumb = new Breadcrumb();
		$this->crumb->add('user/profile','Profile');
		$this->crumb->add('user/editprofile','Edit');
		$this->crumb->add('user/profile',$user_profile['fullname']);


		$form = Formly::make($user_profile);

		return View::make('user.editprofile')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Profile');

	}

	public function post_editprofile(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'fullname'  => 'required|max:50'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('user/edit/'.$id)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new User();
			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('users/profile')->with('notify_success','User profile saved successfully');
			}else{
		    	return Redirect::to('users/profile')->with('notify_success','User profile saving failed');
			}
			
	    }

		
	}


	public function get_edit($id = null){

		$this->crumb->add('user/edit','Edit',false);

		$user = new User();

		$id = (is_null($id))?Auth::user()->id:$id;

		$id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$id));

		$this->crumb->add('user/edit',$user_profile['fullname']);

		foreach($user_profile['permissions'] as $key=>$val){
			//$user_profile[$key] = ($val)?1:0;
			if(is_array($val)){
				foreach($val as $k=>$v){
					$user_profile[$key.'_'.$k] = $v;
				}
			}
		}

		//print_r($user_profile);

		$form = Formly::make($user_profile);

		return View::make('user.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit User');

	}


	public function post_edit($id){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'fullname'  => 'required|max:50'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('user/edit/'.$id)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$obj = Config::get('kickstart.department');

			$pitem = Config::get('acl.permissions');

			$permissions = array();

			foreach($obj as $o=>$t){

				/*
				if(isset($data[$o])){
					$permissions[$o] = true;
					unset($data[$o]);
				}else{
					$permissions[$o] = false;
				}
				if(isset($data[$o.'_set'])){
					$permissions[$o]['set'] = $data[$o.'_set'];
					unset($data[$o.'_set']);
				}else{
					$permissions[$o]['set'] = 0;
				}
				*/
				foreach($pitem as $p){
					if(isset($data[$o.'_'.$p])){
						$permissions[$o][$p] = $data[$o.'_'.$p];
						unset($data[$o.'_'.$p]);
					}else{
						$permissions[$o][$p] = 0;
					}
				}
			}

			$data['permissions'] = $permissions;

			$id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			unset($data['csrf_token']);
			unset($data['id']);

			$user = new User();

			//print_r($data);

			
			if($user->update(array('_id'=>$id),array('$set'=>$data))){
		    	return Redirect::to('users')->with('notify_success','User saved successfully');
			}else{
		    	return Redirect::to('users')->with('notify_success','User saving failed');
			}
			
	    }

		
	}



	public function get_add(){

		$this->crumb->add('project/add','Management',false);
		$this->crumb->add('project/add','New User');

		$form = new Formly();
		return View::make('user.new')
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','New User');

	}

	public function post_add(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'fullname'  => 'required|max:50',
	        'email' => 'required|email|unique:user',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('user/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	
			$obj = Config::get('kickstart.department');

			$pitem = Config::get('acl.permissions');

			$permissions = array();

			foreach($obj as $o=>$t){

				if(isset($data[$o])){
					$permissions[$o] = true;
				}else{
					$permissions[$o] = false;
				}

				/*
				if(isset($data[$o.'_set'])){
					$permissions[$o]['set'] = $data[$o.'_set'];
					unset($data[$o.'_set']);
				}else{
					$permissions[$o]['set'] = 0;
				}

				foreach($pitem as $p){
					if(isset($data[$o.'_'.$p])){
						$permissions[$o][$p] = $data[$o.'_'.$p];
						unset($data[$o.'_'.$p]);
					}else{
						$permissions[$o][$p] = 0;
					}
				}
				*/
			}

			$data['pass'] = Hash::make($data['pass']);
			$data['permissions'] = $permissions;

			unset($data['repass']);
			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();
			$data['creatorName'] = Auth::user()->fullname;
			$data['creatorId'] = Auth::user()->id;

			$user = new User();

			if($user->insert($data)){
		    	return Redirect::to('users')->with('notify_success','User saved successfully');
			}else{
		    	return Redirect::to('users')->with('notify_success','User saving failed');
			}
			

	    }

		
	}

	public function get_people()
	{
		$heads = array('#','Full Name','Username','Email','Role','Access','Action');
		$fields = array('seq','fullname','username','email','role','access','action');
		$searchinput = array(false,'fullname','username','email','role','access',false);

		return View::make('tables.simple')
			->with('title','People')
			->with('newbutton','New User')
			->with('disablesort','0,5,6')
			->with('addurl','user/add')
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('user/people'))
			->with('ajaxdel',URL::to('user/del'))
			->with('heads',$heads);
	}

	public function post_people()
	{
		$fields = array('fullname','username','email','role','access');

		$rel = array('like','like','like','equ','equ');

		$cond = array('both','both','both','equ','equ');

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

		$document = new User();

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
				$doc['fullname'],
				$doc['username'],
				$doc['email'],
				implode(',',$doc['role']),
				implode(',',$doc['access']),
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

}