function formsubmiting(cusid)
{ 
	
	var form = $('#submitform'); 
	var error = $('#form-error');
	var txt_part_1 = $('#txt_part_1');
	var txt_email_1 = $('#txt_email_1');
	var txt_con_1 = $('#txt_con_1');	
	
	var txt_part_2 = $('#txt_part_2');
	var txt_email_2 = $('#txt_email_2');
	var txt_con_2 = $('#txt_con_2');	
	
	var txt_part_3 = $('#txt_part_3');
	var txt_email_3 = $('#txt_email_3');
	var txt_con_3 = $('#txt_con_3');	
	
	var txt_part_4 = $('#txt_part_4');
	var txt_email_4 = $('#txt_email_4');
	var txt_con_4 = $('#txt_con_4');	
	
	var txt_part_5 = $('#txt_part_5');
	var txt_email_5 = $('#txt_email_5');
	var txt_con_5 = $('#txt_con_5');	
	
	var txt_part_6 = $('#txt_part_6');
	var txt_email_6 = $('#txt_email_6');
	var txt_con_6 = $('#txt_con_6');
	
	var txtCheque = $('#txtCheque');
	var txtChequeDate = $('#txtChequeDate');
	var txtBankName = $('#txtBankName');	
	

	var passdata = "type=save&txt_part_1=" + encodeURIComponent(txt_part_1.val())  +  "&txt_email_1=" + encodeURIComponent(txt_email_1.val()) + "&txt_con_1=" + encodeURIComponent($('#txt_con_1').val())  + "&txt_part_2=" + encodeURIComponent(txt_part_2.val())  +  "&txt_email_2=" + encodeURIComponent(txt_email_2.val()) + "&txt_con_2=" + encodeURIComponent($('#txt_con_2').val())  + "&txt_part_3=" + encodeURIComponent(txt_part_3.val())  +  "&txt_email_3=" + encodeURIComponent(txt_email_3.val()) + "&txt_con_3=" + encodeURIComponent($('#txt_con_3').val())  + "&txt_part_4=" + encodeURIComponent(txt_part_4.val())  +  "&txt_email_4=" + encodeURIComponent(txt_email_4.val()) + "&txt_con_4=" + encodeURIComponent($('#txt_con_4').val())  + "&txt_part_5=" + encodeURIComponent(txt_part_5.val())  +  "&txt_email_5=" + encodeURIComponent(txt_email_5.val()) + "&txt_con_5=" + encodeURIComponent($('#txt_con_5').val())  + "&txt_part_6=" + encodeURIComponent(txt_part_6.val())  +  "&txt_email_6=" + encodeURIComponent(txt_email_6.val()) + "&txt_con_6=" + encodeURIComponent($('#txt_con_6').val())  + "&txtCheque="+ encodeURIComponent($('#txtCheque').val()) +"&txtChequeDate="+ encodeURIComponent($('#txtChequeDate').val()) +"&txtBankName="+ encodeURIComponent($('#txtBankName').val()) +"&dummy=" + Math.floor(Math.random()*100000000);//alert(passdata)
	//alert(passdata);
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

