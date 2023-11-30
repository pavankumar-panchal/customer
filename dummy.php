<?php

include('functions/phpfunctions.php');
	$emailid = 'meghana.b@relyonsoft.com';
	$emailarray = explode(',',$emailid);
	$emailcount = count($emailarray);
	
	for($i = 0; $i < $emailcount; $i++)
	{
		if(checkemailaddress($emailarray[$i]))
		{
				$emailids[$emailarray[$i]] = $emailarray[$i];
		}
	}
	
	
	$fromname = "Relyon";
	$fromemail = "imax@relyon.co.in";
	//$subject = "Testing";
	require_once("include/RSLMAIL_MAIL.php");
	$msg = file_get_contents("mailcontent/writetorelyon.htm");
	$textmsg = file_get_contents("mailcontent/writetorelyon.txt");
	$date = datetimelocal('d-m-Y');
	/*$array = array();
	$array[] = "##DATE##%^%".$date;
	$array[] = "##NAME##%^%".$contactperson;
	$array[] = "##COMPANY##%^%".$businessname;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##TABLE##%^%".$table;
	$array[] = "##BILLNO##%^%".$cusbillnumber;
	$array[] = "##EMAILID##%^%".$emailid;
	$array[] = "##AMOUNT##%^%".$totalpurchaseamount;
	$array[] = "##TOTALCREDIT##%^%".$totalcredit;
	$array[] = "##REMARKS##%^%".$remarks;*/
	$filearray = array(
		array('images/relyon-logo.jpg','inline','8888888888'),
		array('images/message-icon.gif','inline','1234567890')
	);
	$toarray = $emailids;
	//$bccemailids['rashmi'] ='archana.ab@relyonsoft.com';
	//$bccemailids['rashmi'] ='rashmi.hk@relyonsoft.com';
	$bccarray = $bccemailids;
	$msg = replacemailvariable($msg,$array);
	$textmsg = replacemailvariable($textmsg,$array);
	$subject = 'Testing';
	$html = $msg;
	$text = $textmsg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,null,$bccarray,$filearray); 
	
	echo('Successfully Sent');
?>

