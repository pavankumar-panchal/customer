var totalarray = new Array();
var contactarray = '';

function validation(cusid)
{ 
	var form = $('#submitform'); 
	var error = $('#form-error');
	var phonevalues = '';
	var cellvalues = '';
	var gst_no = '';
	var emailvalues = '';
	var namevalues = '';
	//var businessname = document.getElementById("businessname");
	var type = $("#type");
	var category = $("#category");
	var field = $('#disablelogin:checked').val();
	if(field != 'on') var disablelogin = 'no'; else disablelogin = 'yes';

	var field = $('#businessname');
	if(!field.val()) { error.html(errormessage("Enter the Business Name [Company]. ")); field.focus(); return false; }
	if(field.val()) { if(!validatebusinessname(field.val())) { error.html(errormessage('Business name contains special characters. Please use only Alpha / Numeric / space / hyphen / small brackets.')); field.focus(); return false; } }
	
	//var field = $('#gst_no');
	//if(!field.val()) { error.html(errormessage("Enter the GSTIN. ")); field.focus(); return false; }

	if($('#state').val()!= 36) {
		//added on 5th Jan 2018
		var state_gst_code = $("#state_gst_code").val();

		var field = $('#gst_no');

		// if (!field.val()) {
		// 	error.html(errormessage("Enter the GSTIN. "));
		// 	field.focus();
		// 	return false;
		// }
		if (field.val()) {
			if (!validategstin(field.val())) {
				error.html(errormessage('GSTIN contains special characters. Please use only Alpha / Numeric .'));
				field.focus();
				return false;
			}
		}

		if (field.val() != '') {
			if (field.val() != 'Not Registered Under GST') {
				var gstinformat = new RegExp('^[0-9]{2}[A-Z]{5}[0-9]{4}[A-Z]{1}[1-9A-Z]{1}Z[0-9A-Z]{1}$');
				if (!validategstin(field.val())) {
					error.html(errormessage('Add Only Numeric and Alpha Characters'));
					field.focus();
					return false;
				}
				if (!gstinformat.test(field.val())) {
					error.html(errormessage('State GST Code Not in Format.'));
					field.focus();
					error.css({"color": "red"});
					return false;
				}
				if (field.val()) {
					if (!validategstinregex(field.val(), state_gst_code)) {
						error.html(errormessage('State GST Code Not Matching.'));
						field.focus();
						error.css({"color": "red"});
						return false;
					}
				}
			}
		}
		if (field.val() == '' || field.val() == 'Not Registered Under GST') {
			field.val(' ');
		}

		//ends on 5th Jan 2018
	}
	
	var rowcount = $('#adddescriptionrows tr').length;
	tabopen5('2','tabg1');
	var l=1;
	while(l<=rowcount)
	{
		if(!$("#selectiontype1").val())
		{
				error.html(errormessage("Minimum of ONE contact detail is mandatory")); return false;
		}
		else
		var field = $("#"+'selectiontype'+l);
		if(!field.val()) { error.html(errormessage("Select the Type. ")); field.focus(); return false; }
		var field = $("#"+'phone'+l);
		if(field.val()) { if(!validatephone(field.val())) { error.html(errormessage('Enter the valid Phone Number.')); field.focus(); return false; } }
		var field = $("#"+'cell'+l);
		if(field.val()) { if(!cellvalidation(field.val())) { error.html(errormessage('Enter the valid Cell Number.')); field.focus(); return false; } }
		var field = $("#"+'emailid'+l);
		if(field.val()) { if(!checkemail(field.val())) { error.html(errormessage('Enter the valid Email Id.')); field.focus(); return false; } }
		var field = $("#"+'name'+l);
		if(field.val()) { if(!contactpersonvalidate(field.val())) { error.html(errormessage('Contact person name contains special characters. Please use only Numeric / space.')); field.focus(); return false; } }
		l++;
		
	}
	for(j=1;j<=rowcount;j++)
	{
		var typefield = $("#"+'selectiontype'+j);

		var namefield = $("#"+'name'+j);
		if(namevalues == '')
			var namevalues = namefield.val();
		else
			var namevalues = namevalues + '~' + namefield.val();
		var phonefield = $("#"+'phone'+j);
		if(phonevalues == '')
			var phonevalues = phonefield.val();
		else
			var phonevalues = phonevalues + '~' + phonefield.val();
		var cellfield = $("#"+'cell'+j);
		if(cellvalues == '')
			var cellvalues = cellfield.val();
		else
			var cellvalues = cellvalues + '~' + cellfield.val();
		var emailfield = $("#"+'emailid'+j);
		if(emailvalues == '')
			var emailvalues = emailfield.val();
		else
			var emailvalues = emailvalues + '~' + emailfield.val();
		
		var slnofield = $("#"+'contactslno'+j);
		if(j == 1)
			contactarray = typefield.val() + '#' + namefield.val() + '#' +phonefield.val() + '#' + cellfield.val() + '#' + emailfield.val() + '#' + slnofield.val();
		else
			contactarray = contactarray + '****' + typefield.val()  + '#' + namefield.val() + '#' +phonefield.val() + '#' + cellfield.val() + '#' + emailfield.val() + '#' + slnofield.val();
	}
	if(namevalues == '')
		{error.html(errormessage("Enter Atleast One Contact Person Name."));return false;}
	if(phonevalues == '')
		{error.html(errormessage("Enter Atleast One Phone Number."));return false;}
	if(cellvalues == '')
		{error.html(errormessage("Enter Atleast One Cell Number."));return false;}
	if(emailvalues == '')
		{error.html(errormessage("Enter Atleast One Email Id."));return false;}

	tabopen5('1','tabg1');

	var field = $('#place');
	if(!field.val()){error.html(errormessage("Enter the Place")); return false; field.focus();}
	var field = $('#state');
	if(!field.val()){error.html(errormessage("Select the state"));  return false; field.focus();}
	var field = $('#district');
	if(!field.val()){error.html(errormessage("Select the District")); return false; field.focus();}
	var field = $('#pincode');
	if(!field.val()){error.html(errormessage("Enter the PIN Code")); return false; field.focus();}
	if(field.val()) { if(!validatepincode(field.val())) { error.html(errormessage('Enter the valid PIN Code.')); field.focus(); return false; } }
	var field = $('#stdcode');
	if(!field.val()){error.html(errormessage("Enter the STD Code")); return false; field.focus();}
	if(field.val()) { if(!validatestdcode(field.val())) { error.html(errormessage('Enter the valid STD Code.')); field.focus(); return false; } }
	var field = $('#fax');
	if(field.val()) { if(!validatephone(field.val())) { error.html(errormessage('Enter the valid Fax Number.')); field.focus(); return false; } }
	var field = $('#website');
		if(field.val()) { if(!validatewebsite(field.val())) { error.html(errormessage('Enter the valid Website.')); field.focus(); return false; } }
	var field = $('#type');
	if(!field.val()){error.html(errormessage("Enter the Type")); return false; field.focus();}
	var field = $('#category');
	if(!field.val()){error.html(errormessage("Enter the Category")); return false; field.focus();}
	var field = $('#promotionalsms:checked').val();
	if(field != 'on') var promotionalsms = 'no'; else promotionalsms = 'yes';
	var field = $('#promotionalemail:checked').val();
	if(field != 'on') var promotionalemail = 'no'; else promotionalemail = 'yes';

		if(disablelogin == 'yes')
		{
			var passdata  = "switchtype=update&businessname=" + encodeURIComponent($('#businessname').val()) +"&contactperson=" + encodeURIComponent($('#contactperson').val())  + "&gst_no=" + encodeURIComponent($('#gst_no').val()) + "&address=" + encodeURIComponent($('#address').val()) + "&place=" + encodeURIComponent($('#place').val()) + "&state=" + encodeURIComponent($('#state').val()) + "&district=" + encodeURIComponent($('#district').val()) + "&pincode=" + encodeURIComponent($('#pincode').val()) + "&stdcode=" + encodeURIComponent($('#stdcode').val()) + "&phone=" + encodeURIComponent($('#phone').val()) + "&cell=" + encodeURIComponent($('#cell').val()) +  "&fax=" + encodeURIComponent($('#fax').val()) + "&emailid=" + encodeURIComponent($('#emailid').val()) +"&website=" + encodeURIComponent($('#website').val()) +"&type=" + encodeURIComponent($('#type').val()) +"&category=" + encodeURIComponent($('#category').val()) +  "&cusid=" + (cusid)+ "&contactarray=" + encodeURIComponent(contactarray)+ "&totalarray=" + encodeURIComponent(totalarray)+ "&promotionalemail=" + encodeURIComponent(promotionalemail)+ "&promotionalsms=" + encodeURIComponent(promotionalsms) +   "&dummy=" + Math.floor(Math.random()*100000000);  //alert(passData);
			error.html('<img src="../images/imax-loading-image.gif" border="0"/>');
			var queryString = "../ajax/editprofile.php";//alert(queryString)
			ajaxobjext14 = $.ajax(
				{
					type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
					success: function(ajaxresponse,status)
					{	
						if(disablelogin == 'yes')
						{
							$('#disablelogin').attr('checked',false);
						}
						var response = ajaxresponse;
						if(response == 'Thinking to redirect')
						{
							window.location ="../logout.php";
							return false;//alert(ajaxresponse)
						}
						else
						{
						//alert(response)
							$('#form-error').html('');
							error.html(successmessage(response['errormsg']));
							$('#updatewarningmeg').show();
							$('#cancelmeg').html('');
						}
					}, 
					error: function(a,b)
					{
						$("#form-error").html(scripterror());
					}
				});		
		}
	else
	{
		$('#form-error').html(displaypendingmessage('If you want to Update your profile, please confirm the checkbox.' ));
	}
}



function getcustomerdetails(cusid)
{
	var form = $('#submitform'); 
	var error = $('#form-error');
	var passData = '';
	passdata = "switchtype=getcustomerdetails&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passData)
	var queryString = "../ajax/editprofile.php";
	ajaxcall1 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location ="../logout.php";
				return false;//alert(ajaxresponse)
			}
			else
			{
				var response = ajaxresponse;
				$('#customerstatus').val(response['customerstatus']);
				if($('#customerstatus').val() == 'pending')
				{
					$('#updatewarningmeg').show();	
				}
				$('#businessname').val(response['businessname']);
				//$('#contactperson').val(response[1]);
				$('#address').val(response['address']);
				$('#place').val(response['place']);
				$('#state').val(response['state']);
				getdistrict('districtcodedisplay', response['state']);
				$('#district').val(response['district']);
				$('#pincode').val(response['pincode']);
				$('#stdcode').val(response['stdcode']);
				$('#gst_no').val(response['gst_no']);
				$('#state_gst_code').val(response['state_gst_code']);
				//$('#phone').val(response[8]);
				//$('#cell').val(response[9]);
				$('#fax').val(response['fax']);
				//$('#emailid').val(response[10]);
				$('#website').val(response['website']);
				$('#customerid').val(response['dbcustomerid']);//alert(response[13])
				$('#type').val(response['type']);
				$('#category').val(response['category']);
				$('#createddate').html(response['createddate']);
				autochecknew($('#promotionalsms'), response['promotionalsms']);
				autochecknew($('#promotionalemail'), response['promotionalemail']);
				var countrow = response['contactarray'].split('****');
				$('#adddescriptionrows tr').remove();
				for(k=1;k<=countrow.length;k++)
				{
					slno = k;
					rowid = 'removedescriptionrow'+ slno;
					
					if(k == 10)
					{
						var value = 'contactname'+slno;
						$('#adddescriptionrowdiv').hide();
						var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
					}
					else if(k == 1)
					{
						var value = 'contactname'+slno;
						$('#adddescriptionrowdiv').show();
						var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
					}
					else
					{
						var value = 'contactname'+slno;
						$('#adddescriptionrowdiv').show();
						var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
					}
					$("#adddescriptionrows").append(row);
					$('#'+value).html(slno);
					
				}
			
				splitvalue = new Array();
				for(var i=0;i<countrow.length;i++)
				{
					splitvalue[i] =  countrow[i].split('#');
					$("#"+'selectiontype'+(i+1)).val(splitvalue[i][0]);
					$("#"+'name'+(i+1)).val(splitvalue[i][1]);
					$("#"+'phone'+(i+1)).val(splitvalue[i][2]);
					$("#"+'cell'+(i+1)).val(splitvalue[i][3]);
					$("#"+'emailid'+(i+1)).val(splitvalue[i][4]);
					$("#"+'contactslno'+(i+1)).val(splitvalue[i][5]);
				}
			}
		}, 
		error: function(a,b)
		{
			error.html(scripterror());
		}
	});		

}


function validate(cusid)
{ 
	var form = $('#submitform'); 
	var passdata  = "switchtype=undo&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*100000000); 
	var queryString = "../ajax/editprofile.php";
	ajaxcall2 = $.ajax(
	{
		type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location ="../logout.php";
				return false;//
			}
			else
			{
				var response = ajaxresponse;
				$('#businessname').val(response['businessname']);
				//$('#contactperson').val(response[1]);
				$('#address').val(response['address']);
				$('#place').val(response['place']);
				$('#state').val(response['state']);
				getdistrict('districtcodedisplay', response['state']);
				$('#district').val(response['district']);
				$('#pincode').val(response['pincode']);
				$('#stdcode').val(response['stdcode']);
				$('#gst_no').val(response['gst_no']);
				//$('#phone').val(response[8]);
				//$('#cell').val(response[9]);
				$('#fax').val(response['fax']);
				//$('#emailid').val(response[10]);
				$('#website').val(response['website']);
				$('#customerid').val(response['dbcustomerid']);
				$('#type').val(response['type']);
				$('#category').val(response['category']);
				$('#createddate').html(response['createddate']);
				$('#updatewarningmeg').hide();
				autochecknew($('#promotionalsms'), response['promotionalsms']);
				autochecknew($('#promotionalemail'), response['promotionalemail']);

				var countrow = response['contactarray'].split('****');
				$('#adddescriptionrows tr').remove();
				for(k=1;k<=countrow.length;k++)
				{
					slno = k;
					rowid = 'removedescriptionrow'+ slno;
					
					if(k == 10)
					{
						var value = 'contactname'+slno;
						$('#adddescriptionrowdiv').hide();
						var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
					}
					else if(k == 1)
					{
						var value = 'contactname'+slno;
						$('#adddescriptionrowdiv').show();
						var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
					}
					else
					{
						var value = 'contactname'+slno;
						$('#adddescriptionrowdiv').show();
						var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
					}
					$("#adddescriptionrows").append(row);
					$('#'+value).html(slno);
					
				}
			
				splitvalue = new Array();
				for(var i=0;i<countrow.length;i++)
				{
					splitvalue[i] =  countrow[i].split('#');
					$("#"+'selectiontype'+(i+1)).val(splitvalue[i][0]);
					$("#"+'name'+(i+1)).val(splitvalue[i][1]);
					$("#"+'phone'+(i+1)).val(splitvalue[i][2]);
					$("#"+'cell'+(i+1)).val(splitvalue[i][3]);
					$("#"+'emailid'+(i+1)).val(splitvalue[i][4]);
					$("#"+'contactslno'+(i+1)).val(splitvalue[i][5]);
				}
			}
		}, 
		error: function(a,b)
		{
			$("#form-error").html(scripterror());
		}
	});		
}

function cancelupdate(cusid)
{	
	var form = $('#submitform'); 
	var error = $('#form-error');
	$('#lastslno').val(cusid);
	var passdata = '';
	passdata = "switchtype=cancelupdate&cusid=" + cusid;
	var queryString = "../ajax/editprofile.php";
	ajaxcall3 = $.ajax(
		{
			type: "POST",url: queryString, data: passdata, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
				if(ajaxresponse == 'Thinking to redirect')
				{
					window.location ="../logout.php";
					return false;//alert(ajaxresponse)
				}
				else
				{
					var response = ajaxresponse;//alert(response)
					if(response['errorcode'] == 1)
					{
						$('#cancelmeg').html(successmessage(response['errormsg']));
						$('#updatewarningmeg').hide();
						$('#form-error').html('');
						validate($('#lastslno').val());
					}
					else
					if(response['errorcode'] == 2)
					{
						$('#cancelmeg').html(successmessage(response['errormsg']));
						$('#updatewarningmeg').hide();
						$('#form-error').html('');
						validate($('#lastslno').val());
					}
				}
			}, 
			error: function(a,b)
			{
				$("#form-error").html(scripterror());
			}
		});		
}


//To add description rows
function adddescriptionrows()
{
	$("#form-error").html('');
	var rowcount = ($('#adddescriptionrows tr').length);
	if(rowcount == 1)
		slno  = (rowcount+1);
	else
		slno = rowcount + 1;

	rowid = 'removedescriptionrow'+ slno;
	var value = 'contactname'+slno;
	
	var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
	
	$("#adddescriptionrows").append(row);
	$('#'+value).html(slno);
	if(slno == 10)
		$('#adddescriptionrowdiv').hide();
	else
		$('#adddescriptionrowdiv').show();
}

//Remove description row
function removedescriptionrows(rowid,rowslno)
{
	if(totalarray == '')
		totalarray = $('#contactslno'+rowslno).val();
	else if($('#contactslno'+rowslno).val())
		totalarray = totalarray  + ',' + $('#contactslno'+rowslno).val();
	var error = $("#form-error");
	$('#adddescriptionrowdiv').show();
	var rowcount = $('#adddescriptionrows tr').length;
	if(rowcount == 1)
	{
		error.html(errormessage("Minimum of ONE contact detail is mandatory")); 
		return false;
	}
	else
	{
		$('#'+rowid).remove();
		var countval = 0;
		for(i=1;i<=(rowcount+1);i++)
		{
			var selectiontype = '#selectiontype'+i;
			var designationtype = '#designationtype'+i;
			var name = '#name'+i;
			var phone = '#phone'+i;
			var cell = '#cell'+i;
			var emailid = '#emailid'+i;
			var removedescriptionrow = '#removedescriptionrow'+i;
			var contactslno =  '#contactslno'+i;
			var removerowdiv = '#removerowdiv'+i;
			if($(removedescriptionrow).length > 0)
			{
				countval++;
				$("#selectiontype"+ i).attr("name","selectiontype"+ countval);
				$("#selectiontype"+ i).attr("id","selectiontype"+ countval);
				
				$("#name"+ i).attr("name","name"+ countval);
				$("#name"+ i).attr("id","name"+ countval);
				
				$("#phone"+ i).attr("name","phone"+ countval);
				$("#phone"+ i).attr("id","phone"+ countval);
				
				$("#cell"+ i).attr("name","cell"+ countval);
				$("#cell"+ i).attr("id","cell"+ countval);
				
				$("#emailid"+ i).attr("name","emailid"+ countval);
				$("#emailid"+ i).attr("id","emailid"+ countval);
				
				$("#removedescriptionrow"+ i).attr("name","removedescriptionrow"+ countval);
				$("#removedescriptionrow"+ i).attr("id","removedescriptionrow"+ countval);
				
				$("#contactslno"+ i).attr("name","contactslno"+ countval);
				$("#contactslno"+ i).attr("id","contactslno"+ countval);
				
				$("#contactname"+ i).attr("id","contactname"+ countval);
				$("#contactname"+ countval).html(countval);
				
				$("#removerowdiv"+ i).attr("id","removerowdiv"+ countval);
				document.getElementById("removerowdiv"+ countval).onclick = new Function('removedescriptionrows("removedescriptionrow' + countval + '" ,"' + countval + '")') ;
						
			}
		}
	}
}

function rowwdelete()
{
	totalarray = '';
	var rowcount = $('#adddescriptionrows tr').length;
	if(rowcount <=10)
	{
		slno =1;
		$('#adddescriptionrows tr').remove();
		rowid = 'removedescriptionrow'+ slno;
		var value = 'contactname'+slno;
		var row = '<tr id="removedescriptionrow'+ slno+'"><td  width="6%"><div align="left"><span id="contactname'+ slno+'" style="font-weight:bold">&nbsp;</span></td><td width="17%"><div align="center"><select name="selectiontype'+ slno+'" id="selectiontype'+ slno+'" style="width:115px" class="swift_mandatory"><option value="" selected="selected" >--Select--</option><option value="general">General</option><option value="gm/director">GM/Director</option><option value="hrhead">HR Head</option><option value="ithead/edp">IT-Head/EDP</option><option value="softwareuser" >Software User</option><option value="financehead">Finance Head</option><option value="manager" >MANAGER</option><option value="CA">CA</option><option value="others" >Others</option></select></div></td><td width="17%"><div align="center"><input name="name'+ slno+'" type="text" class="swifttext" id="name'+ slno+'"  style="width:100px"  maxlength="110"  autocomplete="off"/></div></td><td width="17%"><div align="center"><input name="phone'+ slno+'" type="text"class="swifttext" id="phone'+ slno+'" style="width:100px" maxlength="100"  autocomplete="off" /></div></td><td width="16%"><div align="center"><input name="cell'+ slno+'" type="text" class="swifttext" id="cell'+ slno+'" style="width:90px"  maxlength="10"  autocomplete="off"/></div></td><td width="22%"><div align="center"><input name="emailid'+ slno+'" type="text" class="swifttext" id="emailid'+ slno+'" style="width:120px"  maxlength="200"  autocomplete="off"/></div></td><td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv'+ slno+'" onclick ="removedescriptionrows(\'' + rowid +'\',\'' + slno +'\')" style="cursor:pointer;">X</a></strong></font><input type="hidden" name="contactslno'+ slno+'" id="contactslno'+ slno+'" /></td></tr>';
		$("#adddescriptionrows").append(row);
		$('#'+value).html(slno);
	}
		
}

function changeToUpperCase(t) {
   var eleVal = document.getElementById(t.id);
   eleVal.value= eleVal.value.toUpperCase().replace(/ /g,'');
}

//added on 5th Jan 2018
function validategstinregex(value,stategstcode) {
 var valueEntered = value;
 var stategstcode = stategstcode;
 var valueEntered_new = valueEntered.substring(0, 2);
 
  if(valueEntered_new != stategstcode) {
    return false;
  }
  else
  {
      return true;
  }
}
//ends on 5th Jan 2018