function viewlicensedetails(startlimit)
{
	var form = $('#submitform');
	var passdata = "switchtype=view&dummy="+  Math.floor(Math.random()*1000782200000)+ "&startlimit=" + encodeURIComponent(startlimit);
	var queryString = "../ajax/viewlicense.php";
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	ajaxobjext14 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(response,status)
		{	
			var ajaxresponse = response;//alert(ajaxresponse)
			$('#form-error').html('');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				if(ajaxresponse['errorcode'] == '1')
				{
					$('#tabgroupgridc1').show();
					$('#tabgroupgridc1_1').html(ajaxresponse['message']);
				}
				else if(ajaxresponse['errorcode'] == '2')
				{
					var responseajax = ajaxresponse['message'].split('$$');
					var response1 = responseajax[0].split('^');
					var response2 = responseajax[1].split('^');
					var response3 = responseajax[2].split('^');
					var response4 = responseajax[3].split('^');
					var response5 = responseajax[4].split('^');
					var response6 = responseajax[5].split('^');
					var response7 = responseajax[6].split('^');
					var response8 = responseajax[7].split('^');
					var response9 = responseajax[8].split('^');
					var response10 = responseajax[9].split('^');
					var response11 = responseajax[10].split('^');
					var response12 = responseajax[11].split('^');
					var response13 = responseajax[12].split('^');
					
					if(response1 != '')
					{
						$('#tabgroupgridc1').show();
						$('#tabgroupgridc1_1').html(response1[0]);
						$('#tabgroupgridc1link').html(response1[1]);
					}
					if(response2 != '')
					{
						$('#tabgroupgridc2').show();
						$('#tabgroupgridc1_2').html(response2[0]);
						$('#tabgroupgridc2link').html(response2[1]);
					}
					if(response3 != '')
					{
						$('#tabgroupgridc3').show();
						$('#tabgroupgridc1_3').html(response3[0]);
						$('#tabgroupgridc3link').html(response3[1]);
					}
					if(response4 != '')
					{
						$('#tabgroupgridc4').show();
						$('#tabgroupgridc1_4').html(response4[0]);
						$('#tabgroupgridc4link').html(response4[1]);
					}
					
					if(response5 != '')
					{
						$('#tabgroupgridc5').show();
						$('#tabgroupgridc1_5').html(response5[0]);
						$('#tabgroupgridc5link').html(response5[1]);
					}
					
					if(response6 != '')
					{
						$('#tabgroupgridc6').show();
						$('#tabgroupgridc1_6').html(response6[0]);
						$('#tabgroupgridc6link').html(response6[1]);
					}
					if(response7 != '')
					{
						$('#tabgroupgridc7').show();
						$('#tabgroupgridc1_7').html(response7[0]);
						$('#tabgroupgridc7link').html(response7[1]);
					}
					if(response8 != '')
					{
						$('#tabgroupgridc8').show();
						$('#tabgroupgridc1_8').html(response8[0]);
						$('#tabgroupgridc8link').html(response8[1]);
					}
					if(response9 != '')
					{
						$('#tabgroupgridc9').show();
						$('#tabgroupgridc1_9').html(response9[0]);
						$('#tabgroupgridc9link').html(response9[1]);
					}
					if(response10 != '')
					{
						$('#tabgroupgridc10').show();
						$('#tabgroupgridc1_10').html(response10[0]);
						$('#tabgroupgridc10link').html(response10[1]);
					}
					if(response11 != '')
					{
						$('#tabgroupgridc11').show();
						$('#tabgroupgridc1_11').html(response11[0]);
						$('#tabgroupgridc11link').html(response11[1]);
					}
					if(response12 != '')
					{
						$('#tabgroupgridc12').show();
						$('#tabgroupgridc1_12').html(response12[0]);
						$('#tabgroupgridc12link').html(response12[1]);
					}
					if(response13 != '')
					{
						$('#tabgroupgridc13').show();
						$('#tabgroupgridc1_13').html(response13[0]);
						$('#tabgroupgridc13link').html(response13[1]);
					}
				}
			}
		}, 
		error: function(a,b)
		{
			$("#form-error").html(scripterror());
		}
	});		
}

function getmoreesigndetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);//alert(passData)
	var queryString = "../ajax/viewlicense.php";
	$('#moredis').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall1 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');//alert(responseajax);
				$('#moredis').html('');
				var response1 = responseajax[0].split('^');
				$('#resultgrid1').html($('#tabgroupgridc1_1').html());
				$('#tabgroupgridc1_1').html($('#resultgrid1').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc1link').html(response1[1]);
				
				
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc1link").html(scripterror());
		}
	});		
}


function getmorecontactdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis1').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall2 = $.ajax(
		{
			type: "POST",url: queryString, data: passdata, cache: false, dataType: "json",
			success: function(ajaxresponse,status)
			{	
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var responseajax = ajaxresponse.split('$$');
					$('#moredis1').html('');
					var response1 = responseajax[1].split('^');
					$('#resultgrid2').html($('#tabgroupgridc1_2').html());
					
					$('#tabgroupgridc1_2').html($('#resultgrid2').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
					//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
					$('#tabgroupgridc2link').html(response1[1]);
					
					
				}
			}, 
			error: function(a,b)
			{
				$("#tabgroupgridc2link").html(scripterror());
			}
		});		
}



function getmorestodetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis2').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall4 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false, dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis2').html('');
				var response1 = responseajax[2].split('^');
				$('#resultgrid3').html($('#tabgroupgridc1_3').html());
				
				$('#tabgroupgridc1_3').html($('#resultgrid3').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc3link').html(response1[1]);
				
				
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc3link").html(scripterror());
		}
	});		
}


function getmoresppdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis3').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall5 = $.ajax(
		{
			type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var responseajax = ajaxresponse.split('$$');
					$('#moredis3').html('');
					var response1 = responseajax[3].split('^');
					$('#resultgrid4').html($('#tabgroupgridc1_4').html());
					
					$('#tabgroupgridc1_4').html($('#resultgrid4').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
					//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
					$('#tabgroupgridc4link').html(response1[1]);
					
					
				}
			}, 
			error: function(a,b)
			{
				$("#tabgroupgridc4link").html(scripterror());
			}
		});		
}

function getmoresacdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis4').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall6 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis4').html('');
				var response1 = responseajax[4].split('^');
				$('#resultgrid5').html($('#tabgroupgridc1_5').html());
				
				$('#tabgroupgridc1_5').html($('#resultgrid5').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc5link').html(response1[1]);
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc5link").html(scripterror());
		}
	});		
}

function getmoreothersdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis5').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall7 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis5').html('');
				var response1 = responseajax[5].split('^');
				$('#resultgrid6').html($('#tabgroupgridc1_6').html());
				
				$('#tabgroupgridc1_6').html($('#resultgrid6').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc6link').html(response1[1]);
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc6link").html(scripterror());
		}
	});		
}

function getmoresurveydetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis6').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall8 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis6').html('');
				var response1 = responseajax[6].split('^');
				$('#resultgrid7').html($('#tabgroupgridc1_7').html());
				
				$('#tabgroupgridc1_7').html($('#resultgrid7').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc7link').html(response1[1]);
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc7link").html(scripterror());
		}
	});		
}


function getmoretdsdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passData = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);//alert(passData)
	var queryString = "../ajax/viewlicense.php";
	$('#moredis7').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall9 = $.ajax(
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
				var responseajax = ajaxresponse.split('$$');//alert(responseajax)
				$('#moredis7').html('');
				var response1 = responseajax[7].split('^');
				$('#resultgrid8').html($('#tabgroupgridc1_8').html());
				
				$('#tabgroupgridc1_8').html($('#resultgrid8').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc8link').html(response1[1]);
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc8link").html(scripterror());
		}
	});		
}


function getmoresvhdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis8').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall10 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis8').html('');
				var response1 = responseajax[8].split('^');
				$('#resultgrid9').html($('#tabgroupgridc1_9').html());
				
				$('#tabgroupgridc1_9').html($('#resultgrid9').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc9link').html(response1[1]);
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc9link").html(scripterror());
		}
	});		
}

function getmoresvidetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis9').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall11 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis9').html('');
				var response1 = responseajax[9].split('^');
				$('#resultgrid10').html($('#tabgroupgridc1_10').html());
				
				$('#tabgroupgridc1_10').html($('#resultgrid10').html().replace(/\<\/div\>/gi,'') + response1[0]) ;
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc10link').html(response1[1]);
				
				
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc10link").html(scripterror());
		}
	});		
}


function getmoreairdetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis10').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall12 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis10').html('');
				var response1 = responseajax[10].split('^');
				$('#resultgrid11').html($('#tabgroupgridc1_11').html());
				
				$('#tabgroupgridc1_11').html($('#resultgrid11').html().replace(/\<\/div\>/gi,'') + response1[0]);
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc11link').html(response1[1]);
				
				
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc11link").html(scripterror());
		}
	});		
}

function getmorenadetails(array,cusid,limit,slno)
{
	var form = $('#submitform');
	var passdata = "switchtype=recorddisplay&limit=" + limit+ "&slno=" + slno + "&array=" + array  + "&cusid=" + cusid + "&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/viewlicense.php";
	$('#moredis11').html('<img src="../images/ajax-loader.gif" border="0"/>');
	ajaxcall13 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			{
				var responseajax = ajaxresponse.split('$$');
				$('#moredis11').html('');
				var response1 = responseajax[11].split('^');
				$('#resultgrid12').html($('#tabgroupgridc1_12').html());
				
				$('#tabgroupgridc1_12').html($('#resultgrid12').html().replace(/\<\/div\>/gi,'') + response1[0]);
				//alert(document.getElementById('tabgroupgridc1_1').innerHTML)
				$('#tabgroupgridc12link').html(response1[1]);
				
				
			}
		}, 
		error: function(a,b)
		{
			$("#tabgroupgridc12link").html(scripterror());
		}
	});		
}



