<?

$cusid=imaxgetcookie('custuserid');
$query = "select emailid  from inv_contactdetails where customerid = '".$cusid."';";
$result = runmysqlquery($query);
while($fetch = mysqli_fetch_array($result))
{
	if($fetch['emailid'] <> '')
	{
		$emailarray = explode(',',$fetch['emailid']);
		$emailcount = count($emailarray);
	}
	else
	return true;
			
			for($i = 0; $i < $emailcount; $i++)
			{
				echo('<option value="'.$emailarray[$i].'">'.$emailarray[$i].'</option>');
			}
		
}
?>