function createajax()
{
   var objectname = false;	
	try { /*Internet Explorer Browsers*/ objectname = new ActiveXObject('Msxml2.XMLHTTP'); } 
	catch (e)
	{
		try { objectname = new ActiveXObject('Microsoft.XMLHTTP'); } 
		catch (e)  
		{
			try { /*// Opera 8.0+, Firefox, Safari*/ 
				objectname = new XMLHttpRequest();		
				} 
			catch (e) { /*Something went wrong*/ alert('Your browser is not responding for Javascripts.'); return false; }
		}
	}
	return objectname;
}

function validatecustomerid(cusid)
{
	var numericExpresion1 = /^\d{17}$/;
	var numericExpresion = /^[0-9]{4}-[0-9]{4}-[0-9]{4}-[0-9]{5}$/;
	var numericExpresion2 = /^[0-9]{4}(\s)[0-9]{4}(\s)[0-9]{4}(\s)[0-9]{5}$/;
	var numericExpresion3 = /^\d{5}$/;
	if(cusid.match(numericExpresion)) return true;
	else if(cusid.match(numericExpresion1)) return true;
	else if(cusid.match(numericExpresion2)) return true;
	else if(cusid.match(numericExpresion3)) return true;
	else return false;
}
function onblurvalue()
{
	var dtStr =  document.getElementById('username').value;
	var val=dtStr.replace(/-/g,"");
	document.getElementById('username').value = val;
}
function formsubmit()
{
	var form = document.submitform;
	var field =document.getElementById('username');
	var field1 =document.getElementById('password');
	var passwd =document.getElementById('passwd');
	var error = document.getElementById('form-error');
	var displayerror = document.getElementById('display-error');
	if(!field.value )
	{	 
		  error.innerHTML = errormessage("Enter the User name"); 
		  field.focus(); 
		  return false;
	}
	if(!field1.value)
	{ 
		error.innerHTML = errormessage("Enter the Password"); 
		field1.focus(); 
		return false;
	}
	if(!validatecustomerid(field.value))
	{ 
		error.innerHTML = errormessage("Please enter a Valid Customer ID."); 
		field.focus(); 
		return false;
	}
	form.submit();
}
function errormessage(message)
{
	var msg = '<div class="errorbox">' + message + '</div>';
	return msg;
}

//function to validate the contact person
function validatecontactperson(contactname)
{
	var numericExpression = /^([A-Z\s\()]+[a-zA-Z\s()])(?:(?:[,;]([A-Z\s()]+[a-zA-Z\s()])))*$/i;
	if(contactname.match(numericExpression)) return true;
	else return false;
}
//function to validate the business name
function validatebusinessname(contactname)
{
 var numericExpression = /^([A-Z0-9\s\-()]+[a-zA-Z0-9\s-()])(?:(?:[,;]([A-Z0-9\s-()]+[a-zA-Z0-9\s-()])))*$/i;
 if(contactname.match(numericExpression)) return true;
 else return false;
}

//function to validate the GSTIN
function validategstin(contactname)
{
 var numericExpression = /^[a-zA-Z0-9_.-]*$/i;
 if(contactname.match(numericExpression)) return true;
 else return false;
}

function emailvalidation(emailid)
{
	var emailExp = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}(?:(?:[,][A-Z0-9\._%-]+@[A-Z0-9\.-]+))*$/i;
	var emails = emailid.replace(/[,\s]*,[,\s]*/g, ",").replace(/^,/, "").replace(/,$/, "");
	if(emails.match(emailExp)) { return true; }
	else { return false; }
}
function validatestdcode(stdcodenumber)
{
	var numericExpression = /^[0]+[0-9]{2,4}$/i;
	if(stdcodenumber.match(numericExpression)) return true;
	else return false;
}
function validatepincode(pincodenumber)
{
	var numericExpression = /^[^0]+[0-9]{5}$/i;
	if(pincodenumber.match(numericExpression)) return true;
	else return false;
}
function validatecell(cellnumber)
{
	var numericExpression = /^[7|8|9]\d{9}(?:(?:([,][\s]|[;][\s]|[,;])[7|8|9]\d{9}))*$/i;
	//var numericExpression = /^[7|8|9]+[0-9]{9,9}(?:(?:[,;][7|8|9]+[0-9]{9,9}))*$/i;
	if(cellnumber.match(numericExpression)) return true;
	else return false;
}

function validatephone(phonenumber)
{
	var numericExpression = /^[^9]\d{5,7}(?:(?:([,][\s]|[;][\s]|[,;])[^9]\d{5,7}))*$/i;
	if(phonenumber.match(numericExpression)) return true;
	else return false;
}

function districtcodeFunction(selectid,comparevalue)
{ 
	var statecode = document.getElementById('state').value;
	var districtDisplay = document.getElementById('districtcodedisplay'); 
	passData = "statecode=" + encodeURIComponent(statecode) + "&dummy=" + Math.floor(Math.random()*1100011000000);//alert(passData)
	ajaxcalld = createajax();
	var queryString = "../ajax/selectdistrictonstate.php";
	ajaxcalld.open("POST", queryString, true);
	ajaxcalld.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	ajaxcalld.onreadystatechange = function()
	{
		if(ajaxcalld.readyState == 4)
		{
			districtDisplay.innerHTML = ajaxcalld.responseText;
			if(selectid && comparevalue)
			autoselect(selectid, comparevalue);
		}
	}
	ajaxcalld.send(passData);return true;
}
function autoselect(selectid,comparevalue)
{
	var selection = document.getElementById(selectid);
	for(var i = 0; i < selection.length; i++) 
	{
		if(selection[i].value == comparevalue)
		{
			selection[i].selected = "1";
			return;
		}
	}
}
function successmessage(message)
{
	var msg = '<div class="successbox">' + message + '</div>';
	return msg;
}
function displaysuccessmessage(message)
{
	var msg = '<div class="displaysuccess">' + message + '</div>';
	return msg;
}
function displaypendingmessage(message)
{
	var msg = '<div class="displaypendingreq">' + message + '</div>';
	return msg;
}
//Function to display a error message if the script failed-Meghana[11/12/2009]
function scripterror()
{
	var msghtml = '<div class="errorbox">Unable to Connect....</div>';
	return msghtml;
}
function tabopen14(activetab,tabgroupname)
{
	var totaltabs = 30;
	//alert(activetab);
	//var activetabheadclass = "vertabheadactive";
//	var tabheadclass = "vertabhead";
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		if(i == activetab) 
		{
		//	document.getElementById(tabhead).className = activetabheadclass;
			if(document.getElementById(tabcontent).style.display == 'block')
				document.getElementById(tabcontent).style.display = 'none';
			else 
				document.getElementById(tabcontent).style.display = 'block';
		}
	}
}

/*function tabopen14(activetab,tabgroupname)
{
	var totaltabs = 14;
	//var activetabheadclass = "vertabheadactive";
//	var tabheadclass = "vertabhead";
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		if(i == activetab) 
		{
		//	document.getElementById(tabhead).className = activetabheadclass;
			if(document.getElementById(tabcontent).style.display == 'block')
				document.getElementById(tabcontent).style.display = 'none';
			else 
				document.getElementById(tabcontent).style.display = 'block';
		}
	}
}*/

function tabopen11(activetab,tabgroupname)
{
	var totaltabs = 11;
	//var activetabheadclass = "vertabheadactive";
//	var tabheadclass = "vertabhead";
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		if(i == activetab) 
		{
		//	document.getElementById(tabhead).className = activetabheadclass;
			if(document.getElementById(tabcontent).style.display == 'block')
				document.getElementById(tabcontent).style.display = 'none';
			else 
				document.getElementById(tabcontent).style.display = 'block';
		}
	}
}




//Function to enable the next button------------------------------------------------------------------------------
function enablenext()
{
	document.getElementById('next').disabled = false;
	document.getElementById('next').className = 'swiftchoicebutton';
}

//Function to enable the send button--------------------------------------------------------------------------------
function enablesend()
{
	document.getElementById('send').disabled = false;
	document.getElementById('send').className = 'swiftchoicebutton';
}

//Function to disable the send button--------------------------------------------------------------------------------
function disablesend(){
	document.getElementById('send').disabled = true;
	document.getElementById('send').className = 'swiftchoicebuttondisabled';
}
//Function to disable the next button--------------------------------------------------------------------------------
function disablenext(){
	document.getElementById('next').disabled = true;
	document.getElementById('next').className = 'swiftchoicebuttondisabled';
}
function validatewebsite(website)
{
	var websiteExpression = /^(www\.)?[a-zA-Z0-9-\.,]+\.[a-zA-Z]{2,4}$/i;
	if(website.match(websiteExpression)) return true;
	else return false;
}

function validatesmscontactperson(contactname)
{
	var numericExpression = /^([A-Z\s\()]+[a-zA-Z\s()])$/i;
	if(contactname.match(numericExpression)) return true;
	else return false;
}

function emailsmsvalidation(emailid)
{
	var emailExp = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}$/i;
	if(emailid.match(emailExp)) { return true; }
	else { return false; }
} 

function validatesmscell(cellnumber)
{
	var numericExpression = /^[7|8|9]+[0-9]{9,9}$/i;
	if(cellnumber.match(numericExpression)) return true;
	else return false;
}

//Validation SMS User Name
function validatesmsfromname(fromname)
{
	if (fromname.match(/^[a-zA-Z0-9-]+$/))
	{
		return true;
	}
	else
	{
		return false;
	} 
}

function getprocessingimage()
{
	var imagehtml = '<img src="../images/imax-loading-image.gif" border="0"/>';
	return imagehtml;
}

function tabopen5(activetab,tabgroupname)
{
	var totaltabs = 2;
	var activetabheadclass = "producttabheadactive";
	var tabheadclass = "producttabhead";
	
	for(var i=1; i<=totaltabs; i++)
	{
		var tabhead = tabgroupname + 'h' + i;
		var tabcontent = tabgroupname + 'c' + i;
		if(i == activetab)
		{
			document.getElementById(tabhead).className = activetabheadclass;
			document.getElementById(tabcontent).style.display = 'block';
		}
		else
		{
			document.getElementById(tabhead).className = tabheadclass;
			document.getElementById(tabcontent).style.display = 'none';
		}
	}
}

function cellvalidation(cellnumber)
{
 var numericExpression = /^[7|8|9]+[0-9]{9,9}$/i;
 if(cellnumber.match(numericExpression)) return true;
 else return false;
}

function contactpersonvalidate(contactname)
{
 var numericExpression = /^([A-Z\s\()]+[a-zA-Z\s()])$/i;
 if(contactname.match(numericExpression)) return true;
 else return false;
}

function checkemail(mailid)
{
 var numericExpression = /^[A-Z0-9\._%-]+@[A-Z0-9\.-]+\.[A-Z]{2,4}$/i;
 if(mailid.match(numericExpression)) return true;
 else return false;
}

//Function to check the particular option in <input type =check> Tag, with the compare value------------------------
function autochecknew(selectid,comparevalue)
{
		var selection = selectid;
		if('yes' == comparevalue)
		{
			$(selection).attr('checked',true)
			return;
		}
		else
		{
			$(selection).attr('checked',false)
			return;
		}
}



