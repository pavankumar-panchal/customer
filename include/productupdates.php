<?php
	include('../functions/phpfunctions.php'); 
	include('../include/checksession.php');
	//$cusid=imaxgetcookie('custuserid');
	//$cusid = $_COOKIE['userid'];
	
	//Assign the product codes to upgrade patches
	$tdsparray = array('942','634','708','744','635','638','639','641','642');
	$tdscarray = array('954','963','951','961','955','965','964','956','636','715','752','645','647','650','652','656');
	$tdsiarray = array('960','966','637','720','760','646','648','651','653','657');
	$stoarray = array('346','349','345','321','348','384','366','330','350','351','352');
	$sitarray = array('303','304','305','306','307');
	$saiarray = array('210','211','212','213');
	$svharray = array('471','469','472','473','475');
	$svxarray = array('464','470','474');
	$sviarray = array('511','512','513','509');
	$spparray = array('851','869','870','874','876','875');
	$sesarray = array('101');
	$scommuarray = array('160');
	$sxbrlarray = array('239');
	$sst3array = array('369');
	
	//Define a "Have Upgrades" variable for checking the display. If none are there, then show as "No upgrades available"
	$haveupgrades = false;

	
	//Get the list of product codes used by customer
	$customerproductsarray = array();
	$query1 = "select distinct left(computerid,3) as customerproducts from inv_customerproduct where customerreference = '".$cusid."';";
	$result1 = runmysqlquery($query1);
	while($fetch1 = mysqli_fetch_array($result1))
	{	
		$customerproductsarray[] = $fetch1['customerproducts'];
	}
		

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product Updates | Relyon Customer Login Area</title>
<?php include('../include/scriptsandstyles.php'); ?>
<SCRIPT src="../functions/javascript.js" type=text/javascript></SCRIPT>
<SCRIPT src="../functions/pnginner.js" type=text/javascript></SCRIPT>
</head>
<body>
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
                <td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="5">
                    <tr>
                      <td class="subheadind-font">Product Updates</td>
                    </tr>
                    <tr>
                      <td class="blueline" height="4px"></td>
                    </tr>
                    <tr>
                      <td><table  width="100%" border="0" cellspacing="0" cellpadding="0" >
                          <?php if(matcharray($tdsparray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh1" onclick="tabopen14('1','tab');"><font color="#0000CC"><strong>Saral TDS - Professional</strong></font></div>
                                          <div  id="tabc1" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">1.</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.04</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">01 August 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">24.20 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltds/stds-prof-1200-to-1204.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                                            <tr>
                                            <td>&nbsp;
                                            
                                            </td>
                                            </tr>
                                             <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">2.</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.03</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">30 June 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">21.80 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltds/stds-prof-1200-to-1203.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                       <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">04 July 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.03</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">3.63 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltds/hf-tds-prof-1203-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    
                                            <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">3.</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.02</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">21 May 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">18.70 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltds/stds-prof-1200-to-1202.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                     <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">06 June 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.02</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">4.50 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltds/hf-tds-prof-1202-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    
                  </table>                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($tdscarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh2" onclick="tabopen14('2','tab');"><font color="#0000CC"><strong>Saral TDS - Corporate </strong></font></div>
                                          <div  id="tabc2" style=" display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            
                                            <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">1.</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.04</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">01 August 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">29.80 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdscorp/stds-corp-1200-to-1204.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                    <td>&nbsp;
                    </td></tr>
                                             <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">2.</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.03</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">30 June 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">27.30 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdscorp/stds-corp-1200-to-1203.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">04 July 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.03</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">5.90 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdscorp/hf-tds-corp-1203-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                                              <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">3.</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.02</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">21 May 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">25.6 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdscorp/stds-corp-1200-to-1202.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                              <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">06 June 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.02</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">8.03 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdscorp/hf-tds-corp-1202-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                                            
                                                  
                                            </table>

                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($tdsiarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><div>
                                <table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                  <tr>
                                    <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                        <tr bgcolor="#f7faff">
                                          <td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh3" onclick="tabopen14('3','tab');"><font color="#0000CC"><strong>Saral TDS - Institutional </strong></font></div>
                                            <div  id="tabc3" style="display:none; padding:5px ">
                                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">1.</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.04</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">01 August 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">31 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdsinst/stds-inst-1200-to-1204.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                    <td>&nbsp;</td></tr>
                                               <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">2.</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.03</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">30 June 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">28.60 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdsinst/stds-inst-1200-to-1203.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                     <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">HotFix</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">04 July 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.03</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">5.90 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdsinst/hf-tds-inst-1203-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    
                                                <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">3.</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">12.02</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">21 May 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">25.60 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdsinst/stds-inst-1200-to-1202.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                     <tr>
                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      
                          <tr>
                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                <tr bgcolor="#edf4ff">
                                  <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td width="35%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                  <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">06 June 2012</td>
                                </tr>
                                <tr bgcolor="#f7faff" >
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.02</td>
                                </tr>
                                <tr bgcolor="#f7faff">
                                  <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                  <td valign="top" bgcolor="#f7faff" class="product_content">8.03 MB</td>
                                </tr>
                              </table></td>
                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td>&nbsp;</td>
                                </tr>
                                <tr>
                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saraltdsinst/hf-tds-inst-1202-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                                </tr>
                              </table></td>
                          </tr>
                        </table></td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                                               
                                                      
                                                
                                              </table>
                                            </div></td>
                                        </tr>
                                      </table></td>
                                  </tr>
                                </table>
                              </div></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($stoarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh4" onclick="tabopen14('4','tab');"><font color="#0000CC"><strong>Saral TaxOffice</strong></font></div>
                                          <div  id="tabc4" style="display:none;padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td valign="top" style="padding:5px"><strong>1.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.08</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">14 August 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.02) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">23.7 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sto/sto-7002-to-7008.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    
                                                    <!--<tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.07</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">30 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.02) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">23 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/sto-7002-to-7007.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>-->
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                    <td>&nbsp;
                                                    
                                                    </td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            <!--<tr>
                                                <td valign="top" style="padding:5px"><strong>2.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.06</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">20 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.02) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">24.30 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/sto-7002-to-7006.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">2</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">26 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.06) Only</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">8.60 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/hf-sto-7006-2.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                           <!--   <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>-->
                                             <!--<tr>
                                                <td valign="top" style="padding:5px"><strong>3.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.05</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">05 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.02) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">17.80 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/sto-7002-to-7005.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            <!--<tr>
                                                <td valign="top" style="padding:5px"><strong>4.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.04</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">04 June 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.02) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">16.5 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/sto-7002-to-7004.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                              <!--<tr>
                                                <td valign="top" style="padding:5px">&nbsp;</td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">4</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">23 June 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.04) Only</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">8.92 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/hf-sto-7004-4.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            <!--<tr>
                                                <td valign="top" style="padding:5px"><strong>5.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.03</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">14 May 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"> Saral TaxOffice 2011 (Version 6.01) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">12.4 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/sto-7002-to-7003.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                               <!--<tr>
                                                <td valign="top" style="padding:5px">&nbsp;</td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">3</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">26 May 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"> Saral TaxOffice 2012 (Version 7.03) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">10.60 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/sto/hf-sto-7003-3.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                              <tr>
                                                <td valign="top" style="padding:5px"><strong>6.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Patch</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.02</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">05 May 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"> Saral TaxOffice 2011 (Version 6.01) and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">58.1  MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sto/sto-6001-to-7002.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                        </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($sitarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh5" onclick="tabopen14('5','tab');"><font color="#0000CC"><strong>Saral IncomeTax </strong></font></div>
                                          <div  id="tabc5" style=" display:none;padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="5%" valign="top" style="padding:5px"><strong>1.</strong></td>
                                                <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">7.08</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">14 August 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.02 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">14.8 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralincometax/sit-7002-to-7008.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                    <td>&nbsp;</td>
                                                                                                          </tr>
                                                                                                          <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          
                                                        </table></td>
                                                    </tr>
                                                    
                                                  </table></td>
                                              </tr>
                                            <!--<tr>
                                                <td width="5%" valign="top" style="padding:5px"><strong>1.</strong></td>
                                                <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">7.07</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">30 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.02 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">15 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/sit-7002-to-7007.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                    <td>&nbsp;</td>
                                                                                                          </tr>
                                                                                                          <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff" >
                                                                  <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                                                  <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">2</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">02 August 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Saral TaxOffice 2012 (Version 7.07) Only</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">4.74 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/hf-sit-7007-2.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                    <td>&nbsp;
                                                    
                                                    </td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            <!--<tr>
                                                <td width="5%" valign="top" style="padding:5px"><strong>2.</strong></td>
                                                <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">7.06</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">20 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.02 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">14.50 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/sit-7002-to-7006.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">2</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">26 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.06 Only</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">6.20 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/hf-sit-7006-2.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            
                                             <!--<tr>
                                                <td width="5%" valign="top" style="padding:5px"><strong>3.</strong></td>
                                                <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">7.05</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">05 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.02 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">12.8 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/sit-7002-to-7005.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                              
                                            <!--<tr>
                                                <td width="5%" valign="top" style="padding:5px"><strong>4.</strong></td>
                                                <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">7.04</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">05 June 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.02 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">12.2 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/sit-7002-to-7004.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                              
                                              <!--<tr>
                                                <td width="5%" valign="top" style="padding:5px">&nbsp;</td>
                                                <td width="95%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">4</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">23 June 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">  v7.04 Only</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">6.25 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralincometax/hf-sit-7004-4.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                              
                                              <tr>
                                                <td valign="top" style="padding:5px"><strong>5.</strong></td>
                                                <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff">
                                                                  <td width="38%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                                  <td width="62%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF3300">7.02</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">07 May 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content"> Version 6.01</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff">
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">41.5  MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralincometax/sit-6001-to-7002.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                        </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($saiarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font" ><div class="product-font" id="tabh6" onclick="tabopen14('6','tab');"><font color="#0000CC"><strong>Saral Accounts </strong></font></div>
                                          <div  id="tabc6" style="display:show; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="4%" valign="top" style="padding:5px"><strong>1.</strong></td>
                                                <td width="96%" ><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff"  >
                                                                  <td width="31%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                                  <td width="69%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">6.02</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">26 July 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.00 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">18.90 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sai/sai-6000-to-6002.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td width="4%" valign="top" style="padding:5px">&nbsp;</td>
                                                <td width="96%" ><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff"  >
                                                                  <td width="31%" valign="top" bgcolor="#EDF4FF" class="product_content" ><font color="#FF0000">Hotfix</font></td>
                                                                  <td width="69%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">2</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">02 August 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">v 6.02 Only</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">5.74 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sai/hf-sai-6002-2.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            <tr>
                                                <td width="4%" valign="top" style="padding:5px"><strong>2.</strong></td>
                                                <td width="96%" ><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff"  >
                                                                  <td width="31%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                                  <td width="69%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">6.01</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">23 May 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.00 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">14.20 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sai/sai-600-to-601.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td width="4%" valign="top" style="padding:5px"><strong>3.</strong></td>
                                                <td width="96%" ><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff"  >
                                                                  <td width="31%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                                  <td width="69%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">6.00</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">29 February 2012</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 5.00 and above</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">27.90 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sai/sai-500-to-600.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
                                                          </tr>
                                                        </table></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td style="padding:5px" valign="top"><strong>4.</strong></td>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                          <tr>
                                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                                <tr bgcolor="#edf4ff"  >
                                                                  <td width="31%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                                  <td width="69%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">5.00</font></strong></td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Dated</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">24 March 2011</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                                  <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 4.00 to 5.00</td>
                                                                </tr>
                                                                <tr bgcolor="#f7faff" >
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                                  <td valign="top" bgcolor="#f7faff" class="product_content">13.25 MB</td>
                                                                </tr>
                                                              </table></td>
                                                            <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td>&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/sai/sai-400-to-500.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                                </tr>
                                                              </table></td>
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
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($svharray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr >
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font"><div class="product-font" id="tabh7" onclick="tabopen14('7','tab');"><font color="#0000CC"><strong>Saral VAT100 - Standard / Premium</strong></font></div>
                                          <div  id="tabc7" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content" ><strong>1.</strong></td>
                                                      <td width="49%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                      <td width="42%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.03</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">30  July 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">7.00 and Above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">4.70 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvat100/svh-7000-to-7003.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                                                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                             <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content" ><strong>2.</strong></td>
                                                      <td width="49%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                      <td width="42%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.02</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">13  July 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">7.00 and Above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">4.70 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvat100/svh-7000-to-7002.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                                                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                            <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content" ><strong>3.</strong></td>
                                                      <td width="49%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                      <td width="42%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.01</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">12  June 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">7.00 and Above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">4.60 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvat100/svh-7000-to-7001.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                                                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>

                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content" ><strong>4.</strong></td>
                                                      <td width="49%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                      <td width="42%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">5.32</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">12  May 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">5.00 and Above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">5.14 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvat100/svh-500-to-532.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content" ><strong>5.</strong></td>
                                                      <td width="49%" valign="top" bgcolor="#EDF4FF" class="product_content" >Version</td>
                                                      <td width="42%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">06  February 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">6.07 and Above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">4.54MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvat100/svh-607-to-700.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($svxarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font"><div class="product-font" id="tabh8" onclick="tabopen14('8','tab');"><font color="#0000CC"><strong>Saral VATXML</strong></font></div>
                                          <div  id="tabc8" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff"  >
                                                      <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content">1.</td>
                                                      <td width="42%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                      <td width="50%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">4.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">3 March 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">2.00 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">552 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatxml/svx-300-to-400.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($sviarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr >
                                        <td colspan="4" valign="top" bgcolor="#f7faff" ><div class="product-font" id="tabh9" onclick="tabopen14('9','tab');"><strong><font color="#0000CC">Saral VATInfo</font></strong> </div>
                                         <!-- <div  id="tabc9" style="display:none; padding:5px ">-->
                                         <div  id="tabc9" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                  <tr bgcolor="#EDF4FF" >
                                                    <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>1. Version<font color="#FF0000"> 12.00 to 12.01 </font></strong></td>
                                                  </tr>
                                                  <tr bgcolor="#f7faff">
                                                    <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                    <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                    <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">12 May 2012</td>
                                                  </tr>
                                                  <tr bgcolor="#f7faff">
                                                    <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                    <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                    <td valign="top" bgcolor="#EDF4FF" class="product_content">v12 Above</td>
                                                  </tr>
                                                  <tr bgcolor="#f7faff">
                                                    <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                    <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                    <td valign="top" bgcolor="#f7faff" class="product_content">2.4 MB</td>
                                                  </tr>
                                                </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-1200-to-1201.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                  </tr>
                                                </table></td>
                                              </tr>
                                              
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                  <tr bgcolor="#EDF4FF" >
                                                    <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>2. Version<font color="#FF0000"> 11.03 to 12</font></strong></td>
                                                  </tr>
                                                  <tr bgcolor="#f7faff">
                                                    <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                    <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                    <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">20 April 2012</td>
                                                  </tr>
                                                  <tr bgcolor="#f7faff">
                                                    <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                    <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                    <td valign="top" bgcolor="#EDF4FF" class="product_content">v11.03 to 12</td>
                                                  </tr>
                                                  <tr bgcolor="#f7faff">
                                                    <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                    <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                    <td valign="top" bgcolor="#f7faff" class="product_content">2387 KB</td>
                                                  </tr>
                                                </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td>&nbsp;</td>
                                                  </tr>
                                                  <tr>
                                                    <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-1103-to-1200.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                  </tr>
                                                </table></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>3. Version<font color="#FF0000"> 11.02 to 11.03</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">07 January 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v11.02 to 11.03</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">1644 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-1102-to-1103.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>4. Version<font color="#FF0000"> 11.01 to 11.02</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">10 October 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v11.01 to 11.02</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">1776 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-1101-to-1102.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>5. Version<font color="#FF0000"> 11.00 to 11.01</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">06 July 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v11.00 to 11.01</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">1408 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-1100-to-1101.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>6. Version<font color="#FF0000"> 10.04 to 11.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">28 April 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v10.04 to 11.00</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">1904 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-104-to-11.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>7. Version<font color="#FF0000"> 9.03 to 10.04</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">07 January 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.03</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">3116 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-903-to-1004.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>8. Version<font color="#FF0000"> 9.03 to 10.03</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="7%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="55%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">05 October 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.03</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">2724 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-903-to-1003.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>9. Version<font color="#FF0000"> 9.03 to 10.02</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="8%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="54%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">07 August 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.03</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">2724 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-903-to-1002.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>10. Version<font color="#FF0000"> 9.03 to 10.01</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="8%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="54%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">10 June 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.03</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">2004 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-903-to-1001.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff">
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>11. Version <font color="#FF0000">9.03 to 10.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="8%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="54%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">13 May 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.01</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">1.83 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-903-to-100.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>12. Version<font color="#FF0000"> 9.02 to 9.03</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="8%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="41%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="51%" valign="top" bgcolor="#f7faff" class="product_content">12 January 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.01</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">1.1 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-902-to-903.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#EDF4FF" >
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>13. Version<font color="#FF0000"> 9.01 to 9.02</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="8%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="40%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="52%" valign="top" bgcolor="#f7faff" class="product_content">07 October 2009</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.01</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">776 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-901-to-902.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#f7faff">
                                                      <td colspan="3" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>14. Version <font color="#FF0000">9.00 to 9.01</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td width="8%" valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td width="54%" valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td width="38%" valign="top" bgcolor="#f7faff" class="product_content">10 July 2009</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v9.00</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">968 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr></tr>
                                                    <tr></tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatinfo/svi-900-to-901.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($spparray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh10" onclick="tabopen14('10','tab');"><font color="#0000CC"><strong>Saral PayPack - Professional / Standard / Premium</strong></font></div>
                                          <div  id="tabc10" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                            <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
      <tr bgcolor="#edf4ff"  >
        <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>1.</strong></td>
        <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.01 Upgrade</td>
        <td width="34%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"> 6.02</font></strong></td>
      </tr>
      <tr bgcolor="#f7faff">
        <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">19 July 2012</td>
      </tr>
      <tr bgcolor="#f7faff">
        <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
        <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
        <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.01</td>
      </tr>
      <tr bgcolor="#f7faff">
        <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">45.2 MB</td>
      </tr>
    </table></td>
    <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/SaralPayPack6p02.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
      </tr>
    </table></td>
    
    <tr><td>&nbsp;</td></tr>
  <tr>
    <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
      <tr bgcolor="#edf4ff"  >
        <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>2.</strong></td>
        <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.00 Upgrade</td>
        <td width="34%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"> 6.01</font></strong></td>
      </tr>
      <tr bgcolor="#f7faff">
        <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">13 April 2012</td>
      </tr>
      <tr bgcolor="#f7faff">
        <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
        <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
        <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.00</td>
      </tr>
      <tr bgcolor="#f7faff">
        <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
        <td valign="top" bgcolor="#f7faff" class="product_content">28.12 MB</td>
      </tr>
    </table></td>
    <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/SaralPayPack6p01.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
      </tr>
    </table></td>
    
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
          <tr bgcolor="#edf4ff">
            <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
            <td width="44%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>
            <td width="47%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
          </tr>
          <tr bgcolor="#f7faff">
            <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
            <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
            <td valign="top" bgcolor="#f7faff" class="product_content">11 May 2012</td>
          </tr>
          <tr bgcolor="#f7faff" >
            <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
            <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
            <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.01</td>
          </tr>
          <tr bgcolor="#f7faff">
            <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
            <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
            <td valign="top" bgcolor="#f7faff" class="product_content">9.6 MB</td>
          </tr>
        </table></td>
        <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/SaralPayPack6p01_Fix_1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff"  >
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>3.</strong></td>
                                                      <td width="57%" valign="top" bgcolor="#EDF4FF" class="product_content">Version 5 Upgrade</td>
                                                      <td width="34%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"> 6.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">16 January 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 6.00</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">37.35 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/SaralPayPack6p0.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff"  >
                                                      <td width="8%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>4.</strong></td>
                                                      <td width="46%" valign="top" bgcolor="#EDF4FF" class="product_content">Version 5 Upgrade</td>
                                                      <td width="46%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"> 5.01</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">11 Febrauary 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 5.00</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">16.42 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/Saral PayPack_5p01.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                            </table>
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff"  >
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong>5.</strong></td>
                                                      <td width="45%" valign="top" bgcolor="#EDF4FF" class="product_content">Version 4 Upgrade</td>
                                                      <td width="46%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"> 5.01</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">11 Febrauary 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 4.00</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">16.42 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/SaralPayPack_5p01_Upgrade.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td colspan="2">&nbsp;</td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($sesarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh11" onclick="tabopen14('11','tab');"><font color="#0000CC"><strong>Saral Sign</strong></font></div>
                                          <div  id="tabc11" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="8%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>1.</strong></td>
                                                      <td width="33%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="59%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1.04</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">15 May 2009</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 1.00 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">636 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralesign/ses-100-to-104.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($scommuarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh12" onclick="tabopen14('12','tab');"><font color="#0000CC"><strong>Saral Comminicator</strong></font></div>
                                          <div  id="tabc12" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="8%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>1.</strong></td>
                                                      <td width="33%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="59%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1.03</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">14 September 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 1.00 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">8.05 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralcommunicator/sc-100-to-103.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($sxbrlarray,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh13" onclick="tabopen14('13','tab');"><font color="#0000CC"><strong>Saral XBRL</strong></font></div>
                                          <div  id="tabc13" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                      <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="8%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>1.</strong></td>
                                                      <td width="33%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="59%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">2.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">28 January 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 1.00 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">12.1 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralxbrl/xbrl-1000-to-2000.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="8%" valign="top" bgcolor="#EDF4FF"class="product_content" >&nbsp;</td>
                                                      <td width="33%" valign="top" bgcolor="#EDF4FF"class="product_content" >Hotfix</td>
                                                      <td width="59%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">29 June 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Version 2.00 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">528 KB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralxbrl/hf-xbrl-2000-1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <tr>
                                              <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                              </tr>
                                              <!--<tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td valign="top" bgcolor="#EDF4FF"class="product_content" >Hotfix</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">3</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">31 December 2011</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">1.03</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">3.59 MB</td>
                                                    </tr>
                                                </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralxbrl/hf-xbrl-1003-3.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                </table></td>
                                              </tr>-->
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if(matcharray($sst3array,$customerproductsarray)){ $haveupgrades = true; ?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh14" onclick="tabopen14('14','tab');"><font color="#0000CC"><strong>Saral eST3</strong></font></div>
                                          <div  id="tabc14" style="display:none; padding:5px ">
                                                  <!-- Start of V7.05-->
                                          
                                          <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <td width="61%">
                                                <table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>1.</strong></td>
                                                      <td width="40%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="51%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.08</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">14 August 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content"> v7.02 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">4.96 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralest3/st3-7002-to-7008.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                                <!--<td width="61%">
                                                <table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>1.</strong></td>
                                                      <td width="40%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="51%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.06</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">20 July 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content"> v7.02 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">7.35 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralest3/st3-7002-to-7006.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            </table>
                                       
                       <!-- End Of V7.06 -->
                                                                       <!-- Start of V7.05-->
                                          
                                         <!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
    <tr bgcolor="#edf4ff">
                                                      <td height="25" valign="top" bgcolor="#EDF4FF"class="product_content" >&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF"class="product_content" >&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                              </tr>                                                <!--<td width="61%">
                                                <table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>2.</strong></td>
                                                      <td width="40%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="51%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.05</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">05 July 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content"> v7.02 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">4.80 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralest3/st3-7002-to-7005.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            </table--><!-- End Of V7.05 -->
                       
                             <!-- Start of V7.04-->
                                          
                                      <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              
                                                  <!--<td width="61%">
                                                <table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                
                                                    <tr bgcolor="#edf4ff">
                                                      <td valign="top" bgcolor="#EDF4FF"class="product_content" >&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF"class="product_content" >&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                    </tr>
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>3.</strong></td>
                                                      <td width="40%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="51%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.04</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">05 June 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content"> v7.02 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">5.24 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralest3/st3-7002-to-7004.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>-->
                                            </table>
                                       
                       <!-- End Of V7.04 -->
                                  
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              
                                                <td width="61%">
                                                <table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td width="9%" valign="top" bgcolor="#EDF4FF"class="product_content" ><strong>4.</strong></td>
                                                      <td width="41%" valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td width="50%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.02</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">05 May 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">6.12 and above</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">&nbsp;</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">15.28 MB</td>
                                                    </tr>
                                                  </table></td>
                                                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td>&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralest3/st3-6012-to-7002.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
                                                    </tr>
                                                  </table></td>
                                              </tr>
                                            </table>
                                          </div></td>
                                      </tr>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <?php if($haveupgrades == false){?>
                          <tr>
                            <td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
                                <tr>
                                  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
                                      <tr bgcolor="#f7faff">
                                        <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font">
                                            <div align="center" style="font-size:16px; font-weight:bold"><font color="#FF3333">There are no Upgrade Patches for your existing licenses.</font></div>
                                          </div>
                                    </table></td>
                                </tr>
                              </table></td>
                          </tr>
                          <?php } ?>
                          <tr>
                            <td >&nbsp;</td>
                          </tr>
                          <tr>
                            <td >&nbsp;</td>
                          </tr>
                        </table></td>
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
    <td><?php include('../include/footer.php') ?></td>
  </tr>
</table>
</body>
</html>
