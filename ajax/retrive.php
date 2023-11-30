<?
ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtytpe = $_POST['switchtype'];
switch($switchtytpe)
{
	case 'retrivepwd':
	{
		$responsearray = array();
		$password= $_POST['password'];
		$confirmpwd= $_POST['confirmpwd'];
		$key= $_POST['key'];
		if($password == "" || $confirmpwd == "")
		{
			$responsearray['errorcode'] = "2";
			$responsearray['errormsg'] = "New / confirm passwords cannot be empty.";
			echo(json_encode($responsearray));
			//echo('2^'.'New / confirm passwords cannot be empty.');
		}
		elseif($password <> $confirmpwd)
		{
			$responsearray['errorcode'] = "2";
			$responsearray['errormsg'] = "New and confirm passwords does not match.";
			echo(json_encode($responsearray));
			//echo('2^'.'New and confirm passwords does not match.');
		}
		else
		{
			$query = "select slno, customerid, pwdresetkey, pwdresettime from inv_mas_customer where pwdresetkey = '".$key."';";
			$result = runmysqlquery($query);
			if(mysqli_num_rows($result) == 0)
			{
				$responsearray['errorcode'] = "2";
				$responsearray['errormsg'] = "The Request Key is Invalid.";
				echo(json_encode($responsearray));
				//echo('2^'.'The Request Key is Invalid.');
				break;
			}
			else
			{
				$fetch = runmysqlqueryfetch($query);
				$customerid= $fetch['customerid'];
				$slno= $fetch['slno'];
				$currentime = date('Y-m-d').' '.date('H:i:s');
				$requesttime = $fetch['pwdresettime'];
				$interval = 48 * 60 * 60;
				$time2 = strtotime($currentime);
				$time3 = strtotime('+'.$interval.' second '.$requesttime);
				if($time2 <=$time3)
				{
					$query = "UPDATE inv_mas_customer SET loginpassword=AES_ENCRYPT('".$confirmpwd."','imaxpasswordkey'),pwdresetkey = '',pwdresettime = '',passwordchanged = 'Y' where slno = '".$slno."'";
					$result = runmysqlquery($query);
					$responsearray['errorcode'] = "1";
					$responsearray['errormsg'] = "Password Updated Sucessfully";
					echo(json_encode($responsearray));
					//echo('1^'.'Password Updated Sucessfully');
				}
				else
				{
					$responsearray['errorcode'] = "2";
					$responsearray['errormsg'] = "The Request Key has been expired. Please place a password request again.";
					echo(json_encode($responsearray));
					//echo('2^'.'The Request Key has been expired. Please place a password request again.');
				}
			}
		}
	}
	break;
}

?>