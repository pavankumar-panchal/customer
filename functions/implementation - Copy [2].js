
function checkvalidation(cusid)
{
	var form = $('#submitform'); 
	var error = $('#form-error');
	var passData = '';
	passData = "switchtype=implementation&cusid=" + cusid + "&dummy=" + Math.floor(Math.random()*100000000);
	var queryString = "../ajax/implementation.php";
	$('#form-error').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	ajaxcall1 = $.ajax(
	{
		type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
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
				if(response['errorcode'] == '2')
				{
					$('#displaydiv1').show();
					$('#displaydiv2').hide();
					$('#displaytext').html(response['grid']);
					
				}
				else if(response['errorcode'] == '1')
				{
					$('#displaydiv2').show();
					$('#displaydiv1').hide();
					
					$('#lastslno').val(response['slno']);
					implemenationstatus(response['slno']);
					generatecustomization();
					$('#invoiceno').html(response['invoicenumber']);
					$('#datedisplay').html(response['podetails']);
					$('#noofcompanydisplay').html(response['numberofcompanies']);
					$('#noofmonthdisplay').html(response['processingfrommonth']);
					$('#processmonthdisplay').html(response['numberofmonths']);
					if(response['shipinvoiceapplicable'] == 'NO')
					{
						$('#shippmentdisplaydiv1').hide();
					}
					else
					{
						$('#shippmentdisplaydiv1').show();
						$('#shipinvoicedisplay').html(response['shipinvoiceremarks']);
					}
					if(response['attendanceremarks'] == '')
					{
						$('#vendordisplay').html('Not Available');
						$('#aiffilename').html('');
						$('#aifdatedisplay').html('Not Available');
						$('#aifcreatedby').html('Not Available');

					}
					else
					{
						var filename3 = response['attendancefilepath'].split('/');
						$('#aiffilename').html( '<a onclick = "viewfilepath(\'' + response['attendancefilepath'] + '\',\'1\')"  style="text-decoration:none; cursor:pointer">' + '<img src="../images/imax_zip_icon.gif" />' +' '+filename3[5] + '</a>');
						$('#aifdatedisplay').html(response['attendancefiledate']);
						$('#aifcreatedby').html(response['attendancefileattachedby']);
						$('#vendordisplay').html(response['attendanceremarks']);
					}
					if(response['customizationapplicable'] == 'NO')
					{
						$('#custstatusdisplay').html('Not Applicable');
						$('#custremarksdisplay').html('Not Available');
						$('#custgriddisplay').html('Not Available');
					}
					else
					{
						$('#custstatusdisplay').html(response['customizationstatus']);
						$('#custremarksdisplay').html(response['customizationremarks']);
						//$('#custgriddisplay').html('');
					}
					if(response['webimplemenationapplicable'] == 'NO')
					{
						$('#webimplementationdisplaydiv2').show();
						$('#webimplementationdisplaydiv1').hide();
					}
					else
					{
						$('#webimplementationdisplaydiv2').hide();
						$('#webimplementationdisplaydiv1').show();
						$('#webimplementationdisplay').html(response['webimplemenationremarks']);
					}
					$('#visitgriddisplay').html(response['assigngrid']);
					$('#visittotal').html(response['fetchcount']);
					$('#statuvisitdisplay').html(response['visitgrid']);
					$('#addongriddisplay').html(response['addongrid']);
					if(response['attachfilepath'] == '')
					{
						$('#raffilename').html('');
						$('#rafdatedisplay').html('Not Available');
						$('#rafcreatedby').html('Not Available');

					}
					else
					{
						var filename4 = response['attachfilepath'].split('/');
						$('#raffilename').html( '<a onclick = "viewfilepath(\'' + response['attachfilepath'] + '\',\'2\')"  style="text-decoration:none; cursor:pointer">' + '<img src="../images/imax_pdf_icon.gif" />' +' '+filename4[5] + '</a>');
						$('#rafdatedisplay').html(response['rafcreateddatetime']);
						$('#rafcreatedby').html(response['rafcreatedby']);
					}
					if(response['shipmanualapplicable'] == 'NO')
					{
						$('#shippmentdisplaydiv2').hide();
					}
					else
					{
						$('#shippmentdisplaydiv2').show();
						$('#shipmanualdisplay').html(response['shipmanualremarks']);
					}
					if(response['shipmanualapplicable'] == 'NO' && response['shipinvoiceapplicable'] == 'NO')
					{
						$('#shippmentdisplaydiv1').hide();
						$('#shippmentdisplaydiv2').hide();
						$('#shippmentdisplaydiv3').show();
					}
					
				}
				
				
			}
			//document.getElementById('updatewarningmeg').style.display = 'block';
		}, 
		error: function(a,b)
		{
			$("#invoicedetailsgridc1_1").html(scripterror());
		}
	});		
}

function visitsdetails(slno,implastslno)
{
	//alert(slno)
	if(slno != '')
	{
		var passData = "switchtype=visitsdetails&slno=" + slno +"&implastslno=" + implastslno + "&dummy=" + Math.floor(Math.random()*10054300000);//alert(passData)
		queryString = "../ajax/implementation.php";
		ajaxcall2 = $.ajax(
		{
			type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
			success: function(ajaxresponse,status)
			{	
					var response = ajaxresponse;//alert(response)
					if(response == 'Thinking to redirect')
					{
						window.location = "../logout.php";
						return false;
					}
					else
					{
						$('#detailscontent').html(response['resultgrid']);
						$("").colorbox({ inline:true, href:"#inline_example1" , onLoad: function() { $('#cboxClose').hide()}});
					}
			}, 
			error: function(a,b)
			{
				$("#invoicedetailsgridc1_1").html(scripterror());
			}
		});	
	}
				
}


function confirmation(slno,implastslno)
{
	$("").colorbox({ inline:true, href:"#inline_example2" , onLoad: function() { $('#cboxClose').hide()}});
	var form = $('#colorform1');
	$('#implastslno').val(slno);
	$('#customerid').val(implastslno);
}

function update(type)
{
	var form = $('#'+ 'submitform');
	var submitform = $('#colorform');
	if(! $('#remarks').val()) { alert("Enter the Remarks "); $('#remarks').focus(); return false;  }
	passData =  "switchtype=confirmation&type=" + encodeURIComponent(type) + "&slno=" + encodeURIComponent($('#implastslno').val())+ "&remarks=" + encodeURIComponent($('#remarks').val()) + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passData)
	$('#process1').html('<img src="../images/imax-loading-image.gif" border="0"/>');
	queryString = '../ajax/implementation.php';
	ajaxcall3 = $.ajax(
	{
		type: "POST",url: queryString, data: passData, cache: false,dataType: "json",
		success: function(ajaxresponse,status)
		{	
			$('#process1').html('');
			if(ajaxresponse == 'Thinking to redirect')
			{
				window.location = "../logout.php";
				return false;
			}
			else
			var response = ajaxresponse;
			if(response['errorcode'] == '1')
			{
				$().colorbox.close();
				checkvalidation($('#customerid').val());
			}
				
		}, 
		error: function(a,b)
		{
			$("#process1").html(scripterror());
		}
	});			
}


function viewfilepath(filepath,filenumber)
{
	if(filepath != '')
		$('#'+'filepath'+filenumber).val(filepath);
		
	var form = $('#submitform');	
	$('#submitform').attr("action", "../ajax/downloadfile.php?id="+filenumber+"") ;
	//$('#submitform').attr( 'target', '_blank' );
	$('#submitform').submit();
}


function implemenationstatus(lastslno)
{
	var form = $('#submitform');
	var passData =  "switchtype=implemenationstatus&lastslno=" + encodeURIComponent(lastslno) + "&dummy=" + Math.floor(Math.random()*100000000);//alert(passData)
	
	queryString = '../ajax/implementation.php';
	ajaxcall4 = $.ajax(
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
			var response = ajaxresponse;//alert(response)
			if(response['errorcode'] == '1')
			{
				if(response['branchapproval'] == 'no' && response['coordinatorreject'] == 'no' && response['coordinatorapproval'] == 'no' && response['implementationstatus'] == 'pending')
				{
					$("#implementationstatus").html('Awaiting Branch Head Approval.');
					$("#implementationremarks").html('Your Implmenetation activity has been submitted in the system. It is awaiting the approval from respective head. This will be executed shortly.');
					$('#iccattachdisplay').hide();
					
				}
				else if(response['branchapproval'] == 'yes'  && response['coordinatorreject'] == 'no' && response['coordinatorapproval'] == 'no' && response['implementationstatus'] == 'pending')
				{
					$("#implementationstatus").html('Awaiting Co-ordinator Approval.');
					$("#implementationremarks").html('Your Implmenetation activity has been approved by respective head and now is with Coordinator. It wil be shortly reveiwed and processed further.');
					$('#iccattachdisplay').hide();
				}
				else if(response['branchapproval'] == 'no' && response['coordinatorreject'] == 'yes' && response['coordinatorapproval'] == 'no' && response['implementationstatus'] == 'pending')
				{
					$("#implementationstatus").html('Fowarded back to Branch Head.');
					$("#implementationremarks").html('As there were few clarifications needed, your implementation activity has been forwarded back to respective head. It shall be processed soon.');
					$('#iccattachdisplay').hide();
				}
				else if(response['branchapproval'] == 'yes' && response['coordinatorreject'] == 'no'  && response['coordinatorapproval'] == 'yes' && response['implementationstatus'] == 'pending' )
				{
					$("#implementationstatus").html('Implementation, Yet to be Assigned.');
					$("#implementationremarks").html('Your Implementation activity has been approved with all the levels. It will soon be assigned with Implementer and respective visits be scheduled.');
					$('#iccattachdisplay').hide();
				}
				else if(response['branchapproval'] == 'yes' && response['coordinatorreject'] == 'no'  && response['coordinatorapproval'] == 'yes' && response['implementationstatus'] == 'assigned' )
				{
					$("#implementationstatus").html('Assigned For Implementation.');
					$("#implementationremarks").html('You have been assigned with Implementer  <font color="#178BFF"><strong> '+ response['businessname'].toUpperCase()+' </strong></font> . The visits scheduled shall be displayed here for your information / action.');
					$('#iccattachdisplay').hide();
				}
				else if(response['branchapproval'] == 'yes' && response['coordinatorreject'] == 'no'  && response['coordinatorapproval'] == 'yes' && response['implementationstatus'] == 'progess' )
				{
					$("#implementationstatus").html('Implementation in progess.');
					$("#implementationremarks").html('Visits are under progress for your Implementation. Our implmeneter has started his visits. The status remains the same until we receive "Implementation Completion Certificate"');
					$('#iccattachdisplay').hide();
				}
				else if(response['branchapproval'] == 'yes' && response['coordinatorreject'] == 'no'  && response['coordinatorapproval'] == 'yes' && response['implementationstatus'] == 'completed' )
				{
					$("#implementationstatus").html('Implementation Completed.');
					$("#implementationremarks").html('Your Implementation has been successfully completed. Please click here to view the "Implementation Completion Certificate".');
					$('#iccattachdisplay').show();
					if(response['iccattachmentpath'] == '')
					{
						$('#iccattachname').html('');
						$('#iccattachdatedisplay').html('Not Available');
						$('#iccattachcreatedby').html('Not Available');

					}
					else
					{
						var filename4 = response['iccattachmentpath'].split('/');
						$('#iccattachname').html( '<a onclick = "viewfilepath(\'' + response['iccattachmentpath'] + '\',\'3\')"  style="text-decoration:none; cursor:pointer">' + '<img src="../images/imax_zip_icon.gif" />' +' '+filename4[5] + '</a>');
						$('#iccattachdatedisplay').html(response['iccattachmentdate']);
						$('#iccattachcreatedby').html(response['businessname']);
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


function generatecustomization()
{
	var form = $("#submitform");
	var passData = "switchtype=customizationgrid&imprslno="+ encodeURIComponent($('#lastslno').val());//alert(passData)
	var queryString = "../ajax/implementation.php";
	$('#form-error').html(getprocessingimage());
	ajaxcall5 = $.ajax(
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
					var response = ajaxresponse;
					if(response['errorcode'] == '1')
					{
						$('#tabgroupgridc1_2').html(response['grid']);
					}
					else if(response[0] == '2')
					{
						$('#tabgroupgridc1_2').html(scripterror());
					}
				}
		}, 
		error: function(a,b)
		{
			$("#form-error").html(scripterror());
		}
	});		
				
			
}

