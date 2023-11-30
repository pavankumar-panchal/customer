
function enablepayment()
{
	document.submitform.payment.disabled = false;
	document.submitform.payment.className = 'swiftchoicebutton';
	document.submitform.payment.disabled = false;
	document.submitform.payment.className = 'swiftchoicebutton';
}

//Function to enable the payment button--------------------------------------------------------------------------------
function disablepayment()
{
	document.submitform.payment.disabled = true;
	document.submitform.payment.className = 'swiftchoicebuttondisabled';
	document.submitform.payment.disabled = true;
	document.submitform.payment.className = 'swiftchoicebuttondisabled';
}

function  paymentserial()
{
	/*var form = $('#submitform');
	//form.action = '../makepayment/pay.php';
	//form.target = '_blank';
	form.action = 'dummy.php';
	//form.action = 'test.php';
	form.submit();*/
	$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepayment/pay.php") ;
	//$('#submitform').attr("action", "dummy.php") ;
	//$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
}

function calctotal()
{
	var form = document.submitform;
	var result= document.getElementsByName("productcheck[]");
	var resulttotal = 0 ;
	for(var i=0; i < result.length; i++)
	{
		if(result[i].checked)
		{
			var resultsplit = result[i].value.split('^');
			var resulttotal = resulttotal + parseInt(resultsplit[1]) ;
			
		}
	}
	if(resulttotal == '0')
	{
		disablepayment();
	}
	else
	{
		enablepayment();
	}
	document.getElementById("totalresult").innerHTML = resulttotal;

}


function proceedpayment()
{
	var form = document.submitexistform;	
	var mode1=document.submitexistform.paymode[0].checked;
	var mode2=document.submitexistform.paymode[1].checked;
	//var res=document.getElementById('onlineinvoiceno').value;
	var mode='';
	if(mode1==true && mode2==false)
	{
		//mode="credit";		
		/*form.action = '../makepayment/pay.php';
		form.submit();*/
		
		$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepayment/pay.php") ;
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
		
		$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepayment/paycitrus.php") ;
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
	$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepayment/paymode.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	       
   /*loadPopupBox();
	$("body").append('<div class="modalOverlay">'); 
	//$('#lslnop').val(onlineslno);
	//$('#onlineinvoiceno').val(onlineslno);
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