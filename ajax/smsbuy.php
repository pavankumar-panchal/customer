<?

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 

$switchtype = $_POST['switchtype'];

switch($switchtype)
{
	
	case 'getsmstariff':
	{
		$query = "SELECT * FROM inv_sms_price;";
		$result = runmysqlquery($query);
		$grid .= '<table width="325" border="0" align="center" cellpadding="3" cellspacing="0" class="table-border-grid">';
		$grid .= '<tr class="tr-grid-header"><td class="td-border-grid"><div align="center"><strong>SMS Quantity </strong></div></td>';
		$grid .= '<td class="td-border-grid"><div align="center"><strong>Price Per SMS </strong></div></td></tr>';
		while($resultfetch = mysqli_fetch_array($result))
		{
				$grid .=' <tr><td class="td-border-grid">'.$resultfetch['smsfromquantity'].' - '.$resultfetch['smstoquantity'].'</td><td  class="td-border-grid">'.$resultfetch['price'].' ps</td></tr>';
		}
		$grid .= '<tr><td colspan="2" class="td-border-grid"><strong>* Additonal Service Tax of 12.3% is applicable</strong></td>
		</tr>';
		$grid .= '<tr><td colspan="2" class="td-border-grid"><strong>* Mininmum purchase quantity is 500 SMS</strong></td>
		</tr></table>';
		
		$responsearray = array();
		$responsearray['grid'] = $grid;
		echo(json_encode($responsearray));
	}
	break;
}


?>
