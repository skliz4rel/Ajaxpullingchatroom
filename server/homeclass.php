<?php
	session_start();
	
	include_once("add.php");
	
	connection();
		
	class Home{
		
		function __construct()
		{
			
		}
		
		function showAdmin()
		{
		
			$depart = trim($_POST['department']);
			$query = "select id,username,status from adminusers where department = '$depart';--";
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_num_rows($result);
			
			
				while($record = mysql_fetch_array($result))
				{
					echo "<a href=".$record['id']." target='_blank' >".$record['username']."</a>...Status:- ".$record['status']."<br/>";
				}
			
		}
		
		function showclients()
		{
			$agent_type = $_POST['agent_type'];
			$output = "<strong>Clients Waiting for an Agent to chat with</strong><br/>";
			$query = "select id,username from clients where agent_department = '$agent_type' and admin_id IS NULL;--";
			$result = mysql_query($query) or die(mysql_error());
			$id = mysql_num_rows($result);
			
			$output .= "<div id = 'notchattingdisplay'><ul>";
			if($id >0){
				while($records = mysql_fetch_array($result)){
					$output .=  "<li>$records[1]....... <a id =$records[0] href= 'message.php?id=$records[0]' class='chatlinks' target='_BLANK'>Chat					</a></li>";
				}
			}
			$output.="</ul></div>";
			
			$output .= "<br/>";
			$output .= "<strong>Clients Already Chatting with Agents</strong><br/>";
			
			$output .= "<div id = 'chattingdisplay'><ul>";
			
			$query = "select id,username,admin_id from clients where agent_department = '$agent_type' and admin_id IS NOT NULL;--";
			$result = mysql_query($query) or die(mysql_error());
			$id = mysql_num_rows($result);
			
			if($id  >0){
				while($records = mysql_fetch_array($result)){
					$output .=  "<li class='ch'>$records[1].......Chatting with Admin agent id($records[2])</li>";
				}
			}
			
			$output.="</ul></div>";
			echo $output;
			
		}
		
		function linkadmintoclient(){
			//This function is going to control the chatting operations between the administration and the clients
			$admin_id = $_POST['admin_id'];
			$client_id = $_POST['client_to_chat'];
			
			$query = "update clients set admin_id = '$admin_id' where id = $client_id;--";
			
			$result = mysql_query($query) or die(mysql_error());
			
			$id = mysql_affected_rows();
			
			if($id > 0)
				echo 'nice';
		}
	}


$object = new Home(); //This is going to create the object of the class


if(isset($_POST['tech']))
	$object->showAdmin();
	
if(isset($_POST['techbutton']))
	$object->showclients();
	
if(isset($_POST['custbutton']))
	$object->showclients();
	
if(isset($_POST['clientbutton']))
	$object->showclients();
	
if(isset($_POST['client_to_chat']))
	$object->linkadmintoclient();
?>