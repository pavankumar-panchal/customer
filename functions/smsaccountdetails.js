function getsmsaccountdetails()
{
	var form = document.submitform;
	var error = document.getElementById('form-error');
	var passData = "switchtype=getsmsaccountdetails&dummy="+  Math.floor(Math.random()*1000782200000);
	var queryString = "../ajax/smsaccountdetails.php";
	ajaxcall3 = createajax();
	document.getElementById('form-error').innerHTML = '<img src="../images/imax-loading-image.gif" border="0"/>';	
	ajaxcall3.open("POST", queryString, true);
	ajaxcall3.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcall3.onreadystatechange = function()
	{
		if(ajaxcall3.readyState == 4)
		{
			if(ajaxcall3.status == 200)
			{
				var ajaxresponse = ajaxcall3.responseText;
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					error.innerHTML = '';
					var response = ajaxresponse.split('^');
					if(response[0] == 1)
					{
						document.getElementById('displayaccountdetails').innerHTML = response[1];
						document.getElementById('displaylinks').style.display = 'block';
					}
					else if(response[0] == 2)
					{
						document.getElementById('displayaccountdetails').innerHTML = response[1];
						document.getElementById('displaylinks').style.display = 'none';
					}
					else
						document.getElementById('form-error').innerHTML =scripterror();
				}
				
			}
			else
				document.getElementById('form-error').innerHTML =scripterror();
		}
	}
	ajaxcall3.send(passData);
}

