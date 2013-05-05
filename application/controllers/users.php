<?php

class Users_Controller extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->controller_name = str_replace('_Controller', '', get_class());
		
		$this->crumb = new Breadcrumb();
		$this->crumb->add(strtolower($this->controller_name),ucfirst($this->controller_name));

		$this->model = new User();

	}

	public function get_index()
	{

		$heads = array('#','','Full Name','Email','Department','Role','Action');
		$searchinput = array(false,false,'fullname','email','department','role',false);
		$colclass = array('','two','','','','','');

		$this->heads = array(
			array('Full Name',array('search'=>true,'sort'=>true)),
			array('Email',array('search'=>true,'sort'=>true)),
			array('Role',array('search'=>true,'sort'=>true)),
			array('Created',array('search'=>true,'sort'=>true)),
			array('Last Update',array('search'=>true,'sort'=>true)),
		);

		return parent::get_index();

	}

	public function post_index()
	{
		$fields = array('fullname','username','email','department','role');

		$this->fields = array(
			array('fullname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'namePic','attr'=>array('class'=>'expander'))),
			array('email',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('role',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('createdDate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
		);

		return parent::post_index();
	}

	public function post_add($data = null)
	{
		$this->validator = array(
	        'fullname'  => 'required|max:50',
	        'email' => 'required|email|unique:user',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required'
	    );

		//transform data before actually save it

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

		$data['creatorName'] = Auth::user()->fullname;
		$data['creatorId'] = Auth::user()->id;

		return parent::post_add($data);
	}

	public function makeActions($data){
		$delete = '<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$data['_id'].'" >Delete</span>';
		$edit =	'<a class="icon-"  href="'.URL::to('users/edit/'.$data['_id']).'"><i>&#xe164;</i><span>Update User</span>';
		$pic =	'<a class="icon-"  href="'.URL::to('users/picture/'.$data['_id']).'"><i>&#x0062;</i><span>Update Picture</span>';
		$pass =	'<a class="icon-"  href="'.URL::to('users/pass/'.$data['_id']).'"><i>&#x006a;</i><span>Change Password</span>';

		$actions = $edit.$delete.$pic.$pass;
		return $actions;
	}

	public function namePic($data){
		$display = '<div class="row-fluid">';
		$display .= '<div class="span4">'.getavatar($data['_id'],$data['fullname'],'').'</div>';
		$display .= '<div class="span8"><span class="expander" id="'.$data['_id'].'" >'.$data['fullname'].'</span></div>';
		$display .= '</div>';

		return $display;
	}

	public function afterUpdate($id)
	{

		$files = Input::file();

		$newid = $id;

		$newdir = realpath(Config::get('kickstart.storage')).'/products/'.$newid;

		if(!file_exists($newdir)){
			mkdir($newdir,0777);
		}

		foreach($files as $key=>$val){

			if($val['name'] != ''){

				$val['name'] = fixfilename($val['name']);

				Input::upload($key,$newdir,$val['name']);

				$path = $newdir.'/'.$val['name'];

				foreach(Config::get('shoplite.picsizes') as $s){
					$smsuccess = Resizer::open( $path )
		        		->resize( $s['w'] , $s['h'] , $s['opt'] )
		        		->save( Config::get('kickstart.storage').'/products/'.$newid.'/'.$s['prefix'].$key.$s['ext'] , $s['q'] );					
				}

			}				
		}

		return $id;

	}

	public function afterSave($obj)
	{

		$files = Input::file();

		$newid = $obj['_id']->__toString();

		$newdir = realpath(Config::get('kickstart.storage')).'/products/'.$newid;

		if(!file_exists($newdir)){
			mkdir($newdir,0777);
		}

		foreach($files as $key=>$val){

			if($val['name'] != ''){

				$val['name'] = fixfilename($val['name']);

				Input::upload($key,$newdir,$val['name']);

				$path = $newdir.'/'.$val['name'];

				foreach(Config::get('shoplite.picsizes') as $s){
					$smsuccess = Resizer::open( $path )
		        		->resize( $s['w'] , $s['h'] , $s['opt'] )
		        		->save( Config::get('kickstart.storage').'/products/'.$newid.'/'.$s['prefix'].$key.$s['ext'] , $s['q'] );					
				}

			}				
		}

		return $obj;
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

	public function get_pass($id){

		$this->crumb->add(strtolower($this->controller_name).'/pass','Change Password',false);

		$doc['_id'] = $id;

		$form = Formly::make();

		$_id = new MongoId($id);

		$user = new User();

		$user_profile = $user->get(array('_id'=>$_id));

		$this->crumb->add(strtolower($this->controller_name).'/pass',$user_profile['fullname'],false);

		return View::make(strtolower($this->controller_name).'.pass')
					->with('form',$form)
					->with('doc',$doc)
					->with('crumb',$this->crumb)
					->with('title','Change Password');

	}

	public function post_pass($id = null){

		$back = $this->controller_name;

	    $rules = array(
	        'pass' => 'same:repass',
	        'repass'=> 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('users/pass/'.$id)->with_errors($validation)->with_input(Input::all());

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



}