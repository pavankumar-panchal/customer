function validation()
{ 
	var form = $('#submitform');
	var error = $('#form-error');
	var field = $("#customerid");
	if(!field.val()){error.html(errormessage("Customer ID cannot be blank. Please enter a valid Customer ID provided by Relyon. (To know your Customer ID " + '<a href="../retrival/customer.php" class="Links">Click here</a>).')); field.focus();  return false;}
	if(!validatecustomerid(field.val()))
	{ 
		error.html(errormessage("The Customer ID entered is not in proper format. Please enter a Valid Customer ID. (To know your Customer ID " + '<a href="../retrival/customer.php" class="Links">Click here</a>). ')); 
		field.focus(); 
		return false;
	}
	else
	{
		var passData  = "switchtype=retrival&customerid=" + encodeURIComponent(field.val()) + "&dummy=" + Math.floor(Math.random()*100000000);  
		//disablenext();
		var queryString = "../ajax/password.php";//alert(queryString)
		ajaxcall0 = $.ajax(
		{
			type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
				var responetext = ajaxresponse;
				if(responetext['errorcode'] == 1)
				{
					error.html('');
					$('#emailresult').html(responetext['value']);//alert(responetext[1])
					$('#lastslno').val(responetext['customerid']);
					$('#tabc1').hide();
					$('#tabc2').show();
					
					$('#displayselectedcustid').html(field.val().substring(0,4) + '-' + field.val().substring(4,8) + '-' + field.val().substring(8,12) + '-' + field.val().substring(12,17));
					disablenext();
				}
				else if(responetext['errorcode'] == 2)
				{
					error.html('');
					error.html(errormessage(responetext['errormsg']));
					enablenext();
				}
			}, 
			error: function(a,b)
			{
				error.html(scripterror());
			}
		});	
	}
}

function onblurvalue()
{
	var dtStr = $('#customerid').val();
	var val=dtStr.replace(/-/g,"");
	 $('#customerid').val(val);
}	


function formsubmiting()
{ 
	var form =  $('#submitform'); 
	var error =  $('#form-error1');
	var emailresult =  $('#email');
	var customerid =  $("#lastslno");
	//var customerid = document.getElementById('customerid');
	var field = $('#email');
	if(!field.val()){error.html(errormessage("Select the Email ID")); field.focus();  return false;}
	/*if(field.value)	{ if(!emailvalidation(field.value)) { error.innerHTML = errormessage('Enter the valid Email ID.'); field.focus(); return false; } }*/
	else
	{
		var passData  = "switchtype=send&emailresult=" + encodeURIComponent(emailresult.val()) + "&customerid=" + encodeURIComponent(customerid.val()) + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passData)
		disablesend();
		error.html('');
		$('#customerprocess').html('<img src="../images/imax-loading-image.gif" border="0"/>');
		var queryString = "../ajax/password.php";
		ajaxcall01 = $.ajax(
		{
			type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
					var response = ajaxresponse;
					if(response['errorcode'] == 1)//alert(response)
					{
						error.innerHTML ='';
						$('#customerprocess').html('');
						$('#tabc2').hide();
						$('#tabc3').show();
						$('#form-error2').html(displaysuccessmessage(response['errormsg']));
					}
					else if(response['errorcode'] == 2)
						window.location = "http://imax.relyonsoft.net/customer/index.php";
					else
						$('#form-error2').html(errormessage("Response unknown."));
			}, 
			error: function(a,b)
			{
				$("#form-error2").html(scripterror());
			}
		});	
	}
}
		