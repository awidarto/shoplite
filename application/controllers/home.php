<?php

class Home_Controller extends Base_Controller {

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

	public function action_index()
	{
		$heads = array('#','Project','Tags','Action');
		$colclass = array('one','','two','one');
		//$searchinput = array(false,'title','created','last update','creator','project manager','tags',false);
		$searchinput = array(false,'project','tags',false);

		return View::make('tables.event')
			->with('title','Events')
			->with('newbutton','New Event')
			->with('disablesort','0')
			->with('addurl','project/add')
			->with('colclass',$colclass)
			->with('searchinput',$searchinput)
			->with('ajaxsource',URL::to('project'))
			->with('ajaxdel',URL::to('project/del'))
			->with('heads',$heads);
	}

}