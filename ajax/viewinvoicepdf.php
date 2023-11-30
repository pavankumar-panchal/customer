<?

	ob_start("ob_gzhandler");

	include('../include/ajax-referer-security.php');
	include('../functions/phpfunctions.php');

	//$lastslno = $_POST['onlineslno'];
	$lastslno = $_POST['onlineinvoiceno'];
	if($lastslno == '')
	{
		echo('Thinking to redirect');
		exit;
	}
	else
	{
		vieworgeneratepdfinvoice($lastslno,'view');
	}


?>