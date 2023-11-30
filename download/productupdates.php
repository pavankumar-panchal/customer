<?php
include('../functions/phpfunctions.php'); 
include('../include/checksession.php');
include_once ('prd_function.php');
$cusid = imaxgetcookie('custuserid');
//$cusid = $_COOKIE['userid'];


//Assign the product codes to upgrade patches
$tdsparray = array('942','634','708','744','635','638','639','641','642','643','644','667','669','670','673','676','679');
$tdscarray = array('954','963','951','961','955','965','964','956','636','715','752','645','647','650','652','656','658','660','662',
                   '665','671','674','676','677','680');
$tdsiarray = array('960','966','637','720','760','646','648','651','653','657','659','661','664','668','672','675','678','681');

//dot products
$tdsdparray = array('711','716','719','723');
$tdsdcarray = array('709','717','721','724');
$tdsdiarray = array('710','718','722','725');
//dot products ends 

$tdsplarray = array('690','691','692','693','694','695','696','697');
$stoarray = array('346','349','345','321','348','384','366','330','350','351','352','353','354','355','356','357','358','359','360');
$sitarray = array('303','304','305','306','307','308','309','310','311','312','313','314','315');
$saiarray = array('210','211','212','213','216','215','219','222','250','407','419');
$svharray = array('471','469','472','473','475','482','478','483','484','485','486','487','488');
$svxarray = array('464','470','474','480','481');
$sviarray = array('511','512','513','509','515','514','515','516','506','507','508','509','511','512','513','514','515','516','517','518');
$spparray = array('851','869','870','874','876','875','882','884','883','880','879','878','885','886','887','888',
'889','890','891','893','894','895','899','900','902','903','904','905','912','907','908','913','911','910','914','915','917','916','918','921','919','920','925','923','922');
$sesarray = array('101');
$scommuarray = array('160');
$sxbrlarray = array('239','240','242','244','241','243','245','246','247','252','253','254','256','258','260');
$sst3array = array('369','370','371','372','373','374');
$sbiarray = array('214','217','220','223','251','439');
$saiparray = array('215','221');
$sairarray = array('583','584');

$sfintracproarray = array('585','587');
$sfintracprearray = array('586','588');

$saralgst = array('519','521','522','525','524');
$saralefpfsi = array('817','818','819','820','821','822','824');

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
<div  id="tabc1" style="display:none; padding:5px "><!-- Saral TDSProfessional -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDSProfessional';
 product($product);
?>
</table>
</div><!-- End Saral TDSProfessional-->
</td>
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
<div  id="tabc2" style=" display:none; padding:5px "><!--Saral TDSCorporate-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDSCorporate';
 product($product);
?>
 </table>
</div><!--End Saral TDSCorporate--></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<?php } ?>




<?php if(matcharray($saralgst,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh2" onclick="tabopen14('28','tab');"><font color="#0000CC"><strong>Saral GST </strong></font></div>
<div  id="tabc28" style=" display:none; padding:5px "><!--Saral GST-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral GST';
 product($product);
?>
 </table>
</div><!--End Saral GST --></td>
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
<div  id="tabc3" style="display:none; padding:5px "><!--Saral TDSInstitutional-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDSInstitutional';
 product($product);
?>
</table>                                             
</div><!--End Saral TDSInstitutional--></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<?php } ?>

<!-- Dot Products Added Here -->

<?php if(matcharray($tdsdcarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh22" onclick="tabopen14('22','tab');"><font color="#0000CC"><strong>Saral TDS.Corporate</strong></font></div>
<div  id="tabc22" style="display:none; padding:5px "><!--Saral TDS.Corporate-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDS.Corporate';
 product($product);
?>
</table>                                             
</div><!--End Saral TDS.Corporate--></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<?php } ?>

<?php if(matcharray($tdsdparray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh21" onclick="tabopen14('21','tab');"><font color="#0000CC"><strong>Saral TDS.Professional</strong></font></div>
<div  id="tabc21" style="display:none; padding:5px "><!--Saral TDS.Professional-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDS.Professional';
 product($product);
?>
</table>                                             
</div><!--End Saral TDS.Professional--></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<?php } ?>

<?php if(matcharray($tdsdiarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh23" onclick="tabopen14('23','tab');"><font color="#0000CC"><strong>Saral TDS.Institutional</strong></font></div>
<div  id="tabc23" style="display:none; padding:5px "><!--Saral TDS.Institutional-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDS.Institutional';
 product($product);
?>
</table>                                             
</div><!--End Saral TDS.Institutional--></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<?php } ?>



<!-- Dot Products Ends Here -->

<!-- FinTrac Product Updates -->

<?php if(matcharray($sfintracprearray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh19" onclick="tabopen14('19','tab');"><font color="#0000CC"><strong>Saral FinTrac - Premium</strong></font></div>
<div  id="tabc19" style="display:none; padding:5px "><!--FinTrac  Premium-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral FinTrac - Premium';
 product($product);
?>
</table>                                             
</div><!--End FinTrac premium --></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<?php } ?>



<?php if(matcharray($sfintracproarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><div>
<table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh20" onclick="tabopen14('20','tab');"><font color="#0000CC"><strong>Saral FinTrac - Professional</strong></font></div>
<div  id="tabc20" style="display:none; padding:5px "><!--FinTrac  Professional-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral FinTrac - Professional';
 product($product);
?>
</table>                                             
</div><!--End FinTrac Professional --></td>
</tr>
</table></td>
</tr>
</table>
</div></td>
</tr>
<?php } ?>


<!-- FinTrac Ends Here -->


<?php if(matcharray($tdsplarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh17" onclick="tabopen14('17','tab');"><font color="#0000CC"><strong>Saral TDS - Plus</strong></font></div>
<div  id="tabc17" style="display:none; padding:5px "><!-- Saral TDSPlus -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

<?php
$product ='Saral TDSPlus';
 product($product);
?>
</table>
</div><!-- End Saral TDSPlus-->
</td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<?php } ?>

<?php if(matcharray($stoarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh4" onclick="tabopen14('4','tab');"><font color="#0000CC"><strong>Saral TaxOffice</strong></font></div>
<div  id="tabc4" style="display:none;padding:5px "><!--Saral TaxOffice-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral TaxOffice';
 product($product);
?>
</table>
</div><!--END Saral TaxOffice--></td>
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
<div  id="tabc5" style=" display:none;padding:5px"><!--Saral IncomeTax-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral IncomeTax';
 product($product);
?>
</table>
</div><!--END Saral IncomeTax--></td>
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
<div  id="tabc6" style="display:none; padding:5px "><!--END Saral Accounts-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral Accounts';
 product($product);
?>
</table>
</div><!--END Saral Accounts--></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<?php } ?>

<?php if(matcharray($saiparray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font" ><div class="product-font" id="tabh16" onclick="tabopen14('16','tab');"><font color="#0000CC"><strong>Saral Accounts Professional</strong></font></div>
<div  id="tabc16" style="display:none; padding:5px "><!--END Saral Accounts Professional-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral Accounts Professional';
 product($product);
?>
</table>
</div><!--END Saral Accounts Professional--></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<?php } ?>


<?php if(matcharray($sbiarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font" ><div class="product-font" id="tabh15" onclick="tabopen14('15','tab');"><font color="#0000CC"><strong>Saral Billing </strong></font></div>
<div  id="tabc15" style="display:none; padding:5px ">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral Billing';
 product($product);
?>
</table>
</div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<?php } ?><!--END Saral Billing-->

<?php if(matcharray($svharray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr >
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" class="product-font"><div class="product-font" id="tabh7" onclick="tabopen14('7','tab');"><font color="#0000CC"><strong>Saral VAT100 - Standard / Premium</strong></font></div>
<div  id="tabc7" style="display:none; padding:5px "><!--END Saral VAT100 - Standard / Premium-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral VAT100';
 product($product);
?>
</table>
</div><!--END Saral VAT100 - Standard / Premium--></td>
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
<div  id="tabc8" style="display:none; padding:5px "><!--Saral VATXML-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral VATXML';
 product($product);
?>
</table>
</div><!--END Saral VATXML--></td>
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
<div  id="tabc9" style="display:none; padding:5px "><!--END Saral VATInfo-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral VATinfo';
 product($product);
?>
</table>
</div><!--END Saral VATInfo--></td>
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
<td colspan="3" valign="top" bgcolor="#F7FAFF"  ><div class="product-font" id="tabh10" onclick="tabopen14('10','tab');"><font color="#0000CC"><strong>Saral PayPack - Professional / Standard / Premium / Corporate / SECUFAM</strong></font></div>
<div  id="tabc10" style="display:none; padding:5px "><!-- Saral  PayPack - Professional / Standard / Premium-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral PayPack';
 product($product);
?>
</table>
<!--<table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!-- <tr>-->
<!--    <td width="7%" valign="top" style="padding:5px"><strong>1.</strong></td>-->
<!--    <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--        <tr>-->
<!--          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--              <tr>-->
<!--                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">-->
<!--                    <tr bgcolor="#edf4ff" >-->
<!--                      <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>-->
<!--                      <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">13.00</font></strong></td>-->
<!--                    </tr>-->
<!--                    <tr bgcolor="#f7faff">-->
<!--                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Date</td>-->
<!--                      <td valign="top" bgcolor="#f7faff" class="product_content">22 December 2018</td>-->
<!--                    </tr>-->
<!--                    <tr bgcolor="#f7faff">-->
<!--                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>-->
<!--                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above 12.00</td>-->
<!--                    </tr>-->
<!--                    <tr bgcolor="#f7faff">-->
<!--                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>-->
<!--                      <td valign="top" bgcolor="#f7faff" class="product_content">243000 KB</td>-->
<!--                    </tr>-->
<!--                  </table></td>-->
<!--                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--                    <tr>-->
<!--                      <td>&nbsp;</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                      <td>&nbsp;</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                      <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralpaypack/SaralPayPack_v12p0_To_v13p0.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>-->
<!--                    </tr>-->
<!--                  </table></td>-->
<!--              </tr>-->
<!--            </table></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td>&nbsp;</td>-->
<!--        </tr>-->
<!--      </table></td>-->
<!--  </tr>-->
<!-- <tr bgcolor="#edf4ff">-->
<!--      <td width="7%" valign="top" style="padding:5px"><strong></strong></td>-->
<!--      <td width="93%" valign="top" bgcolor="#EDF4FF" class="product_content"><font color="#FF0000">-->
      <!-- Hotfix </font></td>-->
<!---->
<!--  </tr>-->
<!--   <tr>-->
<!--    <td width="7%" valign="top" style="padding:5px"><strong></strong></td>-->
<!--    <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--       <tr>-->
<!--          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--              <tr>-->
<!--                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">-->
<!--                    <tr bgcolor="#edf4ff" >-->
<!--                      <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Hotfix</td>-->
<!--                      <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content">-->
<!--                      <strong><font color="#FF0000">1</font></strong></td>-->
<!--                    </tr>-->
<!--                    <tr bgcolor="#f7faff">-->
<!--                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Date</td>-->
<!--                      <td valign="top" bgcolor="#f7faff" class="product_content">24 May 2019</td>-->
<!--                    </tr>-->
<!--                    <tr bgcolor="#f7faff">-->
<!--                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>-->
<!--                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v13.01</td>-->
<!--                    </tr>-->
<!--                    <tr bgcolor="#f7faff">-->
<!--                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>-->
<!--                      <td valign="top" bgcolor="#EDF4FF" class="product_content">11771 KB</td>-->
<!--                    </tr>-->
<!--                  </table>-->
<!--                </td>-->
<!--                <td width="39%" valign="top" bgcolor="#EDF4FF">-->
<!--                <table width="100%" border="0" cellspacing="0" cellpadding="0">-->
<!--                    <tr>-->
<!--                      <td>&nbsp;</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                      <td>&nbsp;</td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                      <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads//saralpaypack/SaralPayPack_v13p01_Fix1.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>-->
<!--                    </tr>-->
<!--                  </table></td>-->
<!--              </tr>-->
<!--            </table></td>-->
<!--        </tr>-->
<!--        <tr>-->
<!--          <td>&nbsp;</td>-->
<!--        </tr>-->
<!--      </table></td>-->
<!--  </tr>-->
<!---->
<!--</table>-->
<!--</div> -->
<!--END Saral  PayPack - Professional / Standard / Premium-->
<!--</td>-->
<!--</tr>-->
<!--</table>-->

<!-- Adding Hotfix -->








<!-- Hotfix addition ends -->


</td>
</tr>
</table></td>
</tr>
<?php } ?>
<!-- ePFESI Addition in Table -->

<!--
<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center" style="border:1px solid #308ebc;">
<tbody><tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tbody><tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"><div class="product-font" id="tabh22" onclick="tabopen14('22','tab');"><font color="#0000CC"><strong>Saral ePFESI</strong></font></div>
<div id="tabc22" style="display: block; padding: 5px;">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tbody><tr>
    <td width="7%" valign="top" style="padding:5px"><strong>1.</strong></td>
    <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td width="61%"><table width="100%" border="0" cellpadding="5" cellspacing="0">
                    <tbody>
	  <tr bgcolor="#edf4ff"  >
		<td width="32%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
		<td width="68%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">6.00</font> </strong></td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
		<td valign="top" bgcolor="#f7faff" class="product_content">07 Jan 2017</td>
	  </tr>
     <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">Applicable to </td>
		<td valign="top" bgcolor="#f7faff" class="product_content">Version above 6.00</td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
		<td valign="top" bgcolor="#EDF4FF" class="product_content">2.90 MB</td>
	  </tr>
                  </tbody></table></td>
                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
  <td><div align="center"><a href="http://www.etds-payroll-salary-software-india.com/downloads/saralepfesi/epfesi-6000-to-7000.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </tbody></table></td>
  </tr> 
</tbody></table>
</div></td>
</tr>
</tbody></table></td>
</tr>
</tbody></table></td>
</tr>
-->

<?php if(matcharray($saralefpfsi,$customerproductsarray)){ $haveupgrades = true; ?>

<tr>
<td style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center" style="border:1px solid #308ebc;">
<tbody><tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tbody><tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF"><div class="product-font" id="tabh22" onclick="tabopen14('22','tab');"><font color="#0000CC"><strong>Saral ePFESI</strong></font></div>
<div id="tabc22" style="display: block; padding: 5px;">
<!-- <table width="100%" border="0" cellspacing="0" cellpadding="0">
</table> -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">

	<?php
$product ='Saral ePFESI';
 product($product);
?>
 <!-- <tbody><tr>
    <td width="7%" valign="top" style="padding:5px"><strong>1.</strong></td>
    <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tbody><tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tbody><tr>
                <td width="61%">
                	<table width="100%" border="0" cellpadding="5" cellspacing="0">
                    <tbody>
	  <tr bgcolor="#edf4ff"  >
		<td width="32%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
		<td width="68%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000">8.00</font> </strong></td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">Release Dated</td>
		<td valign="top" bgcolor="#f7faff" class="product_content">26 Mar 2018</td>
	  </tr>
     <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#f7faff" class="product_content">Applicable to </td>
		<td valign="top" bgcolor="#f7faff" class="product_content">Version above 7.00</td>
	  </tr>
	  <tr bgcolor="#f7faff">
		<td valign="top" bgcolor="#EDF4FF" class="product_content">Size</td>
		<td valign="top" bgcolor="#EDF4FF" class="product_content">2.90 MB</td>
	  </tr>
                  </tbody></table></td>
                <td width="39%" valign="top" bgcolor="#EDF4FF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tbody><tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
                      <td>&nbsp;</td>
                    </tr>
                    <tr>
  <td><div align="center"><a href="https://www.etds-payroll-salary-software-india.com/downloads/saralepfesi/epfesi-7000-to-8000.exe"><img src="../images/imax-customer-downloadicon.gif" alt="Download" title="Download" border="0" /></a></div></td>
                    </tr>
                  </tbody></table></td>
              </tr>
            </tbody></table></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
        </tr>
      </tbody></table></td>
  </tr> 
</tbody> --></table>
</div></td>
</tr>
</tbody></table></td>
</tr>
</tbody></table></td>
</tr>


<!--
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tab16" onclick="tabopen14('16','tab');"><font color="#0000CC"><strong>Saral e-PFESI</strong></font></div>
<div id="tabc16" style="display:none; padding:5px ">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php //$product ='Saral e-PFESI'; product($product); ?>
</table>
</div></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>

-->
<?php } ?>

<!-- ePFESI Ends -->
<?php if(matcharray($sesarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh11" onclick="tabopen14('11','tab');"><font color="#0000CC"><strong>Saral Sign</strong></font></div>
<div  id="tabc11" style="display:none; padding:5px "><!--Saral Sign-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral eSign';
 product($product);
?>
</table>
</div><!--END Saral Sign--></td>
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
<div  id="tabc12" style="display:none; padding:5px "><!-- Saral Comminicator-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral Comminicator';
 product($product);
?>
</table>
</div><!--END Saral Comminicator--></td>
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
<div  id="tabc13" style="display:none; padding:5px "><!--END Saral XBRL-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral XBRL';
 product($product);
?>
</table>
</div><!--END Saral XBRL--></td>
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
<div  id="tabc14" style="display:none; padding:5px "><!-- Saral eST3-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral eST3';
 product($product);
?>
</table>
</div><!--END Saral eST3--></td>
</tr>
</table></td>
</tr>
</table></td>
</tr>
<?php } ?>
<?php if(matcharray($sairarray,$customerproductsarray)){ $haveupgrades = true; ?>
<tr>
<td  style="padding-bottom:10px"><table width="600" border="0" cellpadding="5" cellspacing="0" align="center"  style="border:1px solid #308ebc;" >
<tr>
<td><table width="100%" border="0" cellspacing="0" cellpadding="6">
<tr bgcolor="#f7faff">
<td colspan="3" valign="top" bgcolor="#F7FAFF" ><div class="product-font" id="tabh18" onclick="tabopen14('18','tab');"><font color="#0000CC"><strong>Saral AIR</strong></font></div>
<div  id="tabc18" style="display:none; padding:5px "><!--Saral AIR-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<?php
$product ='Saral AIR';
 product($product);
?>
</table>
</div><!--END Saral AIR--></td>
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
