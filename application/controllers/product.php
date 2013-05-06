<?php

class Product_Controller extends Base_Controller {

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
		$this->crumb->add('product','Products');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{


		$form = new Formly();
		$form->set_options(array(
			'framework'=>'metro',
			'form_class'=>'form-horizontal'
			));

		$select_all = $form->checkbox('select_all','','',false,array('id'=>'select_all'));

		$action_selection = $form->select('action','',Config::get('kickstart.actionselection'));

		$btn_add_to_group = '<span class=" add_to_group" id="add_to_group">'.$action_selection.'</span>';


		$heads = array(
			array('#',array('search'=>false,'sort'=>false)),
			array($select_all,array('search'=>false,'sort'=>false)),
			array('Name',array('search'=>true,'sort'=>true)),
			array('Product Code',array('search'=>true,'sort'=>true)),
			array('Permalink',array('search'=>true,'sort'=>true)),
			array('Description',array('search'=>true,'sort'=>true)),
			array('Section',array('search'=>true,'sort'=>true)),
			array('Category',array('search'=>true,'sort'=>true)),
			array('Tags',array('search'=>true,'sort'=>true)),
			array('Currency',array('search'=>true,'sort'=>true)),
			array('Retail Price',array('search'=>true,'sort'=>true)),
			array('Sale Price',array('search'=>true,'sort'=>true)),
			array('Effective From',array('search'=>true,'sort'=>true)),
			array('Effective Until',array('search'=>true,'sort'=>true)),
			array('Created',array('search'=>true,'sort'=>true)),
			array('Last Update',array('search'=>true,'sort'=>true)),
			array('Productsequence',array('search'=>true,'sort'=>true)),
			array('',array('search'=>false,'sort'=>false))
		);

		$disablesort = array();

		for($s = 0; $s < count($heads);$s++){
			if($heads[$s][1]['sort'] == false){
				$disablesort[] = $s;
			}
		}

		$disablesort = implode(',',$disablesort);

		if(Auth::user()->role == 'root' || Auth::user()->role == 'super' || Auth::user()->role == 'onsite'){
			return View::make('tables.simple')
				->with('title','Master Data')
				->with('newbutton','New Visitor')
				->with('disablesort',$disablesort)
				->with('addurl','product/add')
				->with('ajaxsource',URL::to('product'))
				->with('ajaxdel',URL::to('product/del'))
				->with('ajaxpay',URL::to('product/paystatus'))
				->with('ajaxpaygolf',URL::to('product/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('product/paystatusgolfconvention'))
				->with('ajaxresendmail',URL::to('product/resendmail'))
				->with('printsource',URL::to('product/printbadge'))
				->with('form',$form)
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','product.rowdetail');
		}else{
			return View::make('product.restricted')
							->with('title','Master Data');
		}
	}

	public function post_index()
	{
		$fields = array(
			array('name',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'attr'=>array('class'=>'expander'))),
			array('productcode',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('permalink',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('description',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('section',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('category',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('tags',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('currency',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('retailPrice',array('kind'=>'currency','query'=>'like','pos'=>'both','show'=>true)),
			array('salePrice',array('kind'=>'currency','query'=>'like','pos'=>'both','show'=>true)),
			array('effectiveFrom',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('effectiveUntil',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('createdDate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('productsequence',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true))
		);

		$pagestart = Input::get('iDisplayStart');
		$pagelength = Input::get('iDisplayLength');

		$limit = array($pagelength, $pagestart);

		$defsort = 1;
		$defdir = -1;

		$idx = 0;
		$q = array();

		$hilite = array();
		$hilite_replace = array();

		for($i = 1;$i < count($fields);$i++){
			$idx = $i;
			//print_r($fields[$i]);
			$field = $fields[$i-1][0];
			$type = $fields[$i-1][1]['kind'];

			if(Input::get('sSearch_'.$i))
			{
				if( $type == 'text'){
					if($fields[$i][1]['query'] == 'like'){
						$pos = $fields[$i][1]['pos'];
						if($pos == 'both'){
							$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'/i');
						}else if($pos == 'before'){
							$q[$field] = new MongoRegex('/^'.Input::get('sSearch_'.$idx).'/i');
						}else if($pos == 'after'){
							$q[$field] = new MongoRegex('/'.Input::get('sSearch_'.$idx).'$/i');
						}
					}else{
						$q[$field] = Input::get('sSearch_'.$idx);
					}
				}elseif($type == 'numeric' || $type == 'currency'){
					$str = Input::get('sSearch_'.$idx);

					$sign = null;

					if(strpos($str, "<=") !== false){
						$sign = '$lte';
					}elseif(strpos($str, ">=") !== false){
						$sign = '$gte';
					}elseif(strpos($str, ">") !== false){
						$sign = '$gt';
					}elseif(stripos($str, "<") !== false){
						$sign = '$lt';
					}

					//print $sign;

					$str = trim(str_replace(array('<','>','='), '', $str));

					if(is_null($sign)){
						$q[$field] = new MongoInt32($str);
					}else{
						$str = new MongoInt32($str);
						$q[$field] = array($sign=>$str);
					}
				}elseif($type == 'date'){
					$q[$field] = Input::get('sSearch_'.$idx);
				}

			}

		}

		//print_r($q);

		$product = new Product();

		/* first column is always sequence number, so must be omitted */
		$fidx = Input::get('iSortCol_0');
		if($fidx == 0){
			$fidx = $defsort;
			$sort_col = $fields[$fidx][0];
			$sort_dir = $defdir;
		}else{
			$fidx = ($fidx > 0)?$fidx - 1:$fidx;
			$sort_col = $fields[$fidx][0];
			$sort_dir = (Input::get('sSortDir_0') == 'asc')?1:-1;
		}

		$count_all = $product->count();

		if(count($q) > 0){
			$products = $product->find($q,array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $product->count($q);
		}else{
			$products = $product->find(array(),array(),array($sort_col=>$sort_dir),$limit);
			$count_display_all = $product->count();
		}

		$aadata = array();

		$form = new Formly();

		$messagelog = new Logmessage();

		$counter = 1 + $pagestart;

		//print_r($products);

		foreach ($products as $doc) {

			$extra = $doc;

			$select = $form->checkbox('sel_'.$doc['_id'],'','',false,array('id'=>$doc['_id'],'class'=>'selector'));

			//find message log

			//$rowResendMessage = '';
			//$messagelogs = $messagelog->find(array('user'=>$doc['_id']),array(),array(),array());
			//if(count($messagelogs)>0){

			$rowResendMessage = '<a class="icon-"  ><i>&#xe165;</i><span class="resendmail" id="'.$doc['_id'].'" >Resend Email</span>';
			//}
			$action = $rowResendMessage;


			$row = array();

			$row[] = $counter;
			$row[] = $select;

			foreach($fields as $field){
				if($field[1]['show'] == true){
					if(isset($doc[$field[0]])){
						if($field[1]['kind'] == 'date'){
							$rowitem = date('Y-m-d H:i:s',$doc[$field[0]]->sec);
						}elseif($field[1]['kind'] == 'currency'){
							$rowitem = number_format($doc[$field[0]],2,',','.');
						}else{
							$rowitem = $doc[$field[0]];
						}

						if(isset($field[1]['attr'])){
							$attr = '';
							foreach ($field[1]['attr'] as $key => $value) {
								$attr .= '"'.$key.'"="'.$value.'" ';
							}
							$row[] = '<span '.$attr.' >'.$rowitem.'</span>';
						}else{
							$row[] = $rowitem;
						}

					}else{
						$row[] = '';
					}
				}
			}

			$row[] = $action;
			$row['extra'] = $extra;


			$aadata[] = $row;

			/*
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
				'<a class="icon-"  href="'.URL::to('product/edit/'.$doc['_id']).'"><i>&#xe164;</i><span>Update Profile</span>'.
				
				$rowResendMessage.
				'<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$doc['_id'].'" >Delete</span>',
				

				'extra'=>$extra
			);
			*/

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

	public function get_groups()
	{
		$this->crumb->add('product','Groups');

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
				->with('ajaxsource',URL::to('product/groups'))
				->with('ajaxdel',URL::to('product/del'))
				->with('ajaxpay',URL::to('product/paystatus'))
				->with('ajaxpaygolf',URL::to('product/paystatusgolf'))
				->with('ajaxpaygolfconvention',URL::to('product/paystatusgolfconvention'))
				->with('printsource',URL::to('product/printbadge'))
				->with('form',$form)
				->with('crumb',$this->crumb)
				->with('heads',$heads)
				->nest('row','product.rowdetailgroups');
		}else{
			return View::make('product.restricted')
							->with('title',$title);
		}
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
		$product = new Product();

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
			$peoples = $product->find($condition, array(), array(),array());
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

		$user = new Product();

		if(is_null($id)){
			$result = array('status'=>'ERR','data'=>'NOID');
		}else{

			$id = new MongoId($id);


			if($user->delete(array('_id'=>$id))){
				Event::fire('product.delete',array('id'=>$id,'result'=>'OK'));
				$result = array('status'=>'OK','data'=>'CONTENTDELETED');
			}else{
				Event::fire('product.delete',array('id'=>$id,'result'=>'FAILED'));
				$result = array('status'=>'ERR','data'=>'DELETEFAILED');
			}
		}

		print json_encode($result);
	}

	public function post_resendmail(){
		$id = Input::get('id');
		$mailtype = Input::get('type');

		$user = new Product();
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
			$this->crumb->add('product/add','New Product');
		}else{
			$this->crumb = new Breadcrumb();
			$this->crumb->add('product/type/'.$type,'Product');

			$this->crumb->add('product/type/'.$type,depttitle($type));
			$this->crumb->add('product/add','New Product');
		}

		$product = new Product();

		$form = new Formly();
		$form->set_options(array(
			'framework'=>'metro',
			'form_class'=>'form-vertical'
			));

		return View::make('product.new')
					->with('form',$form)
					->with('type',$type)
					->with('crumb',$this->crumb)
					->with('title','New Product');

	}

	public function post_add(){

		//print_r(Session::get('permission'));
		$data = Input::get();

		$files = Input::file();

			$rules = array(

			    'name' => 'required', 
			    'productcode' => 'required',
			    'permalink' => 'required',
			    'description' => 'required',
			    'category' => 'required',
			    'tags' => 'required',
			    'priceCurrency' => 'required',
			    'retailPrice' => 'required',
			    'salePrice' => 'required',
			    'effectiveFrom' => 'required',
			    'effectiveUntil' => 'required'
		    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('product/add')->with_errors($validation)->with_input(Input::all());

	    }else{

			//$data = Input::get();


			unset($data['csrf_token']);

			$data['createdDate'] = new MongoDate();
			$data['lastUpdate'] = new MongoDate();

			//set number types into string 

			foreach($data as $key=>$val){
				if((is_integer($val) || is_float($val) || is_long($val) || is_double($val))){
					$data[$key] = new MongoInt32($val);
				}
			}

			$data['retailPrice'] = new MongoInt64($data['retailPrice']);
			$data['salePrice'] = new MongoInt64($data['salePrice']);

			$seq = new Sequence();

			$rseq = $seq->find_and_modify(array('_id'=>'product'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

			$regsequence = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

			//$reg_number[] = $regsequence;

			$data['productsequence'] = $regsequence;

			//normalize
			$data['cache_id'] = '';
			$data['cache_obj'] = '';
			$data['groupId'] = '';
			$data['groupName'] = '';

			$productpic = array();

			foreach($files as $key=>$val){
				if($val['name'] != ''){
					$productpic[$key] = $val;
				}				
			}

			$data['productpic'] = $productpic;
			
			$product = new Product();

			if($obj = $product->insert($data)){

				$newid = $obj['_id']->__toString();

				$newdir = realpath(Config::get('kickstart.storage')).'/products/'.$newid;

				if(!file_exists($newdir)){
					mkdir($newdir,0777);
				}

				foreach($files as $key=>$val){

					if($val['name'] != ''){

						Input::upload($key,$newdir,$val['name']);

						$thumbpath = Config::get('kickstart.storage').'/products/'.$newid;

						print_r($val);

						//$smsuccess = Resizer::open( $val )
			        	//	->resize( 200 , 200 , 'fit' );
			        		//->save( Config::get('kickstart.storage').'/products/'.$newid.'/sm_'.$key.'.jpg' , 90 );

			        	/*


						$mdsuccess = Resizer::open( $pfile )
			        		->resize( 400 , 400 , 'fit' )
			        		->save( $thumbpath.'/med_'.$key.'.jpg' , 90 );
						*/

					}				
				}

				//Event::fire('product.createformadmin',array($obj['_id'],$passwordRandom,$obj['conventionPaymentStatus']));
				//return Redirect::to('product')->with('notify_success',Config::get('site.register_success'));
		    	
			}else{
		    	return Redirect::to('product')->with('notify_success',Config::get('site.register_failed'));
			}


	    }

	}

	public function get_edit($id){

		$this->crumb->add('product/edit','Edit',false);

		$user = new Product();

		$_id = new MongoId($id);

		$user_profile = $user->get(array('_id'=>$_id));

		//print_r($user_profile);
		$user_profile['registrationnumber'] = (isset($user_profile['registrationnumber']))?$user_profile['registrationnumber']:'';

		$form = Formly::make($user_profile);
		$form->set_options(array(
			'framework'=>'metro',
			'form_class'=>'form-vertical'
			));

		$this->crumb->add('product/edit/'.$id,$user_profile['registrationnumber'],false);

		return View::make('product.edit')
					->with('user',$user_profile)
					->with('form',$form)
					->with('crumb',$this->crumb)
					->with('title','Edit Product');

	}


	public function post_edit(){

		//print_r(Session::get('permission'));

	    $rules = array(
	        'email'  => 'required'
	    );

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('product/edit')->with_errors($validation)->with_input(Input::all());

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

			$user = new Product();

			if(isset($data['registrationnumber']) && $data['registrationnumber'] != ''){
				$reg_number = explode('-',$data['registrationnumber']);

				$reg_number[0] = 'C';
				$reg_number[1] = $data['regtype'];
				$reg_number[2] = ($data['attenddinner'] == 'Yes')?str_pad(Config::get('eventreg.galadinner'), 2,'0',STR_PAD_LEFT):'00';

			}else if($data['registrationnumber'] == ''){
				$reg_number = array();
				$seq = new Sequence();
				$rseq = $seq->find_and_modify(array('_id'=>'product'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

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
		    	return Redirect::to('product')->with('notify_success','Product saved successfully');
			}else{
		    	return Redirect::to('product')->with('notify_success','Product saving failed');
			}

	    }

	}


	public function get_view($id){
		$id = new MongoId($id);

		$product = new Document();

		$doc = $product->get(array('_id'=>$id));

		return View::make('pop.docview')->with('profile',$doc);
	}



	public function get_addSequencetoCollection(){
		$product = new Product();
		$countSeq = 0;
		$products = $product->find();
		foreach($products as $att){
			$_id = $att['_id'];
			$reg_number = explode('-',$att['registrationnumber']);
			$reg_seq = $reg_number[3];
			$product->update(array('_id'=>$_id),array('$set'=>array('regsequence'=>$reg_seq)));
			$countSeq ++;
		}
		return View::make('product.updateField')
				->with('countSeq',$countSeq)
				->with('title','Update Field');

	}

	public function get_updateField(){
		$product = new Product();

		$products = $product->find();
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

		foreach($products as $att){

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

				if($product->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$updateCount++;
				}

			}

			if(!isset($att['cache_id'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('cache_id'=>'')))){
					$caheIDCount++;
				}
			}

			if(!isset($att['cache_obj'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('cache_obj'=>'')))){
					$caheOBJCount++;
				}

			}

			if(!isset($att['companys_npwp'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('companys_npwp'=>'')))){
					$companyNPWPCount++;
				}

			}

			if(!isset($att['groupId'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('groupId'=>'')))){
					$groupIDCount++;
				}

			}
			if(!isset($att['groupName'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('groupName'=>'')))){
					$groupNameCount++;
				}

			}

			if(!isset($att['inv_letter'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('inv_letter'=>'')))){
					$invLetterCount++;
				}

			}

			if(!isset($att['invoice_address_conv'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('invoice_address_conv'=>'')))){
					$invCompanyAddCount++;
				}

			}
			if(!isset($att['paymentStatus'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('paymentStatus'=>'')))){
					$paymentStatCount++;
				}

			}


			if(!isset($att['address'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('address'=>'')))){
					$AddCount++;
				}

			}

			if(!isset($att['addressInvoice'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('addressInvoice'=>'')))){
					$AddCountInvoice++;
				}

			}

			if(!isset($att['confirmation'])){
				$_id = $att['_id'];
				if($product->update(array('_id'=>$_id),array('$set'=>array('confirmation'=>'none')))){
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

				if($product->update(array('_id'=>$_id),array('$set'=>array('totalIDR'=>$totalIDR,'totalUSD'=>$totalUSD)))){
					$normalRate++;
				}

			}




		}

		return View::make('product.updateField')
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