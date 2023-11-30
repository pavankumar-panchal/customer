function getdistrict(divid,statecode)
{
	switch(statecode)
	{
		case '':
			districtlist = '<select name="district" class="swift_mandatory" id="district" style="width: 200px;"><option value="">Select A State First</option></select>';
			break;
			
<?php
include('../functions/phpfunctions.php');

$querystate = "SELECT distinct statecode FROM inv_mas_state order by statename;";
$resultstate = runmysqlquery($querystate);
while($fetchstate = mysqli_fetch_array($resultstate))
{
	echo('case "'.$fetchstate['statecode'].'": districtlist = \'');
	$query = "SELECT districtcode,districtname FROM inv_mas_district WHERE statecode = '".$fetchstate['statecode']."' order by districtname;";
	$result = runmysqlquery($query);
	echo('<select name="district" class="swift_mandatory" id="district" style="width:200px;"><option value="">Select A District</option>');
	while($fetch = mysqli_fetch_array($result))
	{
		echo('<option value="'.$fetch['districtcode'].'">'.$fetch['districtname'].'</option>');
	}
	echo('</select>\'; break; ');
}

?>
	}
	document.getElementById(divid).innerHTML = districtlist;
}



