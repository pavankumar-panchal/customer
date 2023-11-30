<?
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
include_once ('prd_function.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Product (Full)| Relyon Customer Login Area</title>
<? include('../include/scriptsandstyles.php'); ?>
<style type="text/css">
.productlink
{
	font-size:12px; 
	text-decoration:none;
	color:#424AEC;
}

a:hover
{
	color:#FF8000;
}
</style>
<SCRIPT src="../functions/pnginner.js" type=text/javascript></SCRIPT>
</head>
<body>
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
<td class="content-mid"><table width="100%" border="0" cellspacing="0" cellpadding="5">
<tr>
<td class="subheadind-font">Product (Full)</td>
</tr>
<tr>
<td class="blueline" height="4px"></td>
</tr>
<tr>
<td><table  width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh1" onclick="tabopen14('1','tab');"><font color="#0000CC"><strong>Saral TDS - Professional</strong></font></div>
  <div  id="tabc1" style="display:none; padding:5px ">
<?php
$product ='Saral TDSProfessional';
product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh2" onclick="tabopen14('2','tab');"><font color="#0000CC"><strong>Saral TDS - Corporate </strong></font></div>
  <div  id="tabc2" style="display:none; padding:5px ">
<?php
$product ='Saral TDSCorporate';
product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh3" onclick="tabopen14('3','tab');"><font color="#0000CC"><strong>Saral TDS - Institutional </strong></font></div>
	<div  id="tabc3" style="display:none; padding:5px ">
<?php
$product ='Saral TDSInstitutional';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>


<!-- Product Added sep-09 2016  Comes Here -->
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh28" onclick="tabopen14('28','tab');"><font color="#0000CC"><strong>Saral GST </strong></font></div>
	<div  id="tabc28" style="display:none; padding:5px ">
<?php
$product ='Saral GST';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>



<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh21" onclick="tabopen14('21','tab');"><font color="#0000CC"><strong>Saral TDS.Corporate </strong></font></div>
	<div  id="tabc21" style="display:none; padding:5px ">
<?php
$product ='Saral TDS.Corporate';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>


<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh22" onclick="tabopen14('22','tab');"><font color="#0000CC"><strong>Saral TDS.Professional </strong></font></div>
	<div  id="tabc22" style="display:none; padding:5px ">
<?php
$product ='Saral TDS.Professional';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>


<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh23" onclick="tabopen14('23','tab');"><font color="#0000CC"><strong>Saral TDS.Institutional</strong></font></div>
	<div  id="tabc23" style="display:none; padding:5px ">
<?php
$product ='Saral TDS.Institutional';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>



<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh24" onclick="tabopen14('24','tab');"><font color="#0000CC"><strong>Saral FinTrac - Premium </strong></font></div>
	<div  id="tabc24" style="display:none; padding:5px ">
<?php
$product ='Saral FinTrac - Premium';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>


<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh25" onclick="tabopen14('25','tab');"><font color="#0000CC"><strong>Saral FinTrac - Professional </strong></font></div>
	<div  id="tabc25" style="display:none; padding:5px ">
<?php
$product ='Saral FinTrac - Professional';
 product_setup($product);
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<!-- Product Added sep-09 2016-- ends -->


<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh20" onclick="tabopen14('20','tab');"><font color="#0000CC"><strong>Saral TDS - Plus </strong></font></div>
	<div id="tabc20" style="display:none; padding:5px ">
<?php
$product ='Saral TDSPlus';
 product_setup($product);
 echo "<br>";
 echo '<a class="productlink" href="https://www.etds-payroll-salary-software-india.com/downloads/SaralTDSPlus/Saral_TDSPlus_Installation_Guide.pdf" target="_blank" >Installation and Registration Guide</a>';
?>
	</div></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh4" onclick="tabopen14('4','tab');"><font color="#0000CC"><strong>Saral TaxOffice</strong></font></div>
  <div  id="tabc4" style="display:none; padding:5px ">
<?php
$product ='Saral TaxOffice';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh5" onclick="tabopen14('5','tab');"><font color="#0000CC"><strong>Saral IncomeTax </strong></font></div>
  <div  id="tabc5" style="display:none; padding:5px ">
<?php
$product ='Saral IncomeTax';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh6" onclick="tabopen14('6','tab');"  ><font color="#0000CC"><strong>Saral Accounts </strong></font></div>
  <div  id="tabc6" style="display:none; padding:5px ">
<?php
$product ='Saral Accounts';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>

<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh17" onclick="tabopen14('17','tab');"  ><font color="#0000CC"><strong>Saral Accounts Professional </strong></font></div>
  <div  id="tabc17" style="display:none; padding:5px ">
<?php
$product ='Saral Accounts Professional';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>

<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh15" onclick="tabopen14('15','tab');"  ><font color="#0000CC"><strong>Saral Billing </strong></font></div>
  <div  id="tabc15" style="display:none; padding:5px ">
<?php
$product ='Saral Billing';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>

<tr >
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font"><div class="product-font" id="tabh7" onclick="tabopen14('7','tab');"><font color="#0000CC"><strong>Saral VAT100 - Standard / Premium</strong></font></div>
  <div  id="tabc7" style="display:none; padding:5px ">
<?php
$product ='Saral VAT100';
product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
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
                                                      <td width="34%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                                                      <td width="66%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">5.00</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">08 February 2012</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">6.71 MB</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">License</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Evaluation cum Licensed Version</td>
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
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralvatxml/setupex.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
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
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr >
<td colspan="4" valign="top" bgcolor="#f7faff" ><div class="product-font" id="tabh9" onclick="tabopen14('9','tab');"><strong><font color="#0000CC">Saral VATInfo</font></strong> </div>
  <div  id="tabc9" style="display:none; padding:5px ">
<?php
$product ='Saral VATinfo';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh10" onclick="tabopen14('10','tab');"><font color="#0000CC"><strong>Saral PayPack - Professional / Standard / Premium  / Corporate / SECUFAM</strong></font></div>
  <div  id="tabc10" style="display:none; padding:5px ">
<?php
$product ='Saral PayPack';
 product_setup($product);
?>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
	  <tr bgcolor="#edf4ff"  >
		<td width="32%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
		<td width="68%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">9.00</font> </strong></td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
		<td valign="top" bgcolor="#f7faff" class="product_content">01 January 2015</td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
		<td valign="top" bgcolor="#EDF4FF" class="product_content">309730 KB</td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">License</td>
		<td valign="top" bgcolor="#f7faff" class="product_content">Evaluation cum Licensed Version</td>
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
		<td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/setupex_9000.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td colspan="2">&nbsp;</td>
  </tr>
</table>-->
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh16" onclick="tabopen14('16','tab');"><font color="#0000CC"><strong>Saral ePFESI</strong></font></div>
<div  id="tabc16" style="display:none; padding:5px ">
	<?php
$product ='Saral ePFESI';
 product_setup($product);
?>
<!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
	<td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
	  <tr bgcolor="#edf4ff"  >
		<td width="32%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
		<td width="68%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">8.00</font> </strong></td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
		<td valign="top" bgcolor="#f7faff" class="product_content">26 Mar 2018</td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
		<td valign="top" bgcolor="#EDF4FF" class="product_content">136 MB</td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">License</td>
		<td valign="top" bgcolor="#f7faff" class="product_content">Evaluation cum Licensed Version</td>
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
		<td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralepfesi/setupex.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td colspan="2">&nbsp;</td>
  </tr>
</table> -->
</div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh11" onclick="tabopen14('11','tab');"><font color="#0000CC"><strong>Saral Sign</strong></font></div>
	<div  id="tabc11" style="display:none; padding:5px ">
<?php
$product ='Saral eSign';
 product_setup($product);
?>

	</div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh12" onclick="tabopen14('12','tab');"><font color="#0000CC"><strong>Saral AIR</strong></font></div>
  <div  id="tabc12" style="display:none; padding:5px ">
<?php
$product ='Saral AIR';
product_setup($product);
?>
  <!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
			<tr bgcolor="#edf4ff">
			  <td valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
			  <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">8.00</font></strong></td>
			</tr>
			<tr bgcolor="#f7faff" >
			  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
			  <td valign="top" bgcolor="#f7faff" class="product_content">19 April 2012</td>
			</tr>
			<tr bgcolor="#f7faff">
			  <td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
			  <td valign="top" bgcolor="#EDF4FF" class="product_content">24.1 MB</td>
			</tr>
			<tr bgcolor="#f7faff">
			  <td valign="top" bgcolor="#f7faff" class="product_content">License</td>
			  <td valign="top" bgcolor="#f7faff" class="product_content">Evaluation cum Licensed Version</td>
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
			  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralair/setup_v8.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
			</tr>
		</table></td>
	  </tr>
	</table>-->
	<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
			<tr bgcolor="#edf4ff">
			  <td valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
			  <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">7.00</font></strong></td>
			</tr>
			<tr bgcolor="#f7faff" >
			  <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
			  <td valign="top" bgcolor="#f7faff" class="product_content">21 April 2011</td>
			</tr>
			<tr bgcolor="#f7faff">
			  <td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
			  <td valign="top" bgcolor="#EDF4FF" class="product_content">23.0 MB</td>
			</tr>
			<tr bgcolor="#f7faff">
			  <td valign="top" bgcolor="#f7faff" class="product_content">License</td>
			  <td valign="top" bgcolor="#f7faff" class="product_content">Evaluation cum Licensed Version</td>
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
			  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralair/setupex.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
			</tr>
		</table></td>
	  </tr>
	</table>-->
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>

<tr>
<td  style="padding-bottom:10px"></td>
</tr>
			<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh13" onclick="tabopen14('13','tab');"><font color="#0000CC"><strong>Saral Communicator</strong></font></div>
<div  id="tabc13" style="display:none; padding:5px ">
                                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                              <tr>
                                                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                                                    <tr bgcolor="#edf4ff">
                                                      <td valign="top" bgcolor="#EDF4FF"class="product_content" >Version</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">1.03</font></strong></td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff" >
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">14 September 2010</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
                                                      <td valign="top" bgcolor="#EDF4FF" class="product_content">22.54 MB</td>
                                                    </tr>
                                                    <tr bgcolor="#f7faff">
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">License</td>
                                                      <td valign="top" bgcolor="#f7faff" class="product_content">Evaluation cum Licensed Version</td>
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
                                                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralcommunicator/setupex.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
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
			<tr>
			  <td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
				<tr>
				  <td><table width="100%" border="0" cellspacing="0" cellpadding="6">
					<tr bgcolor="#f7faff">
					  <td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh14" onclick="tabopen14('14','tab');"><font color="#0000CC"><strong>Saral eST3</strong></font></div>
						<div  id="tabc14" style="display:none; padding:5px ">
<?php
$product ='Saral eST3';
 product_setup($product);
?>
						</div></td>
					</tr>
				  </table></td>
				</tr>
			  </table></td>
			</tr>
            <!-- Saral XBRL -->
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh18" onclick="tabopen14('18','tab');"><font color="#0000CC"><strong>Saral XBRL</strong></font></div>
  <div  id="tabc18" style="display:none; padding:5px ">
<?php
$product ='Saral XBRL';
 product_setup($product);
?>
  </div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
            
            
			<tr>
			  <td>&nbsp;</td>
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
<td><? include('../include/footer.php') ?></td>
</tr>
</table>
</body>
</html>
