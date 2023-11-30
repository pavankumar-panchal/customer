<?php
session_start();
if(imaxgetcookie('custuserid') == false) { imaxcustomerlogoutredirect(); }
else
$cusid= imaxgetcookie('custuserid');
?>