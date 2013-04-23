<?php

class Export_Controller extends Base_Controller {

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

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');

		$this->crumb->add('import','Export Data');
	}

	public function get_index()
	{

		$form = new Formly();

		return View::make('export.export')
			->with('title','Export Data')
			->with('form',$form)
			->with('crumb',$this->crumb);
	}

	public function post_index(){

		$criteria = Input::get();

		if($criteria['daterange'] == 'creation'){
			$rules = array(
		        'collection'  => 'required',
		        'fromDate' => 'required',
		        'toDate' => 'required'
		    );
		}else{
			$rules = array(
		        'collection'  => 'required',
		    );
		}

	    $validation = Validator::make($input = Input::all(), $rules);

	    if($validation->fails()){

	    	return Redirect::to('export')->with_errors($validation)->with_input(Input::all());

	    }else{

			switch($criteria['collection']){
				case 'attendee' :
					$dataset = new Attendee();
					break;
				case 'visitor' :
					$dataset = new Attendee();
					break;
				case 'official' :
					$dataset = new Official();
					break;
				case 'exhibitor' :
					$dataset = new Exhibitor();
					break;
			}

			if($criteria['daterange'] == 'all'){
				$dataresult = $dataset->find(array(),array(),array('regsequence'=> -1));
			}else if($criteria['daterange'] == 'creation'){

				$dateFrom = new MongoDate(strtotime($criteria['fromDate']." 00:00:00"));
				$dateTo = new MongoDate(strtotime($criteria['toDate']." 23:59:59"));
				$dataresult = $dataset->find(array('createdDate'=>array('$gte'=>$dateFrom,'$lte'=>$dateTo)),array(),array('regsequence'=> -1));
			}

			if($criteria['format'] == 'csv'){

				$filename = date('Ymd_his',time()).'_'.$criteria['collection'].'.csv';

				$header['Cache-Control'] = "must-revalidate, post-check=0, pre-check=0";
				$header['Content-Description'] = "File Transfer";
				$header['Content-type'] = "text/csv";
				$header['Content-Disposition'] = "attachment; filename=".$filename;
				$header['Expires'] = "0";
				$header['Pragma'] = "public";

				$dataheader = Config::get('eventreg.'.$criteria['collection'].'_csv_template');

				$dataheader = array_keys($dataheader);

				for($i = 0; $i < count($dataheader);$i++){
					$first_row[$i] = '"'.$dataheader[$i].'"';
				}

				$first_row = implode(',',$first_row);

				//print $first_row;

				$result = array();
				$result[] = $first_row; // add the header

				foreach($dataresult as $row){
					$inrow = array();
					for($i = 0; $i < count($dataheader); $i++){
						
						//regfee
						$regtype = $row['regtype'];
						$feeregtype = Config::get('eventreg.convetionfee');
						

						if($regtype == 'PD'){
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[33]] =strval($row['regPD']);
							}else{
								$row[$dataheader[33]] ='';
							}
							$row[$dataheader[34]] ='';
							$row[$dataheader[35]] ='';
							$row[$dataheader[36]] ='';

						}elseif ($regtype == 'PO') {
							$row[$dataheader[33]] ='';
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[34]] =strval($row['regPO']);
							}else{
								$row[$dataheader[34]] ='';
							}
							$row[$dataheader[35]] ='';
							$row[$dataheader[36]] ='';
						}elseif ($regtype == 'SD') {
							$row[$dataheader[33]] ='';
							$row[$dataheader[34]] ='';
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[35]] =strval($row['regSD']);
							}else{
								$row[$dataheader[35]] ='';
							}
							$row[$dataheader[36]] ='';
						}elseif ($regtype == 'SO') {
							$row[$dataheader[33]] ='';
							$row[$dataheader[34]] ='';
							$row[$dataheader[35]] ='';
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[36]] =strval($row['regSO']);
							}else{
								$row[$dataheader[36]] ='';
							}
							
						}



						//FOC
						if($row['conventionPaymentStatus']=='free'){
							$row[$dataheader[37]] ='Yes';
						}else{
							$row[$dataheader[37]] ='No';
						}
						
						$row[$dataheader[40]] = strval($row['totalIDR']);
						$row[$dataheader[41]] = strval($row['totalUSD']);

						//PIC
						$haspic = $row['cache_id'];

						if($haspic!=''){
							//find pic details
							$pic = new import();
							$picMongoID = new MongoId($haspic);
							$picobjc = $pic->get(array('_id'=>$picMongoID));
							$row[$dataheader[42]] =$picobjc['salutation'];
							$row[$dataheader[43]] =$picobjc['firstname'];
							$row[$dataheader[44]] =$picobjc['lastname'];
							$row[$dataheader[45]] =$picobjc['position'];
							$row[$dataheader[46]] =$picobjc['company'];
							$row[$dataheader[47]] =$picobjc['email'];
							$row[$dataheader[48]] =$picobjc['mobile'];
							if(isset($picobjc['address_1'])){
								$row[$dataheader[49]] =$picobjc['address_1'];
							}else{
								$row[$dataheader[49]] =$picobjc['address'];
							}
							if(isset($picobjc['address_1'])){
								$row[$dataheader[50]] =$picobjc['address_2'];
							}else{
								$row[$dataheader[50]]='';
							}
							$row[$dataheader[51]] =$picobjc['city'];
							$row[$dataheader[52]] =$picobjc['zip'];
							$row[$dataheader[53]] =$picobjc['country'];
							if(isset($picobjc['address_1'])){
								$row[$dataheader[54]] =$picobjc['groupName'];
							}
						}

						if($row['golf']=='Yes'){
								$golffee = strval(2500000);
								$row[$dataheader[39]] = $golffee;
						}else{
							$row[$dataheader[39]] = '';
						}

						if($row['conventionPaymentStatus']=='free'){
							$row[$dataheader[40]] = '';
							$row[$dataheader[41]] = '';

						}
						$a = $row['mobile'];
						$b = (string)$a;
						$row[$dataheader[6]] = (string)'::'.$b;

						if(isset($row[$dataheader[$i]])){

							$inrow[$i] = '"'.$row[$dataheader[$i]].'"';


						}else{
							$inrow[$i] = '""';
						}

						
					}					
					$result[] = implode(',',$inrow);
				}

				//$dataresult = serialize($dataresult);
				//$result = Formatter::make($dataresult,'serialize')->to_csv();

				//print_r($result);

				$result = implode("\r\n",$result);
				return Response::make($result,'200',$header);
			}



	    }

	}

	public function get_report(){


		$dataset = new Attendee();
		$collection = 'attendee';

		//$dataresult = $dataset->find(array('createdDate'=>array('$gte'=>$dateFrom,'$lte'=>$dateTo)));
		
		//all
		if(isset($_GET['type'])){
			$type = $_GET['type'];
			if($type == 'all'){
				$dataresult = $dataset->find();
			}else{
				$condition  = array('regtype'=>$type);
				$dataresult = $dataset->find($condition, array(), array(),array());
			}
		}

		if(isset($_GET['payment'])){
			$paymentstatus = $_GET['payment'];
			$condition  = array('conventionPaymentStatus'=>$paymentstatus);
			$dataresult = $dataset->find($condition, array(), array(),array());
			
		}

		if(isset($_GET['golf'])){

			$condition  = array('golf'=>'Yes');
			$dataresult = $dataset->find($condition, array(), array(),array());
			
		}

		if(isset($_GET['dinner'])){

			$condition  = array('attenddinner'=>'Yes');
			$dataresult = $dataset->find($condition, array(), array(),array());
			
		}

		if(isset($_GET['country'])){
			$country =$_GET['country'];
			$condition  = array('country'=>$country);
			$dataresult = $dataset->find($condition, array(), array(),array());
			
		}

		

		if(isset($dataresult)){

			$filename = date('Ymd_his',time()).'_'.$collection.'.csv';

			$header['Cache-Control'] = "must-revalidate, post-check=0, pre-check=0";
			$header['Content-Description'] = "File Transfer";
			$header['Content-type'] = "text/csv";
			$header['Content-Disposition'] = "attachment; filename=".$filename;
			$header['Expires'] = "0";
			$header['Pragma'] = "public";

			$dataheader = Config::get('eventreg.'.$collection.'_csv_template');

			$dataheader = array_keys($dataheader);

			for($i = 0; $i < count($dataheader);$i++){
				$first_row[$i] = '"'.$dataheader[$i].'"';
			}

			$first_row = implode(',',$first_row);

			//print $first_row;

			$result = array();
			$result[] = $first_row; // add the header

			foreach($dataresult as $row){
				$inrow = array();
				for($i = 0; $i < count($dataheader); $i++){

						//regfee
						$regtype = $row['regtype'];
						$feeregtype = Config::get('eventreg.convetionfee');
						

						if($regtype == 'PD'){
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[33]] =strval($row['regPD']);
							}else{
								$row[$dataheader[33]] ='';
							}
							$row[$dataheader[34]] ='';
							$row[$dataheader[35]] ='';
							$row[$dataheader[36]] ='';

						}elseif ($regtype == 'PO') {
							$row[$dataheader[33]] ='';
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[34]] =strval($row['regPO']);
							}else{
								$row[$dataheader[34]] ='';
							}
							$row[$dataheader[35]] ='';
							$row[$dataheader[36]] ='';
						}elseif ($regtype == 'SD') {
							$row[$dataheader[33]] ='';
							$row[$dataheader[34]] ='';
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[35]] =strval($row['regSD']);
							}else{
								$row[$dataheader[35]] ='';
							}
							$row[$dataheader[36]] ='';
						}elseif ($regtype == 'SO') {
							$row[$dataheader[33]] ='';
							$row[$dataheader[34]] ='';
							$row[$dataheader[35]] ='';
							if($row['conventionPaymentStatus']!='free'){
								$row[$dataheader[36]] =strval($row['regSO']);
							}else{
								$row[$dataheader[36]] ='';
							}
							
						}



						//FOC
						if($row['conventionPaymentStatus']=='free'){
							$row[$dataheader[37]] ='Yes';
						}else{
							$row[$dataheader[37]] ='No';
						}
						
						$row[$dataheader[40]] = strval($row['totalIDR']);
						$row[$dataheader[41]] = strval($row['totalUSD']);
						
						

						//PIC
						$haspic = $row['cache_id'];

						if($haspic!=''){
							//find pic details
							$pic = new import();
							$picMongoID = new MongoId($haspic);
							$picobjc = $pic->get(array('_id'=>$picMongoID));
							$row[$dataheader[42]] =$picobjc['salutation'];
							$row[$dataheader[43]] =$picobjc['firstname'];
							$row[$dataheader[44]] =$picobjc['lastname'];
							$row[$dataheader[45]] =$picobjc['position'];
							$row[$dataheader[46]] =$picobjc['company'];
							$row[$dataheader[47]] =$picobjc['email'];
							$row[$dataheader[48]] =$picobjc['mobile'];
							if(isset($picobjc['address_1'])){
								$row[$dataheader[49]] =$picobjc['address_1'];
							}else{
								$row[$dataheader[49]] =$picobjc['address'];
							}
							if(isset($picobjc['address_1'])){
								$row[$dataheader[50]] =$picobjc['address_2'];
							}else{
								$row[$dataheader[50]]='';
							}
							$row[$dataheader[51]] =$picobjc['city'];
							$row[$dataheader[52]] =$picobjc['zip'];
							$row[$dataheader[53]] =$picobjc['country'];
							if(isset($picobjc['address_1'])){
								$row[$dataheader[54]] =$picobjc['groupName'];
							}
						}

						if($row['golf']=='Yes'){
								$golffee = strval(2500000);
								$row[$dataheader[39]] = $golffee;
						}else{
							$row[$dataheader[39]] = '';
						}

						



					if(isset($row[$dataheader[$i]])){
						if(is_float($row[$dataheader[$i]]) || is_double($row[$dataheader[$i]]) || is_long($row[$dataheader[$i]]) || is_integer($row[$dataheader[$i]])){
							$row[$dataheader[$i]] = (string) $row[$dataheader[$i]];
							$inrow[$i] = '"\''.$row[$dataheader[$i]].'"';
						}else{
							$inrow[$i] = '"'.$row[$dataheader[$i]].'"';
						}
					}else{
						$inrow[$i] = '""';
					}
				}					
				$result[] = implode(',',$inrow);
			}

			//$dataresult = serialize($dataresult);
			//$result = Formatter::make($dataresult,'serialize')->to_csv();

			//print_r($result);

			$result = implode("\r\n",$result);
			return Response::make($result,'200',$header);
		}

	}


	public function get_reportbycompany(){


		$dataset = new Attendee();
		$collection = 'attendee';

		//$dataresult = $dataset->find(array('createdDate'=>array('$gte'=>$dateFrom,'$lte'=>$dateTo)));
		$dataresult = $dataset->find(array(), array(), array(),array());
		$companies = $dataset->distinct('company');
		

		if(isset($dataresult)){

			$filename = date('Ymd_his',time()).'_'.$collection.'.csv';

			$header['Cache-Control'] = "must-revalidate, post-check=0, pre-check=0";
			$header['Content-Description'] = "File Transfer";
			$header['Content-type'] = "text/csv";
			$header['Content-Disposition'] = "attachment; filename=".$filename;
			$header['Expires'] = "0";
			$header['Pragma'] = "public";

			$dataheader = 
			array(
				//new template
				'NO'=> '',
				'COMPANY'=> '',
				'PERSONS'=> '',
				'COUNTRY'=> ''
			);

			$dataheader = array_keys($dataheader);

			for($i = 0; $i < count($dataheader);$i++){
				$first_row[$i] = '"'.$dataheader[$i].'"';
			}

			$first_row = implode(',',$first_row);

			//print $first_row;

			//print $first_row;

			$result = array();
			$result[] = $first_row; // add the header

			foreach($companies as $row){
				$inrow = array();
				for($i = 0; $i < count($dataheader); $i++){
	
					$row[$dataheader[0]] = 1;
					$row[$dataheader[1]] = '';
					$row[$dataheader[2]] = '';
					
					if(isset($row[$dataheader[$i]])){
						if(is_float($row[$dataheader[$i]]) || is_double($row[$dataheader[$i]]) || is_long($row[$dataheader[$i]]) || is_integer($row[$dataheader[$i]])){
							$row[$dataheader[$i]] = (string) $row[$dataheader[$i]];
							$inrow[$i] = '"\''.$row[$dataheader[$i]].'"';
						}else{
							$inrow[$i] = '"'.$row[$dataheader[$i]].'"';
						}
					}else{
						$inrow[$i] = '""';
					}
				}					
				$result[] = implode(',',$inrow);
			}


			$result = implode("\r\n",$result);
			return Response::make($result,'200',$header);
		}

	}


	public function get_boothassistant($boothassistantdata_id,$exhibitorid){

		$boothassistantdata = new Boothassistant();
		$ex = new Exhibitor();
		$booths = new Booth();
		$formData = new Operationalform();


		
		$_id = new MongoId($boothassistantdata_id);
		$_exhibitorid = new MongoId($exhibitorid);

		//find user first
		$data = $boothassistantdata->get(array('_id'=>$_id));
		$exhibitor = $ex->get(array('_id'=>$_exhibitorid));
		$user_form = $formData->get(array('userid'=>$exhibitorid));

		$booth = '';


		if(isset($exhibitor['boothid'])){
			$_boothID = new MongoId($exhibitor['boothid']);
			$booth = $booths->get(array('_id'=>$_boothID));
		}

		$freepasscount = 0;
		$boothassistantcount = 0;
		$addboothassistantcount = 0;
		
		$pass = $booth['freepassslot'];

		if(isset($exhibitor['overridefreepassname'])){
			$pass = $exhibitor['overridefreepassname'];
		}else{
			$pass = $pass;
		}

		for($i=1;$i<$pass+1;$i++){
			if(isset($data['freepassname'.$i.''])){
		  		$freepasscount++;
			}
		}

		for($i=1;$i<11;$i++){
		    if(isset($data['boothassistant'.$i.''])){
		      $boothassistantcount++;
		    }
		}

		for($i=1;$i<=$user_form['totaladdbooth'];$i++){
		  	if(isset($data['addboothname'.$i.''])){
		      $addboothassistantcount++;
		    }
		}

		//return View::make('print.exhibitorbadgeall')
		
		//->with('profile',$data)
		//->with('booth',$booth)
		//->with('exhibitorid',$exhibitorid)
		//->with('exhibitor',$exhibitor);

		$filename = 'Boothassistantdata_'.$exhibitor['company'].'_'.date('Ymd_his',time()).'.csv';

		$header['Cache-Control'] = "must-revalidate, post-check=0, pre-check=0";
		$header['Content-Description'] = "File Transfer";
		$header['Content-type'] = "text/csv";
		$header['Content-Disposition'] = "attachment; filename=".$filename;
		$header['Expires'] = "0";
		$header['Pragma'] = "public";

		
		$result[] = 'Registration Number :'.$exhibitor['registrationnumber'];
		$result[] = 'Company :'.$exhibitor['company'];
		$result[] = 'Hall :'.$exhibitor['hall'];
		$result[] = 'Booth :'.$exhibitor['booth'];
		$result[] = '';
		$result[] = '';
		$result[] = '';
		$result[] = 'EXHIBITOR PASS HOLDERS (FREE)';
		$result[] = '';
		
		

		for($i=1;$i<=$freepasscount;$i++){
			$inarray[0] = $i;
			$inarray[1] = $data['freepassname'.$i.''];
			$inarray[2] = $data['freepassname'.$i.'regnumber'];
			$result[] = implode(',',$inarray);
		}

		$result[] = '';
		$result[] = 'FREE ADDITIONAL EXHIBITOR PASS HOLDERS';
		$result[] = '';

		
		for($i=1;$i<=$boothassistantcount;$i++){
			$inarray[0] = $i;
			$inarray[1] = $data['boothassistant'.$i.''];
			$inarray[2] = $data['boothassistant'.$i.'regnumber'];
			$result[] = implode(',',$inarray);
		}

		$result[] = '';
		$result[] = 'ADDITIONAL EXHIBITOR PASS (PAYABLE)';
		$result[] = '';

		
		for($i=1;$i<=$addboothassistantcount;$i++){
			$inarray[0] = $i;
			$inarray[1] = $data['addboothname'.$i.''];
			$inarray[2] = $data['addboothname'.$i.'regnumber'];
			$result[] = implode(',',$inarray);
		}


		


		$result = implode("\r\n",$result);
		return Response::make($result,'200',$header);
	    

	}


	public function get_allboothassistant(){

		$boothassistantdata = new Boothassistant();

		

		$filename = 'Boothassistantdata_'.date('Ymd_his',time()).'.csv';

		$header['Cache-Control'] = "must-revalidate, post-check=0, pre-check=0";
		$header['Content-Description'] = "File Transfer";
		$header['Content-type'] = "text/csv";
		$header['Content-Disposition'] = "attachment; filename=".$filename;
		$header['Expires'] = "0";
		$header['Pragma'] = "public";

		$dataresult = $boothassistantdata->find(array(),array(),array());
		
		foreach ($dataresult as $data) {

			$result[] = 'Company :'.$data['companyname'];
			$result[] = 'Hall :'.$data['hallname'];
			$result[] = 'Booth :'.$data['boothname'];
			$result[] = '';
			$result[] = 'EXHIBITOR PASS HOLDERS (FREE)';
			$result[] = '';
			
			for($i=1;$i<=10;$i++){
				if(isset($data['freepassname'.$i.''])){
					$inarray[0] = $i;
					$inarray[1] = $data['freepassname'.$i.''];
					$inarray[2] = $data['freepassname'.$i.'regnumber'];
					$result[] = implode(',',$inarray);
				}
			}

			$result[] = '';
			$result[] = 'FREE ADDITIONAL EXHIBITOR PASS HOLDERS';
			$result[] = '';

			
			for($i=1;$i<=10;$i++){
				if(isset($data['boothassistant'.$i.''])){
					$inarray[0] = $i;
					$inarray[1] = $data['boothassistant'.$i.''];
					$inarray[2] = $data['boothassistant'.$i.'regnumber'];
					$result[] = implode(',',$inarray);
				}
			}

			$result[] = '';
			$result[] = 'ADDITIONAL EXHIBITOR PASS (PAYABLE)';
			$result[] = '';

			
			for($i=1;$i<=10;$i++){
				if(isset($data['addboothname'.$i.''])){
					$inarray[0] = $i;
					$inarray[1] = $data['addboothname'.$i.''];
					$inarray[2] = $data['addboothname'.$i.'regnumber'];
					$result[] = implode(',',$inarray);
				}
			}
			$result[] = '';
			$result[] = '';
			$result[] = '';
		}
		
		$result = implode("\r\n",$result);
		return Response::make($result,'200',$header);
	    

	}


}

?>