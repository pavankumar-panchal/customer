<?

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtytpe = $_POST['switchtype'];
if(imaxgetcookie('dbcustomerid') <> '' )
$dbcustomerid = imaxgetcookie('dbcustomerid');
else
{
	echo('Thinking to redirect');
	exit;
}
switch($switchtytpe)
{
	case 'update':
	{
		$responsearray = array();
		$cusid = $_POST['cusid'];
		$businessname= $_POST['businessname'];
		$address = $_POST['address'];
		$place = $_POST['place'];
		$gst_no = $_POST['gst_no'];
		$district = $_POST['district'];
		$state = $_POST['state'];
		$pincode = $_POST['pincode'];
		$stdcode = $_POST['stdcode'];
		$fax = $_POST['fax'];
		$website = $_POST['website'];
		$type = $_POST['type'];
		$category = $_POST['category'];
		$promotionalsms = $_POST['promotionalsms'];
		$promotionalemail = $_POST['promotionalemail'];
		$contactarray = $_POST['contactarray'];
		$totalarray = $_POST['totalarray'];  
		$totalsplit = explode(',',$totalarray);
		$contactsplit = explode('****',$contactarray);
		$contactcount = count($contactsplit);
		if($contactcount > 1)
		{
			for($i=0;$i<$contactcount;$i++)
			{
				$contactressplit[] = explode('#',$contactsplit[$i]);
			}
		}
		else
		{
			for($i=0;$i<$contactcount;$i++)
			{
				$contactressplit[] = explode('#',$contactsplit[$i]);
			}
		}
		
		$createddate = datetimelocal('d-m-Y').' '.datetimelocal('H:i:s');
		$countquery = "SELECT COUNT(*) as count FROM inv_customerreqpending WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module';"; 
		$countfetch = runmysqlqueryfetch($countquery);
		if($countfetch['count'] == 0)
		{
			$query = runmysqlqueryfetch("SELECT (MAX(slno) + 1) AS slno FROM inv_customerreqpending");
			$slno = $query['slno'];
			
			$query = "Insert into inv_customerreqpending(slno,customerid,businessname,address,place,district,pincode,stdcode,fax,website,type,category,createddate,customerstatus,requestfrom,requestby,promotionalemail,promotionalsms,gst_no) values('".$slno."','".$cusid."','".trim($businessname)."','".$address."','".$place."','".$district."','".$pincode."','".$stdcode."','".$fax."','".$website."','".$type."','".$category."','".date('Y-m-d').' '.date('H:i:s')."','pending','customer_module','".substr($dbcustomerid,12)."','".$promotionalemail."','".$promotionalsms."','".$gst_no."')";
			$result1 = runmysqlquery($query);
			if($totalarray <> '')
			{
				$query22 = "SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid from inv_contactdetails where slno IN (".$totalarray.")"; 
				$result = runmysqlquery($query22);
				while($fetchres = mysqli_fetch_array($result))
				{
						$selectiontype1 = $fetchres['selectiontype'];
						$contactperson1 = $fetchres['contactperson'];
						$phone1 = $fetchres['phone'];
						$cell1 = $fetchres['cell'];
						$emailid1= $fetchres['emailid'];
						
						$query4 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$cusid."','".$selectiontype1."','".$contactperson1."','".$phone1."','".$cell1."','".$emailid1."','pending','customer_module','delete_type');"; //echo($query4); exit;
						$result = runmysqlquery($query4);
				}
			}
			
			for($j=0;$j<count($contactressplit);$j++)
				{
					$selectiontype = $contactressplit[$j][0];
					$contactperson = $contactressplit[$j][1];
					$phone1 = $contactressplit[$j][2];
					$cell1 = $contactressplit[$j][3];
					$emailid1 = $contactressplit[$j][4];
					//Added Space after comma is not avaliable in phone, cell and emailid fields
					$phonespace = str_replace(", ", ",",$phone1);
					$phonevalue = str_replace(',',', ',$phonespace);
					
					$cellspace = str_replace(", ", ",",$cell1);
					$cellvalue = str_replace(',',', ',$cellspace);
					
					$emailidspace = str_replace(", ", ",",$emailid1);
					$emailidvalue = str_replace(',',', ',$emailidspace);
					
					$query2 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$cusid."','".$selectiontype."','".$contactperson."','".$phonevalue."','".$cellvalue."','".$emailidvalue."','pending','customer_module','edit_type');";
					$result = runmysqlquery($query2);
				}
		}
		else
		{
			$countquery1 = "SELECT COUNT(*) as count FROM inv_customerreqpending WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' AND customerstatus = 'pending';";
			$countfetch1 = runmysqlqueryfetch($countquery1);
			if($countfetch1['count'] <> 0)
			{
				$countquery2 = "SELECT COUNT(*) as count FROM inv_contactreqpending WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' AND customerstatus = 'pending';";
				$countfetch2 = runmysqlqueryfetch($countquery2);
				if($countfetch2['count'] <> 0)
				{
					$query1 = "UPDATE inv_contactreqpending SET customerstatus = 'oldrequest' WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' AND customerstatus = 'pending';";
					$result = runmysqlquery($query1);
				}
				$query11 = "UPDATE inv_customerreqpending SET customerstatus = 'oldrequest' WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' AND customerstatus = 'pending';";
				$result = runmysqlquery($query11);
				
				$query = runmysqlqueryfetch("SELECT (MAX(slno) + 1) AS slno FROM inv_customerreqpending");
				$slno = $query['slno'];

				$query1 = "Insert into inv_customerreqpending(slno,customerid,businessname,address,place,district,pincode,stdcode,fax,website,type,category,createddate,customerstatus,requestfrom,requestby,promotionalemail,promotionalsms,gst_no) values('".$slno."','".$cusid."','".trim($businessname)."','".$address."','".$place."','".$district."','".$pincode."','".$stdcode."','".$fax."','".$website."','".$type."','".$category."','".date('Y-m-d').' '.date('H:i:s')."','pending','customer_module','".substr($dbcustomerid,12)."','".$promotionalemail."','".$promotionalsms."','".$gst_no."')";
				$result1 = runmysqlquery($query1);
				if($totalarray <> '')
				{
					$query22 = "SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid from inv_contactdetails where slno IN (".$totalarray.")";
					$result23 = runmysqlquery($query22);
					while($fetchres = mysqli_fetch_array($result23))
					{
						$selectiontype1 = $fetchres['selectiontype'];
						$contactperson1 = $fetchres['contactperson'];
						$phone1 = $fetchres['phone'];
						$cell1 = $fetchres['cell'];
						$emailid1= $fetchres['emailid'];
						
						$query4 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$cusid."','".$selectiontype1."','".$contactperson1."','".$phone1."','".$cell1."','".$emailid1."','pending','customer_module','delete_type');";
						$result = runmysqlquery($query4);
					}
				}
				for($j=0;$j<count($contactressplit);$j++)
				{
					$selectiontype = $contactressplit[$j][0];
					$contactperson = $contactressplit[$j][1];
					$phone = $contactressplit[$j][2];
					$cell = $contactressplit[$j][3];
					$emailid = $contactressplit[$j][4];
					//Added Space after comma is not avaliable in phone, cell and emailid fields
					$phonespace = str_replace(", ", ",",$phone);
					$phonevalue = str_replace(',',', ',$phonespace);
					
					$cellspace = str_replace(", ", ",",$cell);
					$cellvalue = str_replace(',',', ',$cellspace);
					
					$emailidspace = str_replace(", ", ",",$emailid);
					$emailidvalue = str_replace(',',', ',$emailidspace);
					
					$query2 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$cusid."','".$selectiontype."','".$contactperson."','".$phonevalue."','".$cellvalue."','".$emailidvalue."','pending','customer_module','edit_type');";
					$result = runmysqlquery($query2);
				}
				$updateddata = $customerid."|^|".$businessname."|^|".$address."|^|".$place."|^|".$district."|^|".$pincode."|^|".$stdcode."|^|".$website."|^|".$type."|^|".$category."|^|".$createddate."|^|".$fax."|^|".$userid."|^|".$contactarray;
				$query5 = "Insert into inv_logs_pendingrequest(userid,type,updateddata,updateddate,updatedtime,system) values('".substr($dbcustomerid,12)."','customer_module','".$updateddata."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
				$result5 = runmysqlquery($query5);
				
			}
			else
			{
				$query = runmysqlqueryfetch("SELECT (MAX(slno) + 1) AS slno FROM inv_customerreqpending");
				$slno = $query['slno'];

				$query1 = "Insert into inv_customerreqpending(slno,customerid,businessname,address,place,district,pincode,stdcode,fax,website,type,category,createddate, customerstatus,requestfrom,requestby,promotionalemail,promotionalsms,gst_no) values('".$slno."','".$cusid."','".trim($businessname)."','".$address."','".$place."','".$district."','".$pincode."','".$stdcode."','".$fax."','".$website."','".$type."','".$category."','".date('Y-m-d').' '.date('H:i:s')."','pending','customer_module','".substr($dbcustomerid,12)."','".$promotionalemail."','".$promotionalsms."','".$gst_no."')";
				$result1 = runmysqlquery($query1);
				if($totalarray <> '')
				{
					$query22 = "SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid from inv_contactdetails where slno IN (".$totalarray.")";
					$result23 = runmysqlquery($query22);
					while($fetchres = mysqli_fetch_array($result23))
					{
							$selectiontype1 = $fetchres['selectiontype'];
							$contactperson1 = $fetchres['contactperson'];
							$phone1 = $fetchres['phone'];
							$cell1 = $fetchres['cell'];
							$emailid1= $fetchres['emailid'];
							
							$query4 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$cusid."','".$selectiontype1."','".$contactperson1."','".$phone1."','".$cell1."','".$emailid1."','pending','customer_module','delete_type');";
							$result = runmysqlquery($query4);
					}
				}
				for($j=0;$j<count($contactressplit);$j++)
				{
					$selectiontype = $contactressplit[$j][0];
					$contactperson = $contactressplit[$j][1];
					$phone = $contactressplit[$j][2];
					$cell = $contactressplit[$j][3];
					$emailid = $contactressplit[$j][4];
					//Added Space after comma is not avaliable in phone, cell and emailid fields
					$phonespace = str_replace(", ", ",",$phone);
					$phonevalue = str_replace(',',', ',$phonespace);
					
					$cellspace = str_replace(", ", ",",$cell);
					$cellvalue = str_replace(',',', ',$cellspace);
					
					$emailidspace = str_replace(", ", ",",$emailid);
					$emailidvalue = str_replace(',',', ',$emailidspace);
					
					$query2 = "Insert into inv_contactreqpending(refslno,customerid,selectiontype,contactperson,phone,cell,emailid,customerstatus,requestfrom,editedtype) values  ('".$slno."','".$cusid."','".$selectiontype."','".$contactperson."','".$phonevalue."','".$cellvalue."','".$emailidvalue."','pending','customer_module','edit_type');";
					$result = runmysqlquery($query2);
				}
				$updateddata = $customerid."|^|".$businessname."|^|".$contactperson."|^|".$address."|^|".$place."|^|".$district."|^|".$pincode."|^|".$stdcode."|^|".$phonevalue."|^|".$cellvalue."|^|".$emailid."|^|".$website."|^|".$type."|^|".$category."|^|".$createddate."|^|".$fax."|^|".$userid."|^|".$contactarray;
				
				$query2 = "Insert into inv_logs_pendingrequest(userid,type,updateddata,updateddate,updatedtime,system) values('".substr($dbcustomerid,12)."','customer_module','".$updateddata."','".datetimelocal('Y-m-d')."','".datetimelocal('H:i:s')."','".$_SERVER['REMOTE_ADDR']."')";
				$result2 = runmysqlquery($query2);
		     }
		}
		$responsearray['errormsg'] = 'Profile update Request has been submitted successfully to Relyon. This will be verified and updated in a few hours.';
		echo(json_encode($responsearray));
		//echo('Profile update Request has been submitted successfully to Relyon. This will be verified and updated in a few hours.');
	
	break;
	}
	case 'undo':
	{
		$responsearray2 = array();
		$cusid = $_POST['cusid'];
		$query = "SELECT count(*) AS count FROM inv_mas_customer WHERE slno = '".$cusid."';";
		$fetch = runmysqlqueryfetch($query);
		$count = $fetch['count'];
		if($count > 0)
		{
			$query2 = "SELECT inv_mas_customer.slno,inv_mas_customer.customerid,inv_mas_customer.gst_no,businessname,address,place,district,
inv_mas_state.slno as state,pincode,stdcode,fax,website,type,category,createddate,promotionalemail,promotionalsms FROM 
inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode= inv_mas_customer.district 
left join inv_mas_state on inv_mas_state.slno = inv_mas_district.statecode WHERE inv_mas_customer.slno = '".$cusid."';";
			$fetch = runmysqlqueryfetch($query2);
			$createddate = changedateformatwithtime($fetch['createddate']);
			
			$query1 ="SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactdetails where customerid = '".$cusid."'; ";
			$resultfetch = runmysqlquery($query1);
			$valuecount = 0;
			while($fetchres = mysqli_fetch_array($resultfetch))
			{
				if($valuecount > 0)
					$contactarray .= '****';
				$selectiontype = $fetchres['selectiontype'];
				$contactperson = $fetchres['contactperson'];
				$phone = $fetchres['phone'];
				$cell = $fetchres['cell'];
				$emailid = $fetchres['emailid'];
				$slno = $fetchres['slno'];
				
				$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
				$valuecount++;
				
			}
		}
		$responsearray2['businessname'] = $fetch['businessname'];
		$responsearray2['address'] = $fetch['address'];
		$responsearray2['place'] = $fetch['place'];
		$responsearray2['state'] = $fetch['state'];
		$responsearray2['district'] = $fetch['district'];
		$responsearray2['pincode'] = $fetch['pincode'];
		$responsearray2['stdcode'] = $fetch['stdcode'];
		$responsearray2['website'] = $fetch['website'];
		$responsearray2['dbcustomerid'] = cusidcombine1($dbcustomerid);
		$responsearray2['type'] = $fetch['type'];
		$responsearray2['category'] = $fetch['category'];
		$responsearray2['createddate'] = $createddate;
		$responsearray2['fax'] = $fetch['fax'];
		$responsearray2['customerstatus'] = $fetch['customerstatus'];
		$responsearray2['contactarray'] = $contactarray;
		$responsearray2['promotionalemail'] = $fetch['promotionalemail'];
		$responsearray2['promotionalsms'] = $fetch['promotionalsms'];
		$responsearray2['gst_no'] = $fetch['gst_no'];
		echo(json_encode($responsearray2));
		//echo($fetch['businessname'].'^'.$fetch['address'].'^'.$fetch['place'].'^'.$fetch['state'].'^'.$fetch['district'].'^'.$fetch['pincode'].'^'.$fetch['stdcode'].'^'.$fetch['website'].'^'. cusidcombine1($dbcustomerid).'^'.$fetch['type'].'^'.$fetch['category'].'^'.$createddate.'^'.$fetch['fax'].'^'.$contactarray.'^'.$fetch['promotionalemail'].'^'.$fetch['promotionalsms']);
		
	}
	break;
	case 'getcustomerdetails':
	{
		$responsearray1 = array();
		$cusid = $_POST['cusid'];
		$query = "SELECT count(*) AS count FROM inv_customerreqpending WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' and customerstatus = 'pending';";
		$fetch = runmysqlqueryfetch($query);
		$count = $fetch['count'];
		if($count > 0)
		{
			$query = "SELECT inv_customerreqpending.slno as refslno,customerid,gst_no,businessname,address,place,district,
pincode,stdcode,fax,website,type,category,inv_customerreqpending.createddate,inv_mas_district.statecode
as state, inv_mas_state.state_gst_code as state_gst_code, inv_customerreqpending.customerstatus as customerstatus, inv_customerreqpending.promotionalsms,inv_customerreqpending.promotionalemail FROM inv_customerreqpending left join inv_mas_district on inv_mas_district.districtcode= inv_customerreqpending.district 
left join inv_mas_state on inv_mas_state.slno = inv_mas_district.statecode WHERE customerid = '".$cusid."'  AND requestfrom = 'customer_module' and inv_customerreqpending.customerstatus='pending' ;";
			$fetch = runmysqlqueryfetch($query);
			$createddate = changedateformatwithtime($fetch['createddate']);
			$query1 ="SELECT refslno,customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactreqpending where refslno = '".$fetch['refslno']."' and editedtype = 'edit_type'; ";
			$resultfetch = runmysqlquery($query1);
			$valuecount = 0;
			while($fetchres = mysqli_fetch_array($resultfetch))
			{
				if($valuecount > 0)
					$contactarray .= '****';
				$selectiontype = $fetchres['selectiontype'];
				$contactperson = $fetchres['contactperson'];
				$phone = $fetchres['phone'];
				$cell = $fetchres['cell'];
				$emailid = $fetchres['emailid'];
				$slno = $fetchres['slno'];
				
				$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
				$valuecount++;
				
			}
			
		}
		else
		{
			$query = "SELECT inv_mas_customer.slno ,inv_mas_customer.customerid AS 
customerid,inv_mas_customer.businessname AS businessname,inv_mas_customer.createddate,inv_mas_customer.gst_no,inv_mas_customer.address AS address,inv_mas_customer.category AS category,inv_mas_customer.place AS place,inv_mas_customer.district AS district,inv_mas_district.statecode as state,inv_mas_state.state_gst_code as state_gst_code,inv_mas_customer.pincode AS pincode,inv_mas_customer.stdcode AS stdcode ,inv_mas_customer.`type` AS type,inv_mas_customer.fax AS fax,inv_mas_customer.website AS website,inv_mas_customer.promotionalemail AS promotionalemail,inv_mas_customer.promotionalsms AS promotionalsms FROM inv_mas_customer left join inv_mas_district on inv_mas_district.districtcode= inv_mas_customer.district
left join inv_mas_state on inv_mas_state.slno = inv_mas_district.statecode 
WHERE inv_mas_customer.slno = '".$cusid."'; ";
			$fetch= runmysqlqueryfetch($query);
			$createddate = changedateformatwithtime($fetch['createddate']);
			
			$query1 ="SELECT slno,customerid,contactperson,selectiontype,phone,cell,emailid,slno from inv_contactdetails where customerid = '".$cusid."'; ";
				$resultfetch = runmysqlquery($query1);
				$valuecount = 0;
				while($fetchres = mysqli_fetch_array($resultfetch))
				{
					if($valuecount > 0)
						$contactarray .= '****';
					$selectiontype = $fetchres['selectiontype'];
					$contactperson = $fetchres['contactperson'];
					$phone = $fetchres['phone'];
					$cell = $fetchres['cell'];
					$emailid = $fetchres['emailid'];
					$slno = $fetchres['slno'];
					
					$contactarray .= $selectiontype.'#'.$contactperson.'#'.$phone.'#'.$cell.'#'.$emailid.'#'.$slno;
					$valuecount++;
					
				}
			
		}
		$responsearray1['businessname'] = $fetch['businessname'];
		$responsearray1['address'] = $fetch['address'];
		$responsearray1['place'] = $fetch['place'];
		$responsearray1['state'] = $fetch['state'];
		$responsearray1['district'] = $fetch['district'];
		$responsearray1['pincode'] = $fetch['pincode'];
		$responsearray1['stdcode'] = $fetch['stdcode'];
		$responsearray1['website'] = $fetch['website'];
		$responsearray1['dbcustomerid'] = cusidcombine1($dbcustomerid);
		$responsearray1['type'] = $fetch['type'];
		$responsearray1['category'] = $fetch['category'];
		$responsearray1['createddate'] = $createddate;
		$responsearray1['fax'] = $fetch['fax'];
		$responsearray1['customerstatus'] = $fetch['customerstatus'];
		$responsearray1['contactarray'] = $contactarray;
		$responsearray1['promotionalemail'] = $fetch['promotionalemail'];
		$responsearray1['promotionalsms'] = $fetch['promotionalsms'];
		$responsearray1['gst_no'] = $fetch['gst_no'];
		$responsearray1['state_gst_code'] = $fetch['state_gst_code'];
		echo(json_encode($responsearray1));
		
			
		//echo($fetch['businessname'].'^'.$fetch['address'].'^'.$fetch['place'].'^'.$fetch['state'].'^'.$fetch['district'].'^'.$fetch['pincode'].'^'.$fetch['stdcode'].'^'.$fetch['website'].'^'. cusidcombine1($dbcustomerid).'^'.$fetch['type'].'^'.$fetch['category'].'^'.$createddate .'^'.$fetch['fax'].'^'.$fetch['customerstatus'].'^'.$contactarray.'^'.$fetch['promotionalemail'].'^'.$fetch['promotionalsms']);
	}
	break;
	case 'cancelupdate':
	{
		$responsearray3 = array();
		$cusid = $_POST['cusid'];
		$query = "SELECT count(*) AS count FROM inv_customerreqpending WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' and customerstatus = 'processed'";
		$fetch = runmysqlqueryfetch($query);
		$count = $fetch['count'];
		if($count < 0)
		{
			$responsearray3['errorcode'] = "1";
			$responsearray3['errormsg'] = "This request is already processed.";
			echo(json_encode($responsearray3));
			//echo('1^This request is already processed.');
		}
		else
		{
			$query2 = "SELECT count(*) AS count FROM inv_contactreqpending WHERE customerid = '".$cusid."' AND requestfrom = 'customer_module' and customerstatus = 'pending'";
			$fetch2 = runmysqlqueryfetch($query2);
			if($fetch2['count'] > 0)
			{
				$query1 ="update inv_contactreqpending set customerstatus = 'cancelled' where customerid = '".$cusid."' AND requestfrom = 'customer_module'  and customerstatus = 'pending';";
				$result1 = runmysqlquery($query1);
			}
			$query ="update inv_customerreqpending set customerstatus = 'cancelled' where customerid = '".$cusid."' AND requestfrom = 'customer_module'  and customerstatus = 'pending';";
			$result = runmysqlquery($query);
			$responsearray3['errorcode'] = "2";
			$responsearray3['errormsg'] = "Pending Request Cancelled Successfully.";
			echo(json_encode($responsearray3));
			//echo('2^Pending Request Cancelled Successfully.');
		}
	}
	break;
}


?>
