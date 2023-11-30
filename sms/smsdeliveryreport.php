<?
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
<title>SMS Delivery Reports | Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/smsdeliveryreport.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
</head>

<body onload="getuseraccountlist();"><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include('../include/header.php') ?></td>
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
                      <td height="26" class="subheadind-font" >SMS Delivery Report</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td></tr>
                   
                    <tr >
                      <td><form id="submitform" name="submitform" method="post" action="" onsubmit="return false;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="contentmid-font" >
                      <tr><td>&nbsp;</td></tr>
  <tr>
    <td>This provision will Display the list of SMS sent from your account, along with their delivery status. (Please note, Mobile Numbers and SMS text are not responded in full for privacy reasons, by the network.)</td>
  </tr><tr><td>&nbsp;</td></tr><tr><td><strong>List of Status:</strong></td>
  </tr> <tr>
                      <td><ul>
                        <li>UNKNOWN: SMS is awaiting the reply from network. This will be updated on delivery/rejection/expiry or within 24 hours.</li>
                        <li>DELIVERED: SMS has been delivered to recepient on mentioned time</li>
                        <li>EXPIRED: SMS has been expired by the network after retries till mentioned time.</li>
                        <li>NO-RESPONSE: Appears in rare scenario, where network doesn't respond back even after 24 hours.</li>
                      </ul></td>
                    </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="99%" border="0" align="center" cellpadding="3" cellspacing="0" style="border: 1px solid #308ebc">
      <tr>
        <td colspan="5">&nbsp;</td>
      </tr>
      <tr>
        <td width="17%">SMS Account:</td>
        <td width="31%"><div id="smsaccountlist"><select name="smsaccount" class="swiftselect-mandatory" id="smsaccount" style="width:200px;">
                                    <option value="">Select an Account</option></select></div></td>
        <td width="18%">SMS Password:</td>
        <td width="23%"><input name="smspassword" type="password" class="swift_mandatory" id="smspassword" size="25" autocomplete="off" /></td>
        <td><div align="center">
          <input name="viewreport" type="button" class="swiftchoicebutton" id="viewreport" value="View" onclick="viewdeliveryreport();" />
        </div></td>
      </tr>
      <tr><td colspan="4" id="form-error" height="35px;">&nbsp;</td><td width="11%">&nbsp;</td>
      </tr>
      <tr></tr>
    </table></td>
  </tr>
  <tr><td>&nbsp;</td></tr>
  <tr>
    <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; border-top:none;">
            <tr>
              <td width="37%" align="left" class="header-line" style="padding:0"><div id="tabdescription"><strong>Delivery Report Details:</strong></div></td>
              <td width="51%" align="left" class="header-line" style="padding:0"><span id="tabgroupgridwb1"></span></td>
              <td width="4%" align="left" class="header-line" style="padding:0">&nbsp;</td>
              <td width="8%" align="left" class="header-line" style="padding:0">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="4" align="center" valign="top"><div id="tabgroupgridc1" style="overflow:auto; height:200px; width:650px; padding:2px;" align="center">
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td><div id="tabgroupgridc1_1" align="center" ></div></td>
                    </tr>
                    <tr>
                      <td><div id="tabgroupgridc1link"  align="left" style="height:20px; padding:2px;"> </div></td>
                    </tr>
                  </table>
              </div>
                  <div id="resultgrid" style="overflow:auto; display:none; height:150px; width:650px; padding:2px;" align="center">&nbsp;</div></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  <tr>
    <td >&nbsp;</td>
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
    <td><? include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>

<?  }?>