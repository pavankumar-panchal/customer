<?php
include("../functions/phpfunctions.php");
include('../include/checksession.php');
$paymentsarray = $_POST['productcheck'];


//Ensure record numbers are right and recalculate the total of selected records.
$paymenttotal = 0;
$recordreferencestring = "";
for($i = 0; $i < count($paymentsarray); $i++)
{
	$splitarray = explode('^',$paymentsarray[$i]);
	$recordnumber = $splitarray[0];
	$query = "select * from inv_custpaymentreq left join inv_mas_customer on inv_mas_customer.slno = inv_custpaymentreq.custreferences where inv_custpaymentreq.slno = '".$recordnumber."' and inv_custpaymentreq.custreferences = '".$cusid."'";
	$result = runmysqlquery($query);
	
	//Fetch contact details from Contact details table
	$querycontactdetails = "select customerid, GROUP_CONCAT(inv_contactdetails.contactperson) as contactperson, GROUP_CONCAT(inv_contactdetails.phone) as phone, GROUP_CONCAT(inv_contactdetails.cell) as cell,GROUP_CONCAT(inv_contactdetails.emailid) as emailid from inv_contactdetails where customerid = '".$cusid."'  group by customerid ";
	$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);
	
	$contactperson1 = trim(removedoublecomma($resultcontactdetails['contactperson']),',');
	$phone1 = trim(removedoublecomma($resultcontactdetails['phone']),',');
	$cell1 = trim(removedoublecomma($resultcontactdetails['cell']),',');
	$emailid1 = trim(removedoublecomma($resultcontactdetails['emailid']),',');
	if(mysqli_num_rows($result) == 0)
	{
		$errormessage = "Invalid Entry.";
		header("Location:../purchase/payments.php?error=".$error);
		exit;
	}
	else
	{
		$fetchedresult = mysqli_fetch_array($result);
		
		$paymenttotal = $paymenttotal + $fetchedresult['paymentamt'];
		$recordreferencestring .= $recordnumber;
		if($i < (count($paymentsarray)-1))
			$recordreferencestring .= "^";
	}
}
//echo($query);
//exit;

// To fetch the product name for the selected payment by the customer
	$arraysplit = explode('^',$recordreferencestring);
	for($i = 0; $i < count($arraysplit); $i++)
	{

		$recordnumber = $arraysplit[$i];
		$query1 = "select * from inv_custpaymentreq where slno = '".$recordnumber."' and custreferences = '".$cusid."'";
		$result1 = runmysqlquery($query1);
		$fetchedresult1 = mysqli_fetch_array($result1);
		$productname .= $fetchedresult1['productdesc'];
		if($i < (count($arraysplit)-1))
			$productname .= ";";
		
	}
	$splitvalue = str_replace('^',',',$recordreferencestring);
	//Select the main data through record-reference
	$query = "select * from inv_custpaymentreq   where inv_custpaymentreq.slno in (".$splitvalue.")";
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
		$slno = $fetch2['slno'];
		$customerid = $fetch2['customerid'];
		$company = $fetch2['businessname'];
		$contactperson = contactperson1;
		$address = $fetch2['address'];
		$place = $fetch2['place'];
		$phone = $fetch2['phone'];
		//$emailid = $fetch2['emailid'];
		$grid .= "</table>";
	$ResponseCode = 0;
	$emailid = 'archana.ab@relyonsoft.com';
	$emailarray = explode(',',$emailid);
	$emailcount = count($emailarray);
	
	for($i = 0; $i < $emailcount; $i++)
	{
		if(checkemailaddress($emailarray[$i]))
		{
				$emailids[$emailarray[$i]] = $emailarray[$i];
		}
	}


	$fromname = "Relyon";
	$fromemail = "imax@relyon.co.in";
	require_once("../include/RSLMAIL_MAIL.php");
	$msg = file_get_contents("../mailcontent/paymentinfo.htm");
	$textmsg = file_get_contents("../mailcontent/paymentinfo.txt");
	$date = datetimelocal('d-m-Y');
	$time = datetimelocal('H:i:s');
	$array = array();
	$array[] = "##DATE##%^%".$date;
	$array[] = "##TIME##%^%".$time;
	$array[] = "##NAME##%^%".$contactperson;
	$array[] = "##COMPANY##%^%".$company;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##CUSTOMERID##%^%".cusidcombine1($customerid);
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##ADDRESS##%^%".$address;
	$array[] = "##PHONE##%^%".$phone;
	$array[] = "##PRODUCTNAME##%^%".$productname;
	$array[] = "##TOTALAMOUNT##%^%".$paymenttotal;
	$array[] = "##TABLE##%^%".$grid;
	
	$filearray = array(
		array('../images/relyon-logo.jpg','inline','1234567890')
	);
	
	//Mail to customer
	//$toarray = $emailids;
	
	$toarray[] = 'archana.ab@relyonsoft.com';
	
	//Copy of email to Accounts / Vijay Kumar / Bigmails
	//$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Accounts' => 'accounts@relyonsoft.com', 'Vijay' => 'vijaykumar@relyonsoft.com'); 
	$msg = replacemailvariable($msg,$array);
	$textmsg = replacemailvariable($textmsg,$array);
	$subject = "Payment made successfully to Relyon by ".$company;
	$html = $msg;
	$text = $textmsg;
	//rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,$ccarray,$bccarray,$filearray); 
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,'','',$filearray); 


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
                              <td colspan="2" class="fontstyle" ><p align="left">You have been successfully paid for Rs. <?php echo($amount)?>. An email also have been sent to <font color="#FF0000"><?php echo($emailid)?></font>with the confirmation.<br />
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
                                    <td><?php echo($grid)?></td>
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
