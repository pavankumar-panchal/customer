<?php

include("../functions/phpfunctions.php"); 


//Configuration
require_once("java/Java.inc");
$strMerchantId="00004074";
$astrFileName="/usr/jb_manju/00004074.key";
$astrClearData;

if($_POST)
{
  $TxnID = "";
  $txnrefno = "";
  $txnstatus = "";
  $Message = "";
  $firstName = "";
  $lastName = "";
  $email = "";
  $street1 = "";
  $city = "";
  $state = "";
  $country = "";
  $pincode = "";
  $mobileNo = "";
  
  if(isset($_POST['TxRefNo']))
  {
	  $txnrefno = $_POST['TxRefNo'];
  }
  if(isset($_POST['TxId']))
  {
	  $TxnID = $_POST['TxId'];
  }
  if(isset($_POST['TxStatus']))
  {
	  $txnstatus = $_POST['TxStatus'];
  }
  if(isset($_POST['TxMsg']))
  {
	  $Message = $_POST['TxMsg'];
  }
  if(isset($_POST['pgTxnNo']))
  {
	  $ePGTxnID = $_POST['pgTxnNo'];
  }
  if(isset($_POST['pgRespCode']))
  {
	  $ResponseCode = $_POST['pgRespCode'];
  }
  if(isset($_POST['amount']))
  {
	  $amount = $_POST['amount'];
  }
  if(isset($_POST['authIdCode']))
  {
	  $AuthIdCode = $_POST['authIdCode'];
  }
  if(isset($_POST['issuerRefNo']))
  {
	  $issuerrefno = $_POST['issuerRefNo'];
  }
  if(isset($_POST['firstName']))
  {
	  $firstName = $_POST['firstName'];
  }
  if(isset($_POST['lastName']))
  {
	  $lastName = $_POST['lastName'];
  }
  if(isset($_POST['email']))
  {
	  $email = $_POST['email'];
  }
  if(isset($_POST['addressStreet1']))
  {
	  $street1 = $_POST['addressStreet1'];
  }
  if(isset($_POST['addressStreet2']))
  {
	  $street2 = $_POST['addressStreet2'];
  }
  if(isset($_POST['addressCity']))
  {
	  $city = $_POST['addressCity'];
  }
  if(isset($_POST['addressState']))
  {
	  $state = $_POST['addressState'];
  }
  if(isset($_POST['addressCountry']))
  {
	  $country = $_POST['addressCountry'];
  }
  if(isset($_POST['addressZip']))
  {
	  $pincode = $_POST['addressZip'];
  }
  if(isset($_POST['mandatoryErrorMsg']))
  {
	  $mandatoryerrmsg = $_POST['mandatoryErrorMsg'];
  }
  if(isset($_POST['successTxn']))
  {
	  $successtxn = $_POST['successTxn'];
  }
  if(isset($_POST['mobileNo']))
  {
	  $mobileNo = $_POST['mobileNo'];
  }
	  
	//Validation of Refresh or Back button
	if(isset($_COOKIE['relyoncctransaction']))
	{
		if($_COOKIE['relyoncctransaction'] == $TxnID)
		{
			echo("You have either hit on Refresh or Back. The page has been expired.");
			exit;
		}
	}
	
	//Set the cookie for Refresh or Back button validation
	setcookie(relyoncctransaction,$TxnID,time()+3600, "/", ".relyonsoft.com");
	
}
else
{
	echo("Invalid Entry");
	exit;
}

//Update the transactions table
$query = "update transactions set responsecode = '".$ResponseCode."', responsemessage = '".$Message."', pgtxnid = '".$ePGTxnID."', authidcode = '".$AuthIdCode."', rrn = NULL, cvrespcode = NULL, fdmsscore = NULL, fdmsresult = NULL, cookievalue = NULL where id = '".$TxnID."'";
$result = runicicidbquery($query);
	citruspayment(1,$TxnID,$recordreferencestring,$query);


//Select the values from transation table
$query = "select * from transactions where id = '".$TxnID."'";
$result = runicicidbquery($query);
$transaction = mysqli_fetch_array($result);

$date = datetimelocal('Y-m-d');
$time = datetimelocal('H:i:s');
$recordreferencestring = $transaction['recordreference'];
$paymentamount = $transaction['amount'];
$company = $transaction['company'];
$contactperson = $transaction['contactperson'];
$emailid = $transaction['emailid'];
$phone = $transaction['phone'];
$address = $transaction['address1'];
$customerid = $transaction['customerid'];
$place = $transaction['city'];

//Select the main data through record-reference
$splitvalue = str_replace('^',',',$recordreferencestring);
$query = "select * from inv_custpaymentreq   where inv_custpaymentreq.slno IN (".$splitvalue.")";
$result = runmysqlquery($query);
$grid = '<table width="700px" cellpadding="3" cellspacing="0" border="1" align="center" style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:12px" >';
$grid .= '<tr bgcolor ="#3EC0FF">
<td nowrap = "nowrap"><strong>Sl No</strong></td>
<td nowrap = "nowrap"><strong>Product Reference</strong></td>
<td nowrap = "nowrap"><strong>Bill reference</strong></td>
<td nowrap = "nowrap" ><strong>Bill Amount</strong></td>
</tr>';
$k=0;
while($fetch2 = mysqli_fetch_array($result))
{
	$k++;
	$grid .= "<tr>";
	$grid .= "<td nowrap = 'nowrap'>".$k."</td>";
	$grid .= "<td nowrap = 'nowrap'>".$fetch2['productdesc']."</td>";
	$grid .= "<td nowrap = 'nowrap'>".$fetch2['billref']."</td>";
	$grid .= "<td nowrap = 'nowrap'>".$fetch2['paymentamt']."</td>";
	$grid .= "</tr>";

}
$grid .= "</table>";

if($ResponseCode == 0) //Success
{
	$splitvalue = str_replace('^',',',$recordreferencestring);
	//Update payment details to Payment request table
	$query1 = "update inv_custpaymentreq set paymentstatus = 'PAID', paymentdate = '".$date."', paymenttime = '".$time."' where 
	slno IN (".$splitvalue.")";
	$result = runmysqlquery($query1);
	
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
	$array = array();
	$array[] = "##DATE##%^%".changedateformat($date);
	$array[] = "##NAME##%^%".$contactperson;
	$array[] = "##COMPANY##%^%".$company;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##CUSTOMERID##%^%".cusidcombine1($customerid);
	$array[] = "##ADDRESS##%^%".$address;
	$array[] = "##PHONE##%^%".$phone;
	$array[] = "##TOTALAMOUNT##%^%".$paymentamount;
	$array[] = "##TABLE##%^%".$grid;
	
	$filearray = array(
		array('../images/relyon-logo.jpg','inline','1234567890')
	);
	
	//Mail to customer
	$toarray = $emailids;
	
	//Copy of email to Accounts / Vijay Kumar / Bigmails
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Accounts' => 'accounts@relyonsoft.com', 'Relyonimax'=> 'relyonimax@gmail.com'); 
	//$bccarray = array('Vijay' => 'vijaykumar@relyonsoft.com');

	$msg = replacemailvariable($msg,$array);
	$textmsg = replacemailvariable($textmsg,$array);
	$subject = "Payment made successfully to Relyon by ".$company;
	$html = $msg;
	$text = $textmsg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,$ccarray,$bccarray,$filearray); 
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta  name="description" content="Products page of Relyon - House of eTDS, Payroll, salary and attendance management software" />
<meta content="Form100, VAT Offices,Service Tax Returns,Online Filing,Indian Taxation,Inventory,PF software,Computerized Accounting" name="keywords" />
<title>Relyon: Buy Online</title>
<link rel="stylesheet" type="text/css" href="../styles/style.css?dummy = <? echo (rand());?>">
<script language="javascript">
function returnhomepage()
{
	window.location = '../buy/index.php';
	return false;
}

</script>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table width="750px" border="0" align="center" cellpadding="0" cellspacing="0" >
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
                                  <td width="39%" class="subfonts"><div align="right"><img src="../images/relyon-image.gif" width="106" height="37" border="0" style="border:solid 2px #9aaed2"/></div></td>
                                </tr>
                              </table></td>
                          </tr>
                          <tr>
                            <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
                                <tr>
                                  <td width="45%" valign="top" class="displayfont"><strong>Payment from :</strong><br />
                                    <? echo($company)?><br />
                                    <? echo('('.$contactperson.')')?><br />
                                    <? echo($address)?><br />
                                    <? echo($place)?> : <? echo($pincode)?> </td>
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
                            <td colspan="2" class="fontstyle" ><p align="left">You have  successfully paid  <img src="../images/relyon-rupee-small.jpg" width="8" height="10"  />&nbsp;<font color="#000000"><? echo($amount.'.00')?></font>. An email also have been sent to <font color="#FF0000"><? echo($emailid)?></font> with the confirmation.<br />
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
                                            <strong>Citrus Transaction reference Number:</strong> <? echo($ePGTxnID); ?><br />
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
        <? }else{?>
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
                            <td width="39%" class="subfonts"><div align="right"><img src="../images/relyon-image.gif" width="106" height="37" style="border:solid 2px #9aaed2"/></div></td>
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
                                      <strong>Citrus Transaction reference Number:</strong> <? echo($ePGTxnID); ?><br />
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
      </table></td>
  </tr>
</table>
</body>
</html>
