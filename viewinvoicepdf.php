<?

	ob_start("ob_gzhandler");

	include('../include/ajax-referer-security.php');
	include('../functions/phpfunctions.php');

	$lastslno = $_POST['onlineslno'];
	if($lastslno == '')
	{
		echo('Thinkingqw to redirect');
		exit;
	}
	else
	{
		vieworgeneratepdfinvoice($lastslno,'view');
	}


?>