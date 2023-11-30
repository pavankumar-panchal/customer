<?php 
	include('../functions/phpfunctions.php');
	include('../include/checksession.php');
	$id = $_GET['id'];
	$filename = 'filepath'.$id;
	$filepath = $_REQUEST[$filename];
	
	if($filepath == '')
	{
		$url = '../main/index.php'; 
		header("location:".$url);
	}
	else
	{
		viewfilepath($filepath);
	}
	
function viewfilepath($filepath)
{
	$filename = explode('/',$filepath);
				
	$fp = fopen($filename[5],"wa+");
	if($fp)
	{
		downloadfile($filepath);
		fclose($fp);
	}
}
?>