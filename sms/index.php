<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
$cusid=imaxgetcookie('custuserid');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMS Services | Relyon Customer Login Area</title>
<script type="text/javascript" language="javascript" src="../functions/smsaccountdetails.js"></script>
<? include('../include/scriptsandstyles.php'); ?>
</head>

<body onload="getsmsaccountdetails();"><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include('../include/header.php') ?></td>
  </tr>
    <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200" valign="top"><? include('../include/left-link.php'); ?></td>
          <td width="700" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="content-top">&nbsp;</td>
              </tr>
              <tr>
                <td class="content-mid"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td height="26" class="subheadind-font">Your SMS Account</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td></tr>
                   
                    <tr >
                      <td><form id="submitform" name="submitform" method="post" action="" onsubmit="return false;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="contentmid-font" >
                      <tr><td>&nbsp;</td></tr><tr><td>Relyon provides SMS services to its customer, with an unique acocunt to them. This account can be utilized in any of Relyon based SMS sending Software/features like, Saral Communicator, Saral TDS, etc.</td></tr><tr><td>&nbsp;</td></tr><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0" height="100px;">
  <tr>
    <td><div id="displayaccountdetails"></div></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
</table>
</td></tr> <tr>
                      <td><div id="displaylinks" style="display:none"><table width="350" border="0" align="center" cellpadding="2" cellspacing="0" style=" border:1px solid #AAD5FF">
 <tr>
    <td width="33%"><div align="center"><a href="retrivesmspassword.php"  class="Linking"><img src="../images/imax-customer-reset-password.jpg" width="35" height="44" border="0" alt="Reset Password"  title="Reset Password"/><br/>
      Reset Password</a></div></td>
    <td width="1%">&nbsp;</td>
    <td width="33%"><div align="center"><a href="../sms/smsbuy.php"  class="Linking" ><img src="../images/imax-customer-buy-sms.jpg" width="45" height="42" border="0"  alt="Buy SMS" title="Buy SMS"/><br/>
      Buy SMS</a></div></td>
    <td width="1%">&nbsp;</td>
    <td width="32%"><div align="center"><a href="smsdeliveryreport.php"  class="Linking"><img src="../images/imax-customer-mail-delivery.jpg" width="40" height="45" border="0"  align="Delivery Reports" title="Delivery Reports"/><br/>
      Delivery Reports</a></div></td>
  </tr>
</table></div></td>
  
                    </tr>
                    <tr>
    <td height="30px;" id="form-error">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  
</table>
                      </form></td>
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
    <td><? include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>

