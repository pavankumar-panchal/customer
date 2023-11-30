<? 
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include('../include/scriptsandstyles.php'); ?>
<title>Manage Invoices</title>
<SCRIPT src="../functions/manageinvoices.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
<script language="javascript" src="../functions/getdistrictjs.php?dummy=<? echo (rand());?>"></script>
<script type="text/javascript">
   $(document).ready( function() {
          $('#popupBoxClose').click( function() {  
			$(".modalOverlay").remove();          
            unloadPopupBox();
        });
   });

</script>
<style type="text/css">
.modalOverlay {
    position: fixed;
    width: 100%;
    height: 100%;
    top: 0px;
    left: 0px;
    background-color: rgba(0,0,0,0.3);
}
.modalOverlay1 {
    position: relative;
    width: 10;
    height: 0%;
    top: 0px;
    left: 0px;
    background-color: rgba(0,0,0,0); 
}
#invoicedetailsgrid { 
    display:none;
    position:fixed;  
    _position:absolute; 
    height:170px;  
    width:300px;  
    background:#FFFFFF;  
    left: 500px;
    top: 200px;
    z-index:100;
    margin-left: 15px;  
    border:1px solid #328cb8;
	box-shadow: 0px 0px 30px #666666; 
    font-size:15px;   	
	-moz-border-radius: 15px;
	border-radius: 15px; 
}

a{  
cursor: pointer;
text-decoration:none;  
} 

#popupBoxClose {
    font-size:14px;  
    line-height:15px;  
    right:5px;  
    top:5px;  
    position:absolute;  
    color:#FFF;  
    font-weight:500;      
}
</style>
</head>
<body onload="getgeneratedinvoices();">
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include('../include/header.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200" valign="top"><? include('../include/left-link.php'); ?></td>
          <td width="700" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="content-top">&nbsp;</td>
              </tr>
              <tr>
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="4">
  <tr>
    <td width="64%" class="subheadind-font">Manage Invoices</td>
    <td width="36%" align="right">Dated after 01 February 2011</td>
  </tr>
  <tr>
    <td height="4px" colspan="2" class="blueline" ></td>
  </tr>
  <tr>
      <td colspan="2"></td>
    </tr>
  <tr>
    <td colspan="2" > <form action="" method="post" name="submitform" id="submitform" onsubmit="return false;"><div id="tabgroupgridc1" style="overflow:auto; " align="center">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr><td><div align="right" id="totalinvoices" style="font-size:12px; "></div></td></tr>
        <tr>
          <td><div id="tabgroupgridc1_1" align="center"></div></td>
        </tr>
        <tr>
          <td><div id="getmorelink"  align="left" ></div></td>
        </tr>
        <tr>
          <td><input type="hidden" name="onlineinvoiceno" id="onlineinvoiceno" value=" "/></td>
        </tr>
      </table>
    </div><div id="resultgrid" style="overflow:auto; display:none; " align="center">&nbsp;</div></form></td>
  </tr>
  <tr>
  	<td>
    	<div id="invoicedetailsgrid">
                            		<div style="background-color:#328cb8; height:25px; -moz-border-top-left-radius: 15px;border-top-left-radius: 15px;-moz-border-top-right-radius: 15px;border-top-right-radius: 15px;">
                              <font style="font-size:14px; line-height:15px;left:5px;top:5px; position:absolute;  color:#FFF; font-weight:500; ">Payment mode</font>
 								 <a id="popupBoxClose">Close</a></div>
                                 <form action="" method="post" name="submitexistform" id="submitexistform">
                                  	<table align="center"  width="100%" border="0" cellspacing="10px" cellpadding="0">
                                    <tr><td>
                                     <label> <input type="radio" id="paymode" name="paymode" value="credit" />&nbsp;Pay through Credit Card</label><br /></td></tr><tr><td>
                                      <label><input type="radio" id="paymode" name="paymode" value="internet" />&nbsp;Pay through Net Banking</label><br /></td></tr><tr><td>&nbsp;<input type="hidden" name="lslnop" id="lslnop" value=""><div id="err" style="color:red;">&nbsp;</div></td></tr><tr><td align="center">
                                      <input name="custpayment" type="button"  id="custpayment" value="Proceed for Payment" onclick ="proceedpayment()"/></td></tr>
                                    </table>
                                  </form>
                              </div>
    </td>
  </tr>
</table></td>
              </tr>
              <tr>
                <td class="content-btm"></td>
              </tr>
            </table></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td><? include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>
