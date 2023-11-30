<?

ob_start("ob_gzhandler");
include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
if(imaxgetcookie('custuserid')<> '') 
$cusid = imaxgetcookie('custuserid');
else
{ 
	echo('Thinking to redirect');
	exit;
}
$type = $_POST['type'];
switch($type)
{
 case 'save':
		{ 
			$responsearray = array();
 			$txt_part_1 = trim($_POST['txt_part_1']);
			$txt_email_1 = $_POST['txt_email_1'];
			$txt_con_1 = $_POST['txt_con_1'];
			
			$txt_part_2 = trim($_POST['txt_part_2']);
			$txt_email_2 = $_POST['txt_email_2'];
			$txt_con_2 = $_POST['txt_con_2'];
			
			$txt_part_3 = trim($_POST['txt_part_3']);
			$txt_email_3 = $_POST['txt_email_3'];
			$txt_con_3 = $_POST['txt_con_3'];
			
			$txt_part_4 = trim($_POST['txt_part_4']);
			$txt_email_4 = $_POST['txt_email_4'];
			$txt_con_4 = $_POST['txt_con_4'];
			
			$txt_part_5 = trim($_POST['txt_part_5']);
			$txt_email_5 = $_POST['txt_email_5'];
			$txt_con_5 = $_POST['txt_con_5'];
			
			$txt_part_6 = trim($_POST['txt_part_6']);
			$txt_email_6 = $_POST['txt_email_6'];
			$txt_con_6 = $_POST['txt_con_6'];
			
			$txtCheque	= $_POST['txtCheque'];		
			$txtChequeDate= $_POST['txtChequeDate'];
			$txtBankName= $_POST['txtBankName'];
			
			$query = "select businessname,address,place, inv_mas_state.statename as state,
			inv_mas_district.districtname as district from inv_mas_customer 
			left join inv_mas_district on inv_mas_district.slno=inv_mas_customer.district
			left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode
			where inv_mas_customer.slno ='".$cusid."'";
			$fetch= runmysqlqueryfetch($query);
			
			// fetch Contact Details
			$query1 ="SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactdetails where customerid = '".$cusid."'; ";
			$resultfetch = runmysqlquery($query1);
			while($fetchres = mysqli_fetch_array($resultfetch))
			{
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
			$rescontact = trim($contactvalues,',');
			$resphone = trim($phoneres,',');
			$rescell = trim($cellres,',');
			$resemailid = trim($emailidres,',');

			$businessname = $fetch['businessname'];
			$contactperson = $rescontact;
			$address = $fetch['address'];
			$place = $fetch['place'];
			$state = $fetch['state'];
			$district = $fetch['district'];
			
			$phone = $resphone;
			$cell = $rescell;
			$custemail = $resemailid;
			
			//$email = 'manjunath.sm@relyonsoft.com';
			$email = 'imax.support@relyonsoft.com';
			$message='';
			/*$message  =  $message . '<table width="100%" border="1" cellspacing="2" cellpadding="2">
                          <tr>
                            <td><strong>Participant name </strong></td>
                            <td><strong>Email id</strong></td>
                            <td><strong>Contact Number</strong></td>
                          </tr>
                          <tr>
                            <td>'. $txt_part_1 .'</td>
                            <td>'. $txt_email_1 .'</td>
                            <td>'. $txt_con_1. '</td>
                          </tr>
                          <tr>
                             <td>'. $txt_part_2 .'</td>
                            <td>'. $txt_email_2 .'</td>
                            <td>'. $txt_con_2. '</td>
                          </tr>
                          <tr>
                            <td>'. $txt_part_3 .'</td>
                            <td>'. $txt_email_3 .'</td>
                            <td>'. $txt_con_3. '</td>
                          </tr>
                          <tr>
                             <td>'. $txt_part_4 .'</td>
                            <td>'. $txt_email_4 .'</td>
                            <td>'. $txt_con_4. '</td>
                          </tr>
                          <tr>
                            <td>'. $txt_part_5 .'</td>
                            <td>'. $txt_email_5 .'</td>
                            <td>'. $txt_con_5. '</td>
                          </tr>
                          <tr>
                             <td>'. $txt_part_6 .'</td>
                            <td>'. $txt_email_6 .'</td>
                            <td>'. $txt_con_6. '</td>
                          </tr>
                         
                        </table>';*/
			$message='';
			
			$messageforhtml = str_replace("\n","<br>",$message);
			$messagefortext = $message;
 			#########  Mailing Starts -----------------------------------
			if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") ||  ($_SERVER['HTTP_HOST'] == "archanaab"))
			{
				$emailid = 'rashmi.hk@relyonsoft.com';
			}
			else
			{
				$emailid = $email;
			}
			
			$emailarray = explode(',',$emailid);
			$emailcount = count($emailarray);
			
			for($i = 0; $i < $emailcount; $i++)
			{
				if(checkemailaddress($emailarray[$i]))
				{
						$emailids[$emailarray[$i]] = $emailarray[$i];
				}
			}
			
			$fromname = "Relyon Softech Ltd.";
			$fromemail = "imax@relyon.co.in";
			$replyto = "imax@relyon.co.in"; 
			$msg = file_get_contents("../mailcontent/saraltds-blr.htm");
			$textmsg = file_get_contents("../mailcontent/saraltds-blr.txt");
			//$toarray = array($contactperson => $emailids);
			require_once("../include/RSLMAIL_MAIL.php");
			
			if($address == '')
			{
				$address = 'Not Available';
			}
			$array = array();
			
			$array[] = "##TEXTMESSAGE##%^%".$messageforhtml;
			$array[] = "##NAME##%^%".$contactperson;
			$array[] = "##COMPANY##%^%".$businessname;
			$array[] = "##PLACE##%^%".$place;
			$array[] = "##STATE##%^%".$state;
			$array[] = "##DISTRICT##%^%".$district;
			$array[] = "##ADDRESS##%^%".$address;
			$array[] = "##PHONE##%^%".$phone;
			$array[] = "##CELL##%^%".$cell;
			$array[] = "##EMAIL##%^%".$custemail;
			
			$array[] = "##txt_part_1##%^%".$txt_part_1;
			$array[] = "##txt_email_1##%^%".$txt_email_1;
			$array[] = "##txt_con_1##%^%".$txt_con_1;
			
			$array[] = "##txt_part_2##%^%".$txt_part_2;
			$array[] = "##txt_email_2##%^%".$txt_email_2;
			$array[] = "##txt_con_2##%^%".$txt_con_2;
			
			$array[] = "##txt_part_3##%^%".$txt_part_3;
			$array[] = "##txt_email_3##%^%".$txt_email_3;
			$array[] = "##txt_con_3##%^%".$txt_con_3;
			
			$array[] = "##txt_part_4##%^%".$txt_part_4;
			$array[] = "##txt_email_4##%^%".$txt_email_4;
			$array[] = "##txt_con_4##%^%".$txt_con_4;
			
			$array[] = "##txt_part_5##%^%".$txt_part_5;
			$array[] = "##txt_email_5##%^%".$txt_email_5;
			$array[] = "##txt_con_5##%^%".$txt_con_5;
			
			$array[] = "##txt_part_6##%^%".$txt_part_6;
			$array[] = "##txt_email_6##%^%".$txt_email_6;
			$array[] = "##txt_con_6##%^%".$txt_con_6;
			
			$array[] = "##txtCheque##%^%".$txtCheque;
			$array[] = "##txtChequeDate##%^%".$txtChequeDate;
			$array[] = "##txtBankName##%^%".$txtBankName;
			
			
			
			
			
			
			$textarray = array();
			
			$textarray[] = "##TEXTMESSAGE##%^%".$messagefortext;
			$textarray[] = "##NAME##%^%".$contactperson;
			$textarray[] = "##COMPANY##%^%".$businessname;
			$textarray[] = "##PLACE##%^%".$place;
			$textarray[] = "##STATE##%^%".$state;
			$textarray[] = "##DISTRICT##%^%".$district;
			$textarray[] = "##ADDRESS##%^%".$address;
			$textarray[] = "##PHONE##%^%".$phone;
			$textarray[] = "##CELL##%^%".$cell;
			$textarray[] = "##EMAIL##%^%".$custemail;
			
			$filearray = array(
				array('../images/message-icon.gif','inline','1234567890')
			);
			$toarray = $emailids;
			
			$bccemailids['bigmail'] ='bigmail@relyonsoft.com';
			$bccemailids['Relyonimax'] ='relyonimax@gmail.com';
			$bccarray = $bccemailids;
			
			$msg = replacemailvariable($msg,$array);
			$textmsg = replacemailvariable($textmsg,$textarray);
			
			$html = $msg;
			$text = $textmsg;
			$subject = "Training Registration from ". $businessname;
			
			//echo $html;
			rslmail($fromname, $fromemail, $toarray, $subject, $text, $html, $ccarray,$bccarray, $filearray,$replyto);
			
			//Insert the mail forwarded details to the logs table
			//$bccmailid = 'vijaykumar@relyonsoft.com,bigmail@relyonsoft.com'; 
			//inserttologs($cusid,$cusid,$fromname,$fromemail,$emailid,$ccmailid,$bccmailid,$subject);
			
		}
		$responsearray['errormsg'] = "Your Message is Successful Sent";
		echo(json_encode($responsearray));
		break;
}

	
?>