<?php 
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include('../include/scriptsandstyles.php'); ?>
<title>View Implementation Status | Relyon Customer Login Area</title>
<link media="screen" rel="stylesheet" href="../css/colorbox.css?dummy=<?php echo (rand());?>" />
<SCRIPT src="../functions/implementation.js?dummy=<?php echo (rand());?>" type=text/javascript></SCRIPT>
<script language="javascript" src="../functions/jquery.colorbox.js?dummy=<?php echo (rand());?>"></script>
</head>
<body onload="checkvalidation(<?php echo($cusid); ?>);">
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
                <td class="content-mid"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td class="subheadind-font"><strong>Implementation Information </strong></td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><form action="" method="post" name="submitform" id="submitform">
                          <table width="100%" border="0" cellspacing="0" cellpadding="0" >
                            <tr>
                              <td><div id="loadingimage"></div></td>
                            </tr>
                            <tr>
                              <td ><div id="displaydiv1" style="display:none">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                      <td><input type="hidden" name="lastslno" id="lastslno" />
                                        &nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td id="displaytext"  class="imp_box" >&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>
                                  </table>
                                </div>
                                <div id="displaydiv2" style="display:none">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                    <tr>
                                      <td id="displaydetails"><table width="100%" border="0" cellspacing="0" cellpadding="5" >
                                          <tr>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td><div class="imp_title_bar"  >
                                                      <div class="imp_rounder" >
                                                        <input type="hidden" name="filepath1" id="filepath1" />
                                                        <input type="hidden" name="filepath2" id="filepath2" />
                                                        <input type="hidden" name="filepath3" id="filepath3" />
                                                      </div>
                                                      <span>Current Status </span></div>
                                                    <div class="imp_dashboard_module" style="height:180px" >
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                        <tr>
                                                          <td id="implementationstatus" style="color:#FF0000; font-weight:bold; text-align:left" align="left">&nbsp;</td>
                                                        </tr>
                                                        <tr >
                                                          <td><strong>Remarks</strong> : <span id="implementationremarks"></span></td>
                                                        </tr>
                                                        <tr >
                                                          <td ><div id="iccattachdisplay" style="display:none"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                        <tr>
                                                          <td colspan="2" id="iccattachname">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td width="18%"><strong>Date</strong> :</td>
                                                          <td width="82%" id="iccattachdatedisplay">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>By</strong> :</td>
                                                          <td id="iccattachcreatedby">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2">&nbsp;</td>
                                                        </tr>
                                                      </table>
</div></td>
                                                        </tr>
                                                        <tr>
                                                          <td>&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Visit Details </span></div>
                                                    <div class="imp_dashboard_module" >
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                        <tr>
                                                          <td><strong>Total Visits: <span id="visittotal"></span></strong> </td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>Schedule</strong>:</td>
                                                        </tr>
                                                        <tr>
                                                          <td id="visitgriddisplay">&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Shipment Information </span></div>
                                                    <div class="imp_dashboard_module" style="height:150px">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                        <tr>
                                                          <td><div align="center" id="shippmentdisplaydiv1" style="display:none">
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td ><strong>Invoice Remarks :</strong></td>
                                                                </tr>
                                                                 <tr>
                                                                  <td id="shipinvoicedisplay">&nbsp;</td>
                                                                </tr>
                                                              </table>
                                                            </div></td>
                                                        </tr>
                                                        <tr>
                                                          <td><div align="center" id="shippmentdisplaydiv2" style="display:none"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><strong>Manual Remarks :</strong></td>
  </tr>
   <tr>
    <td id="shipmanualdisplay">&nbsp;</td>
  </tr>
</table>
</div></td>
                                                        </tr>
                                                        <tr><td>&nbsp;</td></tr>
                                                         <tr>
                                                          <td><div id="shippmentdisplaydiv3" style="display:none"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><strong>Not Applicable</strong></td>
  </tr>
</table>
</div></td>
                                                          </tr> 
                                                          <tr>
                                                          <td>&nbsp;</td>
                                                          </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Status of Visits </span></div>
                                                    <div class="imp_dashboard_module" >
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td id="statuvisitdisplay" style="padding:2px">&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Additional Information </span></div>
                                                    <div class="imp_dashboard_module" style="height:150px">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                        <tr>
                                                          <td ><strong>Invoice No</strong>: <span id="invoiceno"></span></td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>PO No/Date</strong> : <span id="datedisplay"></span></td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>No of Companies to be processed </strong>: <span id="noofcompanydisplay"></span></td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>No of Months to be processed</strong> : <span id="noofmonthdisplay"></span></td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>Processing from month</strong> : <span id="processmonthdisplay"></span></td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td><div class="imp_title_bar"  >
                                                      <div class="imp_rounder" ></div>
                                                      <span>Requriment Analysis</span></div>
                                                    <div class="imp_dashboard_module" style="height:150px">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                        <tr>
                                                          <td colspan="2" id="raffilename">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td width="18%"><strong>Date</strong> :</td>
                                                          <td width="82%" id="rafdatedisplay">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>By</strong> :</td>
                                                          <td id="rafcreatedby">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2">&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Add-on Module </span></div>
                                                    <div class="imp_dashboard_module" style="height:150px">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                        <tr>
                                                          <td id="addongriddisplay" >&nbsp;</td>
                                                        </tr >
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Customization Information </span></div>
                                                    <div class="imp_dashboard_module" >
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="3">
                                                        <tr>
                                                          <td><strong>Status</strong> : <span id="custstatusdisplay"></span></td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>Remarks</strong> : <span id="custremarksdisplay"></span></td>
                                                        </tr>
                                                        <tr><td><strong>Delivered files</strong>:</td></tr>
                                                        <tr>
                                                          <td ><div id="tabgroupgridc2" style="overflow:auto;; padding:1px;" align="center">
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><div id="tabgroupgridc1_2" align="center"></div></td>
                                        </tr>
                                        <tr>
                                          <td><div id="tabgroupgridc2link" style="height:20px; padding:1px;" align="left"> </div></td>
                                        </tr>
                                      </table>
                                      <div id="regresultgrid2" style="overflow:auto; display:none; padding:1px;" align="center"></div>
                                    </div></td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td valign="top"><div class="imp_title_bar"  >
                                                      <div class="imp_rounder"></div>
                                                      <span>Web Implementation</span></div>
                                                    <div class="imp_dashboard_module" style="height:150px">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                        <tr>
                                                          <td><div id="webimplementationdisplaydiv1" style="display:none"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td id="webimplementationdisplay">&nbsp;</td>
  </tr>
</table>
</div></td>
                                                        </tr>
                                                        <tr>
                                                          <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td ><div id="webimplementationdisplaydiv2" style="display:none"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><strong>Not Applicable</strong></td>
  </tr>
</table>
</div></td>
                                                        </tr>
                                                        <tr>
                                                          <td>&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td>&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                            <td width="50%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="1" >
                                                <tr>
                                                  <td><div class="imp_title_bar"  >
                                                      <div class="imp_rounder" ></div>
                                                      <span>Attendance Integration</span></div>
                                                    <div class="imp_dashboard_module" style="height:150px">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                        <tr>
                                                          <td colspan="2" ><strong>Vendor Details</strong> : <span id="vendordisplay"></span></td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2" id="aiffilename">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td width="18%"><strong>Date</strong> :</td>
                                                          <td width="82%" id="aifdatedisplay">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td><strong>By</strong> :</td>
                                                          <td id="aifcreatedby">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="2">&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                                </tr>
                                              </table></td>
                                          </tr>
                                          <tr>
                                            <td width="50%">&nbsp;</td>
                                            <td width="50%">&nbsp;</td>
                                          </tr>
                                        </table></td>
                                    </tr>
                                  </table>
                                </div></td>
                            </tr>
                            <tr>
                              <td>&nbsp;</td>
                            </tr>
                          </table>
                        </form></td>
                    </tr>
                    <tr><td><div style="display:none">
                   
                                <form action="" method="post" name="colorform" id="colorform" onsubmit="return false;">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td><div id='inline_example1' style='background:#fff; width:650px'>
                                          <table width="100%" border="0" cellspacing="0" cellpadding="5" >
                                                                                       
                                            
                                           <tr><td colspan="2"><div id="detailscontent" style=" width:637px;height:200px ;overflow:auto;"></div></td></tr>
                                           <tr><td colspan="2">&nbsp;</td></tr>
                                           <tr><td colspan="2" align="right"> <input type="button" value="Close" id="closepreviewbutton1"  onclick="$().colorbox.close();" class="swiftchoicebutton"/></td></tr>
                                          </table>
                                        </div></td>
                                    </tr>
                                  </table>
                                </form>
                              </div></td></tr> 
                              <tr><td><div style="display:none">
                   
                                <form action="" method="post" name="colorform1" id="colorform1" onsubmit="return false;">
                                  <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                    <tr>
                                      <td><div id='inline_example2' style='background:#fff; width:600px; height:130px'>
                                          <table width="100%" border="0" cellspacing="0" cellpadding="5" >
                                                                                       
                                            
                                            <tr bgcolor="#f7faff" >
                                              <td><strong>Remarks</strong> </td>
                                              <td><textarea name="remarks" cols="60" class="swifttextareanew" id="remarks" rows="3" style="resize: none;"></textarea></td><input type="hidden" id="implastslno" name="implastslno" value="" /><input type="hidden" id="customerid" name="customerid" value="" />
                                            </tr>
                                           
                                            <tr>
                                           <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
     <td id="process1">&nbsp;</td>
                                              <td align="right"><input type="button" name="approve" class="swiftchoicebutton" value="Confirm" id="approve" onclick="update('confirm')" />
                                                &nbsp;&nbsp;
                                                <input type="button" name="reject" value="Not Satisfactory" id="reject"   class="swiftchoicebuttonbig" onclick="update('notsatisfactory')"/>&nbsp;&nbsp;
                                                <input type="button" value="Close" id="closepreviewbutton2"  onclick="$().colorbox.close();" class="swiftchoicebutton"/></td>
  </tr>
</table>
</td>
                                            </tr>
                                          </table>
                                        </div></td>
                                    </tr>
                                  </table>
                                </form>
                              </div></td></tr>
                    <tr><td>&nbsp;</td></tr>
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
</html>
