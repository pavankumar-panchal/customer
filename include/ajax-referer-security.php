<?php

//Security check for Ajax pages

$referurl = parse_url($_SERVER['HTTP_REFERER']);
$referhost = $referurl['host'];


if($referhost <> 'localhost' &&  $referhost <> 'imax.relyonsoft.net' && $referhost <> 'www.imax.relyonsoft.net' && $referhost <> 'relyonsoft.in')
{
	echo("ttThinking, why u called this page. Anyways, call me on my cell");
	exit;
}

?>
