<?php
class Fetchmail_Task{

	public function run(){
		Bundle::start('mongovel');
		
		$doc = new Document();
		$docs = $doc->find();

		print_r($docs);
	}

}

?>
