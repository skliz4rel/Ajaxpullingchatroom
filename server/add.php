<?php
	include('constant.inc');
	
		function connection()
		{
			$connect = mysql_connect(server,user,password);
			
			$select  = mysql_select_db('Teemarkchatroom',$connect);
			
		}
		
		function redirect($page)
		{
			header("Location: $page");
			exit;
		}
	
		function mysql_prep($value)
        {
                  $magic_quotes_active = get_magic_quotes_gpc();
                  $new_enough = function_exists("mysql_real_escape_string");
                  if($new_enough){
                  if($magic_quotes_active)
                  {
                     $value = stripslashes($value);
                  }
                  $value = mysql_real_escape_string($value);
                  return $value;
                }
                else
                {
                    if(!$magic_quotes_active)
                    {
                        $value = addslashes($value);
                    }
                    
                    return $value;
                }
          }
		  
		  function secure()
		  {
		  	if(!isset($_SESSION['username123xyz']) and !isset($_SESSION['department123xyz']))
			redirect('MindMeister.php');
		  }
		  
		  function changeadminstatus($id,$username,$department)
		  {
		  	//This function is going to change the administrators status from online to offline
			$query = "update adminusers set status = 'offline' where id = $id and username = '$username' and department = '$department';-- ";
			$result = mysql_query($query);
			
		  }
		  
		  function securelogin()
		  {
			unset($_SESSION['username123xyz']);  unset($_SESSION['department123xyz']); unset($_SESSION['id']);
			session_destroy();
		  }
	
?>