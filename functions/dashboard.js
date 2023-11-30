// JavaScript Document

function getinvoices()
{
	var passData = '';
	passData = "switchtype=getinvoices&dummy=" + Math.floor(Math.random()*100000000);
	ajaxcall3 = createajax();//alert(passData);
	var queryString = "../ajax/dashboard.php";
	ajaxcall3.open("POST", queryString, true);
	ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall3.onreadystatechange = function()
	{
		if(ajaxcall3.readyState == 4)
		{
			var ajaxresponse = ajaxcall3.responseText.split('^');//alert(ajaxresponse[2]);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					if(ajaxresponse[2] != '0')
					{
						$("#displayduedetails").show();
						$("#tabgroupgridc1_1").html(ajaxresponse[1]);
					}
				}
				
			}
		}
	}
	ajaxcall3.send(passData);
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