<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
//$cusid=imaxgetcookie('custuserid');
	
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Write to Relyon | Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/writetorelyon.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
</head>

<body>
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
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
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td class="subheadind-font">Write to Relyon</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><form action="" method="post" name="submitform" id="submitform" onsubmit="return false;"><table width="600px" border="0" cellspacing="0" cellpadding="5" align="center" style="border:#d1dceb solid 1px">
  <tr bgcolor="#F7FAFF">
    <td width="94" class="Linkrelyon">From : </td>
    <td width="488"><select name="femail"  id="femail" class="swiftselect-mandatory">
                               
                    <option value="">--Select--</option>
                      <? include('../include/email.php'); ?>
                  </select>                           </td>
  </tr>
  <tr bgcolor="#EDF4FF">
    <td class="Linkrelyon">Subject :</td>
    <td><input name="subject" type="text"  id="subject" size="70" autocomplete="off" class="swiftselect-mandatory" /></td>
  </tr>
  <tr bgcolor="#F7FAFF">
    <td class="Linkrelyon">Category :</td>
    <td bgcolor="#F7FAFF"><select name="category"  id="category" class="swiftselect-mandatory">
        <option value="" selected="selected">--Select--</option>
        <option value="General">General</option>
        <option value="Re-registration">Re-registration</option>
        <option value="Support">Support</option>
        <option value="Sales">Sales</option>
        <option value="Billing">Billing</option>
        <option value="SOS">SOS</option>
    </select></td>
  </tr>
  <tr bgcolor="#F7FAFF">
    <td bgcolor="#EDF4FF" class="Linkrelyon">Product :</td>
<td width="488" bgcolor="#EDF4FF"><select name="product"  id="product" class="swiftselect-mandatory" style=" width:120px">
                                <option value="" selected="selected">--Select--</option>
                                <option value="TDS">TDS</option>
                                <option value="Payroll">Payroll</option>
                                <option value="IncomeTax">IncomeTax</option>
                                <option value="Accounting">Accounting</option>
                                 <option value="XBRL">XBRL</option>
                            </select></td>  </tr>
  <tr  bgcolor="#EDF4FF">
    <td colspan="2" bgcolor="#F7FAFF" class="Linkrelyon">Message :</td>
    </tr>
  <tr>
    <td colspan="2"  valign="top"><textarea name="message" rows="8" cols="75"  id="message" ></textarea></td>
    </tr>
    <tr>
    <td colspan="2"  valign="top">&nbsp;</td>
    </tr>
  <tr>
            <td colspan="2" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
 <td width="65%" height="35" align="left" valign="middle" ><div id="form-error" align="left">&nbsp;</div></td>
     <td align="right"><input name="send" type="button" class="swiftchoicebutton" id="send" value="Send" onclick="formsubmiting(<? echo($cusid); ?>);" />
      &nbsp;
                          <input name="clear" type="reset" class="swiftchoicebutton" id="resetvalue" value="Reset" onClick="document.getElementById('form-error').innerHTML = '';enablesend();"  />&nbsp;&nbsp;  </td>
  </tr>
</table>                                            </td>
    </tr>
  <tr>
    <td colspan="2" ></td></tr>
    <tr>
    <td  colspan="2"></td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
  </tr>
</table>
                      </form>
</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
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
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><? include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>
