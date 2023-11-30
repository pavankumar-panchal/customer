<?php
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
$cusid=imaxgetcookie('custuserid');
$query = "select * from inv_smsactivation where userreference = '".$cusid."';";
$result = runmysqlquery($query);
if(mysqli_fetch_row($result) == 0)
{
	echo("You are not authorized to view this page");
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Retrive SMS Password | Relyon Customer Login Area</title>
<?php include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/retrivesmspassword.js?dummy=<?php echo (rand());?>" type=text/javascript></SCRIPT>
<style type="text/css">
<!--
.style1 {color: #FF0000}
.style2 {
	color: #666666
}
-->
</style>
</head>

<body onload="getuseraccountlist();"><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php include('../include/header.php') ?></td>
  </tr>
    <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200" valign="top"><?php include('../include/left-link.php'); ?></td>
          <td width="700" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="content-top">&nbsp;</td>
              </tr>
              <tr>
                <td class="content-mid"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td height="26" class="subheadind-font">Retrive SMS Password</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td></tr>
                   
                    <tr >
                      <td><form id="submitform" name="submitform" method="post" action="" onsubmit="return false;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="contentmid-font" >
                      <tr><td>&nbsp;</td></tr>
  <tr>
    <td>This option will &quot;Reset&quot; your password and email the new password to SMS account configured email ID. <span class="style1">If you are not the concerned person, please do not use this provision.</span></td>
  </tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td width="12%">&nbsp;</td>
      <td width="25%"><div align="left">Select your SMS account:</div></td>
      <td width="62%"><div id="smsaccountlist">
          <select name="smsaccount" class="swiftselect-mandatory" id="smsaccount" style="width:200px;">
            <option value="">Select an Account</option>
          </select>
      </div></td>
      <td width="1%">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td><div align="left">Enter the Email ID:</div></td>
      <td><input name="smsemailid" type="text" class="swift_mandatory" id="smsemailid" size="30" maxlength="300" autocomplete="off" /></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="3"><div align="center" class="style2">* This should be the email ID, which has been configured to your SMS account.</div></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td colspan="4"><div align="center">
        <input name="resetsmspassword"  value="Reset and Email me the New Password" type="submit" class="swiftchoicebuttonsuperbig" id="swiftchoicebuttonsuperbig"  onclick="retrivesmspassword();" />
      </div></td>
      </tr>
  </table></td></tr> <tr>
                      <td>&nbsp;</td>
                    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
    <tr>
      <td >&nbsp;</td>
    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td id="form-error" height="30px;">&nbsp;</td>
  </tr>
</table>
                      </form> 
</td>
                    </tr>
                   
                    
                </table></td>
              </tr>
              <tr>
                <td class="content-btm"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><?php include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>

<?php }?>