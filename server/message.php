<?php
	session_start();
	ob_start();
	
	include('add.php');
	
	connection(); 
	
	if(isset($_GET['id']) or !is_int($_GET['id']))
		$client_id = (int)$_GET['id'];
	else
		redirect('Home.php');
		
	//collecting the picture path to display picture
	$query = "select picpath from adminusers;--";
	$result = mysql_query($query) or die(mysql_query);
	$id = mysql_num_rows($result);
	
	if($id >0)
	{
		$record = mysql_fetch_array($result);
		
		$_SESSION['pic'] = $record[0];
	}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Private Chatbox</title>
<link type='text/css' rel='stylesheet' href='css/custom-theme/jquery-ui-1.8.17.custom.css' />

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>

<script type = 'text/javascript'>
var client_id = '<?php echo $client_id; ?>';
var admin_id = '<?php echo $_SESSION['id']; ?>';
var admin_pic = '<?php echo $_SESSION['pic'];?>';

//alert(admin_pic);

var timerId = 0;

$(document).ready(function (){
	//display the picture to the administrator
	var d = "<img src='"+admin_pic+"' alt = 'Admin passport' >";
	$(d).insertBefore('#ruler');
	
	//alert(d);

	$('#error').hide();
	
	$('#Send').click(function() {
		//alert('hello buddy');
		var message = $('#msg').val();
		
		if(message.length < 1)
		{
			$('#error').show('slide');
		}
		else
		{
			$.post(
				'messageclass.php',
				{client_id:client_id,admin_id:admin_id,message:message,send:$(this).attr('id')},
				function(data){
					$('#msg').val('');
				}
			);
			
		}
		
	});
	
	
	$('#msg').click(function () {
		$('#error').hide();
	});
});

//autoloader
function showmessage()
{
	$.post(
		'messageclass.php',
		{loader:1,client_id:client_id},
		function(data){
			$('#message').html(data);
			//alert(data);
		}
	);
}

function loader()
{
	showmessage();
	timerId = setTimeout('loader()',1000);
}
</script>

<style type = 'text/css' rel='stylesheet'>
	#message{
		border : 1px solid green;
		overflow:scroll;
		width:inherit;
		height:inherit;
	}
</style>
</head>

<body onload='loader();'>
<div>

  <form id="form1" name="form1" method="post" action="">
    <table width="777" height="246" border="0">
	<tr>
        <td>
		<div id = 'title' class="ui-state-error ui-corner-all">Private chat box </div>
		</td>
      </tr>
      <tr>
        <td width="707" height="215">
		<div id = 'message' class="ui-state-default ui-corner-all ui-state-highlight"></div>
		</td>
		<td width="60"><hr id= 'ruler'></td>
      </tr>
      <tr>
        <td class="ui-widget">
		<div class="ui-state-error ui-corner-all"> 

          <input name="msg" type="text" id="msg" size = '80'  class="ui-state-default ui-corner-all"/>
          <input name="Send" type="button" id="Send" value="Send"  class="ui-state-default ui-corner-all"/>
          <input name="Logout" type="button" id="Logout" value="Logout"  class="ui-state-default ui-corner-all"/>
		 </div>
          <br/>
        <font color = 'red' id = 'error'>Enter text into the message field </font></td>
      </tr>
    </table>
  </form>
</div>
</body>
</html>

<?php
	ob_end_flush();
?>