<?php
include('phpqrcode/qrlib.php');

class QR {
	public static function png($str,$filename = null){
		if(is_null($filename)){
			QRcode::png($str);
		}else{
			QRcode::png($str,$filename);
		}
	}
}

?>