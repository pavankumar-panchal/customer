function cancelorconfirmretrivepassword()
{
	var form = $('#submitform');
	var error = $('#form-error'); 
	var field = $('#smsaccount');
	if(!field.val()) {error.html(errormessage('Please select an Account')); field.focus(); return false; }
	var field = $('#smsemailid');
	if(!field.val()) {error.html(errormessage('Please Enter the Email ID')); field.focus(); return false; }
	if(field.val())	{ if(!singleemailidvalidation(field.val())) { error.html(errormessage('Enter the valid Email ID.')); field.focus(); return false; } }
	var passData = "switchtype=checkemailid&smsuserid=" +  encodeURIComponent($('#smsaccount').val()) + "&smsemailid=" + encodeURIComponent($('#smsemailid').val()) + "&dummy=" +  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/retrivesmspassword.php";
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');	
	ajaxcall10 = $.ajax(
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
					//error.innerHTML = '';
					var response = ajaxresponse;
					if(response['verifiedresult'] == 1)
					{
						error.innerHTML = ''; 
					}
					else
					{
						error.innerHTML = errormessage(response['verifiedresult']);
	
					}
				
				}
				
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1_1").html(scripterror());
		}
	});		

}

function retrivesmspassword()
{
	var form = $("#submitform");
	var error = $('#form-error');
	var field = $('#smsaccount');
	if(!field.val()) {error.html(errormessage('Please select an Account')); field.focus(); return false; }
	var field = $('#smsemailid');
	if(!field.val()) {error.html(errormessage('Please Enter the Email ID')); field.focus(); return false; }
	if(field.val())	{ if(!singleemailidvalidation(field.val())) { error.html(errormessage('Enter the valid Email ID.')); field.focus(); return false; } }
	var confirmation = confirm("This provision will reset your existing password. Note that, existing password becomes unusable. Do you really wish to send the reset password via email");
	if(confirmation)
	{
		//document.getElementById('confirmresetpassword').disabled = true;
		var passData = "switchtype=retrivesmspassword&smsuserid=" + encodeURIComponent($('#smsaccount').val()) + "&smsemailid=" +encodeURIComponent($('#smsemailid').val()) + "&dummy=" + Math.floor(Math.random()*10054300000);
		$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');	
		queryString = "../ajax/retrivesmspassword.php";
		ajaxcall10 = $.ajax(
		{
			type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse;
					if(response['errorcode'] == '1')
					{
						$('#form-error').html(successmessage(response['errormsg']));
						$("#submitform")[0].reset();
					}
					else
					{
						$('#form-error').html(errormessage(response['errormsg']));
						$("#submitform")[0].reset();
					}
				}
			}, 
			error: function(a,b)
			{
				$("#form-error").html(scripterror());
			}
		});		
	}
	else
	{
		$('#form-error').html('');
		$("#submitform")[0].reset();
	}
}

function getuseraccountlist()
{
	var form = $('#submitform');
	var passData = "switchtype=getuseraccountlist&dummy=" + Math.floor(Math.random()*10054300000);
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	queryString = "../ajax/retrivesmspassword.php";
	ajaxcall112 = $.ajax(
	{
		type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
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
				$('#smsaccountlist').html(ajaxresponse);
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1_1").html(scripterror());
		}
	});		
}

function singleemailidvalidation(emailid)
{
	var emailExp = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}$/i;
	if(emailid.match(emailExp)) { return true; }
	else { return false; }
} 