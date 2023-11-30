<?

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
if(imaxgetcookie('custuserid')<> '') 
//$userid = imaxgetcookie('custuserid');
$cusid = imaxgetcookie('custuserid');
else
{ 
	echo('Thinking to redirect');
	exit;
}


$switchtype = $_POST['switchtype'];
switch($switchtype)
{
	case 'save':
	{
		$customerreference = $cusid;
		$smsactivateddate = date('Y-m-d').' '.date('H:i:s');
		$activatesmsaccount = 'yes';
		$smsusername = $cusid;
		$smsfromname = $_POST['fromname'];
		$smspassword = generatesmspwd();
		$disablesmsaccount ='no';
		$contactperson = $_POST['contactperson'];
		$emailid = $_POST['emailid'];
		$cell = $_POST['cell'];
		$croptext = 'no';
		$offercode = $_POST['offercode'];
		$offercodedefined = 'OFR1110';
		$creditstobeadded = '10';
		
		$query1 = "select * from inv_smsactivation where smsusername = '".$cusid."' ";
		$result1 = runmysqlquery($query1);
		if(mysqli_fetch_row($result1) > 0)
		{
			echo("2^"."User Name Already exists. Please use a different Username");
		}
		else
		{
			if($offercode <> '')
			{
				if($offercode == $offercodedefined)
				{
					$query1= "select max(slno) + 1 as slno from inv_smsactivation;";
					$resultfetch = runmysqlqueryfetch($query1);
					$slnoinserted = $resultfetch['slno'];
					
					$query = "INSERT INTO inv_smsactivation(slno,userreference,usertype,contactperson,emailid,cell,activatesmsaccount,smsfromname,smsusername,smspassword,smsaccountdisabled,createdby,createddate,createdip,lastmodifiedby,lastmodifieddate,lastmodifiedip,croptext,accounttype) values('".$slnoinserted."','".$customerreference."','customer','".$contactperson."','".$emailid."','".$cell."','".$activatesmsaccount."','".$smsfromname."','".$smsusername."','".$smspassword."','".$disablesmsaccount."','2','".date('Y-m-d').' '.date('H:i:s')."','".$_SERVER['REMOTE_ADDR']."','2','".date('Y-m-d').' '.date('H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$croptext."','service');";
					$result = runmysqlquery($query);
					
					smsactivationmail($slnoinserted);
					$query = "select max(slno) + 1 as billref from inv_sms_bill;";
					$resultfetch = runmysqlqueryfetch($query);
					$billrefernce = $resultfetch['billref'];
					$invoiceno = 'RSL/SMS/'.$billrefernce;
					//Insert the invoice details to table
					$query = "INSERT INTO inv_sms_bill(slno,userreference,billdate,remarks,total,userid,taxamount,netamount,invoiceno,privatenote,createdip,lastmodifieddate,lastmodifiedby,lastmodifiedip,onlineinvoiceno) values('".$billrefernce."','".$cusid."','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','Auto Credit: OFR1110','0','2','0','0','".$invoiceno."','','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d').' '.date('H:i:s')."','2','".$_SERVER['REMOTE_ADDR']."','');";
					$result = runmysqlquery($query);
					
					//Insert credit details to table
					$query = "INSERT INTO inv_smscredits (billref,amount,enteredby,createddate,createdip,lastmodifieddate,lastmodifiedby,lastmodifiedip,remarks,quantity,smsuserid) values('".$billrefernce."','0','2','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d').' '.date('H:i:s')."','2','".$_SERVER['REMOTE_ADDR']."','Auto Credit: OFR1110','".$creditstobeadded."','".$slnoinserted."');";
					$result = runmysqlquery($query);
					echo("1^"."SMS Account activated Successfully");
				}
				else
				{
					echo("2^"."Please enter a valid Offer Code");
				}
			}
			else
			{
				$query1= "select max(slno) + 1 as slno from inv_smsactivation;";
				$resultfetch = runmysqlqueryfetch($query1);
				$slnoinserted = $resultfetch['slno'];
				$query = "INSERT INTO inv_smsactivation(slno,userreference,usertype,contactperson,emailid,cell,activatesmsaccount,smsfromname,smsusername,smspassword,smsaccountdisabled,createdby,createddate,createdip,lastmodifiedby,lastmodifieddate,lastmodifiedip,croptext,accounttype) values('".$slnoinserted."','".$customerreference."','customer','".$contactperson."','".$emailid."','".$cell."','".$activatesmsaccount."','".$smsfromname."','".$smsusername."','".$smspassword."','".$disablesmsaccount."','2','".date('Y-m-d').' '.date('H:i:s')."','".$_SERVER['REMOTE_ADDR']."','2','".date('Y-m-d').' '.date('H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$croptext."','service');";
				$result = runmysqlquery($query);
				smsactivationmail($slnoinserted);
				echo("1^"."SMS Account activated Successfully");
			}
			
		}
	}
	break;
}



?>