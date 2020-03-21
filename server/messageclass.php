<?php

	session_start();
	
	include_once("add.php");
	
	connection();
	
	class Message{
		
		function __construct()
		{
		
		}
	
		function sendMessage()
		{
			$client_id = (int)$_POST['client_id'];
			$admin_id = (int)$_POST['admin_id'];
			$message = $_POST['message'];
			$user = $_SESSION['username123xyz'];
			$query = "insert into message (client_id,admin_id,message,chatuser) values ($client_id,$admin_id,'$message','$user')";
			
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_insert_id();
			
			if($id > 0)
			{
				echo 'sent';
			}
		}
		
		function showMessage()
		{
			$admin_id = (int)$_SESSION['id'];
			$client_id = $_POST['client_id'];
			$query = "select chatuser,message from message where client_id = $client_id and admin_id = $admin_id;--";
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_num_rows($result);
			
			$message = null;
			
		
				if($id > 0)
				while($record = mysql_fetch_array($result)){
					$message .= " <div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'> 
  <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
".$record[0]." :- ".$record[1]."</div>";
				}
				
				echo $message;
			
		}
	}
	
	$object = new Message();
	
	
	if(isset($_POST['send']))
		$object->sendMessage();
		
	if(isset($_POST['loader']))
		$object->showMessage();
?>