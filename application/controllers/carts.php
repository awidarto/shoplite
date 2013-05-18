<?php

class Carts_Controller extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->controller_name = str_replace('_Controller', '', get_class());
		
		$this->crumb = new Breadcrumb();
		$this->crumb->add(strtolower($this->controller_name),ucfirst($this->controller_name));

		$this->model = new Cart();

	}

	public function get_index()
	{

		$this->heads = array(
			array('First Name',array('search'=>true,'sort'=>true)),
			array('Last Name',array('search'=>true,'sort'=>true)),
			array('Items',array('search'=>true,'sort'=>true)),
			array('Currency',array('search'=>true,'sort'=>true)),
			array('Total Price',array('search'=>true,'sort'=>true)),
			array('Cart Status',array('search'=>true,'sort'=>true)),
			//array('Effective From',array('search'=>true,'sort'=>true)),
			//array('Effective Until',array('search'=>true,'sort'=>true)),
			array('Created',array('search'=>true,'sort'=>true)),
			array('Last Update',array('search'=>true,'sort'=>true)),
		);

		return parent::get_index();

	}

	public function post_index()
	{
		$this->fields = array(
			array('buyerDetail.firstname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'fName','attr'=>array('class'=>'expander'))),
			array('buyerDetail.lastname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'lName','attr'=>array('class'=>'expander'))),
			array('items',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('currency',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('totalPrice',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('cartStatus',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('createdDate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			//array('productsequence',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true))
		);

		return parent::post_index();
	}

	public function post_add($data = null)
	{
		$this->validator = array(
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

		//transform data before actually save it

		$data = Input::get();

		// access posted object array
		$files = Input::file();

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


		return parent::post_add($data);
	}

	public function makeActions($data){
		$delete = '<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$data['_id'].'" >Delete</span>';
		$edit =	'<a class="icon-"  href="'.URL::to('products/edit/'.$data['_id']).'"><i>&#xe164;</i><span>Update Product</span>';

		$actions = $edit.$delete;
		return $actions;
	}

	public function calcTotal()
	{
		return '';

	}

	public function fName($data)
	{
		return $data['buyerDetail']['firstname'];
	}

	public function lName($data)
	{
		return $data['buyerDetail']['lastname'];				
	}

	public function namePic($data){
		$display = $data['buyerDetail']['firstname'];
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

}