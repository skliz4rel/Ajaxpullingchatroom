<?php
	session_start();
	ob_start();

	include('add.php');
	
	secure(); // check for the loggin details authetication on each page
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link type="text/css" href="css/custom-theme/jquery-ui-1.8.17.custom.css" rel="stylesheet" />	
		<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.17.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.ui.widget.js"></script>
		<script type="text/javascript" src="js/jquery.ui.button.js"></script>

<script type = 'text/javascript'>
<!--
var admin_id = '<?php echo $_SESSION['id'];?>';


$(document).ready(function () {
	//alert('hello myclients');
	var accord = {
		header: "h3",
		event: 'click',
		collapsible: true,
		active : -1,
		//height : 200,
		fillspace:true,
		autoHeight : true,
		 height:700
	};
	
	$('#accordion').accordion(accord);
	
	
	$('#customer').hide();
	$('#technical').hide();
	$('#client').hide();
	
	$('#tech').click(function () {
		$.post(
			'homeclass.php',
			{tech:$(this).attr('id'),department:'Technical Support'},
			function(data){
				$('#technical').html(data);
				$('#technical').slideDown('slow');
				//alert(data);
			}
		);
		
	});
	
	$('#cust').click(function () {
		$.post(
			'homeclass.php',
			{tech:$(this).attr('id'),department:'Customer Care'},
			function(data){
				$('#customer').html(data);
				$('#customer').slideDown('slow');
				//alert(data);
			}
		);
		
	});
	
	$('#clie').click(function () {
		$.post(
			'homeclass.php',
			{tech:$(this).attr('id'),department:'Client Service'},
			function(data){
				$('#client').html(data);
				$('#client').slideDown('slow');
				//alert(data);
			}
		);
		
	});
	
	$('#techbutton').click(function (){
		$.post(
			'homeclass.php',
			{techbutton:$(this).attr('id'),agent_type:'Technical Support'},
			function(data){
				$('.technicalclient').html(data);
				//alert(data);
			}
		);
	
	});
	
	$('#custbutton').click(function() {
		$.post(
			'homeclass.php',
			{custbutton:$(this).attr('id'),agent_type:'Customer Care'},
			function(data){
				$('.customerclient').html(data);
				//alert(data);
			}
		);
	
	});
	
	$('#clientbutton').click(function (){
	
		$.post(
			'homeclass.php',
			{clientbutton:$(this).attr('id'),agent_type:'Client Service'},
			function(data){
				$('.serviceclient').html(data);
				//alert(data);
			}
		);
	});
	
	$('.chatlinks').live('click',function(){
		var id = $(this).attr('id');
		
		$.post(
			'homeclass.php',
			{client_to_chat:id,admin_id:admin_id},
			function (data){
				var object= $(this);
				
				$(this).remove();
				
				$('.ch').after(object);
			}
		);
	});
});
</script>

<style type="text/css" rel='stylesheet'>
	#customer{
		border : 1px solid green;
		overflow:scroll;
	}
	
	#technical{
		border : 1px solid green;
		overflow:scroll;
	}
	
	#client{
		border : 1px solid green;
		overflow:scroll;
	}

</style>
</head>

<body>

	
<table width="1241" height="606" border="0">
  <tr>
    <td height="67" colspan="2"><DIV id='head'>Online User <a href='dispose.php'  class="ui-state-default ui-corner-all">Logout</a></div>
	  <br/>
	  Online Clients 
	  <hr>
	</td>
  </tr>
  <tr height="1000">
    <td valign="top"><div id = 'users'>
	
	<div id = 'accordion'>
	
	<div>
		<h3><a href='#'><button id ='techbutton' class="ui-state-default ui-corner-all"><span class="ui-icon ui-icon-newwin"></span>View Client for Technical Service</button></a></h3>
		<div><br/>
			
			
			<div class='technicalclient'></div>
			
			
		</div>
	</div>
	
	<div>
		<h3><a href='#'><button id='custbutton' class="ui-state-default ui-corner-all">View Client for Customer Care</button></a></h3>
		<div><br/>
			
			
			<div class='customerclient'></div>
			
		</div>
	</div>
	
	<div>
		<h3><a href='#'><button id='clientbutton' class="ui-state-default ui-corner-all">View Client for Client Service</button></a></h3>
		<div><br/>
			
			<div class='serviceclient'></div>
			
		</div>
	</div>
	
	
	</div>
	
	
	</div></td>
    <td width="350" valign="top">
	<div>View Administrators Online</div>
	<br/>
	<div id='tech'>Technical Support click here</div>    <label id='t'>close</label>
	<div id='technical'></div>
	<br/>
	<div id = 'cust'>Customer Care click here</div>
	<div id = 'customer'></div>
	<br/>
	<div id = 'clie'>Client Service click here</div>
	<div id='client'></div>
	<br/>
	</div>
	</td>
  </tr>
</table>
<p>&nbsp;</p>
<p><a href='dispose.php'></a></p>
</body>
</html>
