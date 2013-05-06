<?php
namespace Bread;

use \HTML;

/**
 * Simple breadcrumb generation.
 *
 * @package     Bundles
 * @subpackage  Forms
 * @author      JonoB
 * @version 	1.0.2
 *
 * @see http://github.com/JonoB/flare-formly
 * @see http://twitter.github.com/bootstrap/
 */
class Crumb
{
	public $breadcrumb = array();

	public $zurb = '<ul class="breadcrumbs">';

	public $bootstrap = '<ul class="breadcrumb">';

	public function __construct($defaults = array())
	{
		array_push($this->breadcrumb, array('/','Home',true) );
	}

	public function add($segment,$label,$enable = true)
	{
		array_push($this->breadcrumb, array($segment,$label,$enable));
	}

	public function generate($framework = 'zurb',$divider = '/')
	{
		if($framework == 'zurb'){

            /*
            <ul class="breadcrumbs">
              <li><a href="#">Home</a></li>
              <li><a href="#">Features</a></li>
              <li class="unavailable"><a href="#">Gene Splicing</a></li>
              <li class="current"><a href="#">Home</a></li>
            </ul>
			*/
            $count = count($this->breadcrumb);

            $counter = 1;

            foreach ($this->breadcrumb as $segment) {

            	if($count == $counter){
	            	$segment = '<li class="current"><span>'.$segment[1].'</span></li>';
            	}else{
	            	if($segment[2] == true){
		            	$segment = '<li>'.HTML::link($segment[0],$segment[1]).'</li>';
	            	}else{
		            	$segment = '<li class="unavailable"><span>'.$segment[1].'</span></li>';
	            	} 
            	}

            	$this->zurb .= $segment;

            	$counter++;
            }
        	$this->zurb .= '</ul>';
			return $this->zurb;
		}else if($framework == 'bootstrap'){

            $count = count($this->breadcrumb);

            $counter = 1;

            foreach ($this->breadcrumb as $segment) {

            	if($count == $counter){
	            	$segment = '<li class="current"><span>'.$segment[1].'</span></li>';
            	}else{
	            	if($segment[2] == true){
		            	$segment = '<li>'.HTML::link($segment[0],$segment[1]).'<span class="divider">'.$divider.'</span></li>';
	            	}else{
		            	$segment = '<li class="unavailable"><span>'.$segment[1].'</span><span class="divider">'.$divider.'</span></li>';
	            	} 
            	}

            	$this->bootstrap .= $segment;

            	$counter++;
            }
        	$this->bootstrap .= '</ul>';
			return $this->bootstrap;

		}
	}

}

?>