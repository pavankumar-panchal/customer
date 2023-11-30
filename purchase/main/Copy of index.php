<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');

			$query = "select distinct inv_mas_customer.slno ,inv_mas_customer.place,
inv_mas_state.statename,inv_mas_customer.phone,inv_mas_customer.cell,inv_mas_customer.emailid,
inv_mas_district.districtname,inv_mas_customer.contactperson,inv_mas_customer.businessname,inv_mas_customer.customerid,
inv_mas_district.statecode from inv_mas_customer left join inv_customerproduct on inv_mas_customer.slno = inv_customerproduct.customerreference
left join inv_mas_product on inv_mas_product.productcode = inv_mas_customer.firstproduct
left join inv_mas_district on inv_mas_district.districtcode
= inv_mas_customer.district left join inv_mas_state 
on inv_mas_state.slno = inv_mas_district.statecode  WHERE inv_mas_customer.slno = '".$cusid."';";
			$fetch= runmysqlqueryfetch($query);
			$businessname =$fetch['businessname'];
			$contactperson =$fetch['contactperson'];
			$place = $fetch['place'];
			$statename = $fetch['statename'];
			$districtname = $fetch['districtname'];
			$pincode = $fetch['pincode'];
			$stdcode = $fetch['stdcode'];
			$phone = $fetch['phone'];
			$cell = $fetch['cell'];
			$emailid = $fetch['emailid'];
			$customerid = cusidcombine1($fetch['customerid']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include('../include/scriptsandstyles.php'); ?>
<link rel="stylesheet" type="text/css" href="../css/style.css?dummy=<? echo (rand());?>">
<SCRIPT src="../functions/dashboard.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
<title>Dashboard | Relyon Customer Login Area</title>
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
                                        <td height="20px">Email: <? echo(gridtrim40($emailid));?>										</td>
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
                      <td > 
					  <? 
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
                    <tr>
                      <td style="padding-left:6px" ><table width="96%" border="0" cellspacing="0" cellpadding="0" align="center" class="paymentreq-font">
                      <tr>
                      <td width="13%" >&nbsp;</td>
                      <td width="84%" ><div  class="smsaccount-font"  align="left" ><img src="../images/imax-customer-smsaccount.jpg" width="30" height="29" border="0" align="absmiddle"  /><span style="padding-left:1px;" > To access your SMS account please <a href="../sms/index.php" class="Links">click here</a>...</span></div></td>
                      <td width="3%" >&nbsp;</td>
                      </tr>
  <tr>
    <td colspan="3">  <? if($p_request == 'yes') { ?>
      <div id="pendingrequestmeg"   align="center" ><img src="../images/imax-pendingrequest-icon.gif" width="30" height="25" border="0" align="absmiddle"  /><span style="padding-left:1px;" > You have a payment due, which can be paid online. <a href="../purchase/payments.php" class="Links">Click here to Proceed...</a></span></div>
        <? } ?></td>
  </tr>
  <tr>
    <td height="5px" colspan="3"></td>
  </tr>
</table></td>
                    </tr>
                    <tr><td>&nbsp;</td></tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td><div id="displayduedetails" style="display:none"><form action="" method="post" name="submitform" id="submitform" onsubmit="return false;"><table width="95%" border="0" cellspacing="0" cellpadding="0" align="center" >
    <tr>
      <td><div align="center" class="smallbox-heading">Invoices Due</div></td>
    </tr>
    <tr>
      <td><div align="center" >Dated after 01 Febrauary 2011</div></td>
    </tr>
    <tr><td>&nbsp;</td></tr>
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
    </div><div id="resultgrid" style="overflow:auto; display:none;" align="center">&nbsp;</div></td>
                        </tr>
                      </table></form></div></td>
  </tr>
</table>
</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
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
