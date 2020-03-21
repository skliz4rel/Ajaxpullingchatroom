<?php
session_start();
ob_start();
	
	include('add.php');
	
	securelogin();

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3c.org/TR/1999/REC-html401-19991224/loose.dtd">
<!-- saved from url=(0041)https://www.mindmeister.com/account/login -->
<HTML lang=en xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><HEAD><TITLE>MindMeister</TITLE>
<META content="text/html; charset=utf-8" http-equiv=Content-Type>
<META content=chrome=1 http-equiv=X-UA-Compatible>
<META content="IE=9; IE=8; IE=edge" http-equiv=X-UA-Compatible>
<META name=viewport content="width=device-width, initial-scale=1.0"><LINK 
rel="shortcut icon" type=image/ico href="/favicon.ico">
<META name=description content=Teemark Group of Companies>
<META name=author content=Teemark Group of Companies>
<META name=publisher content=Teemark Group of Companies>
<META name=distribution content=global>
<META name=robots content="follow, all">
<META name=language content=en>
<META name=revisit-after content="5 days">

<link type="text/css" href="css/custom-theme/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>


<script type = 'text/javascript'>
<!--

$(document).ready(function () {

	var dialog = {
		height : 400,
		width: 400,
		autoOpen: false,
		title: 'Form Errors',
		modal: true,
		buttons: {
						"Ok": function() { 
							$(this).dialog("close"); 
						}, 
						"Cancel": function() { 
							$(this).dialog("close"); 
						} 
					}

	};
	
	$('#dialog').dialog(dialog);
	
	$('#logins').dialog({
		height : 300,
		width: 500,
		autoOpen: true,
		title: 'Login',
		modal: true
	});
	




	

	$('#signin').submit(function () {
		$('#mesg').hide();
		var username = $('#username').val();
		var password = $('#password').val();
		var captcha = $('#captcha').val();
		var menu = $('#menu1').val();
		
		var onSubmit = true;
		var error = "<font><ul>Correct the following errors Administrator";
		
		if(username.length < 3){
			error+= "<li>Enter your username (Not less that 5 characters)<br/>";
			onSubmit = false;
		}
		
		if(password.length < 5){
			error += "<li>Enter your password (Not less that 5 characters)<br/>";
			onSubmit = false;
		}
		
		if(captcha.length <3){
			error += "<li>Enter captcha (The 3 black characters)";
			onSubmit = false;
		}
		
		if(menu.length < 3){
			error += "<li>Select your department";
			onSubmit = false;
		}
		
		if(onSubmit == false)
		{
			error += "</ul></font>";
			$('#dialog').html(error);
			$('#dialog').dialog('open');
			return false;
		}
		
		if(onSubmit == true){
			return true
		}
	});
	
	
	$('#reset').click(function (){
		$('#mesg').hide();
	});
	
	$('#username').focus(function () {
		$('#mesg').hide();
	});
	
	$('#password').focus(function () {
		$('#mesg').hide();
	});
	
	
});
//-->
</script>

<LINK rel=stylesheet type=text/css href="MindMeister_files/common.css" 
media=screen><LINK rel=stylesheet type=text/css 
href="MindMeister_files/dlgbox.css" media=screen><LINK rel=stylesheet 
type=text/css href="MindMeister_files/ie.css" media=screen,print>
<META name=GENERATOR content="MSHTML 8.00.7600.16912">
</HEAD>
<BODY>

<link href="style.css" rel="stylesheet" type="text/css" />
<DIV class=p40>
<DIV class="dialog center">
<DIV class=dialog_content>
<STYLE type=text/css>.selected.flyout {
	box-shadow: none
}
</STYLE>
<div id = 'content'>
<div id="jidepane">
 
<DIV style="TEXT-ALIGN: center; MARGIN: 25px 0px; CLEAR: both"><img src='images/teemarklogo.jpg'><strong>Teemark Limited Administrative Section</strong></DIV>

 
 <div id = 'dialog'></div>
<DIV id=logins>
<FORM id='signin' method='post' name='signin_standard' action='form.php'>
<div class="ui-widget">
			<div class="ui-state-highlight ui-corner-all" style="margin-top: 20px; padding: 0 .7em;"> 

<DIV style="HEIGHT: 110px" class=content>
 <?php
	if(isset($_GET['login_attempt']) and $_GET['login_attempt'] == 1)
	{
		echo "<font id = 'mesg' color = 'blue'>You have entered a wrong username and password</font>";
	}

?>

<table width="364" border = 0>

<tr>
  <td><LABEL style="LINE-HEIGHT: 24px; COLOR: #10334d; FONT-SIZE: 15px" class=large 
for=login> Username</LABEL> </td>
 <td> <INPUT style="WIDTH: 200px" id=username 
tabIndex=1 type=text name=username  class="ui-state-default ui-corner-all"> </td>
</tr>
<tr>
<td><LABEL style="LINE-HEIGHT: 24px; COLOR: #10334d; FONT-SIZE: 15px" class=large 
for=password>Password</LABEL></td>
<td> <INPUT style="WIDTH: 200px" id=password tabIndex=2 
type=password name=password  class="ui-state-default ui-corner-all"></td>
 </tr>
 
 <tr>
   <td><LABEL style="LINE-HEIGHT: 24px; COLOR: #10334d; FONT-SIZE: 15px" class=large 
for=department>Department</label></td>
   <td><select name="menu1" id = 'menu1'  class="ui-state-default ui-corner-all">
     <option value=''>Select Category</option>
     <option value='Technical Support'>Technical Support</option>
     <option value='Customer Care'>Customer Care</option>
     <option value='Client Service'>Client Service</option>
   </select></td>
 </tr>
 <tr>
 <td></td>
 <td>Enter the 3 black characters</td>
 </tr>
<tr>
<td></td>
<td><img src="captcha.php" alt="captcha image" width="76" height="38" class=="ui-state-default ui-corner-all"></td>
</tr>
<tr><td></td>
<td><input type="text" name="captcha" size="5" maxlength="3" id = "captcha"  class="ui-state-default ui-corner-all"></td>
</tr>
<tr>
<td></td>
<td><DIV class=dialog_buttons><INPUT  class="ui-state-default ui-corner-all" style="FLOAT: left; FONT-SIZE: 14px" id=submit tabIndex=3 value="Sign In" type=submit name='submit'> 
&nbsp;&nbsp;&nbsp;
<INPUT style="FONT-SIZE: 14px"  class="ui-state-default ui-corner-all"  value="Reset" type=reset id = 'reset'> 
</DIV></td>
</tr></table>
</DIV>


</div></div>
</FORM>
</DIV>

<DIV style="DISPLAY: none" id=popover_logintype 
class="popover menu above icons large"></DIV>


</DIV></DIV></DIV>
</div>
</div>
</BODY>

</HTML>