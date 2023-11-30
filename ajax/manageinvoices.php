<?php

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
			$responsearray = array();
			$i_n = 0;
			$startlimit = $_POST['startlimit'];
			$slno = $_POST['slnocount'];
			$showtype = $_POST['showtype'];
			
			$query = "select inv_invoicenumbers.slno as invoicenumber,inv_invoicenumbers.invoiceno as invoiceno, left(inv_invoicenumbers.createddate,10) as invoicedate ,  inv_invoicenumbers.duedate as duedate, inv_invoicenumbers.netamount as netamount,receiptamount,inv_invoicenumbers.status from inv_invoicenumbers left join (select sum(receiptamount) as receiptamount,invoiceno as invoiceno,partialpayment from inv_mas_receipt group by invoiceno)inv_mas_receipt on inv_mas_receipt.invoiceno = inv_invoicenumbers.slno
where right(customerid,5) = '".$cusid."'  order by inv_invoicenumbers.createddate desc";
			
			
			$limit = '10';
			if($startlimit == '')
			{
				$startlimit = 0;
				$slno = 0;
			}
			else
			{
				$startlimit = $slno ;
				$slno = $slno;
			}
			if($slno == 0)
			{
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
			}
			$result = runmysqlquery($query);	
			$fetchresultcount = mysqli_num_rows($result);
			$addlimit = " LIMIT ".$startlimit.",".$limit."; ";
			$query1 = $query.$addlimit;
			$result1 = runmysqlquery($query1);
			
			while($fetch = mysqli_fetch_array($result1))
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
				
				if($fetch['receiptamount'] == '' || $fetch['receiptamount'] < $fetch['netamount'])
				{
					if($fetch['status'] == 'CANCELLED')
					{
						$grid .= '<td  nowrap="nowrap" class="td-border-grid1" align="center"><span class="redtext">CANCELLED</span></td>';
					}
					else
					{
						$grid .= '<td  nowrap="nowrap" class="td-border-grid1" align="center">'.getpaymentstatus($fetch['receiptamount'],$fetch['netamount']).'<span class="sub_headingfont" onclick = "paynow(\''.$fetch['invoicenumber'].'\')">(Pay Now)</span></td>';
					}
				}
				else
				{
					if($fetch['status'] == 'CANCELLED')
					{
						$grid .= '<td  nowrap="nowrap" class="td-border-grid1" align="center"><span class="redtext">CANCELLED</span></td>';
					}
					else
					{
						$grid .= "<td  nowrap='nowrap' class='td-border-grid1' align='center'>".getpaymentstatus($fetch['receiptamount'],$fetch['netamount'])."&nbsp;</td>";
					}
				}
				$grid .= '<td nowrap="nowrap" class="td-border-grid1" align="center"><img src="../images/imax-customer-viewpdf.jpg" onclick="viewinvoice(\''.$fetch['invoicenumber'].'\');" class = "imageclass"/></td>';
				$grid .= "<td nowrap='nowrap' class='td-border-grid1' align='center'>".$fetch['status']."</td>";
				$grid .= "</tr>";
			}
			
			if($slno >= $fetchresultcount)
			$linkgrid .='<table width="100%" border="0" cellspacing="0" cellpadding="6px" height ="20px"><tr><td bgcolor="#FFFFD2"><font color="#FF4F4F">No More Records</font><div></div></td></tr></table>';
			else
			$linkgrid .= '<table align = "center"><tr><td height ="2px"></td></tr><tr><td><a onclick="getmoreinvoices(\''.$startlimit.'\',\''.$slno.'\',\'more\');" class="more" ><span id ="morerows">Show More Records >></span></a></td></tr></table>';
			$grid .= '</table>';
			
			$responsearray['errorcode'] = "1";
			$responsearray['grid'] = $grid;
			$responsearray['linkgrid'] = $linkgrid;
			$responsearray['fetchresultcount'] = $fetchresultcount;
			echo(json_encode($responsearray));
			//echo('1^'.$grid.'^'.$linkgrid.'^'.$fetchresultcount);
		
			break;

}
?>
