
var customerarray = new Array();


function smsformsubmit()
{
	var form = document.submitform;
	var error = document.getElementById('form-error');
	
	var field = form.contactperson;
	if(!field.value) { error.innerHTML = errormessage("Enter the Contact Person Name . "); field.focus(); return false; }
	if(field.value) { if(!validatesmscontactperson(field.value)) { error.innerHTML = errormessage('Contact person name contains special characters. Please use only Alpha / Numeric / space.'); field.focus(); return false; } }
	
	var field = form.emailid;
	if(!field.value) { error.innerHTML = errormessage("Enter the Email ID. "); field.focus(); return false; }
	if(field.value)	{ if(!emailsmsvalidation(field.value)) { error.innerHTML = errormessage('Enter the valid Email ID.'); field.focus(); return false; } }
	
	
	var field = form.cell;
	if(!field.value) { error.innerHTML = errormessage("Enter the Cell Number. "); field.focus(); return false; }
	if(field.value) { if(!validatesmscell(field.value)) { error.innerHTML = errormessage('Enter the valid Cell Number.'); field.focus(); return false; } }
	
	var field = form.fromname;
	if(!field.value) { error.innerHTML = errormessage("Enter the Fromname. "); field.focus(); return false; }
	if(field.value)	{ if(!validatesmsfromname(field.value)) { error.innerHTML = errormessage('From Name is not valid (Allowed Aplhabhets, Numbers, Hyphen).'); field.focus(); return false; } }

	passData =  "switchtype=save&contactperson=" + encodeURIComponent(form.contactperson.value)  + "&emailid=" + encodeURIComponent(form.emailid.value) + "&cell=" + encodeURIComponent(form.cell.value) + "&fromname=" + encodeURIComponent(form.fromname.value)+ "&offercode=" + encodeURIComponent(form.offercode.value) + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passData);
	queryString = '../ajax/createsmsaccount.php';
	var ajaxcall0 = createajax();//alert(passData);
	error.innerHTML = getprocessingimage();
	ajaxcall0.open('POST', queryString, true);
	ajaxcall0.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
	ajaxcall0.onreadystatechange = function()
	{
		if(ajaxcall0.readyState == 4)
		{
			if(ajaxcall0.status == 200)
			{
				var ajaxresponse = ajaxcall0.responseText;
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location = "../logout.php";
					return false;
				}
				else
				{
					var response = ajaxresponse.split('^');//alert(response);
					if(response[0] == '1')
					{
						//error.innerHTML = successmessage(response[1]);
						clearall();
						window.location = '../sms/index.php';
					}
					else if(response[0] == '2')
					{
						error.innerHTML = errormessage(response[1]);
					}
					else
					{
						error.innerHTML = errormessage('Unable to Connect...');
					}
				}
			}
			else
				error.innerHTML = scripterror();
		}
	}
	ajaxcall0.send(passData);
}

function clearall()
{
	var form = document.submitform;
	form.reset();
	document.getElementById('form-error').innerHTML = '';
}