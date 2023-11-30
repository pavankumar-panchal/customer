<?php
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
//$cusid = imaxgetcookie('custuserid');

		$query = "select distinct inv_mas_customer.slno,inv_mas_customer.businessname,inv_mas_customer.address,inv_mas_customer.place,
inv_mas_customer.pincode,inv_mas_state.statename,inv_mas_customer.website,
inv_mas_customertype.customertype as `type` ,inv_mas_district.districtname,inv_mas_customer.stdcode,
inv_mas_dealer.businessname as firstdealer,
inv_mas_customer.disablelogin,inv_mas_product.productname as firstproduct,
inv_mas_customer.customerid,inv_mas_customercategory.businesstype as category,
inv_mas_customer.promotionalsms, inv_mas_customer.promotionalemail ,inv_mas_region.category as region,inv_mas_customer.gst_no as gst_no
from inv_mas_customer 
left join inv_customerproduct on inv_mas_customer.slno = inv_customerproduct.customerreference 
left join inv_mas_product on inv_mas_product.productcode = inv_mas_customer.firstproduct
left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category
left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type
left join inv_mas_dealer on inv_mas_dealer.slno = inv_mas_customer.firstdealer 
left join inv_mas_district on inv_mas_district.districtcode = inv_mas_customer.district 
left join inv_mas_state on inv_mas_state.slno = inv_mas_district.statecode 
left join  inv_mas_region on inv_mas_region.slno=inv_mas_customer.region 
WHERE inv_mas_customer.slno = '".$cusid."';";
			$fetch= runmysqlqueryfetch($query);
			$businessname = $fetch['businessname'];
			$address = $fetch['address'];
			$place = $fetch['place'];
			$statename = $fetch['statename'];
			$districtname = $fetch['districtname'];
			$pincode = $fetch['pincode'];
			$custgst_no = $fetch['gst_no'];
            if(is_numeric($custgst_no))
            {
                $querygst = "select gst_no from customer_gstin_logs where gstin_id =".$custgst_no;
                $resultgst = runmysqlquery($querygst);
                $countgst = mysqli_num_rows($resultgst);
                if($countgst > 0)
                {
                    $fetchgst = runmysqlqueryfetch($querygst);
                    $gst_no = $fetchgst['gst_no'];
                }
            }
            else
            {
                $gst_no = $custgst_no;
            }
			if($fetch['type'] == '' )
				$type = 'Not Avaliable';	
			else
				$type = $fetch['type'];	
			if($fetch['category'] == '' )
				$category = 'Not Avaliable';	
			else
				$category = $fetch['category'];	
			$firstdealer = $fetch['firstdealer'];
			$firstproduct = $fetch['firstproduct'];
			if($fetch['stdcode'] == '' )
				$stdcode = 'Not Avaliable';	
			else
				$stdcode = $fetch['stdcode'];
			if($fetch['website'] == '' )
				$website = 'Not Avaliable';	
			else
				$website = $fetch['website'];	
			$customerid = cusidcombine1($fetch['customerid']);	
			$promotionalemail = $fetch['promotionalemail'];
			$promotionalsms = $fetch['promotionalsms'];
			$region = $fetch['region'];
			

			$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="5"  style="color:#646464; " class="table-border-grid">';
			$grid .= '<tr class="tr-grid-header1">';
			$grid .= '<td width="8%" align = "center" class="td-border-grid"><strong>Sl No</strong></td>';
			$grid .= '<td width="14%" align = "center" class="td-border-grid"><strong>Type</strong></td>';
			$grid .= '<td width="20%" align = "center" class="td-border-grid"><strong>Name</strong></td>';
			$grid .= '<td width="20%" align = "center" class="td-border-grid"><strong>Phone</strong></td>';
			$grid .= '<td width="15%" align = "center" class="td-border-grid"><strong>Cell</strong></td>';
			$grid .= '<td width="23%" align = "center" class="td-border-grid"><strong>Email Id</strong></td>';
			
			$grid .= '</tr>';
			$m = 0;
			$query1 ="SELECT customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactdetails where customerid = '".$cusid."'; ";
			$resultfetch = runmysqlquery($query1);
			$slnumber = 0;
			$i_n = 0;
			while($fetchres = mysqli_fetch_array($resultfetch))
			{
				if($fetchres['selectiontype'] == 'general')
					$type = 'General';
				else if($fetchres['selectiontype'] == 'gm/director')
					$type = 'GM/Director';
				else if($fetchres['selectiontype'] == 'hrhead')
					$type = 'HR Head';
				else if($fetchres['selectiontype'] == 'ithead/edp')
					$type = 'IT-Head/EDP';
				else if($fetchres['selectiontype'] == 'softwareuser')
					$type = 'Software User';
				else if($fetchres['selectiontype'] == 'financehead')
					$type = 'Finance Head';
				else if($fetchres['selectiontype'] == 'manager')
					$type = 'MANAGER';
				else if($fetchres['selectiontype'] == 'CA')
					$type = 'CA';
				else if($fetchres['selectiontype'] == 'others')
					$type = 'Others';
				else if($fetchres['selectiontype'] == '')
					$type = '';
				$slnumber++;
				$i_n++;$slno++;
				$color;
				if($i_n%2 == 0)
					$color = "#edf4ff";
				else
					$color = "#f7faff";
				
				$grid .= '<tr bgcolor = "'.$color.'">';						
				$grid .= '<td width="8%" style="text-align:left" class="td-border-grid">'.$slnumber.'</td>';
				$grid .= '<td width="14%" style="text-align:left" class="td-border-grid">'.$type.'</td>';
				$grid .= '<td width="20%" style="text-align:left" class="td-border-grid">'.$fetchres['contactperson'].'</td>';
				$grid .= '<td width="20%" style="text-align:left" class="td-border-grid">'.$fetchres['phone'].'</td>';
				$grid .= '<td width="15%" style="text-align:left" class="td-border-grid">'.$fetchres['cell'].'</td>';
				$grid .= '<td width="23%" style="text-align:left" class="td-border-grid">'.$fetchres['emailid'].'</td>';
				$grid .= '</tr>';
				
			}
			$grid .= '</table>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('../include/scriptsandstyles.php'); ?>
<title>View Profile |  Relyon Customer Login Area</title>
</head>
<body>
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php include('../include/header.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200" valign="top"><?php include('../include/left-link.php'); ?></td>
          <td width="700" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="content-top">&nbsp;</td>
              </tr>
              <tr>
                <td class="content-mid"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td class="subheadind-font">View Profile</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                     <tr>
                      <td align="right" valign="top"><a href="editprofile.php"  class="Linking">Edit Profile</a></td>
                    </tr>
                    <tr>
                      <td><form id="submitform" name="submitform" method="post" action="">
                        <table width="100%" border="0" cellspacing="0" cellpadding="4" class="swiftselect" >
                                   
                                    <tr>
                                      <td width="50%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                              <tr>
                                                <td width="2%" height="25" class="producttabheadnone"></td>
                                                <td width="18%" onclick="tabopen5('1','tabg1')" class="producttabheadactive" id="tabg1h1" style="cursor:pointer;"><div align="center"><strong>General Details</strong></div></td>
                                                <td width="2%" class="producttabheadnone"></td>
                                                <td width="18%" onclick="tabopen5('2','tabg1')" class="producttabhead" id="tabg1h2" style="cursor:pointer;"><div align="center"><strong>Contact Details</strong></div></td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%" class="producttabhead" ></td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%"  class="producttabhead" >&nbsp;</td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%"  class="producttabhead">&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td><div style="display:block;"  align="justify" id="tabg1c1" >
                                              <table width="100%" border="0" cellspacing="0" cellpadding="3" class="productcontent" height="300px">
                                                <tr>
                                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">Customer ID: </td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF" id="customerid"><?php echo($customerid)?> </td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">GSTIN: </td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF" id="gst_no"><?php echo($gst_no)?> </td>
                                                    </tr>
                                                    <tr>
                                                      <td width="39%" align="left" bgcolor="#F7FAFF">Business Name:</td>
                                                      <td width="66%" align="left" bgcolor="#F7FAFF" id="businessname"><?php echo($businessname);?></td>
                                                    </tr>

                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">Address:</td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF"  id="address"><?php echo($address)?></td>
                                                    </tr>
                                                    <tr bgcolor="#edf4ff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">Place:</td>
                                                      <td align="left" valign="top" bgcolor="#F7FAFF" id="place"><?php echo($place)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">State:</td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF"  id="state" ><?php echo($statename)?> </td>
                                                    </tr>
                                                    <tr bgcolor="#edf4ff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">District:</td>
                                                      <td valign="top" bgcolor="#F7FAFF" id="district" align="left"><?php echo($districtname)?> </td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">Pin Code:</td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF" id="pincode"><?php echo($pincode)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="39%" align="left" valign="top" bgcolor="#F7FAFF">STD Code:</td>
                                                      <td width="66%" align="left" valign="top" id="stdcode" bgcolor="#F7FAFF"><?php echo($stdcode)?></td>
                                                    </tr>

                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">Website:</td>
                                                      <td align="left" valign="top" bgcolor="#F7FAFF" id="website"><?php echo($website)?> </td>
                                                    </tr>
                                                    <tr bgcolor="#edf4ff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">Type:</td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF" id="type"><?php echo($type)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">Category:</td>
                                                      <td align="left" valign="top" bgcolor="#F7FAFF" id="category"><?php echo($category)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">Promotional SMS:</td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF" id="promotionalsms"><?php echo($promotionalsms)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">Promotional Email:</td>
                                                      <td align="left" valign="top" bgcolor="#F7FAFF" id="promotionalemail"><?php echo($promotionalemail)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td colspan="2" align="left" valign="top" bgcolor="#EDF4FF"><strong>For Relyon Use Only:</strong></td>
                                                    </tr>
                                                    <tr bgcolor="#edf4ff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">Region:</td>
                                                      <td align="left" valign="top" bgcolor="#F7FAFF" id="region"><?php echo($region)?></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#EDF4FF">First Dealer:</td>
                                                      <td align="left" valign="top" bgcolor="#EDF4FF"  id="firstdealer"><?php echo($firstdealer) ?> </td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td align="left" valign="top" bgcolor="#F7FAFF">First Product:</td>
                                                      <td align="left" valign="top" bgcolor="#F7FAFF" id="firstproduct"><?php echo($firstproduct)?> </td>
                                                    </tr>
                                                  </table></td>
                                                </tr>
                                              </table>
                                          </div>
                                              <div style="display:none;" align="justify" id="tabg1c2">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="3" class="productcontent" height="300px">
                                                        <tr>
                                                          <td colspan="2" valign="top"><?php echo($grid);?></td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                   
                                  </table>
                             </form>                      </td>
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
    <td><?php include('../include/footer.php') ?></td>
  </tr>
</table>

</body>
</html>
