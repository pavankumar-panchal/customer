function formsubmiting(cusid)
{ 
	var form = $('#submitform'); 
	var error = $('#form-error');
	var txt_part_1 = $('#txt_part_1');
	var txt_email_1 = $('#txt_email_1');
	var txt_con_1 = $('#txt_con_1');	
	

	var passdata = "type=save&txt_part_1=" + encodeURIComponent(txt_part_1.val())  +  "&txt_email_1=" + encodeURIComponent(txt_email_1.val()) + "&txt_con_1=" + encodeURIComponent($('#txt_con_1').val())  + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passdata)
	disablesend();
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	var queryString = "../ajax/writetorelyon.php";
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

