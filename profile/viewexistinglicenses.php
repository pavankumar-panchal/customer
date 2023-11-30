<?

include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<script language="javascript" src="../functions/viewlicense.js?dummy=<? echo (rand());?>"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>View Existing Licenses | Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
</head>
<body onload="viewlicensedetails('')">
<table width="900px" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include('../include/header.php') ?></td>
  </tr>
  <tr>
    <td colspan="2" >&nbsp;</td>
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
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td class="subheadind-font">View Existing Licenses</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><form action="" method="post" name="submitform" id"submitform">
                          <table width="100%" border="0" cellspacing="0" cellpadding="4">
                          <tr><td id="form-error"></td></tr>
                            <tr>
                              <td ><div id="tabgroupgridc1" style="display:none; padding:10px" >
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; " >
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_1" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc1link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid1" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div> 
                           
                           <div id="tabgroupgridc2" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_2" > </div></td>
                                    </tr>
                                    <tr>
                                      <td><div id="tabgroupgridc2link"> </div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid2" style="overflow:auto; display:none;"></div></td></tr>
                                  </table>
                                </div>
                              <div id="tabgroupgridc3" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_3" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc3link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid3" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div>
                               <div id="tabgroupgridc4" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_4" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc4link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid4" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div> <div id="tabgroupgridc5" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_5" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc5link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid5" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div> <div id="tabgroupgridc6" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_6" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc6link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid6" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div><div id="tabgroupgridc7" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_7" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc7link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid7" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div> <div id="tabgroupgridc8" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_8" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc8link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid8" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div> <div id="tabgroupgridc9" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_9" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc9link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid9" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div><div id="tabgroupgridc10" style="display:none; padding:10px" >
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_10" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc10link"></div></td>
                                    </tr>
                                    <tr><td> <div id="resultgrid10" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div><div id="tabgroupgridc11" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_11" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc11link"></div></td>
                                    </tr>
                                    <tr><td> <div id="resultgrid11" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div><div id="tabgroupgridc12" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_12" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc12link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid12" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div><div id="tabgroupgridc13" style="display:none; padding:10px">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #308ebc; ">
                                    <tr>
                                      <td align="center"><div id="tabgroupgridc1_13" > </div></td>
                                    </tr>
                                    <tr>
                                      <td ><div id="tabgroupgridc13link"></div></td>
                                    </tr>
                                    <tr><td><div id="resultgrid13" style="overflow:auto; display:none;" ></div></td></tr>
                                  </table>
                                </div></td>
                            </tr>
                            
                          </table>
                        </form>
                          </td>
                    </tr>
                    <tr>
                      <td></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
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
