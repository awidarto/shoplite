<?php

class Shoppers_Controller extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->controller_name = str_replace('_Controller', '', get_class());
		
		$this->crumb = new Breadcrumb();
		$this->crumb->add(strtolower($this->controller_name),ucfirst($this->controller_name));

		$this->model = new Shopper();

	}

	public function get_index()
	{

/*
	"activeCart": ObjectId("517aba4eccae5b8e05000000"),
   "address_1": "Komp DKI Joglo Blok D No 3 RT 01\/04 Joglo Kembangan",
   "address_2": "",
   "agreetnc": "",
   "bankname": "",
   "branch": "",
   "cardnumber": "",
   "ccname": "",
   "city": "Jakarta",
   "country": "Indonesia",
   "createdDate": ISODate("2013-04-26T11:09:10.574Z"),
   "email": "andy.awidarto@gmail.com",
   "expiremonth": "",
   "expireyear": "",
   "firstname": "Andi",
   "fullname": "Andi Karsono",
   "lastUpdate": ISODate("2013-04-26T11:09:10.574Z"),
   "lastname": "Karsono",
   "mobile": "",
   "pass": "$2a$08$Q7UxB8TpjY4ZsQ33Dw3nReuTT\/2eG6bn7UY\/LezTUenQeX\/CQaJei",
   "role": "shopper",
   "salutation": "Mr",
   "saveinfo": "",
   "shippingphone": "",
   "shopperseq": "0000000002",
   "zip": "11640" 
*/

		$this->heads = array(
			array('First Name',array('search'=>true,'sort'=>true)),
			array('Last Name',array('search'=>true,'sort'=>true)),
			array('Email',array('search'=>true,'sort'=>true)),
			array('Address 1',array('search'=>true,'sort'=>true)),
			array('Address 2',array('search'=>true,'sort'=>true)),
			array('City',array('search'=>true,'sort'=>true)),
			array('ZIP',array('search'=>true,'sort'=>true)),
			array('Country',array('search'=>true,'sort'=>true)),
			array('Mobile',array('search'=>true,'sort'=>true)),
			array('Phone',array('search'=>true,'sort'=>true)),
			array('Created',array('search'=>true,'sort'=>true,'class'=>'date')),
			array('Last Update',array('search'=>true,'sort'=>true,'class'=>'date')),
		);

		return parent::get_index();

	}

	public function post_index()
	{
		$this->fields = array(
			array('firstname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'attr'=>array('class'=>'expander'))),
			array('lastname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('email',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('address_1',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('address_2',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('city',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('zip',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('country',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('mobile',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('phone',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('createdDate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
		);

		return parent::post_index();
	}

	public function post_add($data = null)
	{

		$this->validator = array(
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	        'email' => 'required|email|unique:shopper',
	        'pass' => 'required|same:repass',
	        'repass'=> 'required',
	        'address_1' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        'country' => 'required'
	    );

		if(is_null($data)){
			$data = Input::get();
		}

		$data['agreetnc'] = (isset($data['agreetnc']) && $data['agreetnc'] == 'on')?true:false;
		$data['saveinfo'] = (isset($data['saveinfo']) && $data['saveinfo'] == 'on')?true:false;

		return parent::post_add($data);
	}

	public function post_edit($id,$data = null){

	    $this->validator = array(
	    	'firstname' => 'required',
	    	'lastname' => 'required',
	        'address_1' => 'required',
	        'city' => 'required',
	        'zip' => 'required',
	        'country' => 'required'
	    );


		if(is_null($data)){
			$data = Input::get();
		}

		//print_r($data);

		$data['agreetnc'] = (isset($data['agreetnc']) && $data['agreetnc'] == 'on')?true:false;
		$data['saveinfo'] = (isset($data['saveinfo']) && $data['saveinfo'] == 'on')?true:false;

		return parent::post_edit($id,$data);
	}

	public function makeActions($data){
		$controller_name = strtolower($this->controller_name);

		$delete = '<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$data['_id'].'" >Delete</span>';
		$edit =	'<a class="icon-"  href="'.URL::to($controller_name.'/edit/'.$data['_id']).'"><i>&#xe164;</i><span>Update Shopper</span>';
		$pic =	'<a class="icon-"  href="'.URL::to($controller_name.'/picture/'.$data['_id']).'"><i>&#x0062;</i><span>Update Picture</span>';
		$pass =	'<a class="icon-"  href="'.URL::to($controller_name.'/pass/'.$data['_id']).'"><i>&#x006a;</i><span>Change Password</span>';

		$actions = $edit.$delete.$pic.$pass;
		return $actions;
	}

	public function namePic($data){
		$display = HTML::image(URL::base().'/storage/products/'.$data['_id'].'/sm_pic0'.$data['defaultpic'].'.jpg?'.time(), 'sm_pic01.jpg', array('id' => $data['_id']));
		return $display;
	}

	public function afterUpdate($id,$data = null)
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


	public function get_picture($id){

		$controller_name = strtolower($this->controller_name);

		$this->crumb->add($controller_name.'/picture','Change Picture',false);

		$_id = new MongoId($id);

		$model = $this->model;

		$formdata = $model->get(array('_id'=>$_id));

		$this->crumb->add($controller_name.'/picture',$formdata['fullname'],false);

		$form = $this->form;

		$form->set_options(array(
			'framework'=>'metro',
			'form_class'=>'form-vertical'
			));

		return View::make($controller_name.'.pic')
					->with('submit',$controller_name.'/picture/'.$id)
					->with('form',$form)
					->with('id',$id)
					->with('doc',$formdata)
					->with('crumb',$this->crumb)
					->with('title','Change Photo');
	}

	public function post_picture($id){

		$controller_name = strtolower($this->controller_name);

		$picupload = Input::file('picupload');

		$data = Input::get();

		if($picupload['name'] != ''){

			$newdir = realpath(Config::get('kickstart.storage')).'/'.$controller_name.'/'.$id;

			print($newdir);

			if(!file_exists($newdir)){
				mkdir($newdir,0777);
			}

			$success = Resizer::open( $picupload )
        		->resize( 200 , 200 , 'crop' )
        		->save( Config::get('kickstart.storage').'/'.$controller_name.'/'.$id.'/avatar.jpg' , 90 );

			Input::upload('picupload',$newdir,$picupload['name']);

			
		}

		$model = $this->model;

		$_id = new MongoId($data['id']);
		$data['lastUpdate'] = new MongoDate();

		unset($data['csrf_token']);
		unset($data['id']);		

		
		if($model->update(array('_id'=>$_id),array('$set'=>$data))){
	    	return Redirect::to($controller_name)->with('notify_success','Picture saved successfully');
		}else{
	    	return Redirect::to($controller_name)->with('notify_success','Picture saving failed');
		}

	}

	public function get_pass($id){

		$this->crumb->add(strtolower($this->controller_name).'/pass','Change Password',false);

		$controller_name = strtolower($this->controller_name);

		$doc['_id'] = $id;

		$form = $this->form;

		$form->set_options(array(
			'framework'=>'metro',
			'form_class'=>'form-vertical'
			));

		$_id = new MongoId($id);

		$model = $this->model;

		$formdata = $model->get(array('_id'=>$_id));

		$this->crumb->add($controller_name.'/pass',$formdata['fullname'],false);

		return View::make($controller_name.'.pass')
					->with('submit',$controller_name.'/add')
					->with('form',$form)
					->with('doc',$formdata)
					->with('crumb',$this->crumb)
					->with('title','Change Password');

	}

	public function post_pass($id = null){

		$controller_name = strtolower($this->controller_name);

	    $rules = array(
	        'pass' => 'required|same:repass',
	        'repass'=> 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to($controller_name.'/pass/'.$id)->with_errors($validation)->with_input(Input::all());

	    }else{

			$data = Input::get();
	    	

			$data['pass'] = Hash::make($data['pass']);

			unset($data['repass']);
			unset($data['csrf_token']);

			$_id = new MongoId($data['id']);
			$data['lastUpdate'] = new MongoDate();

			$user = $this->model;

			if($user->update(array('_id'=>$_id),array('$set'=>$data))){
		    	return Redirect::to($controller_name)->with('notify_success','Password changed successfully');
			}else{
		    	return Redirect::to($controller_name)->with('notify_success','Password change failed');
			}
			

	    }		

	}



}