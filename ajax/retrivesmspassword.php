<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
$type = $_POST['switchtype'];
$cusid = imaxgetcookie('custuserid');
switch ($type) {
	case 'retrivesmspassword': {
			$responsearray1 = array();
			$smsaccount = $_POST['smsuserid'];
			$smsemailid = $_POST['smsemailid'];
			$verifiedresult = verifyemail($smsemailid, $smsaccount);
			$verifiedresultsplit = explode('^', $verifiedresult);
			if ($verifiedresultsplit[0] == 1) {
				//Get the company name
				$query1 = "select * from  inv_mas_customer where slno = '" . $cusid . "';";
				$resultfetch = runmysqlqueryfetch($query1);
				$companyname = $resultfetch['businessname'];

				//Get the username,contact person emailid from activation table
				$query = 'select * from inv_smsactivation where userreference = "' . $cusid . '" and activatesmsaccount = "yes" and slno = "' . $smsaccount . '";';
				$resultfetch = runmysqlqueryfetch($query);
				$smsusername = $resultfetch['smsusername'];
				$emailid = $resultfetch['emailid'];
				$contactperson = $resultfetch['contactperson'];
				$smsnewpassword = generatepwd();

				//Update password for the selected account
				$query = "update inv_smsactivation set smspassword = '" . $smsnewpassword . "' where userreference = '" . $cusid . "' and activatesmsaccount = 'yes' and slno = '" . $smsaccount . "';";
				$result = runmysqlquery($query);
				#########  Mailing Starts -----------------------------------
				//$emailids['rashmi'] = 'rashmi.hk@relyonsoft.com';
				$emailids[$contactperson] = $emailid;
				$fromname = "Relyon";
				$fromemail = "imax@relyon.co.in";
				require_once("../include/RSLMAIL_MAIL.php");
				$msg = file_get_contents("../mailcontent/retrivesmspassword.htm");
				$textmsg = file_get_contents("../mailcontent/retrivesmspassword.txt");
				$date = date('d-m-Y') . ' (' . date('H:i') . ')';
				$array = array();
				$array[] = "##DATE##%^%" . $date;
				$array[] = "##USERNAME##%^%" . $smsusername;
				$array[] = "##PASSWORD##%^%" . $smsnewpassword;
				$array[] = "##COMPANYNAME##%^%" . $companyname;

				$filearray = array(
					array('../images/relyon-logo.jpg', 'inline', '1234567890')
				);
				$toarray = $emailids;
				$bccemailids['Relyonimax'] = 'relyonimax@gmail.com';
				$bccemailids['bigmail'] = 'bigmail@relyonsoft.com';
				//$bccemailids['bigmail'] ='meghana.b@relyonsoft.com';
				$bccarray = $bccemailids;
				$msg = replacemailvariable($msg, $array);
				$textmsg = replacemailvariable($textmsg, $array);
				//$textmsg ='Test Message';

				$subject = "SMS Password Retrival | Relyon Customer Login Area";
				$html = $msg;
				$text = $textmsg;
				rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, null, $bccarray, $filearray);

				//Insert the mail forwarded details to the logs table
				$bccmailid = 'vijaykumar@relyonsoft.com,bigmail@relyonsoft.com';
				inserttologs($cusid, $cusid, $fromname, $fromemail, $emailid, null, $bccmailid, $subject);

				$responsearray1['errorcode'] = "1";
				$responsearray1['errormsg'] = 'The login password associated with the SMS Account ' . $customerid . ' has been emailed successfully to ' . $emailid . '. Please check your email account for details';
				echo (json_encode($responsearray1));
				//echo('1^'.'The login password associated with the SMS Account '.$customerid.' has been emailed successfully to '.$emailid.'. Please check your email account for details');
			} else {
				$responsearray1['errorcode'] = "2";
				$responsearray1['errormsg'] = $verifiedresultsplit[1];
				echo (json_encode($responsearray1));
			}
			//echo('2^'.$verifiedresultsplit[1]);

			###################  Mailing Ends ------------------------------------------------------------
		}
		break;
	case 'getuseraccountlist': {
			$customerreference = $_POST['customerreference'];
			$query = "select * from inv_smsactivation where userreference = '" . $cusid . "'";
			$result = runmysqlquery($query);
			$grid = '<select name="smsaccount" class="swiftselect-mandatory" id="smsaccount" style="width:200px;">                      <option value="">Select an Account</option>';
			while ($fetch = mysqli_fetch_array($result)) {
				$grid .= '<option value="' . $fetch['slno'] . '">' . $fetch['smsusername'] . '</option>';
			}
			$grid .= '</select>';
			echo (json_encode($grid));
		}
		break;
	case 'checkemailid': {
			$responsearray = array();
			$smsemailid = $_POST['smsemailid'];
			$smsuserid = $_POST['smsuserid'];
			$verifiedresult = verifyemail($smsemailid, $smsuserid);
			$responsearray['verifiedresult'] = $verifiedresult;
			echo (json_encode($responsearray));
			//echo($verifiedresult);

		}
		break;
}

function verifyemail($smsemailid, $smsuserid)
{
	$query = "Select * from inv_smsactivation where slno = '" . $smsuserid . "';";
	$result = runmysqlquery($query);
	if (mysqli_num_rows($result) > 0) {
		$fetch = mysqli_fetch_array($result);
		$emailid = $fetch['emailid'];
		if ($emailid <> $smsemailid)
			return '2^The entered Email ID does not match with the Email ID in the Database. Please enter the correct Email ID';
		else
			return '1^1';
	} else
		return '2^Invalid Account' . $query;
}
?>