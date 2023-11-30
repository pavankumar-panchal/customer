<?php 
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
$year = date('Y').'-'.(date('y')+1);


$cusid = imaxgetcookie('custuserid');
$query = "select * from inv_mas_customer where inv_mas_customer.slno ='".$cusid."'";
$fetch= runmysqlqueryfetch($query);
$currentdealer = $fetch['currentdealer'];

$query1 = "select * from inv_mas_dealer where slno = '".$currentdealer."'";
$fetch1 = runmysqlqueryfetch($query1);
$relyonexecutive = $fetch1['relyonexecutive'];

if($relyonexecutive == 'no')
{
	header("Location:../main/index.php");
}
else
{
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('../include/scriptsandstyles.php'); ?>
<title>Renew Your Sofware</title>
<SCRIPT src="../functions/renewsoftware.js?dummy=<?php echo (rand());?>" type=text/javascript></SCRIPT>
<script language="javascript" src="../functions/getdistrictjs.php?dummy=<?php echo (rand());?>"></script>
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
<body onload="renewsoftware();renewsoftwaresto();renewsoftwaresvi();renewsoftwaresvh();renewsoftwarexbrl();renewsoftwaregstn();">
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php include('../include/header.php') ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="200" valign="top"><?php include('../include/left-link.php'); ?></td>
          <td width="700" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="content-top">&nbsp;</td>
              </tr>
              <tr>
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="4">
                    <tr>
                      <td class="subheadind-font">Renew Your Software</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px" ></td>
                    </tr>
                    <tr>
                      <td><form action="" id="submitform" name="submitform" onsubmit="return false;" method="post">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                  <tr>
                                    <td><table width="98%" border="0" cellspacing="0" cellpadding="4" align="center" style="border:1px solid #527094;" id="tdsdiv">
                                      <tr>
                                                  <td colspan="4"><strong><span style="color:#FF9900; font-size:12px">Saral TDS Products :</span><span style="color:#666666;font-size:12px"> Renew for year </span><span id="currentyear" style="color:#666666;font-size:12px"></span></strong></td>
                                                </tr>
                                        <tr>
                                          <td colspan="4"><div id = "TDS" style="display:none1;">
                                              <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                                
                                                <tr>
                                                  <td width="11%">Product :</td>
                                                  <td width="37%">Saral TDS</td>
                                                  <td width="17%">Previous Year : </td>
                                                  <td width="35%" id="previousyear">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td colspan="4"><strong>Number of Licenses :</strong>
                                                    <input name="productcodehidden" type="hidden" value=" " id = "productcodehidden"/>
                                                    <input type="hidden" name="onlineslno" id="onlineslno" value=" "/></td>
                                                  <input name="productusagetype" type="hidden" value=" " id = "productusagetype"/>
                                                </tr>
                                              </table>
                                            </div></td>
                                        </tr>
                                        <tr>
                                          <td colspan="4"><div id="resultdiv" align="center"></div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td>
                                  <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                    <tr>
                                      <td><table width="98%" border="0" cellspacing="0" cellpadding="4" align="center" style="border:1px solid #527094;" id="stodiv">  <tr>
                                            <td colspan="4"><strong><span style="color:#FF9900; font-size:12px">Saral TaxOffice Products :</span><span style="color:#666666;font-size:12px"> Renew for year </span><span id="currentyearsto" style="color:#666666;font-size:12px"></span></strong></td>
                                          </tr> <tr>
                                            <td colspan="4"><div id = "STO" style="display:none1;"><table width="100%" border="0" cellspacing="0" cellpadding="4">
 
                                          <tr>
                                            <td width="11%">Product :</td>
                                            <td width="37%">Saral Taxoffice</td>
                                            <td width="17%">Previous Year : </td>
                                            <td width="35%" id="previousyearsto">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td colspan="4"><strong>Number of Licenses :</strong>
                                              <input name="productcodehiddensto" type="hidden" value=" " id = "productcodehiddensto"/>
                                              <input type="hidden" name="onlineslnosto" id="onlineslnosto" value=" "/></td>
                                            <input name="productusagetypesto" type="hidden" value=" " id = "productusagetypesto"/>
                                          </tr>
</table></div>
</td></tr>
                                         
                                          <tr>
                                            <td colspan="4"><div id="resultdivsto" align="center"></div></td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </table>
                                </td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <!-- <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                <tr>
                                  <td><table width="98%" border="0" cellspacing="0" cellpadding="4" align="center" style="border:1px solid #527094;" id="svidiv">
                                    <tr>
                                      <td colspan="4"><strong><span style="color:#FF9900; font-size:12px">Saral VATInfo Products :</span><span style="color:#666666;font-size:12px"> Renew for year </span><span id="currentyearsvi" style="color:#666666;font-size:12px"></span></strong></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id = "SVI" style="display:none1;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                          <tr>
                                            <td width="11%">Product :</td>
                                            <td width="37%">Saral VATInfo</td>
                                            <td width="17%">Previous Year : </td>
                                            <td width="35%" id="previousyearsvi">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td colspan="4"><strong>Number of Licenses :</strong>
                                              <input name="productcodehiddensvi" type="hidden" value=" " id = "productcodehiddensvi"/>
                                              <input type="hidden" name="onlineslnosvi" id="onlineslnosvi" value=" "/></td>
                                            <input name="productusagetypesvi" type="hidden" value=" " id = "productusagetypesvi"/>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id="resultdivsvi" align="center"></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                            <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                <tr>
                                  <td><table width="98%" border="0" cellspacing="0" cellpadding="4" align="center" style="border:1px solid #527094;" id="svhdiv">
                                    <tr>
                                      <td colspan="4"><strong><span style="color:#FF9900; font-size:12px">Saral VAT100 Products :</span><span style="color:#666666;font-size:12px"> Renew for year </span><span id="currentyearsvh" style="color:#666666;font-size:12px"></span></strong></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id = "SVH" style="display:none1;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                          <tr>
                                            <td width="11%">Product :</td>
                                            <td width="37%">Saral VAT100</td>
                                            <td width="17%">Previous Year : </td>
                                            <td width="35%" id="previousyearsvh">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td colspan="4"><strong>Number of Licenses :</strong>
                                              <input name="productcodehiddensvh" type="hidden" value=" " id = "productcodehiddensvh"/>
                                              <input type="hidden" name="onlineslnosvh" id="onlineslnosvh" value=" "/></td>
                                            <input name="productusagetypesvh" type="hidden" value=" " id = "productusagetypesvh"/>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id="resultdivsvh" align="center"></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr> -->
                            <!--------XBRL-------->
                              <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                <tr>
                                  <td><table width="98%" border="0" cellspacing="0" cellpadding="4" align="center" style="border:1px solid #527094;" id="xbrldiv">
                                    <tr>
                                      <td colspan="4"><strong><span style="color:#FF9900; font-size:12px">Saral XBRL Products :</span><span style="color:#666666;font-size:12px"> Renew for year </span><span id="currentyearxbrl" style="color:#666666;font-size:12px"></span></strong></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id = "XBRL" style="display:none1;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                          <tr>
                                            <td width="11%">Product :</td>
                                            <td width="37%">Saral XBRL</td>
                                            <td width="17%">Previous Year : </td>
                                            <td width="35%" id="previousyearxbrl">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td colspan="4"><strong>Number of Licenses :</strong>
                                              <input name="productcodehiddenxbrl" type="hidden" value=" " id = "productcodehiddenxbrl"/>
                                              <input type="hidden" name="onlineslnoxbrl" id="onlineslnoxbrl" value=" "/></td>
                                            <input name="productusagetypexbrl" type="hidden" value=" " id = "productusagetypexbrl"/>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id="resultdivxbrl" align="center"></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table></td>
                          <tr>
                              <td>&nbsp;</td>
                            </tr>
                             <!--//added for xbrl-->

                          <!-------GSTN--------->
                          <tr>
                              <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                <tr>
                                  <td><table width="98%" border="0" cellspacing="0" cellpadding="4" align="center" style="border:1px solid #527094;" id="gstndiv">
                                    <tr>
                                      <td colspan="4"><strong><span style="color:#FF9900; font-size:12px">Saral GST Products :</span><span style="color:#666666;font-size:12px"> Renew for year </span><span id="currentyearxbrl" style="color:#666666;font-size:12px"></span></strong></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id = "GSTN" style="display:none1;">
                                        <table width="100%" border="0" cellspacing="0" cellpadding="4">
                                          <tr>
                                            <td width="11%">Product :</td>
                                            <td width="37%">Saral GSTN</td>
                                            <td width="17%">Previous Year : </td>
                                            <td width="35%" id="previousyeargstn">&nbsp;</td>
                                          </tr>
                                          <tr>
                                            <td colspan="4"><strong>Number of Licenses :</strong>
                                              <input name="productcodehiddengstn" type="hidden" value=" " id = "productcodehiddengstn"/>
                                              <input type="hidden" name="onlineslnogstn" id="onlineslnogstn" value=" "/></td>
                                            <input name="productusagetypegstn" type="hidden" value=" " id = "productusagetypegstn"/>
                                          </tr>
                                        </table>
                                      </div></td>
                                    </tr>
                                    <tr>
                                      <td colspan="4"><div id="resultdivgstn" align="center"></div></td>
                                    </tr>
                                  </table></td>
                                </tr>
                              </table></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                           
                            <!--//added for GSTN-->
                          </table>
                      </form></td>
                    </tr>
                    <tr><td>
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
                    </td></tr>
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
    <td><?php include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
<script>
var url = window.location+ "";
var colorvaluesplit = url.split("#");
var colorvalue = colorvaluesplit[1];
switch(colorvalue)
{
	case 'TDS': document.getElementById('tdsdiv').style.background = '#FFFFCC'; break;
	case 'STO': document.getElementById('stodiv').style.background = '#FFFFCC'; break;
	case 'SVI': document.getElementById('svidiv').style.background = '#FFFFCC'; break;
	case 'SVH': document.getElementById('svhdiv').style.background = '#FFFFCC'; break;

}
</script>
</html>
<?php
}
?>