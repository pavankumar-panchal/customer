<?php

include('../include/ajax-referer-security.php');
include("../functions/phpfunctions.php");
include('../include/checksession.php');

if(imaxgetcookie('custuserid') <> '') 
{
	$customerid = imaxgetcookie('custuserid');
}
else
{ 
	echo('Thinking to redirect');
	exit;
}

		$onlineinvoiceno = $_POST['onlineslno']; //echo($onlineinvoiceno);exit;
	
		///Update the Payment status 
		$query1 = "UPDATE dealer_online_purchase SET  paymentdate = '".date('Y-m-d')."', paymenttime = '".date('H:i:s')."',paymenttypeselected = 'paymentmadenow', paymentmode = 'creditordebit' WHERE onlineinvoiceno = '".$onlineinvoiceno."'";
		$result = runmysqlquery($query1);
	
		// Fetch required details from dealer_online_purchase
	
		$query2 = "select inv_invoicenumbers.products as products,dealer_online_purchase.usagetype as usagetpe from inv_invoicenumbers left join dealer_online_purchase on dealer_online_purchase.onlineinvoiceno = inv_invoicenumbers.slno where inv_invoicenumbers.slno = '".$onlineinvoiceno."'";
	
		//echo($query2);exit;	
		
		
 		$result2 = runmysqlqueryfetch($query2);
		$totalquantity  = $result2['productquantity'];
		$products = $result2['products'];
		$productarray = explode('#',$products);
		$currentdealer = $result2['dealerid'];
		$usertype = $result2['usagetpe'];
		$splitusertypes = explode(',',$usertype);
		$total = $result2['netamount'];
		
		echo($products.'^'.$usertype);exit;
		
		//Take a new PIN number from scratch card table
		$query6 = "SELECT * FROM inv_mas_scratchcard WHERE attached = 'no' order by cardid limit  ".$totalquantity."  ;";
		$result6 = runmysqlquery($query6);
		//empty($pinserials);
		$pinserialcount = 0;
		while($fetch3 = mysqli_fetch_array($result6))
		{
			//$pinserials[] = $fetch3['cardid'];
			if($pinserialcount > 0)
				$pinserials .= ',';
			$pinserials .= $fetch3['cardid'];
			$pinserialcount++;
		}
		//First update them as attached
		$query7 = "UPDATE inv_mas_scratchcard SET attached = 'yes', registered = 'no', blocked = 'no', online = 'yes', cancelled = 'no'  WHERE cardid IN (".$pinserials.");";
		$result7 = runmysqlquery($query7);
		$pinserialssplit = explode(',',$pinserials);
		
		for($i = 0; $i < count($pinserialssplit); $i++)
		{
			$cardid = $pinserialssplit[$i];
			
			$usagetype = $splitusertypes[$i];
			$addlicence = '';
			//Attach that PIN Number to that customer
			$query8 = "INSERT INTO inv_dealercard(dealerid,cardid,productcode,date,usagetype,purchasetype,userid,customerreference,initialusagetype,initialpurchasetype,initialproduct,initialdealerid,cusbillnumber,scheme,cuscardattacheddate,cuscardattachedby,usertype,addlicence,invoiceid) values('".$currentdealer."','".$cardid."','".$productarray[$i]."','".date('Y-m-d').' '.date('H:i:s')."','".$usagetype."','updation','2','".$customerid."','".$usagetype."','updation','".$productarray[$i]."','".$currentdealer."','','1','".date('Y-m-d').' '.date('H:i:s')."','".$currentdealer."','customer','','".$onlineinvoiceno."')";  
			$result8 = runmysqlquery($query8);
		}
		// Insert into receipts
		
		$query9 = "INSERT INTO inv_mas_receipt(invoiceno,receiptamount,paymentmode,receiptremarks,privatenote,createddate,createdby,createdip,lastmodifieddate,lastmodifiedby,lastmodifiedip,customerreference,chequedate,chequeno,drawnon,depositdate,receiptdate,receipttime,module,partialpayment) values('".$onlineinvoiceno."','".$total."','creditordebit','','','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','".$customerid."','".$_SERVER['REMOTE_ADDR']."','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','".$customerid."','".$_SERVER['REMOTE_ADDR']."','".$customerid."','','','','','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','customer_module','no');";
		$result9 = runmysqlquery($query9);
		
		
		
		$carddetailsquery = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode left join inv_mas_scratchcard on inv_mas_scratchcard.cardid = inv_dealercard.cardid  where invoiceid = '".$onlineinvoiceno."';";
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
			$description .= $slno.'$'.$carddetailsfetch['productname'].' - ('.$carddetailsfetch['year'].')'.'$'.$purchasetype.'$'.$usagetype.'$'.$carddetailsfetch['scratchnumber'].'$'.$carddetailsfetch['cardid'].'$'.$pricearray[$k];
			$k++;
			$descriptioncount++;
		}
		
		// Update Details
		
		$invoicequery = "update inv_invoicenumbers set description = '".$description."' where slno  ='".$onlineinvoiceslno."';";
		$invoiceresult = runmysqlquery($invoicequery);
	
		//update preonline purchase table with invoice no and other details 
		$query10 = "UPDATE dealer_online_purchase SET paymentdate = '".date('Y-m-d')."', paymenttime = '".date('H:i:s')."',paymentremarks = 'paymentmadenow',onlineinvoiceno = '".$onlineinvoiceslno."' WHERE slno = '".$slnotobeinserted."'";
		$result10 = runmysqlquery($query10);
	
	
		//Update invoicenumbers with payment status details
		$query2 = "update inv_invoicenumbers set paymenttypeselected = 'paymentmadenow', paymentmode = 'creditordebit' where slno =  '".$recordreferencestring."'";
		$result2 = runmysqlquery($query2);
		
		
		$query1 = "select * from  inv_invoicenumbers  where slno = '".$onlineinvoiceno."'";//echo($query);exit;
		$result1 = runmysqlqueryfetch($query1);
		$customerid = $result1['customerid'];
		$invoiceno = $result1['invoiceno'];	
	
	
	$invoicedetails = vieworgeneratepdfinvoice($onlineinvoiceno,'createcustomer');
	
	$invoicedetailssplit = explode('^',$invoicedetails); 
	$filebasename = $invoicedetailssplit[0];
	$businessname = $invoicedetailssplit[1];
	$invoiceno = $invoicedetailssplit[2];
	$emailid =  $invoicedetailssplit[3];
	$customerid = $invoicedetailssplit[4];
	$dealeremailid =  $invoicedetailssplit[5];
	$place = $invoicedetailssplit[10];
	$date = datetimelocal('d-m-Y');
	
	
	$query1 = "select * from  inv_invoicenumbers  where slno = '".$onlineinvoiceno."'";//echo($query);exit;
	$result1 = runmysqlqueryfetch($query1);
	$customerid = $result1['customerid'];
	$invoiceno = $result1['invoiceno'];	
	$contactperson = $result1['contactperson'];	
	
	$total = $result1['netamount'];
	// Maillig Starts
	$fromname = "Relyon";
	$fromemail = "imax@relyon.co.in";
	require_once("../include/RSLMAIL_MAIL.php");
	$msg = file_get_contents("../mailcontent/paymentinfoforinvoie.htm");
	$textmsg = file_get_contents("../mailcontent/paymentinfoforinvoice.txt");
	
	$array = array();
	$array[] = "##DATE##%^%".$date;
	$array[] = "##NAME##%^%".$contactperson;
	$array[] = "##COMPANY##%^%".$businessname;
	$array[] = "##PLACE##%^%".$place;
	$array[] = "##CUSTOMERID##%^%".$customerid ;
	$array[] = "##PHONE##%^%".$phone;
	$array[] = "##AMOUNT##%^%".$total;
	$array[] = "##INVOICENO##%^%".$invoiceno;

	//$emailid = $emailid;
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
	//CC to Sales person
	//$dealeremailid = 'archana.ab@relyonsoft.com';
/*	$ccemailarray = explode(',',$dealeremailid);
	$ccemailcount = count($ccemailarray);
	for($i = 0; $i < $ccemailcount; $i++)
	{
		if(checkemailaddress($ccemailarray[$i]))
		{
			if($i == 0)
				$ccemailids[$ccemailarray[$i]] = $ccemailarray[$i];
			else
				$ccemailids[$ccemailarray[$i]] = $ccemailarray[$i];
		}
	}*/
	
	//Relyon Logo for email Content, as Inline [Not attachment]
	$filearray = array(
		array('../images/relyon-logo.jpg','inline','1234567890'),array('../images/relyon-rupee-small.jpg','inline','1234567892'),array('../filecreated/'.$filebasename,'inline','1234567893')
	);
	$toarray = $emailids;
	
	//CC to sales person
	$ccarray = $ccemailids;
	
	if(($_SERVER['HTTP_HOST'] == "meghanab") || ($_SERVER['HTTP_HOST'] == "rashmihk") ||  ($_SERVER['HTTP_HOST'] == "archanaab") )
	{
		$bccemailids['rashmi'] ='meghana.b@relyonsoft.com';
		//$bccemailids['archanaab'] ='archana.ab@relyonsoft.com';
	}
	else
	{
		$bccemailids = array('Bigmail' => 'bigmail@relyonsoft.com', 'Accounts'=> 'bills@relyonsoft.com', 'Vijay' => 'vijaykumar@relyonsoft.com');
	}
	$bccarray = $bccemailids;
	$msg = replacemailvariable($msg,$array);
	$textmsg = replacemailvariable($textmsg,$array);
	$subject = "Relyon Online Invoice | ".$invoiceno."";
	$html = $msg;
	$text = $textmsg;
	rslmail($fromname, $fromemail, $toarray, $subject, $text, $html,$ccarray,$bccarray,$filearray);
	
	//Insert the mail forwarded details to the logs table
	//$bccmailid = 'vijaykumar@relyonsoft.com,bills@relyonsoft.com,bigmail@relyonsoft.com'; 
	inserttologs(imaxgetcookie('custuserid'),$slno,$fromname,$fromemail,$emailid,null,$bccmailid,$subject);
	
	
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
                                      <?php echo($businessname)?><br />
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
                              <td colspan="2" class="fontstyle" ><p align="left">You have been successfully paid for <img src="../images/relyon-rupee-small.jpg" width="8" height="10"  />&nbsp; <?php echo($total)?>. An email also have been sent to <font color="#FF0000"><?php echo($emailid)?></font> with the confirmation.<br />
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
