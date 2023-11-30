<?php

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

	# Bharosa Object

	$oSessionDetails   	    =  new SessionDetail();
	$oCustomerDetails   	=  new CustomerDetails();
	$oOfficeAddress      	=  new Address();
	$oHomeAddress    		=  new Address();
	$oMerchanDise       	=  new MerchanDise();
	$oAirLineTransaction 	=  new AirLineTransaction();




	$oMerchant->setMerchantDetails("00004074","00004074","00004074","193.545.34.33",rand()."","Ord123","http://10.10.10.147:8756/SFAResponse.php","POST","INR","INV123","req.Sale","100","","PHP","true","PHP","PHP","PHP");

	$oBTA->setAddressDetails ("CID","Tester","Aline1","Aline2","Aline3","Pune","A.P","48927489","IND","tester@soft.com");
	$oSTA->setAddressDetails ("Add1","Add2","Add3","City","State","443543","IND","sad@df.com");
	#oMPI->setMPIRequestDetails("1245","$12.45","418","2","2 shirts","12","20011212","12","0","","image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/vnd.ms-powerpoint, application/vnd.ms-excel, application/msword, application/x-shockwave-flash, */*","Mozilla/4.0 (compatible; MSIE 5.5; Windows NT 5.0)");

    #To set the value to Bharosa Object

    #Parameter Name for Address Details   AddLine1   AddLine2    ,  AddLine3  , City   , State ,  Zip Country , Email id
	$oHomeAddress->setAddressDetails("Sandeep","UttamCorner","Chinchwad","Pune","state","4385435873","IND","tester@soft.com");
	$oOfficeAddress->setAddressDetails("2Opus","MayFairTowers","Wakdewadi","Pune","state","4385435873","IND","tester@soft.com");

	#Parameter Name for Customer Details First Name,LastName ,Office Address Object,Home Address Object,Mobile No,RegistrationDate, flag for matching bill to address and ship to address
	$oCustomerDetails->setCustomerDetails("Amit","Paliwal", $oOfficeAddress, $oHomeAddress,"09372450137","2007-06-13","Y");

	#Parameter Name for Merchant Dise Details Item Purchased,Quantity,Brand,ModelNumber,Buyers Name,flag value for matching CardName and BuyerName
	$oMerchanDise->setMerchanDiseDetails("Computer","2","Intel","P4","Sandeep Patil","Y");

	#Parameter for Session Details   Remote Address, Cookies Value            Browser Country,Browser Local Language,Browser Local Lang Variant,Browser User Agent
	$oSessionDetails->setSessionDetails($_SERVER["REMOTE_ADDR"],"TestCookie","Browser Country",$_SERVER["HTTP_ACCEPT_LANGUAGE"],"",$_SERVER["HTTP_USER_AGENT"]);

	#Parameter Name for AirLine Transaction Details  Booking Date,FlightDate,Flight Time,Flight Number,Passenger Name,Number Of Tickets,flag for matching card name and customer name,PNR,sector from,sector to
	$oAirLineTransaction->setAirLineTransactionDetails ("2007-10-06", "2007-06-22","13:20","119", "Sandeep", "1",  "Y", "25c","Pune","Mumbai");


    # call a postSSL function

    # for passing null for any parameter, just pass null
	    # eg to pass null for merchandise
	    # eg ->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);


    $oPGResp=$oPostLibphp->postSSL($oBTA,$oSTA,$oMerchant,$oMPI,$oPGReserveData,$oCustomerDetails,$oSessionDetails,$oAirLineTransaction,$oMerchanDise);


	if(java_values($oPGResp->getRespCode()) == '000')
	{

		$url	=	java_values($oPGResp->getRedirectionUrl());
		#$url =~ s/http/https/;
		#print "Location: ".$url."\n\n";
		#header("Location: ".$url);
		redirect($url);

	}else
	{
		print "Error Occured.<br>";
		print "Error Code:".java_values($oPGResp->getRespCode())."<br>";
		print "Error Message:".java_values($oPGResp->getRespMessage())."<br>";

	 }

  function redirect($url) {

	 if(headers_sent()) {
	 ?>
	 <html><head>
	 <script language="javascript" type="text/javascript">

	  window.self.location='<?php print($url);?>';

	 </script>
	 </head></html>
	 <?php
	 exit;

	 } else {

	 header("Location: ".$url);
	 exit;

	 }
 }

 ?>
