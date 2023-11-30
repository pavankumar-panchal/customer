function validation(keyvalue)
{  
	var form = $('#submitpwdform'); 
	var error = $('#form-error');
	var field = $('#password');
	if(!field.val()){error.html(errormessage("Enter the Password")); return false; field.focus(); }
	var field = $('#confirmpwd');
	if(!field.val()){error.html(errormessage("Re-Enter the New Password"));  return false; field.focus();}
	if($('#password').val() != $('#confirmpwd').val())
	{
		error.html(errormessage("New and confirm passwords does not match.")); return false; field.focus();
	}
	else
	{
			var passData  = "switchtype=retrivepwd&password=" + encodeURIComponent($('#password').val())  + "&confirmpwd=" + encodeURIComponent($('#confirmpwd').val()) + "&key=" + encodeURIComponent(keyvalue) + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passData)
			var queryString = "../ajax/retrive.php"; 
			ajaxcall10 = $.ajax(
			{
				type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
				success: function(ajaxresponse,status)
				{	
					var responetext=ajaxresponse;
					if(responetext['errorcode'] == 1)
					{
						$('#form-error').html(successmessage(responetext['errormsg']));
						$('#submitpwdform')[0].reset();
					}
					else if(responetext['errorcode'] == 2)
					{
						$('#form-error').html(errormessage(responetext['errormsg']));
						$('#submitpwdform')[0].reset();
					}
					else
					{
						$('#form-error').html(errormessage(scripterror()));
					}
				},
				error: function(a,b)
				{
					$("#form-error").html(scripterror());
				}
			});		
		}
}

function resetform()
{
	var form = $("#submitpwdform"); 
	$('form-error').html('');
	$("#submitpwdform")[0].reset();
}

