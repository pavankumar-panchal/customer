<?
include('../functions/phpfunctions.php'); 
$requestkey = $_GET['key'];
$errormessage = "";

//Check if request key is a valid one
$query = "select slno,customerid,pwdresetkey,pwdresettime  from inv_mas_customer where pwdresetkey = '".$requestkey."';";
$result = runmysqlquery($query);
if(mysqli_num_rows($result) == 0)
	$errormessage = "The Request Key is Invalid.";
else
{
	//Check for time expiration of Key
	$fetch = mysqli_fetch_array($result);
	$currentime = date('Y-m-d').' '.date('H:i:s');
	$requesttime = $fetch['pwdresettime'];
    $interval = 48 * 60 * 60; //Currently defined for 48 Hours
	$time2 = strtotime($currentime);
    $time3 = strtotime('+'.$interval.' second '.$requesttime);
    if($time2 >=$time3)
		$errormessage = "The Request Key has been expired. Please place a password request again.";
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Retrival |Relyon Customer Login Area</title>
<SCRIPT src="../functions/retrive.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
<? include('../include/scriptsandstyles.php'); ?>
<body>
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include('../include/header3.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="700px" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td id="logincontent-top1">&nbsp;</td>
              </tr>
              <tr>
                <td id="logincontent-mid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td class="heading-font">Password Retrival</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <? if($errormessage <> "") { ?>
                    <tr>
                      <td style="font-size:12px; font-family:Verdana; padding:4px; border:2px solid #FF0000; background-color:#FFFF99"><div align="center"><? echo($errormessage); ?></div></td>
                    </tr>
                    <? } ?>
                    <tr>
                      <td style="font-size:12px; font-family:Verdana; padding:4px; padding-left:5px"><p>&nbsp;</p></td>
                    </tr>
                    <? if($errormessage == "") { ?>
                    <tr>
                      <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
                          <tr>
                            <td align="center"><form id="submitpwdform" name="submitpwdform" method="post" action="" onsubmit="return false;" >
                                <table width="500" border="0" cellspacing="0" cellpadding="5">
                                  <tr>
                                    <td><table width="99%" border="0" cellspacing="0" cellpadding="5" style="border:solid 1px #A6D2FF">
                                        <tr>
                                          <td colspan="3" style="font-size:12px; color:#FF0000" align="left" ><strong>Enter Your New Password</strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" height="35px" >Please enter a new password for your login at Customer Login Area.<br />
                                            <strong>Your Username: <? echo(cusidcombine1($fetch['customerid'])); ?></strong></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3" height="38px" ><div id="form-error" align="center"></div></td>
                                        </tr>
                                        <td width="171" align="left" valign="top" style="font-size:12px"><strong>New Password:</strong></td>
                                          <td colspan="2" align="left" valign="top"><input name="password" type="password" class="swifttext" id="password" size="30" maxlength="20" />                                          </td>
                                        </tr>
                                        <tr>
                                          <td align="left" valign="top" style="font-size:12px"><strong>Confirm New Password:</strong></td>
                                          <td colspan="2" align="left" valign="top"><input name="confirmpwd" type="password" class="swifttext" id="confirmpwd" size="30" maxlength="20" />                                          </td>
                                        </tr>
                                        <tr>
                                          <td align="left" valign="top">&nbsp;</td>
                                          <td width="74" align="left" valign="top"><input name="resetpassword" type="button" class="swiftchoicebutton" id="resetpassword" value="Proceed..." onclick="validation(<? echo('\''.$_GET['key'].'\'') ?>)" /></td>
                                          <td width="213" align="left" valign="top"><input name="clearform" type="button" class="swiftchoicebutton" id="clearform" value="Clear" onclick="resetform();" /></td>
                                        </tr>
                                        <tr>
                                          <td colspan="3"  valign="top" style="font-size:11px; padding-top:0px;" align="center" >&nbsp;</td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                              </form></td>
                          </tr>
                        </table></td>
                    </tr>
                    <? } ?>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
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
    <td><? include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>
