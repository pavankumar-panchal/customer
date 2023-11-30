<?php
	if(isset($_GET["customerid"]))
	{
		$customerid=$_GET["customerid"];
	}
	else
	{
		$customerid="";
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Password Retrival |Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/password.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
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
                      <td class="heading-font">Password Retrival</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px" ></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                      <td style="font-size:12px; font-family:Verdana; padding:4px; padding-left:5px"><p>This option will help you to Retrive your Password. The Password will be emailed to the email account associated with your Customer ID.</p></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" align="center" cellpadding="4" cellspacing="0">
          <tr>
            <td align="center"><form id="submitform" name="submitform" method="post" action="" onsubmit="return false;">
              <table width="600" border="0" cellspacing="0" cellpadding="5">
                <tr>
                  <td><div style="display:block" id="tabc1">
                    <table width="99%" border="0" cellspacing="2" cellpadding="5" style="border:solid 1px #A6D2FF">
                        <tr >
                          <td colspan="3" style="font-size:12px; color:#FF0000" align="left" ><strong><span style="font-size:16px">Step 1</span>:</strong> <p>Please Enter Your Customer ID to Proceed with.</p></td>
                        </tr>
                        <tr>
                          <td width="133" align="left" valign="top" style="font-size:12px"><strong> &nbsp;&nbsp;Customer ID</strong>:</td><input type="hidden" name="lastslno" id="lastslno"    />   
                          <td width="265" align="left" valign="top"><input name="customerid" type="text" class="swifttext" id="customerid" size="30" maxlength="20" onblur="onblurvalue();" value="<?php echo $customerid; ?>"/>  
                                           </td>
                          <td width="125" align="left" valign="top"><input name="next" type="button" class="swiftchoicebutton" id="next" value="Next"  onclick= "validation() ;" />                          </td> 
                        </tr>
                        <tr> <td colspan="3"  valign="top" style="font-size:11px; padding-top:0px;" align="center" ><font color="#666666">[Eg: 1234-4356-7891-12345 OR 12344356789112345]</font></td>
                        </tr>
                      <tr>
                        <td colspan="3" style="height:35px;width:100%" id="form-error" align="left"></td>
                      </tr>
                      </table>
                  </div></td>
                  <td><div style="display:none" id="tabc2">
                    <table width="99%" border="0" cellspacing="2" cellpadding="5" style="border:solid 1px #A6D2FF">
                        <tr >
                          <td colspan="3" style="font-size:12px; color:#FF0000" align="left"><strong><span style="font-size:16px">Step 2</span>:</strong> <p>Below are the email ID (s) associated with your Customer ID (<span id="displayselectedcustid"></span>). Please select your email account for sending password information.</p></td>
                        </tr>
                        <tr>
                          <td width="120" align="left" valign="top" style="font-size:12px"><strong>Select your Email ID</strong>:</td>
                          <td width="217" align="left" valign="top"><!--<select name="email" id="email" class="swiftselect-mandatory" style="width: 200px;" ></select>--><div  id="emailresult" ></div></td>
                              
                          <td width="137" align="left" valign="top"><input name="send" type="button" class="swiftchoicebutton" id="send" value="Send"  onclick= "formsubmiting();" />                       </td>
                        </tr>
                      <tr>
                        <td colspan="3" style="height:35px;width:100%" id="form-error1" align="left"></td>
                      </tr>
                      <tr><td colspan="3" align="left" ><a href="password.php" class="edit" >&lt;&lt; Back to Step 1</a></td></tr>
                      </table>
                  </div></td> 
                            
  <td><div style="display:none" id="tabc3">
    <table width="99%" border="0" cellspacing="2" cellpadding="5" style="border:solid 1px #A6D2FF">
      <tr >
        <td style="font-size:12px; color:#FF0000" align="left" ><strong><span style="font-size:16px">Step 3</span>:</strong> 
           </td>
      </tr>
      <tr>
        <td  align="left" id="form-error2" style="height:35px;width:100%; "></td>
      </tr>
      <tr>
        <td align="right"><a href="../index.php" class="Linkspasswd" >Go to Login Page &gt;&gt;</a></td>
      </tr>
    </table>
  </div></td>
  </tr><tr><td colspan="3" height="40" id="customerprocess" style="padding:7px; padding-left:15px" >&nbsp;</td></tr>
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
