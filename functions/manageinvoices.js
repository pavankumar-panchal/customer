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
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse['errorcode'] == '1')
			{
				$('#moredis').html('');
				$("#resultgrid").html($("#tabgroupgridc1_1").html());
				$("#totalinvoices").html('Total Invoices : '+ ajaxresponse['fetchresultcount']);
				$("#tabgroupgridc1_1").html($("#resultgrid").html().replace(/\<\/table\>/gi,'')+ ajaxresponse['grid']);
				$("#getmorelink").html(ajaxresponse['linkgrid']);
				
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
	$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentonline/pay.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	//getgeneratedinvoices();
}


function proceedpayment()
{
	var form = document.submitexistform;	
	var mode1=document.submitexistform.paymode[0].checked;
	var mode2=document.submitexistform.paymode[1].checked;
	var res=document.getElementById('onlineinvoiceno').value;
	var mode='';
	if(mode1==true && mode2==false)
	{
		//mode="credit";		
		/*form.action = '../makepayment/pay.php';
		form.submit();*/
		
		$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentonline/pay.php") ;
		$('#submitform').attr( 'target', '_blank' );
		$('#submitform').submit();
		$(".modalOverlay").remove();         
		unloadPopupBox();
	}
	else if(mode1==false && mode2==true)
	{
		//mode="internet";
		/*form.action = '../makepayment/paycitrus.php';
		form.submit();*/
		
		$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentonline/paycitrus.php") ;
		$('#submitform').attr( 'target', '_blank' );
		$('#submitform').submit();
		$(".modalOverlay").remove();         
		unloadPopupBox();
	}
	else
	{
		//alert("Select mode of payment");
		$('#err').html('Select mode of payment');
		document.getElementById("paymode").focus();
	}
}

function paynow(onlineslno)
{    
	$('#onlineinvoiceno').val(onlineslno);
	$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentonline/paymode.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	    
/*	loadPopupBox();
	$("body").append('<div class="modalOverlay">'); 
	$('#lslnop').val(onlineslno);
	$('#onlineinvoiceno').val(onlineslno);
	
	
	$('#onlineslno').val(onlineslno);
	$('#submitform').attr("action", "../makepayment/pay.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();*/
}
function unloadPopupBox() {    // TO Unload the Popupbox
	var msg='&nbsp;';
	$('#err').html(msg);
	$('#invoicedetailsgrid').fadeOut("slow");
	/*$('body').css({ // this is just for style        
		"opacity": "1"  
	});*/ 
}    

function loadPopupBox() {    // To Load the Popupbox
	$('#invoicedetailsgrid').fadeIn("slow");
	/*$('body').css({ // this is just for style
		"opacity": "0.3"  
	});*/         
} 