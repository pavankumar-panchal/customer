// JavaScript Document
function getsmstariff()
{
	var form = $('#submitform');
	var error = $('#form-error');
	var passData =  "switchtype=getsmstariff&dummy=" + Math.floor(Math.random()*100000000);
	queryString = '../ajax/smsbuy.php';
	ajaxcall10 = $.ajax(
	{
		type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
				$('#displaytariff').html(ajaxresponse['grid']);
		}, 
		error: function(a,b)
		{
			error.html(scripterror());
		}
	});			
}

function gotosmsbuypage()
{
	//var form = document.submitform;
	//form.action = "http://imax.relyonsoft.net/sms/buy/";
	//form.target = "_blank";
	//form.submit();	
	$('#submitform').attr("action", "http://imax.relyonsoft.net/sms/buy/") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
}