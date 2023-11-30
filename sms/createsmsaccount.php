<?php
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
$cusid=imaxgetcookie('custuserid');
$query = "select * from inv_smsactivation where userreference = '".$cusid."';";
$result = runmysqlquery($query);
if(mysqli_num_rows($result) > 0)
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
<title>Create SMS Account | Relyon Customer Login Area</title>
<?php include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/createsmsaccount.js?dummy=<?php echo (rand());?>" type=text/javascript></SCRIPT>
</head>
<body><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php include('../include/header.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
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
                      <td height="26" class="subheadind-font">Create SMS Account</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td></tr>
                   
                    <tr >
                      <td><form id="submitform" name="submitform" method="post" action="" onsubmit="return false;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="contentmid-font" ><tr><td><table width="100%" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4">
    
          
      </table></td>
    </tr>
    <tr>
      <td valign="top" style="border-right:1px solid #d1dceb;border-left:1px solid #d1dceb;border-top:1px solid #d1dceb;"><table width="100%" height="71" border="0" cellpadding="4" cellspacing="0">
      <tr bgcolor="#f7faff">
            <td width="21%" align="left" valign="top" bgcolor="#f7faff">Company Name:</td>
            <td colspan="2" align="left" valign="top" bgcolor="#f7faff" ><strong><?php echo($businessname);?></strong></td>
            </tr>
          <tr bgcolor="#f7faff">
            <td width="21%" align="left" valign="top" bgcolor="#f7faff">Responsible Person:</td>
            <td width="28%" align="left" valign="top" bgcolor="#f7faff" id="displaycustomername"><input name="contactperson" type="text" class="swifttext-mandatory" id="contactperson" size="30" autocomplete="off" /></td>
            <td width="51%" align="left" valign="top" bgcolor="#f7faff" id="displaycustomername"><div align="justify">Please enter the name of concerned person, responsible to handle this account. Any SMS sent through this account will be referred for this person, under TRAI guidelines</div></td>
          </tr>
          <tr bgcolor="#EDF4FF">
            <td align="left" valign="top"><label>
              Email ID:
              <div align="right"></div>
              </label></td>
            <td align="left" valign="top" bgcolor="#EDF4FF" ><input name="emailid" type="text" class="swifttext-mandatory" id="emailid" size="30" autocomplete="off" /></td>
            <td align="left" valign="top" bgcolor="#EDF4FF" ><div align="justify">Please provide a valid email ID of responsible perosn. Once the account is created, the username and password will be emailed to this Email ID</div></td>
          </tr>
          <tr bgcolor="#EDF4FF">
            <td align="left" valign="top" bgcolor="#f7faff">Mobile No :</td>
            <td align="left" valign="top" bgcolor="#f7faff" ><input name="cell" type="text" class="swifttext-mandatory" id="cell" size="30" maxlength="10" autocomplete="off" /></td>
            <td align="left" valign="top" bgcolor="#f7faff" ><div align="justify">Please provide a valid 10 digit mobile number of responsible person. This number will be referred for future communications, if any.</div></td>
          </tr>
          <tr bgcolor="#EDF4FF">
            <td align="left" valign="top">&quot;SMS From&quot; name:</td>
            <td align="left" valign="top" bgcolor="#EDF4FF" ><input name="fromname" type="text" class="swifttext-mandatory" id="fromname" size="30" maxlength="8" autocomplete="off" /></td>
            <td align="left" valign="top" bgcolor="#EDF4FF" ><div align="justify">Please provide a FROM name (Alpha Sender Id) to be displayed in receiver's cellphone. The SMS sent through this account will be shown from this name. <font color="#FF0000">You cannot use any sender Id to send sms other than your own name, company or firm's name owned or managed by you</font>. In case, any sender Id found other than owned by you, will cause the termination of your account and all credits will be set to zero.</div></td>
          </tr>
          <tr bgcolor="#EDF4FF">
            <td align="left" valign="top" bgcolor="#f7faff">Offer Code:</td>
            <td align="left" valign="top" bgcolor="#f7faff" ><input name="offercode" type="text" class="swifttext-mandatory" id="offercode" size="30" maxlength="7" autocomplete="off" /></td>
            <td align="left" valign="top" bgcolor="#f7faff" ><div align="justify">Please provide a valid 7 digit Offer Code.</div></td>
          </tr>
          <tr><td colspan="3"  height="55"><div id="form-error"></div></td></tr>
          <tr>
            <td colspan="3" align="left" valign="top"><div align="center">
              <input name="save" type="button" class="swiftchoicebuttonbig" id="save" value="Create Account" onclick="smsformsubmit();" />&nbsp;
              <input name="clear" type="button" class="swiftchoicebutton" id="clear" value="Reset" onclick="clearall();" />
            </div></td>
            </tr>
           

          
      </table></td>
      </tr>
    <tr>
      <td align="right" valign="middle" style="padding-right:15px; border-top:1px solid #d1dceb;"><table width="98%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="56%" align="left" valign="middle" height="55"><div id="productselectionprocess"></div></td>
            <td width="44%" align="right" valign="middle">&nbsp;&nbsp;&nbsp;&nbsp;</td>
          </tr>
      </table></td>
    </tr>
  </table></td></tr><tr>
    <td>&nbsp;</td>
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