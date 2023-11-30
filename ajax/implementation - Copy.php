<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtytpe = $_POST['switchtype'];
if(imaxgetcookie('dbcustomerid') <> '' )
$dbcustomerid = imaxgetcookie('dbcustomerid');
else
{
	echo('Thinking to redirect');
	exit;
}
switch($switchtytpe)
{
	case 'implementation':
	{
		$responsearray = array();
		$cusid = $_POST['cusid'];
		$query = "SELECT count(*) AS count FROM imp_implementation WHERE customerreference = '".$cusid."'";
		$fetch = runmysqlqueryfetch($query);
		$count = $fetch['count'];
		if($count > 0)
		{
			$query = "SELECT imp_implementation.slno,imp_implementation.customerreference, imp_implementation.invoicenumber,
imp_implementation.podetails, imp_implementation.numberofcompanies, imp_implementation.numberofmonths,
imp_implementation.processingfrommonth, imp_implementation.shipinvoiceapplicable,
imp_implementation.shipinvoiceremarks,imp_implementation.shipmanualapplicable,
imp_implementation.shipmanualremarks,imp_implementation.attendancefilepath, imp_implementation.attendanceremarks, imp_implementation.attendancefiledate,inv_mas_dealer.businessname as attendancefileattachedby,
imp_implementation.customizationapplicable, imp_implementation.customizationremarks,
imp_implementation.customizationstatus, imp_implementation.implementationstatus , imp_implementation.webimplemenationapplicable,imp_implementation.webimplemenationremarks
from imp_implementation left join inv_mas_dealer on inv_mas_dealer.slno = imp_implementation.attendancefileattachedby  where imp_implementation.customerreference = '".$cusid."';";
			$fetch = runmysqlqueryfetch($query);
			
			//Assigned Implementation Grid Details  
			$query12 = "SELECT slno,assigneddate,remarks from imp_implementationdays  WHERE impref = '".$fetch['slno']."' order by  assigneddate is null and  createddatetime asc;";
			$assigngrid = '<table width="100%" cellpadding="3" cellspacing="0" class="imp_table-border-grid">';
			$assigngrid .= '<tr class="imp_tr-grid-header" align ="left"><td nowrap = "nowrap" class="imp_td-border-grid" >Sl No</td><td nowrap = "nowrap" class="imp_td-border-grid">Date</td><td nowrap = "nowrap" class="imp_td-border-grid">Remarks</td></tr>';
			$result11 = runmysqlquery($query12);
			$slno1 =0;
			while($fetch11 = mysqli_fetch_array($result11))
			{
				$slno1++;
				$assigngrid .= '<tr align ="left">';
				$assigngrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".$slno1."</td>";
				if($fetch11['assigneddate'] == '')
					$assigngrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>Not Assigned</td>";
				else
					$assigngrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".changedateformat($fetch11['assigneddate'])."</td>";
				$assigngrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".gridtrim($fetch11['remarks'])."</td>";
				$assigngrid .= "</tr>";
			}
			$fetchcount = mysqli_num_rows($result11);
			if($fetchcount == '0')
				$assigngrid .= "<tr><td colspan ='3' class='imp_td-border-grid'><div align='center'><font color='#FF0000'><strong>No Records to Display</strong></font></div></td></tr>";
				$assigngrid .= "</table>";
			
			//Visited Status Grid Details  
			$query14 = "SELECT slno,assigneddate,remarks,visitedstartflag,visitedendflag,customerstatus from imp_implementationdays  WHERE impref = '".$fetch['slno']."' order by createddatetime DESC ";
			$visitgrid = '<table width="100%" cellpadding="3" cellspacing="0" class="imp_table-border-grid">';
			$visitgrid .= '<tr class="imp_tr-grid-header" align ="left"><td nowrap = "nowrap" class="imp_td-border-grid" >Visits</td><td nowrap = "nowrap" class="imp_td-border-grid">Status</td><td nowrap = "nowrap" class="imp_td-border-grid">&nbsp;</td><td nowrap = "nowrap" class="imp_td-border-grid">&nbsp;</td></tr>';
			$result14 = runmysqlquery($query14);
			$slno2 =0;
			$fetchdetails = '';$customerflag = '';
			while($fetch14 = mysqli_fetch_array($result14))
			{
				$visitestartflag = $fetch14['visitedstartflag'];
				$visitedendflag = $fetch14['visitedendflag'];
				$customerstatus = $fetch14['customerstatus'];
				if($visitestartflag == 'yes' && $visitedendflag == 'yes')
				{
					$status = 'Completed';
					$fetchdetails = 'yes';
				}
				elseif($visitestartflag == 'no' && $visitedendflag == 'no')
				{
					$status = 'Pending';
					$fetchdetails = 'no';
				}
				elseif($visitestartflag == 'yes' && $visitedendflag == 'no')
				{
					$status = 'Ongoing';
					$fetchdetails = 'no';
				}
				$slno2++;
				if($customerstatus == 'pending')
					$customerflag = 'no';
				elseif($customerstatus == 'confirm' || $customerstatus == 'notsatisfactory')
					$customerflag = 'yes';
				
				$visitgrid .= '<tr align ="left">';
				$visitgrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>Visit".$slno2."</td>";
				$visitgrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".$status ."</td>";
				if($fetchdetails == 'yes')
					$visitgrid .= '<td nowrap="nowrap" class="imp_td-border-grid" style="text-align:center"><a class="r-text" onClick="visitsdetails(\''.$fetch['slno'].'\',\''.$fetch14['slno'].'\');">Details &#8250;&#8250;</a></td>';
				elseif($fetchdetails == 'no')
					$visitgrid .= "<td nowrap='nowrap' class='imp_td-border-grid' style='text-align:center' >-</td>";
				if($customerflag == 'no' && $fetchdetails == 'yes')
					$visitgrid .= '<td nowrap="nowrap" class="imp_td-border-grid" style="text-align:center"><a class="r-text" onClick="confirmation(\''.$fetch14['slno'].'\',\''.$cusid.'\');">Confirm &#8250;&#8250;</a></td>';
				elseif($customerflag == 'yes' && $fetchdetails == 'yes')
					$visitgrid .= "<td nowrap='nowrap' class='imp_td-border-grid' style='text-align:center;color:#FF0000 ' >Confirmed</td>";
				elseif($customerflag == 'no' && $fetchdetails == 'no')
					$visitgrid .= "<td nowrap='nowrap' class='imp_td-border-grid' style='text-align:center' >-</td>";
				$visitgrid .= "</tr>";
			}
			$fetchcount1 = mysqli_num_rows($result14);
			if($fetchcount1 == '0')
				$visitgrid .= "<tr><td colspan ='5' class='imp_td-border-grid'><div align='center'><font color='#FF0000'><strong>No Records to Display</strong></font></div></td></tr>";
				$visitgrid .= "</table>";
				
			//Add-on's Grid Details  
			$query15 = "SELECT imp_addon.slno, imp_addon.customerid, imp_addon.refslno, imp_mas_addons.addonname as addon, imp_addon.remarks,imp_addon.addon as addonslno from imp_addon left join imp_mas_addons on imp_mas_addons.slno = imp_addon.addon where refslno  = '".$fetch['slno']."';";
			$addongrid = '<table width="100%" cellpadding="3" cellspacing="0" class="imp_table-border-grid">';
			$addongrid .= '<tr class="imp_tr-grid-header" align ="left"><td nowrap = "nowrap" class="imp_td-border-grid" >Sl No</td><td nowrap = "nowrap" class="imp_td-border-grid">Add-on</td><td nowrap = "nowrap" class="imp_td-border-grid">Remarks</td></tr>';
			$result15 = runmysqlquery($query15);
			$slno3 =0;
			while($fetch15 = mysqli_fetch_array($result15))
			{
				$slno3++;
				$addongrid .= '<tr align ="left">';
				$addongrid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".$slno3."</td>";
				$addongrid .= "<td class='td-border-grid' >".$fetch15['addon']."</td>";
				$addongrid .= "<td class='td-border-grid' >".$fetch15['remarks']."</td>";
				$addongrid .= "</tr>";
			}
			$fetchcount2 = mysqli_num_rows($result15);
			if($fetchcount2 == '0')
				$addongrid .= "<tr><td colspan ='3' class='imp_td-border-grid'><div align='center'><font color='#FF0000'><strong>No Records to Display</strong></font></div></td></tr>";
				$addongrid .= "</table>";
			
			//Fetch the Requriment Analysis Details
			$query16 = "select  imp_rafiles.slno,imp_rafiles.customerreference,imp_rafiles.attachfilepath,imp_rafiles.remarks,
max(imp_rafiles.createddatetime) as rafcreateddatetime,imp_rafiles.createdby ,inv_mas_dealer.businessname as rafcreatedby from imp_rafiles  left join inv_mas_dealer on inv_mas_dealer.slno = imp_rafiles.createdby 
where impref = '".$fetch['slno']."' group by customerreference";
			$result16 = runmysqlqueryfetch($query16);
			$filename = explode('/',$result16['attachfilepath']);
			
			
			$responsearray['errorcode'] = "1";	
			$responsearray['slno'] = $fetch['slno'];
			$responsearray['customerreference'] = $fetch['customerreference'];
			$responsearray['invoicenumber'] = $fetch['invoicenumber'];
			$responsearray['podetails'] = $fetch['podetails'];
			$responsearray['numberofcompanies'] = $fetch['numberofcompanies'];
			$responsearray['processingfrommonth'] = $fetch['processingfrommonth'];
			$responsearray['numberofmonths'] = $fetch['numberofmonths'];
			$responsearray['shipinvoiceapplicable'] = strtoupper($fetch['shipinvoiceapplicable']);
			$responsearray['shipinvoiceremarks'] = $fetch['shipinvoiceremarks'];
			$responsearray['attendanceremarks'] = $fetch['attendanceremarks'];
			$responsearray['attendancefilepath'] = $fetch['attendancefilepath'];
			$responsearray['attendancefiledate'] = changedateformatwithtime($fetch['attendancefiledate']);
			$responsearray['attendancefileattachedby'] = strtoupper($fetch['attendancefileattachedby']);
			$responsearray['customizationremarks'] = $fetch['customizationremarks'];
			$responsearray['customizationstatus'] = $fetch['customizationstatus'];
			$responsearray['implementationstatus'] = $fetch['implementationstatus'];	
			$responsearray['webimplemenationapplicable'] = strtoupper($fetch['webimplemenationapplicable']);
			$responsearray['webimplemenationremarks'] = $fetch['webimplemenationremarks'];
			$responsearray['assigngrid'] = $assigngrid;
			$responsearray['fetchcount'] = $fetchcount;
			$responsearray['visitgrid'] = $visitgrid;
			$responsearray['addongrid'] = $addongrid;
			$responsearray['attachfilepath'] = $result16['attachfilepath'];
			$responsearray['rafcreateddatetime'] = changedateformatwithtime($result16['rafcreateddatetime']);
			$responsearray['rafcreatedby'] = strtoupper($result16['rafcreatedby']);
			$responsearray['shipmanualapplicable'] = strtoupper($fetch['shipmanualapplicable']);
			$responsearray['shipmanualremarks'] = $fetch['shipmanualremarks'];		
			echo(json_encode($responsearray));//echo('1^'.$fetch['slno'].'^'.$fetch['customerreference'].'^'.$fetch['invoicenumber'].'^'.$fetch['podetails'].'^'.$fetch['numberofcompanies'].'^'.$fetch['processingfrommonth'].'^'.$fetch['numberofmonths'].'^'.strtoupper($fetch['shipinvoiceapplicable']).'^'.$fetch['shipinvoiceremarks'].'^'.$fetch['attendanceremarks'].'^'.$fetch['attendancefilepath'].'^'.changedateformatwithtime($fetch['attendancefiledate']).'^'.strtoupper($fetch['attendancefileattachedby']).'^'.strtoupper($fetch['customizationapplicable']).'^'.$fetch['customizationremarks'].'^'.$fetch['customizationstatus'].'^'.$fetch['implementationstatus'].'^'.strtoupper($fetch['webimplemenationapplicable']).'^'.$fetch['webimplemenationremarks'].'^'.$assigngrid.'^'.$fetchcount.'^'.$visitgrid.'^'.$addongrid.'^'.$result16['attachfilepath'].'^'.changedateformatwithtime($result16['rafcreateddatetime']).'^'.strtoupper($result16['rafcreatedby']).'^'.strtoupper($fetch['shipmanualapplicable']).'^'.$fetch['shipmanualremarks']);
				
			}
		else
		{
			$responsearray['errorcode'] = "2";	
			$responsearray['grid'] = '<div style="padding-left:10px">No implementation details available!! This wil be avaliable only if you have purchased Relyon Saral PayPack and opted for "Implementation". To buy Relyon Saral PayPack Contact your Relyon Representative or email to <font color="#6464FF"><a href="mailto:sales@relyonsoft.com" class="Links">sales@relyonsoft.com.</a> </font></div>';
			echo(json_encode($responsearray));
			//echo('2^'.'<div style="padding-left:10px">No implementation details available!! This wil be avaliable only if you have purchased Relyon Saral PayPack and opted for "Implementation". To buy Relyon Saral PayPack Contact your Relyon Representative or email to <font color="#6464FF"><a href="mailto:sales@relyonsoft.com" class="Links">sales@relyonsoft.com.</a> </font></div>');
			
		}
	}
	break;
	
	case 'visitsdetails':
	{
		$responsearray1 = array();
		$slno = $_POST['slno'];
		$implastslno = $_POST['implastslno'];
		$query = "SELECT slno,visiteddate,remarks,starttime,endtime from imp_implementationdays  WHERE slno = '".$implastslno."' and impref= '".$slno."'";
		$result1 = runmysqlqueryfetch($query);
		
		$query11 = "SELECT imp_implementationactivity.slno,imp_mas_activity.activityname ,imp_implementationactivity.remarks from imp_implementationactivity left join imp_mas_activity on imp_mas_activity.slno = imp_implementationactivity.activity WHERE impref = '".$slno."' ";
		$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header" align ="left"><td nowrap = "nowrap" class="td-border-grid" >Sl No</td><td nowrap = "nowrap" class="td-border-grid">Activity</td><td nowrap = "nowrap" class="td-border-grid">Remarks</td></tr>';
		$i_n = 0;$slno1 = 0;
		$result11 = runmysqlquery($query11);
		while($fetch = mysqli_fetch_array($result11))
		{
			$i_n++;
			$slno1++;
			$color;
			if($i_n%2 == 0)
				$color = "#edf4ff";
			else
				$color = "#f7faff";
			$grid .= '<tr class="gridrow" bgcolor='.$color.' align ="left">';
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno1."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['activityname']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid'>".gridtrim($fetch['remarks'])."</td>";
			$grid .= "</tr>";
		}
		$fetchcount = mysqli_num_rows($result11);
		
		if($fetchcount == '0')
			$grid .= "<tr><td colspan ='3'><div align='center'><font color='#FF0000'><strong>No Records to Display</strong></font></div></td></tr>";
		$grid .= "</table>";
		$resultgrid = '<table width="100%" border="0" cellspacing="0" cellpadding="5" style="border:solid 1px #CAE4FF">';
		$resultgrid .= '<tr><td width="20%"><strong>Date of Visit :</strong></td> <td width="80%">'.changedateformat($result1['visiteddate']).'</td></tr>';
		$resultgrid .= '<tr><td width="20%"><strong>Start Time :</strong></td><td width="80%">'.$result1['starttime'].'</td></tr>';
		$resultgrid .= '<tr><td width="20%"><strong>End Time :</strong></td> <td width="80%">'.$result1['endtime'].'</td></tr>';
		$resultgrid .= '<tr><td width="20%"><strong>Visit Summary :</strong></td><td width="80%">'.$result1['remarks'].'</td> </tr>';
		$resultgrid .= '<tr><td colspan="2"><strong>Activities Carried :</strong></td></tr>';
		$resultgrid .= '<tr><td colspan="2">'.$grid.'</td></tr></table>';
		
		$responsearray1['errorcode'] = "1";
		$responsearray1['resultgrid'] = $resultgrid;
		echo(json_encode($responsearray1));
		//echo('1^'.$resultgrid);
	}
	break;
	case 'confirmation':
	{
		$responsearray2 = array();
		$slno = $_POST['slno'];
		$type = $_POST['type'];
		$remarks = $_POST['remarks'];
		$query = "update imp_implementationdays set customerstatus = '".$type."',customerremarks = '".$remarks."' where imp_implementationdays.slno = '".$slno."'";  //echo($query); exit;
		$result1 = runmysqlquery($query);
		mailfromcustomer($slno,$type);
		
		$responsearray2['errorcode'] = "1";
		$responsearray2['errormsg'] = 'Record is Updated.'.$slno;
		echo(json_encode($responsearray2));
		//echo('1^'.'Record is Updated.'.$slno);
	}
	break;
	
	case 'implemenationstatus':
	{
		$responsearray3 = array();
		$lastslno = $_POST['lastslno'];
		$query = "SELECT imp_implementation.branchreject,imp_implementation.branchapproval, imp_implementation.coordinatorreject, imp_implementation.coordinatorapproval, imp_implementation.implementationstatus, inv_mas_implementer.businessname from  imp_implementation left join inv_mas_implementer on inv_mas_implementer.slno = imp_implementation.assignimplemenation 
where imp_implementation.slno = '".$lastslno."';";
		$fetch = runmysqlqueryfetch($query);
		
		$query1 = "Select iccattachmentpath,iccattachmentdate,inv_mas_implementer.businessname from imp_implementationdays
left join  inv_mas_implementer on inv_mas_implementer.slno = imp_implementationdays.iccattachmentby
where imp_implementationdays.impref = '".$lastslno."' and iccattachment = 'yes';";
		$result = runmysqlquery($query1);
		$fetchcount = mysqli_num_rows($result);
		if($fetchcount <> 0)
			$result1 = runmysqlqueryfetch($query1);
		
		$responsearray3['errorcode'] = "1";	
		$responsearray3['branchapproval'] = $fetch['branchapproval'];
		$responsearray3['coordinatorreject'] = $fetch['coordinatorreject'];
		$responsearray3['coordinatorapproval'] = $fetch['coordinatorapproval'];
		$responsearray3['implementationstatus'] = $fetch['implementationstatus'];
		$responsearray3['businessname'] = $result1['businessname'];
		$responsearray3['iccattachmentpath'] = $result1['iccattachmentpath'];
		$responsearray3['iccattachmentdate'] = $result1['iccattachmentdate'];
		$responsearray3['businessname'] = $result1['businessname'];
		$responsearray3['branchreject'] = $result1['branchreject'];
		echo(json_encode($responsearray3));
		//echo('1^'.$fetch['branchapproval'].'^'.$fetch['coordinatorreject'].'^'.$fetch['coordinatorapproval'].'^'.$fetch['implementationstatus'].'^'.$fetch['businessname'].'^'.$result1['iccattachmentpath'].'^'.$result1['iccattachmentdate'].'^'.$result1['businessname']);
		
	}
	break;
	
	case 'customizationgrid':
	{
		$responsearray4 = array();
		$implastslno = $_POST['imprslno'];
		$resultcount = "SELECT count(*) as count from imp_customizationfiles where imp_customizationfiles.impref = '".$implastslno."';";
		$fetch10 = runmysqlqueryfetch($resultcount);
		$result = runmysqlquery($resultcount);
		$fetchresultcount = $fetch10['count'];;
		$fetchcount = mysqli_num_rows($result);
		
		if($fetchcount <> 0)
		{
			$query = "SELECT imp_customizationfiles.slno,imp_customizationfiles.remarks,imp_customizationfiles.attachfilepath from imp_customizationfiles  WHERE imp_customizationfiles.impref = '".$implastslno."' order by createddatetime DESC ;";
			$grid = '<table width="100%" cellpadding="2" cellspacing="0" class="imp_table-border-grid">';
			$grid .= '<tr class="imp_tr-grid-header" align ="left"><td nowrap = "nowrap" class="imp_td-border-grid" >Sl No</td><td nowrap = "nowrap" class="imp_td-border-grid">Remarks</td><td nowrap = "nowrap" class="imp_td-border-grid">Downloadlink</td></tr>';
			$i_n = 0;
			$result = runmysqlquery($query);
			while($fetch = mysqli_fetch_array($result))
			{
				$i_n++;
				$slno++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				$grid .= '<tr bgcolor='.$color.'  align ="left">';
				$grid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".$slno."</td>";
				$grid .= "<td nowrap='nowrap' class='imp_td-border-grid'>".gridtrim($fetch['remarks'])."</td>";
				$grid .= "<td nowrap='nowrap' class='imp_td-border-grid'><div align = 'center'><img src='../images/download-arrow.gif'  style='cursor:pointer' onclick = viewfilepath('".$fetch['attachfilepath']."','1') /></div></td>";
				$grid .= "</tr>";
			}
			$grid .= "</table>";
		}
		else
		{
			$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px"  ><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font></td></tr></table>';
		}
		
		$responsearray4['errorcode'] = "1";	
		$responsearray4['grid'] = $fetch['branchapproval'];
		echo(json_encode($responsearray4));
		
		//echo '1^'.$grid;
	}
	break;
	
}




?>
