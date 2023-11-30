function validation()
{
	var form = $('#submitform'); 
	var error = $('#form-error');
	var email = $("#email");
	//var field = form.email;
	if(!email.val()){error.html(errormessage(" Email ID is compulsory. Please enter a valid email ID. ")); field.focus();return false;}
	else if(!emailvalidation(email.val()))
	{ 
		error.html(errormessage("The email ID entered is not in proper format. Please enter a Valid email ID. ")); 
		field.focus(); 
		return false;
	}
	else
	{
	var passData  = "switchtype=retrival&email=" + encodeURIComponent(email.val()) + "&dummy=" + Math.floor(Math.random()*100000000);  //alert(passData)
	disablenext();
	error.html('');
	$('#customerprocess').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	var queryString = "../ajax/custpasswd.php";
	ajaxcall0 = $.ajax(
	{
		type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			var responetext = ajaxresponse;
			if(responetext['errorcode'] == 1)
			{
				$('#customerprocess').html('');
				error.html('');
				$('#tabc1').hide(); 
				$('#tabc2').show();
				$('#form-error1').html(displaysuccessmessage(responetext['errormsg']));
				//alert(response);
			}
			else
			{
				error.html('');
				$('#customerprocess').html('');
				$('#tabc1').show();
				$('#form-error').html(errormessage(responetext['errormsg']));
			}
		}, 
		error: function(a,b)
		{
			$("#customerprocess").html(scripterror());
		}
	});	
	}
}
