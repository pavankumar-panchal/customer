function viewdeliveryreport()
{
	var form = $('#submitform');
	var error = $('#form-error');
	var field = $('#smsaccount');
	if(!field.val()){error.html(errormessage('Select an Account Type')); field.focus(); return false;}
	var field =  $('#smspassword');
	if(!field.val()){error.html(errormessage('Enter the Password')); field.focus(); return false;}
	var passData = "switchtype=verifypassword&smsuserid=" +  encodeURIComponent( $('#smsaccount').val()) + "&smspassword=" + encodeURIComponent($('#smspassword').val()) + "&dummy=" +  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/smsdeliveryreport.php";
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');	
	ajaxcall416 = $.ajax(
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
				var response = ajaxresponse.split('^');
				if(response[0] == 1)
				{
					generatedeliveryreportgrid('');
				}
				else
				{
					error.html(errormessage(response[1]));
					$('#tabgroupgridwb1').html('');
					$('#tabgroupgridc1_1').html('');
					$('#tabgroupgridc1link').html('');
				}
			
			}
				
		}, 
		error: function(a,b)
		{
			$('#form-error').html(scripterror());
		}
	});		
}


function generatedeliveryreportgrid(startlimit)
{
	var form = $('#submitform');
	var error = $('#form-error');
	var startlimit = '';
	var passData = "switchtype=generatedeliveryreportgrid&startlimit="+ encodeURIComponent(startlimit) + "&smsuserid=" + encodeURIComponent($('#smsaccount').val())+ "&smspassword=" + encodeURIComponent($('#smspassword').val());
	var queryString = "../ajax/smsdeliveryreport.php";
	$('#tabgroupgridc1_1').html('<img src="../images/imax-loading-image.gif" border="0"/>');	
	$('#tabgroupgridc1link').html('');
	ajaxcall41 = $.ajax(
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
				error.html('');
				var response = ajaxresponse;
				if(response['errorcode'] == 1)
				{
					$('#tabgroupgridwb1').html("Total Count :  " + response['fetchresultcount']);
					$('#tabgroupgridc1_1').html(response['grid']);
					$('#tabgroupgridc1link').html(response['linkgrid']);
				}
				else
				{
					$('#tabgroupgridwb1').html("Total Count :  " + response['fetchresultcount']);
					$('#tabgroupgridc1_1').html(response['grid']);
					$('#tabgroupgridc1link').html(response['linkgrid']);

				}
				
			}
				
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1_1").html(scripterror());
		}
	});		
}

//Function for "show more records" or  "show all records" link  - to get registration records
function getmoregeneratedeliveryreportgrid(startlimit,slnocount,showtype)
{
	
	var form = $("#submitform");
//	document.getElementById('lastslno').value = id;	
	var passData = "switchtype=generatedeliveryreportgrid&startlimit="+ encodeURIComponent(startlimit) + "&slnocount=" + encodeURIComponent(slnocount) + "&showtype=" + encodeURIComponent(showtype) + "&smsuserid=" + encodeURIComponent($("#smsaccount").val())  + "&smspassword=" + encodeURIComponent($("#smspassword").val()) + "&dummy=" + Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/smsdeliveryreport.php";
	$('#tabgroupgridc1link').html('<img src="../images/imax-loading-image.gif" border="0"/>');	
	ajaxcall42 = $.ajax(
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
					if(response['errorcode'] == 1)
					{
						$('#tabgroupgridwb1').html("Total Count :  " + response['fetchresultcount']);
						$('#resultgrid').html($('#tabgroupgridc1_1').html());
						$('#tabgroupgridc1_1').html($('#resultgrid').html().replace(/\<\/table\>/gi,'')+ response['grid']);
						$('#tabgroupgridc1link').html(response['linkgrid']);
					}
					else
					{
						$('#tabgroupgridwb1').html("Total Count :  " + response['fetchresultcount']);
						$('#tabgroupgridc1_1').html(response['grid']);
						$('#tabgroupgridc1link').html(response['linkgrid']);
					}
				}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1link").html(scripterror());
		}
	});		
}
function getuseraccountlist()
{
	var form = $('#submitform');
	var passData = "switchtype=getuseraccountlist&dummy=" + Math.floor(Math.random()*10054300000);
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	queryString = "../ajax/smsdeliveryreport.php";
	ajaxcall427 = $.ajax(
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
			$("#form-error").html(scripterror());
		}
	});		
}