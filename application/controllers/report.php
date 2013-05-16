<?php

class Report_Controller extends Base_Controller {

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
		$this->crumb->add('report','Report');

		date_default_timezone_set('Asia/Jakarta');
		$this->filter('before','auth');
	}

	public function get_index()
	{

		$attendee = new Attendee();

	    $companies = $attendee->distinct('company');

	    
	    

		$stat['PO'] = $attendee->count(array('regtype'=>'PO'));

		$stat['PD'] = $attendee->count(array('regtype'=>'PD'));

		$stat['SO'] = $attendee->count(array('regtype'=>'SO'));

		$stat['SD'] = $attendee->count(array('regtype'=>'SD'));

		$stat['Attendee'] = $attendee->count();


		$stat['paidAttendee'] = $attendee->count(array('conventionPaymentStatus'=>'paid'));

		$stat['unpaidAttendee'] = $attendee->count(array('conventionPaymentStatus'=>'unpaid'));

		$stat['Golf'] = $attendee->count(array('golf'=>'Yes'));
		$stat['Dinner'] = $attendee->count(array('attenddinner'=>'Yes'));
		$country = Config::get('country.countries');
		$today = date('Y-m-d');
		$getdate = $this->makeDateRange('2013-02-11', $today);
		$getCount = $this->getCountAttendee('2013-02-11', $today);
		
		foreach($companies as $key => $value){
			$companyValue[$value] = $attendee->count(array('company'=>$value));
		}

		foreach ($country as $key => $value) {
			$coutryValue[$value] = $attendee->count(array('country'=>$value));
		}

		return View::make('report.summary')
			->with('title','Report')
			->with('stat',$stat)
			->with('companies',$companies)
			->with('coutryValue',$coutryValue)
			->with('companyValue',$companyValue)
			->with('country',$country)
			->with('getdate',$getdate)
			->with('getCount',$getCount)
			
			->with('crumb',$this->crumb);
	}

	public function get_onsite(){

		$attendee = new Attendee();

	    $companies = $attendee->distinct('company');


		$stat['PO'] = $attendee->count(array('regtype'=>'PO'));

		$stat['PD'] = $attendee->count(array('regtype'=>'PD'));

		$stat['SO'] = $attendee->count(array('regtype'=>'SO'));

		$stat['SD'] = $attendee->count(array('regtype'=>'SD'));

		$stat['Attendee'] = $attendee->count();


		$stat['paidAttendee'] = $attendee->count(array('conventionPaymentStatus'=>'paid'));

		$stat['unpaidAttendee'] = $attendee->count(array('conventionPaymentStatus'=>'unpaid'));

		$stat['Golf'] = $attendee->count(array('golf'=>'Yes'));
		$stat['Dinner'] = $attendee->count(array('attenddinner'=>'Yes'));
		$country = Config::get('country.countries');
		$today = date('Y-m-d');
		$getdate = $this->makeDateRange('2013-02-11', $today);
		$getCount = $this->getCountAttendee('2013-02-11', $today);
		
		foreach($companies as $key => $value){
			$companyValue[$value] = $attendee->count(array('company'=>$value));
		}

		foreach ($country as $key => $value) {
			$coutryValue[$value] = $attendee->count(array('country'=>$value));
		}

		return View::make('report.onsite')
			->with('title','Report')
			->with('stat',$stat)
			->with('companies',$companies)
			->with('coutryValue',$coutryValue)
			->with('companyValue',$companyValue)
			->with('country',$country)
			->with('getdate',$getdate)
			->with('getCount',$getCount)
			
			->with('crumb',$this->crumb);


	}

	private function makeDateRange($strDateFrom,$strDateTo){

	  $aryRange=array();

	  $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	  $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

	  if ($iDateTo>=$iDateFrom) {
	    array_push($aryRange,date('d M',$iDateFrom)); // first entry

	    while ($iDateFrom<$iDateTo) {
	      $iDateFrom+=86400; // add 24 hours
	      array_push($aryRange,date('d M',$iDateFrom));
	    }
	  }
	  return $aryRange;
	}

	private function getCountAttendee($strDateFrom,$strDateTo){

	  $attendee = new Attendee();
	  $aryRange=array();

	  $iDateFrom=mktime(1,0,0,substr($strDateFrom,5,2),     substr($strDateFrom,8,2),substr($strDateFrom,0,4));
	  $iDateTo=mktime(1,0,0,substr($strDateTo,5,2),     substr($strDateTo,8,2),substr($strDateTo,0,4));

	  if ($iDateTo>=$iDateFrom) {
	   
	    
	    $fromDate = date('d-M-Y',$iDateFrom);
	    $toDate = date('d-M-Y',$iDateFrom);
	    $dateFrom = new MongoDate(strtotime($fromDate." 00:00:00"));
		$dateTo = new MongoDate(strtotime($toDate." 23:59:59"));

		$dataresult = $attendee->count(array('createdDate'=>array('$gte'=>$dateFrom,'$lte'=>$dateTo)));
		array_push($aryRange,$dataresult ); // first entry


	    while ($iDateFrom<$iDateTo) {
	      	$iDateFrom+=86400; // add 24 hours
			$fromDate = date('d-M-Y',$iDateFrom);
			$toDate = date('d-M-Y',$iDateFrom);
			$dateFrom = new MongoDate(strtotime($fromDate." 00:00:00"));
			$dateTo = new MongoDate(strtotime($toDate." 23:59:59"));

			$dataresult = $attendee->count(array('createdDate'=>array('$gte'=>$dateFrom,'$lte'=>$dateTo)));
			array_push($aryRange,$dataresult ); // first entry

	    }
	  }
	  return $aryRange;
	}
}

?>