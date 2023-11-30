<?php

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php');
$switchtytpe = $_POST['switchtype'];


if (imaxgetcookie('custuserid') <> '')
	$customerid = imaxgetcookie('custuserid');
else {
	echo ('Thinking to redirect');
	exit;
}

switch ($switchtytpe) {
	case 'getdata':

		//Define the year for which Renewals are needed
		$yearforrenewal = "2011-12";

		// Ger the current Financial Year in YYYY-YY format
		//$currentyear = date('Y').'-'.(date('y')+1); 
		$currentyear = $yearforrenewal;

		//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
		$query1 = "select inv_mas_product.year from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '10001'and inv_mas_product.group = 'TDS' and inv_customerproduct.reregistration = 'no'order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
		$result1 = runmysqlquery($query1);
		$count_customerproduct = mysqli_num_rows($result1);
		if ($count_customerproduct == 0) {
			// Convey that, they do not have Saral TDS product license for renewal
			$message = "3^nolicense";
		} else {
			//Fetch the previous year to a variable
			$fetch1 = mysqli_fetch_array($result1);
			$previousyear = $fetch1['year'];

			//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
			$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '10001' and inv_mas_product.group = 'TDS' and inv_mas_product.year = '" . $currentyear . "'";
			$result2 = runmysqlquery($query2);
			$count_dealercard = mysqli_num_rows($result2);

			//Check if the Previous purchase year is same as current year 
			//OR a PIN already attached in dealercard for current year
			if ($previousyear == $currentyear || $count_dealercard > 0) {
				// Convey that, they have already taken a license for current year
				$message = "3^renewed";
			} else {
				//Get the details for renewal, including the price (Final tabular result)
				$query3 = "select renewal_edition_mapping_tds.upgradetoedition, mid(inv_customerproduct.computerid,4,2) as usagetype,if(mid(inv_customerproduct.computerid,4,2) = '00',inv_dealer_pricing.renewalsunewprice,inv_dealer_pricing.renewalmunewprice) as renewalnewprice, if(mid(inv_customerproduct.computerid,4,2) = '00',inv_dealer_pricing.renewalsuupactual,inv_dealer_pricing.renewalmuupactual) as renewalupactual, if(mid(inv_customerproduct.computerid,4,2) = '00',inv_dealer_pricing.renewalsuupdiscounted,inv_dealer_pricing.renewalmuupdiscounted) as renewalupdiscounted, renewal_edition_mapping_tds.upgradetocode from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) left join renewal_edition_mapping_tds on renewal_edition_mapping_tds.productcode = inv_mas_product.productcode left join inv_dealer_pricing on renewal_edition_mapping_tds.upgradetocode = inv_dealer_pricing.product where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'TDS' and inv_customerproduct.reregistration = 'no' and inv_mas_product.year = '" . $previousyear . "' group by inv_customerproduct.cardid";
				$result3 = runmysqlqueryfetch($query3);


			}
		}


		// Fetch the product that has to be updated 
		$query3 = "select inv_mas_product.productcode,inv_mas_product.productname,inv_mas_product.group,inv_mas_product.year,inv_customerproduct.date AS Date,substring(inv_customerproduct.computerid,4,2) as usagetype,renewal_edition_mapping_tds.upgradeto as edition,purchasetype  from inv_customerproduct 
left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode 
left join renewal_edition_mapping_tds on renewal_edition_mapping_tds.productname = inv_mas_product.productname 
where customerreference='" . $customerid . "' and reregistration = 'no' and inv_mas_product.group = 'TDS' and date = (select max(inv_customerproduct.date) from inv_customerproduct 
left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode 
where customerreference='" . $customerid . "' and reregistration = 'no' and inv_mas_product.group = 'TDS') order by date desc";

		//echo($query3);exit;

		$result3 = runmysqlquery($query3);
		$count = mysqli_num_rows($result3);
		if ($count > '0') {
			// Check if the product is of this year 
			$result3 = runmysqlqueryfetch($query3);
			if ($result3['year'] <> $year) {
				// Fetch latest product's product prices for updation 

				$query5 = "select * from inv_dealer_pricing left join inv_mas_product on inv_mas_product.productcode = inv_dealer_pricing.product where inv_mas_product.group = 'TDS' and inv_mas_product.year = '" . $year . "' and inv_dealer_pricing.productname like '%" . $result3['edition'] . "%' ";
				$result5 = runmysqlqueryfetch($query5);

				// Check if the product is already updated (i.e; if any card attached for the dealer for same product)

				$querycheck = "select * from inv_dealercard where customerreference ='" . $customerid . "' and productcode = '" . $result5['product'] . "';";

				$resultcheck = runmysqlquery($querycheck);
				$checkcount = mysqli_num_rows($resultcheck); //echo($checkcount.'^'.$querycheck); exit;

				if ($checkcount == '0') {
					// Now fetch total no of licences for the product 

					$query4 = "select substring(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on left(inv_customerproduct.computerid,3) = inv_mas_product.productcode where customerreference='" . $customerid . "' and reregistration = 'no' and inv_mas_product.group = 'TDS' 
		and inv_mas_product.productcode = '" . $result3['productcode'] . "'";

					$result4 = runmysqlquery($query4); // echo($query4);exit;

					$singleusercount = 0;
					$multiusercount = 0;

					while ($fetch4 = mysqli_fetch_array($result4)) {
						if ($fetch4['usagetype'] == '00') {
							$singleusercount++;
						} else if ($fetch4['usagetype'] == '09') {
							$multiusercount++;
						}
					}
					$productpricesu = 0;
					$renewalpricesu = 0;
					$actualpricesu = 0;
					$productpricemu = 0;
					$renewalpricemu = 0;
					$actualpricemu = 0;

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="4" style="border:1px solid #527094;">';
					$grid .= '<tr>';
					$grid .= '<td>';
					if ($singleusercount > '0') {
						$usagetype = 'singleuser';
						$productpricesu = $result5['renewalsuupactual'];
						$renewalpricesu = $result5['renewalsunewprice']; //echo($result5['renewalsuupactual']);exit;
						$actualpricesu = $result5['renewalsuupdiscounted'];

						// Grid for single user
						$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" >';
						$grid .= '<tr>';
						$grid .= '<td><div align="left" style="color:#666666; font-size:12px"><strong>TDS Products : Renew for Year ' . $year . '</strong> </div></td>';
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td>';
						$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
						$grid .= '<tr>';
						$grid .= '<td  width = "49%"><table width="100%" border="0" cellspacing="0" cellpadding="4">';
						$grid .= '<tr>';
						$grid .= '<td  bgcolor = "#EDF4FF"> Product :</td>';
						$grid .= '<td  bgcolor = "#EDF4FF">' . $result3['productname'] . '</td>';
						$grid .= '</tr>';
						$grid .= '</table></td>';
						$grid .= '<td width = "2%">&nbsp;</td>';
						$grid .= '<td valign="top" width = "49%"><table width="100%" border="0" cellspacing="0" cellpadding="4">';
						$grid .= '<tr>';
						$grid .= '<td bgcolor = "#EDF4FF" width = "40%">Previous Year : </td>';
						$grid .= '<td bgcolor = "#EDF4FF" width = "60%">' . $result3['year'] . '</td>';
						$grid .= '</tr>';
						$grid .= '</table></td>';
						$grid .= '</tr>';
						$grid .= '</table>';
						$grid .= '</td>';
						$grid .= '</tr>';

						$grid .= '</table>';
					}
					if ($multiusercount > '0') {
						//echo('here');exit;
						$usagetype = 'multiuser';
						$productpricemu = $result5['renewalmuupactual'];
						$renewalpricemu = $result5['renewalmunewprice'];
						$actualpricemu = $result5['renewalmuupdiscounted'];

						$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td>&nbsp;</td></tr></table>
';
						$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" >';
						if ($singleusercount == '0') {
							$grid .= '<tr>';
							$grid .= '<td><div align="left" style="color:#666666; font-size:12px"><strong>TDS Products : Renew for Year ' . $year . '</strong> </div></td>';
							$grid .= '</tr>';

							$grid .= '<tr>';
							$grid .= '<td>';
							$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="0">';
							$grid .= '<tr>';
							$grid .= '<td  width = "50%"><table width="100%" border="0" cellspacing="0" cellpadding="4">';
							$grid .= '<tr>';
							$grid .= '<td  bgcolor = "#EDF4FF"> Product :</td>';
							$grid .= '<td  bgcolor = "#EDF4FF">' . $result3['productname'] . '</td>';
							$grid .= '</tr>';
							$grid .= '</table></td>';
							$grid .= '<td valign="top" width = "50%"><table width="100%" border="0" cellspacing="0" cellpadding="4">';
							$grid .= '<tr>';
							$grid .= '<td bgcolor = "#EDF4FF" width = "40%">Previous Year : </td>';
							$grid .= '<td bgcolor = "#EDF4FF" width = "60%">' . $result3['year'] . '</td>';
							$grid .= '</tr>';
							$grid .= '</table></td>';
							$grid .= '</tr>';
							$grid .= '</table>';
							$grid .= '</td>';
							$grid .= '</tr>';
							$grid .= '</table>';
						}
					}
					// Display amount details in grid.
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td><div align="left" style="color:#666666; font-size:11px"><strong>Number of Licences :</strong></div></td></tr></table>';

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';

					// Display all single user licences
					$slno = 0;
					$usertypes = '';
					$total = 0;
					for ($i = 0; $i < $singleusercount; $i++) {
						if ($usertypes == '')
							$usertypes = 'singleuser';
						else
							$usertypes .= ',' . 'singleuser';
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $result3['edition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Single User</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $productpricesu . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $renewalpricesu . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $actualpricesu . '</td>';
						$grid .= '</tr>';

						$total = $total + $actualpricesu;
					}
					for ($i = 0; $i < $multiusercount; $i++) {
						if ($usertypes == '')
							$usertypes = 'multiuser';
						else
							$usertypes .= ',' . 'multiuser';
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $result3['edition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Multi User</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $productpricemu . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $renewalpricemu . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $actualpricemu . '</td>';
						$grid .= '</tr>';

						$total = $total + $actualpricemu;
					}
					$grid .= '</table>';

					// Calculate Prices and display

					$tax = roundnearest($total * (0.103));
					$netamount = $total + $tax;


					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $total . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Service Tax @ 10.3% :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $tax . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right" class="sub_headingfont" onclick = "paynow(\'' . $usertypes . '\',' . $actualpricesu . ',' . $actualpricemu . ',' . $tax . ',' . $netamount . ',' . $result5['product'] . ')"><img src="../images/imax-arrow.jpg" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';

					$grid .= '</td></tr></table>';

					$message = '1^' . $grid;
				} else {
					$message = '2^renewed';
				}
			} else {
				$message = '2^renewed';
			}
		} else {
			$message = '2^renewed';
		}
		echo ($message);
		break;
}

function roundnearest($amount)
{
	$firstamount = round($amount, 1);
	$amount1 = round($firstamount);
	return $amount1;
}

?>