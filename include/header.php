<?php
include('../functions/phpfunc.php');

$customeridysep = cusidcombine(imaxgetcookie('dbcustomerid'));
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0"  >
        <tr>
          <td width="24%" style="cursor:pointer; "><a href="../main/index.php" style="text-decoration:none"><img src="../images/imax-relyon-logo.png" alt="Customer Login Zone" width="196" height="75" border="0" /></a></td>
          <td width="76%" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="5"></td>
            </tr>
            <tr>
              <td style="border:1px solid #932f18; background-color:#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                <tr>
                  <td colspan="2" height="10"></td>
                </tr>
                <tr >
                  <td width="53%" >&nbsp;&nbsp;<a href="../main/index.php"class="Links" ><strong>Home</strong></a>&nbsp;|&nbsp;&nbsp;<a href="../profile/viewprofile.php" class="Links"><strong>Profile</strong></a>&nbsp;<!--| &nbsp;&nbsp;<a href="../messages/message.php" class="Links"><strong>Messages</strong></a>--></td>
                  <td width="47%" ><div align="right"><font color="#c94141">Customer ID: <?php echo($customeridysep);?></font> &nbsp;|&nbsp;&nbsp; <a href="../logout.php" class="Links" ><strong>Logout</strong></a></div></td>
                </tr>
                <tr>
                  <td height="10" colspan="2"></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td><div align="right"><img src="../images/imax-customerzone-heading.png" alt="Customer Login Area" width="262" height="20" border="0" /></div></td>
            </tr>
          </table>            </td>
        </tr>
      </table>