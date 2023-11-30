<?
ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtype = $_POST['switchtype'];
$cusid=imaxgetcookie('custuserid');
switch($switchtype)
{
	case 'getsmsaccountdetails':
	{
		$query = "select * from inv_smsactivation where userreference = '".$cusid."' and usertype = 'customer';";
		$result = runmysqlquery($query);
		if(mysqli_fetch_row($result) == 0)
		{
			$grid = '<table width="100%" cellpadding="3" cellspacing="0">';
			$grid = '<tr><td>&nbsp;</td></tr>';
			$grid .= '<tr bgcolor ="#FFE6E6";><td colspan = "2" width = "7%"><div  class="account-font"  align="center" ><img src="../images/imax-pendingrequest-icon.gif" border="0" align="absmiddle"  /><span style="padding-left:1px;" >You are not holding any SMS Account with Relyon. To get one, <a href= "../sms/createsmsaccount.php" class="resendtext" style="text-decoration:none"> Click here </a> </span></td></tr>';
			$grid .= "</table>";
			echo("2^".$grid);	
		}
		else
		{
			$query1 = "select count(*) as count from inv_smsactivation where userreference = '".$cusid."' and usertype = 'customer' order by smsusername;";
			$resultfetch = runmysqlqueryfetch($query1);
			$count = $resultfetch['count'];
			$grid .= '<table width="100%" cellpadding="3" cellspacing="0"><tr><td > <div align = "center" class="account-font" valign="bottom" ><strong>You Currently have '.$count.' Accounts</strong></div></td></table>';
			echo("1^".$grid);	
		}
		
	}
	break;
}

?>