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
	case 'getdata': {
			//Define the year for which Renewals are needed
			//$yearforrenewal = "2012-13";
			//$yearforrenewal = "2018-19";
			$yearforrenewal = "2022-23";

			/*--------------------For GST -----------------------------*/

			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
		inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
		,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
		left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
		left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
		where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			//if($customer_gstno != "") {
			// $customer_gst_code = substr($customer_gstno, 0, 2);
			//}
			//else {
			//$customer_gst_code = $fetch_customer_details['state_gst_code'];
			// }
			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
				//$customer_gst_code = '';
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/

			/***************Ends**********************/

			// Ger the current Financial Year in YYYY-YY format
			//$currentyear = date('Y').'-'.(date('y')+1); 
			$currentyear = $yearforrenewal;

			//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
			$query1 = "select inv_mas_product.year,inv_mas_product.productcode,mid(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'TDS' and inv_customerproduct.reregistration = 'no' order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
			$result1 = runmysqlquery($query1); //echo($query1);exit;
			$count_customerproduct = mysqli_num_rows($result1);
			if ($count_customerproduct == 0) {
				$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" ><tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#FF0000><strong>You do not have any Saral TDS license for renewal.</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
				// Convey that, they do not have Saral TDS product license for renewal
				$message = "3^" . $grid;
			} else {
				//Fetch the previous year to a variable
				$fetch1 = mysqli_fetch_array($result1);
				$previousyear = $fetch1['year'];
				$productcode = $fetch1['productcode'];
				$usagetypecode = $fetch1['usagetype'];

				//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
				$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '" . $customerid . "' and inv_mas_product.group = 'TDS' and inv_mas_product.year = '" . $currentyear . "'";
				$result2 = runmysqlquery($query2);
				$count_dealercard = mysqli_num_rows($result2);

				//Check if the Previous purchase year is same as current year 
				//OR a PIN already attached in dealercard for current year
				if ($previousyear == $currentyear || $count_dealercard > 0) {
					//echo($previousyear.'s'.$currentyear.'s'.$count_dealercard);exit;
					$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#669966><strong>Saral TDS Products for year ' . $currentyear . ' Renewed !!</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
					// Convey that, they have already taken a license for current year
					$message = "2^" . $grid . '^' . $previousyear . '^' . $currentyear;
				} else {
					$query5 = "select subgroup from inv_mas_product where productcode = " . $productcode;
					$fetch5 = runmysqlqueryfetch($query5);
					$getsubgroup = $fetch5['subgroup'];


					$query4 = "select productcode from inv_mas_product where year = '" . $yearforrenewal . "' and subgroup = '" . $getsubgroup . "'";
					$fetch4 = runmysqlqueryfetch($query4);
					$newproductcode = $fetch4['productcode'];

					$result3 = getpricingdetails($newproductcode, $usagetypecode);
					//Get the details for renewal, including the price (Final tabular result)

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';
					$slno = 0;
					$total = 0;
					$upgardetoproduct = '';
					$pricearray = '';
					$usertypearray = '';
					while ($fetch3 = mysqli_fetch_array($result3)) {
						if ($upgardetoproduct == '')
							$upgardetoproduct = $fetch3['upgradetocode'];
						else
							$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
						if ($usertypearray == '') {
							if ($fetch3['usagetype'] == '00')
								$usertypearray = 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray = 'multiuser';
						} else {
							if ($fetch3['usagetype'] == '00')
								$usertypearray .= ',' . 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray .= ',' . 'multiuser';
						}

						if ($fetch3['usagetype'] == '00')
							$usagetype = 'Single User';
						else if ($fetch3['usagetype'] == '09')
							$usagetype = 'Multi User';

						if ($pricearray == '')
							$pricearray = $fetch3['renewalupdiscounted'];
						else
							$pricearray .= '*' . $fetch3['renewalupdiscounted'];

						$total = $total + $fetch3['renewalupdiscounted'];
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $fetch3['upgradetoedition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">' . $usagetype . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalnewprice'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalupactual'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $fetch3['renewalupdiscounted'] . '</td>';
						$grid .= '</tr>';
					}
					$currentdate = strtotime(date('Y-m-d'));
					$expirydate = strtotime('2012-04-04');
					if ($expirydate > $currentdate)
						$tax = roundnearest($total * (0.103));
					else
						$tax = roundnearest($total * (0.1236));

					/*---------------Tax for GSt-----------------*/
					$totalamount = $total;
					$total_tax = '';

					if ($customer_sez_enabled == 'yes') {
						$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
						$gst_type = 'SEZ';
						$total_tax = '0.00';
						$netamount = $total;
					} else {
						if ($customer_gst_code == '29') {
							$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
							$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

							$total_tax = $cgst_tax_amount + $sgst_tax_amount;

							$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
							$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
							$igst_tax_amount = '0.00';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount = $netamount;
							//$totalpricearray[] = $fetchresult[$i];
							$gst_type = 'CSGST';
						} else {
							$cgst_tax_amount = $sgst_tax_amount = '0.00';
							$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

							$total_tax = $igst_tax_amount;
							$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

							$gst_type = 'IGST';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount += $netamount;
							//$totalpricearray[] = $fetchresult[$i];
						}
					}

					$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

					/**************************Ends*************/


					//$netamount =  $total + $tax;

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $totalamount . '</td>';
					$grid .= '</tr>';
					if ($gst_type == 'CSGST') {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>CGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $cgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>SGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $sgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					} else {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>IGST @ 18% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $igst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					}

					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right"><input name="paynow1" type="button" class="swichchoicebutton" id="paynow1" value="Pay Now" onclick = "paynow()" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';
					$grid .= '</td></tr></table>';
					$message = '1^' . $grid . '^' . $previousyear . '^' . $currentyear . '^' . $newproductcode . '^' . $usagetypecode;
				}
			}
			echo ($message);
		}
		break;
	case 'getdatasto': {
			//Define the year for which Renewals are needed
			$yearforrenewal = "2022-23";

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
			inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
			,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
			left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
			left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
			where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			/*if($customer_gstno != "") {
						 $customer_gst_code = substr($customer_gstno,0,2);
					 }
					 else {
						 $customer_gst_code = $fetch_customer_details['state_gst_code'];
					 }*/
			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno,0,2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
				//$customer_gst_code = '';
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/

			/***************Ends**********************/

			// Ger the current Financial Year in YYYY-YY format
			//$currentyear = date('Y').'-'.(date('y')+1); 
			$currentyear = $yearforrenewal;
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
			$query1 = "select inv_mas_product.year,inv_mas_product.productcode,mid(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'STO' and inv_customerproduct.reregistration = 'no' and inv_mas_product.productcode not in ('368','369','370') order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
			$result1 = runmysqlquery($query1); //echo($query1);exit;
			$count_customerproduct = mysqli_num_rows($result1);
			if ($count_customerproduct == 0) {
				$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" ><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#FF0000><strong>You do not have any Saral TDS license for renewal.</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
				// Convey that, they do not have Saral TDS product license for renewal
				$message = "3^" . $grid;
			} else {
				//Fetch the previous year to a variable
				$fetch1 = mysqli_fetch_array($result1);
				$previousyear = $fetch1['year'];
				$productcode = $fetch1['productcode'];
				$usagetypecode = $fetch1['usagetype'];

				//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
				$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '" . $customerid . "' and inv_mas_product.group = 'STO' and inv_mas_product.year = '" . $currentyear . "'";
				$result2 = runmysqlquery($query2);
				$count_dealercard = mysqli_num_rows($result2);

				//Check if the Previous purchase year is same as current year 
				//OR a PIN already attached in dealercard for current year
				if ($previousyear == $currentyear || $count_dealercard > 0) {
					//echo($previousyear.'s'.$currentyear.'s'.$count_dealercard);exit;
					$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
					<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#669966><strong>Saral STO Products for year ' . $currentyear . ' Renewed !!</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
					// Convey that, they have already taken a license for current year
					$message = "2^" . $grid . '^' . $previousyear . '^' . $currentyear;
				} else {
					$query5 = "select subgroup from inv_mas_product where productcode = " . $productcode;
					$fetch5 = runmysqlqueryfetch($query5);
					$getsubgroup = $fetch5['subgroup'];


					$query4 = "select productcode from inv_mas_product where year = '" . $yearforrenewal . "' and subgroup = '" . $getsubgroup . "'";
					$fetch4 = runmysqlqueryfetch($query4);
					$newproductcode = $fetch4['productcode'];

					$result3 = getpricingdetails($newproductcode, $usagetypecode);
					//	echo($result3);
					//Get the details for renewal, including the price (Final tabular result)

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';
					$slno = 0;
					$total = 0;
					$upgardetoproduct = '';
					$pricearray = '';
					$usertypearray = '';
					while ($fetch3 = mysqli_fetch_array($result3)) {
						if ($upgardetoproduct == '')
							$upgardetoproduct = $fetch3['upgradetocode'];
						else
							$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
						if ($usertypearray == '') {
							if ($fetch3['usagetype'] == '00')
								$usertypearray = 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray = 'multiuser';
						} else {
							if ($fetch3['usagetype'] == '00')
								$usertypearray .= ',' . 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray .= ',' . 'multiuser';
						}

						if ($fetch3['usagetype'] == '00')
							$usagetype = 'Single User';
						else if ($fetch3['usagetype'] == '09')
							$usagetype = 'Multi User';

						if ($pricearray == '')
							$pricearray = $fetch3['renewalupdiscounted'];
						else
							$pricearray .= '*' . $fetch3['renewalupdiscounted'];

						$total = $total + $fetch3['renewalupdiscounted'];
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $fetch3['upgradetoedition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">' . $usagetype . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalnewprice'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalupactual'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $fetch3['renewalupdiscounted'] . '</td>';
						$grid .= '</tr>';
					}
					$currentdate = strtotime(date('Y-m-d'));
					$expirydate = strtotime('2012-04-01');
					if ($expirydate > $currentdate)
						$tax = roundnearest($total * (0.103));
					else
						$tax = roundnearest($total * (0.1236));

					/*---------------Tax for GSt-----------------*/
					$totalamount = $total;
					$total_tax = '';

					if ($customer_sez_enabled == 'yes') {
						$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
						$gst_type = 'SEZ';
						$total_tax = '0.00';
						$netamount = $total;
					} else {
						if ($customer_gst_code == '29') {
							$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
							$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

							$total_tax = $cgst_tax_amount + $sgst_tax_amount;

							$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
							$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
							$igst_tax_amount = '0.00';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount = $netamount;
							//$totalpricearray[] = $fetchresult[$i];
							$gst_type = 'CSGST';
						} else {
							$cgst_tax_amount = $sgst_tax_amount = '0.00';
							$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

							$total_tax = $igst_tax_amount;
							$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

							$gst_type = 'IGST';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount += $netamount;
							//$totalpricearray[] = $fetchresult[$i];
						}
					}

					$netamount = round($netamount); //((float)$netamount, 2, '.', '');			

					/**************************Ends*************/


					//$netamount =  $total + $tax;

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $totalamount . '</td>';
					$grid .= '</tr>';
					if ($gst_type == 'CSGST') {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>CGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $cgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>SGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $sgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					} else {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>IGST @ 18% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $igst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					}

					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right"><input name="paynow1" type="button" class="swichchoicebutton" id="paynow1" value="Pay Now" onclick = "paynowsto()" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';
					$grid .= '</td></tr></table>';
					$message = '1^' . $grid . '^' . $previousyear . '^' . $currentyear . '^' . $newproductcode . '^' . $usagetypecode;
				}
			}
			echo ($message);
		}
		break;
	case 'getdatasvi': {
			//Define the year for which Renewals are needed
			//$yearforrenewal = "2018-19";
			$yearforrenewal = "2022-23";

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
		inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
		,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
		left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
		left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
		where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			/*if($customer_gstno != "") {
					  $customer_gst_code = substr($customer_gstno, 0, 2);
				  }
				  else {
					  $customer_gst_code = $fetch_customer_details['state_gst_code'];
				  }*/
			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
				//$customer_gst_code = '';
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/

			/***************Ends**********************/

			// Ger the current Financial Year in YYYY-YY format
			//$currentyear = date('Y').'-'.(date('y')+1); 
			$currentyear = $yearforrenewal;

			//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
			$query1 = "select inv_mas_product.year,inv_mas_product.productcode,mid(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'SVI' and inv_customerproduct.reregistration = 'no' and inv_mas_product.productcode not in ('368','369','370') order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
			$result1 = runmysqlquery($query1); //echo($query1);exit;
			$count_customerproduct = mysqli_num_rows($result1);
			if ($count_customerproduct == 0) {
				$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" ><tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#FF0000><strong>You do not have any Saral SVI license for renewal.</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
				// Convey that, they do not have Saral TDS product license for renewal
				$message = "3^" . $grid;
			} else {
				//Fetch the previous year to a variable
				$fetch1 = mysqli_fetch_array($result1);
				$previousyear = $fetch1['year'];
				$productcode = $fetch1['productcode'];
				$usagetypecode = $fetch1['usagetype'];

				//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
				$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '" . $customerid . "' and inv_mas_product.group = 'SVI' and inv_mas_product.year = '" . $currentyear . "'";
				$result2 = runmysqlquery($query2);
				$count_dealercard = mysqli_num_rows($result2);

				//Check if the Previous purchase year is same as current year 
				//OR a PIN already attached in dealercard for current year
				if ($previousyear == $currentyear || $count_dealercard > 0) {
					//echo($previousyear.'s'.$currentyear.'s'.$count_dealercard);exit;
					$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#669966><strong>Saral SVI Products for year ' . $currentyear . ' Renewed !!</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
					// Convey that, they have already taken a license for current year
					$message = "2^" . $grid . '^' . $previousyear . '^' . $currentyear;
				} else {
					$query5 = "select subgroup from inv_mas_product where productcode = " . $productcode;
					$fetch5 = runmysqlqueryfetch($query5);
					$getsubgroup = $fetch5['subgroup'];


					$query4 = "select productcode from inv_mas_product where year = '" . $yearforrenewal . "' and subgroup = '" . $getsubgroup . "'";
					$fetch4 = runmysqlqueryfetch($query4);
					$newproductcode = $fetch4['productcode'];

					$result3 = getpricingdetails($newproductcode, $usagetypecode);
					//	echo($result3);
					//Get the details for renewal, including the price (Final tabular result)

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';
					$slno = 0;
					$total = 0;
					$upgardetoproduct = '';
					$pricearray = '';
					$usertypearray = '';
					while ($fetch3 = mysqli_fetch_array($result3)) {
						if ($upgardetoproduct == '')
							$upgardetoproduct = $fetch3['upgradetocode'];
						else
							$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
						if ($usertypearray == '') {
							if ($fetch3['usagetype'] == '00')
								$usertypearray = 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray = 'multiuser';
						} else {
							if ($fetch3['usagetype'] == '00')
								$usertypearray .= ',' . 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray .= ',' . 'multiuser';
						}

						if ($fetch3['usagetype'] == '00')
							$usagetype = 'Single User';
						else if ($fetch3['usagetype'] == '09')
							$usagetype = 'Multi User';

						if ($pricearray == '')
							$pricearray = $fetch3['renewalupdiscounted'];
						else
							$pricearray .= '*' . $fetch3['renewalupdiscounted'];

						$total = $total + $fetch3['renewalupdiscounted'];
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $fetch3['upgradetoedition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">' . $usagetype . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalnewprice'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalupactual'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $fetch3['renewalupdiscounted'] . '</td>';
						$grid .= '</tr>';
					}

					$currentdate = strtotime(date('Y-m-d'));
					$expirydate = strtotime('2012-04-01');
					if ($expirydate > $currentdate)
						$tax = roundnearest($total * (0.103));
					else
						$tax = roundnearest($total * (0.1236));

					/*---------------Tax for GSt-----------------*/
					$totalamount = $total;
					$total_tax = '';

					if ($customer_sez_enabled == 'yes') {
						$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
						$gst_type = 'SEZ';
						$total_tax = '0.00';
						$netamount = $total;
					} else {
						if ($customer_gst_code == '29') {
							$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
							$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

							$total_tax = $cgst_tax_amount + $sgst_tax_amount;

							$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
							$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
							$igst_tax_amount = '0.00';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount = $netamount;
							//$totalpricearray[] = $fetchresult[$i];
							$gst_type = 'CSGST';
						} else {
							$cgst_tax_amount = $sgst_tax_amount = '0.00';
							$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

							$total_tax = $igst_tax_amount;
							$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

							$gst_type = 'IGST';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount += $netamount;
							//$totalpricearray[] = $fetchresult[$i];
						}
					}

					$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

					/**************************Ends*************/
					//$netamount =  $total + $tax;

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $totalamount . '</td>';
					$grid .= '</tr>';
					if ($gst_type == 'CSGST') {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>CGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $cgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>SGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $sgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					} else {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>IGST @ 18% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $igst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					}

					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right"><input name="paynow1" type="button" class="swichchoicebutton" id="paynow1" value="Pay Now" onclick = "paynowsvi()" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';
					$grid .= '</td></tr></table>';
					$message = '1^' . $grid . '^' . $previousyear . '^' . $currentyear . '^' . $newproductcode . '^' . $usagetypecode;
				}
			}
			echo ($message);
		}
		break;
	case 'getdatasvh': {
			//Define the year for which Renewals are needed
			//$yearforrenewal = "2018-19";
			$yearforrenewal = "2022-23";

			/*--------------------For GST -----------------------------*/

			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
		inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
		,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
		left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
		left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
		where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			/* if($customer_gstno != "") {
					  $customer_gst_code = substr($customer_gstno, 0, 2);
				  }
				  else {
					  $customer_gst_code = $fetch_customer_details['state_gst_code'];
				  }*/

			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
				//$customer_gst_code = '';
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/
			/***************Ends**********************/

			// Ger the current Financial Year in YYYY-YY format
			//$currentyear = date('Y').'-'.(date('y')+1); 
			$currentyear = $yearforrenewal;

			//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
			$query1 = "select inv_mas_product.year,inv_mas_product.productcode,mid(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'SVH' and inv_customerproduct.reregistration = 'no' and inv_mas_product.productcode not in ('368','369','370') order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
			$result1 = runmysqlquery($query1); //echo($query1);exit;
			$count_customerproduct = mysqli_num_rows($result1);
			if ($count_customerproduct == 0) {
				$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" ><tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#FF0000><strong>You do not have any Saral SVH license for renewal.</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
				// Convey that, they do not have Saral TDS product license for renewal
				$message = "3^" . $grid;
			} else {
				//Fetch the previous year to a variable
				$fetch1 = mysqli_fetch_array($result1);
				$previousyear = $fetch1['year'];
				$productcode = $fetch1['productcode'];
				$usagetypecode = $fetch1['usagetype'];

				//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
				$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '" . $customerid . "' and inv_mas_product.group = 'SVH' and inv_mas_product.year = '" . $currentyear . "'";
				$result2 = runmysqlquery($query2);
				$count_dealercard = mysqli_num_rows($result2);

				//Check if the Previous purchase year is same as current year 
				//OR a PIN already attached in dealercard for current year
				if ($previousyear == $currentyear || $count_dealercard > 0) {
					//echo($previousyear.'s'.$currentyear.'s'.$count_dealercard);exit;
					$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#669966><strong>Saral SVH Products for year ' . $currentyear . ' Renewed !!</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
					// Convey that, they have already taken a license for current year
					$message = "2^" . $grid . '^' . $previousyear . '^' . $currentyear;
				} else {
					$query5 = "select subgroup from inv_mas_product where productcode = " . $productcode;
					$fetch5 = runmysqlqueryfetch($query5);
					$getsubgroup = $fetch5['subgroup'];


					$query4 = "select productcode from inv_mas_product where year = '" . $yearforrenewal . "' and subgroup = '" . $getsubgroup . "'";
					$fetch4 = runmysqlqueryfetch($query4);
					$newproductcode = $fetch4['productcode'];

					$result3 = getpricingdetails($newproductcode, $usagetypecode);
					//	echo($result3);
					//Get the details for renewal, including the price (Final tabular result)

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';
					$slno = 0;
					$total = 0;
					$upgardetoproduct = '';
					$pricearray = '';
					$usertypearray = '';
					while ($fetch3 = mysqli_fetch_array($result3)) {
						if ($upgardetoproduct == '')
							$upgardetoproduct = $fetch3['upgradetocode'];
						else
							$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
						if ($usertypearray == '') {
							if ($fetch3['usagetype'] == '00')
								$usertypearray = 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray = 'multiuser';
						} else {
							if ($fetch3['usagetype'] == '00')
								$usertypearray .= ',' . 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray .= ',' . 'multiuser';
						}

						if ($fetch3['usagetype'] == '00')
							$usagetype = 'Single User';
						else if ($fetch3['usagetype'] == '09')
							$usagetype = 'Multi User';

						if ($pricearray == '')
							$pricearray = $fetch3['renewalupdiscounted'];
						else
							$pricearray .= '*' . $fetch3['renewalupdiscounted'];

						$total = $total + $fetch3['renewalupdiscounted'];
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $fetch3['upgradetoedition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">' . $usagetype . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalnewprice'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalupactual'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $fetch3['renewalupdiscounted'] . '</td>';
						$grid .= '</tr>';
					}
					$currentdate = strtotime(date('Y-m-d'));
					$expirydate = strtotime('2012-04-01');
					if ($expirydate > $currentdate)
						$tax = roundnearest($total * (0.103));
					else
						$tax = roundnearest($total * (0.1236));

					/*---------------Tax for GSt-----------------*/
					$totalamount = $total;
					$total_tax = '';

					if ($customer_sez_enabled == 'yes') {
						$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
						$gst_type = 'SEZ';
						$total_tax = '0.00';
						$netamount = $total;
					} else {
						if ($customer_gst_code == '29') {
							$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
							$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

							$total_tax = $cgst_tax_amount + $sgst_tax_amount;

							$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
							$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
							$igst_tax_amount = '0.00';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount = $netamount;
							//$totalpricearray[] = $fetchresult[$i];
							$gst_type = 'CSGST';
						} else {
							$cgst_tax_amount = $sgst_tax_amount = '0.00';
							$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

							$total_tax = $igst_tax_amount;
							$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

							$gst_type = 'IGST';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount += $netamount;
							//$totalpricearray[] = $fetchresult[$i];
						}
					}

					$netamount = round($netamount); // number_format((float)$netamount, 2, '.', '');			

					/**************************Ends*************/

					//$netamount =  $total + $tax;

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $totalamount . '</td>';
					$grid .= '</tr>';
					if ($gst_type == 'CSGST') {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>CGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $cgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>SGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $sgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					} else {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>IGST @ 18% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $igst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					}

					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right"><input name="paynow1" type="button" class="swichchoicebutton" id="paynow1" value="Pay Now" onclick = "paynowsvh()" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';
					$grid .= '</td></tr></table>';
					$message = '1^' . $grid . '^' . $previousyear . '^' . $currentyear . '^' . $newproductcode . '^' . $usagetypecode;
				}
			}
			echo ($message);
		}
		break;
	case 'getdatagstn': {
			//Define the year for which Renewals are needed
			$yearforrenewal = "2022-23";

			/*--------------------For GST -----------------------------*/

			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
		inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
		,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
		left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
		left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
		where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			/*if($customer_gstno != "") {
					  $customer_gst_code = substr($customer_gstno, 0, 2);
				  }
				  else {
					  $customer_gst_code = $fetch_customer_details['state_gst_code'];
				  }*/
			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
				//$customer_gst_code = '';
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/

			/***************Ends**********************/

			// Ger the current Financial Year in YYYY-YY format
			//$currentyear = date('Y').'-'.(date('y')+1); 
			$currentyear = $yearforrenewal;
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
			$query1 = "select inv_mas_product.year,inv_mas_product.productcode,mid(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'GST' and inv_customerproduct.reregistration = 'no' and inv_mas_product.productcode not in ('368','369','370') order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
			$result1 = runmysqlquery($query1); //echo($query1);exit;
			$count_customerproduct = mysqli_num_rows($result1);
			if ($count_customerproduct == 0) {
				$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" ><tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#FF0000><strong>You do not have any Saral GST license for renewal.</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
				// Convey that, they do not have Saral TDS product license for renewal
				$message = "3^" . $grid;
			} else {
				//Fetch the previous year to a variable
				$fetch1 = mysqli_fetch_array($result1);
				$previousyear = $fetch1['year'];
				$productcode = $fetch1['productcode'];
				$usagetypecode = $fetch1['usagetype'];

				//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
				$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '" . $customerid . "' and inv_mas_product.group = 'GST' and inv_mas_product.year = '" . $currentyear . "'";
				$result2 = runmysqlquery($query2);
				$count_dealercard = mysqli_num_rows($result2);

				//Check if the Previous purchase year is same as current year 
				//OR a PIN already attached in dealercard for current year
				if ($previousyear == $currentyear || $count_dealercard > 0) {
					//echo($previousyear.'s'.$currentyear.'s'.$count_dealercard);exit;
					$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#669966><strong>Saral GST Products for year ' . $currentyear . ' Renewed !!</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
					// Convey that, they have already taken a license for current year
					$message = "2^" . $grid . '^' . $previousyear . '^' . $currentyear;
				} else {
					$query5 = "select subgroup from inv_mas_product where productcode = " . $productcode;
					$fetch5 = runmysqlqueryfetch($query5);
					$getsubgroup = $fetch5['subgroup'];


					$query4 = "select productcode from inv_mas_product where year = '" . $yearforrenewal . "' and subgroup = '" . $getsubgroup . "'";
					$fetch4 = runmysqlqueryfetch($query4);
					$newproductcode = $fetch4['productcode'];

					$result3 = getpricingdetails($newproductcode, $usagetypecode);
					//	echo($result3);
					//Get the details for renewal, including the price (Final tabular result)

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';
					$slno = 0;
					$total = 0;
					$upgardetoproduct = '';
					$pricearray = '';
					$usertypearray = '';
					while ($fetch3 = mysqli_fetch_array($result3)) {
						if ($upgardetoproduct == '')
							$upgardetoproduct = $fetch3['upgradetocode'];
						else
							$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
						if ($usertypearray == '') {
							if ($fetch3['usagetype'] == '00')
								$usertypearray = 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray = 'multiuser';
						} else {
							if ($fetch3['usagetype'] == '00')
								$usertypearray .= ',' . 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray .= ',' . 'multiuser';
						}

						if ($fetch3['usagetype'] == '00')
							$usagetype = 'Single User';
						else if ($fetch3['usagetype'] == '09')
							$usagetype = 'Multi User';

						if ($pricearray == '')
							$pricearray = $fetch3['renewalupdiscounted'];
						else
							$pricearray .= '*' . $fetch3['renewalupdiscounted'];

						$total = $total + $fetch3['renewalupdiscounted'];
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $fetch3['upgradetoedition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">' . $usagetype . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalnewprice'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalupactual'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $fetch3['renewalupdiscounted'] . '</td>';
						$grid .= '</tr>';
					}
					$currentdate = strtotime(date('Y-m-d'));
					$expirydate = strtotime('2012-04-01');
					if ($expirydate > $currentdate)
						$tax = roundnearest($total * (0.103));
					else
						$tax = roundnearest($total * (0.1236));

					/*---------------Tax for GSt-----------------*/
					$totalamount = $total;
					$total_tax = '';

					if ($customer_sez_enabled == 'yes') {
						$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
						$gst_type = 'SEZ';
						$total_tax = '0.00';
						$netamount = $total;
					} else {
						if ($customer_gst_code == '29') {
							$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
							$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

							$total_tax = $cgst_tax_amount + $sgst_tax_amount;

							$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
							$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
							$igst_tax_amount = '0.00';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount = $netamount;
							//$totalpricearray[] = $fetchresult[$i];
							$gst_type = 'CSGST';
						} else {
							$cgst_tax_amount = $sgst_tax_amount = '0.00';
							$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

							$total_tax = $igst_tax_amount;
							$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

							$gst_type = 'IGST';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount += $netamount;
							//$totalpricearray[] = $fetchresult[$i];
						}
					}

					$netamount = round($netamount); //((float)$netamount, 2, '.', '');			

					/**************************Ends*************/


					//$netamount =  $total + $tax;

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $totalamount . '</td>';
					$grid .= '</tr>';
					if ($gst_type == 'CSGST') {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>CGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $cgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>SGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $sgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					} else {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>IGST @ 18% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $igst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					}

					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right"><input name="paynow1" type="button" class="swichchoicebutton" id="paynow1" value="Pay Now" onclick = "paynowgstn()" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';
					$grid .= '</td></tr></table>';
					$message = '1^' . $grid . '^' . $previousyear . '^' . $currentyear . '^' . $newproductcode . '^' . $usagetypecode;
				}
			}
			echo ($message);
		}
		break;
	case 'getdataxbrl': {
			//Define the year for which Renewals are needed
			$yearforrenewal = "2022-23";

			/*--------------------For GST -----------------------------*/

			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
		inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
		,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
		left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
		left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
		where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			/*if($customer_gstno != "") {
					  $customer_gst_code = substr($customer_gstno, 0, 2);
				  }
				  else {
					  $customer_gst_code = $fetch_customer_details['state_gst_code'];
				  }*/
			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
				//$customer_gst_code = '';
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/

			/***************Ends**********************/

			// Ger the current Financial Year in YYYY-YY format
			//$currentyear = date('Y').'-'.(date('y')+1); 
			$currentyear = $yearforrenewal;
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			//Find the "Last Purchased year" by taking last registration record for TDS (Reregistration = No)
			$query1 = "select inv_mas_product.year,inv_mas_product.productcode,mid(inv_customerproduct.computerid,4,2) as usagetype from inv_customerproduct left join inv_mas_product on inv_mas_product.productcode = left(inv_customerproduct.computerid,3) where inv_customerproduct.customerreference = '" . $customerid . "' and inv_mas_product.group = 'XBRL' and inv_customerproduct.reregistration = 'no' and inv_mas_product.productcode not in ('368','369','370') order by inv_customerproduct.date desc, inv_customerproduct.time desc limit 1";
			$result1 = runmysqlquery($query1); //echo($query1);exit;
			$count_customerproduct = mysqli_num_rows($result1);
			if ($count_customerproduct == 0) {
				$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" ><tr><td>
			<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#FF0000><strong>You do not have any Saral XBRL license for renewal.</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
				// Convey that, they do not have Saral TDS product license for renewal
				$message = "3^" . $grid;
			} else {
				//Fetch the previous year to a variable
				$fetch1 = mysqli_fetch_array($result1);
				$previousyear = $fetch1['year'];
				$productcode = $fetch1['productcode'];
				$usagetypecode = $fetch1['usagetype'];

				//Check with dealercard table, so that no PIN is attached (and may not have got registered) for current year
				$query2 = "select * from inv_dealercard left join inv_mas_product on inv_mas_product.productcode = inv_dealercard.productcode where inv_dealercard.customerreference = '" . $customerid . "' and inv_mas_product.group = 'XBRL' and inv_mas_product.year = '" . $currentyear . "'";
				$result2 = runmysqlquery($query2);
				$count_dealercard = mysqli_num_rows($result2);

				//Check if the Previous purchase year is same as current year 
				//OR a PIN already attached in dealercard for current year
				if ($previousyear == $currentyear || $count_dealercard > 0) {
					//echo($previousyear.'s'.$currentyear.'s'.$count_dealercard);exit;
					$grid .= '<table width="95%" border="0" cellpadding="4" cellspacing="0" bordercolor="#527094"><tr><td>
				<table width="100%" border="0" cellpadding="0" cellspacing="0" ><tr> <td width="77%" valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="5" ><tr><td ><div align="center" style = "font-size:16px"><font color=#669966><strong>Saral XBRL Products for year ' . $currentyear . ' Renewed !!</strong></font></div></td></tr></table></td></tr></table></td></tr></table>';
					// Convey that, they have already taken a license for current year
					$message = "2^" . $grid . '^' . $previousyear . '^' . $currentyear;
				} else {
					$query5 = "select subgroup from inv_mas_product where productcode = " . $productcode;
					$fetch5 = runmysqlqueryfetch($query5);
					$getsubgroup = $fetch5['subgroup'];


					$query4 = "select productcode from inv_mas_product where year = '" . $yearforrenewal . "' and subgroup = '" . $getsubgroup . "'";
					$fetch4 = runmysqlqueryfetch($query4);
					$newproductcode = $fetch4['productcode'];

					$result3 = getpricingdetails($newproductcode, $usagetypecode);
					//	echo($result3);
					//Get the details for renewal, including the price (Final tabular result)

					$grid = '<table width="98%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
					$grid .= '<tr class = "tdheaderclass">';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Edition</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Usage Type</td>';
					$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">New Price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Renewal price</td>';
					$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Discounted Price</td>';
					$grid .= '</tr>';
					$slno = 0;
					$total = 0;
					$upgardetoproduct = '';
					$pricearray = '';
					$usertypearray = '';
					while ($fetch3 = mysqli_fetch_array($result3)) {
						if ($upgardetoproduct == '')
							$upgardetoproduct = $fetch3['upgradetocode'];
						else
							$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
						if ($usertypearray == '') {
							if ($fetch3['usagetype'] == '00')
								$usertypearray = 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray = 'multiuser';
						} else {
							if ($fetch3['usagetype'] == '00')
								$usertypearray .= ',' . 'singleuser';
							else if ($fetch3['usagetype'] == '09')
								$usertypearray .= ',' . 'multiuser';
						}

						if ($fetch3['usagetype'] == '00')
							$usagetype = 'Single User';
						else if ($fetch3['usagetype'] == '09')
							$usagetype = 'Multi User';

						if ($pricearray == '')
							$pricearray = $fetch3['renewalupdiscounted'];
						else
							$pricearray .= '*' . $fetch3['renewalupdiscounted'];

						$total = $total + $fetch3['renewalupdiscounted'];
						$slno++;
						$grid .= '<tr >';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $slno . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >' . $fetch3['upgradetoedition'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">' . $usagetype . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalnewprice'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" style="color:#cccccc">' . $fetch3['renewalupactual'] . '</td>';
						$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">' . $fetch3['renewalupdiscounted'] . '</td>';
						$grid .= '</tr>';
					}
					$currentdate = strtotime(date('Y-m-d'));
					$expirydate = strtotime('2012-04-01');
					if ($expirydate > $currentdate)
						$tax = roundnearest($total * (0.103));
					else
						$tax = roundnearest($total * (0.1236));

					/*---------------Tax for GSt-----------------*/
					$totalamount = $total;
					$total_tax = '';

					if ($customer_sez_enabled == 'yes') {
						$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
						$gst_type = 'SEZ';
						$total_tax = '0.00';
						$netamount = $total;
					} else {
						if ($customer_gst_code == '29') {
							$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
							$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

							$total_tax = $cgst_tax_amount + $sgst_tax_amount;

							$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
							$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
							$igst_tax_amount = '0.00';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount = $netamount;
							//$totalpricearray[] = $fetchresult[$i];
							$gst_type = 'CSGST';
						} else {
							$cgst_tax_amount = $sgst_tax_amount = '0.00';
							$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

							$total_tax = $igst_tax_amount;
							$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

							$gst_type = 'IGST';

							$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
							//$totalamount += $netamount;
							//$totalpricearray[] = $fetchresult[$i];
						}
					}

					$netamount = round($netamount); //((float)$netamount, 2, '.', '');			

					/**************************Ends*************/

					//$netamount =  $total + $tax;

					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="0" align = "center"><tr><td>&nbsp;</td></tr><tr><td>&nbsp;</td></tr></table>';
					$grid .= '<div align = "right" style = "font-size:12px">';
					$grid .= '<table width="98%" border="0" cellspacing="0" cellpadding="4" align = "right">';
					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Total Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $totalamount . '</td>';
					$grid .= '</tr>';
					if ($gst_type == 'CSGST') {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>CGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $cgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>SGST @ 9% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $sgst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					} else {
						$grid .= '<tr>';
						$grid .= '<td width="60%">&nbsp;</td>';
						$grid .= '<td width="30%" align="right"><strong>IGST @ 18% :</strong></td>';
						$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
						$grid .= '<td width="7%" align="right">' . $igst_tax_amount . '</td>'; //for gst
						$grid .= '</tr>';
					}

					$grid .= '<tr>';
					$grid .= '<td width="60%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"><strong>Net Amount :</strong></td>';
					$grid .= '<td width="3%" align="right"><img src="../images/relyon-rupee-small.jpg" /></td>';
					$grid .= '<td width="7%" align="right">' . $netamount . '</td>';
					$grid .= '</tr>';
					$grid .= '<tr>';
					$grid .= '<td width="50%">&nbsp;</td>';
					$grid .= '<td width="30%" align="right"></td>';
					$grid .= '<td width="20%" colspan = "2"><div align = "right"><input name="paynow1" type="button" class="swichchoicebutton" id="paynow1" value="Pay Now" onclick = "paynowxbrl()" /></div></td>';
					$grid .= '</tr>';
					$grid .= '</table>';
					$grid .= '</div>';
					$grid .= '</td></tr></table>';
					$message = '1^' . $grid . '^' . $previousyear . '^' . $currentyear . '^' . $newproductcode . '^' . $usagetypecode;
				}
			}
			echo ($message);
		}
		break;
	case 'preonlinedata': {

			/*--------------------For GST -----------------------------*/

			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
		inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
		,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
		left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
		left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
		where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			if ($customer_gstno != "" || !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/



			/***************Ends**********************/


			$productcode = $_POST['productcodehidden'];
			$usagetypecode = $_POST['productusagetype'];
			$result3 = getpricingdetails($productcode, $usagetypecode);
			$total = 0;
			$upgardetoproduct = '';
			$pricearray = '';
			$actualpricearray = '';
			$usertypearray = '';
			while ($fetch3 = mysqli_fetch_array($result3)) {
				if ($upgardetoproduct == '')
					$upgardetoproduct = $fetch3['upgradetocode'];
				else
					$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
				if ($usertypearray == '') {
					if ($fetch3['usagetype'] == '00')
						$usertypearray = 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray = 'multiuser';
				} else {
					if ($fetch3['usagetype'] == '00')
						$usertypearray .= ',' . 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray .= ',' . 'multiuser';
				}

				if ($pricearray == '')
					$pricearray = $fetch3['renewalupdiscounted'];
				else
					$pricearray .= '*' . $fetch3['renewalupdiscounted'];

				if ($actualpricearray == '')
					$actualpricearray = $fetch3['renewalupactual'];
				else
					$actualpricearray .= '*' . $fetch3['renewalupactual'];

				$total = $total + $fetch3['renewalupdiscounted'];
			}
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			if ($expirydate > $currentdate)
				$tax = roundnearest($total * (0.103));
			else
				$tax = roundnearest($total * (0.1236));

			/*---------------Tax for GSt-----------------*/
			$totalamount = $total;
			$total_tax = '';

			if ($customer_sez_enabled == 'yes') {
				$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
				$gst_type = 'SEZ';
				$total_tax = '0.00';
				$netamount = $total;
			} else {
				if ($customer_gst_code == '29') {
					$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
					$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

					$total_tax = $cgst_tax_amount + $sgst_tax_amount;

					$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
					$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
					$igst_tax_amount = '0.00';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount = $netamount;
					//$totalpricearray[] = $fetchresult[$i];
					$gst_type = 'CSGST';
				} else {
					$cgst_tax_amount = $sgst_tax_amount = '0.00';
					$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

					$total_tax = $igst_tax_amount;
					$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

					$gst_type = 'IGST';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount += $netamount;
					//$totalpricearray[] = $fetchresult[$i];
				}
			}

			$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

			/**************************Ends*************/

			//$netamount =  $total + $tax;

			//$netamount =  $total + $tax;
			$usertypes = $usertypearray;
			$prices = $pricearray;
			$servicetax = '0.00';
			$product = $upgardetoproduct;

			$total = $netamount;  //echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;

			$splitusertypes = explode(',', $usertypes);

			$productarray = explode('#', $product);
			$allproducts = '';
			for ($i = 0; $i < count($productarray); $i++) {
				if ($allproducts == '')
					$allproducts = $productarray[$i];
				else
					$allproducts .= '#' . $productarray[$i];
			}
			// Add all the prices 
			$pricearray = explode('*', $prices);
			$totalquantity = count($productarray);
			for ($i = 0; $i < count($pricearray); $i++) {
				$amount = $amount + $pricearray[$i];
			}

			//echo($amount); exit;

			// Fetch customer deatails to insert.
			$query1 = "select *,inv_mas_customercategory.slno as category,inv_mas_customertype.slno as type from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '" . $customerid . "';";
			$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;

			// Fetch Contact Details
			$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
		GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '" . $customerid . "'  group by customerid ";
			$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);

			$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
			$phoneres = removedoublecomma($resultcontactdetails['phone']);
			$cellres = removedoublecomma($resultcontactdetails['cell']);
			$emailidres = removedoublecomma($resultcontactdetails['emailid']);

			// Fetch all other details 
			$phonenumber = explode(',', $phoneres);
			$phone = $phonenumber[0];
			$cellnumber = explode(',', $cellres);
			$cell = $cellnumber[0];
			$businessname = $fetch['businessname'];
			$address = addslashes($fetch['address']);
			$place = $fetch['place'];
			$district = $fetch['districtcode'];
			$state = $fetch['statename'];
			$pincode = $fetch['pincode'];
			$contactperson = trim($contactvalues, ',');
			$stdcode = $fetch['stdcode'];
			$phone = $phonenumber[0];
			$fax = $fetch['fax'];
			$cell = $cellnumber[0];
			$emailid = trim($resultantemailid, ',');
			$category = $fetch['inv_mas_customercategory.slno'];
			$type = $fetch['type'];
			$currentdealer = $fetch['currentdealer'];
			$customertype = ($fetch['customertype'] == '') ? 'Not Available' : $fetch['customertype'];
			$customercategory = ($fetch['businesstype'] == '') ? 'Not Available' : $fetch['businesstype'];

			$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type'";
			$result22 = runmysqlqueryfetch($query22);
			if ($result22['count'] == 0) {
				$resultantemailid = trim($emailidres, ',');
			} else {
				// Fetch of contact details, from pending request table if any
				$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
				$resultcontactpending = runmysqlqueryfetch($querycontactpending);

				$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);

				$finalemailid = $emailidres . ',' . $emailidpending;
				$resultantemailid = remove_duplicates($finalemailid);
			}
			//Fetch the max slno from dealer online purchase table
			$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
			$fetchcount = runmysqlqueryfetch($countquery);
			$slnotobeinserted = $fetchcount['slnotobeinserted'];
			$duedate = date('Y-m-d');

			//Insert the purchase details in dealer online purchase table
			$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,
		stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax,sbtax,kktax, products, paymentdate, paymenttime, purchasetype,
		paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,
		createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,
		serviceamount,paymenttypeselected,paymentmode,actualproductprice,duedate,privatenote,podate,poreference,productbriefdescription,itembriefdescription,
		seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,igst,cgst,sgst)
		values
		('" . $slnotobeinserted . "','" . $customerid . "','" . $businessname . "','" . $address . "','" . $place . "','" . $district . "','" . $state . "','" . $pincode . "','" . $contactperson . "',
		'" . $stdcode . "','" . $phone . "','" . $fax . "','" . $cell . "','" . $resultantemailid . "','" . $customercategory . "','" . $customertype . "','" . $currentdealer . "','" . $amount . "','" . $total . "',
		'" . $servicetax . "','0.00','0.00','" . $allproducts . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','updation','credit/debit','" . $usertypes . "','','','',
		'None','Payment received through Credit/Debit card.','" . $totalquantity . "','default','0','" . $prices . "','" . $customerid . "','" . $_SERVER['REMOTE_ADDR'] . "',
		'" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $customerid . "','" . $amount . "','','customer_module','',
		'','paymentmadenow','credit/debit','" . $actualpricearray . "','" . $duedate . "','','0000-00-00','Not Avaliable','Not Avaliable','','','','','','" . $igst_tax_amount . "',
		'" . $cgst_tax_amount . "','" . $sgst_tax_amount . "')";
			$result2 = runmysqlquery($query2);

			echo ('1^' . $slnotobeinserted);
		}
		break;

	case 'preonlinedatasto': {

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
                                    inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
                                    ,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
                                    left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
                                    left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
                                    where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);

			$customer_gstno = $fetch_customer_details['customer_gstno'];

			if ($customer_gstno != "" || !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/



			/***************Ends**********************/

			$productcode = $_POST['productcodehidden'];
			$usagetypecode = $_POST['productusagetype'];
			$result3 = getpricingdetails($productcode, $usagetypecode);
			$total = 0;
			$upgardetoproduct = '';
			$pricearray = '';
			$actualpricearray = '';
			$usertypearray = '';
			while ($fetch3 = mysqli_fetch_array($result3)) {
				if ($upgardetoproduct == '')
					$upgardetoproduct = $fetch3['upgradetocode'];
				else
					$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
				if ($usertypearray == '') {
					if ($fetch3['usagetype'] == '00')
						$usertypearray = 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray = 'multiuser';
				} else {
					if ($fetch3['usagetype'] == '00')
						$usertypearray .= ',' . 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray .= ',' . 'multiuser';
				}

				if ($pricearray == '')
					$pricearray = $fetch3['renewalupdiscounted'];
				else
					$pricearray .= '*' . $fetch3['renewalupdiscounted'];

				if ($actualpricearray == '')
					$actualpricearray = $fetch3['renewalupactual'];
				else
					$actualpricearray .= '*' . $fetch3['renewalupactual'];

				$total = $total + $fetch3['renewalupdiscounted'];
			}
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			if ($expirydate > $currentdate)
				$tax = roundnearest($total * (0.103));
			else
				$tax = roundnearest($total * (0.1236));

			/*---------------Tax for GSt-----------------*/
			$totalamount = $total;
			$total_tax = '';

			if ($customer_sez_enabled == 'yes') {
				$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
				$gst_type = 'SEZ';
				$total_tax = '0.00';
				$netamount = $total;
			} else {
				if ($customer_gst_code == '29') {
					$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
					$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

					$total_tax = $cgst_tax_amount + $sgst_tax_amount;

					$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
					$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
					$igst_tax_amount = '0.00';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount = $netamount;
					//$totalpricearray[] = $fetchresult[$i];
					$gst_type = 'CSGST';
				} else {
					$cgst_tax_amount = $sgst_tax_amount = '0.00';
					$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

					$total_tax = $igst_tax_amount;
					$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

					$gst_type = 'IGST';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount += $netamount;
					//$totalpricearray[] = $fetchresult[$i];
				}
			}

			$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

			/**************************Ends*************/


			//$netamount =  $total + $tax;

			//$netamount =  $total + $tax;
			$usertypes = $usertypearray;
			$prices = $pricearray;
			$servicetax = '0.00';
			$product = $upgardetoproduct;

			$total = $netamount;  //echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;

			$splitusertypes = explode(',', $usertypes);

			$productarray = explode('#', $product);
			$allproducts = '';
			for ($i = 0; $i < count($productarray); $i++) {
				if ($allproducts == '')
					$allproducts = $productarray[$i];
				else
					$allproducts .= '#' . $productarray[$i];
			}
			// Add all the prices 
			$pricearray = explode('*', $prices);
			$totalquantity = count($productarray);
			for ($i = 0; $i < count($pricearray); $i++) {
				$amount = $amount + $pricearray[$i];
			}

			//echo($amount); exit;

			// Fetch customer deatails to insert.
			$query1 = "select *,inv_mas_customercategory.slno as category,inv_mas_customertype.slno as type from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '" . $customerid . "';";
			$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;

			// Fetch Contact Details
			$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
		GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '" . $customerid . "'  group by customerid ";
			$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);

			$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
			$phoneres = removedoublecomma($resultcontactdetails['phone']);
			$cellres = removedoublecomma($resultcontactdetails['cell']);
			$emailidres = removedoublecomma($resultcontactdetails['emailid']);

			// Fetch all other details 
			$phonenumber = explode(',', $phoneres);
			$phone = $phonenumber[0];
			$cellnumber = explode(',', $cellres);
			$cell = $cellnumber[0];
			$businessname = $fetch['businessname'];
			$address = addslashes($fetch['address']);
			$place = $fetch['place'];
			$district = $fetch['districtcode'];
			$state = $fetch['statename'];
			$pincode = $fetch['pincode'];
			$contactperson = trim($contactvalues, ',');
			$stdcode = $fetch['stdcode'];
			$phone = $phonenumber[0];
			$fax = $fetch['fax'];
			$cell = $cellnumber[0];
			$emailid = trim($resultantemailid, ',');
			$category = $fetch['inv_mas_customercategory.slno'];
			$type = $fetch['type'];
			$currentdealer = $fetch['currentdealer'];
			$customertype = ($fetch['customertype'] == '') ? 'Not Available' : $fetch['customertype'];
			$customercategory = ($fetch['businesstype'] == '') ? 'Not Available' : $fetch['businesstype'];

			$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type'";
			$result22 = runmysqlqueryfetch($query22);
			if ($result22['count'] == 0) {
				$resultantemailid = trim($emailidres, ',');
			} else {
				// Fetch of contact details, from pending request table if any
				$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
				$resultcontactpending = runmysqlqueryfetch($querycontactpending);

				$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);

				$finalemailid = $emailidres . ',' . $emailidpending;
				$resultantemailid = remove_duplicates($finalemailid);
			}
			//Fetch the max slno from dealer online purchase table
			$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
			$fetchcount = runmysqlqueryfetch($countquery);
			$slnotobeinserted = $fetchcount['slnotobeinserted'];
			$duedate = date('Y-m-d');

			//Insert the purchase details in dealer online purchase table
			$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,
			stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax,sbtax,kktax, products, paymentdate, paymenttime, purchasetype,
			paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,
			createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,
			serviceamount,paymenttypeselected,paymentmode,actualproductprice,duedate,privatenote,podate,poreference,productbriefdescription,itembriefdescription,
			seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,igst,cgst,sgst)
			values
			('" . $slnotobeinserted . "','" . $customerid . "','" . $businessname . "','" . $address . "','" . $place . "','" . $district . "','" . $state . "','" . $pincode . "','" . $contactperson . "',
			'" . $stdcode . "','" . $phone . "','" . $fax . "','" . $cell . "','" . $resultantemailid . "','" . $customercategory . "','" . $customertype . "','" . $currentdealer . "','" . $amount . "','" . $total . "',
			'" . $servicetax . "','0.00','0.00','" . $allproducts . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','updation','credit/debit','" . $usertypes . "','','','',
			'None','Payment received through Credit/Debit card.','" . $totalquantity . "','default','0','" . $prices . "','" . $customerid . "','" . $_SERVER['REMOTE_ADDR'] . "',
			'" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $customerid . "','" . $amount . "','','customer_module','',
			'','paymentmadenow','credit/debit','" . $actualpricearray . "','" . $duedate . "','','0000-00-00','Not Avaliable','Not Avaliable','','','','','','" . $igst_tax_amount . "',
			'" . $cgst_tax_amount . "','" . $sgst_tax_amount . "')";
			$result2 = runmysqlquery($query2);



		}
		echo ('1^' . $slnotobeinserted);
		break;
	case 'preonlinedatasvi': {

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
                                    inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
                                    ,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
                                    left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
                                    left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
                                    where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			if ($customer_gstno != "" || !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/



			/***************Ends**********************/


			$productcode = $_POST['productcodehidden'];
			$usagetypecode = $_POST['productusagetype'];
			$result3 = getpricingdetails($productcode, $usagetypecode);
			$total = 0;
			$upgardetoproduct = '';
			$pricearray = '';
			$actualpricearray = '';
			$usertypearray = '';
			while ($fetch3 = mysqli_fetch_array($result3)) {
				if ($upgardetoproduct == '')
					$upgardetoproduct = $fetch3['upgradetocode'];
				else
					$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
				if ($usertypearray == '') {
					if ($fetch3['usagetype'] == '00')
						$usertypearray = 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray = 'multiuser';
				} else {
					if ($fetch3['usagetype'] == '00')
						$usertypearray .= ',' . 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray .= ',' . 'multiuser';
				}

				if ($pricearray == '')
					$pricearray = $fetch3['renewalupdiscounted'];
				else
					$pricearray .= '*' . $fetch3['renewalupdiscounted'];

				if ($actualpricearray == '')
					$actualpricearray = $fetch3['renewalupactual'];
				else
					$actualpricearray .= '*' . $fetch3['renewalupactual'];

				$total = $total + $fetch3['renewalupdiscounted'];
			}
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			if ($expirydate > $currentdate)
				$tax = roundnearest($total * (0.103));
			else
				$tax = roundnearest($total * (0.1236));

			/*---------------Tax for GSt-----------------*/
			$totalamount = $total;
			$total_tax = '';

			if ($customer_sez_enabled == 'yes') {
				$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
				$gst_type = 'SEZ';
				$total_tax = '0.00';
				$netamount = $total;
			} else {
				if ($customer_gst_code == '29') {
					$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
					$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

					$total_tax = $cgst_tax_amount + $sgst_tax_amount;

					$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
					$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
					$igst_tax_amount = '0.00';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount = $netamount;
					//$totalpricearray[] = $fetchresult[$i];
					$gst_type = 'CSGST';
				} else {
					$cgst_tax_amount = $sgst_tax_amount = '0.00';
					$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

					$total_tax = $igst_tax_amount;
					$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

					$gst_type = 'IGST';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount += $netamount;
					//$totalpricearray[] = $fetchresult[$i];
				}
			}

			$netamount = round($netamount); // number_format((float)$netamount, 2, '.', '');			

			/**************************Ends*************/


			//$netamount =  $total + $tax;

			//$netamount =  $total + $tax;
			$usertypes = $usertypearray;
			$prices = $pricearray;
			$servicetax = '0.00';
			$product = $upgardetoproduct;

			$total = $netamount;  //echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;

			$splitusertypes = explode(',', $usertypes);

			$productarray = explode('#', $product);
			$allproducts = '';
			for ($i = 0; $i < count($productarray); $i++) {
				if ($allproducts == '')
					$allproducts = $productarray[$i];
				else
					$allproducts .= '#' . $productarray[$i];
			}
			// Add all the prices 
			$pricearray = explode('*', $prices);
			$totalquantity = count($productarray);
			for ($i = 0; $i < count($pricearray); $i++) {
				$amount = $amount + $pricearray[$i];
			}

			//echo($amount); exit;

			// Fetch customer deatails to insert.
			$query1 = "select *,inv_mas_customercategory.slno as category,inv_mas_customertype.slno as type from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '" . $customerid . "';";
			$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;

			// Fetch Contact Details
			$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
		GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '" . $customerid . "'  group by customerid ";
			$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);

			$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
			$phoneres = removedoublecomma($resultcontactdetails['phone']);
			$cellres = removedoublecomma($resultcontactdetails['cell']);
			$emailidres = removedoublecomma($resultcontactdetails['emailid']);

			// Fetch all other details 
			$phonenumber = explode(',', $phoneres);
			$phone = $phonenumber[0];
			$cellnumber = explode(',', $cellres);
			$cell = $cellnumber[0];
			$businessname = $fetch['businessname'];
			$address = addslashes($fetch['address']);
			$place = $fetch['place'];
			$district = $fetch['districtcode'];
			$state = $fetch['statename'];
			$pincode = $fetch['pincode'];
			$contactperson = trim($contactvalues, ',');
			$stdcode = $fetch['stdcode'];
			$phone = $phonenumber[0];
			$fax = $fetch['fax'];
			$cell = $cellnumber[0];
			$emailid = trim($resultantemailid, ',');
			$category = $fetch['inv_mas_customercategory.slno'];
			$type = $fetch['type'];
			$currentdealer = $fetch['currentdealer'];
			$customertype = ($fetch['customertype'] == '') ? 'Not Available' : $fetch['customertype'];
			$customercategory = ($fetch['businesstype'] == '') ? 'Not Available' : $fetch['businesstype'];

			$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type'";
			$result22 = runmysqlqueryfetch($query22);
			if ($result22['count'] == 0) {
				$resultantemailid = trim($emailidres, ',');
			} else {
				// Fetch of contact details, from pending request table if any
				$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
				$resultcontactpending = runmysqlqueryfetch($querycontactpending);

				$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);

				$finalemailid = $emailidres . ',' . $emailidpending;
				$resultantemailid = remove_duplicates($finalemailid);
			}
			//Fetch the max slno from dealer online purchase table
			$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
			$fetchcount = runmysqlqueryfetch($countquery);
			$slnotobeinserted = $fetchcount['slnotobeinserted'];
			$duedate = date('Y-m-d');

			//Insert the purchase details in dealer online purchase table
			$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,
			stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax,sbtax,kktax, products, paymentdate, paymenttime, purchasetype,
			paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,
			createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,
			serviceamount,paymenttypeselected,paymentmode,actualproductprice,duedate,privatenote,podate,poreference,productbriefdescription,itembriefdescription,
			seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,igst,cgst,sgst)
			values
			('" . $slnotobeinserted . "','" . $customerid . "','" . $businessname . "','" . $address . "','" . $place . "','" . $district . "','" . $state . "','" . $pincode . "','" . $contactperson . "',
			'" . $stdcode . "','" . $phone . "','" . $fax . "','" . $cell . "','" . $resultantemailid . "','" . $customercategory . "','" . $customertype . "','" . $currentdealer . "','" . $amount . "','" . $total . "',
			'" . $servicetax . "','0.00','0.00','" . $allproducts . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','updation','credit/debit','" . $usertypes . "','','','',
			'None','Payment received through Credit/Debit card.','" . $totalquantity . "','default','0','" . $prices . "','" . $customerid . "','" . $_SERVER['REMOTE_ADDR'] . "',
			'" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $customerid . "','" . $amount . "','','customer_module','',
			'','paymentmadenow','credit/debit','" . $actualpricearray . "','" . $duedate . "','','0000-00-00','Not Avaliable','Not Avaliable','','','','','','" . $igst_tax_amount . "',
			'" . $cgst_tax_amount . "','" . $sgst_tax_amount . "')";
			$result2 = runmysqlquery($query2);



		}
		echo ('1^' . $slnotobeinserted);
		break;
	case 'preonlinedatasvh': {

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
                                    inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
                                    ,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
                                    left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
                                    left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
                                    where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);
			$customer_gstno = $fetch_customer_details['customer_gstno'];

			if ($customer_gstno != "" || !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/



			/***************Ends**********************/

			$productcode = $_POST['productcodehidden'];
			$usagetypecode = $_POST['productusagetype'];
			$result3 = getpricingdetails($productcode, $usagetypecode);
			$total = 0;
			$upgardetoproduct = '';
			$pricearray = '';
			$actualpricearray = '';
			$usertypearray = '';
			while ($fetch3 = mysqli_fetch_array($result3)) {
				if ($upgardetoproduct == '')
					$upgardetoproduct = $fetch3['upgradetocode'];
				else
					$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
				if ($usertypearray == '') {
					if ($fetch3['usagetype'] == '00')
						$usertypearray = 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray = 'multiuser';
				} else {
					if ($fetch3['usagetype'] == '00')
						$usertypearray .= ',' . 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray .= ',' . 'multiuser';
				}

				if ($pricearray == '')
					$pricearray = $fetch3['renewalupdiscounted'];
				else
					$pricearray .= '*' . $fetch3['renewalupdiscounted'];

				if ($actualpricearray == '')
					$actualpricearray = $fetch3['renewalupactual'];
				else
					$actualpricearray .= '*' . $fetch3['renewalupactual'];

				$total = $total + $fetch3['renewalupdiscounted'];
			}
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			if ($expirydate > $currentdate)
				$tax = roundnearest($total * (0.103));
			else
				$tax = roundnearest($total * (0.1236));

			/*---------------Tax for GSt-----------------*/
			$totalamount = $total;
			$total_tax = '';

			if ($customer_sez_enabled == 'yes') {
				$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
				$gst_type = 'SEZ';
				$total_tax = '0.00';
				$netamount = $total;
			} else {
				if ($customer_gst_code == '29') {
					$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
					$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

					$total_tax = $cgst_tax_amount + $sgst_tax_amount;

					$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
					$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
					$igst_tax_amount = '0.00';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount = $netamount;
					//$totalpricearray[] = $fetchresult[$i];
					$gst_type = 'CSGST';
				} else {
					$cgst_tax_amount = $sgst_tax_amount = '0.00';
					$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

					$total_tax = $igst_tax_amount;
					$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

					$gst_type = 'IGST';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount += $netamount;
					//$totalpricearray[] = $fetchresult[$i];
				}
			}

			$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

			/**************************Ends*************/


			//$netamount =  $total + $tax;

			//$netamount =  $total + $tax;
			$usertypes = $usertypearray;
			$prices = $pricearray;
			$servicetax = '0.00';
			$product = $upgardetoproduct;

			$total = $netamount;  //echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;

			$splitusertypes = explode(',', $usertypes);

			$productarray = explode('#', $product);
			$allproducts = '';
			for ($i = 0; $i < count($productarray); $i++) {
				if ($allproducts == '')
					$allproducts = $productarray[$i];
				else
					$allproducts .= '#' . $productarray[$i];
			}
			// Add all the prices 
			$pricearray = explode('*', $prices);
			$totalquantity = count($productarray);
			for ($i = 0; $i < count($pricearray); $i++) {
				$amount = $amount + $pricearray[$i];
			}

			//echo($amount); exit;

			// Fetch customer deatails to insert.
			$query1 = "select *,inv_mas_customercategory.slno as category,inv_mas_customertype.slno as type from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '" . $customerid . "';";
			$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;

			// Fetch Contact Details
			$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
		GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '" . $customerid . "'  group by customerid ";
			$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);

			$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
			$phoneres = removedoublecomma($resultcontactdetails['phone']);
			$cellres = removedoublecomma($resultcontactdetails['cell']);
			$emailidres = removedoublecomma($resultcontactdetails['emailid']);

			// Fetch all other details 
			$phonenumber = explode(',', $phoneres);
			$phone = $phonenumber[0];
			$cellnumber = explode(',', $cellres);
			$cell = $cellnumber[0];
			$businessname = $fetch['businessname'];
			$address = addslashes($fetch['address']);
			$place = $fetch['place'];
			$district = $fetch['districtcode'];
			$state = $fetch['statename'];
			$pincode = $fetch['pincode'];
			$contactperson = trim($contactvalues, ',');
			$stdcode = $fetch['stdcode'];
			$phone = $phonenumber[0];
			$fax = $fetch['fax'];
			$cell = $cellnumber[0];
			$emailid = trim($resultantemailid, ',');
			$category = $fetch['inv_mas_customercategory.slno'];
			$type = $fetch['type'];
			$currentdealer = $fetch['currentdealer'];
			$customertype = ($fetch['customertype'] == '') ? 'Not Available' : $fetch['customertype'];
			$customercategory = ($fetch['businesstype'] == '') ? 'Not Available' : $fetch['businesstype'];

			$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type'";
			$result22 = runmysqlqueryfetch($query22);
			if ($result22['count'] == 0) {
				$resultantemailid = trim($emailidres, ',');
			} else {
				// Fetch of contact details, from pending request table if any
				$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
				$resultcontactpending = runmysqlqueryfetch($querycontactpending);

				$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);

				$finalemailid = $emailidres . ',' . $emailidpending;
				$resultantemailid = remove_duplicates($finalemailid);
			}
			//Fetch the max slno from dealer online purchase table
			$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
			$fetchcount = runmysqlqueryfetch($countquery);
			$slnotobeinserted = $fetchcount['slnotobeinserted'];
			$duedate = date('Y-m-d');

			//Insert the purchase details in dealer online purchase table
			$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,
			stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax,sbtax,kktax, products, paymentdate, paymenttime, purchasetype,
			paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,
			createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,
			serviceamount,paymenttypeselected,paymentmode,actualproductprice,duedate,privatenote,podate,poreference,productbriefdescription,itembriefdescription,
			seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,igst,cgst,sgst)
			values
			('" . $slnotobeinserted . "','" . $customerid . "','" . $businessname . "','" . $address . "','" . $place . "','" . $district . "','" . $state . "','" . $pincode . "','" . $contactperson . "',
			'" . $stdcode . "','" . $phone . "','" . $fax . "','" . $cell . "','" . $resultantemailid . "','" . $customercategory . "','" . $customertype . "','" . $currentdealer . "','" . $amount . "','" . $total . "',
			'" . $servicetax . "','0.00','0.00','" . $allproducts . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','updation','credit/debit','" . $usertypes . "','','','',
			'None','Payment received through Credit/Debit card.','" . $totalquantity . "','default','0','" . $prices . "','" . $customerid . "','" . $_SERVER['REMOTE_ADDR'] . "',
			'" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $customerid . "','" . $amount . "','','customer_module','',
			'','paymentmadenow','credit/debit','" . $actualpricearray . "','" . $duedate . "','','0000-00-00','Not Avaliable','Not Avaliable','','','','','','" . $igst_tax_amount . "',
			'" . $cgst_tax_amount . "','" . $sgst_tax_amount . "')";
			$result2 = runmysqlquery($query2);



		}
		echo ('1^' . $slnotobeinserted);
		break;

	case 'preonlinedatagstn': {

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
                                    inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
                                    ,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
                                    left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
                                    left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
                                    where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);

			$customer_gstno = $fetch_customer_details['customer_gstno'];

			if ($customer_gstno != "" || !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/



			/***************Ends**********************/

			$productcode = $_POST['productcodehidden'];
			$usagetypecode = $_POST['productusagetype'];
			$result3 = getpricingdetails($productcode, $usagetypecode);
			$total = 0;
			$upgardetoproduct = '';
			$pricearray = '';
			$actualpricearray = '';
			$usertypearray = '';
			while ($fetch3 = mysqli_fetch_array($result3)) {
				if ($upgardetoproduct == '')
					$upgardetoproduct = $fetch3['upgradetocode'];
				else
					$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
				if ($usertypearray == '') {
					if ($fetch3['usagetype'] == '00')
						$usertypearray = 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray = 'multiuser';
				} else {
					if ($fetch3['usagetype'] == '00')
						$usertypearray .= ',' . 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray .= ',' . 'multiuser';
				}

				if ($pricearray == '')
					$pricearray = $fetch3['renewalupdiscounted'];
				else
					$pricearray .= '*' . $fetch3['renewalupdiscounted'];

				if ($actualpricearray == '')
					$actualpricearray = $fetch3['renewalupactual'];
				else
					$actualpricearray .= '*' . $fetch3['renewalupactual'];

				$total = $total + $fetch3['renewalupdiscounted'];
			}
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			if ($expirydate > $currentdate)
				$tax = roundnearest($total * (0.103));
			else
				$tax = roundnearest($total * (0.1236));

			/*---------------Tax for GSt-----------------*/
			$totalamount = $total;
			$total_tax = '';

			if ($customer_sez_enabled == 'yes') {
				$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
				$gst_type = 'SEZ';
				$total_tax = '0.00';
				$netamount = $total;
			} else {
				if ($customer_gst_code == '29') {
					$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
					$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

					$total_tax = $cgst_tax_amount + $sgst_tax_amount;

					$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
					$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
					$igst_tax_amount = '0.00';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount = $netamount;
					//$totalpricearray[] = $fetchresult[$i];
					$gst_type = 'CSGST';
				} else {
					$cgst_tax_amount = $sgst_tax_amount = '0.00';
					$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

					$total_tax = $igst_tax_amount;
					$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

					$gst_type = 'IGST';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount += $netamount;
					//$totalpricearray[] = $fetchresult[$i];
				}
			}

			$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

			/**************************Ends*************/


			//$netamount =  $total + $tax;

			//$netamount =  $total + $tax;
			$usertypes = $usertypearray;
			$prices = $pricearray;
			$servicetax = '0.00';
			$product = $upgardetoproduct;

			$total = $netamount;  //echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;

			$splitusertypes = explode(',', $usertypes);

			$productarray = explode('#', $product);
			$allproducts = '';
			for ($i = 0; $i < count($productarray); $i++) {
				if ($allproducts == '')
					$allproducts = $productarray[$i];
				else
					$allproducts .= '#' . $productarray[$i];
			}
			// Add all the prices 
			$pricearray = explode('*', $prices);
			$totalquantity = count($productarray);
			for ($i = 0; $i < count($pricearray); $i++) {
				$amount = $amount + $pricearray[$i];
			}

			//echo($amount); exit;

			// Fetch customer deatails to insert.
			$query1 = "select *,inv_mas_customercategory.slno as category,inv_mas_customertype.slno as type from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '" . $customerid . "';";
			$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;

			// Fetch Contact Details
			$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
		GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '" . $customerid . "'  group by customerid ";
			$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);

			$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
			$phoneres = removedoublecomma($resultcontactdetails['phone']);
			$cellres = removedoublecomma($resultcontactdetails['cell']);
			$emailidres = removedoublecomma($resultcontactdetails['emailid']);

			// Fetch all other details 
			$phonenumber = explode(',', $phoneres);
			$phone = $phonenumber[0];
			$cellnumber = explode(',', $cellres);
			$cell = $cellnumber[0];
			$businessname = $fetch['businessname'];
			$address = addslashes($fetch['address']);
			$place = $fetch['place'];
			$district = $fetch['districtcode'];
			$state = $fetch['statename'];
			$pincode = $fetch['pincode'];
			$contactperson = trim($contactvalues, ',');
			$stdcode = $fetch['stdcode'];
			$phone = $phonenumber[0];
			$fax = $fetch['fax'];
			$cell = $cellnumber[0];
			$emailid = trim($resultantemailid, ',');
			$category = $fetch['inv_mas_customercategory.slno'];
			$type = $fetch['type'];
			$currentdealer = $fetch['currentdealer'];
			$customertype = ($fetch['customertype'] == '') ? 'Not Available' : $fetch['customertype'];
			$customercategory = ($fetch['businesstype'] == '') ? 'Not Available' : $fetch['businesstype'];

			$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type'";
			$result22 = runmysqlqueryfetch($query22);
			if ($result22['count'] == 0) {
				$resultantemailid = trim($emailidres, ',');
			} else {
				// Fetch of contact details, from pending request table if any
				$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
				$resultcontactpending = runmysqlqueryfetch($querycontactpending);

				$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);

				$finalemailid = $emailidres . ',' . $emailidpending;
				$resultantemailid = remove_duplicates($finalemailid);
			}
			//Fetch the max slno from dealer online purchase table
			$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
			$fetchcount = runmysqlqueryfetch($countquery);
			$slnotobeinserted = $fetchcount['slnotobeinserted'];
			$duedate = date('Y-m-d');

			//Insert the purchase details in dealer online purchase table
			$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,
			stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax,sbtax,kktax, products, paymentdate, paymenttime, purchasetype,
			paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,
			createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,
			serviceamount,paymenttypeselected,paymentmode,actualproductprice,duedate,privatenote,podate,poreference,productbriefdescription,itembriefdescription,
			seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,igst,cgst,sgst)
			values
			('" . $slnotobeinserted . "','" . $customerid . "','" . $businessname . "','" . $address . "','" . $place . "','" . $district . "','" . $state . "','" . $pincode . "','" . $contactperson . "',
			'" . $stdcode . "','" . $phone . "','" . $fax . "','" . $cell . "','" . $resultantemailid . "','" . $customercategory . "','" . $customertype . "','" . $currentdealer . "','" . $amount . "','" . $total . "',
			'" . $servicetax . "','0.00','0.00','" . $allproducts . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','updation','credit/debit','" . $usertypes . "','','','',
			'None','Payment received through Credit/Debit card.','" . $totalquantity . "','default','0','" . $prices . "','" . $customerid . "','" . $_SERVER['REMOTE_ADDR'] . "',
			'" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $customerid . "','" . $amount . "','','customer_module','',
			'','paymentmadenow','credit/debit','" . $actualpricearray . "','" . $duedate . "','','0000-00-00','Not Avaliable','Not Avaliable','','','','','','" . $igst_tax_amount . "',
			'" . $cgst_tax_amount . "','" . $sgst_tax_amount . "')";
			$result2 = runmysqlquery($query2);



		}
		echo ('1^' . $slnotobeinserted);
		break;
	case 'preonlinedataxbrl': {

			/*--------------------For GST -----------------------------*/


			$search_customer = str_replace("-", "", $customerid);

			$customer_details = "select inv_mas_customer.sez_enabled as sez_enabled,
                                    inv_mas_district.statecode as state_code,inv_mas_state.statename as statename,inv_mas_state.statecode as statecode
                                    ,inv_mas_state.state_gst_code as state_gst_code, inv_mas_customer.gst_no as customer_gstno from inv_mas_customer 
                                    left join inv_mas_district on inv_mas_customer.district = inv_mas_district.districtcode
                                    left join inv_mas_state on inv_mas_state.statecode = inv_mas_district.statecode 
                                    where inv_mas_customer.customerid like '%" . $search_customer . "%'";

			$fetch_customer_details = runmysqlqueryfetch($customer_details);

			$customer_gstno = $fetch_customer_details['customer_gstno'];

			if ($customer_gstno != "" && !empty($customer_gstno)) {
				//$customer_gst_code = substr($customer_gstno, 0, 2);
				if (is_numeric($customer_gstno)) {
					$query_gst_details = "select gst_no from customer_gstin_logs where gstin_id=" . $customer_gstno;
					$fetch_gst_details = runmysqlqueryfetch($query_gst_details);
					$customer_gst_code = substr($fetch_gst_details['gst_no'], 0, 2);

				} else {
					$customer_gst_code = substr($customer_gstno, 0, 2);
				}
			} else {
				$customer_gst_code = $fetch_customer_details['state_gst_code'];
			}

			$customer_sez_enabled = $fetch_customer_details['sez_enabled'];

			/*--------------------------------------GST Tax Rates ----------------------------------------*/

			$gst_tax_date = strtotime('2017-07-01');
			$invoicecreated_date = date('Y-m-d');
			$querygst = "SELECT igst_rate,cgst_rate,sgst_rate from gst_rates where from_date <= '" . $invoicecreated_date . "' AND to_date >= '" . $invoicecreated_date . "'";
			$fetchrate = runmysqlqueryfetch($querygst);

			$igst_tax_rate = $fetchrate['igst_rate'];
			$cgst_tax_rate = $fetchrate['cgst_rate'];
			$sgst_tax_rate = $fetchrate['sgst_rate'];
			$gst_type = '';

			/*---------------------./Ends------------------------------------------*/



			/***************Ends**********************/

			$productcode = $_POST['productcodehidden'];
			$usagetypecode = $_POST['productusagetype'];
			$result3 = getpricingdetails($productcode, $usagetypecode);
			$total = 0;
			$upgardetoproduct = '';
			$pricearray = '';
			$actualpricearray = '';
			$usertypearray = '';
			while ($fetch3 = mysqli_fetch_array($result3)) {
				if ($upgardetoproduct == '')
					$upgardetoproduct = $fetch3['upgradetocode'];
				else
					$upgardetoproduct .= '#' . $fetch3['upgradetocode'];
				if ($usertypearray == '') {
					if ($fetch3['usagetype'] == '00')
						$usertypearray = 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray = 'multiuser';
				} else {
					if ($fetch3['usagetype'] == '00')
						$usertypearray .= ',' . 'singleuser';
					else if ($fetch3['usagetype'] == '09')
						$usertypearray .= ',' . 'multiuser';
				}

				if ($pricearray == '')
					$pricearray = $fetch3['renewalupdiscounted'];
				else
					$pricearray .= '*' . $fetch3['renewalupdiscounted'];

				if ($actualpricearray == '')
					$actualpricearray = $fetch3['renewalupactual'];
				else
					$actualpricearray .= '*' . $fetch3['renewalupactual'];

				$total = $total + $fetch3['renewalupdiscounted'];
			}
			$currentdate = strtotime(date('Y-m-d'));
			$expirydate = strtotime('2012-04-01');
			if ($expirydate > $currentdate)
				$tax = roundnearest($total * (0.103));
			else
				$tax = roundnearest($total * (0.1236));

			/*---------------Tax for GSt-----------------*/
			$totalamount = $total;
			$total_tax = '';

			if ($customer_sez_enabled == 'yes') {
				$cgst_tax_amount = $sgst_tax_amount = $igst_tax_amount = '0.00';
				$gst_type = 'SEZ';
				$total_tax = '0.00';
				$netamount = $total;
			} else {
				if ($customer_gst_code == '29') {
					$cgst_tax_amount = $totalamount * $cgst_tax_rate / 100;
					$sgst_tax_amount = $totalamount * $sgst_tax_rate / 100;

					$total_tax = $cgst_tax_amount + $sgst_tax_amount;

					$cgst_tax_amount = sprintf('%0.2f', $cgst_tax_amount);
					$sgst_tax_amount = sprintf('%0.2f', $sgst_tax_amount);
					$igst_tax_amount = '0.00';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount = $netamount;
					//$totalpricearray[] = $fetchresult[$i];
					$gst_type = 'CSGST';
				} else {
					$cgst_tax_amount = $sgst_tax_amount = '0.00';
					$igst_tax_amount = $totalamount * $igst_tax_rate / 100;

					$total_tax = $igst_tax_amount;
					$igst_tax_amount = sprintf('%0.2f', $igst_tax_amount);

					$gst_type = 'IGST';

					$netamount = $totalamount + $cgst_tax_amount + $sgst_tax_amount + $igst_tax_amount;
					//$totalamount += $netamount;
					//$totalpricearray[] = $fetchresult[$i];
				}
			}

			$netamount = round($netamount); //number_format((float)$netamount, 2, '.', '');			

			/**************************Ends*************/


			//$netamount =  $total + $tax;

			//$netamount =  $total + $tax;
			$usertypes = $usertypearray;
			$prices = $pricearray;
			$servicetax = '0.00';
			$product = $upgardetoproduct;

			$total = $netamount;  //echo($usertypes.','.$prices.','.$servicetax.','.$product.','.$total);exit;

			$splitusertypes = explode(',', $usertypes);

			$productarray = explode('#', $product);
			$allproducts = '';
			for ($i = 0; $i < count($productarray); $i++) {
				if ($allproducts == '')
					$allproducts = $productarray[$i];
				else
					$allproducts .= '#' . $productarray[$i];
			}
			// Add all the prices 
			$pricearray = explode('*', $prices);
			$totalquantity = count($productarray);
			for ($i = 0; $i < count($pricearray); $i++) {
				$amount = $amount + $pricearray[$i];
			}

			//echo($amount); exit;

			// Fetch customer deatails to insert.
			$query1 = "select *,inv_mas_customercategory.slno as category,inv_mas_customertype.slno as type from inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode =inv_mas_customer.district left join inv_mas_state on inv_mas_state.statecode =inv_mas_district.statecode left join inv_mas_region on inv_mas_region.slno = inv_mas_customer.slno left join inv_mas_branch on  inv_mas_branch.slno = inv_mas_customer.branch left join inv_mas_customertype on inv_mas_customertype.slno = inv_mas_customer.type left join inv_mas_customercategory on inv_mas_customercategory.slno = inv_mas_customer.category  where inv_mas_customer.slno = '" . $customerid . "';";
			$fetch = runmysqlqueryfetch($query1); // echo($query1);exit;

			// Fetch Contact Details
			$querycontactdetails = "select customerid, GROUP_CONCAT(contactperson) as contactperson,  
		GROUP_CONCAT(phone) as phone, GROUP_CONCAT(cell) as cell, GROUP_CONCAT(emailid) as emailid from inv_contactdetails where customerid = '" . $customerid . "'  group by customerid ";
			$resultcontactdetails = runmysqlqueryfetch($querycontactdetails);

			$contactvalues = removedoublecomma($resultcontactdetails['contactperson']);
			$phoneres = removedoublecomma($resultcontactdetails['phone']);
			$cellres = removedoublecomma($resultcontactdetails['cell']);
			$emailidres = removedoublecomma($resultcontactdetails['emailid']);

			// Fetch all other details 
			$phonenumber = explode(',', $phoneres);
			$phone = $phonenumber[0];
			$cellnumber = explode(',', $cellres);
			$cell = $cellnumber[0];
			$businessname = $fetch['businessname'];
			$address = addslashes($fetch['address']);
			$place = $fetch['place'];
			$district = $fetch['districtcode'];
			$state = $fetch['statename'];
			$pincode = $fetch['pincode'];
			$contactperson = trim($contactvalues, ',');
			$stdcode = $fetch['stdcode'];
			$phone = $phonenumber[0];
			$fax = $fetch['fax'];
			$cell = $cellnumber[0];
			$emailid = trim($resultantemailid, ',');
			$category = $fetch['inv_mas_customercategory.slno'];
			$type = $fetch['type'];
			$currentdealer = $fetch['currentdealer'];
			$customertype = ($fetch['customertype'] == '') ? 'Not Available' : $fetch['customertype'];
			$customercategory = ($fetch['businesstype'] == '') ? 'Not Available' : $fetch['businesstype'];

			$query22 = "SELECT count(*) as count from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type'";
			$result22 = runmysqlqueryfetch($query22);
			if ($result22['count'] == 0) {
				$resultantemailid = trim($emailidres, ',');
			} else {
				// Fetch of contact details, from pending request table if any
				$querycontactpending = "select GROUP_CONCAT(emailid) as pendemailid from inv_contactreqpending where customerid = '" . $lastslno . "' and customerstatus = 'pending' and editedtype = 'edit_type' group by customerid ";
				$resultcontactpending = runmysqlqueryfetch($querycontactpending);

				$emailidpending = removedoublecomma($resultcontactpending['pendemailid']);

				$finalemailid = $emailidres . ',' . $emailidpending;
				$resultantemailid = remove_duplicates($finalemailid);
			}
			//Fetch the max slno from dealer online purchase table
			$countquery = "select ifnull(max(slno),0) + 1 as slnotobeinserted from dealer_online_purchase;";
			$fetchcount = runmysqlqueryfetch($countquery);
			$slnotobeinserted = $fetchcount['slnotobeinserted'];
			$duedate = date('Y-m-d');

			//Insert the purchase details in dealer online purchase table
			$query2 = "insert into `dealer_online_purchase`(slno,customerreference,businessname,address,place,district,state,pincode,contactperson,
			stdcode,phone,fax,cell,emailid,category,type,currentdealer,amount,netamount,servicetax,sbtax,kktax, products, paymentdate, paymenttime, purchasetype,
			paymenttype, usagetype, offertype, offerdescription, offeramount, invoiceremarks, paymentremarks,quantity,pricingtype,pricingamount,productpricearray,
			createdby,createdip,createddate,lastmodifieddate,lastmodifiedip,lastmodifiedby,totalproductpricearray,offerremarks,module,service,
			serviceamount,paymenttypeselected,paymentmode,actualproductprice,duedate,privatenote,podate,poreference,productbriefdescription,itembriefdescription,
			seztaxtype,seztaxfilepath,seztaxdate,seztaxattachedby,igst,cgst,sgst)
			values
			('" . $slnotobeinserted . "','" . $customerid . "','" . $businessname . "','" . $address . "','" . $place . "','" . $district . "','" . $state . "','" . $pincode . "','" . $contactperson . "',
			'" . $stdcode . "','" . $phone . "','" . $fax . "','" . $cell . "','" . $resultantemailid . "','" . $customercategory . "','" . $customertype . "','" . $currentdealer . "','" . $amount . "','" . $total . "',
			'" . $servicetax . "','0.00','0.00','" . $allproducts . "','" . date('Y-m-d') . "','" . date('H:i:s') . "','updation','credit/debit','" . $usertypes . "','','','',
			'None','Payment received through Credit/Debit card.','" . $totalquantity . "','default','0','" . $prices . "','" . $customerid . "','" . $_SERVER['REMOTE_ADDR'] . "',
			'" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . date('Y-m-d') . ' ' . date('H:i:s') . "','" . $_SERVER['REMOTE_ADDR'] . "','" . $customerid . "','" . $amount . "','','customer_module','',
			'','paymentmadenow','credit/debit','" . $actualpricearray . "','" . $duedate . "','','0000-00-00','Not Avaliable','Not Avaliable','','','','','','" . $igst_tax_amount . "',
			'" . $cgst_tax_amount . "','" . $sgst_tax_amount . "')";
			$result2 = runmysqlquery($query2);



		}
		echo ('1^' . $slnotobeinserted);
		break;

}

function roundnearest($amount)
{
	$firstamount = round($amount, 1);
	$amount1 = round($firstamount);
	return $amount1;
}


function getpricingdetails($productcode, $usagetypecode)
{
	$query2 = "select * from renewal_edition_mapping_tds  where productcode = '" . $productcode . "' ";
	$result1 = runmysqlqueryfetch($query2);
	$upgradetocode = $result1['upgradetocode'];

	$query3 = "select renewal_edition_mapping_tds.upgradetoedition,(@usagetype:='" . $usagetypecode . "') as usagetype,
if(" . $usagetypecode . " = '00',inv_dealer_pricing.newsuprice,inv_dealer_pricing.newmuprice) as renewalnewprice, 
if(" . $usagetypecode . " = '00',inv_dealer_pricing.renewalsuupactual,inv_dealer_pricing.renewalmuupactual) as renewalupactual, 
if(" . $usagetypecode . " = '00',inv_dealer_pricing.renewalsuupdiscounted,inv_dealer_pricing.renewalmuupdiscounted) as renewalupdiscounted,
renewal_edition_mapping_tds.upgradetocode
from inv_dealer_pricing
left join renewal_edition_mapping_tds on renewal_edition_mapping_tds.productcode = inv_dealer_pricing.product
where  inv_dealer_pricing.product = '" . $upgradetocode . "'";
	$result3 = runmysqlquery($query3);
	//echo($query3);

	return $result3;
}


?>