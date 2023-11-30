<?php
include('../functions/password.php');
include('../functions/phpfunctions.php');
	$customerid= $_POST['customerid'];
	$query = "select emailid  from inv_mas_customer where customerid = '".$customerid."';";
	$result = runmysqlquery($query);
	while($fetch = mysqli_fetch_array($result))
	{
		$emailarray = explode(',',$fetch['emailid']);
		$emailcount = count($emailarray);
		for($i = 0; $i < $emailcount; $i++)
		{
			echo('<option value="'.$emailarray[$i].'">'.$emailarray[$i].'</option>');
		}
	
	}
?>