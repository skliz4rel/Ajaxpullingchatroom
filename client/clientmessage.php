<?php
	session_start();
	
	include_once("add.php");
	
	connection();
	
	class Message
	{
		
		function __construct()
		{
		
		}
		
		
		function check()
		{
			$client_id = $_POST['clientid'];
			$query = "select admin_id from clients where id = $client_id";
			
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_num_rows($result);
			
			if($id > 0)
			{
				$record = mysql_fetch_array($result);
				
				if(is_null($record['admin_id']))
					echo "waiting";
				else{
					$admin_id = $record['admin_id'];
					echo $admin_id;
				}
				
			}
		}
		
		function getAdminpath($admin_id){
			$query = "select id,username,picpath from adminusers where id = $admin_id LIMIT 1;--";
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_num_rows($result);
			
			if($id > 0)
			{
				
			}
		}
		
		function send()
		{
			$client_id = (int)$_POST['client_id'];
			$admin_id = (int)$_POST['admin_id'];
			$chatuser = $_POST['chatuser'];
			$message = $_POST['message'];
			$query = "insert into message (client_id,admin_id,chatuser,message) values ($client_id,$admin_id,'$chatuser','$message');--";
			
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_insert_id();
			
			if($id > 0){
				echo 'Sent';
			}
		}
		
		function showMessage(){
			$admin_id = (int)$_POST['admin_id'];
			$client_id = (int)$_POST['client_id'];
			$query = "select chatuser,message from message where client_id =$client_id and admin_id =$admin_id;--";
			
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_num_rows($result);
			
			$message = null;
			if($id >0)
			{
				while($record = mysql_fetch_array($result)){
					$message .= " <div class='ui-state-highlight ui-corner-all' style='margin-top: 20px; padding: 0 .7em;'> 
  <span class='ui-icon ui-icon-info' style='float: left; margin-right: .3em;'></span>
".$record[0]." :- ".$record[1]."</div>";
				}
				
				echo $message;
			}	
		}
		
		
	}

$object = new Message();

if(isset($_POST['check']))
	$object->check();
	
if(isset($_POST['send']))
	$object->send();
	
if(isset($_POST['showmsg']))
	$object->showMessage();
?>