// JavaScript Document

function renewsoftware()
{
	var passData = '';
	$('#TDS').show();
	$('#resultdiv').html(getprocessingimage());
	passdata = "switchtype=getdata&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdiv').html('');
			var ajaxresponse = response.split('^');//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					$('#TDS').show();
					$('#resultdiv').html(ajaxresponse[1]);
					$('#previousyear').html(ajaxresponse[2]);
					$('#productcodehidden').val(ajaxresponse[4]);
					$('#productusagetype').val(ajaxresponse[5]);
					$('#currentyear').html(ajaxresponse[3]);
				}
				if(ajaxresponse[0] == '2')
				{
					//alert('here');
					$('#TDS').hide();
					$('#previousyear').html(ajaxresponse[2]);
					$('#currentyear').html(ajaxresponse[3]);
					$('#resultdiv').html(ajaxresponse[1]);
				}
				if(ajaxresponse[0] == '3')
				{
					$('#TDS').show();
					$('#previousyear').html('Not Available');
					$('#currentyear').html(ajaxresponse[2]);
					$('#resultdiv').html(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdiv").html(scripterror());
		}
	});		
}

function renewsoftwaresto()
{
	var passData = '';
	$('#STO').show();
	$('#resultdivsto').html(getprocessingimage());
	passdata = "switchtype=getdatasto&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivsto').html('');
			var ajaxresponse = response.split('^');//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					$('#STO').show();
					$('#resultdivsto').html(ajaxresponse[1]);
					$('#previousyearsto').html(ajaxresponse[2]);
					$('#productcodehiddensto').val(ajaxresponse[4]);
					$('#productusagetypesto').val(ajaxresponse[5]);
					$('#currentyearsto').html(ajaxresponse[3]);
				}
				if(ajaxresponse[0] == '2')
				{
					//alert('here');
					$('#STO').hide();
					$('#previousyearsto').html(ajaxresponse[2]);
					$('#currentyearsto').html(ajaxresponse[3]);
					$('#resultdivsto').html(ajaxresponse[1]);
				}
				if(ajaxresponse[0] == '3')
				{
					$('#STO').show();
					$('#previousyearsto').html('Not Available');
					$('#currentyearsto').html(ajaxresponse[2]);
					$('#resultdivsto').html(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivsto").html(scripterror());
		}
	});		
}


function renewsoftwaresvi()
{
	var passData = '';
	$('#SVI').show();
	$('#resultdivsvi').html(getprocessingimage());
	passdata = "switchtype=getdatasvi&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivsvi').html('');
			var ajaxresponse = response.split('^');//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					$('#SVI').show();
					$('#resultdivsvi').html(ajaxresponse[1]);
					$('#previousyearsvi').html(ajaxresponse[2]);
					$('#productcodehiddensvi').val(ajaxresponse[4]);
					$('#productusagetypesvi').val(ajaxresponse[5]);
					$('#currentyearsvi').html(ajaxresponse[3]);
				}
				if(ajaxresponse[0] == '2')
				{
					//alert('here');
					$('#SVI').hide();
					$('#previousyearsvi').html(ajaxresponse[2]);
					$('#currentyearsvi').html(ajaxresponse[3]);
					$('#resultdivsvi').html(ajaxresponse[1]);
				}
				if(ajaxresponse[0] == '3')
				{
					$('#SVI').show();
					$('#previousyearsvi').html('Not Available');
					$('#currentyearsvi').html(ajaxresponse[2]);
					$('#resultdivsvi').html(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivsvi").html(scripterror());
		}
	});		
}


function renewsoftwaresvh()
{
	var passData = '';
	$('#SVH').show();
	$('#resultdivsvh').html(getprocessingimage());
	passdata = "switchtype=getdatasvh&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivsvh').html('');
			var ajaxresponse = response.split('^');//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					$('#SVH').show();
					$('#resultdivsvh').html(ajaxresponse[1]);
					$('#previousyearsvh').html(ajaxresponse[2]);
					$('#productcodehiddensvh').val(ajaxresponse[4]);
					$('#productusagetypesvh').val(ajaxresponse[5]);
					$('#currentyearsvh').html(ajaxresponse[3]);
				}
				if(ajaxresponse[0] == '2')
				{
					//alert('here');
					$('#SVH').hide();
					$('#previousyearsvh').html(ajaxresponse[2]);
					$('#currentyearsvh').html(ajaxresponse[3]);
					$('#resultdivsvh').html(ajaxresponse[1]);
				}
				if(ajaxresponse[0] == '3')
				{
					$('#SVH').show();
					$('#previousyearsvh').html('Not Available');
					$('#currentyearsvh').html(ajaxresponse[2]);
					$('#resultdivsvh').html(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivsvh").html(scripterror());
		}
	});		
}

//added for xbrl on 10/03/2018

function renewsoftwarexbrl()
{
	var passData = '';
	$('#XBRL').show();
	$('#resultdivxbrl').html(getprocessingimage());
	passdata = "switchtype=getdataxbrl&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivxbrl').html('');
			var ajaxresponse = response.split('^');
			//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					$('#XBRL').show();
					$('#resultdivxbrl').html(ajaxresponse[1]);
					$('#previousyearxbrl').html(ajaxresponse[2]);
					$('#productcodehiddenxbrl').val(ajaxresponse[4]);
					$('#productusagetypexbrl').val(ajaxresponse[5]);
					$('#currentyearxbrl').html(ajaxresponse[3]);
				}
				if(ajaxresponse[0] == '2')
				{
					//alert('here');
					$('#XBRL').hide();
					$('#previousyearxbrl').html(ajaxresponse[2]);
					$('#currentyearxbrl').html(ajaxresponse[3]);
					$('#resultdivxbrl').html(ajaxresponse[1]);
				}
				if(ajaxresponse[0] == '3')
				{
					$('#XBRL').show();
					$('#previousyearxbrl').html('Not Available');
					$('#currentyearxbrl').html(ajaxresponse[2]);
					$('#resultdivxbrl').html(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivxbrl").html(scripterror());
		}
	});		
}

//added on 29 June 2020
function renewsoftwaregstn()
{
	var passData = '';
	$('#GSTN').show();
	$('#resultdivgstn').html(getprocessingimage());
	passdata = "switchtype=getdatagstn&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivgstn').html('');
			var ajaxresponse = response.split('^');
			//alert(ajaxresponse);
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					$('#GSTN').show();
					$('#resultdivgstn').html(ajaxresponse[1]);
					$('#previousyeargstn').html(ajaxresponse[2]);
					$('#productcodehiddengstn').val(ajaxresponse[4]);
					$('#productusagetypegstn').val(ajaxresponse[5]);
					$('#currentyeargstn').html(ajaxresponse[3]);
				}
				if(ajaxresponse[0] == '2')
				{
					//alert('here');
					$('#GSTN').hide();
					$('#previousyeargstn').html(ajaxresponse[2]);
					$('#currentyeargstn').html(ajaxresponse[3]);
					$('#resultdivgstn').html(ajaxresponse[1]);
				}
				if(ajaxresponse[0] == '3')
				{
					$('#GSTN').show();
					$('#previousyeargstn').html('Not Available');
					$('#currentyeargstn').html(ajaxresponse[2]);
					$('#resultdivgstn').html(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivgstn").html(scripterror());
		}
	});		
}

function paynow()
{

	$('#resultdiv').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedata&productcodehidden=" + encodeURIComponent($('#productcodehidden').val())+"&productusagetype=" + encodeURIComponent($('#productusagetype').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdiv').html('');
			var ajaxresponse = response.split('^');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					makepaymentnow(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdiv").html(scripterror());
		}
	});		

}

function paynowsvi()
{

	$('#resultdivsvi').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedatasvi&productcodehidden=" + encodeURIComponent($('#productcodehiddensvi').val())+"&productusagetype=" + encodeURIComponent($('#productusagetypesvi').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivsvi').html('');
			var ajaxresponse = response.split('^');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					makepaymentnow(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivsvi").html(scripterror());
		}
	});		

}

function paynowsvh()
{

	$('#resultdivsvh').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedatasvh&productcodehidden=" + encodeURIComponent($('#productcodehiddensvh').val())+"&productusagetype=" + encodeURIComponent($('#productusagetypesvh').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivsvh').html('');
			var ajaxresponse = response.split('^');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					makepaymentnow(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivsvh").html(scripterror());
		}
	});		

}
function paynowsto()
{

	$('#resultdivsto').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedatasto&productcodehidden=" + encodeURIComponent($('#productcodehiddensto').val())+"&productusagetype=" + encodeURIComponent($('#productusagetypesto').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivsto').html('');
			var ajaxresponse = response.split('^');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					makepaymentnow(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivstoU").html(scripterror());
		}
	});		

}
function paynowgstn()
{

	$('#resultdivsto').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedatagstn&productcodehidden=" + encodeURIComponent($('#productcodehiddengstn').val())+"&productusagetype=" + encodeURIComponent($('#productusagetypegstn').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivgstn').html('');
			var ajaxresponse = response.split('^');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					makepaymentnow(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivgstn").html(scripterror());
		}
	});		

}
function paynowxbrl()
{

	$('#resultdivxbrl').html(getprocessingimage());
	var passdata  = "switchtype=preonlinedataxbrl&productcodehidden=" + encodeURIComponent($('#productcodehiddenxbrl').val())+"&productusagetype=" + encodeURIComponent($('#productusagetypexbrl').val())+"&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/renewsoftware.php";
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,
		success: function(response,status)
		{	
			$('#resultdivxbrl').html('');
			var ajaxresponse = response.split('^');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse[0] == '1')
				{
					//alert(ajaxresponse[1]); exit;
					makepaymentnow(ajaxresponse[1]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#resultdivxbrl").html(scripterror());
		}
	});		

}

function makepayment(onlineslno)
{
	if(onlineslno != '') {
		$('#onlineslno').val(onlineslno);
	}
		
$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentforrenewproduct/paymode.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
			
	//$('#submitform').attr("action", "../makepaymentforrenewproduct/test1.php") ;
	
	/*$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentforrenewproduct/pay.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	//renewsoftware();*/
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
		
		$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentforrenewproduct/pay.php") ;
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
		
		//$('#submitform').attr("action", "http://imax.relyonsoft.com/customer/makepaymentforrenewproduct/paycitrus.php") ;
		//$('#submitform').attr( 'target', '_blank' );
		//$('#submitform').submit();
		//$(".modalOverlay").remove();         
		//unloadPopupBox();
		alert("Net Banking option has been disabled on temporary basis. Sorry for the inconvenience.");
	}
	else
	{
		//alert("Select mode of payment");
		$('#err').html('Select mode of payment');
		document.getElementById("paymode").focus();
	}
}

function makepaymentnow(onlineslno)
{       
	//alert(onlineslno);
	if(onlineslno != '') {
		$('#onlineslno').val(onlineslno);
	}

	$('#submitform').attr("action", "http://localhost/imax/customerpayment/makepaymentforrenewproduct/paymode.php") ;
	$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
	
		//alert(onlineslno);
	/*		  if(onlineslno != '')
			$('#onlineslno').val(onlineslno);
			loadPopupBox();
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