<?php namespace Mongovel; use Laravel\Hash as Hash, Laravel\Config as Config,Laravel\Log as Log;

class MongoAuth extends \Laravel\Auth\Drivers\Driver {

	/**
	 * Get the current user of the application.
	 *
	 * If the user is a guest, null should be returned.
	 *
	 * @param  int         $id
	 * @return mixed|null
	 */

	public function retrieve($id)
	{
		//if (filter_var($id, FILTER_VALIDATE_INT) !== false)
		//{
			$user = $this->model()->get(array('_id'=>$id));

			if(is_null($user)){
				return null;
			}else{
				$user['id'] = $user['_id']->__toString();
				unset($user['password']);
				$user = $this->array_to_object($user);
				return $user;
			}

		//}
	}

	/**
	 * Get the current attendee of the application.
	 *
	 * If the user is a guest, null should be returned.
	 *
	 * @param  int         $id
	 * @return mixed|null
	 */
	public function attendeeretrieve($id)
	{
		//if (filter_var($id, FILTER_VALIDATE_INT) !== false)
		//{
			$user = $this->attmodel()->get(array('_id'=>$id));

			if(is_null($user)){
				return null;
			}else{
				$user['id'] = $user['_id']->__toString();
				unset($user['password']);
				$user = $this->array_to_object($user);
				return $user;
			}

		//}
	}

	public function shopperretrieve($id)
	{
		//if (filter_var($id, FILTER_VALIDATE_INT) !== false)
		//{
			$user = $this->shopmodel()->get(array('_id'=>$id));

			if(is_null($user)){
				return null;
			}else{
				$user['id'] = $user['_id']->__toString();
				unset($user['password']);
				$user = $this->array_to_object($user);
				return $user;
			}

		//}
	}

	public function exhibitorretrieve($id)
	{
		//if (filter_var($id, FILTER_VALIDATE_INT) !== false)
		//{
			$user = $this->exhbmodel()->get(array('_id'=>$id));

			if(is_null($user)){
				return null;
			}else{
				$user['id'] = $user['_id']->__toString();
				unset($user['password']);
				$user = $this->array_to_object($user);
				return $user;
			}

		//}
	}

	/**
	 * Get the current user of the application.
	 *
	 * If the user is a guest, null should be returned.
	 *
	 * @return mixed|null
	 */
	public function attendee()
	{
		if ( ! is_null($this->user)) return $this->user;

		return $this->user = $this->attendeeretrieve($this->token);
	}

	public function shopper()
	{
		if ( ! is_null($this->user)) return $this->user;

		return $this->user = $this->shopperretrieve($this->token);
	}

	public function exhibitor()
	{
		if ( ! is_null($this->user)) return $this->user;

		return $this->user = $this->exhibitorretrieve($this->token);
	}

	/**
	 * Determine if the user is logged in.
	 *
	 * @return bool
	 */
	public function attendeecheck()
	{
		return ! is_null($this->attendee());
	}

	public function shoppercheck()
	{
		return ! is_null($this->shopper());
	}

	public function exhibitorcheck()
	{
		return ! is_null($this->exhibitor());
	}

	/**
	 * Attempt to log a user into the application.
	 *
	 * @param  array  $arguments
	 * @return void
	 */

	public function attempt($arguments = array())
	{
		$username = Config::get('auth.username');

		$user = $this->model()->get(array($username=>$arguments['username']));

		$passfield = Config::get('auth.password');

		// This driver uses a basic username and password authentication scheme
		// so if the credentials match what is in the database we will just
		// log the user into the application and remember them if asked.
		$password = $arguments['password'];

		if ( ! is_null($user) and Hash::check($password, $user[$passfield]))
		{
			//$user = $this->array_to_object($user);

			//Log::info('User '.$username->username.' id : '.$username->_id->toString().' Logged In');
			return $this->login($user['_id'], array_get($arguments, 'remember'));
		}


		return false;
	}

	/**
	 * Attempt to log a user into the application.
	 *
	 * @param  array  $arguments
	 * @return void
	 */

	public function attendeeattempt($arguments = array())
	{
		$username = Config::get('auth.username');

		$user = $this->attmodel()->get(array($username=>$arguments['username']));

		$passfield = Config::get('auth.password');

		// This driver uses a basic username and password authentication scheme
		// so if the credentials match what is in the database we will just
		// log the user into the application and remember them if asked.
		$password = $arguments['password'];

		if ( ! is_null($user) and Hash::check($password, $user[$passfield]))
		{

			//print_r($user);

			//$user = $this->array_to_object($user);

			//Log::info('User '.$username->username.' id : '.$username->_id->toString().' Logged In');
			return $this->login($user['_id'], array_get($arguments, 'remember'));
		}
		//else{
		//	print 'failed to login';
		//}


		return false;
	}

	public function shopperattempt($arguments = array())
	{
		$username = Config::get('auth.username');

		$user = $this->shopmodel()->get(array($username=>$arguments['username']));

		$passfield = Config::get('auth.password');

		// This driver uses a basic username and password authentication scheme
		// so if the credentials match what is in the database we will just
		// log the user into the application and remember them if asked.
		$password = $arguments['password'];

		if ( ! is_null($user) and Hash::check($password, $user[$passfield]))
		{

			//print_r($user);

			//$user = $this->array_to_object($user);

			//Log::info('User '.$username->username.' id : '.$username->_id->toString().' Logged In');
			return $this->login($user['_id'], array_get($arguments, 'remember'));
		}
		//else{
		//	print 'failed to login';
		//}


		return false;
	}


	public function exhibitorattempt($arguments = array())
	{
		$username = Config::get('auth.username');

		$user = $this->exhbmodel()->get(array($username=>$arguments['username']));

		$passfield = Config::get('auth.password');

		// This driver uses a basic username and password authentication scheme
		// so if the credentials match what is in the database we will just
		// log the user into the application and remember them if asked.
		$password = $arguments['password'];

		if ( ! is_null($user) and Hash::check($password, $user[$passfield]))
		{

			//print_r($user);

			//$user = $this->array_to_object($user);

			//Log::info('User '.$username->username.' id : '.$username->_id->toString().' Logged In');
			return $this->login($user['_id'], array_get($arguments, 'remember'));
		}
		//else{
		//	print 'failed to login';
		//}


		return false;
	}

	/**
	 * Change password.
	 *
	 * @return boolean
	 */

	public function changepass($newpass){

		$passwd = Hash::make($newpass);

		$user = $this->user();

		$passfield = Config::get('auth.password');

		if(is_null($user)){
			return false;
		}else{
			return $this->model()->update(array('email'=>$user->email), array('$set'=>array($passfield=>$passwd)));
		}

	}

	/**
	 * Check permission
	 * always return true if role is root
	 * @return boolean
	 */

	public function permit($object, $ops = 'set'){
		if($this->user->role == 'root'){
			return true;
		}else{
			return $this->user->permissions->$object->$ops;
		}
	}

	/**
	 * Check permission
	 *
	 * @return boolean
	 */

	public function role($role){
		if($this->user->role == $role){
			return true;
		}else{
			return false;
		}
	}

	/**
	 * Get a fresh model instance.
	 *
	 * @return Eloquent
	 */
	protected function model()
	{
		$model = Config::get('auth.model');

		return new $model;
	}

	/**
	 * Get a fresh model instance.
	 *
	 * @return Eloquent
	 */
	protected function attmodel()
	{
		$model = Config::get('auth.attendeemodel');

		return new $model;
	}

	protected function shopmodel()
	{
		$model = Config::get('auth.shoppermodel');

		return new $model;
	}

	protected function exhbmodel()
	{
		$model = Config::get('auth.exhibitmodel');

		return new $model;
	}

	protected function array_to_object($array) {

		$obj = json_decode(json_encode($array));

		return $obj;
	}

}

?>