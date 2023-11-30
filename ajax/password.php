<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
$switchtytpe = $_POST['switchtype'];
switch ($switchtytpe) {
	case 'send': {
			$responsearray = array();
			$emails = $_POST['emailresult'];
			$cusid = $_POST['customerid'];
			$timestamp = date('Y-m-d') . ' ' . date('H:i:s');

			//random key value generated
			$key = rand_str();

			//md5 value of customerid ,timestamp and the random key generated
			$resultkey = md5($customerid . $timestamp . $keyvalue);

			//server side validation
			$query1 = "Select inv_mas_customer.customerid ,inv_mas_customer.businessname, 
		inv_mas_customer.place,inv_contactdetails.emailid as emailid,inv_mas_customer.slno from inv_mas_customer 
		left join inv_contactdetails on inv_contactdetails.customerid = inv_mas_customer.slno 
		where inv_mas_customer.slno = '" . $cusid . "' and inv_contactdetails.emailid = '" . $emails . "'";
			$result = runmysqlquery($query1);
			if (mysqli_num_rows($result) == 0) {
				//Invalid Customer ID
				$responsearray['errorcode'] = "2";
				$responsearray['errormsg'] = 'Invalid Customer ID';
				echo (json_encode($responsearray));
				//echo('2^'.'Invalid Customer ID');
			} else {
				$fetch1 = mysqli_fetch_array($result);
				$fetchemail = $fetch1['emailid'];


				/*if(strrpos($fetchemail,$emails) === false)
						 {
							 //Invalid Email ID
							 $responsearray['errorcode'] = "2";
							 $responsearray['errormsg'] = 'Invalid Email ID';
							 echo(json_encode($responsearray));
							 //echo('2^'.'Invalid Email ID');
						 }
						 else
						 {*/
				$businessname = $fetch1['businessname'];
				$customerid = cusidcombine1($fetch1['customerid']);
				$place = $fetch1['place'];
				$userreference = $fetch1['slno'];
				$date = datetimelocal('d-m-Y');
				$url = "http://imax.relyonsoft.net/customer/retrival/retrivepwd.php?key=" . $resultkey . "";
				//$url = "http://bhumika/rwm/SaraliMax-Customer/retrival/retrivepwd.php?key=".$resultkey."";
				$query = "UPDATE inv_mas_customer SET pwdresetkey='" . $resultkey . "',pwdresettime='" . $timestamp . "' where slno = '" . $cusid . "'";
				$result = runmysqlquery($query);

				#########  Mailing Starts -----------------------------------
				if (($_SERVER['HTTP_HOST'] == "bhumika")) {
					$emailid = 'bhumik.p@relyonsoft.com';
				} else {
					$emailid = $emails;
				}

				$emailarray = explode(',', $emailid);
				$emailcount = count($emailarray);

				for ($i = 0; $i < $emailcount; $i++) {
					if (checkemailaddress($emailarray[$i])) {
						$emailids[$businessname] = $emailarray[$i];
					}
				}
				$fromname = "Relyon";
				$fromemail = "imax@relyon.co.in";
				//$toarray = array($contactperson => $emailids);
				require_once("../include/RSLMAIL_MAIL.php");
				$msg = file_get_contents("../mailcontent/password.htm");
				$textmsg = file_get_contents("../mailcontent/password.txt");

				$array = array();
				$array[] = "##DATE##%^%" . $date;
				$array[] = "##COMPANYNAME##%^%" . $businessname;
				$array[] = "##PLACE##%^%" . $place;
				$array[] = "##CUSTOMERID##%^%" . $customerid;
				$array[] = "##URL##%^%" . $url;
				$filearray = array(
					array('../images/relyon-logo.jpg', 'inline', '1234567890')
					//array('../inc/SPP_with_Online_Profile.pdf','attachment','1234567891')
				);
				$toarray = $emailids;
				if (($_SERVER['HTTP_HOST'] == "bhumika")) {
					$bccemailids['archana'] = 'bhumika.p@relyonsoft.com';
				} else {
					$bccemailids['Relyonimax'] = 'relyonimax@gmail.com';
					$bccemailids['bigmail'] = 'bigmail@relyonsoft.com';
				}
				$bccarray = $bccemailids;
				//			print_r($emailids);
				$msg = replacemailvariable($msg, $array);
				$textmsg = replacemailvariable($textmsg, $array);
				$subject = "Password Retrival | Relyon Customer Login Area";
				$html = $msg;
				$text = $textmsg;
				$replyto = 'support@relyonsoft.com';
				rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, null, $bccarray, $filearray, $replyto);

				//Insert the mail forwarded details to the logs table
				$bccmailid = 'bigmail@relyonsoft.com';
				inserttologs($cusid, $userreference, $fromname, $fromemail, $emailid, null, $bccmailid, $subject);

				$responsearray['errorcode'] = "1";
				$responsearray['errormsg'] = 'The URL to reset your login password associated with the customer ID ' . $customerid . ' has been emailed successfully to ' . $emails . '. Please check your email account for details';
				echo (json_encode($responsearray));
				//echo('1^'.'The URL to reset your login password associated with the customer ID '.$customerid.' has been emailed successfully to '.$emails.'. Please check your email account for details');

				###################  Mailing Ends ------------------------------------------------------------

				//}

			}
		}
		break;
	case 'retrival': {
			$responsearray1 = array();
			$customerid = $_POST['customerid'];
			$query1 = "SELECT slno from inv_mas_customer where customerid = '" . $customerid . "';";
			$result = runmysqlquery($query1);
			if (mysqli_num_rows($result) == 0) {
				$responsearray1['errorcode'] = "2";
				$responsearray1['errormsg'] = 'The Customer ID ' . cusidcombine1($customerid) . ' is not registered in our Customer database. Please enter a valid Customer ID provided by Relyon. (To Know your Customer ID <a href="../retrival/customer.php" class="Links">Click here</a>). ';
				echo (json_encode($responsearray1));
				//echo('2^The Customer ID '.cusidcombine1($customerid).' is not registered in our Customer database. Please enter a valid Customer ID provided by Relyon. (To Know your Customer ID <a href="../retrival/customer.php" class="Links">Click here</a>). ');
				break;
			} else {
				$fetch = runmysqlqueryfetch($query1);
				$cusid = $fetch['slno'];
			}
			$query = "select emailid  from inv_contactdetails where customerid = '" . $cusid . "' and emailid <> '';";
			$result = runmysqlquery($query);
			$value .= '<select name="email" id="email" class="swiftselect-mandatory" style="width: 200px;" >';
			$value .= '<option value="">--Select--</option>';
			while ($fetch = mysqli_fetch_array($result)) {
				$value .= '<option value="' . $fetch['emailid'] . '">' . $fetch['emailid'] . '</option>';
			}
			$value .= '</select>';
			$responsearray1['errorcode'] = "1";
			$responsearray1['value'] = $value;
			$responsearray1['customerid'] = $cusid;
			echo (json_encode($responsearray1));
			//echo('1^'.$value.'^'.$cusid);

		}
		break;
}

?>