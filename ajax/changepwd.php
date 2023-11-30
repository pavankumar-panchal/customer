<?

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
	case 'change':
	{
		$responsearray = array();
		$oldpassword = $_REQUEST['oldpassword'];
		$newpassword = $_REQUEST['newpassword'];
		$confirmpassword = $_REQUEST['confirmpassword'];
	
		$query="SELECT AES_DECRYPT(loginpassword,'imaxpasswordkey') as password,passwordchanged FROM inv_mas_customer WHERE slno = '".$cusid."';";
		$fetch = runmysqlqueryfetch($query);
		$dbpassword = $fetch['password'];
		if($dbpassword == $oldpassword)
		{
			if($oldpassword == $newpassword )
			echo("1^Existing password and New password should not be same");
			else
			{
				if($newpassword == $confirmpassword)
				{
					$query = "UPDATE inv_mas_customer set  loginpassword = AES_ENCRYPT('".$newpassword."','imaxpasswordkey'),passwordchanged ='Y'  WHERE slno ='".$cusid."';";
					$result = runmysqlquery($query);
					$responsearray['errormsg'] = "Your Password has been changed successfully";
					echo(json_encode($responsearray));
					//echo("Your Password has been changed successfully");
				}
				else
				{
					$responsearray['errormsg'] = "1";
					$responsearray['errormsg'] = "New Password does not match with the Confirm Password";
					echo(json_encode($responsearray));
					//echo("1^New Password does not match with the Confirm Password");
				}
			}
		}
		else
		{
			$responsearray['errormsg'] = "1";
			$responsearray['errormsg'] = "Invalid Password";
			echo(json_encode($responsearray));
			//echo("1^Invalid Password");
		}
   }
   break;
  
   
}
?>