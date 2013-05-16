<?php

class Feed_Controller extends Base_Controller {
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
	}

	public function get_index(){
		$feed = Feed::make();

		$feed->logo(asset('img/logo.jpg'))
		     ->icon(URL::home().'favicon.ico')
		     ->webmaster('Your Name')
		     ->author   ('Your Name')
		     ->rating('SFW')
		     ->pubdate(time())
		     ->ttl(60)
		     ->title('My App Feed')
		     ->description('Newest stuff on MyApp.com')
		     ->copyright('(c) '.date('Y').' MyApp.com')
		     ->permalink(URL::home().'/feed')
		     ->category('PHP')
		     ->language('en_EN')
		     ->baseurl(URL::home());

		// get latest 20 posts
		$posts = Post::order_by('created_at','desc')->take(20)->get();

		foreach ($posts as $post) {
		  $feed->entry()->published($post->created_at)
		                ->content()->add('text', $post->text)->up()
		                ->content()->add('html', HTML::decode($post->text).'<br><a href="'.action('posts@view', array($post->slug)).'"><img src="'.asset('uploads/'.(($post->attachment_id) ? (Upload::find($post->attachment_id)->small_filename) : "empty.jpg" )).'" /></a>')->up()
		                ->title()->add('text',$post->title)->up()
		                ->permalink(action('posts@view', array($post->slug)))
		                ->author()->name('By '.$post->author)->up()
		                ->updated($post->updated_at);
		}

		$feed->Rss20();
		// this is a shortcut for calling $feed->feed()->send(...);
		// you can also just $feed->Rss20(), Rss092() or Atom();		


	}

	public function get_atom()
	{
		$feed = Feed::make();

		$feed->logo(asset('img/logo.jpg'))
		     ->icon(URL::home().'favicon.ico')
		     ->webmaster('Your Name')
		     ->author   ('Your Name')
		     ->rating('SFW')
		     ->pubdate(time())
		     ->ttl(60)
		     ->title('My App Feed')
		     ->description('Newest stuff on MyApp.com')
		     ->copyright('(c) '.date('Y').' MyApp.com')
		     ->permalink(URL::home().'/feed')
		     ->category('PHP')
		     ->language('en_EN')
		     ->baseurl(URL::home());

		$posts = Post::order_by('created_at','desc')->take(20)->get();

		foreach ($posts as $post) {
		  $feed->entry()->title()->add('text',$post->title)->up()
		  		        ->updated($post->updated_at)
		  		       	->permalink(action('posts@view', array($post->slug)))
		                ->author()->name('By '.$post->author)->up()
		                ->content()->add('html', HTML::decode($post->text).'<br><a href="'.action('posts@view', array($post->slug)).'"><img src="'.asset('uploads/'.(($post->attachment_id) ? (Upload::find($post->attachment_id)->small_filename) : "empty.jpg" )).'" /></a>');
		}

		$feed->Atom();
	}	

	public function get_rss092()
	{
		$feed = Feed::make();

		$feed->logo(asset('img/logo.jpg'))
		     ->icon(URL::home().'favicon.ico')
		     ->webmaster('Your Name')
		     ->author   ('Your Name')
		     ->rating('SFW')
		     ->pubdate(time())
		     ->ttl(60)
		     ->title('My App Feed')
		     ->description('Newest stuff on MyApp.com')
		     ->copyright('(c) '.date('Y').' MyApp.com')
		     ->permalink(URL::home().'/feed')
		     ->category('PHP')
		     ->language('en_EN')
		     ->baseurl(URL::home());

		$posts = Post::order_by('created_at','desc')->take(20)->get();

		foreach ($posts as $post) {
		  $feed->entry()->published($post->created_at)
		                ->content()->add('text', $post->text)->up()
		                ->content()->add('html', HTML::decode($post->text).'<br><a href="'.action('posts@view', array($post->slug)).'"><img src="'.asset('uploads/'.(($post->attachment_id) ? (Upload::find($post->attachment_id)->small_filename) : "empty.jpg" )).'" /></a>')->up()
		                ->title()->add('text',$post->title)->up()
		                ->permalink(action('posts@view', array($post->slug)))
		                ->author()->name('By '.$post->author)->up()
		                ->updated($post->updated_at);
		}

		$feed->Rss092();
		// this is a shortcut for calling $feed->feed()->send(...);
		// you can also just $feed->Rss20(), Rss092() or Atom();
	}

}

