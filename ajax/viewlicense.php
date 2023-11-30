<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtytpe = $_POST['switchtype'];

if(imaxgetcookie('custuserid')<> '') 
$cusid = imaxgetcookie('custuserid');
else
{ 
	echo('Thinking to redirect');
	exit;
}

switch($switchtytpe)
{
	case 'view':
	{
		$responsearray = array();
		$limit = 5;
		$slno = 0;
		$query1 = "select distinct inv_mas_product.group from inv_customerproduct left join inv_mas_product on
		left(inv_customerproduct.computerid,3) = inv_mas_product.productcode where customerreference='".$cusid."' and reregistration = 'no';";
		$result1 = runmysqlquery($query1);
		if(mysqli_num_rows($result1) == 0)
		{
			$message = '<table width="100%" border="0" cellpadding="0" cellspacing="0" bordercolor="#527094"><tr>
		<td><table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr><td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr> <td ><div align="center"><strong><font color ="#FF0000">No Licenses Avaialble</font></strong></div></td></tr></table></td></tr></table></td></tr></table>';
			$responsearray['errorcode'] = "1";
			$responsearray['message'] = $message;
			echo(json_encode($responsearray));
			//echo('1%*%'.$message);
		}	
		else
		{
			while($fetch1 = mysqli_fetch_array($result1))
			{	
				$grouparray[] = $fetch1['group'];
			}
			//$grouparray[] = 'SES';
			$val2 = groupdisplay($grouparray,$cusid,$limit,$slno);
			$responsearray['errorcode'] = "2";
			$responsearray['message'] = $val2;
			echo(json_encode($responsearray));
			//echo('2%*%'.$val2);
		}
		
	}
	break;
	case 'recorddisplay':
	{
		$grouparray[] = $_POST['array'];
		$cusid = $_POST['cusid'];
		$limit = $_POST['limit'];
		$slno = $_POST['slno'];
		$val1 = groupdisplay($grouparray,$cusid,$limit,$slno);
		//echo(json_encode($responsearray1));
		echo(json_encode($val1));
	}
	break;
}


function groupdisplay($grouparray,$cusid,$limit,$slno)
{
	for($i = 0; $i < count($grouparray); $i++)
	{
		$group = $grouparray[$i];
		switch($group)
		{
			case 'SES':
			{
				$slno1 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno1.",".$limit.";";
			$result1 = runmysqlquery($query3);
			if($slno1 == 0)
			{
				$grid .= '<table width="100%" border="0" cellpadding="4" cellspacing="0">';
				$grid .= '<tr><td  style="text-align:left;"><strong>'.grouplongname('SES').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result1))
			{
				$slno1++;
				if($slno1 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno1.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid .= "</table>";
		$array1 = 'SES';
		if($slno1 >= $fetchresultcount)
		$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F"  style="text-align:left;">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid .= '<table align="center"><tr><td height ="2px"></td></tr><tr><td ><a onclick ="getmoreesigndetails(\''.$array1.'\',\''.$cusid.'\',\'5\',\''.$slno1.'\');" class="more" ><span id ="moredis" >Show More Records >></span></a></td></tr></table>';
		$esigngrid = $grid.'^'.$linkgrid;
			}
			break;
			
			case 'CONTACT':
			{
				$slno2 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno2.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno2 == 0)
			{
				$grid1 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid1 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('CONTACT').'</strong></td><tr>';
			}

			while($fetch = mysqli_fetch_array($result2))
			{
				$slno2++;
				if($slno2 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid1 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno2.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid1 .= "</table>";
		$array2 = 'CONTACT';
		if($slno2 >= $fetchresultcount)
		$linkgrid1 .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid1 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmorecontactdetails(\''.$array2.'\',\''.$cusid.'\',\'5\',\''.$slno2.'\');" class="more" ><span id ="moredis1">Show More Records >></span></a></td></tr></table>';
		$contactgrid = $grid1.'^'.$linkgrid1;
			}
			break;
			
			case 'STO':
			{
				$slno3 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno3.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno3 == 0)
			{
				$grid2 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid2 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('STO').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno3++;
				if($slno3 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid2 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno3.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid2 .= "</table>";
		$array3 = 'STO';
		if($slno3 >= $fetchresultcount)
		$linkgrid2 .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid2 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td ><a onclick ="getmorestodetails(\''.$array3.'\',\''.$cusid.'\',\'5\',\''.$slno3.'\');" class="more" ><span id ="moredis2">Show More Records >></span></a></td></tr></table>';
		$stogrid = $grid2.'^'.$linkgrid2;
			}
			break;
			
			
			case 'SPP':
			{
				$slno4 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno4.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno4 == 0)
			{
				$grid3 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid3 .= '<tr><td  style="text-align:left;"><strong>'.grouplongname('SPP').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno4++;
				if($slno4 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid3 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno4.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid3 .= "</table>";
		$array4 = 'SPP';
		if($slno4 >= $fetchresultcount)
		$linkgrid3 .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid3 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoresppdetails(\''.$array4.'\',\''.$cusid.'\',\'5\',\''.$slno4.'\');" class="more" ><span id ="moredis3">Show More Records >></span></a></td></tr></table>';
		$sppgrid = $grid3.'^'.$linkgrid3;
			}
			break;
			
			
			case 'SAC':
			{
				$slno5 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno5.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno5 == 0)
			{
				$grid4 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid4 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('SAC').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno5++;
				if($slno5 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid4 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno5.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid4 .= "</table>";
		$array5 = 'SAC';
		if($slno5 >= $fetchresultcount)
		$linkgrid4 .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid4 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoresacdetails(\''.$array5.'\',\''.$cusid.'\',\'5\',\''.$slno5.'\');" class="more" ><span id ="moredis4">Show More Records >></span></a></td></tr></table>';
		$sacgrid = $grid4.'^'.$linkgrid4;
			}
			break;
			
			case 'OTHERS':
			{
				$slno6 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno6.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno6 == 0)
			{
				$grid5 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid5 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('OTHERS').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno6++;
				if($slno6 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid5 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno6.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid5 .= "</table>";
		$array6 = 'OTHERS';
		if($slno6 >= $fetchresultcount)
		$linkgrid5 .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid5 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoreothersdetails(\''.$array6.'\',\''.$cusid.'\',\'5\',\''.$slno6.'\');" class="more" ><span id ="moredis5" >Show More Records >></span></a></td></tr></table>';
		$othersgrid = $grid5.'^'.$linkgrid5;
			}
			break;
			
			case 'SURVEY':
			{
				$slno7 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno7.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno7 == 0)
			{
				$grid6 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid6 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('SURVEY').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno7++;
				if($slno7 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid6 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno7.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid6 .= "</table>";
		$array7 = 'SURVEY';
		if($slno7 >= $fetchresultcount)
		$linkgrid6 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid6 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoresurveydetails(\''.$array7.'\',\''.$cusid.'\',\'5\',\''.$slno7.'\');" class="more" ><span id ="moredis6" >Show More Records >></span></a></td></tr></table>';
		$surveygrid = $grid6.'^'.$linkgrid6;
			}
			break;
			
			case 'TDS':
			{
				$slno8 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno8.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno8 == 0)
			{
				$grid7 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid7 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('TDS').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno8++;
				if($slno8 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid7 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno8.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid7 .= "</table>";
		$array8 = 'TDS';
		if($slno8 >= $fetchresultcount)
		$linkgrid7 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid7 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoretdsdetails(\''.$array8.'\',\''.$cusid.'\',\'5\',\''.$slno8.'\');" class="more" ><span id ="moredis7" >Show More Records >></span></a></td></tr></table>';
		$tdsgrid = $grid7.'^'.$linkgrid7;
			}
			break;
			
			case 'SVH':
			{
				$slno9 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno9.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno9 == 0)
			{
				$grid8 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid8 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('SVH').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno9++;
				if($slno9 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid8 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno9.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid8 .= "</table>";
		$array9 = 'SVH';
		if($slno9 >= $fetchresultcount)
		$linkgrid8 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid8 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoresvhdetails(\''.$array9.'\',\''.$cusid.'\',\'5\',\''.$slno9.'\');" class="more" ><span id ="moredis8" >Show More Records >></span></a></td></tr></table>';
		$svhgrid = $grid8.'^'.$linkgrid8;
			}
			break;
			
			case 'SVI':
			{
				$slno10 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno10.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno10 == 0)
			{
				$grid9 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid9 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('SVI').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno10++;
				if($slno10 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid9 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno10.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid9 .= "</table>";
		$array10 = 'SVI';
		if($slno10 >= $fetchresultcount)
		$linkgrid9 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid9 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoresvidetails(\''.$array10.'\',\''.$cusid.'\',\'5\',\''.$slno10.'\');" class="more" ><span id ="moredis9" >Show More Records >></span></a></td></tr></table>';
		$svigrid = $grid9.'^'.$linkgrid9;
			}
			break;
			
			case 'AIR':
			{
				$slno11 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno11.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno11 == 0)
			{
				$grid10 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid10 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('AIR').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno11++;
				if($slno11 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid10 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno11.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid10 .= "</table>";
		$array11 = 'AIR';
		if($slno11 >= $fetchresultcount)
		$linkgrid10 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid10 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmoreairdetails(\''.$array11.'\',\''.$cusid.'\',\'5\',\''.$slno11.'\');" class="more" ><span id ="moredis10" >Show More Records >></span></a></td></tr></table>';
		$airgrid = $grid10.'^'.$linkgrid10;
			}
			break;
			case 'NA':
			{
				$slno12 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno12.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno12 == 0)
			{
				$grid11 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid11 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('NA').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno12++;
				if($slno12 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid11 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno12.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid11 .= "</table>";
		$array12 = 'NA';
		if($slno12 >= $fetchresultcount)
		$linkgrid11 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid11 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmorenadetails(\''.$array12.'\',\''.$cusid.'\',\'5\',\''.$slno12.'\');" class="more" ><span id ="moredis11" >Show More Records >></span></a></td></tr></table>';
		$nagrid = $grid11.'^'.$linkgrid11;
			}
			case 'XBRL':
			{
				$slno13 = $slno;
				$query2 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc";
			$resultfetch = runmysqlquery($query2);
			$fetchresultcount = mysqli_num_rows($resultfetch);
			$query3 = "select  inv_mas_product.productname,inv_mas_product.group,
inv_mas_product.year, inv_mas_scratchcard.cardid, inv_mas_scratchcard.scratchnumber,inv_customerproduct.date AS Date ,inv_customerproduct.computerid ,inv_customerproduct.softkey,inv_mas_dealer.businessname as Dealer
from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode  left join inv_mas_scratchcard on inv_customerproduct.cardid = inv_mas_scratchcard.cardid left join inv_mas_dealer 
on inv_mas_dealer.slno=inv_customerproduct.dealerid where customerreference='".$cusid."' and reregistration = 'no' and inv_mas_product.group = '".$grouparray[$i]."' order by date desc LIMIT ".$slno13.",".$limit.";";
			$result2 = runmysqlquery($query3);
			
			if($slno13 == 0)
			{
				$grid12 .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094">';
				$grid12 .= '<tr><td style="text-align:left;"><strong>'.grouplongname('XBRL').'</strong></td><tr>';
			}
			while($fetch = mysqli_fetch_array($result2))
			{
				$slno13++;
				if($slno13 == 1)
					$color = '#FF0000';
				else
					$color = '#3366CC';
				$cardid = ($fetch['cardid'] <> '')?$fetch['cardid']:"Not available";
				$pinno = ($fetch['scratchnumber'] <> '')?$fetch['scratchnumber']:"Not available";
				$year = ($fetch['year'] <> '')?$fetch['year']:"Not available";
				
				$grid12 .= '<div><table width="100%" border="0" cellpadding="5" cellspacing="0"><tr><td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5"><tr bgcolor="#f7faff"><td colspan="2"  width="100%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><font color="'.$color.'"><strong>'.$slno13.'.&nbsp;&nbsp;'.$fetch['productname'].'</strong></font></td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">License Date:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.changedateformat($fetch['Date']).'</td></tr><tr bgcolor="#edf4ff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Number:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$cardid.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;">Computer ID:</td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['computerid'].'</td></tr></table></td><td width="50%" valign="top"  style="text-align:left;"><table width="100%" border="0" cellspacing="0" cellpadding="5" class="swiftselect"><tr bgcolor="#f7faff"><td width="44%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">Year:</div></td><td width="56%" valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$year.'</td></tr><tr bgcolor="#f7faff"><td valign="top" bgcolor="#f7faff"  style="text-align:left;"><div align="left">Dealer:</div></td><td valign="top" bgcolor="#f7faff"  style="text-align:left;">'.$fetch['Dealer'].'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;"><div align="left">PIN Serial:</div></td><td valign="top" bgcolor="#EDF4FF"  style="text-align:left;">'.$pinno.'</td></tr><tr bgcolor="#edf4ff"><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;"><div align="left">Soft Key:</div></td><td valign="top" bgcolor="#F7FAFF"  style="text-align:left;">'.$fetch['softkey'].'</td></tr> </table></td></tr></table></div>';
			}
		$grid12 .= "</table>";
		$array13 = 'XBRL';
		if($slno13 >= $fetchresultcount)
		$linkgrid12 .='<table width="100%%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
		else
		$linkgrid12 .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick ="getmorenadetails(\''.$array13.'\',\''.$cusid.'\',\'5\',\''.$slno13.'\');" class="more" ><span id ="moredis11" >Show More Records >></span></a></td></tr></table>';
		$xbrlgrid = $grid12.'^'.$linkgrid12;
			}
			break;
		}
	}
	return $esigngrid.'$$'.$contactgrid.'$$'.$stogrid.'$$'.$sppgrid.'$$'.$sacgrid.'$$'.$othersgrid.'$$'.$surveygrid.'$$'.$tdsgrid.'$$'.$svhgrid.'$$'.$svigrid.'$$'.$airgrid.'$$'.$nagrid .'$$'.$xbrlgrid;
	
}



?>