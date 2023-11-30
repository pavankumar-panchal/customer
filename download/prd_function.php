<?php
include_once ('prd_config.php');

function product($product)
{	
	$query = "SELECT * FROM prdupdate WHERE product='".$product."' AND updatetype = 'versionupdate' AND showinweb = '1' and prdcode NOT IN('899','893') ORDER BY slno DESC";
	$result = fetchhb($query);
	
$serial = 1;

	while ($row = mysqli_fetch_array($result)) 
	{
		$version =$row['patchversion'];
?>
<tr>
    <td width="7%" valign="top" style="padding:5px"><strong><?php echo $serial++;?>.</strong></td>
    <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                    <tr bgcolor="#edf4ff" >
                      <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content">Version</td>
                      <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"><?php echo $row['patchversion'];?></font></strong></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Date</td>
                      <td valign="top" bgcolor="#f7faff" class="product_content"><?php echo date("d M Y",strtotime($row['reldate']));?></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Versions above <?php echo $row['applicable'];?></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                      <td valign="top" bgcolor="#f7faff" class="product_content"><?php echo $row['size'];?> KB</td>
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
                      <td><div align="center"><a href="<?php echo $row['patchurl'];?>"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
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
  <?php
  hotfix($product,$version);
  	 }?>
<?php				
	
}


function hotfix($product,$version)
{	
	$query = "SELECT * FROM prdupdate WHERE product='".$product."' AND patchversion='".$version."' AND updatetype = 'hotfix' AND showinweb = '1' ORDER BY slno DESC";
	#echo "testing query og hotfix funct ".$query;
	$result = mysqli_query($query) or die('MySql Error' . mysqli_error());
	
	while ($row = mysqli_fetch_array($result)) 
	{

?>
<tr>
    <td width="7%" valign="top" style="padding:5px">&nbsp;</td>
    <td width="93%"><table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
                    <tr bgcolor="#edf4ff" >
                      <td width="30%" valign="top" bgcolor="#EDF4FF" class="product_content"><font color="#FF0000">Hotfix</font></td>
                      <td width="70%" valign="top" bgcolor="#EDF4FF" class="product_content"><strong><font color="#FF0000"><?php echo $row['hotfixno'];?></font></strong></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#f7faff" class="product_content">Release Date</td>
                      <td valign="top" bgcolor="#f7faff" class="product_content"><?php echo date("d M Y",strtotime($row['reldate']));?></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#EDF4FF" class="product_content">Applicable to</td>
                      <td valign="top" bgcolor="#EDF4FF" class="product_content">v<?php echo $row['patchversion'];?></td>
                    </tr>
                    <tr bgcolor="#f7faff">
                      <td valign="top" bgcolor="#f7faff" class="product_content">Size</td>
                      <td valign="top" bgcolor="#f7faff" class="product_content"><?php echo $row['size'];?> KB</td>
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
                      <td><div align="center"><a href="<?php echo $row['patchurl'];?>"><img src="../images/imax-customer-downloadicon.gif" alt="Download"  title="Download" border="0" /></a></div></td>
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
  <?php }?>
<?php				
}

function product_setup($product)
{	
	$query = "SELECT * FROM saral_update WHERE product='".$product."' ORDER BY pid DESC LIMIT 1";
	$result = fetchhb($query);
	
$serial = 1;

	while ($row = mysqli_fetch_array($result)) 
	{
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td width="61%"><table width="100%"  border="0" cellpadding="5" cellspacing="0">
			<tr bgcolor="#edf4ff"  >
			  <td valign="top" bgcolor="#EDF4FF"  class="product_content">Version</td>
			  <td valign="top" bgcolor="#EDF4FF"  class="product_content"><strong><font color="#FF0000"><?php echo $row['version'];?></font></strong></td>
			</tr>
			<tr bgcolor="#f7faff" >
			  <td valign="top" bgcolor="#f7faff"  class="product_content">Release Dated</td>
			  <td valign="top" bgcolor="#f7faff"  class="product_content"><?php echo date("d M Y",strtotime($row['date']));?></td>
			</tr>
			<tr bgcolor="#f7faff" >
			  <td valign="top" bgcolor="#EDF4FF"  class="product_content">Size</td>
			  <td valign="top" bgcolor="#EDF4FF"  class="product_content"><?php echo $row['size'];?> KB</td>
			</tr>
			<tr bgcolor="#f7faff" >
			  <td valign="top" bgcolor="#f7faff"  class="product_content">License</td>
			  <td valign="top" bgcolor="#f7faff"  class="product_content">Evaluation cum Licensed Version</td>
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
			  <td><div align="center"><a href="<?php echo $row['url'];?>"><img src="../images/imax-customer-downloadicon.gif" alt="Download" border="0" title="Download" /></a></div></td>
			</tr>
		</table></td>
	  </tr>
	</table>  <?php
  	 }
	
}

?>