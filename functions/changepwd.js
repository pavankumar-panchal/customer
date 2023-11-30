function validating(cusid)
{ 
	var form = $('#submitformpwd'); 
	var error = $('#form-error');
	var field = $('#oldpassword');
	if(!field.val()){error.html(errormessage("Enter the Password")); return false; field.focus(); }
	var field =  $('#newpassword');
	if(!field.val()){error.html(errormessage("Enter the New Password"));  return false; field.focus();}
	var field = $('#confirmpassword');
	if(!field.val()){error.html(errormessage("Re-Enter the New Password")); return false; field.focus();}
	else
	{
		var passdata  = "switchtype=change&oldpassword=" + encodeURIComponent($('#oldpassword').val())  + "&newpassword=" + encodeURIComponent($('#newpassword').val()) + "&confirmpassword=" + encodeURIComponent($('#confirmpassword').val()) + "&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*100000000); 
		$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
		var queryString = "../ajax/changepwd.php"; 
		ajaxobjext14 = $.ajax(
		{
			type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					$('#form-error').html('');
					var responetext = ajaxresponse;//alert(responetext)
					if(responetext['errorcode'] == 1)
					{
						$('#form-error').html(errormessage(responetext['errormsg']));
						$('#submitformpwd')[0].reset(); 
					}
					else 
					{
						$('#form-error').html(successmessage(responetext['errormsg']));
						$('#submitformpwd')[0].reset(); 
					}
				}
			}, 
			error: function(a,b)
			{
				$('#form-error').html(scripterror());
			}
		});		
	}
}

