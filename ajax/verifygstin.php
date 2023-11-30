<?php
ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
//apis to verify GSTIN
include('../include/generateirn.php');

$switchtype = $_POST['switchtype'];
$customer_gst_no = $_POST['customer_gst_no'];

switch($switchtype)
{
    case 'verifygstin':
    {
        $ch = curl_init();
  
        $gstinurl = "https://demo.saralgsp.com/eivital/v1.04/Master";
        $dataArray = ['gstin' => $customer_gst_no];

        $parameters = http_build_query($dataArray);

        $getUrl = $gstinurl."?".$parameters;
        //open connection
        $irnCurl = curl_init();

        curl_setopt($irnCurl, CURLOPT_URL, $getUrl);
        //So that curl_exec returns the contents of the cURL; rather than echoing it
        curl_setopt($irnCurl, CURLOPT_RETURNTRANSFER, true);

        // Set HTTP Header for POST request 
        curl_setopt($irnCurl, CURLOPT_HTTPHEADER, array(
            "AuthenticationToken: $authenticationToken",
            "SubscriptionId: $subscriptionId",
            "user_name: $UserName",
            "AuthToken: $AuthToken",
            "sek: $sek",
            "Gstin: 29AABCR7796N000",
            )
        );

        //execute post
        $irnresult = curl_exec($irnCurl);

        //Print error if any
        if(curl_errno($irnCurl))
        {
            echo 'error:' . curl_error($irnCurl);
        } 
        curl_close($irnCurl);
        //echo($irnresult);
        $decodedata = json_decode($irnresult);
        $status = $decodedata->Status;
        if($status == 0)
            echo(json_encode('1^'.$status));
        else if($status === 'ACT')
            echo(json_encode('2^'.$status));
    }
    break;
}
?>