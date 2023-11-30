<?

include('../include/ajax-referer-security.php');
include("../functions/phpfunctions.php");
include('../include/checksession.php');

if(imaxgetcookie('custuserid') <> '') 
{
	$userid = imaxgetcookie('custuserid');
}
else
{ 
	echo('Thinking to redirect');
	exit;
}

	$usertypes = $_POST['usertype'];
	$prices = $_POST['prices']; 
	$servicetax = $_POST['tax'];
	$product = $_POST['products']; 
	$total = $_POST['netamount']; echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;
	
	$splitusertypes = explode(',',$usertypes);
	$totalquantity = count($splitusertypes);
	
	// Add all the prices 
	$pricearray = explode(',',$prices);
	for($i = 0;i<count($pricearray);$i++)
	{
		$amount = $amount + $pricearray[$i];
	}
	
	// Fetch other deatails to insert.
	$query1 = "select * from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '".$userid."';";
	$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;
	
	// Fetch Contact Details
	$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '".$userid."'  group by customerid ";
	$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);
	
	$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
	$phoneres = removedoublecomma($resultcontactdetails['phone']);
	$cellres = removedoublecomma($resultcontactdetails['cell']);
	$emailidres = removedoublecomma($resultcontactdetails['emailid']);
	
	
	// Fetch all other details 
	$phonenumber = explode(',', $phoneres);
	$phone = $phonenumber[0];
	$cellnumber = explode(',',$cellres);
	$cell = $cellnumber[0];
	$businessname = $fetch['businessname'];
	$address = addslashes($fetch['address']);
	$place = $fetch['place'];
	$district = $fetch['districtcode'];
	$state = $fetch['statename'];
	$pincode = $fetch['pincode'];
	$contactperson = trim($contactvalues,',');
	$stdcode = $fetch['stdcode'];
	$phone = $phonenumber[0];
	$fax = $fetch['fax'];
	$cell = $cellnumber[0];
	$emailid = trim($resultantemailid,',');
	$category = $fetch['inv_mas_customercategory.slno'];
	$type = $fetch['type'];
	$currentdealer = $fetch['currentdealer'];  
	$customertype = ($fetch['customertype'] == '')?'Not Available':$fetch['customertype'];	
	$customercategory = ($fetch['businesstype'] == '')?'Not Available':$fetch['businesstype'];
	
	$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '".$lastslno."' and customerstatus = 'pending' and editedtype = 'edit_type'";
	$result22 = runmysqlqueryfetch($query22);
	if($result22['count'] == 0)
	{
		$resultantemailid = trim($emailidres,',');
	}
	else
	{
		// Fetch of contact details, from pending request table if any
		$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '".$lastslno."' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
		$resultcontactpending = runmysqlqueryfetch($querycontactpending);
		
		$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);
		
		$finalemailid = $emailidres.','.$emailidpending;
		$resultantemailid = remove_duplicates($finalemailid);
	}
	
	//Fetch the max slno from dealer online purchase table
	$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
	$fetchcount = runmysqlqueryfetch($countquery);
	$slnotobeinserted = $fetchcount['slnotobeinserted'];

	//Insert the purchase details in dealer online purchase table
	$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax, products, paymentdate, paymenttime, purchasetype,paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,serviceamount,paymenttypeselected,paymentmode,actualproductprice)values('".$slnotobeinserted."','".$userid."','".$businessname."','".$address."','".$place."','".$district."','".$state."','".$pincode."','".$contactperson."','".$stdcode."','".$phone."','".$fax."','".$cell."','".$resultantemailid."','".$customercategory."','".$customertype."','".$currentdealer."','".$amount."','".$total."','".$servicetax."','".$product."','".date('Y-m-d')."','".date('H:i:s')."','updation','credit/debit','".$usertypes."','','','','','Selected for Credit/Debit Card Payment. This is subject to successful transaction','".$totalquantity."','','','','".$userid."','".$_SERVER['REMOTE_ADDR']."','".date('Y-m-d').' '.date('H:i:s')."','".date('Y-m-d').' '.date('H:i:s')."','".$_SERVER['REMOTE_ADDR']."','".$userid."','','','customer_module','','','paymentmadenow','credit/debit','".$amount."')";  echo($query2);exit;
	
	$result2 = runmysqlquery($query2);	
	
	// Get Dealer Details 
	
	$query3 = "select businessname,inv_mas_region.category as region,inv_mas_dealer.emailid as dealeremailid from inv_mas_dealer left join inv_mas_region on inv_mas_region.slno = inv_mas_dealer.region  where inv_mas_dealer.slno = '".$currentdealer."';";
	$fetch3 = runmysqlqueryfetch($query3);
	
	$dealername = $fetch3['businessname'];
	$dealerregion = $fetch3['region'];
	$dealeremailid = $fetch3['dealeremailid'];
	
	//Get the next record serial number for insertion in invoicenumbers table
	$query1 = "select ifnull(max(slno),0) + 1 as billref from inv_invoicenumbers";
	$resultfetch1 = runmysqlqueryfetch($query1);
	$onlineinvoiceslno = $resultfetch1['billref'];
	
	//Get the next invoice number from invoicenumbers table, for this new_invoice
	$query4 = "select ifnull(max(onlineinvoiceno),".getstartnumber($dealerregion).")+ 1 as invoicenotobeinserted from inv_invoicenumbers where category = '".$dealerregion."'";  //echo($query4);exit;
	$resultfetch4 = runmysqlqueryfetch($query4);
	$onlineinvoiceno = $resultfetch4['invoicenotobeinserted'];
	$invoicenoformat = 'RSL/'.$dealerregion.'/'.$onlineinvoiceno;
	
	$stdcode = ($fetch['stdcode'] == '')?'':$fetch['stdcode'].' - ';
	$address = $fetch['address'].', '.$fetch['place'].', '.$fetch['districtname'].', '.$fetch['statename'].', Pin: '.$pincode;
	$invoiceheading = ($fetch['statename'] == 'Karnataka')?'Tax Invoice':'Bill Of Sale';
	$branchname = $fetch['branchname'];
	$amountinwords = convert_number($total);
	$servicetaxdesc = 'Service Tax Category: Information Technology Software (zzze), Support(zzzq), Training (zzc), Manpower(k), Salary Processing (22g), SMS Service (b)';
	
	// Insert Details to invoice no table
	
	$query5 = "Insert into inv_invoicenumbers(slno,customerid,businessname,contactperson,address,place,pincode,emailid,description,invoiceno,dealername,createddate,createdby,amount,servicetax,netamount,phone,cell,customertype,customercategory,region,purchasetype,onlineinvoiceno,dealerid,products,productquantity,pricingtype,createdbyid,totalproductpricearray,actualproductpricearray,module,servicetype,serviceamount,paymenttypeselected,paymentmode,stdcode,branch,amountinwords,remarks,servicetaxdesc,category,invoiceheading,offerremarks,invoiceremarks,status) values('".$onlineinvoiceslno."','".cusidcombine1($fetch['customerid'])."','".$fetch['businessname']."','".$contactperson."','".addslashes($address)."','".$place."','".$fetch['pincode']."','".$resultantemailid."','','".$invoicenoformat."','".$dealername."','".date('Y-m-d').' '.date('H:i:s')."','".$businessname."','".$amount."','".$servicetax."','".$total."','".$phone."','".$cell."','".$customertype."','".$customercategory."','".$dealerregion."','updation','".$onlineinvoiceno."','".$currentdealer."','".$product."','1','','".$userid."','".$total."','".$amount."','customer_module','','','paymentmadenow','credit/debit','".$stdcode."','".$branchname."','".$amountinwords."','','".$servicetaxdesc."','".$dealerregion."','".$invoiceheading."','','','ACTIVE')";
	
	//echo($query5);exit;
	
	
	$result5 = runmysqlquery($query5);
	
	
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
		$query8 = "INSERT INTO inv_dealercard(dealerid,cardid,productcode,date,usagetype,purchasetype,userid,customerreference,initialusagetype,initialpurchasetype,initialproduct,initialdealerid,cusbillnumber,scheme,cuscardattacheddate,cuscardattachedby,usertype,addlicence,invoiceid) values('".$currentdealer."','".$cardid."','".$product."','".date('Y-m-d').' '.date('H:i:s')."','".$usagetype."','updation','2','".$userid."','".$usagetype."','updation','".$product."','".$currentdealer."','','1','".date('Y-m-d').' '.date('H:i:s')."','".$currentdealer."','customer','','".$onlineinvoiceslno."')";  
		$result8 = runmysqlquery($query8);
	}
	
	// Insert into receipts
	
	$query9 = "INSERT INTO inv_mas_receipt(invoiceno,receiptamount,paymentmode,receiptremarks,privatenote,createddate,createdby,createdip,lastmodifieddate,lastmodifiedby,lastmodifiedip,customerreference,chequedate,chequeno,drawnon,depositdate,receiptdate,receipttime,module,partialpayment) values('".$onlineinvoiceslno."','".$total."','creditordebit','','','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','".$userid."','".$_SERVER['REMOTE_ADDR']."','".datetimelocal('Y-m-d').' '.datetimelocal('H:i:s')."','".$userid."','".$_SERVER['REMOTE_ADDR']."','".$userid."','','','','','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','customer_module','no');";
	$result9 = runmysqlquery($query9);
	
	
	
	$carddetailsquery = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode left join inv_mas_scratchcard on inv_mas_scratchcard.cardid = inv_dealercard.cardid  where invoiceid = '".$onlineinvoiceslno."';";
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
	
	$invoicedetails = vieworgeneratepdfinvoice($onlineinvoiceslno,'createcustomer');
	
	$invoicedetailssplit = explode('^',$invoicedetails); 
	$filebasename = $invoicedetailssplit[0];
	$businessname = $invoicedetailssplit[1];
	$invoiceno = $invoicedetailssplit[2];
	$emailid =  $invoicedetailssplit[3];
	$customerid = $invoicedetailssplit[4];
	$dealeremailid =  $invoicedetailssplit[5];
	$place = $invoicedetailssplit[10];
	$date = datetimelocal('d-m-Y');
	
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
	$array[] = "##ADDRESS##%^%".$address;
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
<? include('../include/scriptsandstyles.php'); ?>
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
                                    <td width="39%" class="subfonts"><div align="right"><img src="../images/paypal-image.gif" width="106" height="37" style="border:solid 2px #9aaed2"/></div></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td colspan="2"><table width="90%" border="0" cellspacing="0" cellpadding="5" align="center">
                                  <tr>
                                    <td width="45%" valign="top" class="displayfont"><strong>Payment from :</strong><br />
                                      <? echo($businessname)?><br />
                                      <? echo($contactperson)?><br />
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
                              <td colspan="2" class="fontstyle" ><p align="left">You have been successfully paid for <img src="../images/relyon-rupee-small.jpg" width="8" height="10"  />&nbsp; <? echo($total)?>. An email also have been sent to <font color="#FF0000"><? echo($emailid)?></font> with the confirmation.<br />
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
</table>
</body>
</html>
