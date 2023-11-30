<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');

	$query = "select distinct inv_mas_customer.slno ,inv_mas_customer.place,
inv_mas_state.statename,
inv_mas_district.districtname,inv_mas_customer.businessname,inv_mas_customer.customerid,
inv_mas_district.statecode,inv_mas_customer.currentdealer from inv_mas_customer left join inv_customerproduct on inv_mas_customer.slno = inv_customerproduct.customerreference
left join inv_mas_product on inv_mas_product.productcode = inv_mas_customer.firstproduct
left join inv_mas_district on inv_mas_district.districtcode
= inv_mas_customer.district left join inv_mas_state 
on inv_mas_state.slno = inv_mas_district.statecode  WHERE inv_mas_customer.slno = '".$cusid."';";

	$fetch= runmysqlqueryfetch($query);
	
	$query2 = "select GROUP_CONCAT(emailid) as emailid,  GROUP_CONCAT(cell) as cell, GROUP_CONCAT(phone) as phone, GROUP_CONCAT(contactperson) as contactperson from inv_contactdetails where customerid = '".$cusid."'";
	$resultfetch2 = runmysqlqueryfetch($query2);
	
	$businessname =$fetch['businessname'];
	$contactperson =$resultfetch2['contactperson'];
	$place = $fetch['place'];
	$statename = $fetch['statename'];
	$districtname = $fetch['districtname'];
	$pincode = $fetch['pincode'];
	$stdcode = $fetch['stdcode'];
	$phone = $resultfetch2['phone'];
	$cell = $resultfetch2['cell'];
	$emailid = $resultfetch2['emailid'];
	$customerid = cusidcombine1($fetch['customerid']);
	$currentdealer = $fetch['currentdealer'];
	
	$renewproduct = 'no';
	//Check if the dealer is relyonexecutive
	  
	$query1 = "select * from inv_mas_dealer where slno = '".$currentdealer."'";
	$fetch1 = runmysqlqueryfetch($query1);
	$relyonexecutive = $fetch1['relyonexecutive'];
	if($relyonexecutive == 'yes')
	{
		//Define the year for which Renewals are needed
		$yearforrenewal = "2012-13";
		
		// Ger the current Financial Year in YYYY-YY format
		//$currentyear = date('Y').'-'.(date('y')+1); 
		$currentyear = $yearforrenewal; 
		
		//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
		$query2 = "select inv_mas_product.year from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '".$cusid."' and inv_mas_product.group = 'TDS' and inv_customerproduct.reregistration = 'no'order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
		$result2 = runmysqlquery($query2);
		$count_customerproduct = mysqli_num_rows($result2);
		if($count_customerproduct > 0)
		{
			//Fetch the previous year to a variable
			$fetch2 = mysqli_fetch_array($result2);
			$previousyear = $fetch2['year'];
			
			//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
			$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '".$cusid."' and inv_mas_product.group = 'TDS' and inv_mas_product.year = '".$currentyear."'";
			$result2 = runmysqlquery($query2);
			$count_dealercard = mysqli_num_rows($result2);
			if($count_dealercard == 0 && $previousyear <> $currentyear)
			{
				$renewproduct = 'yes';
			}			
		}
	}
	$currentyear1 = '2012-13';
	$query3 = "select t1.group as productgroup, if(t3.group is null,'Not yet Available',if(t2.group is null,'Available','Updated')) as status1, if(if(t3.group is null,'Not yet Available',if(t2.group is null,'Available','Updated')) = 'Available','Update Now >>','') as action1 from (select  left(inv_customerproduct.computerid,3) as prdcode, inv_customerproduct.customerreference, inv_mas_product.group from inv_mas_product left join inv_customerproduct on inv_mas_product.productcode = left(inv_customerproduct.computerid,3)
where   inv_customerproduct.customerreference = '".$cusid."' and inv_customerproduct.reregistration = 'no' and inv_mas_product.group in ('TDS','STO','SVI','SVH','SPP','XBRL')) as t1
left join 
(select  ifnull(left(inv_customerproduct.computerid,3),inv_dealercard.productcode) as prdcode, ifnull(inv_customerproduct.customerreference,inv_dealercard.customerreference) as customerreference, inv_mas_product.group from inv_mas_product left join inv_customerproduct on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) and  inv_customerproduct.customerreference = '".$cusid."' and inv_customerproduct.reregistration = 'no' left join inv_dealercard on inv_dealercard.productcode = inv_mas_product.productcode and inv_dealercard.customerreference = '".$cusid."' where  inv_mas_product.year = '".$currentyear1."' and (inv_dealercard.productcode is not null or inv_customerproduct.customerreference is not null) and inv_mas_product.group in ('TDS','STO','SVI','SVH','SPP','XBRL')) as t2 on t1.group = t2.group left join (select distinct `group` from inv_mas_product where `year` = '".$currentyear1."'  and inv_mas_product.group in ('TDS','STO','SVI','SVH','SPP','XBRL')) as t3 on t1.group = t3.group group by t1.group ORDER BY FIELD(t1.group, 'TDS', 'STO', 'SVI', 'SVH', 'SPP', 'XBRL');";
	$result3 = runmysqlquery($query3);
	$grid .= '<table width="400" border="0" align="center" cellpadding="4" cellspacing="0" class="table-border-grid2"><tr bgcolor="#FF8888"><td class="td-border-grid2" align ="center"><strong><font color="#FFFFFF">Product</font></strong></td><td class="td-border-grid2" align ="center"><strong><font color="#FFFFFF">Status</font></strong></td><td class="td-border-grid2" align ="center"><strong><font color="#FFFFFF">Action</font></strong></td></tr>';
	$i_n = 0;
	while($fetch = mysqli_fetch_array($result3))
	{
		$i_n++;
		$color;
		if($i_n%2 == 0)
			$color = "#FFF2F2";
		else
			$color = "#FFEAEA";
		if($fetch['productgroup'] == 'TDS')
		{
			$hashlink = '#TDS';
			$productgroup = 'Saral TDS';
		}
		else if($fetch['productgroup'] == 'XBRL')
		{
			$hashlink = '#XBRL';
			$productgroup = 'Saral XBRL';
		}
		else if($fetch['productgroup'] == 'STO')
		{
			$hashlink = '#STO';
			$productgroup = 'Saral TaxOffice';
		}
		else if($fetch['productgroup'] == 'SVH')
		{
			$hashlink = '#SVH';
			$productgroup = 'Saral VAT100';
		}
		else if($fetch['productgroup'] == 'SVI')
		{
			$hashlink = '#SVI';
			$productgroup = 'Saral VATInfo';
		}
		else if($fetch['productgroup'] == 'SPP')
			$productgroup = 'Saral PayPack';
		if($productgroup == 'Saral PayPack')
		{
			$action = '-';
		}
		else
		{
		  if($fetch['action1'] == '')
			  $action = '-';
		  else
			  $action = '<a href="../purchase/renewsoftware.php?'.$hashlink.'" class ="sub_headingfont">'.$fetch['action1'].'</a>';
		}
		
		if($fetch['status1'] == 'Updated')
			$fontcolor = '#00CC00"';
		elseif($fetch['status1'] == 'Available') 
			$fontcolor = '#FF0000';
		elseif($fetch['status1'] == 'Not yet Available')
			$fontcolor = '#C4C4C4';
		$grid .= ' <tr bgcolor="'.$color.'"><td class="td-border-grid2" >'.$productgroup.'</td><td class="td-border-grid2"><font color="'.$fontcolor.'"><strong>'.$fetch['status1'].'</strong></font></td><td class="td-border-grid2">'.$action.'</td></tr>';
	}
	$grid .= ' </table>';
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include('../include/scriptsandstyles.php'); ?>
<link rel="stylesheet" type="text/css" href="../css/style.css?dummy=<? echo (rand());?>">
<SCRIPT src="../functions/dashboard.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
<title>Dashboard | Relyon Customer Login Area</title>
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
<body onload="getinvoices()">
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td  colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include('../include/header.php') ?></td>
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
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td colspan="2" class="heading-font">Welcome <? echo($businessname);?>,</td>
                  </tr>
                  <tr>
                    <td height="4px" colspan="2" class="blueline"></td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="middle"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td width="58%" valign="top" style="background:url(../images/imax-cust-dashboard-profile-stirp.jpg) no-repeat top center"><table width="330" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td height="178" valign="middle"><table width="270" border="0" cellpadding="4" cellspacing="0" class="dashboardprofilebox">
                              <tr>
                                <td  style="font-size:16px;"><? echo(gridtrim40($businessname));?></td>
                              </tr>
                              <tr>
                                <td><? echo(gridtrim40($contactperson));?></td>
                              </tr>
                              <tr>
                                <td><? echo(gridtrim40($place));?>, <? echo(gridtrim40($districtname));?>, <? echo(gridtrim40($statename));?></td>
                              </tr>
                              <tr>
                                <td>Phone: <? echo(gridtrim40($phone));?>, <? echo(gridtrim40($cell));?></td>
                              </tr>
                              <tr>
                                <td height="20px">Email: <? echo(gridtrim40($emailid));?></td>
                              </tr>
                              <tr>
                                <td style="font-size:15px;"><div align="right"><a href="../profile/editprofile.php">Edit these details</a></div></td>
                              </tr>
                            </table></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                        <td width="42%" valign="top"><table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><a href="../contact/writetorelyon.php"><img src="../images/imax-cust-dashboard-strip1.jpg" alt="Write to Relyon" width="270" height="40" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><a href="../profile/editprofile.php"><img src="../images/imax-cust-dashboard-strip2.jpg" alt="Edit your profile" width="270" height="40" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                          <tr>
                            <td><a href="../support/procedure.php"><img src="../images/imax-cust-dashboard-strip3.jpg" alt="Contact Support" width="270" height="40" border="0" /></a></td>
                          </tr>
                          <tr>
                            <td>&nbsp;</td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td ><? 
					  $query0 = "select  COUNT(*) AS count from inv_custpaymentreq left join inv_mas_customer on  inv_mas_customer.slno = inv_custpaymentreq.custreferences  where inv_mas_customer.slno='".$cusid."' and inv_custpaymentreq.paymentstatus = 'UNPAID'";
						$fetch1 = runmysqlqueryfetch($query0);
						if($fetch1['count'] > 0)
						{
							$p_request = 'yes';
						}
						else
						{
							$p_request = 'no';
						}
	  					?></td>
                  </tr>
                  <? if($p_request == 'yes') { ?>
                  <tr>
                    <td style="padding-left:6px" ><table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="paymentreq-font">
                      <!--<tr>
                        <td width="13%" >&nbsp;</td>
                        <td width="84%" ><div  class="smsaccount-font"  align="left" ><img src="../images/imax-customer-smsaccount.jpg" width="30" height="29" border="0" align="absmiddle"  /><span style="padding-left:1px;" > To access your SMS account please <a href="../sms/index.php" class="Links">click here</a>...</span></div></td>
                        <td width="3%" >&nbsp;</td>
                      </tr>-->
                      <tr>
                        <td colspan="3">
                          <div id="pendingrequestmeg"   align="center" ><img src="../images/imax-pendingrequest-icon.gif" width="30" height="25" border="0" align="absmiddle"  /><span style="padding-left:1px;" > You have a payment due, which can be paid online. <a href="../purchase/payments.php" class="Links">Click here to Proceed...</a></span></div>
                         </td>
                      </tr>
                      <tr>
                        <td height="5px" colspan="3"></td>
                      </tr>
                    </table></td>
                  </tr> <? } ?>
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><div align="center"><strong style="font-size:14px">Product Renewals</strong></div></td>
                  </tr> <tr>
                  
                  <tr>
                    <td>&nbsp;</td>
                  </tr>
                    <td><? echo($grid);?></td>
                  </tr><tr>
                    <td>&nbsp;</td>
                  </tr>
                  <tr>
                    <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td><div id="displayduedetails" style="display:none">
                          <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;">
                            <table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" >
                              <tr>
                                <td><div align="center" class="smallbox-heading">Invoices Due</div></td>
                              </tr>
                              <tr>
                                <td><div align="center" >Dated after 01 February 2011</div></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                              </tr>
                              <tr>
                                <td><div id="tabgroupgridc1" style="overflow:auto;" align="center">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                    <tr>
                                      <td><div id="tabgroupgridc1_1" align="center"></div></td>
                                    </tr>
                                    <tr>
                                      <td><div id="getmorelink"  align="left" ></div></td>
                                    </tr>
                                    <tr>
                                      <td><input type="hidden" name="onlineinvoiceno" id="onlineinvoiceno" value = " "/></td>
                                    </tr>
                                  </table>
                                </div>
                                  <div id="resultgrid" style="overflow:auto; display:none;" align="center">&nbsp;</div></td>
                              </tr>
                            </table>
                          </form>
                        </div></td>
                      </tr>
                    </table></td>
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
                <td></td>
              </tr>
                           <tr>
                <td class="content-btm">&nbsp;</td>
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
