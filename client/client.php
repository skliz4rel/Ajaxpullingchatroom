<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link type='text/css' rel='stylesheet' href='css/custom-theme/jquery-ui-1.8.17.custom.css' />
<script type='text/javascript' src='js/jquery-1.7.1.min.js'></script>
<script type='text/javascript' src='js/jquery-ui-1.8.17.custom.min.js'></script>
<script type='text/javascript'>
<!--
//create a public variable
var clientid = null;
var admin_id = 0;

$(document).ready(function () {

	$('#merror').hide();
	$('#error').hide();
	
	$('#second').hide();
	
	$('#third').hide();
	
	$('#errormessage').hide();
		
	$('#chatroom').hide();
	
		var dialog = {
			width: 900,
			position: ['center','center'],
			height: 500,
			title: 'Ask Questions',
			modal: true,
			autoOpen:false,
			hide: 'explode'
		};
		
		$('#clientchatbox').dialog(dialog);
		
			
			$('#chatbox').click(function(){
			
				$('#clientchatbox').dialog('open');
			});
			
	
			
			$('#go').click(function () {
						
			var option = $('#menu').val();
				if(option.length == 0){
					$('#error').html("Please select an option below");
					$('#error').show('slide');
					
				}
				else
					$.post(
						'form.php',
						{gobutton:$(this).attr('id'),department:$('#menu').val()},
						function(data){
							if(data == 'online')
							{
								$('#first').slideUp('slow');
								$('#third').slideDown('slow');
							}
							if(data == 'offline'){
								//alert(data);
								$('#first').slideUp('slow');
								$('#second').slideDown('slow');
								
							}
							else{}
						}
					);
				
			});
		
		
			
			$('#menu').bind('change',function () {
				$('#error').hide('slide');
			});
			
			$('#mail').click(function() {
			
				var name = $('#clientname').val();
				var email = $('#email').val();
				var ques = $('#question').val();
				
				var onSubmit = true;
				
				//var error = "<br/><font id ='error'></font>";
				
				if(name.length < 3)
				{
					onSubmit = false;
				}
				if(email.length < 3){
					onSubmit = false;
				}
				if(ques.length < 3){
					onSubmit = false;
				}
				
				if(onSubmit == false){
					$('#error').html('fill the form completely');
					$('#error').show('slide');
				
				}
				
				if(onSubmit == true){
					alert('herer');
					$.post(
						'form.php',
						{clientname:$('#clientname').val(),email:$('#email').val(),question:$('#question').val()},
						function(data){
							alert('performed');
							alert(data);
							if(data == 'sent')
								alert('Message sent');
						}
					
					);
				
				}
			});
			
			$('#clientname').click(function () {
				$('#error').hide('slide');
			});
			
			$('#proceed').click(function () {
			$('.other').hide();
			
			var chatname = $('#chatname').val();
			var chatmail = $('#chatmail').val();
			
				if(chatname.length < 2 && chatmail.length <2)
					$('#merror').show('slide');
				else
				{
					$.post(
						'form.php',
						{chatname:$('#chatname').val(),chatmail:$('#chatmail').val(),department:$('#menu').val(),startchat:$(this).attr('id')},
						function(data){
							//alert(data);
							clientid =data;
						}
					);
				
					$('#third').slideUp('slow');
					$('#chatroom').slideDown('slow');
				}
			});
			
			//This button is going to close the mailing form when the user click it. It is a back button
			$('#back').click(function () {
				$('#merror').hide();
				$('#error').hide();
				$('#second').slideUp('slow');
				$('#first').slideDown('slow');
			});
			
			
			//when this button is clicked is going to close the name and email form taking the client back to select a different category
			$('#back1').click(function(){
				$('#third').slideUp('slow');
				$('#first').slideDown('slow');
			});
			
			$('#chatname').click(function() {
				$('#merror').hide();
			});
			
			
			$('#chatmail').click(function (){
				$('#merror').hide();
			});
			
			
			//Empower the button to commence chatting
			$('#send').click(function () {
				var checkadmin = $('#wait').html();
				//alert(checkadmin);
				if(checkadmin == 'waiting'){
						$('#errormessage').html('Please wait for an Agent\n An agent would be up to attend to you in a minute');	
						$('#errormessage').show('slide');
				}
				else
				{
					$('#errormessage').hide();
					//start sending the messages into the database
					var message = $('#message').val();
					if(message.length < 1)
						$('#errormessage').hide();
					
					else{
						$.post(
						'clientmessage.php',
						{send:$(this).attr('id'),client_id:clientid,admin_id:admin_id,chatuser:$('#chatname').val(),message:message},
						function (data){
							$('#message').val('');
							//alert(data);
						}
						);
					}//End of the first else statement
				}
				
			});
			
			$('#message').focus(function () {
				$('#errormessage').hide();
			});
	});
	
	function checker()
	{
		$.post(
			'clientmessage.php',
			{clientid:clientid,check:1},
			function(data){
				admin_id = data;
				$('#wait').html(admin_id);
			}
		);
		
	}
	
	function showmessage()
	{
		$.post(
			'clientmessage.php',
			{showmsg:1,client_id:clientid,admin_id:admin_id},
			function (data){
				$('#displaymessage').html(data);
			}
		);
	}
	
	function loader()
	{
		checker();
		
		if(admin_id != 0)
			showmessage();
			
		var timerid = setTimeout('loader()',1000);
		
	}

//-->
</script>

<style type='text/css' rel='stylesheet'>
	#error{
		border : 1px solid red;
		background: yellow;
	}
	
	#displaymessage {
		border: 1px solid green;
		//background-color: #FFCC99;
		overflow:scroll;	
		width:inherit;
		height:inherit;
	}
</style>
</head>

<body onload="loader();">
<div>
  <p><img src="images/images2.jpg" width="106" height="105" /></p>
  <p>TEEMARK LIVE CHAT SYSTEM 
  </p>
  <div id='chatbox'>
   <div class="ui-widget">
<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><p><span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span> 
<strong>Chat with a live Agent</strong></p></div>
</div>


 </div>
 
 <BR/>
 <div id = 'clientchatbox'>
 

   <p class='other'>What can we help you with ?</p>
   
   <div id = 'error'></div>
   
   <div id = 'first'>
   <form id="form1" name="form1" method="post" action="">
     <table width="363" border="0">
       <tr>
         <td width="218"><select id = 'menu'   class="ui-state-default ui-corner-all">
		 <option value = ''>Please select</option>
           <option value ='Technical Support'>Technical Support</option>
           <option value = 'Customer Care'>Customer Care</option>
           <option value = 'Client Service'>Client Service</option>
         </select></td>
         <td width="129">
          <input type="button" name="button" value="Go" id = 'go'  class="ui-state-default ui-corner-all"/>         </td>
        </tr>
     </table>
    </form>
	</div>
	
	<div id='second'>
	<strong>Sorry None of our agents are online</strong>
	  <form id="form2" name="form2" method="post" action="">
	    <table width="675" border="0">
          <tr>
            <td width="153">&nbsp;</td>
            <td width="506" class="ui-widget-shadow ui-corner-all"><label class='m'>Mail Us</label> </td>
          </tr>
          <tr>
            <td>Name</td>
            <td><label>
              <input type="text" id="clientname"   class="ui-state-default ui-corner-all"/>
            </label></td>
          </tr>
          <tr>
            <td>Email Address </td>
            <td><label>
              <input type="text" id="email"   class="ui-state-default ui-corner-all"/>
            </label></td>
          </tr>
          <tr>
            <td>Question</td>
            <td><label>
              <textarea id="question"   class="ui-state-default ui-corner-all"></textarea>
            </label></td>
          </tr>
          <tr>
            <td height="34">&nbsp;</td>
            <td>
              <input type="button" name="Submit" value="Send Mail" id = 'mail'  class="ui-state-default ui-corner-all"/>
              <input type="button" name="back" value="Back" id = 'back'  class="ui-state-default ui-corner-all"/>
           </td>
          </tr>
        </table>
      </form>
	</div>

   
   <div id = 'third'>
     <table width="546" border="0">
       <tr>
         <td>&nbsp;</td>
         <td class="ui-widget-shadow ui-corner-all"><label id= 'merror'>Enter name and email </label></td>
       </tr>
       <tr>
         <td width="192">Name</td>
         <td width="338">
           <input type="text" name="textfield" id = 'chatname'   class="ui-state-default ui-corner-all"/>         </td>
       </tr>
       <tr>
         <td>Email</td>
         <td>
           <input type="text" name="textfield2" id = 'chatmail'   class="ui-state-default ui-corner-all"/>         </td>
       </tr>

       <tr>
         <td>&nbsp;</td>
         <td>
           <input type="button" name="proceed" value="start chat" id='proceed'  class="ui-state-default ui-corner-all"/>
           <input type="button" name="back" value="Back" id='back1'  class="ui-state-default ui-corner-all"/>         </td>
       </tr>
     </table>
   </div>
     
	 <div id = 'chatroom'>
 	   <table width="946" height="403" border="0">
          <tr>
            <td height="23" colspan="2" class="ui-widget-shadow ui-corner-all">Client chat box  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <label id='wait'>Please wait for an Admin Agent</label></td>
          </tr>

          <tr>
            <td height="235" colspan="2">
			<div id = 'displaymessage'  class="ui-state-default ui-corner-all ui-state-highlight ">			</div>			</td>
          <td width="73" height="69"><hr id='housepic'></td>
          </tr>
          <tr height='20'>
            <td width="674" class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><label>
              <input type="text" name="textfield3" size='75' ID = 'message'  class="ui-state-default ui-corner-all"/>
            </label></td>
            <td width="185" class="ui-state-error ui-corner-all" style="padding: 0 .7em;"><input type="button" name="send" value="Send" id = 'send'  class="ui-state-default ui-corner-all"/>
           
             
              <input type="button" name="logout" value="Logout"  class="ui-state-default ui-corner-all"/>            </td>
          </tr>
       </table>
	   <label id='errormessage'></label>
	 </div>
	 
	 <br/>
	 <br/>
	 <div class="ui-widget-shadow ui-corner-all">
     <p class='other'>OR  call us on our Customer care Lines :- </p>
     <p class = 'other'><strong>Powered by Teemark IT Department</strong></p>
	 </div>
	 
  </div>
</div>
</div>
</body>
</html>