<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');

$query = "select inv_mas_customer.slno,inv_mas_customer.customerid,inv_mas_customer.businessname,inv_mas_customer.pincode from inv_mas_customer where inv_mas_customer.slno = '".$cusid."' ";
$result = runmysqlqueryfetch($query);

$businessname = $result['businessname'];
$pincode = $result['pincode'];

$querycontactdetails = "SELECT GROUP_CONCAT(customerid) as customerid,GROUP_CONCAT(contactperson) as contactperson,
GROUP_CONCAT(emailid) as emailid  from inv_contactdetails where customerid  = '".$cusid."'  group by customerid ";
$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);
			
$contactperson = trim(removedoublecomma($resultcontactdetails['contactperson']),',');
$allemailids = trim(removedoublecomma($resultcontactdetails['emailid']),',');


$emailarray = explode(",",$allemailids);
$emailid = trim($emailarray[0]);
	
	$message ="";
//Check whether the pincode is null else validation of the pincode
	if($businessname == '' || $contactperson == '' )
	{
		$message = "Businessname / Contactperson is not Avaliable.";
	}
	else
//Check whether the Emailid is null else validation of the Emailid
	if($emailid == '')
	{
		$message = "Emailid is not Avaliable.";
	}
	elseif(checkemailaddress($emailid) == false)
	{
		$message = "Enter the valid Email ID.";
	}
	else
//Check whether the pincode is null else validation of the pincode
	if($pincode == '')
	{
		$message = "PIN Code is not Avaliable.";
	}
	elseif(pincodevalidation($pincode) == false)
	{
		$message = "Enter the valid PIN Code.";
	}
	else
	{
		$query1 = "select distinct inv_custpaymentreq.paymentstatus from inv_custpaymentreq  
	where custreferences='".$cusid."' and paymentstatus = 'UNPAID';";
		$result1 = runmysqlquery($query1);
		$grid = "";	
		
		if(mysqli_num_rows($result1) == 0)
		{
			$grid .= '<table width="100%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="border:1px solid #308ebc; "><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center"><font color=#FF0000><strong>You Currently dont have any Payment Request</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';	
		}
		else
		{
			$resulttot = 0;
	$query1= "select inv_custpaymentreq.productdesc,inv_custpaymentreq.billref,inv_custpaymentreq.paymentamt, inv_custpaymentreq.slno as cusslno from inv_custpaymentreq  where custreferences= '".$cusid."' and  paymentstatus = 'UNPAID' order by paymenttime ";
			$grid = '<table width="100%" cellpadding="7" cellspacing="0" class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header"><td nowrap = "nowrap" class="td-border-grid">Sl No</td><td nowrap = "nowrap" class="td-border-grid">Product Reference</td><td nowrap = "nowrap" class="td-border-grid">Bill Reference</td><td nowrap = "nowrap" class="td-border-grid">Bill Amount</td><td nowrap = "nowrap" class="td-border-grid">Pay</td></tr>';
			$i_n = 0;$slno = 0;
			$result1 = runmysqlquery($query1);
			while($fetch = mysqli_fetch_array($result1))
			{
				$i_n++;$slno++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				$resulttot +=  $fetch['paymentamt'];
				$grid .= '<tr class="gridrow" bgcolor='.$color.' >';
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$slno."</td>";
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['productdesc']."</td>";
				$grid .= "<td nowrap='nowrap' class='td-border-grid'>".$fetch['billref']."</td>";
				$grid .= "<td nowrap='nowrap' class='td-border-grid' id ='amt'>".$fetch['paymentamt']."";
				$grid .= '<td class="td-border-grid"><label> <input type="checkbox" name="productcheck[]" id="productcheck" checked = "checked" value ="'.$fetch['cusslno'].'^'.$fetch['paymentamt'].'" onclick ="calctotal()"  /> </label></td>';
				$grid .= "</tr>";
			}
			$grid .= "</table>";
			$grid .='<table width="100%" border="0" cellspacing="0" cellpadding="5">';
			$grid .='<tr><td colspan="3">&nbsp;</td></tr>';
			$grid .=' <tr><td width="76%" align="right" class="paymenttotfont"> Total: </td>
<td width="20%" align="centre" id="totalresult" class="paymenttotfont">'.$resulttot.'</td><td width="9%" align="centre"><input name="payment" type="button" class="swiftchoicebutton" id="payment" value="Pay"  onclick="paynow()"/></td>
</tr></table>';	
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Make Payments | Relyon Customer Login Area</title>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<? include('../include/scriptsandstyles.php'); ?>
<script language="javascript" src="../functions/javascript.js?dummy=<? echo (rand());?>" type="text/javascript"></script>
<script language="javascript" src="../functions/payments.js?dummy=<? echo (rand());?>" type="text/javascript"></script>
<script type="text/javascript">
   $(document).ready( function() {
          $('#popupBoxClose').click( function() {  
			$(".modalOverlay").remove();          
            unloadPopupBox();
        });
   });

</script>
<style type="text/css">
.modalOverlay {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    background-color: rgba(0,0,0,0.3);
}
.modalOverlay1 {
    position: relative;
    width: 10;
    height: 0%;
    top: 0px;
    left: 0px;
    background-color: rgba(0,0,0,0); 
}
#invoicedetailsgrid { 
    display:none;
    position:fixed;  
    _position:absolute; 
    height:170px;  
    width:300px;  
    background:#FFFFFF;  
    left: 500px;
    top: 200px;
    z-index:100;
    margin-left: 15px;  
    border:1px solid #328cb8;
	box-shadow: 0px 0px 30px #666666; 
    font-size:15px;   	
	-moz-border-radius: 15px;
	border-radius: 15px; 
}

a{  
cursor: pointer;
text-decoration:none;  
} 

#popupBoxClose {
    font-size:14px;  
    line-height:15px;  
    right:5px;  
    top:5px;  
    position:absolute;  
    color:#FFF;  
    font-weight:500;      
}
</style>
</head>
<body >
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" ><? include('../include/header.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200" valign="top"><? include('../include/left-link.php'); ?></td>
          <td width="700" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="content-top">&nbsp;</td>
              </tr>
              <tr>
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td class="subheadind-font" >Payment to Relyon Accounts</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><form action="" method="post" name="submitform" id="submitform"  onsubmit="return false;">
                          <table width="100%" border="0" cellspacing="5" cellpadding="4">
                       <tr>
                              <td><? if($_GET['error'] <> '') { ?> <div class="errorbox"> <? echo('Invalid Entry'); } ?></div></td>
                            </tr>
                           
                            <tr>
                              <td><? if($message <> '') { ?> 
                              <div class="errorbox"> 
							  <? echo($message); } else {?> </div><? echo($grid);}?>
                             </td>
                            </tr>
                          </table>
                        </form></td>
                    </tr>
                    
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>
                      	<div id="invoicedetailsgrid">
                            		<div style="background-color:#328cb8; height:25px; -moz-border-top-left-radius: 15px;border-top-left-radius: 15px;-moz-border-top-right-radius: 15px;border-top-right-radius: 15px;">
                              <font style="font-size:14px; line-height:15px;left:5px;top:5px; position:absolute;  color:#FFF; font-weight:500; ">Payment mode</font>
 								 <a id="popupBoxClose">Close</a></div>
                                 <form action="" method="post" name="submitexistform" id="submitexistform">
                                  	<table align="center"  width="100%" border="0" cellspacing="10px" cellpadding="0">
                                    <tr><td>
                                     <label> <input type="radio" id="paymode" name="paymode" value="credit" />&nbsp;Pay through Credit Card</label><br /></td></tr><tr><td>
                                      <label><input type="radio" id="paymode" name="paymode" value="internet" />&nbsp;Pay through Net Banking</label><br /></td></tr><tr><td>&nbsp;<input type="hidden" name="lslnop" id="lslnop" value=""><div id="err" style="color:red;">&nbsp;</div></td></tr><tr><td align="center">
                                      <input name="custpayment" type="button"  id="custpayment" value="Proceed for Payment" onclick ="proceedpayment()"/></td></tr>
                                    </table>
                                  </form>
                              </div>
                      </td>
                    </tr>
                  </table></td>
              </tr>
              <tr>
                <td class="content-btm"></td>
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
</body>
</html>
