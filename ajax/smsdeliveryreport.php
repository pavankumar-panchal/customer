<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
$switchtype = $_POST['switchtype'];
$cusid = imaxgetcookie('custuserid');
switch ($switchtype) {
	case 'generatedeliveryreportgrid': {
			$responsearray = array();
			$startlimit = $_POST['startlimit'];
			$slnocount = $_POST['slnocount'];
			$showtype = $_POST['showtype'];
			$smsuserid = $_POST['smsuserid'];
			$smspassword = $_POST['smspassword'];
			$verifiedvalue = verifyusernameandpassword($smsuserid, $smspassword);
			$verifiedvaluesplit = explode('^', $verifiedvalue);
			if ($verifiedvaluesplit[0] == '1') {
				$resultcount = "select smsdate,smsnumber,smstext,deliverystatus,deliverydatetime from inv_sms_logs_sendsms where smsuserid ='" . $smsuserid . "'; ";
				$fetch10 = runmysqlquery($resultcount);
				$fetchresultcount = mysqli_num_rows($fetch10);
				if ($showtype == 'all')
					$limit = 100000;
				else
					$limit = 100;
				if ($startlimit == '') {
					$startlimit = 0;
					$slnocount = 0;
				} else {
					$startlimit = $slnocount;
					$slnocount = $slnocount;
				}
				$query = "select smsdate,smsnumber,smstext,deliverystatus,deliverydatetime from inv_sms_logs_sendsms where smsuserid ='" . $smsuserid . "' order by smsdate desc  LIMIT " . $startlimit . "," . $limit . "; ";
				$result = runmysqlquery($query);
				if ($startlimit == 0) {
					$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
					$grid .= '<tr class="tr-grid-header1"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Number</td><td nowrap = "nowrap" class="td-border-grid">Text</td><td nowrap = "nowrap" class="td-border-grid">Delivery Status</td><td nowrap = "nowrap" class="td-border-grid">Delivery Date</td></tr>';
				}

				$i_n = 0;
				while ($fetch = mysqli_fetch_array($result)) {
					$i_n++;
					$slnocount++;
					$color;
					if ($i_n % 2 == 0)
						$color = "#edf4ff";
					else
						$color = "#f7faff";
					$smsdatetime = explode(' ', $fetch['smsdate']);
					$smsdate = $smsdatetime[0];
					$smstime = $smsdatetime[1];
					$smstextstring = $fetch['smsnumber'];
					$smstextstring1 = substr($smstextstring, 0, 1);
					$smstextstring2 = 'X';
					$smstextstring3 = substr($smstextstring, 2, 2);
					$smstextstring4 = 'X';
					$smstextstring5 = substr($smstextstring, 5, 5);
					$concsmstextstring = $smstextstring1 . $smstextstring2 . $smstextstring3 . $smstextstring4 . $smstextstring5;
					$smstextsent = base64_decode($fetch['smstext']);
					$smstextlength = strlen($smstextsent);
					$grid .= '<tr bgcolor=' . $color . ' class="gridrow1">';
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . $slnocount . "</td>";
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . changedateformat($smsdate) . "</td>";
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . $smstime . "</td>";
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . gridtrim($concsmstextstring) . "</td>";
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . gridtrimsmstext($smstextsent) . ' (' . $smstextlength . ')' . "</td>";
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . gridtrim($fetch['deliverystatus']) . "</td>";
					$grid .= "<td nowrap='nowrap' class='td-border-grid'>" . changedateformatwithtime($fetch['deliverydatetime']) . "</td>";
					$grid .= "</tr>";
				}
				$grid .= "</table>";
				$fetchcount = mysqli_num_rows($result);
				if ($slnocount >= $fetchresultcount)

					$linkgrid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
				else
					$linkgrid .= '<table><tr><td ><div align ="left" style="padding-right:10px"><a onclick ="getmoregeneratedeliveryreportgrid(\'' . $startlimit . '\',\'' . $slnocount . '\',\'more\');" style="cursor:pointer" class="resendtext">Show More Records >></a><a onclick ="getmoregeneratedeliveryreportgrid(\'' . $startlimit . '\',\'' . $slnocount . '\',\'all\');" class="resendtext1" style="cursor:pointer"><font color = "#000000">(Show All Records)</font></a></div></td></tr></table>';
				$responsearray['errorcode'] = "1";
				$responsearray['grid'] = $grid;
				$responsearray['fetchresultcount'] = $fetchresultcount;
				$responsearray['linkgrid'] = $linkgrid;
				echo (json_encode($responsearray));
				//echo('1~'.$grid.'~'.$fetchresultcount.'~'.$linkgrid);	
			} else {
				$grid = '<table width="100%" cellpadding="3" cellspacing="0" class="table-border-grid">';
				$grid .= '<tr class="tr-grid-header1"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Date</td><td nowrap = "nowrap" class="td-border-grid">Time</td><td nowrap = "nowrap" class="td-border-grid">Number</td><td nowrap = "nowrap" class="td-border-grid">Text</td><td nowrap = "nowrap" class="td-border-grid">Delivery Status</td><td nowrap = "nowrap" class="td-border-grid">Delivery Date</td></tr></table>';
				$fetchresultcount = 0;
				$linkgrid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
				$responsearray['errorcode'] = "2";
				$responsearray['grid'] = $grid;
				$responsearray['fetchresultcount'] = $fetchresultcount;
				$responsearray['linkgrid'] = $linkgrid;
				echo (json_encode($responsearray));
				//echo('2~'.$grid.'~'.$fetchresultcount.'~'.$linkgrid);	
			}

		}
		break;
	case 'getuseraccountlist': {
			$customerreference = $_POST['customerreference'];
			$query = "select * from inv_smsactivation where userreference = '" . $cusid . "' order by smsusername";
			$result = runmysqlquery($query);
			$grid = '<select name="smsaccount" class="swiftselect-mandatory" id="smsaccount" style="width:200px;">                      <option value="">Select an Account</option>';
			while ($fetch = mysqli_fetch_array($result)) {
				$grid .= '<option value="' . $fetch['slno'] . '">' . $fetch['smsusername'] . '</option>';
			}
			$grid .= '</select>';
			echo (json_encode($grid));
		}
		break;
	case 'verifypassword': {
			$smsuserid = $_POST['smsuserid'];
			$smspassword = $_POST['smspassword'];
			$verifiedresult = verifyusernameandpassword($smsuserid, $smspassword);
			echo (json_encode($verifiedresult));
		}
		break;
}


function verifyusernameandpassword($smsuserid, $smspassword)
{
	$query = "SELECT * FROM inv_smsactivation WHERE slno = '" . $smsuserid . "';";
	$result = runmysqlquery($query);
	if (mysqli_num_rows($result) > 0) {
		$fetch = mysqli_fetch_array($result);
		$password = $fetch['smspassword'];
		if ($password <> $smspassword)
			return '2^Invalid Password';
		else
			return '1^1';
	} else {
		return '2^Invalid SMS Account';
	}
}
?>