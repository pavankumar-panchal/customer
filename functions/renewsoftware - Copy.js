// JavaScript Document

function renewsoftware()
{
	var passData = '';
	$('#notrenewed').show();
	$('#resultdiv').html(getprocessingimage());
	passdata = "switchtype=getdata&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(response,status)
		{	
			$('#resultdiv').html('');
			var ajaxresponse = response;//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse['errorcode'] == '1')
				{
					$('#notrenewed').show();
					$('#resultdiv').html(ajaxresponse['grid']);
					$('#previousyear').html(ajaxresponse['previousyear']);
					$('#previousyearhidden').val(ajaxresponse['previousyear']);
					$('#currentyear').html(ajaxresponse['currentyear']);
				}
				if(ajaxresponse['errorcode'] == '2')
				{
					//alert('here');
					$('#notrenewed').show();
					$('#previousyear').html(ajaxresponse['previousyear']);
					$('#currentyear').html(ajaxresponse['currentyear']);
					$('#resultdiv').html(ajaxresponse['grid']);
				}
				if(ajaxresponse['errorcode'] == '3')
				{
					$('#notrenewed').show();
					$('#previousyear').html('Not Available');
					$('#currentyear').html('Not Available');
					$('#resultdiv').html(ajaxresponse['grid']);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdiv").html(scripterror());
		}
	});		
}


function paynow()
{

	$('#resultdiv').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedata&previousyear=" + encodeURIComponent($('#previousyearhidden').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(response,status)
		{	
			$('#resultdiv').html('');
			var ajaxresponse = response;
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				alert(ajaxresponse['slno'])
				if(ajaxresponse['errorcode'] == '1')
				{
					makepayment(ajaxresponse['slno']);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdiv").html(scripterror());
		}
	});		

}


function makepayment(onlineslno)
{
	if(onlineslno != '')
		$('#onlineslno').val(onlineslno);
	//$('#submitform').attr("action", "../purchase/test1.php") ;
	
	$('#submitform').attr("action", "../makepaymentforrenewproduct/pay.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	//renewsoftware();
}