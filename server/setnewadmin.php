<?php
	session_start();
	ob_start(); //This is going to start the output buffering
	include('add.php');
	
	class Sender
	{
		//create the variables of the programme
		public $chatname = null;
		public $password = null;
		public $department = null;
		public $picture = null;
		public $captcha = null;
		
		function  Sender()
		{
			//call the connection to db
			connection();
		
			//initializing the variables of the program
			$this->chatname = $_POST['chatname'];
			$this->password = $_POST['password'];
			
			$this->department = $_POST['department'];
			$this->picture = $_FILES['picture'];
			$this->captcha = $_POST['captcha'];
			
			
			$this->validate(); //calls on the function
			
			//echo 'function performed';
		}
		
		
		function validate()
		{
			$content = array('Chat name'=>$this->chatname,'Password'=>$this->password,'Department'=>$this->department,'Picture'=>$this->picture,'Captcha'=>$this->captcha);
			
			$error = null;
			foreach($content as $key => $value){
				if(empty($value)){
					$error .= '<li>Enter '.$key.'</li>';
				}
			}
			
			$filetype = $this->picture['type'];
			if(isset($filetype))
			if($filetype !== 'image/jpeg' and $filetype !== 'image/gif' and $filetype!=='image/png'){
				$error .= "This file is not an image (Unsupported file format)";
				$error .= "<br/>$filetype";
			}
			
			if(!is_null($error)){
				echo "<br/><font color = 'red'>Correct the following errors<ul>";
				echo $error;
				echo "</ul></font>";
				//exit;
			}
			
			
			else
			{
				//insert the values into the database 
				$this->insert();   ///function called into action	
			}
		}
		
		
		function insert()
		{
			$password = hash('haval256,5',$this->password);
			
			$storefolder = "c:/wamp/www/Teemark chatroom/server/adminpics/";
			
			
			//first move the file into the new directory
			$filename = $this->picture['name'];
			$filetype = $this->picture['type'];
			$filetempname = $this->picture['tmp_name'];
			
			$storagepath = $storefolder.basename($filename);
			
			if(is_uploaded_file($filetempname)){
			
				if(move_uploaded_file($filetempname,$storagepath))
				{
					//renaming the file in the new directory
					$newname = rand().basename($filename);
					rename($storagepath,$storefolder.$newname);    //renames the file in the directory
					
					$storagepath = $storefolder.basename($newname);
					
					//if the fie is inserted into the folder then store into the database
					$query = "insert into adminusers (username,password,department,status,picname,picpath) values ('$this->chatname','$password','$this->department','offline','$newname','$storagepath')";
					
					$result = mysql_query($query) or die(mysql_error());
					
					$id = mysql_insert_id();
					
					if($id >0)						
					{
						redirect("Createchatadmin.php?id=inserted");
					}
					else{
						redirect("Createchatadmin.php?id=failed");
					}
				}
			}
			
		
		}
		
		function showpic()
		{
			
		}
	}


$object= new Sender();
?>