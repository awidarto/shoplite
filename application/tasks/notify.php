<?php
class Notify_Task {

    public function run($arguments)
    {
    	Bundle::start('mongovel');
    	Bundle::start('messages');

    	//find outbox first
        $outbox = new Outbox();
        
        $message = $outbox->find(array('status'=>'unsent'));
        
        
        $count = 0;
        foreach ($message as $key => $value) {
        	$to = $value['to'];
        	$message = Message::to($value['to'])
			->from($value['from'])
			->subject($value['subject'])
			->body($value['body'])
			->send();
			$count++;
			if($message->was_sent())
			{
				echo 'Message Sent!';
			}else{
				echo 'Message Dodol!';
			}

        }

        

        

    }

}
?>