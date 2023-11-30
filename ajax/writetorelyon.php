<?php

ob_start("ob_gzhandler");
include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
if (imaxgetcookie('custuserid') <> '')
	$cusid = imaxgetcookie('custuserid');
else {
	echo ('Thinking to redirect');
	exit;
}
$type = $_POST['type'];
switch ($type) {
	case 'save': {
			$responsearray = array();
			$femail = trim($_POST['femail']);
			$subject = $_POST['subject'];
			$category = $_POST['category'];
			$product = $_POST['product'];
			$query = "select businessname,address,place, inv_mas_state.statename as state,
			inv_mas_district.districtname as district from inv_mas_customer 
			left join inv_mas_district on inv_mas_district.slno=inv_mas_customer.district
			left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
			where inv_mas_customer.slno ='" . $cusid . "'";
			$fetch = runmysqlqueryfetch($query);

			// fetch Contact Details
			$query1 = "SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactdetails where customerid = '" . $cusid . "'; ";
			$resultfetch = runmysqlquery($query1);
			while ($fetchres = mysqli_fetch_array($resultfetch)) {
				$selectiontype = $fetchres['selectiontype'];
				$contactperson = $fetchres['contactperson'];
				$phone = $fetchres['phone'];
				$cell = $fetchres['cell'];
				$emailid = $fetchres['emailid'];
				$slno = $fetchres['slno'];

				$contactvalues .= $contactperson;
				$contactvalues .= appendcomma($contactperson);
				$phoneres .= $phone;
				$phoneres .= appendcomma($phone);
				$cellres .= $cell;
				$cellres .= appendcomma($cell);
				$emailidres .= $emailid;
				$emailidres .= appendcomma($emailid);

			}
			$rescontact = trim($contactvalues, ',');
			$resphone = trim($phoneres, ',');
			$rescell = trim($cellres, ',');
			$resemailid = trim($emailidres, ',');

			$businessname = $fetch['businessname'];
			$contactperson = $rescontact;
			$address = $fetch['address'];
			$place = $fetch['place'];
			$state = $fetch['state'];
			$district = $fetch['district'];

			$phone = $resphone;
			$cell = $rescell;
			$custemail = $resemailid;
			if ($category == 'General' || $category == 'Re-registration') {
				$email = 'info@relyonsoft.com';
			} elseif ($category == 'Support') {
				$email = 'support@relyonsoft.com';
			} elseif ($category == 'Sales') {
				$email = 'sales@relyonsoft.com';
			} elseif ($category == 'Billing') {
				$email = 'accounts@relyonsoft.com';
			} elseif ($category == 'SOS') {
				$email = 'hsn@relyonsoft.com';

			}
			$message = $_POST['message'];

			$messageforhtml = str_replace("\n", "<br>", $message);
			$messagefortext = $message;
			#########  Mailing Starts -----------------------------------
			if (($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") || ($_SERVER['HTTP_HOST'] == "archanaab")) {
				$emailid = 'rashmi.hk@relyonsoft.com';
			} else {
				$emailid = $email;
			}

			$emailarray = explode(',', $emailid);
			$emailcount = count($emailarray);

			for ($i = 0; $i < $emailcount; $i++) {
				if (checkemailaddress($emailarray[$i])) {
					$emailids[$emailarray[$i]] = $emailarray[$i];
				}
			}

			$fromname = $businessname;
			$fromemail = $femail;
			$replyto = $femail;
			$msg = file_get_contents("../mailcontent/writetorelyon.htm");
			$textmsg = file_get_contents("../mailcontent/writetorelyon.txt");
			//$toarray = array($contactperson => $emailids);
			require_once("../include/RSLMAIL_MAIL.php");

			if ($address == '') {
				$address = 'Not Available';
			}
			$array = array();
			$array[] = "##CATEGORY##%^%" . $category;
			$array[] = "##TEXTMESSAGE##%^%" . $messageforhtml;
			$array[] = "##NAME##%^%" . $contactperson;
			$array[] = "##COMPANY##%^%" . $businessname;
			$array[] = "##PLACE##%^%" . $place;
			$array[] = "##STATE##%^%" . $state;
			$array[] = "##DISTRICT##%^%" . $district;
			$array[] = "##ADDRESS##%^%" . $address;
			$array[] = "##PHONE##%^%" . $phone;
			$array[] = "##CELL##%^%" . $cell;
			$array[] = "##EMAIL##%^%" . $custemail;
			$array[] = "##PRODUCT##%^%" . $product;

			$textarray = array();
			$textarray[] = "##CATEGORY##%^%" . $category;
			$textarray[] = "##TEXTMESSAGE##%^%" . $messagefortext;
			$textarray[] = "##NAME##%^%" . $contactperson;
			$textarray[] = "##COMPANY##%^%" . $businessname;
			$textarray[] = "##PLACE##%^%" . $place;
			$textarray[] = "##STATE##%^%" . $state;
			$textarray[] = "##DISTRICT##%^%" . $district;
			$textarray[] = "##ADDRESS##%^%" . $address;
			$textarray[] = "##PHONE##%^%" . $phone;
			$textarray[] = "##CELL##%^%" . $cell;
			$textarray[] = "##EMAIL##%^%" . $custemail;
			$textarray[] = "##PRODUCT##%^%" . $product;
			$filearray = array(
				array('../images/message-icon.gif', 'inline', '1234567890')
			);
			$toarray = $emailids;
			if ($category == 'SOS') {
				$exp_date = "2010-06-25";
				$todays_date = date("Y-m-d");
				$today = strtotime($todays_date);
				$expiration_date = strtotime($exp_date);
				if ($expiration_date > $today) {
					$ccemailids['Nitin'] = 'nitinall@relyonsoft.com';
					$ccarray = $ccemailids;
					for ($i = 0; $i < count($ccarray); $i++) {
						$ccmailid .= $ccarray[$i];
					}
				} else {
					$ccemailids['Nitin'] = '';
					$ccarray = $ccemailids;
					for ($i = 0; $i < count($ccarray); $i++) {
						$ccmailid .= $ccarray[$i];
					}
				}
				$bccemailids['bigmail'] = 'bigmail@relyonsoft.com';
			} else {
				$bccemailids['bigmail'] = 'bigmail@relyonsoft.com';
				$ccemailids['Nitin'] = '';
				$ccarray = $ccemailids;
				for ($i = 0; $i < count($ccarray); $i++) {
					$ccmailid .= $ccarray[$i];
				}
			}
			$bccemailids['Relyonimax'] = 'relyonimax@gmail.com';
			$bccarray = $bccemailids;

			$msg = replacemailvariable($msg, $array);
			$textmsg = replacemailvariable($textmsg, $textarray);

			$html = $msg;
			$text = $textmsg;
			rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, $ccarray, $bccarray, $filearray, $replyto);

			//Insert the mail forwarded details to the logs table
			$bccmailid = 'vijaykumar@relyonsoft.com,bigmail@relyonsoft.com';
			inserttologs($cusid, $cusid, $fromname, $fromemail, $emailid, $ccmailid, $bccmailid, $subject);

		}
		$responsearray['errormsg'] = "Your Message is Successful Sent";
		echo (json_encode($responsearray));
		break;
}


?>