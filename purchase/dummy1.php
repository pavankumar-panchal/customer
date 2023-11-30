<?php
include("../functions/phpfunctions.php");
include('../include/checksession.php');

	$recordreferencestring =  '9746';

	//Update the Payment status 
	$query1 = "UPDATE dealer_online_purchase SET  paymentdate = '".date('Y-m-d')."', paymenttime = '".date('H:i:s')."',paymenttypeselected = 'paymentmadenow', paymentmode = 'creditordebit' WHERE onlineinvoiceno = '".$recordreferencestring."'";
	$result = runmysqlquery($query1);
	
	//Update invoicenumbers with payment status details
	$query2 = "update inv_invoicenumbers set paymenttypeselected = 'paymentmadenow', paymentmode = 'creditordebit' where slno =  '".$recordreferencestring."'";
	$result2 = runmysqlquery($query2);
	// Get receipt amount to add into receipt
	
	$query3 = "select netamount from inv_invoicenumbers where slno = '".$recordreferencestring."'";
	$result3 = runmysqlqueryfetch($query3);
	$totalamount = $result3['netamount'];
	
	// Check if receipt entry is there 
	
	$query4 = "select * from inv_mas_receipt where invoiceno = '".$recordreferencestring."'";
	$result4 = runmysqlquery($query4);
	$count = mysqli_num_rows($result4);
	
	if($count <> '0')
	{
		$query5 = "select sum(receiptamount) as receiptamount from inv_mas_receipt where invoiceno = '".$recordreferencestring."'";
		$receiptamount = runmysqlqueryfetch($query5);
		
		if($receiptamount['receiptamount'] < $totalamount )
		{	
			$amount = $totalamount - $receiptamount['receiptamount'];
		}
		else
		{
			$amount = $totalamount;
		}
	}
	else
	{
		$amount = $totalamount;
	}
	
	
	$query1 = "select * from  inv_invoicenumbers  where slno = '".$recordreferencestring."'";//echo($query);exit;
	$result1 = runmysqlqueryfetch($query1);
	$customerid = $result1['customerid'];
	$invoiceno = $result1['invoiceno'];	
	
	$query1 ="select max(slno) + 1 as receiptslno from inv_mas_receipt";
	$resultfetch1 = runmysqlqueryfetch($query1);
	$receiptslno = $resultfetch1['receiptslno'];
	
	// Add a receipt 
	$query = "INSERT INTO inv_mas_receipt(slno,invoiceno,receiptamount,paymentmode,createddate,createdby,createdip,lastmodifieddate,lastmodifiedby,lastmodifiedip,customerreference,receiptdate,receipttime,module,partialpayment) values('".$receiptslno."','".$recordreferencestring."','".$amount."','creditordebit','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','2','".$_SERVER['REMOTE_ADDR']."','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','2','".$_SERVER['REMOTE_ADDR']."','".$customerreference."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','customer_module','no');";
	$result = runmysqlquery($query);
		
	//Send receipt email

	sendreceipt($receiptslno,'resend');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<META HTTP-EQUIV="Content-type" content="UTF-8">
<title>Payment to Relyon Accounts</title>
<meta name="keywords" content="Register with Relyon for free downloads, newsletters and many more..">
<meta name="description" content="Relyon Customer login pages.">
<link href="../css/style.css" rel="stylesheet" type="text/css">
<script language="javascript">
function returnhomepage()
{
	window.location = 'index.php';
	return false;
}

</script>
<meta name="copyright" content="Relyon Softech Ltd. All rights reserved." />
<?php include('../include/scriptsandstyles.php'); ?>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>
        <table width="750px" border="0" align="center" cellpadding="0" cellspacing="0" >
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td colspan="2"></td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <?php if($ResponseCode == 0) { ?>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td  valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 2px #272727">
                      <tr>
                        <td >&nbsp;</td>
                      </tr>
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
                                    <td width="61%" class="subfonts" style="padding-left:15px" >Transaction Successful</td>
                                    <td width="39%" class="subfonts"><div align="right"><img src="../images/paypal-image.gif" width="106" height="37" style="border:solid 2px #9aaed2"/></div></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
                                  <tr>
                                    <td width="45%" valign="top" class="displayfont"><strong>Payment from :</strong><br />
                                      <?php echo($company)?><br />
                                      <?php echo($contactperson)?><br />
                                      <?php echo($address)?><br />
                                      <?php echo($place)?> : <?php echo($pincode)?> </td>
                                    <td width="45%"  valign="top" class="displayfont"><strong>Payment To :</strong><br />
                                      Relyon Softech Ltd<br />
                                      No. 73, Shreelekha Complex, <br />
                                      WOC Road,Bangalore :560 086<br />
                                      Phone: 1860-425-5570 <br />
                                      Email: support@relyonsoft.com</td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2" class="fontstyle" ><p align="left">You have been successfully paid for <img src="../images/relyon-rupee-small.jpg" width="8" height="10"  />&nbsp; <?php echo($amount)?>. An email also have been sent to <font color="#FF0000"><?php echo($emailid)?></font> with the confirmation.<br />
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
                                          <td class="displayfont"><p align="center"><strong>Transaction Status:</strong> <?php echo($Message); ?><br />
                                              <strong>Relyon Transaction ID:</strong> <?php echo($TxnID); ?><br />
                                              <strong>ICICI Transaction reference Number:</strong> <?php echo($ePGTxnID); ?><br />
                                              <strong>Authorization ID: </strong> <?php echo($AuthIdCode) ?> <br />
                                            </p></td>
                                        </tr>
                                      </table></td>
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
                                  <input type="button" id="print" name="print" value="Print" onclick="window.print()"/>
                                  &nbsp;&nbsp;&nbsp;
                                  <input type="button" id="update" name="update" value="Go to Home Page" onclick="returnhomepage()"  />
                                </div></td>
                            </tr>
                          </table></td>
                      </tr>
                    </table></td>
                </tr>
              </table></td>
          </tr>
          <?php }else{?>
          <tr>
            <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="3" style="border:solid 2px #272727">
                <tr>
                  <td >&nbsp;</td>
                </tr>
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
                              <td width="39%" class="subfonts"><div align="right"><img src="../images/paypal-image.gif" width="106" height="37" style="border:solid 2px #9aaed2"/></div></td>
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
                                    <td class="displayfont"><p align="center"><strong>Transaction Status:</strong><?php echo($Message); ?><br />
                                        <strong>Relyon Transaction ID:</strong> <?php echo($TxnID); ?><br />
                                        <strong>ICICI Transaction reference Number:</strong> <?php echo($ePGTxnID); ?><br />
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
          <?php }?>
          <tr>
            <td></td>
          </tr>
        </table>
      </td>
  </tr>
</table>
</body>
</html>
