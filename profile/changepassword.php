<?
include('../functions/phpfunctions.php'); 
//include('../include/checksession.php');
$cusid=imaxgetcookie('custuserid');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Change Password | Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/changepwd.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
</head>

<body><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
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
                      <td height="26" class="subheadind-font">Change Password</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td></tr>
                   
                    <tr >
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:#95CAFF solid 1px">
  <tr>
    <td><form action="" method="post" name="submitformpwd" id="submitformpwd" onsubmit="return false">
                                  <table width="400" border="0" align="center" cellpadding="2" cellspacing="0">
                                    <tr>
                                      <td>
                                        <table width="100%" border="0" cellpadding="3" cellspacing="0">
                                         <tr><td colspan="2">&nbsp;</td></tr>
                                       <tr height="40"><td colspan="2"  ><div id="form-error" align="center"></div></td></tr>
                                        <tr><td colspan="2" >&nbsp;</td></tr>
                                          <tr >
                                            <td width="42%" align="left" bgcolor="#EDF4FF" >Existing Password:</td>
                                            <td width="58%" bgcolor="#f7faff"><input name="oldpassword" size="25" class="swifttext" value="" type="password" id="oldpassword" maxlength="20" /></td>
                                          </tr>
                                          <tr>
                                            <td width="42%" align="left" bgcolor="#EDF4FF">New Password:</td>
                                            <td  width="58%" bgcolor="#f7faff"><input name="newpassword"  id="newpassword" size="25" class="swifttext" value="" type="password" maxlength="20" /></td>
                                          </tr>
                                          <tr>
                                            <td width="42%" align="left"  bgcolor="#EDF4FF">Confirm New Password:</td>
                                            <td width="58%" bgcolor="#f7faff"><input name="confirmpassword" size="25" class="swifttext" value="" type="password"  id="confirmpassword" maxlength="20" /></td>
                                          </tr>
                                        </table>
                                        <table width="100%" border="0" cellpadding="2" cellspacing="0">
                                          <tbody>
                                            <tr>
                                              <td>&nbsp;
                                                  <div align="center">
                                                    <input name="update"  value="Update" type="submit" class="swiftchoicebutton" id="update"  onclick="validating(<? echo($cusid); ?>);" />
                                                    &nbsp;
                                                    <input name="clear"  value="Clear" type="button" class="swiftchoicebutton" id="clear" onClick="document.getElementById('form-error').innerHTML = '';"/>
                                                  </div></td>
                                            </tr>
                                          </tbody>
                                        </table>
                                      </td>
                                    </tr>
                                  </table>
                                </form></td>
  </tr><tr><td>&nbsp;</td></tr> <tr>
                      <td>&nbsp;</td>
                    </tr>
</table>
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
    <td><? include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>

