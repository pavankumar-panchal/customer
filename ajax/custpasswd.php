<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtytpe = $_POST['switchtype'];
switch($switchtytpe)
{
		case 'retrival':
		{
			$responsearray = array();
			$email= $_POST['email'];
			$query1="SELECT count(*) as count from inv_contactdetails where emailid Like '%".$email."%' and customerid <> ''";
			$fetch = runmysqlqueryfetch($query1);
			$count = $fetch['count'];
			if($count > 0)
			{
				$query = "select inv_mas_customer.customerid,businessname,inv_mas_customer.slno  from inv_mas_customer
left join inv_contactdetails on inv_mas_customer.slno = inv_contactdetails.customerid
 where inv_contactdetails.emailid Like '%".$email."%' and inv_contactdetails.customerid <> '';";
				//$fetch = runmysqlqueryfetch($query);
				//$businessname = $fetch['businessname'];
				//$customerid = cusidcombine1($fetch['customerid']);
				//echo($fetch['customerid'].'^'.$fetch['businessname']);
				$grid = '<table width="400px" cellpadding="3" cellspacing="0" border="1" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px" >';
				$grid .= '<tr bgcolor ="#E9E9D1"><td nowrap = "nowrap"><strong>Sl No</strong></td><td nowrap = "nowrap"><strong>Customer ID</strong></td><td nowrap = "nowrap"><strong>Company Name</strong></td></tr>';
				$result2 = runmysqlquery($query);
				$k = 0;
				$count = 0;
				while($fetch2 = mysqli_fetch_array($result2))
				{
					
					$k++;
					$grid .= '<tr>';
					$grid .= "<td nowrap = 'nowrap'>".$k."</td>";
					$grid .= "<td nowrap = 'nowrap'>".cusidcombine1($fetch2['customerid'])."</td>";
					if($count > 0)
						$userreference .=',';
					$userreference .= $fetch2['slno'];
					$count++;
					$contactperson = $fetch2['businessname'];
					$grid .= "<td nowrap = 'nowrap'>".$fetch2['businessname']."</td>";
					$grid .= "</tr>";
				}
					$grid .= "</table>";
					$table = $grid;
				
				#########  Mailing Starts -----------------------------------
				if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") ||  ($_SERVER['HTTP_HOST'] == "archanaab"))
				{
					$emailid = 'meghana.b@relyonsoft.com';
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
							$emailids[$contactperson] = $emailarray[$i];
					}
				}
				$fromname = "Relyon";
				$fromemail = "imax@relyon.co.in";
				//$toarray = array($contactperson => $emailids);
				$subject = "Testing";
				require_once("../include/RSLMAIL_MAIL.php");
				$msg = file_get_contents("../mailcontent/custpasswd.htm");
				$textmsg = file_get_contents("../mailcontent/custpasswd.txt");
				
				$array = array();
				$array[] = "##TABLE##%^%".$table;
				$array[] = "##EMAILID##%^%".$email;
				
				$filearray = array(
				array('../images/relyon-logo.jpg','inline','1234567890')
				//array('../inc/SPP_with_Online_Profile.pdf','attachment','1234567891')
				);
				$toarray = $emailids;
				if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") ||  ($_SERVER['HTTP_HOST'] == "archanaab"))
				{
					$bccemailids['archana'] ='archana.ab@relyonsoft.com';
				}
				else
				{
					$bccemailids['Relyonimax'] ='relyonimax@gmail.com';
					$bccemailids['bigmail'] ='bigmail@relyonsoft.com';
				}
				$bccarray = $bccemailids;
	//			print_r($emailids);
				$msg = replacemailvariable($msg,$array);
				$textmsg = replacemailvariable($textmsg,$array);
				$subject = "Customer ID Retrival | Relyon Customer Login Area";
				$html = $msg;
				$text = $textmsg;
				$replyto = 'support@relyonsoft.com';
				rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,null,$bccarray,$filearray,$replyto);
				
				//Insert the mail forwarded details to the logs table
				$bccmailid = 'bigmail@relyonsoft.com'; 
				inserttologs($userreference,$userreference,$fromname,$fromemail,$emailid,null,$bccmailid,$subject);
				
				###################  Mailing Ends ------------------------------------------------------------
				$responsearray['errorcode'] = "1";
				$responsearray['errormsg'] = 'The Customer ID associated with '.$email.' has been emailed successfully to your email account. Please check your email account for details.';
				echo(json_encode($responsearray));
				
				//echo('1^ The Customer ID associated with '.$email.' has been emailed successfully to your email account. Please check your email account for details.');
			}
			else
			{
				$responsearray['errorcode'] = "2";
				$responsearray['errormsg'] = 'This email ID is not registered in our Customer database.';
				echo(json_encode($responsearray));
				//echo('2^ This email ID is not registered in our Customer database.');
			}
			break;
		}
}


?>