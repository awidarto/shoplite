<?php
class Mailsend_Task{

	public function run(){
		Bundle::start('mongovel');
		
		$attendee = new Attendee();
		$attendees = $attendee->find();

		print_r($attendees);
	}

}

?>
