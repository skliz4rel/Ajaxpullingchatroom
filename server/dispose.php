<?php
	//This is the logout file
	session_start();
	
	include('add.php');
	
	connection(); 
	
	changeadminstatus($_SESSION['id'],$_SESSION['username123xyz'],$_SESSION['department123xyz']);
	
	if(isset($_SESSION['username123xyz']) and isset($_SESSION['department123xyz']) and isset($_SESSION['id']))
	{
		//unset all the sessions
		unset($_SESSION['username123xyz']);  unset($_SESSION['department123xyz']); unset($_SESSION['id']);
		session_destroy();
		
		mysql_close(); //Disposes all the mysql database object
		header('Location: MindMeister.php');
		exit;
	}
	
	
	

?>