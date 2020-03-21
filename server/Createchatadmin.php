<?php
	session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<style type = 'text/css' rel='stylesheet'>
	#round{
		border : 1px solid green;
		position:relative;	
	}
</style>
<link type="text/css" href="css/custom-theme/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>


<script type = 'text/javascript'>
$(document).ready(function () {
	//window.alert('hello body');
	var picpath = "c:/wamp/www/Teemark chatroom/server/adminpics/";
	
	$('#showpic').hide();
	
	var dialog = {
		autoOpen : false,
		title : 'Form Errors',
		hide : 'slide',
		position: ['center','center'],
		width: 400,
		height: 300
	};
	
	$('#dialog').dialog(dialog);
	
	$('#form1').submit (function () {
		$('#s').hide(); 
	
		//validating the form
		var chatname = $('#chatname').val();
		var password = $('#password').val();
		var department = $('#department').val();
		var picture = $('#picture').val();
		var captcha = $('#captcha').val();
		
		var onSubmit = true;
		var error = "<font>Correct the following errors  in the form<ul>";
		
		if(chatname.length < 3){
			error += "<li>Enter admin chat name (Not less than 3 characters)";
			onSubmit = false;
		}
		
		if(password.length < 5){
			error += "<li>Enter admin password (Not less than five characters)";
			onSubmit = false;
		}
		
		if(department.length < 3){
			error += "<li>Enter admin department";
			onSubmit = false;
		}
		
		if(picture.length < 5){
			error += "<li>Upload picture";
			onSubmit = false;
		}
		
		if(captcha.length < 3){
			error += "<li>Enter 3 black characters in captcha";
			onSubmit = false;
		}
		
		if(onSubmit == false){
			error += "</ul></font>";
			$('#dialog').html(error);
			$('#dialog').dialog('open');
			
			return false;
		}
		
		if(onSubmit == true){
			return true;
		}
	
	});
	
	$('#chatname').click(function() {
	
		$('#s').hide();
	});
	
	
	$('#captcha').bind("click",function(){
		
	});
	


});
</script>

</head>

<body>
<div id = 'dialog'></div>


<div id = 'round'>

<form id="form1" name="form1" method="post" action="setnewadmin.php" enctype="multipart/form-data">
<?php
	
	
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
		if($id == 'inserted')
			echo "<label id = 's'>Details as been inserted</label>";
		else if( $id == 'failed')
			echo "<label id = 's'>Details failed to insert</label>";
		else{
			//do nothing
		}
	}

?>
  <table width="456" border="0">
    <tr>
      <td>&nbsp;</td>
      <td>Create Chat Administrator </td>
    </tr>
    <tr>
      <td width="172">&nbsp;</td>
      <td width="268"><div id = 'showpic'><img src='' width="60" id = 'adminpic'></div></td>
    </tr>
    <tr>
      <td height="32">Chatname</td>
      <td><label>
        <input type="text" name="chatname"  id = 'chatname'/>
      </label></td>
    </tr>
    <tr>
      <td>Password</td>
      <td><label>
      <input type="password" name="password" id= 'password'/>
      </label></td>
    </tr>
    <tr>
      <td>Department</td>
      <td><label>
        <select name="department" id = 'department'>
          <option value=''>Select Category</option>
          <option value='Technical Support'>Technical Support</option>
          <option value='Customer Care'>Customer Care</option>
          <option value='Client Service'>Client Service</option>
        </select>
      </label></td>
    </tr>
    <tr>
      <td>Upload Picture </td>
      <td><label>
      <input type="file" name="picture" id = 'picture' />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><img src = 'captcha.php' alt="captcha image" width="76" height="38"></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>Enter 3 black characters </td>
    </tr>
    <tr>
      <td>Captcha</td>
      <td><label>
      <input type="text" name="captcha" id= 'captcha' size = '10' maxlength="3"/>
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="Submit" value="Submit" />
        <input type="reset" name="Submit2" value="Reset" />
      </label></td>
    </tr>
  </table>
</form>
</div>


</body>
</html>
