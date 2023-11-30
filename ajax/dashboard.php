<?

ob_start("ob_gzhandler");

include('../include/ajax-referer-security.php');
include('../functions/phpfunctions.php'); 
$switchtytpe = $_POST['switchtype'];

if(imaxgetcookie('custuserid')<> '') 
$cusid = imaxgetcookie('custuserid');
else
{ 
	echo('Thinking to redirect');
	exit;
}

switch($switchtytpe)
{
	case "getinvoices":
		$i_n = 0;
		$slno = 0;
		
		$query = "select inv_invoicenumbers.slno as invoicenumber,inv_invoicenumbers.invoiceno as invoiceno, left(inv_invoicenumbers.createddate,10) as invoicedate ,  inv_invoicenumbers.duedate as duedate, inv_invoicenumbers.netamount as netamount,receiptamount,netamount,inv_invoicenumbers.status from inv_invoicenumbers left join (select sum(receiptamount) as receiptamount,invoiceno as invoiceno from inv_mas_receipt group by invoiceno)inv_mas_receipt on inv_mas_receipt.invoiceno = inv_invoicenumbers.slno
where right(customerid,5) = '".$cusid."' and (inv_mas_receipt.receiptamount < inv_invoicenumbers.netamount or inv_mas_receipt.invoiceno is null) and inv_invoicenumbers.status <> 'CANCELLED' order by inv_invoicenumbers.createddate desc";
		
		$result = runmysqlquery($query);	
		$fetchresultcount = mysqli_num_rows($result);
		
		
		
		$grid .= '<table width="100%" border="0" cellspacing="0" cellpadding="3"  class = "table-border-grid1">';
		$grid .= '<tr class = "tdheaderclass">';
		$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Sl No</td>';
		$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Invoice No</td>';
		$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Invoice Date</td>';
		$grid .= '<td nowrap = "nowrap"  align="center"  class="td-border-grid1">Due Date</td>';
		$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Total</td>';
		$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1">Payment</td>';
		$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >View</td>';
		$grid .= '<td nowrap = "nowrap"  align="center" class="td-border-grid1" >Status</td>';
		$grid .= '</tr>';
		
		while($fetch = mysqli_fetch_array($result))
		{
			$i_n++;
			$slno++;
			$color;
			if($i_n%2 == 0)
				$color = "#E2E2E2";
			else
				$color = "#ffffff";
				
			$grid .= '<tr class="gridrow1" bgcolor='.$color.'>';
			$grid .= "<td  nowrap='nowrap' class='td-border-grid1' align='center'>".$slno."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid1' align='center'>".$fetch['invoiceno']."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid1' align='center'>".changedateformat($fetch['invoicedate'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid1' align='center'>".changedateformat($fetch['duedate'])."</td>";
			$grid .= "<td nowrap='nowrap' class='td-border-grid1' align='center'>".$fetch['netamount']."</td>";
			if($fetch['status'] == 'CANCELLED')
			{
				$grid .= '<td  nowrap="nowrap" class="td-border-grid1" align="center"><span class="redtext">CANCELLED</span></td>';
			}
			else
			{
				$grid .= '<td  nowrap="nowrap" class="td-border-grid1" align="center">'.getpaymentstatus($fetch['receiptamount'],$fetch['netamount']).'&nbsp;<span class="sub_headingfont" onclick = "paynow(\''.$fetch['invoicenumber'].'\')">(Pay Now)</span></td>';
			}
			$grid .= '<td nowrap="nowrap" class="td-border-grid1" align="center"><img src="../images/imax-customer-viewpdf.jpg" onclick="viewinvoice(\''.$fetch['invoicenumber'].'\');" class = "imageclass"/></td>';
			$grid .= "<td nowrap='nowrap' class='td-border-grid1' align='center'>".$fetch['status']."</td>";
			$grid .= "</tr>";
		}
		
		$grid .= '</table>';
		echo('1^'.$grid.'^'.$fetchresultcount);
		
			break;

}



?>
