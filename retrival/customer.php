<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Customer ID Retrival | Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/custpasswd.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
</head>

<body><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
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
                      <td class="heading-font">Customer ID Retrival</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px" ></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                    <td style="font-size:12px; font-family:Verdana; padding:4px; padding-left:5px"><p>This option will help you to Retrive your Customer ID.The Customer ID (s) associated with the given email Acocunt will be emailed to the same email accounts</p></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td align="center"><form id="submitform" name="submitform" method="post" action="" onsubmit="return false" >
            <table width="500" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><div style="display:block" id="tabc1"><table border="0" align="center" cellpadding="5" cellspacing="2" style="border:solid 1px #A6D2FF">
                  <tr >
                    <td colspan="3" style="font-size:12px; color:#FF0000" align="left"><strong><span style="font-size:16px">Step 1</span>:</strong>  <p>Please Enter Your Email ID to Proceed with.</p></td>
                  </tr>
  <tr>
                    <td width="66" align="left" valign="top" style="font-size:12px"><strong> &nbsp;&nbsp;Email ID</strong>:</td>
                    <td width="279" align="left" valign="top">
                        <input name="email" type="text" class="swifttext" id="email" size="40" maxlength="70" />                </td>
                    <td width="105" align="left" valign="top"><input name="next" type="button" class="swiftchoicebutton" id="next" value="Next"  onclick= "validation() ;" >
                    </td>
                  <tr><td colspan="3" style="height:35px;width:100%" id="form-error" align="left"></td></tr>
</table></div></td>
    <td><div style="display:none" id="tabc2"><table width="100%" border="0" cellspacing="2" cellpadding="5" style="border:solid 1px #A6D2FF">
                  <tr >
                    <td style="font-size:12px; color:#FF0000" align="left" ><strong><span style="font-size:16px">Step 2</span>:</strong> </td>
                  </tr>
  <tr>
                    <td style="height:35px;width:100%" id="form-error1" align="left">&nbsp; </td></tr>
                    <tr>
                      <td align="right" ><a href="../index.php"class="Linkspasswd" >Go to Login Page &gt;&gt;</a></td></tr>
                    </table>
                  </div></td>
  </tr>
  <tr><td height="50" id="customerprocess" style="padding:7px"></td></tr>
</table>
            </form></td>
          </tr>
        </table></td>
                    </tr>
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

