<?
	$cusid = imaxgetcookie('custuserid');
	$query = "select * from inv_mas_customer where inv_mas_customer.slno ='".$cusid."'";
	$fetch= runmysqlqueryfetch($query);
	$businessname = $fetch['businessname'];
	$currentdealer = $fetch['currentdealer'];
	
	$query1 = "select * from inv_mas_dealer where slno = '".$currentdealer."'";
	$fetch1 = runmysqlqueryfetch($query1);
	$relyonexecutive = $fetch1['relyonexecutive'];
	
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="links-top" ></td>
              </tr>
              <tr>
                <td class="links-mid"><table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
                
                 <tr>
                      <td class="company_font" align="center" ><? echo($businessname);?></td>
                    </tr>
                    
                    <tr><td height="5px"></td></tr>
                    <tr>
                      <td class="smallbox-heading">Profile</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td ><a href="../profile/viewprofile.php" class="sub_headingfont">View Profile</a></td>
                    </tr>
                    <tr>
                      <td><a href="../profile/editprofile.php" class="sub_headingfont">Edit Profile</a></td>
                    </tr>
                       <tr>
                      <td><a href="../profile/changepassword.php" class="sub_headingfont">Change Password</a></td>
                    </tr>
                     <tr>
                      <td><a href="../profile/viewexistinglicenses.php" class="sub_headingfont">View Existing Licenses</a></td>
                    </tr>
                 
                    <!-- <tr>
                      <td><a href="../sms/index.php" class="sub_headingfont">SMS Account</a></td>
                  </tr>-->
                     <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="smallbox-heading">Purchase</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                   <? if($relyonexecutive == 'yes')  {?>
                   <tr>
                      <td><a href="../purchase/renewsoftware.php" class="sub_headingfont" >Renew your Software</a></td>
                    </tr>
                   <? } ?>
                    <tr>
                      <td><a href="../purchase/manageinvoices.php" class="sub_headingfont" >Manage Invoices</a></td>
                    </tr>
                    <tr>
                      <td><a href="../purchase/payments.php" class="sub_headingfont" >Other Payments</a></td>
                    </tr>
                     <tr>
                      <td>&nbsp;</td>
                    </tr>
                      <tr>
                      <td class="smallbox-heading">Download</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><a href="../download/product.php" class="sub_headingfont">Product (Full)</a></td>
                  </tr>
                       <tr>
                      <td><a href="../download/productupdates.php" class="sub_headingfont">Product Updates</a></td>
                  </tr>
                       <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="smallbox-heading">Implementation</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><a href="../deployment/implementation.php" class="sub_headingfont">Implementation Details</a></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="smallbox-heading">Support</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><a href="../support/procedure.php" class="sub_headingfont">Procedure</a></td>
                    </tr>
                    <tr>
                      <td><a href="../support/contactdetails.php" class="sub_headingfont">Contact by Phone</a></td>
                    </tr>
                 
                     <tr>
                      <td><a href="../support/ProductUtilities.php" class="sub_headingfont">Product Utilities</a></td>
                    </tr>
                     <tr>
                      <td><a href="../support/SupportUtilities.php" class="sub_headingfont">Support Utilities</a></td>
                    </tr>
                     <tr>
                      <td><a href="../support/Pre-requisites.php" class="sub_headingfont">Pre-requisites</a></td>
                    </tr>
                    
                    
                  <!-- <tr>
                      <td><a href="../purchase/buyupdations.php" class="sub_headingfont">Buy Updations</a></td>
                    </tr>
                    <tr>
                      <td><a href="../purchase/maintenance.php" class="sub_headingfont">Buy Maintenance Contracts</a></td>
                    </tr>
                    <tr>
                      <td><a href="../purchase/newlicenses.php" class="sub_headingfont">Buy New Licenses</a></td>
                    </tr>-->
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="smallbox-heading">Contact</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><a href="../contact/contact.php" class="sub_headingfont">Contact Details</a></td>
                    </tr>
                    <tr>
                      <td><a href="../contact/writetorelyon.php" class="sub_headingfont">Write to Relyon</a></td>
                    </tr>
                    <!--<tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td class="smallbox-heading">Refer</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><a href="../refer/referFriend.php" class="sub_headingfont">Refer your Friends</a></td>
                    </tr>
                    <tr>-->
                      <td>&nbsp;</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td class="links-btm"></td>
              </tr>
            </table>