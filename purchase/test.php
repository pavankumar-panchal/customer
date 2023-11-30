<?
include("../functions/phpfunctions.php");

	//Select the main data through record-reference
	$query = "select * from inv_custpaymentreq where inv_custpaymentreq.slno in ('28','24','23')";
	$result = runmysqlquery($query);
		$grid = '<table width="700px" cellpadding="3" cellspacing="0" border="1" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px" >';
		$grid .= '<tr bgcolor ="#3EC0FF"><td nowrap = "nowrap"><strong>Sl No</strong></td><td nowrap = "nowrap"><strong>Product Reference</strong></td><td nowrap = "nowrap"><strong>Bill reference</strong></td><td nowrap = "nowrap" ><strong>Bill Amount</strong></td></tr>';
		$i=1;
		while($fetch2 = mysqli_fetch_array($result))
		{
			$grid .= "<tr>";
			$grid .= "<td nowrap = 'nowrap'>".$i."</td>";
			$grid .= "<td nowrap = 'nowrap'>".$fetch2['productdesc']."</td>";
			$grid .= "<td nowrap = 'nowrap'>".$fetch2['billref']."</td>";
			$grid .= "<td nowrap = 'nowrap'>".$fetch2['paymentamt']."</td>";
			$grid .= "</tr>";
			$i++;
		}
		$grid .= "</table>";
		$query = "select * from inv_mas_customer   where inv_mas_customer.slno ='13457'";
		$result2 = runmysqlqueryfetch($query);
		$slno = $result2['slno'];
		$customerid = $result2['customerid'];
		$company = $result2['businessname'];
		$contactperson = $result2['contactperson'];
		$address = $result2['address'];
		$place = $result2['place'];
		$phone = $result2['phone'];
		$pincode = $result2['pincode'];
		//$emailid = $fetch2['emailid'];
		
		$ResponseCode = 9;
	
	


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Payment to Relyon Accounts</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon Customer login pages.">
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function returnhomepage()
{
	window.location = 'payments.php';
	return false;
}

</script>
><? include('../include/scriptsandstyles.php'); ?>
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
          <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td id="logincontent-top">&nbsp;</td>
              </tr>
              <tr>
                <td id="logincontent-mid"><table width="750px" border="0" align="center" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <? if($ResponseCode == 0) { ?>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 2px #272727">
                     
                      <tr>
                        <td ><table width="100%" border="0" cellspacing="0" cellpadding="5"  >
                            <tr>
                              <td colspan="2" class="subheading-font">Payment Status</td>
                            </tr>
                            <tr>
                              <td height="10px" colspan="2"></td>
                            </tr>
                            <tr>
                              <td height="3px" colspan="2" class="payemt-blueline" ></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="paymentbg">
                                  <tr>
                                    <td width="61%" class="subfonts" style="padding-left:15px" >Transaction Successful</td>
                                    <td width="39%" class="subfonts" height="37"></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
                                  <tr>
                                    <td width="45%" valign="top" class="fontdisplay"><strong>Payment from :</strong><br />
                                      <? echo($company)?><br />
                                      <? echo($contactperson)?><br />
                                      <? echo($address)?><br />
                                      <? echo($place)?> : <? echo($pincode)?> </td>
                                    <td width="45%"  valign="top" class="fontdisplay"><strong>Payment To :</strong><br />
                                      Relyon Softech Ltd<br />
                                      No. 73, Shreelekha Complex, <br />
                                      WOC Road,Bangalore :560 086<br />
                                      Phone: 1860-425-5570 <br />
                                      Email: support@relyonsoft.com</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontstyle" ><p align="left">You have been successfully paid for Rs. <? echo($amount)?>. An email also have been sent to <font color="#FF0000"><? echo($emailid)?></font> with the confirmation.<br />
                                <p align="left">The Product Purchased Details of the proceed Transaction is as below:</p></td>
                            </tr>
                            <tr>
                              <td colspan="2" height="10px"></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="600px" border="0" cellspacing="0" cellpadding="5" bgcolor="#eeeeee" align="center">
                                  <tr>
                                    <td><table width="400px" border="0" cellspacing="0" cellpadding="3" align="center" style="border:solid 1px #D4D4D4">
                                        <tr>
                                          <td class="displayfont"><p align="center"><strong>Transaction Status:</strong> <? echo($Message); ?><br />
                                              <strong>Relyon Transaction ID:</strong> <? echo($TxnID); ?><br />
                                              <strong>ICICI Transaction reference Number:</strong> <? echo($ePGTxnID); ?><br />
                                              <strong>Authorization ID: </strong> <? echo($AuthIdCode) ?> <br />
                                            </p></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                  <tr>
                                    <td><? echo($grid)?></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                              <td colspan="2" style="border-top:solid 2px #8e8e8e" height="10px"></td>
                            </tr>
                            <tr>
                              <td width="65%">&nbsp;</td>
                              <td width="35%"><div align="center">
                                  <input type="button" id="print" name="print" value="Print" onClick="window.print()"/>
                                  &nbsp;&nbsp;&nbsp;
                                  <input type="button" id="update" name="update" value="Go to Home Page" onClick="returnhomepage()"  />
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <? }else{?>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 2px #272727">
                <tr>
                  <td ><table width="100%" border="0" cellspacing="0" cellpadding="5"  >
                      <tr>
                        <td colspan="2" class="subheading-font">Payment Status</td>
                      </tr>
                      <tr>
                        <td height="10px" colspan="2"></td>
                      </tr>
                      <tr>
                        <td height="3px" colspan="2" class="blueline" ></td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0" id="paymentbg">
                            <tr>
                              <td width="61%" class="subfonts" style="padding-left:15px" >Transaction Failure</td>
                              <td width="39%" class="subfonts" height="37"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td colspan="2" class="fontstyle" ><p align="left">The transaction was NOT successful due to rejection by Gateway / Card issuing Authority. Please try again. </td>
                      </tr>
                      <tr>
                        <td colspan="2"><table width="600px" border="0" cellspacing="0" cellpadding="5" bgcolor="#eeeeee" align="center">
                            <tr>
                              <td height="10px"></td>
                            </tr>
                            <tr>
                              <td><table width="400px" border="0" cellspacing="0" cellpadding="3" align="center" style="border:solid 1px #D4D4D4" >
                                  <tr>
                                    <td class="displayfont"><p align="center"><strong>Transaction Status:</strong><? echo($Message); ?><br />
                                        <strong>Relyon Transaction ID:</strong> <? echo($TxnID); ?><br />
                                        <strong>ICICI Transaction reference Number:</strong> <? echo($ePGTxnID); ?><br />
                                      </p></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td height="10px"></td>
                            </tr>
                          </table></td>
                      </tr>
                      <tr>
                        <td colspan="2">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2" style="border-top:solid 2px #8e8e8e" height="10px"></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <? }?>
          <tr>
            <td></td>
          </tr>
        </table>
</td>
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
</body></html>

