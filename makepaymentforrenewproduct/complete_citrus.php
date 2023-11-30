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
$recordreferencestring = $transaction['recordreference'];
$paymentamount = $transaction['amount'];
$company = $transaction['company'];
$contactperson = $transaction['contactperson'];
$emailid = $transaction['emailid'];
$phone = $transaction['phone'];
$address = $transaction['address1'];
$customerid = $transaction['customerid'];
$place = $transaction['city'];

if($ResponseCode == 0) //Success
{	$query1 = "select * from dealer_online_purchase where slno = '".$recordreferencestring."';";
	$fetch1 = runmysqlqueryfetch($query1);
	$currentdealer = $fetch1['currentdealer'];
	$servicetax = $fetch1['servicetax'];
	$amount = $fetch1['amount'];
	$customercategory = $fetch1['category'];
	$customertype = $fetch1['type'];
	$products = $fetch1['products'];
	$usagetype = $fetch1['usagetype'];
	$pincode = $fetch1['pincode'];
	$prices = $fetch1['productpricearray'];
	$cell = $fetch1['cell'];
	$stdcode = $fetch1['stdcode'];
	$total = $paymentamount;
	
	$productpricearray = explode('*',$prices);
	$productarray =  explode('#',$products);
	$totalquantity = count($productarray);
	$allproducts = '';
	for($i = 0;$i<count($productarray);$i++)
	{
		if($allproducts == '')
			$allproducts = $productarray[$i];
		else
			$allproducts .= '#'.$productarray[$i];
	}
	$splitusertypes = explode(',',$usagetype);
	for($i = 0;$i<count($usagetypearray);$i++)
	{
		if($allproducts == '')
			$usagetype = $usagetypearray[$i];
		else
			$usagetype .= ','.$usagetypearray[$i];
	}
	// Fetch Customer Id 
	
	$query2 = "select * from inv_mas_customer 
	left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district 
	left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode 
	left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno 
	left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch 
	left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type 
	left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  
	where inv_mas_customer.slno = '".$customerid."';";

	$fetch2 = runmysqlqueryfetch($query2);
	
	// Get Dealer Details 
	
	$query3 = "select businessname,inv_mas_region.category as region,
	inv_mas_dealer.emailid as dealeremailid,
	inv_mas_dealer.region as regionid,inv_mas_dealer.branch  as branchid 
	from inv_mas_dealer 
	left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region  
	where inv_mas_dealer.slno = '".$currentdealer."';";
	$fetch3 = runmysqlqueryfetch($query3);

	$dealername = $fetch3['businessname'];
	$dealerregion = $fetch3['region'];
	$dealeremailid = $fetch3['dealeremailid'];
	$regionid = $fetch3['regionid'];
	$branchid = $fetch3['branchid'];
	
	//Get the next record serial number for insertion in invoicenumbers table
	$query1 = "select ifnull(max(slno),0) + 1 as billref from inv_invoicenumbers";
	$resultfetch1 = runmysqlqueryfetch($query1);
	$onlineinvoiceslno = $resultfetch1['billref'];
	
	$invoicenogenerated = generatebillnumber();
	$invoicenogeneratedsplit = explode('$',$invoicenogenerated);
	$invoicenoformat = $invoicenogeneratedsplit[0];
	$onlineinvoiceno = $invoicenogeneratedsplit[1];
	
	$stdcode = ($fetch1['stdcode'] == '')?'':$fetch1['stdcode'].' - ';
	$address = $fetch2['address'].', '.$fetch2['place'].', '.$fetch2['districtname'].', '.$fetch2['statename'].', Pin: '.$pincode;
	$invoiceheading = ($fetch2['statename'] == 'Karnataka')?'Tax Invoice':'Bill Of Sale';
	$branchname = $fetch2['branchname'];
	$amountinwords = convert_number($total);
	$servicetaxdesc = 'Service Tax Category: Information Technology Software (zzze), Support(zzzq), Training (zzc), Manpower(k), Salary Processing (22g), SMS Service (b)';
	
	// Insert Details to invoice no table
	
	$query5 = "Insert into inv_invoicenumbers(slno,customerid,businessname,contactperson,address,place,pincode,emailid,description,invoiceno,dealername,createddate,createdby,amount,servicetax,netamount,phone,cell,customertype,customercategory,region,purchasetype,onlineinvoiceno,category,dealerid,products,productquantity,pricingtype,createdbyid,totalproductpricearray,actualproductpricearray,module,servicetype,serviceamount,paymenttypeselected,paymentmode,stdcode,branch,amountinwords,remarks,servicetaxdesc,invoiceheading,offerremarks,invoiceremarks,status,duedate,branchid,regionid,privatenote,podate,poreference, productbriefdescription,itembriefdescription,seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,servicedescription,offerdescription) 
	values('".$onlineinvoiceslno."','".cusidcombine1($fetch2['customerid'])."','".$company."','".$contactperson."','".addslashes($address)."','".$place."','".$fetch2['pincode']."','".$emailid."','','".$invoicenoformat."','".$dealername."','".date('Y-m-d').' '.date('H:i:s')."','Webmaster','".$amount."','".$servicetax."','".$total."','".$phone."','".$cell."','".$customertype."','".$customercategory."','".$dealerregion."','Product','".$onlineinvoiceno."','Online','".$currentdealer."','".$allproducts."', '".$totalquantity."', 'default','2','".$total."','".$amount."','customer_module','','','paymentmadenow','citrus','".$stdcode."','".$branchname."','".$amountinwords."','Payment received through citrus.','".$servicetaxdesc."','".$invoiceheading."','','None','ACTIVE','".date('Y-m-d')."','".$branchid."','".$regionid."','','','','','','','','','','','')";
			
	$result5 = runmysqlquery($query5);
	
	for($i=0; $i< $totalquantity ;$i++)
	{
		$usagetype = $splitusertypes[$i];
		$addlicence = '';
		
		//Execute the PIN number Purchase
		$query7 = "SELECT attachPIN() as cardid;";
		$result7 = runmysqlqueryfetch($query7);
		
		//Attach that PIN Number to that dealer/customer
		$query8 = "INSERT INTO inv_dealercard(dealerid,cardid,productcode,date,usagetype,purchasetype,userid,customerreference,initialusagetype,initialpurchasetype,initialproduct,initialdealerid,cusbillnumber,scheme,cuscardattacheddate,cuscardattachedby,usertype,addlicence,invoiceid) 
		values('".$currentdealer."','".$result7['cardid']."','".$productarray[$i]."','".date('Y-m-d').' '.date('H:i:s')."','".$usagetype."','updation','2','".$customerid."','".$usagetype."','updation','".$productarray[$i]."','".$currentdealer."','','1','".date('Y-m-d').' '.date('H:i:s')."','".$customerid."','customer','','".$onlineinvoiceslno."')";  
		$result8 = runmysqlquery($query8);
	}
	
	//Get the next record serial number for insertion in receipts table
	$query45 ="select max(slno) + 1 as receiptslno from inv_mas_receipt";
	$resultfetch45 = runmysqlqueryfetch($query45);
	$receiptslno = $resultfetch45['receiptslno'];
	
	// Insert into receipts
	$query9 = "INSERT INTO inv_mas_receipt(slno,invoiceno,receiptamount,paymentmode,receiptremarks,privatenote,createddate,createdby,createdip,lastmodifieddate,lastmodifiedby,lastmodifiedip,customerreference,chequedate,chequeno,drawnon,depositdate,receiptdate,receipttime,module,partialpayment) 
	values('".$receiptslno."','".$onlineinvoiceslno."','".$total."','citrus','','','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','2','".$_SERVER['REMOTE_ADDR']."','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','2','".$_SERVER['REMOTE_ADDR']."','".$customerid."','','','','','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','customer_module','no');";
	$result9 = runmysqlquery($query9);
	
	//Send receipt email
	sendreceipt($receiptslno,'resend');

	$carddetailsquery = "select * from inv_dealercard 
	left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode 
	left join inv_mas_scratchcard on inv_mas_scratchcard.cardid = inv_dealercard.cardid 
	 where invoiceid = '".$onlineinvoiceslno."';";
	$carddetailsresult = runmysqlquery($carddetailsquery);
	$slno = 0;
	$descriptioncount = 0;
	$k=0;
	while($carddetailsfetch = mysqli_fetch_array($carddetailsresult))
	{
		$slno++;
		if($carddetailsfetch['purchasetype'] == 'new')
			$purchasetype = 'New';
		else
			$purchasetype = 'Updation';
		
		
		if($carddetailsfetch['usagetype'] == 'singleuser')
		{
			$usagetype = 'Single User';
		}
		else
		{
			$usagetype = 'Multi User';
		}
		if($descriptioncount > 0)
			$description .= '*';
		$description .= $slno.'$'.$carddetailsfetch['productname'].' - ('.$carddetailsfetch['year'].')'.'$'.$purchasetype.'$'.$usagetype.'$'.$carddetailsfetch['scratchnumber'].'$'.$carddetailsfetch['cardid'].'$'.$productpricearray[$k];
		$k++;
		$descriptioncount++;
	}

	//Update invoicenumbers with payment status details
	$query10 = "update inv_invoicenumbers set paymenttypeselected = 'paymentmadenow', 
	paymentmode = 'citrus',description = '".$description."' 
	where slno =  '".$onlineinvoiceslno."'";
	$result10 = runmysqlquery($query10);

	//Update the Payment status 
	$query11 = "UPDATE dealer_online_purchase SET  paymentdate = '".date('Y-m-d')."', 
	paymenttime = '".date('H:i:s')."',paymenttypeselected = 'paymentmadenow', 
	paymentmode = 'citrus',onlineinvoiceno = '".$onlineinvoiceslno."'  
	WHERE slno = '".$recordreferencestring."'";
	$result11 = runmysqlquery($query11);
	
	
	// Generate Pdf 
	$invoicedetails = vieworgeneratepdfinvoice($onlineinvoiceslno,'send');
	
	$invoicedetailssplit = explode('^',$invoicedetails); 
	$filebasename = $invoicedetailssplit[0];
	
	$fromname = "Relyon";
	$fromemail = "imax@relyon.co.in";
	require_once("../include/RSLMAIL_MAIL.php");
	$msg = file_get_contents("../mailcontent/paymentinfoupdation.htm");
	$textmsg = file_get_contents("../mailcontent/paymentinfoforupdation.txt");
	$date = datetimelocal('d-m-Y');
	$time = datetimelocal('H:i:s');
	$array = array();
	$array[] = "##DATE##%^%".$date;
	$array[] = "##TIME##%^%".$time;
	$array[] = "##NAME##%^%".$contactperson;
	$array[] = "##COMPANY##%^%".$company;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##CUSTOMERID##%^%".cusidcombine1($fetch2['customerid']) ;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##ADDRESS##%^%".$address;
	$array[] = "##PHONE##%^%".$phone;
	$array[] = "##AMOUNT##%^%".$amount;
	$array[] = "##INVOICENO##%^%".$invoicenoformat;
	$array[] = "##EMAILID##%^%".$emailid;
	
	
	//CC to the dealer
	//$dealeremailid = 'rashmi.hk@relyonsoft.com';
	$ccemailarray = explode(',',$dealeremailid);
	$ccemailcount = count($ccemailarray);
	
	for($i = 0; $i < $ccemailcount; $i++)
	{
		if(checkemailaddress($ccemailarray[$i]))
		{
				$ccemailids[$ccemailarray[$i]] = $ccemailarray[$i];
		}
	}
	$ccarray = $ccemailids;
	$replyto = $ccemailids[$ccemailarray[0]];
	
	$filearray = array(
		array('../images/relyon-logo.jpg','inline','1234567890'),
		array('../images/relyon-rupee-small.jpg','inline','1234567892'),
		array('../filecreated/'.$filebasename,'attachment','1234567893')
	);
	
	$emailarray = explode(',',$emailid);
	$emailcount = count($emailarray);
	
	for($i = 0; $i < $emailcount; $i++)
	{
		if(checkemailaddress($emailarray[$i]))
		{
				$emailids[$emailarray[$i]] = $emailarray[$i];
		}
	}
	$toarray = $emailids;
	
	//Copy of email to Accounts / Vijay Kumar / Bigmails / Bills
	$bccarray = array('Bigmail' => 'bigmail@relyonsoft.com', 'Accounts'=> 'bills@relyonsoft.com', 'Relyonimax'=> 'relyonimax@gmail.com');
	//$bccarray = array('Vijay' => 'vijaykumar@relyonsoft.com');
	$msg = replacemailvariable($msg,$array);
	$textmsg = replacemailvariable($textmsg,$array);
	$subject = "Relyon Online Invoice  | ".$invoicenoformat."";
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
