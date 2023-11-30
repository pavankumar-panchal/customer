<?php

include("../functions/phpfunctions.php"); 
include('../include/checksession.php');

//Receive the serial numer of record
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
		header("Location:../purchase/payments.php?error=".$errormessage);
		exit;
	}
	else
	{
		$userdetails = mysqli_fetch_array($result);
		$paymenttotal = $paymenttotal + $userdetails['paymentamt'];
		$recordreferencestring .= $recordnumber;
		if($i < (count($paymentsarray)-1))
			$recordreferencestring .= "^";
	}
}

/*-----------------------------Do not edit this piece of code - Begin-----------------------------*/
$query = "SHOW TABLE STATUS like 'transactions'";
$result = runicicidbquery($query);
$row = mysqli_fetch_array($result);
$nextautoincrementid = $row['Auto_increment'];

$merchatid = "00004074";
$date = date('Y-m-d');
$time = date('H:i:s');
$userip = $_SERVER["REMOTE_ADDR"];
$userbrowserlanguage = $_SERVER["HTTP_ACCEPT_LANGUAGE"];
$userbrowseragent = $_SERVER["HTTP_USER_AGENT"];
$relyontransactionid = $nextautoincrementid; 
/*-----------------------------Do not edit this piece of code - End-----------------------------*/



//Main Details
$responseurl = "http://imax.relyonsoft.com/customer/makepayment/complete.php"; //Should not exceed 80 Chars
$amount = $paymenttotal;
$recordreferencestring = $recordreferencestring;
$orderid = ""; //Optional
$invoicenumber = ""; //Optional

//User Details
$company = substr($userdetails['businessname'],0,80); //Optional
$contactperson = $contactperson1;
$address1 = addslashes(substr($userdetails['address'],0,50));
$address2 = ""; //Optional
$address3 = ""; //Optional
$city = substr($userdetails['place'],0,30);
$state = "STATE";
$country = "IND"; //No change5
$pincode =  $userdetails['pincode'];
$phone = $phone1; //Optional
$emailid = $emailid1; //Optional
$customerid = $userdetails['customerid']; //Optional
$quantity = "1";

$productname = "Customer Login Payment";

// Do not edit further, till the end.
//Do not touch this. Inserting the record to Relyon main Credit Card transaction table.
$query = "insert into `transactions` (date, time, userip, orderid, responseurl, invoicenumber, amount, company, contactperson, address1, address2, address3, city, state, pincode, phone, emailid, customerid, productname, quantity, userbrowserlanguage, userbrowseragent,recordreference)	values('".$date."', '".$time."', '".$userip."', '".$orderid."', '".$responseurl."', '".$invoicenumber."', '".$amount."', '".$company."', '".$contactperson."', '".$address1."', '".$address2."', '".$address3."', '".$city."', '".$state."', '".$pincode."', '".$phone."', '".$emailid."', '".$customerid."', '".$productname."', '".$quantity."', '".$userbrowserlanguage."', '".$userbrowseragent."', '".$recordreferencestring."')";
$result = runicicidbquery($query);


// ICICI code begins. Do not alter anything Further - Vijay .................................................

include("Sfa/BillToAddress.php");
include("Sfa/CardInfo.php");
include("Sfa/Merchant.php");
include("Sfa/MPIData.php");
include("Sfa/ShipToAddress.php");
include("Sfa/PGResponse.php");
include("Sfa/PostLibPHP.php");
include("Sfa/PGReserveData.php");

include("Sfa/Address.php");
include("Sfa/SessionDetail.php");
include("Sfa/CustomerDetails.php");
include("Sfa/MerchanDise.php");
include("Sfa/AirLineTransaction.php");

$oMPI 			= 	new MPIData();
$oCI			=	new	CardInfo();
$oPostLibphp	=	new	PostLibPHP();
$oMerchant		=	new	Merchant();
$oBTA			=	new	BillToAddress();
$oSTA			=	new	ShipToAddress();
$oPGResp		=	new	PGResponse();
$oPGReserveData = 	new PGReserveData();

$oSessionDetails   	    =  new SessionDetail();
$oCustomerDetails   	=  new CustomerDetails();
$oOfficeAddress      	=  new Address();
$oHomeAddress    		=  new Address();
$oMerchanDise       	=  new MerchanDise();
$oAirLineTransaction 	=  new AirLineTransaction();


# Merchant ID,  Merchant ID(O), Merchant ID(O), UserIpAddress, TransactionID, OrderReference(O), ResponseURL, ResponseMethod(POST), Currency(INR), InvoiceNo(O), AuthorizationType(req.Preauthorization/req.Sale), Amount, GMTOffset(O), Extra1(O), Extra2(true), Extra3(O), Extra4(O), Extra5(O)
$oMerchant -> setMerchantDetails($merchatid, $merchatid, $merchatid, $userip, $relyontransactionid, $orderid, $responseurl, "POST", "INR", $invoicenumber, "req.Sale", $amount, "", "", "true", "", "", "");

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oSTA -> setAddressDetails ($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# CustomerID(O), CustomerName(O), Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oBTA -> setAddressDetails ($customerid, $company, $address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oHomeAddress -> setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# Address1, Address2(O), Address3(O), City, State, ZIP, Country(IND), Email(O)
$oOfficeAddress -> setAddressDetails($address1, $address2, $address3, $city, $state, $pincode, $country, $emailid);

# FirstName, LastName(O), OfficeAddress(O), HomeAddress(O), Mobile(O), RegistrationDate(O), BillingShippingSame(Y/N)
$oCustomerDetails -> setCustomerDetails($contactperson, "", $oOfficeAddress, $oHomeAddress, $phone, "", "Y");

# ItemName, Quantity, Brand(O), Model(O), CustomerName(O), CardNameCustomerNameSame(O)
$oMerchanDise -> setMerchanDiseDetails($productname, $quantity, "", "", $company, "");

# UserIP, CookieValue(O), BrowserCountry(O), BrowserLocalLanguage, BrowserLocalLangVariant(O), BrowserUserAgent
$oSessionDetails -> setSessionDetails($userip, "", "", $userbrowserlanguage, "", $userbrowseragent);


# call a postSSL function
# for passing null for any parameter, just pass null
# eg to pass null for merchandise
# eg ->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);

$oPGResp=$oPostLibphp->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);

if(java_values($oPGResp->getRespCode()) == '000')
{
	$url	=	java_values($oPGResp->getRedirectionUrl());
	redirect($url);
}
else
{
	print "Error Occured.<br>";
	print "Error Code:".java_values($oPGResp->getRespCode())."<br>";
	print "Error Message:".java_values($oPGResp->getRespMessage())."<br>";
}

	function redirect($url) 
	{
		if(headers_sent()) 
		{
			 ?>
			 <html><head>
			 <script language="javascript" type="text/javascript">
			  window.self.location='<?php print($url);?>';
			 </script>
			 </head></html>
			 <?php
			 exit;
		} 
		else 
		{
			 header("Location: ".$url);
			 exit;
		}
	}
 ?>