<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
//$cusid=imaxgetcookie('custuserid');;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Training | Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/saraltds-blr.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
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
                <td class="content-mid"><form action="" method="post" name="submitform" id="submitform" onsubmit="return false;"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td class="subheadind-font">Saral TDS Training at Bangalore</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                          <td><strong>Program Name</strong></td>
                          <td width="1"><strong>:</strong></td>
                          <td>Saral TDS Training at Bangalore</td>
                        </tr>
                        <tr>
                          <td><strong>Date</strong></td>
                          <td><strong>:</strong></td>
                          <td>9th June 2012 at Bangalore</td>
                        </tr>
                        <tr>
                          <td><strong>Duration &amp; Timings</strong></td>
                          <td><strong>:</strong></td>
                          <td>Half Day [09.00am to 01.00pm]</td>
                        </tr>
                        <tr>
                          <td><strong>Venu</strong></td>
                          <td><strong>:</strong></td>
                          <td>Will be Confirmed to the Regisred Participants</td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td><strong>Fee Details : Rs.1000 + 12.36 % Service Tax (Per Participant)</strong> Price Includes Course Materials, Tea/Coffee.</td>
                    </tr>
                    <tr>
                      <td>Subject yo availability of seats Registration will be given on first come first serve basis.</td>
                    </tr>
                    <tr>
                      <td>
                        <table width="100%" border="0" cellspacing="2" cellpadding="2">
                          <tr>
                            <td><strong>Participant name                              </strong></td>
                            <td><strong>Email id</strong></td>
                            <td><strong>Contact Number</strong></td>
                          </tr>
                          <tr>
                            <td>
                              <input name="txt_part_1" type="text" id="txt_part_1" /></td>
                            <td>
                              <input name="txt_email_1" type="text" id="txt_email_1" /></td>
                            <td>
                              <input name="txt_con_1" type="text" id="txt_con_1" /></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" name="txt_part_2" id="txt_part_2" /></td>
                            <td>
                              <input type="text" name="txt_email_2" id="txt_email_2" /></td>
                            <td>
                              <input type="text" name="txt_con_2" id="txt_con_2" /></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" name="txt_part_3" id="txt_part_3" /></td>
                            <td>
                              <input type="text" name="txt_email_3" id="txt_email_3" /></td>
                            <td>
                              <input type="text" name="txt_con_3" id="txt_con_3" /></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" name="txt_part_4" id="txt_part_4" /></td>
                            <td>
                              <input type="text" name="txt_email_4" id="txt_email_4" /></td>
                            <td>
                              <input type="text" name="txt_con_4" id="txt_con_4" /></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" name="txt_part_5" id="txt_part_5" /></td>
                            <td>
                              <input type="text" name="txt_email_5" id="txt_email_5" />
                            </td>
                            <td>
                              <input type="text" name="txt_con_5" id="txt_con_5" /></td>
                          </tr>
                          <tr>
                            <td>
                              <input type="text" name="txt_part_6" id="txt_part_6" /></td>
                            <td>
                              <input type="text" name="txt_email_6" id="txt_email_6" /></td>
                            <td>
                              <input type="text" name="txt_con_6" id="txt_con_6" /></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                          </tr>
                        </table>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Payment Details :</strong></td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                          <td>Cheque No.</td>
                          <td width="1">:</td>
                          <td><label for="txtCheque"></label>
                            <input type="text" name="txtCheque" id="txtCheque" /></td>
                        </tr>
                        <tr>
                          <td>Dated</td>
                          <td>:</td>
                          <td>
                            <input type="text" name="txtChequeDate" id="txtChequeDate" /></td>
                        </tr>
                        <tr>
                          <td>Bank Name</td>
                          <td>:</td>
                          <td>
                            <input type="text" name="txtBankName" id="txtBankName" /></td>
                        </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td>Contact us for payment through Credit/Debit/Net Banking</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td><div id="form-error" align="left">
                        
                        &nbsp;</div></td>
                            <td width="200"><input name="send" type="button" class="swiftchoicebutton" id="send" value="Send" onclick="formsubmiting(<? echo($cusid); ?>);" />
      &nbsp;
                        <input name="clear" type="reset" class="swiftchoicebutton" id="resetvalue" value="Reset" onClick="document.getElementById('form-error').innerHTML = '';enablesend();"  /></td>
                          </tr>
                        </table></td>
                    </tr>
                </table></form></td>
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
