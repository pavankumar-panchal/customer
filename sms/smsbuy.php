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
<title>SMS Services | Relyon Customer Login Area</title>
<script type="text/javascript" language="javascript" src="../functions/smsbuy.js"></script>
<?php include('../include/scriptsandstyles.php'); ?>
</head>

<body onload="getsmstariff();"><table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
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
                      <td height="26" class="subheadind-font">Buy SMS Credits</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td></tr>
                   
                    <tr >
                      <td><form id="submitform" name="submitform" method="post" action="" onsubmit="return false;"><table width="100%" border="0" cellspacing="0" cellpadding="0" class="contentmid-font" >
                      <tr><td width="51%" valign="top"><table width="98%" border="0" cellspacing="0" cellpadding="3">
                        <tr>
                          <td><strong>Option 1: Credit card</strong><br />
                            Pay through your credit card of any bank with Master /Visa card<br />
                              <div align="right">
                              <input name="creditproceed"  type="button" class="swiftchoicebutton" id="creditproceed" value="Proceed" onclick="gotosmsbuypage();"  >                           </div>                            </td>
                        </tr>
<tr><td height="10px"></td></tr>                        <tr>
                          <td><strong>Option 2: Debit card</strong><br />
Pay through your Debit card(with 16 digit no) of any bank with Master /Visa.card<br/><div align="right">
                               <input name="debitproceed" type="button" class="swiftchoicebutton" id="debitproceed" value="Proceed" onclick="gotosmsbuypage();" />
                              </div></td>
                        </tr>
                                                <tr><td height="10px"></td></tr>

                        <tr>
                          <td><strong>Option 3: Remitt to Relyon Bank Account</strong><br />
                             <ol>
                            <li><strong>  Bank of India</strong></li>
                              Payee name: Relyon Softech Ltd<br />
                              Bank A/c No:   840730110000046<br />
                              Branch: J C Road, Bangalore<br />
                              NEFT/IFSC Code: BKID0008407<br />
                              <li><strong> ICICI Bank</strong><br />
                                Payee name: Relyon Softech Ltd<br />
                                  Bank A/c No:   029605004918<br />
                                    Branch: Rajajinagar, Bangalore<br />
                                      NEFT/IFSC Code: ICIC0000296<br />
                                  </li>
                          </ol></td>
                        </tr>
                        <tr>
                          <td><div align="justify">Once remitted, please send the remittance details by email. We will credit the respective SMS credits, on realization of such amount. (Please include the remittance date, amount and branch name in your email.)</div></td>
                        </tr>
                      </table></td>
                        <td width="49%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                          <tr>
                            <td><div align="center"><strong>SMS Tarrif</strong></div></td>
                          </tr>
                          <tr>
                            <td id="displaytariff">&nbsp;</td>
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
    <td colspan="2">&nbsp;</td>
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
    <td><?php include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>
<?php }?>
