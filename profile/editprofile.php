<? 
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<? include('../include/scriptsandstyles.php'); ?>
<title>Edit Profile | Relyon Customer Login Area</title>
<SCRIPT src="../functions/editprofile.js?dummy=<? echo (rand());?>" type=text/javascript></SCRIPT>
<script language="javascript" src="../functions/getdistrictjs.php?dummy=<? echo (rand());?>"></script>
</head>
<body onload="getcustomerdetails(<? echo($cusid); ?>);">
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
                <td class="content-mid"><table width="100%" border="0" cellspacing="5" cellpadding="0">
                    <tr>
                      <td class="subheadind-font">Edit Your Profile</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                     <tr>
                      <td >&nbsp;</td>
                    </tr>
                    <tr>
                      <td><form action="" method="post" name="submitform" id="submitform">
                      <table width="100%" border="0" cellspacing="0" cellpadding="5">
                                    <tr>
                                      <td width="100%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                          <td><table width="100%" border="0" cellspacing="0" cellpadding="4">
                                              <tr>
                                                <td width="2%" height="25" class="producttabheadnone"></td>
                                                <td width="18%" onclick="tabopen5('1','tabg1')" class="producttabheadactive" id="tabg1h1" style="cursor:pointer;"><div align="center"><strong>General Details</strong></div></td>
                                                <td width="2%" class="producttabheadnone"></td>
                                                <td width="18%" onclick="tabopen5('2','tabg1')" class="producttabhead" id="tabg1h2" style="cursor:pointer;"><div align="center"><strong>Contact Details</strong></div></td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%" class="producttabhead" ></td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%"  class="producttabhead" >&nbsp;</td>
                                                <td width="2%" class="producttabheadnone">&nbsp;</td>
                                                <td width="18%"  class="producttabhead">&nbsp;</td>
                                              </tr>
                                          </table></td>
                                        </tr>
                                        <tr>
                                          <td><div style="display:block;"  align="justify" id="tabg1c1" >
                                              <table width="100%" border="0" cellspacing="0" cellpadding="2" class="productcontent" height="515px">
                                                <tr>
                                                  <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="4" >
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="5" >
                                                          <tr>
                                                            <td><div id="updatewarningmeg" style="display:none">
                                                              <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                  <tr>
                                                                    <td class="errorbox">Your Profile Update Request is pending for approval by Relyon. This will be processed in few hours. If you wish to cancel this request, <a onclick="cancelupdate(<? echo($cusid); ?>);" style="cursor:pointer; color:#0000FF; ">click here</a>.</td>
                                                                  </tr>
                                                                </table>
                                                            </div>
                                                                <div id="cancelmeg" ></div></td>
                                                          </tr>
                                                          <tr>
                                                            <td></td>
                                                            <input type="hidden" name="lastslno" id="lastslno" />
                                                          </tr>
                                                          <tr>
                                                            <td width="50%" valign="top" class="swiftselect"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td align="left" valign="top" bgcolor="#F7FAFF">Customer ID:</td>
                                                                  <td align="left" valign="top" bgcolor="#F7FAFF"><input name="customerid" type="text" class="swifttext" id="customerid" style="background:#FEFFE6;" size="30" maxlength="17" readonly="readonly"  autocomplete="off"/>
                                                                      <input type="hidden" id="customerstatus" name="customerstatus" />                                                                  </td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td align="left" valign="top" bgcolor="#F7FAFF">GSTIN:</td>
                                                                  <td align="left" valign="top" bgcolor="#F7FAFF"><input name="gst_no" type="text" class="swifttext" id="gst_no" style="background:#FEFFE6;" size="30" onkeyup="changeToUpperCase(this)" maxlength="50" autocomplete="off" /> <input name="state_gst_code" type="hidden" class="swifttext" id="state_gst_code" style="background:#FEFFE6;" size="30" maxlength="50"  autocomplete="off"/>                                                                </td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="left" bgcolor="#EDF4FF">Business Name:</td>
                                                                  <td align="left" bgcolor="#EDF4FF"><input name="businessname" type="text" class="swift_mandatory" id="businessname" size="40" maxlength="50"  autocomplete="off" />                                                                  </td>
                                                                </tr>

                                                                <tr bgcolor="#f7faff">
                                                                  <td align="left" valign="top" bgcolor="#f7faff">Address:</td>
                                                                  <td align="left" valign="top" bgcolor="#f7faff"><input name="address" type="text" class="swifttext" id="address" size="40" maxlength="50"  autocomplete="off" />
                                                                      <br /></td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF">Place:</td>
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF"><input name="place" type="text" class="swift_mandatory" id="place" size="30" autocomplete="off" /></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF">State:</td>
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF"><select name="state" class="swift_mandatory" id="state"  onchange="getdistrict('districtcodedisplay',this.value);" onkeyup="getdistrict('districtcodedisplay',this.value);" style="width:200px" >
                                                                      <option value="">Select A State</option>
                                                                      <? include('../include/state.php'); ?>
                                                                  </select></td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td align="left" valign="top" bgcolor="#F7FAFF">District:</td>
                                                                  <td align="left" valign="top" bgcolor="#F7FAFF" id="districtcodedisplay"><select name="district" class="swift_mandatory" id="district" style="width:200px">
                                                                      <option value="">Select A State First</option>
                                                                  </select></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF">Pin Code:</td>
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF"><input name="pincode" type="text" class="swift_mandatory" id="pincode" size="30" maxlength="6"  autocomplete="off" /></td>
                                                                </tr>
                                                                <tr bgcolor="#F7FAFF">
                                                                  <td align="left" valign="top">STD Code:</td>
                                                                  <td align="left" valign="top"><input name="stdcode" type="text" class="swift_mandatory" id="stdcode" size="30" maxlength="10"  autocomplete="off" /></td>
                                                                </tr>

                                                                <tr bgcolor="#f7faff">
                                                                  <td align="left" valign="top" bgcolor="#f7faff">Fax:</td>
                                                                  <td align="left" valign="top" bgcolor="#f7faff"><input name="fax" type="text" class="swift_mandatory" id="fax" size="30" maxlength="80" autocomplete="off" style="background:#FFFFFF" /></td>
                                                                </tr>

                                                                <tr bgcolor="#f7faff">
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF">Website:</td>
                                                                  <td align="left" valign="top" bgcolor="#EDF4FF"><input name="website" type="text" class="swifttext" id="website" size="30" maxlength="80" autocomplete="off" />
                                                                      <br /></td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td align="left" valign="top" bgcolor="#f7faff">Type:</td>
                                                                  <td align="left" valign="top" bgcolor="#f7faff"><select name="type" class="swift_mandatory" id="type" style="width:200px">
                                                                      <option value="" selected="selected">Type Selection</option>
                                                                      <? 
											include('../include/custype.php');
												?>
                                                                  </select></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td height="30" align="left" valign="top" bgcolor="#edf4ff">Category:</td>
                                                                  <td align="left" valign="top" bgcolor="#edf4ff"><select name="category" class="swift_mandatory" id="category" style="width:200px">
                                                                      <option value="">Category Selection</option>
                                                                      <? 
											include('../include/category.php');
												?>
                                                                  </select></td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td height="19" align="left" valign="top" bgcolor="#f7faff">Promotional SMS:</td>
                                                                  <td align="left"  valign="top" bgcolor="#f7faff"><input type="checkbox" id="promotionalsms" name="promotionalsms" /></td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td height="19" align="left" valign="top" bgcolor="#edf4ff">Promotional Email:</td>
                                                                  <td align="left"  valign="top" bgcolor="#edf4ff"><input type="checkbox" id="promotionalemail" name="promotionalemail"/></td>
                                                                </tr>
                                                                <tr bgcolor="#edf4ff">
                                                                  <td height="19" align="left" valign="top" bgcolor="#f7faff">Updated Date:</td>
                                                                  <td align="left"  valign="top" bgcolor="#f7faff" id="createddate" >Not Available</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td align="left" valign="top" bgcolor="#edf4ff"><label>
                                                                    <input type="checkbox" name="disablelogin" id="disablelogin" />
                                                                  </label></td>
                                                                  <td align="left" valign="top" bgcolor="#edf4ff">Yes, I want to Update my Profile</td>
                                                                </tr>
                                                            </table></td>
                                                          </tr>
                                                      </table></td>
                                                    </tr>
                                                  </table></td>
                                                </tr>
                                              </table>
                                          </div>
                                              <div style="display:none;" align="justify" id="tabg1c2">
                                                      <table width="100%" border="0" cellspacing="0" cellpadding="2" class="productcontent" height="515px">
                                                        <tr>
                                                          <td colspan="2" valign="top"><table width="100%" border="0" cellspacing="3" cellpadding="0"  >
                                                              <tr>
                                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                    <tr>
                                                                      <td ><table width="100%" border="0" cellspacing="0" cellpadding="5" style="color:#646464; font-weight:bold">
                                                                          <tr>
                                                                            <td width="2%">&nbsp;</td>
                                                                            <td width="19%" ><div align="center">Type</div></td>
                                                                            <td width="17%"><div align="center">Name</div></td>
                                                                            <td width="20%"><div align="center">Phone</div></td>
                                                                            <td width="13%"><div align="center">Cell</div></td>
                                                                            <td width="25%"><div align="center">Email Id</div></td>
                                                                            <td width="4%">&nbsp;</td>
                                                                          </tr>
                                                                        </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td ><table width="100%" border="0" cellspacing="0" cellpadding="3"  id="adddescriptionrows">
                                                                          <tr id="removedescriptionrow1">
                                                                            <td width="6%"><div align="left"><strong>1</strong></div></td>
                                                                          <td width="17%"><div align="center">
                                                                                <select name="selectiontype1" id="selectiontype1" style="width:115px" class="swift_mandatory">
                                                                                  <option value="" selected="selected" >--Select--</option>
                                                                                  <option value="general" >General</option>
                                                                                  <option value="gm/director">GM/Director</option>
                                                                                  <option value="hrhead">HR Head</option>
                                                                                  <option value="ithead/edp">IT-Head/EDP</option>
                                                                                  <option value="softwareuser" >Software User</option>
                                                                                  <option value="financehead">Finance Head</option>
                                                                    		  <option value="manager" >MANAGER</option>              	
                                                                                  <option value="CA" >CA</option>
                                                                                  <option value="others" >Others</option>
                                                                                </select>
                                                                            </div></td>
                                                                          <td width="17%"><div align="center">
                                                                                <input name="name1" type="text" class="swifttext" id="name1"  style="width:100px"  maxlength="70"  autocomplete="off"/>
                                                                            </div></td>
                                                                            <td width="17%"><div align="center">
                                                                                <input name="phone1" type="text"class="swifttext" id="phone1" style="width:100px" maxlength="100"  autocomplete="off" />
                                                                            </div></td>
                                                                            <td width="16%"><div align="center">
                                                                                <input name="cell1" type="text" class="swifttext" id="cell1" style="width:90px"  maxlength="10"  autocomplete="off"/>
                                                                              </div></td>
                                                                          <td width="22%"><div align="center">
                                                                                <input name="emailid1" type="text" class="swifttext" id="emailid1" style="width:120px"  maxlength="200"  autocomplete="off"/>
                                                                            </div></td>
                                                                            <td width="5%"><font color = "#FF0000"><strong><a id="removerowdiv1" onclick ="removedescriptionrows('removedescriptionrow1','1')" style="cursor:pointer;">X</a></strong></font>
                                                                            <input type="hidden" name="contactslno1" id="contactslno1" /></td>
                                                                          </tr>
                                                                          
                                                                        </table></td>
                                                                    </tr>
                                                                    <tr>
                                                                      <td><div align="left" id="adddescriptionrowdiv">
                                                                          <div align="right"><a onclick="adddescriptionrows();" style="cursor:pointer" class="r-text">Add one More >></a></div>
                                                                        </div></td>
                                                                    </tr>
                                                                  </table></td>
                                                              </tr>
                                                            </table></td>
                                                        </tr>
                                                      </table>
                                                    </div></td>
                                        </tr>
                                      </table></td>
                                    </tr>
                                    <tr><td><table width="100%" border="0" cellspacing="0" cellpadding="0" >
                                          <tr>
                                            <td width="65%" height="35" align="left" valign="middle" ><div id="form-error" align="left">&nbsp;</div></td>
                                            <td  align="right" valign="middle"><input name="update" type="button" class="swiftchoicebutton" id="update" value="Update" onclick="validation(<? echo($cusid); ?>);" />
                                              &nbsp;&nbsp;&nbsp;
                                            <input name="clear" type="reset" class="swiftchoicebutton" id="reset" value="Reset"   onClick="document.getElementById('form-error').innerHTML = ''; validate(<? echo($cusid); ?>)"  />&nbsp;                                              </td>
                                        </tr>
                                      </table></td></tr>
                                    
                                  </table>
                      </form></td>
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
