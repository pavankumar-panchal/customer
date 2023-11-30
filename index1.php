<?php 
include('functions/phpfunctions.php');

$sessionname = session_name("imaxcustomer");	
session_start();
if(isset($_SESSION['verificationid']) && isset($_COOKIE['userid']) && $sessionname == 'imaxcustomer')
{
	if($_SESSION['verificationid'] == '4563464364365')
	{
		if(imaxgetcookie('custuserid') <> false)
		{
			$url = 'main/index.php';
			header("location:".$url);
		}
	}
	else
	{
		imaxcustomerlogout();
	}
}
else
{
	imaxcustomerlogout();
}


	$defaultcustomerid = "";
	$message ="";
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username == '' or $password == '')
		$message = "";
	else
	{
		$cusid = strlen($username);
		if($cusid == 17)
			$customerid = substr($username,12,5);
		else
			$customerid = $username;
		$query = "SELECT *,AES_DECRYPT(loginpassword,'imaxpasswordkey') as password FROM inv_mas_customer WHERE slno = '".$customerid."'";
		$result = runmysqlquery($query);
		if(mysqli_num_rows($result) == 0)
		{
			$message = "Invalid Customer ID.";
			$defaultcustomerid = $username;
		}
		else
		{
			$fetch = runmysqlqueryfetch($query);
			
			$user = $fetch['slno']; 
			$passwd = $fetch['password'];
			$disablelogin = $fetch['disablelogin'];
			$dbcustomerid = $fetch['customerid'];
			if($disablelogin == 'yes')
			{
				$message = 'Login is Disabled';
			}
			else
			{
				if($password <> $passwd)
				{
					$message = "Invalid Password";
					$defaultcustomerid = $username;
				}
				else
				{
					session_start(); 
					$_SESSION['verificationid'] = '4563464364365';
					imaxcreatecookie('dbcustomerid',$dbcustomerid);
					imaxcreatecookie('userid',$user);
					//setcookie('dbcustomerid',base64_encode($dbcustomerid));  
					//setcookie('userid',base64_encode($user));
					$query1 ="INSERT INTO inv_logs_login (userid,`date`,`time`,`type`,system) VALUES('".$user."','".date('Y-m-d')."','".date('h:i:s')."','customer_login','".$_SERVER['REMOTE_ADDR']."')";
     				$result = runmysqlquery($query1);
					$url = 'main/index.php'; 
					header("location:".$url);
				}
			}
		}

	}



 ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title> Customer Login</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<?php include('include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/main.js?dummy=<?php echo (rand());?>" type=text/javascript></SCRIPT> 
<script language="javascript">

function checkproperties()
{
	if((navigator.cookieEnabled == false) || (!navigator.javaEnabled()))
	{
		document.getElementById('username').focus(); 
		return false;
	}
	else
	{ 	
		formsubmit();
	}
}

</script>


</head>
<body onload="document.submitform.username.focus(); SetCookie('logincookiejs','logincookiejs'); if(!GetCookie('logincookiejs')) document.getElementById('form-error').innerHTML = '<span class=\'error-message\'>Enable cookies for this site </span>';">
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php include('./include/header2.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="700px" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td id="logincontent-top">&nbsp;</td>
              </tr>
              <tr>
                <td id="logincontent-mid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td colspan="2" class="heading-font">Relyon Customer Login Area</td>
                    </tr>
                    <tr>
                      <td height="4px" colspan="2" class="blueline" ></td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                    <tr>
                      <td colspan="2"><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td align="center"><form id="submitform" name="submitform" method="post" action="" onsubmit="return false">
                <table width="350" border="0" cellspacing="0" cellpadding="5">
                <tr><td height:"18px"></td></tr>
                  <tr>
                    <td colspan="2" ><div align="center"  style="height:18px;width:73%">
                   <div id="form-error" align="center" class="error-messagedisplay"><noscript><div  class="error-messagedisplay" > Enable cookies/javscript/both in your browser,  then </div></noscript><?php if($message <> '') { ?> <div class="errorbox"> <?php echo($message); } ?></div></div></td>
                  </tr>
                  <tr><td height="18"></td></tr>
                  <tr>
                    <td align="left" valign="top">Customer ID:</td>
                    <td align="left" valign="top"><label>
                      <input name="username" type="text" class="swifttext" id="username" onblur="onblurvalue();" value="<?php echo($defaultcustomerid); ?>" size="30" maxlength="20" />
                    </label></td>
                  </tr>
                  <tr>
                    <td colspan="2" align="left" valign="top"><font color="#CCCCCC">[Eg: <font color="#FF9933">1234-4356-7891-13457</font> OR <font color="#FF9933">12344356789113457</font> OR <font color="#FF9933">13457</font>]</font></td>
                    </tr>
                  <tr>
                    <td align="left" valign="top">Password:</td>
                    <td align="left" valign="top"><input name="password" type="password" class="swifttext" id="password" size="30" maxlength="20" /></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top"><div align="center">
  <input name="login" type="submit" class="custchoicebutton-orange" id="login" value="Login" onclick="checkproperties();" />
  &nbsp;&nbsp;&nbsp;
                      <input name="clear" class="custchoicebutton-orange" type="reset"  id="clear" value="Clear" onClick="document.getElementById('form-error').innerHTML = '';validate(<?php echo($cusid); ?>)" />
                    </div></td>
                  </tr>
                  <tr><td colspan="2" align="left" style=" padding-left:120px; font-size:12px">&nbsp;</td>
                        </tr>
                </table>
            </form></td>
          </tr>
        </table></td>
                    </tr>
                    <tr>
                      <td width="55%">&nbsp;</td>
                      <td width="45%" style="padding-right:4px"><table width="250" border="0" align="right" cellpadding="2" cellspacing="0" style="border:#308ebc solid 1px">
  <tr>
    <td width="5%" align="left">&nbsp;</td>
    <td width="11%" align="left"> <img src="images/imax-customer-question-icon.png"  alt="imax-customer-question-icon.png" title="imax-customer-question-icon.png" /></td>
    <td width="84%" align="left"><strong>Problems Logging in?</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:25px ;">You may wish to:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:40px ;color:#5959FF">
       1.&nbsp;<a href="retrival/password.php" class="passwd-font">Retrive Your Password</a>    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2" style="padding-left:40px ;color:#5959FF"> 
      2.&nbsp;<a href="retrival/customer.php" class="passwd-font">Retrive Your Customer ID</a>  </tr>
</table>  </td>
                    </tr>
                    <tr>
                      <td colspan="2">&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td id="logincontent-btm"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><?php include('./include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>
