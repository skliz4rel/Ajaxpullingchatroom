<?php
	session_start();
	ob_start();
	
	include('add.php');
	class Admin{
	
		public $username = null;
		public $password = null;
		public $captcha = null;
		public $department = null;
		
		//public $position = null;
		function __construct()
		{
		
			connection();
			$this->username = $_POST['username'];
			$this->password = $_POST['password'];
			$this->captcha = $_POST['captcha'];
			$this->department = $_POST['menu1'];
			//$this->position = $_POST['position'];
			
			
			if(isset($_POST['submit']))
			$this->validate();
		}
		
		function validate()
		{
			$content = array('Username'=>$this->username,'Password'=>$this->password,'Captcha'=>$this->captcha,'Department'=>$this->department);
			$error = null;
			
			foreach($content as $key => $value)
			{
				if(empty($value))
				{
		
					$error .= "<li>Enter ".$key."</li>";
				
				}
				
			}
			
			if(!is_null($error)){
				//redirect("newcontent.php#fragment-4?type=$error");
				echo "<ul>Please correct the following errors";
				echo $error;
				echo "</ul>";	
				echo "<a href = 'MindMeister.php'>click here to login again</a>";
			}	
			
			if($this->captcha != $_SESSION['captcha']){
				echo "<ul>Please correct the following errors<br/>";
				echo "Enter the correct captcha (The 3 black characters)<br/>";
				echo "</ul>";
				echo "<a href = 'MindMeister.php'>Re-Login</a>";
			}
			
			else
			{
				$this->username = mysql_real_escape_string(strip_tags(trim($_POST['username'])));
				$this->password = mysql_real_escape_string(strip_tags(trim($_POST['password'])));
				$this->department = mysql_real_escape_string(strip_tags(trim($_POST['department'])));

				$newpassword =  hash('haval256,5',$this->password);
				
				$query = "select id,username,department from adminusers where username = '$this->username' and password = '$newpassword' LIMIT 1;-- ";
				
				$result = mysql_query($query) or die(mysql_error());
				
				$id = mysql_num_rows($result);
			
				if($id >0)
				{
					//echo 'Correct username details';
					$content = mysql_fetch_array($result);
					
					$_SESSION['id'] = $content['id'];
					$_SESSION['username123xyz'] = $content['username'];
					$_SESSION['department123xyz'] = $content['department'];
					
					//Before redirecting update the admin status
					$query = "update adminusers set status = 'online' where username ='".$this->username."' and password = '".$newpassword."' and id = ".$_SESSION['id'];
				
					$result = mysql_query($query) or die(mysql_error().'<>');
					
					
					redirect('Home.php');
				}
				else
				{
					redirect('MindMeister.php?login_attempt=1');
				}   
			}
		}
	}


	$object = new Admin();
	ob_end_flush();
	
?>