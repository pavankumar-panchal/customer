// JavaScript Document

function getgeneratedinvoices()
{
	var passdata = '';
	$('#tabgroupgridc1_1').val(getprocessingimage());
	passdata = "switchtype=getinvoices&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/manageinvoices.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(response,status)
		{	
			$('#tabgroupgridc1_1').val('');
			var ajaxresponse = response;//alert(ajaxresponse);
			if(response == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse['errorcode'] == '1')
				{
					$("#totalinvoices").html('Total Invoices : '+ ajaxresponse['fetchresultcount']);
					$("#tabgroupgridc1_1").html(ajaxresponse['grid']); 
					$("#getmorelink").html(ajaxresponse['linkgrid']); 
				}
				
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1_1").html(scripterror());
		}
	});		
}


function getmoreinvoices(startlimit,slnocount,showtype)
{
	passdata = "switchtype=getinvoices&startlimit="+startlimit +"&slnocount="+slnocount+"&showtype="+showtype+"&dummy=" + Math.floor(Math.random()*100000000);
	$('#morerows').html('<img src="../images/ajax-loader.gif" border="0"/>');
	var queryString = "../ajax/manageinvoices.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			var response1 = response.split("|^|");
			if(response1[0] == '1')
			{
				$("#tabgroupgridc1_1").html(response1[1]);
				$("#getmorelink").html(response1[2]);
				$("#gridprocess").html(' => [Total number of Dealers (' + response1[3] +' Records)]') ;
			}
			else if(response1[0] == '2')
			{
				$("#tabgroupgridc1_1").html(response1[1]);
				$("#getmorelink").html(response1[2]);
				$("#gridprocess").html(' => [Total number of Dealers (' + response1[3] +' Records)]') ;
			}
			else
			{
				$("#gridprocess").html(scripterror()) ;
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1_1").html(scripterror());
		}
	});		
}

function viewinvoice(invoicenumber)
{
	if(invoicenumber != '')
		$('#onlineinvoiceno').val(invoicenumber);
		
	var form = $('#submitform');		
	$('#submitform').attr("action", "../ajax/viewinvoicepdf.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	
}

function makepayment(invoicenumber)
{
	if(invoicenumber != '')
		$('#onlineinvoiceno').val(invoicenumber);
	//$('#submitform').attr("action", "../purchase/dummy1.php") ;
	$('#submitform').attr("action", "../makepaymentonline/pay.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	//getgeneratedinvoices();
}