<?php

class Response extends Laravel\Response {
	/**
	 * Create a new JSON response.
	 *
	 * <code>
	 *		// Create a response instance with JSON
	 *		return Response::json($data, 200, array('header' => 'value'));
	 * </code>
	 *
	 * @param  mixed     $data
	 * @param  int       $status
	 * @param  array     $headers
	 * @return Response
	 */
	public static function png($data, $status = 200, $headers = array())
	{
		$headers['Content-Type'] = 'image/png';

		return new static($data, $status, $headers);
	}
}

?>
