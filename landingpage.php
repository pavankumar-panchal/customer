<?php
session_start();
include "functions/phpfunctions.php";

if(!empty($_REQUEST["id"]))
{
$encode_id = $_REQUEST['id'];
$decode_id = decodevalue($encode_id);
$testid = encodevalue("13457");
$query = "select * from inv_mas_customer where slno='".$decode_id."'";
$resp = runmysqlquery($query);
$resp_count = mysqli_num_rows($resp);
if($resp_count > 0){
  $fetch = runmysqlqueryfetch($query);
      $user = $fetch['slno'];
      $passwd = $fetch['loginpassword'];
      $disablelogin = $fetch['disablelogin'];
      $dbcustomerid = $fetch['customerid'];
      if($disablelogin == 'yes')
      {
       echo $message = 'Login is Disabled';
      }
      else
      {
          $_SESSION['verificationid'] = '4563464364365';
          imaxcreatecookie('dbcustomerid',$dbcustomerid);
          imaxcreatecookie('custuserid',$user);
          //setcookie('dbcustomerid',base64_encode($dbcustomerid));
          //setcookie('userid',base64_encode($user));
          $query1 ="INSERT INTO inv_logs_login (userid,`date`,`time`,`type`,system,device,browser) VALUES('".$user."','".date('Y-m-d')."','".date('h:i:s')."','customer_login_by_link','".$_SERVER['REMOTE_ADDR']."','DESKTOP','".$_SERVER['HTTP_USER_AGENT']."')";
            $result = runmysqlquery($query1);
          if(isset($_GET['link']) && isurl($_GET['link']) && isvalidhostname($_GET['link']))
          {
                header('Location:'.$_GET['link']);
          }
          else
          {
                header('Location:'.'main/index.php');
          }
      }

}else
{
  echo $message = "Invalid Customer";
}


}else {

echo $message = "Please pass Customer id";

}





?>
