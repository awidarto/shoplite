<?php

class Shop_Controller extends Base_Controller {

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
		//$this->filter('before','auth');
		$this->crumb = new Breadcrumb();
		$this->crumb->add('shop','Shop');
		$this->filter('before', 'memberauth')->only(array('cart'))->on('get');

	}

	public function get_index()
	{
		$heads = array('#','Articles','Category','Tags','Action');
		$colclass = array('','span9','span1','span1');
		//$searchinput = array(false,'title','created','last update','creator','project manager','tags',false);
		$searchinput = array(false,'project','tags',false);

		return View::make('tables.simple')
			->with('title','Articles')
			->with('newbutton','New Article')
			->with('disablesort','0,3')
			->with('addurl','content/add')
			->with('colclass',$colclass)
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('content'))
			->with('ajaxpaygolf',URL::to('attendee/paystatusgolf'))
			->with('ajaxdel',URL::to('content/del'))
	        ->with('crumb',$this->crumb)
			->with('heads',$heads);
	}

	public function post_index()
	{
		$fields = array(array('title','body'),'projectTag');

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


		$document = new Content();

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

			$item = View::make('content.item')->with('doc',$doc)->with('popsrc','content/view')->with('tags',$tags)->render();

			$item = str_replace($hilite, $hilite_replace, $item);

			$aadata[] = array(
				$counter,
				$item,
				$doc['category'],
				$tags,
				'<a href="'.URL::to('content/view/'.$doc['_id']).'"><i class="foundicon-clock action"></i></a>&nbsp;'.
				'<a href="'.URL::to('content/edit/'.$doc['_id']).'"><i class="foundicon-edit action"></i></a>&nbsp;'.
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

	public function get_home()
	{
		$products = new Product();
		$articles = new Article();

		//$results = $model->find(array(),array(),array($sort_col=>$sort_dir),$limit);

		$pagelength= 3;
		$pagestart = 0;

		$limit = array($pagelength, $pagestart);

		$today = new MongoDate();

		$scheduled = array(
			'publishStatus'=>'scheduled',
			'publishFrom'=>array('$lte'=>$today),
			'publishUntil'=>array('$gte'=>$today)
		);

		$online = array(
			'publishStatus'=>'online',
		);


		$query = array(
			'section'=>'pow',
			'$or'=>array($scheduled,$online)
		);

        $limitsingle = array(1,0);

		$mixmatch = $products->find(array('section'=>'mixmatch','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),$limit);

		$pow = $products->find(array('section'=>'pow','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),$limitsingle);

		$otb = $products->find(array('section'=>'otb','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),$limitsingle);

		$kind = $products->find(array('section'=>'kind','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),$limitsingle);

		$mixmatcharticle = $articles->find(array('section'=>'mixmatch','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),array());
		$powarticle = $articles->find(array('section'=>'pow','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),array());
		$otbarticle = $articles->find(array('section'=>'otb','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),array());
		$kindarticle= $articles->find(array('section'=>'kind','$or'=>array($scheduled,$online)),array(),array('createdDate'=>-1),array());

		$homearticles = array_merge($mixmatcharticle,$powarticle,$otbarticle,$kindarticle);

		// /$mixandmact
		$new = array();
		$featured = array();

		return View::make('shop.home')
			->with('new',$new)
			->with('pow',$pow)
			->with('otb',$otb)
			->with('kind',$kind)
			->with('mixmatch',$mixmatch)
			->with('featured',$featured)

			->with('articles',$homearticles) ;
	}

	public function get_collections($page = 1,$category = 'all',$search = null)
	{

		$products = new Product();

		//$results = $model->find(array(),array(),array($sort_col=>$sort_dir),$limit);

		$pagelength= Config::get('shoplite.item_per_page');
		$pagestart = ($page - 1 ) * $pagelength;

		$limit = array($pagelength, $pagestart);

		$new = array();
		$featured = array();

		$today = new MongoDate();

		$scheduled = array(
			'publishStatus'=>'scheduled',
			'publishFrom'=>array('$lte'=>$today),
			'publishUntil'=>array('$gte'=>$today)
		);

		$online = array(
			'publishStatus'=>'online',
		);

		if($category == 'all'){
			$query = array(
				'category'=>array('$ne'=>'none'),
				'$or'=>array($scheduled,$online)
			);
		}else{
			$query = array(
				'category'=>$category,
				'$or'=>array($scheduled,$online)
			);
		}


		$collections = $products->find($query,array(),array('createdDate'=>-1),$limit);

		$showcount = count($collections);

		$totalfound = $products->count($query);

		$total = $products->count();

		$new = array();
		$featured = array();
		$mixmatch = array();

		$pagenum = $totalfound / $pagelength;

		$currenturl = URL::to('collections').'/'.$page.'/'.$category.'/'.$search;

		$prevpage = (($page - 1) == 0)?$page:($page - 1);
		$nextpage = (($page + 1) > $pagenum )?$page:($page + 1);

		$prevurl = URL::to('collections').'/'.$prevpage.'/'.$category.'/'.$search;
		$nexturl = URL::to('collections').'/'.$nextpage.'/'.$category.'/'.$search;

		$pagination = '<div class="pagination pull-right"><ul>';
        $pagination .='<li><a href="'.$prevurl.'">Prev</a></li>';

            if($pagenum > 11){

                if($page > (round($pagenum) - 7) ){

                    $pageurl = URL::to('collections').'/1/'.$category.'/'.$search;

                    $pagination .='<li ><a href="'.$pageurl.'">1</a></li>';

                    $pagination .='<li class="unavailable"><a href="">&hellip;</a></li>';

                    $ps = round($pagenum) - 7;
                    $pe = round($pagenum);
                    for($p = $ps;$p <= $pe; $p++){

                        $class = ($page == $p)?'class="current"':'';

                        $pageurl = URL::to('collections').'/'.$p.'/'.$category.'/'.$search;

                        $pagination .='<li '.$class.' ><a href="'.$pageurl.'">'.$p.'</a></li>';
                    }

                }else{

                    if($page < 6){
                        for($p = 1;$p <= 6; $p++){

                            $class = ($page == $p)?'class="current"':'';

                            $pageurl = URL::to('collections').'/'.$p.'/'.$category.'/'.$search;

                            $pagination .='<li '.$class.' ><a href="'.$pageurl.'">'.$p.'</a></li>';
                        }
                    }else{
                        $ps = $page - 4;
                        $pe = $page + 1;
                        for($p = $ps;$p <= $pe; $p++){

                            $class = ($page == $p)?'class="current"':'';

                            $pageurl = URL::to('collections').'/'.$p.'/'.$category.'/'.$search;

                            $pagination .='<li '.$class.' ><a href="'.$pageurl.'">'.$p.'</a></li>';
                        }

                    }

                    $pagination .='<li class="unavailable"><a href="">&hellip;</a></li>';

                    $p = round($pagenum);

                    $pageurl = URL::to('collections').'/'.$p.'/'.$category.'/'.$search;

                    $class = ($page == $p)?'class="current"':'';

                    $pagination .='<li '.$class.' ><a href="'.$pageurl.'">'.$p.'</a></li>';

                }

            }elseif($pagenum <= 10){

                if($totalfound > $pagelength){

                    for($p = 1;$p <= $pagenum; $p++){

                        $pageurl = URL::to('collections').'/'.$p.'/'.$category.'/'.$search;

                        $pagination .='<li><a href="'.$pageurl.'">'.$p.'</a></li>';
                    }

                }

            }

        $pagination .='<li><a href="'.$nexturl.'">Next</a></li>';
		$pagination .= '</ul></div>';

		return View::make('shop.collection')
			->with('new',$new)
			->with('page',$page)
			->with('total',$total)
			->with('totalfound',$totalfound)
			->with('showcount',$showcount)
			->with('pagelength',$pagelength)
			->with('category',$category)
			->with('search',$search)
			->with('pagination',$pagination)
			->with('featured',$featured)
			->with('mixmatch',$mixmatch)
			->with('products',$collections);
	}


	public function get_pow($category = 'all',$page = 0,$search = null)
	{
		$products = new Product();

		//$results = $model->find(array(),array(),array($sort_col=>$sort_dir),$limit);

        $pagelength= Config::get('shoplite.item_per_page');
		$pagestart = 0;

		$limit = array($pagelength, $pagestart);

		$new = array();
		$featured = array();

		$today = new MongoDate();

		$scheduled = array(
			'publishStatus'=>'scheduled',
			'publishFrom'=>array('$lte'=>$today),
			'publishUntil'=>array('$gte'=>$today)
		);

		$online = array(
			'publishStatus'=>'online',
		);


		$query = array(
			'section'=>'pow',
			'$or'=>array($scheduled,$online)
		);

		$pow = $products->find($query,array(),array('createdDate'=>-1),$limit);



		return View::make('shop.section')
			->with('new',$new)
			->with('featured',$featured)
			->with('products',$pow);

	}

	public function get_otb($category = 'all',$page = 0,$search = null)
	{
		$products = new Product();

        $pagelength= Config::get('shoplite.item_per_page');
		$pagestart = 0;

		$limit = array($pagelength, $pagestart);

		$new = array();
		$featured = array();

		$today = new MongoDate();

		$scheduled = array(
			'publishStatus'=>'scheduled',
			'publishFrom'=>array('$lte'=>$today),
			'publishUntil'=>array('$gte'=>$today)
		);

		$online = array(
			'publishStatus'=>'online',
		);


		$query = array(
			'section'=>'otb',
			'$or'=>array($scheduled,$online)
		);

		$otb = $products->find($query,array(),array('createdDate'=>-1),$limit);

		return View::make('shop.section')
			->with('new',$new)
			->with('featured',$featured)
			->with('products',$otb);

	}

	public function get_mixmatch($category = 'all',$page = 0,$search = null)
	{
		$products = new Product();

		//$results = $model->find(array(),array(),array($sort_col=>$sort_dir),$limit);

        $pagelength= Config::get('shoplite.item_per_page');
		$pagestart = 0;

		$limit = array($pagelength, $pagestart);

		$new = array();
		$featured = array();

		$today = new MongoDate();

		$scheduled = array(
			'publishStatus'=>'scheduled',
			'publishFrom'=>array('$lte'=>$today),
			'publishUntil'=>array('$gte'=>$today)
		);

		$online = array(
			'publishStatus'=>'online',
		);


		$query = array(
			'section'=>'mixmatch',
			'$or'=>array($scheduled,$online)
		);

		$mixmatch = $products->find($query,array(),array('createdDate'=>-1),$limit);

		return View::make('shop.section')
			->with('new',$new)
			->with('featured',$featured)
			->with('products',$mixmatch);

	}

	public function get_kind($category = 'all',$page = 0,$search = null)
	{
		$products = new Product();

        $pagelength= Config::get('shoplite.item_per_page');
		$pagestart = 0;

		$limit = array($pagelength, $pagestart);

		$new = array();
		$featured = array();

		$today = new MongoDate();

		$scheduled = array(
			'publishStatus'=>'scheduled',
			'publishFrom'=>array('$lte'=>$today),
			'publishUntil'=>array('$gte'=>$today)
		);

		$online = array(
			'publishStatus'=>'online',
		);


		$query = array(
			'section'=>'kind',
			'$or'=>array($scheduled,$online)
		);

		$kind = $products->find($query,array(),array('createdDate'=>-1),$limit);

		return View::make('shop.section')
			->with('new',$new)
			->with('featured',$featured)
			->with('products',$kind);

	}

	public function get_about()
	{
		$new = array();
		$featured = array();
		$mixmatch = array();

		return View::make('shop.collection')
			->with('new',$new)
			->with('featured',$featured)
			->with('mixmatch',$mixmatch);

	}

	public function get_view($id,$slug = null){

		$this->crumb->add('content/view/'.$section,ucfirst($section));

		$this->crumb->add('content/view/'.$section.'/'.$category,ucfirst($category));


		if(is_null($slug)){
			$heads = array('#','Articles','Section','Category','Tags');
			$colclass = array('one','','one','one','two');
			//$searchinput = array(false,'title','created','last update','creator','project manager','tags',false);
			$searchinput = array(false,'article',false,false,'tags');

			return View::make('tables.simple')
				->with('title','Articles')
				->with('newbutton','New Article')
				->with('disablesort','0')
				->with('colclass',$colclass)
				->with('searchinput',$searchinput)
				->with('ajaxsource',URL::to('content/view/'.$section.'/'.$category))
				->with('ajaxdel',URL::to('content/del'))
		        ->with('crumb',$this->crumb)
				->with('heads',$heads);
		}else{

			$content = new Content();

			$article = $content->get(array('slug'=>$slug));

			$this->crumb->add('content/view/'.$section.'/'.$category.'/'.$slug,$article['title']);

			return View::make('content.view')
				->with('crumb',$this->crumb)
				->with('title',$article['title'])
				->with('body', $article['body']);

		}

		$project = new Content();

		$_id = new MongoId($id);

		$projectdata = $project->get(array('_id'=>$_id));

	}

	public function get_detail($id){

		$_id = new MongoId($id);
		$products = new Product();

		$product = $products->get(array('_id'=>$_id));

		$inventory = new Inventory();

		$variants = $inventory->find(array('productId'=>$_id),array('size'=>true,'color'=>true,'_id'=>false));

		$ca = array();
		$sa = array();

		foreach($variants as $v){
			$ca[] = $v['color'];
			$sa[] = $v['size'];
		}

		$related = array();
		if(isset($product['relatedProducts']) && count($product['relatedProducts']) > 0){
			foreach($product['relatedProducts'] as $r){
				$r_id = new MongoId($r['relatedId']);
				$related[] = $products->get(array('_id'=>$r_id));
			}
		}

		$product['relatedProducts'] = $related;

		$component = array();
		if(isset($product['componentProducts']) && count($product['componentProducts']) > 0){
			foreach($product['componentProducts'] as $r){
				$r_id = new MongoId($r['componentId']);
				$component[] = $products->get(array('_id'=>$r_id));
			}
		}

		$product['componentProducts'] = $component;

		$availcolors = array();

		$sizes = array_unique($sa);
		$colors = array_unique($ca);

        $comments = new Comment();


        $shoppercomment = $comments->find( array('product'=>$_id ),array(),array('createdDate'=>-1) );

        //print_r($shoppercomment);

        if(Auth::shoppercheck() == true){
            $my_id = new MongoId(Auth::shopper()->id);

            $product['myreviews'] = $comments->count( array('shopper_id'=>$my_id));

        }else{

            $product['myreviews'] = 0;

        }


        $cr = array();

        foreach($shoppercomment as $comm){
            $comm['shopper_reviews'] = $comments->count( array('shopper_id'=>$comm['shopper_id']));

            $cr[] = $comm;
        }

        $product['comments'] = $cr;

        //print_r($cr);

        //exit();

		return View::make('shop.detail')
			->with('sizes',$sizes)
			->with('colors',$colors)
			->with('variants',$variants)
			->with('product',$product);
	}

	public function post_color()
	{
		$in = Input::get();

		$inv = new Inventory();

		$_pid = new MongoId($in['_id']);

		$colors = $inv->find(array('productId'=>$_pid,'size'=>$in['size']),array('color'=>true, '_id'=>false));

		//print_r($colors);

		$ca = array();
		foreach($colors as $c){
			$ca[] = $c['color'];
		}

		$ca = array_unique($ca);

		$html = '';
		$opt = '<option value="%s" %s >%s</option>';


		$sel = '';
		$cnt = 0;
		$defsel = '-';

		foreach($ca as $c){
			$sel = ($cnt == 0)?'selected':'';
			$cnt++;

			$defsel = ($sel == 'selected')?$c:'-';
			$html .= sprintf($opt , $c , $sel , $c);
		}

		return Response::json(array('colors'=>$ca,'html'=>$html, 'defsel'=>$defsel));

	}

	public function post_qty()
	{
		$in = Input::get();

		$inv = new Inventory();

		$_pid = new MongoId($in['_id']);

		$count = $inv->count(array('productId'=>$_pid,'size'=>$in['size'],'color'=>$in['color'],'status'=>'available'));

		$html = '';

		$opt = '<option value="%s" %s >%s</option>';

		$sel = '';
		$cnt = 0;
        $defsel = '-';

		for($i = 1; $i <= $count; $i++){
			$sel = ($cnt == 0)?'selected':'';
			$cnt++;

			$defsel = ($sel == 'selected')?$i:'';
			$html .= sprintf($opt,$i, $sel,$i);
		}

		return Response::json(array('qty'=>$count,'html'=>$html, 'defsel'=>$defsel));

	}

	public function post_addtocart()
	{
		if(Auth::shoppercheck() == false ){

			return Response::json(array('result'=>'NOTSIGNEDIN','message'=>'You are not signed in'));

		}else{
			$in = Input::get();

		    $item['color'] = $in['color'];
		    $item['size'] = $in['size'];
		    $item['productId'] = $in['_id'];

		    $qty = $in['qty'];

	    	if(isset(Auth::shopper()->activeCart) == false || Auth::shopper()->activeCart == ''){
	    		$cart = $this->newCart();
	    	}else{
	    		$cart = $this->getCurrentCart();
	    	}

	    	//$result = $cart;

	    	$result = $this->addToCart($cart,$item,$qty);

	    	$query = $item;
	    	$query['productId'] = new MongoId($query['productId']);
	    	$query['status'] = 'available';

	    	$inv = new Inventory();

	    	$result['remaining'] = $inv->count($query);

			$carts = new Cart();

			$upcart = $carts->update(array('_id'=>$result['_id']),array('$set'=>array('items'=>$result['items'])),array('upsert'=>true));

			$mycart = $carts->get(array('_id'=>$result['_id']));

			$qty = 0;

			foreach($mycart['items'] as $key=>$val){
				foreach($val as $k=>$v){
					$qty += $v['actual'];
				}
			}

			$counter = $qty;

			//return Response::json(array('result'=>'PRODUCTNOTAVAIL','message'=>'Product no longer available'));

			//return Response::json(array('result'=>'PRODUCTLESSQTY','message'=>'Available quantity is less than you ordered'));

			return Response::json(array('result'=>'PRODUCTADDED','message'=>'Product added into Shopping Cart','data'=>$result,'cartcount'=>$counter));
		}

	}

	public function post_removeitem()
	{

		$id = Input::get('id');

		$c = explode('_', $id);

		$productId = $c[0];
		$size = $c[1];
		$color = $c[2];

		//$size = str_replace('-', ' ', $size);

		$cart = $this->getCurrentCart();

		//print_r($cart);

		if($cart){
			unset($cart['items'][$productId][$size.'_'.$color]);

			if(count($cart['items'][$productId]) == 0){
				unset($cart['items'][$productId]);
			}
		}

		//print_r($cart);

		$prices = $this->recalculate($cart);

		$carts = new Cart();

		$upcart = $carts->update(array('_id'=>$cart['_id']),array('$set'=>array('items'=>$cart['items'])),array('upsert'=>true));

		if($upcart){
			$inventory = new Inventory();

			$query = array(
				'productId'=>new MongoId($productId),
				'color'=>$color,
				'size'=>$size,
				'cartId'=>$cart['_id']
			);

			$invitems = $inventory->find($query);

			$set = array(
				'cartId'=>'',
				'status'=>'available'
				);

			foreach($invitems as $inv){
				$inventory->update(array('_id'=>$inv['_id']),array('$set'=>$set));
			}

			$id = str_replace('#', '', $id);

			$mycart = $carts->get(array('_id'=>$cart['_id']));

			$qty = 0;

			foreach($mycart['items'] as $key=>$val){
				foreach($val as $k=>$v){
					$qty += $v['actual'];
				}
			}

			$counter = $qty;

			return Response::json(array('result'=>'OK','message'=>'Item removed', 'prices'=>$prices,'row'=>$id.'_row','cartcount'=>$counter ));
		}else{
			return Response::json(array('result'=>'ERR','message'=>'Failed to remove item'));
		}
	}

	public function post_updateqty()
	{

		$in = Input::get();
		$c = explode('_', $in['id']);

		$productId = $c[0];
		$size = $c[1];
		$color = $c[2];

		$qty = $in['qty'];

		$cart = $this->getCurrentCart();

		//print_r($cart);

		$currentorder = $cart['items'][$productId][$size.'_'.$color]['ordered'];
		$currentqty = $cart['items'][$productId][$size.'_'.$color]['actual'];

		/*
		print $qty."\r\n";
		print $currentorder."\r\n";
		print $currentqty."\r\n";
		*/
		$inventory = new Inventory();

		if($qty < $currentqty){

			//release some items

			$query = array(
				'productId'=>new MongoId($productId),
				'color'=>$color,
				'size'=>$size,
				'cartId'=>$cart['_id']
			);

			$invs = $inventory->find($query);

			$set = array(
				'cartId'=>'',
				'status'=>'available'
				);

			$removed = $currentqty - $qty;

			for($i = 0;$i < $removed;$i++){
				$inv = array_pop($invs);
				$inventory->update(array('_id'=>$inv['_id']),array('$set'=>$set));
			}

			$aquery = array(
				'productId'=>$query['productId'],
				'cartId'=>$cart['_id'],
				'status'=>'incart',
				'size'=>$size,
				'color'=>$color
			);

			$actual = $inventory->find($aquery);

			$actual_count = $inventory->count($aquery);

			if($cart){
				$cart['items'][$productId][$size.'_'.$color]['ordered'] = $qty;
				$cart['items'][$productId][$size.'_'.$color]['actual'] = $actual_count;
			}

			//print_r($cart);

			$prices = $this->recalculate($cart);

			$carts = new Cart();

			$upcart = $carts->update(array('_id'=>$cart['_id']),array('$set'=>array('items'=>$cart['items'],'prices'=>$prices)),array('upsert'=>true));

			if($upcart){

				$mycart = $carts->get(array('_id'=>$cart['_id']));

				$qty = 0;

				foreach($mycart['items'] as $key=>$val){
					foreach($val as $k=>$v){
						$qty += $v['actual'];
					}
				}

				$counter = $qty;

				return Response::json(array('result'=>'OK:ITEMREMOVED','message'=>$removed.' items removed from current order','prices'=>$prices,'cartcount'=>$counter));
			}else{
				return Response::json(array('result'=>'ERR','message'=>'Fail to update quantity'));
			}
		}elseif($qty > $currentqty){
			// check next available
			$added = $qty - $currentqty;

			//print $added;

			//exit();
			//print_r($cart);

			$item['productId'] = $productId;
			$item['color'] = $color;
			$item['size'] = $size;
			//$item['cartId'] = $cart['_id'];

	    	$result = $this->addToCart($cart,$item,$added);

			$prices = $this->recalculate($result);
	    	//print_r($result);

			$carts = new Cart();

			$upcart = $carts->update(array('_id'=>$result['_id']),array('$set'=>array('items'=>$result['items'],'prices'=>$prices)),array('upsert'=>true));

			if($upcart){

				$mycart = $carts->get(array('_id'=>$cart['_id']));

				$qty = 0;

				foreach($mycart['items'] as $key=>$val){
					foreach($val as $k=>$v){
						$qty += $v['actual'];
					}
				}

				$counter = $qty;

				return Response::json(array('result'=>'OK:ITEMADDED','message'=>$added.' items added to current order','prices'=>$prices,'cartcount'=>$counter));
			}else{
				return Response::json(array('result'=>'ERR','message'=>'Fail to update quantity'));
			}

		}elseif($qty == $currentqty){
			return Response::json(array('result'=>'NOCHANGES'));
		}

	}

	public function recalculate($cart)
	{
		$product = new Product();

		$prices = array();

		$total_due = 0;

		if(count($cart['items']) > 0){

			foreach ($cart['items'] as $key => $val) {

				$prod = $product->get(array('_id'=>new MongoId($key)));

				foreach($val as $k=>$v){
					$kx = str_replace('#', '', $k);
					$prices[$key][$k]['unit_price'] = $prod['retailPrice'];
					$prices[$key][$k]['unit_price_fmt'] = $prod['priceCurrency'].' '.number_format($prod['retailPrice'],2,',','.');

					$subtotal = $prod['retailPrice']*$v['actual'];

					$prices[$key][$k]['sub_total_price'] = $subtotal;
					$prices[$key][$k]['sub_total_price_fmt'] = $prod['priceCurrency'].' '.number_format($subtotal,2,',','.');
					$prices[$key.'_'.$kx.'_sub']['sub_total_price_fmt'] = $prod['priceCurrency'].' '.number_format($subtotal,2,',','.');

					$total_due += $subtotal;
				}

			}

			$prices['total_due'] = $total_due;
			$prices['total_due_fmt'] = $prod['priceCurrency'].' '.number_format($total_due,2,',','.');

			$shipping = 0;
			$prices['shipping'] = $shipping;
			$prices['shipping_fmt'] = $prod['priceCurrency'].' '.number_format($shipping,2,',','.');

			$total_billing = $total_due + $shipping;
			$prices['total_billing'] = $total_billing;
			$prices['total_billing_fmt'] = $prod['priceCurrency'].' '.number_format($total_billing,2,',','.');


		}else{

			$prices['total_due'] = 0;
			$prices['total_due_fmt'] = '-';

			$shipping = 0;
			$prices['shipping'] = $shipping;
			$prices['shipping_fmt'] = '-';

			$total_billing = $total_due + $shipping;
			$prices['total_billing'] = $total_billing;
			$prices['total_billing_fmt'] = '-';

		}



		return $prices;
	}

	public function post_signin()
	{
		$in = Input::get();

	    $username = Input::get('username');
	    $password = Input::get('password');

	    $item['color'] = $in['color'];
	    $item['size'] = $in['size'];
	    $item['productId'] = $in['_id'];

	    $qty = $in['qty'];

	    if ( $userdata = Auth::shopperattempt(array('username'=>$username, 'password'=>$password)) )
	    {

	    	if(Auth::shopper()->activeCart == ''){
	    		$cart = $this->newCart();
	    	}else{
	    		$cart = $this->getCurrentCart();
	    	}

	    	$result = $this->addToCart($cart,$item,$qty);

			//print_r($result);


			$prices = $this->recalculate($result);
	    	//print_r($result);

			$carts = new Cart();

			$upcart = $carts->update(array('_id'=>$result['_id']),array('$set'=>array('items'=>$result['items'],'prices'=>$prices)),array('upsert'=>true));

			if($upcart){

				$mycart = $carts->get(array('_id'=>$cart['_id']));

				$qty = 0;

				foreach($mycart['items'] as $key=>$val){
					foreach($val as $k=>$v){
						$qty += $v['actual'];
					}
				}

				$counter = $qty;

				return Response::json(array('result'=>'OK:ITEMADDED','message'=>'Successfully Signed In and Product Added','prices'=>$prices,'cartcount'=>$counter));
			}else{
				return Response::json(array('result'=>'ERR','message'=>'Fail to update quantity'));
			}


		//	return Response::json(array('result'=>'PRODUCTADDED','message'=>'Successfully Signed In and Product Added','data'=>$cart));
	    }
	    else
	    {
			return Response::json(array('result'=>'FAILEDSIGNEDIN','message'=>'You are not signed in'));
	    }

	}

	private function addToCart($cartobj, $item, $qty)
	{
		$carts = new Cart();

		$inventory = new Inventory();

		$query = $item;

		$query['status'] = 'available';
		$query['productId'] = new MongoId($query['productId']);

		$pagelength = $qty;
		$pagestart = 0;

		$limit = array($pagelength, $pagestart);

		$invitem = $inventory->find($query,array(),array('createdDate'=>1),$limit);

		$item_ids = array_keys($invitem);

		$up = array();

		foreach ($item_ids as $key) {
			$up[] = array('_id'=>new MongoId($key));

			$setinv = $inventory->update(array('_id'=>new MongoId($key),'status'=>'available'),
				array(
					'$set'=>array(
						'status'=>'incart',
						'cartId'=>$cartobj['_id']
					)
				)
			);
		}

		$aquery = array('productId'=>$query['productId'],
			'cartId'=>$cartobj['_id'],
			'status'=>'incart',
			'size'=>$item['size'],
			'color'=>$item['color']);

		$actual = $inventory->find($aquery);

		$actual_count = $inventory->count($aquery);

		if(isset($cartobj['items'][$item['productId']][$item['size'].'_'.$item['color']]['ordered'])){
		    $cartobj['items'][$item['productId']][$item['size'].'_'.$item['color']]['ordered'] += $qty;
		}else{
		    $cartobj['items'][$item['productId']][$item['size'].'_'.$item['color']]['ordered'] = $qty;
		}
	    $cartobj['items'][$item['productId']][$item['size'].'_'.$item['color']]['actual'] = $actual_count;

	    return $cartobj;

	}

	private function removeFromCart($cartobj, $item, $qty)
	{
		$carts = new Cart();

	}

	private function getCurrentCart(){

		$carts = new Cart();

		$cart_id = Auth::shopper()->activeCart;

		$cart = $carts->get(array('_id'=>new MongoId($cart_id) ));

		return $cart;
	}

	private function newCart()
	{
		$thecart = array();
		$thecart['shopper_id'] = Auth::shopper()->id;
		$thecart['items'] = array();
		$thecart['createdDate'] = new MongoDate();
		$thecart['lastUpdate'] = new MongoDate();
		$thecart['cartStatus'] = 'open';
		$thecart['buyerDetail'] = Auth::shopper();
		$thecart['confirmationCode'] = '';

		$cart = new Cart();

		if($newcart = $cart->insert($thecart,array('upsert'=>true))){

			$shopper = new Shopper();

			$_id = new MongoId(Auth::shopper()->id);

			$shopper->update(array('_id'=>$_id),
				array('$set'=>array('activeCart'=>$newcart['_id']->__toString() )),
				array('upsert'=>true)
				);

			return $newcart;
		}else{
			return false;
		}

	}

	public function get_cart(){

		//$this->filter('before','auth');
		/*
		if(Auth::shoppercheck() == false){
			return Redirect::to('signin');
		}
		*/

		$form = new Formly();

		$active_cart = new MongoId(Auth::shopper()->activeCart);

		$carts = new Cart();

		$cart = $carts->get(array('_id'=>$active_cart));

		if( is_array($cart) && count($cart['items']) > 0){
			$or = array();

			$qty = 0;

			foreach($cart['items'] as $key=>$val){
				$or[] = array('_id'=>new MongoId($key));

				foreach($val as $k=>$v){
					$qty += $v['actual'];
				}

			}

			$prods = new Product();

			$products = $prods->find(array('$or'=>$or));

			$prices = $this->recalculate($cart);

			$carts->update(array('_id'=>$active_cart),array('$set'=>array('prices'=>$prices)));

			if($qty == 0){
				$cart = null;
			}
		}else{
			$cart = null;
			$prices = null;
			$products = null;
		}

		return View::make('shop.cart')
			->with('ajaxsource',URL::to('shop/cartloader'))
			->with('ajaxdel',URL::to('shop/itemdel'))
			->with('products',$products)
			->with('prices',$prices)
			->with('cart',$cart)
			->with('form',$form);
	}

	public function post_checkout()
	{
		//print_r(Input::get());
		$this->filter('before','auth');

		$form = new Formly();

		$in = Input::get();

		$active_cart = new MongoId($in['cartId']);

		$carts = new Cart();

		$cart = $carts->get(array('_id'=>$active_cart));

		$or = array();
		foreach($cart['items'] as $key=>$val){
			$or[] = array('_id'=>new MongoId($key));
		}

		$prods = new Product();

		$products = $prods->find(array('$or'=>$or));

		$shippingFee = 30000;

		return View::make('shop.checkout')
			->with('ajaxsource',URL::to('shop/cartloader'))
			->with('ajaxdel',URL::to('shop/itemdel'))
			->with('postdata',$in)
			->with('products',$products)
			->with('shippingFee',$shippingFee)
			->with('cart',$cart)
			->with('form',$form);

	}

	public function post_commit()
	{
		//print_r(Input::get());
		$this->filter('before','auth');

		$form = new Formly();

		$in = Input::get();

		$shoppers = new Shopper();

		$active_cart = new MongoId($in['cartId']);

		$carts = new Cart();

		$cart = $carts->get(array('_id'=>$active_cart));

		$or = array();

		foreach($cart['items'] as $key=>$val){
			$or[] = array('_id'=>new MongoId($key));
		}

		$prods = new Product();

		$products = $prods->find(array('$or'=>$or));

		$shippingFee = 30000;

		$confirmcode = strtoupper(Str::random(8, 'alpha'));

		if(isset($cart['confirmationCode']) && $cart['confirmationCode'] != ''){
			$confirmcode = strtoupper($cart['confirmationCode']);
		}else{
			$carts->update(array('_id'=>$active_cart),array('$set'=>array( 'cartStatus'=>'checkedout','confirmationCode'=>$confirmcode, 'lastUpdate'=>new MongoDate() )));
		}


		$cart = $carts->get(array('_id'=>$active_cart));

		$shoppers->update(array('_id'=>new MongoId(Auth::shopper()->id)),
			array('$set'=>array('activeCart'=>'','prevCart'=>$in['cartId'] )),
			array('upsert'=>true) );

		Event::fire('commit.checkout',array(Auth::shopper()->id,$in['cartId']));

		return View::make('shop.commit')
			->with('postdata',$in)
			->with('products',$products)
			->with('shippingFee',$shippingFee)
			->with('cart',$cart)
			->with('form',$form);

	}

	public function get_confirm(){

		$form = new Formly();

		return View::make('shop.confirm')
			->with('form',$form);
	}

	public function post_confirm(){

		$validator = array(
				'confirmationCode'=>'required',
				'email'=>'required',
				'destinationBank'=>'required',
				'transferDate'=>'required',
				'transferAmount'=>'required',
				'sourceBank'=>'required',
				'sourceAcc'=>'required',
				'sourceAccName'=>'required'
			);

	    $validation = Validator::make($input = Input::all(), $validator);

	    if($validation->fails()){
	    	return Redirect::to('shop/confirm')->with_errors($validation)->with_input(Input::all());
	    }else{

			$form = new Formly();

			$in = Input::get();

			//print_r($in);

			//exit();

			$carts = new Cart();

			$cart = $carts->get(array( 'confirmationCode'=>strtoupper($in['confirmationCode']) ));


			if($cart){

				if($cart['cartStatus'] != 'confirmed'){

					$carts->update(array('_id'=>$cart['_id']),array('$set'=>array( 'cartStatus'=>'confirmed', 'lastUpdate'=>new MongoDate() )));

					$confirmations = new Confirmation();

					$in['createdDate'] = new MongoDate();

					$conobj = $confirmations->insert($in);

				/*
					$shoppers->update(array('_id'=>new MongoId(Auth::shopper()->id)),
						array('$set'=>array('activeCart'=>'','prevCart'=>$in['cartId'] )),
						array('upsert'=>true) );
				*/
					$confirmationCode = $in['confirmationCode'];

					Event::fire('payment.confirm',array($confirmationCode));

					return View::make('shop.confirmed')
						->with('title','Konfirmasi Berhasil');

				}else if($cart['cartStatus'] == 'confirmed'){

					return View::make('shop.alreadyconfirmed')
						->with('title','Pembayaran Telah Terkonfirmasi');

				}


			}else{
				return View::make('shop.confirmfail')
					->with('title','Konfirmasi Gagal');

			}

	    }

	}

}