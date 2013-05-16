<?php

function makerows($in,$class = array(),$ro = array()){
	$rows = array();

	$rowtemplate = '<td><input type="text" name="%s[]" value="%s" class="text %s" %s ></td>';

	foreach($in as $val){
		$row = '';
		$row = '<tr>';
		$cnt = 0;
		foreach($val as $k=>$v){
			$cls = ( count($class) > 0 && isset($class[$cnt]))?$class[$cnt]:'input-small';
			$read = ( count($ro) > 0 && isset($ro[$cnt]))?$ro[$cnt]:'readonly="readonly"';
			$row .= sprintf($rowtemplate,$k,$v,$cls,$read);
			$cnt++;
		}
		$row .= '<td><span class="btn del" style="cursor:pointer"><b class="icon-minus-alt"></b></span></td>';
		$row .= '</tr>';

		$rows[] = $row;
	}

	$rows = implode('',$rows);

	return $rows;
}

function customcombiner($keys,$val,$unit){
	$out = array();

	if(is_array($keys)){
		$counter = 0;
		foreach ($keys as $key) {
			$out[$key] = array('val'=>$val[$counter],'unit'=>$unit[$counter]);
		}
	}

	return $out;
}

function combiner($in,$keys,$types){

	$out = array();

	if(is_array($in[0])){
		$count = count($in[0]);
		$keycount = count($keys);

		if($count > 0){
			for($i = 0; $i < $count; $i++){
				$item = array();
				$kc = 0;
				foreach($keys as $k){
					if($types[$kc] == 'text'){
						$item[$k] = $in[$kc][$i];
					}else if($types[$kc] == 'checkbox'){
						$item[$k] = isset($in[$kc][$i])?$in[$kc][$i]:false;
					}
					$kc++;
				}
				$out[] = $item;
			}			
		}			
	}

	return $out;
}


function rand_string( $length ) {
	$chars = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ0123456789";	

	$size = strlen( $chars );
	$str = '';
	for( $i = 0; $i < $length; $i++ ) {
		$str .= $chars[ rand( 0, $size - 1 ) ];
	}

	return $str;
}


function getavatar($id,$alt = 'avatar-image',$class = 'avatar'){
	if(file_exists(Config::get('kickstart.avatarstorage').$id.'/avatar.jpg')){
		$photo = HTML::image('avatar/'.$id.'/avatar.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}

function getavatarbyemail($email,$alt = 'avatar-image',$class = 'avatar'){
	$usr = new User();

	$usr = $usr->get(array('email'=>$email),array('id','email'));

	$id = $usr['_id'];

	if(file_exists(Config::get('kickstart.avatarstorage').$id.'/avatar.jpg')){
		$photo = HTML::image('avatar/'.$id.'/avatar.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}

// get employee formal photo

function getphoto($id,$alt = 'avatar-image',$class = 'avatar'){
	if(file_exists(Config::get('kickstart.photostorage').$id.'/formal.jpg')){
		$photo = HTML::image('employees/'.$id.'/formal.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}

function getphotobyemail($email,$alt = 'avatar-image',$class = 'avatar'){
	$usr = new User();

	$usr = $usr->get(array('email'=>$email),array('id','email'));

	$id = $usr['_id'];

	if(file_exists(Config::get('kickstart.photostorage').$id.'/avatar.jpg')){
		$photo = HTML::image('employees/'.$id.'/formal.jpg', $alt, array('class' => $class));
	}else{
		$photo = HTML::image('images/no-avatar.jpg', 'no-avatar', array('class' => $class));				
	}

	return $photo;
}


function getuser($id){
	$_id = new MongoId($id);
	$usr = new User();
	$usr = $usr->get(array('_id'=>$_id));
	return $usr;
}

function getuserbyemail($email){
	$usr = new User();
	$usr = $usr->get(array('email'=>$email));
	return $usr;
}

function getdocument($id){
    $_id = new MongoId($id);
    $document = new Document();
    $doc = $document->get(array('_id'=>$_id));
    return $doc;
}

function getproject($id){
    $_id = new MongoId($id);
    $document = new Project();
    $doc = $document->get(array('_id'=>$_id));
    return $doc;
}

function roletitle($role){
	$roletitles = Config::get('acl.roles');
	return $roletitles[$role];
}

function depttitle($dept){
	$depttitles = Config::get('kickstart.department');
	return $depttitles[$dept];
}

function limitwords($string, $word_limit)
{
    $words = explode(" ",$string);
    if(count($words) <= $word_limit){
    	return $string;
    }else{
	    return implode(" ",array_splice($words,0,$word_limit)).'...';
    }
}

function fixfilename($filename)
{
	$label = $filename;
	$label = str_replace(Config::get('kickstart.invalidchars'), ' ', trim($label));
	$label = preg_replace('/[ ][ ]+/', ' ', $label);
	$label = str_replace(array(' '), '_', $label);

	return $label;
}

function formatrp($angka){
	$rupiah=number_format($angka,2,',','.');
	return $rupiah;
}

function get_domain($url)
{
  $pieces = parse_url($url);
  $domain = isset($pieces['host']) ? $pieces['host'] : '';
  if (preg_match('/(?P<domain>[a-z0-9][a-z0-9\-]{1,63}\.[a-z\.]{2,6})$/i', $domain, $regs)) {
    return $regs['domain'];
  }
  return false;
}

?>
