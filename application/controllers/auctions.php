<?php

class Auctions_Controller extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->controller_name = str_replace('_Controller', '', get_class());
		
		$this->crumb = new Breadcrumb();
		$this->crumb->add(strtolower($this->controller_name),ucfirst($this->controller_name));

		$this->model = new Auction();

	}

	public function get_index()
	{

		$this->heads = array(
			array('Title',array('search'=>true,'sort'=>true)),
			array('Permalink',array('search'=>true,'sort'=>true)),
			array('Product Name',array('search'=>true,'sort'=>true)),
			array('Description',array('search'=>true,'sort'=>true)),
			array('Section',array('search'=>true,'sort'=>true,'select'=>Config::get('shoplite.auctions.search_sections'))),
			array('Category',array('search'=>true,'sort'=>true,'select'=>Config::get('shoplite.auctions.search_categories'))),
			array('Publish Status',array('search'=>true,'sort'=>true,'select'=>Config::get('kickstart.search_publishstatus'))),
			//array('Tags',array('search'=>true,'sort'=>true)),
			array('Currency',array('search'=>true,'sort'=>true)),
			array('Starting Price',array('search'=>true,'sort'=>true)),
			array('Incremental',array('search'=>true,'sort'=>true)),
			array('Run From',array('search'=>true,'sort'=>true)),
			array('Run Until',array('search'=>true,'sort'=>true)),
			array('Created',array('search'=>true,'sort'=>true,'date'=>true)),
			array('Last Update',array('search'=>true,'sort'=>true,'date'=>true))
		);

		return parent::get_index();

	}

	public function post_index()
	{
		$this->fields = array(

			array('title',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'nameTitle')),
			array('permalink',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('name',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true,'callback'=>'namePic','attr'=>array('class'=>'expander'))),
			array('description',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('section',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('category',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('publishStatus',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),			
			//array('tags',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('priceCurrency',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('startingPrice',array('kind'=>'currency','query'=>'like','pos'=>'both','show'=>true)),
			array('incrementalPrice',array('kind'=>'currency','query'=>'like','pos'=>'both','show'=>true)),
			array('auctionStart',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('auctionEnd',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true)),
			array('createdDate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			array('lastUpdate',array('kind'=>'date','query'=>'like','pos'=>'both','show'=>true)),
			//array('auctionsequence',array('kind'=>'text','query'=>'like','pos'=>'both','show'=>true))
		);

		return parent::post_index();
	}

	public function post_add($data = null)
	{
		$this->validator = array(
			'title'=>'required',
		    'name' => 'required', 
		    'productcode' => 'required',
		    'permalink' => 'required',
		    'description' => 'required',
		    'category' => 'required',
		    'tags' => 'required',
		    'priceCurrency' => 'required',
		    'startingPrice' => 'required',
		    'incrementalPrice' => 'required',
		    'auctionStart' => 'required',
		    'auctionEnd' => 'required'
	    );

		//transform data before actually save it

		$data = Input::get();

		// access posted object array
		$files = Input::file();

		$data['auctionStart'] = new MongoDate(strtotime($data['auctionStart']));
		$data['auctionEnd'] = new MongoDate(strtotime($data['auctionEnd']));

		$data['publishFrom'] = new MongoDate(strtotime($data['publishFrom']));
		$data['publishUntil'] = new MongoDate(strtotime($data['publishUntil']));

		$data['startingPrice'] = new MongoInt64($data['startingPrice']);
		$data['incrementalPrice'] = new MongoInt64($data['incrementalPrice']);

		$seq = new Sequence();

		$rseq = $seq->find_and_modify(array('_id'=>'auction'),array('$inc'=>array('seq'=>1)),array('seq'=>1),array('new'=>true));

		$regsequence = str_pad($rseq['seq'], 6, '0',STR_PAD_LEFT);

		//$reg_number[] = $regsequence;

		$data['auctionsequence'] = $regsequence;

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

		// deal with tags
		$data['tags'] = explode(',',$data['tags']);

		if(count($data['tags']) > 0){
			$tag = new Tag();
			foreach($data['tags'] as $t){
				$tag->update(array('tag'=>$t),array('$inc'=>array('count'=>1)),array('upsert'=>true));
			}
		}

		return parent::post_add($data);
	}

	public function post_edit($id,$data = null)
	{
		$this->validator = array(
			'title'=>'required',
		    'name' => 'required', 
		    'productcode' => 'required',
		    'permalink' => 'required',
		    'description' => 'required',
		    'category' => 'required',
		    'tags' => 'required',
		    'priceCurrency' => 'required',
		    'startingPrice' => 'required',
		    'incrementalPrice' => 'required',
		    'auctionStart' => 'required',
		    'auctionEnd' => 'required'
	    );

		//transform data before actually save it

		$data = Input::get();

		// access posted object array
		$files = Input::file();

		$data['auctionStart'] = new MongoDate(strtotime($data['auctionStart']));
		$data['auctionEnd'] = new MongoDate(strtotime($data['auctionEnd']));

		$data['publishFrom'] = new MongoDate(strtotime($data['publishFrom']));
		$data['publishUntil'] = new MongoDate(strtotime($data['publishUntil']));

		$data['startingPrice'] = new MongoInt64($data['startingPrice']);
		$data['incrementalPrice'] = new MongoInt64($data['incrementalPrice']);

		$productpic = array();

		foreach($files as $key=>$val){
			if($val['name'] != ''){
				$productpic[$key] = $val;
			}				
		}

		$data['productpic'] = $productpic;

		// deal with tags
		$data['tags'] = explode(',',$data['tags']);

		if(count($data['tags']) > 0){
			$tag = new Tag();
			foreach($data['tags'] as $t){
				$tag->update(array('tag'=>$t),array('$inc'=>array('count'=>1)),array('upsert'=>true));
			}
		}

		return parent::post_edit($id,$data);
	}

	public function makeActions($data){
		$delete = '<a class="action icon-"><i>&#xe001;</i><span class="del" id="'.$data['_id'].'" >Delete</span>';
		$edit =	'<a class="icon-"  href="'.URL::to('auctions/edit/'.$data['_id']).'"><i>&#xe164;</i><span>Update Auction</span>';

		$actions = $edit.$delete;
		return $actions;
	}

	public function nameTitle($data){
		$title = HTML::link('auctions/view/'.$data['_id'],$data['title']);
		return $title;
	}

	public function namePic($data){
		$name = HTML::link('auctions/view/'.$data['_id'],$data['name']);
		$display = HTML::image(URL::base().'/storage/auctions/'.$data['_id'].'/sm_pic0'.$data['defaultpic'].'.jpg?'.time(), 'sm_pic01.jpg', array('id' => $data['_id']));
		return $display.'<br />'.$name;
	}

	public function beforeUpdateForm($population){
		if(isset($population['tags']) && is_array($population['tags']))
		{
			$population['tags'] = implode(',', $population['tags'] );
		}

		return $population;
	}

	public function afterUpdate($id)
	{

		$files = Input::file();

		$newid = $id;

		$newdir = realpath(Config::get('kickstart.storage')).'/auctions/'.$newid;

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
		        		->save( Config::get('kickstart.storage').'/auctions/'.$newid.'/'.$s['prefix'].$key.$s['ext'] , $s['q'] );					
				}

			}				
		}

		return $id;

	}

	public function afterSave($obj)
	{

		$files = Input::file();

		$newid = $obj['_id']->__toString();

		$newdir = realpath(Config::get('kickstart.storage')).'/auctions/'.$newid;

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
		        		->save( Config::get('kickstart.storage').'/auctions/'.$newid.'/'.$s['prefix'].$key.$s['ext'] , $s['q'] );					
				}

			}				
		}

		return $obj;
	}

}