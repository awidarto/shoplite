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
			array('Items',array('search'=>false,'sort'=>false)),
			array('Currency',array('search'=>true,'sort'=>true)),
			array('Total Price',array('search'=>true,'sort'=>true)),
			array('Cart Status',array('search'=>true,'sort'=>true,'select'=>Config::get('shoplite.search_cartstatus'))),
            array('Confirmation Code',array('search'=>true,'sort'=>true)),
			//array('Effective From',array('search'=>true,'sort'=>true)),
			//array('Effective Until',array('search'=>true,'sort'=>true)),
			array('Created',array('search'=>true,'sort'=>true,'date'=>true)),
			array('Last Update',array('search'=>true,'sort'=>true,'date'=>true)),
		);

		return parent::get_index();

	}

	public function post_index()
	{
		$this->fields = array(
			array('buyerDetail.firstname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'fName')),
			array('buyerDetail.lastname',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'lName')),
			array('items',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'itempop','attr'=>array('class'=>'expander') )),
			array('currency',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('totalPrice',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('cartStatus',array('kind'=>'text','query'=>'like','pos'=>'both','callback'=>'hstat','show'=>true)),
            array('confirmationCode',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('createdDate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			//array('productsequence',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true))
		);

		return parent::post_index();
	}

	public function makeActions($data){
		$delete = '<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$data['_id'].'" >Delete</span>';
		$edit =	'<a class="icon-"  href="'.URL::to('carts/edit/'.$data['_id']).'"><i>&#xe164;</i><span>Update Cart</span>';

		$actions = '';
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

    public function hstat($data){
        $stats = Config::get('shoplite.cartstatus');
        return $stats[$data['cartStatus']];
    }

    public function itempop()
    {
        return '<span class="expander"><i class="icon-eye"></i></span>';
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