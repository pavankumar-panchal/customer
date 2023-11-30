function formsubmiting(cusid)
{ 
	var form = $('#submitform'); 
	var error = $('#form-error');
	var subject = $('#subject');
	var message = $('#message');
	var femail = $('#femail');	
	//var field = form.email;
	if(!femail.val()){error.html(errormessage("Select a From Email ID")); return false; field.focus(); }
	if(!subject.val()){error.html(errormessage("Enter the Subject for your message.")); return false; field.focus(); }
	error.html('');
	var field = $('#category');
	if(!field.val()){error.html(errormessage("Select a Proper Category to whom the mesage has to be designated.")); return false; field.focus(); }
	var field = $('#product');
	if(!field.val()){error.html(errormessage("Select a Product group.")); return false; field.focus(); }
	error.html('');
	if(message.val().length < 5){error.html(errormessage("Enter your message (Should be more than 5 Characters).")); return false; field.focus(); }
	error.html('');

	var passdata = "type=save&femail=" + encodeURIComponent(femail.val())  +  "&subject=" + encodeURIComponent(subject.val()) + "&category=" + encodeURIComponent($('#category').val()) +"&message=" + encodeURIComponent(message.val()) +"&product=" + encodeURIComponent($('#product').val()) + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passdata)
	disablesend();
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	var queryString = "../ajax/saraltds-blr.php";
	ajaxcall0 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			var response = ajaxresponse;
			if(response == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				$('#form-error').html('');
				$('#form-error').html(successmessage(response['errormsg']));
				$('#submitform')[0].reset();
			}
		}, 
		error: function(a,b)
		{
			$("#form-error").html(scripterror());
		}
	});	
}

