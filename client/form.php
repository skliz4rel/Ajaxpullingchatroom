<?php

	include_once('add.php');
	
	//echo 'you are tired';

	class Clientprocessor{
		
		function __construct()
		{
			connection(); //This is calling the connector method
		}
		
		function checkstatus()
		{
			$department = $_POST['department'];
			$query = "select * from adminusers where status = 'online' and department = '$department';--";
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_num_rows($result);
			
			if($id > 0)
			{
				echo "online";
			}
			else
				echo "offline";
		}
		
		function mailus()
		{
			//this function is going to send mails to the administrator
			$client = $_POST['clientname'];
			$from = $_POST['email'];
			$subject = "Question from clients";
			$message = $_POST['question'];
			
			$header = "From : $from /n /r";
			
			$id = mail('skliz4rel@yahoo.com',$subject,$message,$header);
			
			echo $id;
		}
		
		function registerClient()
		{
			//This function is going to register any client that logs on commence a chat session
			$chatname = mysql_prep(trim($_POST['chatname']));
			$chatmail = mysql_prep(trim($_POST['chatmail']));
			$agentdepart = mysql_prep(trim($_POST['department']));
			$ipaddress = $_SERVER['REMOTE_ADDR']; //get the clients oip address	
				$query = "insert into clients (username,email,ipaddress,agent_department) values ('$chatname','$chatmail','$ipaddress','$agentdepart')";
				
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_insert_id();
			echo $id;
		}
	}
	

	$object = new Clientprocessor();
	
	if(isset($_POST['gobutton'])){
		$object->checkstatus();
	}
	
	
	if(isset($_POST['mail'])){
		$object->mailus();
	}
	
	
	if(isset($_POST['startchat'])){
		$object->registerClient();
	}
	
	
?>