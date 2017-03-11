<?php
	@include_once('CCommon.php');
	
	class HTML
	{
		function BuyerPoConvertToHTML($PO)
		{
			$oProduct=new CProduct();
			$oCommon=new CCommon();
			$oCompany=$oCommon->ReadCompanyInfo();
			$sql="SELECT sales_po_master.ID, sales_po_master.PoNo, sales_po_master.LCNO,sales_po_master.BuyerCode,sales_buyer_info.Name AS BuyerName,sales_buyer_info.Address, sales_po_master.TotalQty, sales_po_master.TotalAmount, currency.Name AS currency, currency.ShortName AS ShortCurrency, sales_po_master.BankInfo, sales_po_master.Size,sales_po_master.Description,sales_po_master.Febbric, sales_po_master.Note, sales_po_master.OrderDate, sales_po_master.DeliveryDate, sales_po_master.ShipmentDate,sales_po_master.NotifyParty, sales_po_master.OrderType, sales_po_master.Ultimate, agent_info.Name AS ForwaderName,  agent_info.Address AS ForwaderAddress, agent_info_1.Name AS ClearName,  agent_info_1.Address AS ClearAddress, bank_info.Name AS BankName, bank_info.Address AS BankAddress, sales_po_master.CreateDate, sales_po_master.ShipMode 
				 FROM sales_po_master INNER JOIN sales_buyer_info ON sales_buyer_info.UserName=sales_po_master.BuyerCode 
				 INNER JOIN currency ON currency.Code= sales_po_master.Currency 
				 LEFT OUTER JOIN agent_info ON agent_info.ID=sales_po_master.Forwader 
				 LEFT OUTER JOIN agent_info AS agent_info_1 ON agent_info_1.ID=sales_po_master.Clearing 
				 LEFT OUTER JOIN bank_info ON bank_info.ID=sales_po_master.BankInfo 
				 WHERE sales_po_master.PoNo='$PO' ";
			$oResultPO=$oProduct->SqlQuery($sql);
			
			$OrderDate=new DateTime($oResultPO->row['OrderDate']);
			$DeliveryDate=new DateTime($oResultPO->row['DeliveryDate']);
			
			$sql="SELECT  sales_po_details.ProductCode,item_information.Name,sales_po_details.Color, sales_po_details.Size,sales_po_details.Qty,sales_po_details.ReceiveQty,sales_po_details.Price,sales_po_details.NetAmount,sales_po_details.Label FROM sales_po_details INNER JOIN item_information ON sales_po_details.ProductCode=item_information.Code WHERE sales_po_details.PoNo='$PO'";
			$oResultPODetails=$oProduct->SqlQuery($sql);
			
			$Size=$oResultPO->row['Size'];
			$Size=explode('|',$Size);
			 $n=count($Size);
			
			$html="<html>";
			$html.="<head>";
			$html.="</head>";
			$html.="<body>";
			$html.="<center>";			
            $html.="<div style=\"font-size:22px; font-family:Tahoma, Geneva, sans-serif; width:535;\">".$oResultPO->row['BuyerName']."</div>";
			$html.="<div style=\"font-size:12px; font-family:Tahoma, Geneva, sans-serif; width:535;\">".$oResultPO->row['Address']."</div>";
			$html.="<table width=\"535\" border=\"0\" style=\"font-size:12px\">";
  			$html.="<tr align=\"center\">";			
  			$html.="<td align=\"left\">To<br/>".$oCompany->CompanyName."<br/>".$oCompany->POCompanyAddress."</td>";
  			$html.="</tr>";
			$html.="</table>";
			$html.="<div style=\"font-size:12px;  width:535;\">Purchase Order</div>";			
			$html.="<table width=\"535\" border=\"0\" style=\"font-size:12px\">";
  			$html.="<tr align=\"center\">";
  			$html.="<td width=\"268\" align=\"left\">&nbsp;</td>";
    		$html.="<td width=\"267\" align=\"right\">Order Date-".$OrderDate->format('d-M-y')."</td>";
  			$html.="</tr>";
 			$html.="<tr align=\"center\">";
    		$html.="<td scope=\"row\" align=\"left\">".$PO."</td>";
			$html.="<td align=\"right\">Delivery Date-".$DeliveryDate->format('d-M-y')."</td>";
  			$html.="</tr>";
			$html.="</table>";
			$html.="<table  width=\"535\" border='0' cellpadding='0' cellspacing='0' style=\"font-size:9px;\">";
			$html.="<tr >";
    		$html.="<td style='border-right:solid 1px black; border-top:solid 1px black; border-left:solid 1px black;' height=\"20px\">&nbsp;Ulimate Customer</td>";
    		$html.="<td colspan=\"5\" style='border-right: solid 1px black; border-top:solid 1px black;'>&nbsp; ".$oResultPO->row['Ultimate']."</td>";
			$html.="<td colspan=\"".($n)."\" style='border-right: solid 1px black; border-top:solid 1px black;'>&nbsp;</td>";
    		$html.="</tr>";
			$html.="<tr >";
   			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black;' height=\"20px\"> &nbsp; Notify Party</td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['NotifyParty']."</td>";
			$html.="<td colspan=\"".($n)."\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; Order Type: ".$oResultPO->row['OrderType']."</td>";
			$html.="</tr>";
			
			$html.="<tr >";
   			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;  border-left: solid 1px black;' height='20px'> &nbsp; Bank Info </td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['BankName']."</td>";
			$html.="<td colspan=\"".($n)."\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; Clearing Agent Details: ".$oResultPO->row['ClearName']."</td>";
			$html.="</tr>";
			
			
			$html.="<tr >";
   			$html.="<td style='border-top: solid 1px black; border-right: solid 1px black;  border-left: solid 1px black;' height='20px'> &nbsp; Total Qty. </td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".number_format($oResultPO->row['TotalQty'],0,'.','')." Pcs</td>";
			$html.="<td colspan=\"".($n)."\" style=' border-top: solid 1px black; border-right: solid 1px black;'> Forwarder Agent Details: ".$oResultPO->row['ForwaderName']."</td>";
			$html.="</tr>";
			
			$html.="<tr >";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black;' height=\"20px\"> &nbsp; Total Value.</td>";
    		$html.="<td colspan=\"".($n+5)."\" style='border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['ShortCurrency']." ".$oResultPO->row['TotalAmount']."</td>";
    		$html.="</tr>";
 			$html.="<tr align=\"center\">";
			$html.="<td colspan=\"4\" style=' border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black;' height=\"15px\">&nbsp;</td>";
    		$html.="<td colspan=\"".($n+1)."\" style=' border-top: solid 1px black; border-right: solid 1px black;'>Size &amp; Quantity Break Down</td>";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp;</td>";
    		$html.="</tr>";
			$html.="<tr align=\"center\">";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black; background-color:#CCC;' height=\"15px\">Product Code</td>";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>Product Name</td>";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>Color</td>";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>Price</td>";
			for($j=0;$j<$n;$j++)
			{
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>".$Size[$j]."</td>";
			}
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>TTL Pcs &nbsp;</td>";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'> Label </td>";
			$html.="</tr>";
			for($i=0;$i<$oResultPODetails->num_rows;$i++)
			{
				$html.="<tr align=\"center\" >";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black;' height=\"15px\">".$oResultPODetails->rows[$i]['ProductCode']."</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' align=\"left\">".$oResultPODetails->rows[$i]['Name']."</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'> ".$oResultPODetails->rows[$i]['Color']."</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'> ".$oResultPODetails->rows[$i]['Price']."</td>";
				$Size=$oResultPODetails->rows[$i]['Size'];
				$Size=explode('|',$Size);
				$Total=0;
				for($j=0;$j<$n;$j++)
				{
					$Total+=$Size[$j];
					$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>".$Size[$j]."</td>";
				}
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' align=\"right\">".$Total." &nbsp;</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".$oResultPODetails->rows[$i]['Label']."</td>";
			    $html.="</tr>";
			}
			$html.="<tr valign=\"middle\" align=\"center\" >";
			$html.="<td colspan=\"".(4+$n)."\" align=\"right\" style=' border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black;' height=\"20px\">TTL Qty= &nbsp;</td>";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' align=\"right\">".number_format($oResultPO->row['TotalQty'],0,'.','')." &nbsp;</td>";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'> &nbsp; </td>";
			$html.="</tr>";
			$html.="<tr valign=\"middle\" align=\"center\" >";
			$html.="<td colspan='".($n+6)."' align=\"center\" style='border-bottom: solid 1px black; border-top: solid 1px black; border-right: solid 1px black; border-left: solid 1px black;' height=\"25px\">In Words- &nbsp;";
			$number = number_format($oResultPO->row['TotalAmount'], 2, '.', '');
			$Currency="USD";
			$html.=ucwords($oCommon->NumberToWord($number,$Currency))." Only"." &nbsp;</td>";
			$html.="</tr>";
			$html.="</table>";
			
			$html.="<br/><div style=\"font-size:12px; text-align:left; width:535;\">".$oResultPO->row['Description']."<br/>".$oResultPO->row['Febbric']."<br/>".$oResultPO->row['Note']."</div>";
			$html.="</center>";
			$html.="</body>";
			$html.="</html>";
			//echo $html;
			//exit;
			return $html;
		}
		
		function AdminPoConvertToHTML($PO)
		{
			$oProduct=new CProduct();
			$oCommon=new CCommon();
			$oCompany=new CCompany();
			$oCompany=$oCommon->ReadCompanyInfo();
			$sql="SELECT purchase_po_master.ID, purchase_po_master.PoNo,  purchase_po_master.BuyerPoNo,purchase_po_master.LCNO,purchase_po_master.SupplierCode,
			    pur_supplier_info.Name AS SupplierName,pur_supplier_info.Address, purchase_po_master.TotalQty, purchase_po_master.TotalAmount, currency.Name AS currency,
				currency.ShortName AS ShortCurrency, bank_info.Name AS BankName,purchase_po_master.Destination,purchase_po_master.LoadPort,
				purchase_po_master.Size,purchase_po_master.Service, purchase_po_master.Description,purchase_po_master.Fabric, purchase_po_master.Note, 
				purchase_po_master.OrderDate, purchase_po_master.DeliveryDate, purchase_po_master.ShipmentDate,purchase_po_master.CreateDate , 
				sales_buyer_info.Name AS BuyerName,sales_buyer_info.Address AS BuyerAddress, agent_info.Name AS ForwaderName, agent_info.Address AS ForwaderAddress,
				agent_info_1.Name AS ClearName,  agent_info_1.Address AS ClearAddress,sales_po_master.NotifyParty
				FROM purchase_po_master INNER JOIN pur_supplier_info ON pur_supplier_info.UserName=purchase_po_master.SupplierCode 
				INNER JOIN currency ON currency.Code= purchase_po_master.Currency 
				INNER JOIN sales_po_master ON purchase_po_master.BuyerPoNo=sales_po_master.PoNo 
				INNER JOIN sales_buyer_info ON sales_buyer_info.UserName=sales_po_master.BuyerCode
				LEFT OUTER JOIN agent_info ON agent_info.ID=sales_po_master.Forwader 
			    LEFT OUTER JOIN agent_info AS agent_info_1 ON agent_info_1.ID=sales_po_master.Clearing 
				LEFT OUTER JOIN bank_info ON bank_info.ID=purchase_po_master.BankInfo
				WHERE purchase_po_master.PoNo='$PO'";
			$oResultPO=$oProduct->SqlQuery($sql);
			$sql="SELECT  purchase_po_details.ProductCode, item_information.Name, purchase_po_details.Color, purchase_po_details.Size, purchase_po_details.Qty,
			     purchase_po_details.ReceiveQty, purchase_po_details.Price, purchase_po_details.NetAmount, sales_po_details.Label
				 FROM purchase_po_details INNER JOIN item_information ON purchase_po_details.ProductCode=item_information.Code 
				 INNER JOIN sales_po_details ON sales_po_details.ID=purchase_po_details.PoID
				 WHERE purchase_po_details.PoNo='$PO'";
			$oResultPODetails=$oProduct->SqlQuery($sql);
			
			$Size=$oResultPO->row['Size'];
			$Size=explode('|',$Size);
			$n=count($Size);
			$OrderDate=new DateTime($oResultPO->row['OrderDate']);
			$DeliveryDate=new DateTime($oResultPO->row['DeliveryDate']);
			$ShipmentDate=new DateTime($oResultPO->row['ShipmentDate']);
			$html="<html>";
			$html.="<head>";
			$html.="</head>";
			$html.="<body>";
			$html.="<center>";
            $html.="<div style=\"font-size:22px; font-family:Tahoma, Geneva, sans-serif\">".$oCompany->CompanyName."</div>";
			$html.="<div style=\"font-size:12px; font-family:Tahoma, Geneva, sans-serif\">".$oCompany->CompanyAddress."</div>";
			$html.="<table width=\"545\" border=\"0\" style=\"font-size:12px\">";
  			$html.="<tr align=\"center\" >";
  			$html.="<td align=\"left\">To<br/>".$oResultPO->row['SupplierName']."<br/>".$oResultPO->row['Address']."</td>";
  			$html.="</tr>";
			$html.="</table";
			$html.="<div style=\"font-size:12px\">Purchase Order</div>";
			$html.="<table width=\"545\" border=\"0\" style=\"font-size:12px\">";
  			$html.="<tr align=\"center\" >";
  			$html.="<td width=\"275\" scope=\"col\" align=\"left\">&nbsp;</td>";
    		$html.="<td width=\"270\" scope=\"col\" align=\"right\">Order Date-".$OrderDate->format('d-M-y')."</td>";
  			$html.="</tr>";
 			$html.="<tr align=\"center\">";
    		$html.="<th scope=\"row\" align=\"left\">".$PO."</th>";
			$html.="<td align=\"right\">Shipment Date-".$DeliveryDate->format('d-M-y')."</td>";
  			$html.="</tr>";
			$html.="</table>";

			$html.="<table  width=\"550\" border='0' cellpadding='0' cellspacing='0' style=\"font-size:9px; border:solid 1px black;\">";
			$html.="<tr >";
    		$html.="<td style='border-right:solid 1px black;' height=\"20px\">&nbsp;Buyer</td>";
    		$html.="<td colspan=\"5\" style='border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['BuyerName']."</td>";
			$html.="<td colspan=\"".($n)."\" >&nbsp;</td>";
    		$html.="</tr>";
			$html.="<tr >";
   			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"20px\"> &nbsp; Notify Party</td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['NotifyParty']."</td>";
			$html.="<td colspan=\"".($n)."\" style=' border-top: solid 1px black;'>&nbsp; Service : ".$oResultPO->row['Service']."</td>";
			$html.="</tr>";
			
			$html.="<tr >";
   			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"20px\"> &nbsp;Forwarder Agent Details </td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black; border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['ForwaderName']."</td>";
			$html.="<td colspan=\"".($n)."\" style=' border-top: solid 1px black;'>&nbsp; Clearing Agent Details: ".$oResultPO->row['ClearName']."</td>";
			$html.="</tr>";
			
			$html.="<tr >";
   			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"20px\"> &nbsp;Bank Info </td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black;  border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['BankName']."</td>";
			$html.="<td colspan=\"".($n)."\" style='border-right: solid 1px black; border-top: solid 1px black;'>&nbsp; Port of Loading: ".$oResultPO->row['LoadPort']."</td>";
			$html.="</tr>";
			
  			$html.="<tr >";
   			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"20px\"> &nbsp; Total Qty.</td>";
   			$html.="<td colspan=\"5\" style=' border-top: solid 1px black;  border-right: solid 1px black;'>&nbsp; ".$oResultPO->row['TotalQty']." Pcs</td>";
			$html.="<td colspan=\"".($n)."\" style='border-right: solid 1px black; border-top: solid 1px black;'>&nbsp; Port of Destination: ".$oResultPO->row['Destination']."</td>";
			$html.="</tr>";
			$html.="<tr >";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"20px\"> &nbsp; Total Value.</td>";
    		$html.="<td colspan=\"".($n+5)."\" style=' border-top: solid 1px black;'>&nbsp; ".$oResultPO->row['ShortCurrency']." ".$oResultPO->row['TotalAmount']."</td>";
    		$html.="</tr>";
 			$html.="<tr align=\"center\">";
			$html.="<td colspan=\"4\" style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"15px\">&nbsp;</td>";
    		$html.="<td colspan=\"".($n+1)."\" style=' border-top: solid 1px black; border-right: solid 1px black;'>Size &amp; Quantity Break Down</td>";
			$html.="<td style=' border-top: solid 1px black;'>&nbsp;</td>";
    		$html.="</tr>";
			$html.="<tr align=\"center\">";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;' height=\"15px\">Product Code</td>";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>Product Name</td>";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>Color</td>";
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>Price</td>";
			for($j=0;$j<$n;$j++)
			{
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>".$Size[$j]."</td>";
			}
    		$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black; background-color:#CCC;'>TTL Pcs &nbsp;</td>";
			$html.="<td style=' border-top: solid 1px black; background-color:#CCC;'>&nbsp; Label &nbsp;</td>";
			$html.="</tr>";
			for($i=0;$i<$oResultPODetails->num_rows;$i++)
			{
				$html.="<tr align=\"center\" >";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"15px\">".$oResultPODetails->rows[$i]['ProductCode']."</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>".$oResultPODetails->rows[$i]['Name']."</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>".$oResultPODetails->rows[$i]['Color']."</td>";
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>".$oResultPODetails->rows[$i]['Price']."</td>";
				$Size=$oResultPODetails->rows[$i]['Size'];
				$Size=explode('|',$Size);
				$Total=0;
				for($j=0;$j<$n;$j++)
				{
					$Total+=$Size[$j];
					$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;'>".$Size[$j]."</td>";
				}
				$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' align='right'>".$Total." &nbsp; </td>";
				$html.="<td style=' border-top: solid 1px black;'>".$oResultPODetails->rows[$i]['Label']."</td>";
			    $html.="</tr>";
			}
			$html.="<tr valign=\"middle\" align=\"center\" >";
			$html.="<td colspan=\"".(4+$n)."\" align=\"right\" style=' border-top: solid 1px black; border-right: solid 1px black;' height=\"20px\">TTL Qty= &nbsp;</td>";
			$html.="<td style=' border-top: solid 1px black; border-right: solid 1px black;' align='right'>".number_format($oResultPO->row['TotalQty'],0,'.','')." &nbsp;</td>";
			$html.="<td style=' border-top: solid 1px black;'>&nbsp;</td>";
			$html.="</tr>";
			$html.="</table>";
			
			$html.="<br/><div style=\"font-size:12px; text-align:left; width:550px;\">".$oResultPO->row['Description']."<br/>".$oResultPO->row['Fabric']."<br/>".$oResultPO->row['Note']."</div>";
			$html.="</center>";
			$html.="</body>";
			$html.="</html>";
			return $html;
		}
		
		function PackingDetailsConvertToHtml($PoNo)
		{
			$oProduct=new CProduct();
			$oCommon=new CCommon();
			
			$sql="SELECT receive_product_details.ShiftNo,receive_product_master.ManualNo, receive_product_master.LCNo, receive_product_master.LcDate, 
	      receive_product_master.Note, receive_product_master.SupplierCode, pur_supplier_info.Name, pur_supplier_info.Address, 
	      receive_product_master.LoadPort, receive_product_master.ShippingRemarks ,receive_product_master.Discharge, receive_product_master.ShipmentDate,receive_product_master.ExpNo, 
		  receive_product_master.ExpDate, receive_product_details.PoID, receive_product_details.PoNo, receive_product_details.ProductCode,
		  receive_product_details.Measurement, item_information.Name AS ProductName, receive_product_details.Color, receive_product_details.Size, 
		  receive_product_details.Qty, receive_product_details.CtnNo, receive_product_details.CtnQty, receive_product_details.Pcs, 
		  receive_product_details.GrossWeight, receive_product_details.NetWeight, receive_product_details.CMB, bank_info.Name AS BankName, 
		  bank_info.Address AS BankAddress,sales_buyer_info.Name As BuyerName, sales_buyer_info.Address AS BuyerAddress, sales_po_master.NotifyParty, 
		  notify_party.Address AS NotifyAddress, purchase_po_master.Service, bank_info_1.Name As SuppBank, bank_info_1.Address AS SuppBankAddress,
		  receive_product_details.IsAssoted,  receive_product_details.QtySize
          FROM receive_product_details INNER JOIN receive_product_master ON receive_product_master.ShiftNo=receive_product_details.PoNo 
		  INNER JOIN item_information ON item_information.Code=receive_product_details.ProductCode 
		  INNER JOIN purchase_po_master ON receive_product_details.ShiftNo=purchase_po_master.PoNo 
		  INNER JOIN pur_supplier_info ON pur_supplier_info.UserName=receive_product_master.SupplierCode 
		  INNER JOIN sales_po_master  ON purchase_po_master.BuyerPoNo=sales_po_master.PoNo 
		  LEFT OUTER JOIN bank_info ON sales_po_master.BankInfo= bank_info.ID 
		  LEFT OUTER JOIN bank_info AS bank_info_1 ON purchase_po_master.BankInfo= bank_info_1.ID
		  LEFT OUTER JOIN notify_party ON sales_po_master.NotifyParty=notify_party.Name
		  INNER JOIN sales_buyer_info ON sales_buyer_info.UserName=sales_po_master.BuyerCode
          WHERE receive_product_details.PoNo='".$PoNo."' ORDER BY receive_product_details.ID, receive_product_details.ShiftNo, receive_product_details.ProductCode";
		  $oResultPO=$oProduct->SqlQuery($sql);
		  $html="<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">";
		  $html.="<head>";
		  $html.="</head>";
		  $html.="<body>";
          if($oResultPO->num_rows>0) 
		  {
          	$html.="<center>";
			$html.="<table width=\"540\" border=\"0\" align=\"center\" cellspacing=\"0px\" cellpadding=\"2px\">";
      		$html.="<tr>";
        	$html.="<td colspan='4' width='540' style=\"font-size:20px; font-weight:bold;\" align='center'>".$oResultPO->row['Name']."</td>";
			$html.="</tr>";
			$html.="<tr>";
        	$html.="<td  width='540' colspan='4' style=\"font-size:12px; font-style:italic;\" align='center'>".$oResultPO->row['Address']."</td>";
			$html.="</tr>";
			$html.="<tr>";
       		$html.="<td  width='540' colspan='4' style=\"font-size:14px;\" align='center'><h4><u>Packing List</u></h4></td>";
			$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td width=\"135\" height=\"10\" style=\"background:#CCC; font-size:8px;border-top:solid 1px #666; border-left:solid 1px #666; border-top:solid 1px #666;\"><b> Supplier/ Exporter:</b></td>";
         	$html.="<td width=\"135\" style=\"border-right:solid 1px #666; border-top:solid 1px #666;\">&nbsp;</td>";
         	$html.="<td width=\"135\" style=\"background:#CCC; font-size:8px; border-top:solid 1px #666;\" ><b> Invoice No. &amp; Date:</b></td>";
         	$html.="<td width=\"135\" style='border-top:solid 1px #666; border-right:solid 1px #666;'>&nbsp;</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td colspan=\"2\" rowspan=\"5\" style=\"border-right:solid 1px #666; border-left:solid 1px #666; font-size:8px;\" valign=\"top\">".$oResultPO->row['Name'];".<br/>".$oResultPO->row['Address']."<br/></td>";
         	$html.="<td height=\"10\" style=\"font-size:8px; \">".$oResultPO->row['ManualNo']."</td>";
			$date=new DateTime($oResultPO->row['ShipmentDate']);
         	$html.="<td  style=\"font-size:8px; border-right:solid 1px #666;\">".$date->format('M d, Y')."</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td height=\"10\" style=\"border-top:solid 1px #666; background:#CCC; font-size:8px;\"><b>Exp. No. &amp; Date:</b></td>";
         	$html.="<td  style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666;\">&nbsp;</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td height=\"10\" style='font-size:8px;'>".$oResultPO->row['ExpNo']."</td>";
			$date=new DateTime($oResultPO->row['ExpDate']);
         	$html.="<td style=\"font-size:8px; border-right:solid 1px #666;\">".$date->format('M d, Y')."</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-top:solid 1px #666; background:#CCC; font-size:8px;\"><b>L/C or Contract No. &amp; Date:</b></td>";
         	$html.="<td  style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666;\">&nbsp;</td>";
       		$html.="</tr>";
       		$html.="<tr>";
           	$html.="<td style=\"font-size:8px;\">".$oResultPO->row['LCNo']."</td>";
			$date=new DateTime($oResultPO->row['LcDate']);
         	$html.="<td style=\"font-size:8px; border-right:solid 1px #666;\">".$date->format('M d, Y')."</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-top:solid 1px #666;  background:#CCC; border-left:solid 1px #666; font-size:8px;\" height=\"10\"><b>For account & Risk:</b></td>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px;\">&nbsp;</td>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px; background:#CCC;\"><b>Country Of Origin:</b></td>";
         	$html.="<td style=\"border-top:solid 1px #666; background:#CCC; font-size:8px; border-right:solid 1px #666;\"><b>L/C Issuing Bank:</b></td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td colspan=\"2\" rowspan=\"5\"  style=\"border-right:solid 1px #666; border-left:solid 1px #666; font-size:8px;\" valign=\"top\">".$oResultPO->row['BuyerName']."<br/>";
            $html.=$oResultPO->row['BuyerAddress']."</td>";
         	$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\">Bangladesh</td>";
         	$html.="<td rowspan=\"9\" valign=\"top\" style=\"font-size:8px; border-right:solid 1px #666;\">".$oResultPO->row['BankName']."<br/>".$oResultPO->row['BankAddress']."</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px; background:#CCC;\"><b>ERC No.:</b></td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td height=\"10\" valign=\"top\" style='border-right:solid 1px #666; font-size:8px;'>".$oResultPO->row['ExpNo']."&nbsp;</td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td height=\"10\" style='border-top:solid 1px #666; border-right:solid 1px #666; background:#CCC; font-size:8px;'><b>Terms of Delivery:</b></td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td height=\"10\" style=\"border-right:solid 1px #666; font-size:8px;\">".$oResultPO->row['Service']."</td>";
       		$html.="</tr>";
        	$html.="<tr>";
         	$html.="<td style=\"border-top:solid 1px #666; background:#CCC; border-left:solid 1px #666; font-size:8px;\"><b>Consignee to the Order Of :</b></td>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px;\">&nbsp;</td>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; background:#CCC; font-size:8px;\"><b>Ship Mode:</b></td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td colspan=\"2\" rowspan=\"5\" style=\"border-right:solid 1px #666; border-left:solid 1px #666; font-size:8px;\" valign=\"top\">".$oResultPO->row['SuppBank']."<br/>".$oResultPO->row['SuppBankAddress']."</td>";
         	$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\">Sea</td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px; background:#CCC;\"><b>Port Of Loading:</b></td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\" >".$oResultPO->row['LoadPort']."</td>";
         	$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px; background:#CCC;\"><b>Port Of Discharge:</b></td>";
          	$html.="<td style=\"border-top:solid 1px #666; background:#CCC; font-size:8px; border-right:solid 1px #666;\"><b>Final Destination:</b></td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\">".$oResultPO->row['Discharge']."</td>";
         	$html.="<td style=\"font-size:8px; border-right:solid 1px #666;\">".$oResultPO->row['Discharge']."</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td td style=\"border-top:solid 1px #666; border-left:solid 1px #666; background:#CCC; font-size:8px;\"><b>Notity Party:</b></td>";
         	$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px;\">&nbsp;</td>";
         	$html.="<td style=\"border-top:solid 1px #666; background:#CCC; font-size:8px;\" ><b>Remarks:</b></td>";
         	$html.="<td style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666;\">&nbsp;</td>";
       		$html.="</tr>";
       		$html.="<tr>";
         	$html.="<td colspan=\"2\" style=\"border-right:solid 1px #666; border-left:solid 1px #666; border-bottom:solid 1px #666; font-size:8px;\" valign=\"top\">".$oResultPO->row['NotifyParty']."<br/>".$oResultPO->row['NotifyAddress']."</td>";
         	$html.="<td colspan=\"2\" style=\"border-right:solid 1px #666; border-bottom:solid 1px #666; font-size:8px;\" valign=\"top\">".$oResultPO->row['Note']."</td>";
       		$html.="</tr>";
       		$html.="</table>";
       		$html.="<table width=\"530\" border=\"0\" bordercolor=\"#000000\" align=\"center\" cellspacing=\"0px\" cellpadding=\"1px\" style=\"border:solid 1px #666\">";
          	$html.="<tr style=\"font-size:8px; font-weight:bold;\" align=\"center\">";
            $html.="<td width=\"40\" style=\"background:#CCC;\">Product No.</td>";
            $html.="<td width=\"180\" style=\"background:#CCC; border-left:solid 1px #666;\">Description of Goods</td>";
			$html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Size</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Color</td>";            
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Ctns Seq No.</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Ctns Qty.</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Pcs/ Ctns</td>";
            $html.="<td width=\"40\" style=\"background:#CCC; border-left:solid 1px #666;\">Ttl Qty (Pcs)</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Gr. Wt</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">N. Wt</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Ctn Meas</td>";
            $html.="<td width=\"30\" style=\"background:#CCC; border-left:solid 1px #666;\">Ttl Vol.</td>";
          	$html.="</tr>";
            $CatonQty=0;
            $TotalQty=0;
            $GrossWeight=0;
            $NetWeight=0;
			$TotalCMB=0;
            for($i=0;$i<$oResultPO->num_rows;$i++)
            {
          	$html.="<tr valign=\"top\" style=\"font-size:8px\" align='center'>";
          	$html.="<td height=\"8px\" style=\"border-top:solid 1px #666;\">".$oResultPO->rows[$i]['ProductCode']."</td>";
			$Po=explode('-',$oResultPO->rows[$i]['ShiftNo']);
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\" align='left' ";
			if($oResultPO->rows[$i]['IsAssoted']) $html.="colspan='2'";
            $html.= ">".$oResultPO->rows[$i]['ProductName'].", ".$Po[0]."-".$Po[1]."-".$Po[2];
			if($oResultPO->rows[$i]['IsAssoted'])
			{
				$Size=explode('|',$oResultPO->rows[$i]['Size']);
				$html.="<table cellpadding='1' cellspacing='1' width='100%' bgcolor='#000'>";
				$html.="<tr>";
				for($kk=0;$kk<count($Size);$kk++)
				{
					$html.="<td bgcolor='#FFF'>".$Size[$kk]."</td>";
				}
				$html.="</tr>";
				
				$Size=explode('|',$oResultPO->rows[$i]['QtySize']);
				$html.="<tr>";
				for($kk=0;$kk<count($Size);$kk++)
				{
					$html.="<td bgcolor='#FFF'>".$Size[$kk]."</td>";
				}
				$html.="</tr>";
				$html.="</table>";
			}
			$html.="</td>";
			if($oResultPO->rows[$i]['IsAssoted']==0)
			{
            	$html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\">".$oResultPO->rows[$i]['Size']."</td>";
			}
			$html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\">".$oResultPO->rows[$i]['Color']."</td>";            
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\">".$oResultPO->rows[$i]['CtnNo']."</td>";
			$CatonQty+=$oResultPO->rows[$i]['CtnQty'];
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\">".number_format($oResultPO->rows[$i]['CtnQty'],2,'.','')."</td>";
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\">".number_format($oResultPO->rows[$i]['Pcs'],2,'.','')."</td>";
			$TotalQty+=$oResultPO->rows[$i]['Qty'];
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\" align=\"right\">".number_format($oResultPO->rows[$i]['Qty'],0,'.','')."</td>";
			$GrossWeight+=$oResultPO->rows[$i]['GrossWeight'];
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\" align=\"right\">".number_format($oResultPO->rows[$i]['GrossWeight'],2,'.','')."</td>";
			$NetWeight+=$oResultPO->rows[$i]['NetWeight'];
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\" align=\"right\">".number_format($oResultPO->rows[$i]['NetWeight'],2,'.','')."</td>";
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\">".$oResultPO->rows[$i]['Measurement']."</td>";
			$TotalCMB+=$oResultPO->rows[$i]['CMB'];
            $html.="<td style=\"border-left:solid 1px #666; border-top:solid 1px #666;\" align=\"right\">".number_format($oResultPO->rows[$i]['CMB'],2,'.','')."</td>";
          	$html.="</tr>"; 
            }
          	$html.="<tr style=\"font-size:9px\">";
            $html.="<td align=\"center\" colspan=\"5\" style=\"border-top:solid 1px #666; \">Total</td>";
            $html.="<td align=\"center\"  style=\"border-top:solid 1px #666;  border-left:solid 1px #666;\"><b>".number_format($CatonQty,2,'.','')."</b></td>";
            $html.="<td  style=\"border-top:solid 1px #666; border-left:solid 1px #666;\">&nbsp;</td>";
            $html.="<td align=\"right\"  style=\"border-top:solid 1px #666; border-left:solid 1px #666;\"><b>".number_format($TotalQty,0,'.','')."</b></td>";
            $html.="<td align=\"right\"  style=\"border-top:solid 1px #666; border-left:solid 1px #666;\"><b>".number_format($GrossWeight,2,'.','')."</b></td>";
            $html.="<td align=\"right\"  style=\"border-top:solid 1px #666; border-left:solid 1px #666; \"><b>".number_format($NetWeight,2,'.','')."</b></td>";
            $html.="<td align=\"center\"  style=\"border-top:solid 1px #666; border-left:solid 1px #666; \">&nbsp;</td>";
            $html.="<td style=\"border-top:solid 1px #666; border-left:solid 1px #666;\" align=\"right\"><b>".number_format($TotalCMB,2,'.','')."</b></td>";
          	$html.="</tr>";
          	$html.="</table>";
			$html.="<table border=\"0\" width=\"600px\">";
            $html.="<tr >";
            $html.="<td align=\"left\" style=' font-size:8px;'>Shipping Remarks:</td></tr>";
           	$html.="<tr>";
          	$html.="<td align=\"left\" style=\"border:none; font-size:8px;\">";
            $html.="<table border=\"0\" width=\"200px\" style=\"border: solid 2px black;\" align=\"left\">";
            $html.="<tr>";
            $html.="<td align=\"left\" style=\"border:none; font-size:8px;\">".$oResultPO->row['ShippingRemarks']."</td>";
            $html.="</tr>";
            $html.="</table>";
            $html.="</td>";
          	$html.="</tr>";
			$html.="<tr height=\"300px\"> <td>&nbsp;</td></tr>";
			$html.="<tr height=\"300px\"> <td>&nbsp;</td></tr>";
			$html.="<tr height=\"300px\"> <td>&nbsp;</td></tr>";
			$html.="<tr height=\"300px\"> <td>&nbsp;</td></tr>";
            $html.="<tr>";
          	$html.="<td>";
          	$html.="<table border=\"0\" width=\"500px\">";
           	$html.="<tr>";
          	$html.="<td  width=\"150\" align='left' style='border:none; font-size:8px' valign='top'>";
            $html.="COUNTRY OF ORGIN<br/>TOTAL GROSS WEIGHT<br/>TOTAL NET WEIGHT<br/>TOTAL CARTON<br/>TOTAL CBM</td>";
            $html.="<td width=\"300\" style=\"padding-left:3px; border:none; font-size:8px\" align='left' valign='top'>";
           	$html.="BANGLADESH<br/>$GrossWeight Kgs<br/>$NetWeight Kgs<br/>$CatonQty; Cartons<br/>$TotalCMB CMB<br/>";
            $html.="</td>";
          	$html.="</tr>";
            $html.="</table>";
           	$html.="</td>";
            $html.="</tr>";
            $html.="</table>";
        	$html.="</center>";
		  }
		  else
		  {
			$html.="<div align=\"center\" style=\"height:500px\"><h2>This Po Packing List is Not Avaiable</h2></td></div>";
		  }
		  $html.="</body>";
		  return $html;
		  //exit;
		}
		
		
		function DebitNoteConvertToHtml($PoNo)
		{
			$oProduct=new CProduct();
			$oCommon=new CCommon();
			$oCompany=new CCompany();
			$sql="SELECT  v_sale_invoice.DebitNo, v_sale_invoice.ManualNo AS InvoiceNo, v_sale_invoice.ShiftNo, v_sale_invoice.PoNo AS ExportNo ,SUM(ShipQty) AS Qty, 
			 SUM(Amount) Amount, SUM(v_sale_invoice.Amount*purchase_po_master.Commission* purchase_po_master.iscommisionsupplier/100) suppliercom, 
			 SUM(v_sale_invoice.Amount*purchase_po_master.Commission*purchase_po_master.iscommisionbuyer/100) BuyerComm, v_sale_invoice.CurrencyRate, v_sale_invoice.Currency,
			 v_sale_invoice.ShipmentDate, currency.ShortName
			 FROM v_sale_invoice 
			 INNER JOIN item_information ON item_information.Code=v_sale_invoice.ProductCode 
			 INNER JOIN purchase_po_master ON purchase_po_master.PoNo = v_sale_invoice.ShiftNo
			 INNER JOIN currency ON currency.Code=v_sale_invoice.Currency
			 WHERE v_sale_invoice.PoNo='$PoNo'
			 GROUP BY  v_sale_invoice.DebitNo, v_sale_invoice.ManualNo,v_sale_invoice.ShiftNo, v_sale_invoice.PoNo, v_sale_invoice.CurrencyRate, v_sale_invoice.Currency, 
			 v_sale_invoice.ShipmentDate,currency.ShortName";
			$oResultInvoicePO=$oProduct->SqlQuery($sql);
		
			$sql="SELECT SUM(Qty) Qty, SUM(CtnQty) CtnQty, SUM(GrossWeight) GrossWeight, SUM(NetWeight) NetWeight, SUM(CMB) CMB FROM receive_product_details
			 WHERE PoNo='$PoNo' ";
			$oResultCtn=$oProduct->SqlQuery($sql);	 
		
			$sql="SELECT * FROM shippingadvice WHERE PoNo='$PoNo' ";
			$oResultad=$oProduct->SqlQuery($sql);	 
		
			$sql="SElECT sales_buyer_info.Name, sales_buyer_info.PoAddress,  sales_buyer_info.Address
			FROM purchase_po_master INNER JOIN sales_po_master ON purchase_po_master.BuyerPoNo=sales_po_master.PoNo
			INNER JOIN sales_buyer_info ON sales_buyer_info.UserName=sales_po_master.BuyerCode
			WHERE purchase_po_master.PoNo='".$oResultInvoicePO->row['ShiftNo']."'";
			$oResultBuyer=$oProduct->SqlQuery($sql);

			$oCompany=$oCommon->ReadCompanyInfo();
			$html="<html><body><center><div style='font-size:24px; font-weight:bold;'>".$oCompany->CompanyName."</div>"
       			  ."<div style='font-size:14px;'>".$oCompany->CompanyAddress."</div><br />"
       			  ."<div style='font-size:16px;'><h4><u>DEBIT NOTE</u></h4></div>"
       			  ."<table width='529' border='0' align='center' cellspacing='0' cellpadding='1' >"
       			  ."<tr>";
				 $Date=new DateTime($oResultInvoicePO->row['ShipmentDate']);
       		$html.="<td colspan='2' style='font-size:10;'> Date ".$Date->format('M d, Y')."<br/><br/><br/>"
            	    ."To <br/>".$oResultBuyer->row['Name']." <br/>".($oResultBuyer->row['PoAddress']==''?$oResultBuyer->row['Address']:$oResultBuyer->row['PoAddress'])." </td>"
       			  	."</tr>"
					."<tr><td>&nbsp;</td><td>&nbsp;</td></tr>"
       				."<tr>"
         			."<td width='264' style='border-right:solid 1px #666; border-left:solid 1px #666;border-top:solid 1px #666; font-size:10;' valign='top'>"
         		."<table>"
         		."<tr><td style='font-size:10;'>Debit Note No.</td><td>:</td><td style='font-size:10;'>".$oResultInvoicePO->row['DebitNo']."</td></tr>"
            	."<tr><td style='font-size:10;'>Factory Invoice No</td><td>:</td><td style='font-size:10;'>".$oResultInvoicePO->row['InvoiceNo']."</td></tr>"
            	."<tr ><td style='font-size:10;'>Total No. of Cartoon</td><td>:</td><td style='font-size:10;'>".$oResultCtn->row['CtnQty']."</td></tr>"
            	."<tr ><td style='font-size:10;'>Total CMB</td><td>:</td><td style='font-size:10;'>".$oResultCtn->row['CMB']."</td></tr>"
         	."</table>"
          	."</td>"
         	."<td  width='265' valign='top' style='border-right:solid 1px #666; border-top:solid 1px #666; font-size:10;'>"
         	."<table >"
         	."<tr><td style='font-size:10;'>B/L No</td><td>:</td><td style='font-size:10;'>".$oResultad->row['BLNo']."</td></tr>"
            ."<tr><td style='font-size:10;'>Container No.</td><td>:</td><td style='font-size:10;'>".$oResultad->row['ContinerNo']."</td></tr>";
			$Date=new DateTime($oResultad->row['EtdCgp']);
            $html.="<tr><td style='font-size:10;'>Shipped on Board Date</td><td>:</td><td style='font-size:10;'>".$Date->format('M d, Y')."</td></tr>";
			$Date=new DateTime($oResultad->row['EtaPort']);
            $html.="<tr><td style='font-size:10;'>Eta. Destination</td><td>:</td><td style='font-size:10;'>".$Date->format('M d, Y')."</td></tr>"
         		 ."</table>"
         		."</td>"
       		."</tr>"
       	  ."</table>"
       	  ."<table width='530' border='0' bordercolor='#000000' align='center' cellspacing='0' cellpadding='2' style='border:solid 1px #666;font-family: Helvetica, sans-serif; font-size:12px;'>"
           ."<tr style='font-size:12px; font-weight:bold;' align='center'>"
           ."<td width='39' style='background:#CCC; border-right:solid 1px #666; border-bottom:solid 1px #666;'>SL.</td>"
           ."<td width='241' style='background:#CCC; border-right:solid 1px #666; border-bottom:solid 1px #666;' align='center'>Description of Goods</td>"
           ."<td width='75' style='background:#CCC; border-right:solid 1px #666; border-bottom:solid 1px #666;'>Shipped Qty</td>"
           ."<td width='80' style='background:#CCC; border-right:solid 1px #666; border-bottom:solid 1px #666;' align='center'>Invoice Amount</td>"
           ."<td width='80' style='background:#CCC; border-bottom:solid 1px #666;'  align='center'>Total Amount</td>"
           ."</tr>";
            $TotalShipQty=0;
            $TotalAmount=0;
			$TotalCommission=0;
			
		  for($i=0;$i<$oResultInvoicePO->num_rows;$i++) 
		  {
			  $Rate=$oResultInvoicePO->rows[$i]['CurrencyRate'];
			  
			  $TotalShipQty+=$oResultInvoicePO->rows[$i]['Qty'];
			  $TotalAmount+=$oResultInvoicePO->rows[$i]['Amount'];
			  $Commission=($oResultInvoicePO->rows[$i]['suppliercom']+$oResultInvoicePO->rows[$i]['BuyerComm']/$Rate);
			  $TotalCommission+=$Commission;
		  
          $html.="<tr align='center' height='25'>"
         	     ."<td style='border-right: solid 1px #666; valign='top' height='25'>".($i+1)."</td>"
            ."<td style='border-right: solid 1px #666; align='left' valign='top'>PO No. ".$oResultInvoicePO->rows[$i]['ShiftNo']."</td>"
            ."<td style='border-right: solid 1px #666; valign='top' align='right'>".$oResultInvoicePO->rows[$i]['Qty']."</td>"
            ."<td align='right' style='border-right: solid 1px #666;' valign='top'>".number_format($oResultInvoicePO->rows[$i]['Amount'],2,'.','')."</td>
              <td  align='right' style='' valign='top'>".number_format($Commission,2,'.','')."</td>"
          	."</tr>";
		  }
		  for($i;$i<=8;$i++)
		  {
			  $html.="<tr align='center' height='25'>"
         	     ."<td style='border-right: solid 1px #666;' valign='top' height='25'>&nbsp;</td>"
            ."<td style='border-right: solid 1px #666;' align='left' valign='top'>&nbsp;</td>"
            ."<td style='border-right: solid 1px #666; ' valign='top' align='right'>&nbsp;</td>"
            ."<td align='right' style='border-right: solid 1px #666;' valign='top'>&nbsp;</td>
              <td  align='right' style='' valign='top'>&nbsp;</td>"
          	."</tr>";
		  }
          $html.="<tr>"
            	."<td align='center' colspan='2' style='border-top:solid 1px #666; border-right:solid 1px #666;'>Total</td>"
            	."<td align='right' style='border-top:solid 1px #666; border-right:solid 1px #666;'><b>".number_format($TotalShipQty,2,'.','')."</b></td>"
            	."<td style='border-top:solid 1px #666; border-right:solid 1px #666;' align='right'><b>".$oResultInvoicePO->row['ShortName'].' '.number_format($TotalAmount,2,'.','')."</b></td>"
            	."<td style='border-top:solid 1px #666;' align='right'><b>".'US$'.number_format($TotalCommission,2,'.','')."</b></td>"
          		."</tr>"
          		."<tr>"
            	."<td align='left' colspan='5' style='border-top:solid 1px #666;'><strong>In Words:</strong> "; 
		
			$number = number_format($TotalCommission, 2, '.', '');
			$Currency=$oResultInvoicePO->row['Currency'];
			$html.=ucfirst(strtolower($oCommon->NumberToWord($number,$Currency)))." only";
         $html.="</td>"
          	."</tr>"
         ."</table>"
          ."<table border='0' width='530'>"
           	."<tr>"
          	."<td colspan='2' align='left' style='border:none; font-size:12px' valign='top'>
              Amount To be remitted to below Bank A/C:<br/>
           		UCB Bank Limited<br/>
            	Foreign Exchange Branch<br/>
                Dilkusha<br/>
                Dhaka - 1000<br/>
				A/C No -007211100013472<br/>
                Swift : UCBLBDDHFEX<br/>
            </td>
          </tr>
		  <tr><td>&nbsp;</td><td>&nbsp;</td></tr>
		  <tr>
		  <td align='left' style='font-size:12px'>Signaturt not required since this is computer generated.</td><td aligh='right' style='text-aligh:center; font-size:12px; width:140px; float:right; border-top: solid 1px #666;'>Authorise Signature</td>
		  </tr>
          </table></center></body></html>";
		  return $html;
		  //exit;
		}
		
		function InvoiceDetailsConvertToHtml($PoNo)
		{
			$oProduct=new CProduct();
			$oCommon=new CCommon();
			$sql="SELECT  v_sale_invoice.ManualNo AS InvoiceNo, v_sale_invoice.ShiftNo, v_sale_invoice.PoNo AS ExportNo , v_sale_invoice.ProductCode, 
	    		  v_sale_invoice.Color, item_information.Name AS ProductName,ShipQty AS Qty, Price,Amount 
	    		  FROM v_sale_invoice 
				  INNER JOIN item_information ON item_information.Code=v_sale_invoice.ProductCode 
				  WHERE v_sale_invoice.PoNo='".$PoNo."'";

		$oResultInvoicePO=$oProduct->SqlQuery($sql);
		
		$sql="SELECT receive_product_details.ShiftNo,receive_product_master.ManualNo, receive_product_master.LCNo, receive_product_master.LcDate,
		 receive_product_master.Note, receive_product_master.SupplierCode, pur_supplier_info.Name, pur_supplier_info.Address, 
		 receive_product_master.LoadPort,receive_product_master.ShippingRemarks ,receive_product_master.Discharge, 
		 receive_product_master.ShipmentDate, receive_product_master.ExpNo, receive_product_master.ExpDate, receive_product_details.PoID,
		 receive_product_details.PoNo,receive_product_details.ProductCode, receive_product_details.Measurement, item_information.Name AS 
		 ProductName, receive_product_details.Color, receive_product_details.Size, receive_product_details.Qty, receive_product_details.CtnNo, 
		 receive_product_details.CtnQty,receive_product_details.Pcs, receive_product_details.GrossWeight, receive_product_details.NetWeight, 
		 receive_product_details.CMB, bank_info.Name AS BankName,bank_info.Address AS BankAddress, bank_info.AccountNo,bank_info.SwiftNo, 
		 sales_buyer_info.Name As BuyerName,sales_buyer_info.Address AS BuyerAddress, sales_po_master.NotifyParty, notify_party.Address AS 
		 NotifyAddress, purchase_po_master.Service, bank_info_1.Name As SuppBank, bank_info_1.Address AS SuppBankAddress,bank_info_1.AccountNo As 
		 SuppAccountNo, bank_info_1.SwiftNo AS SuppSwiftNo
		 FROM receive_product_details INNER JOIN receive_product_master ON receive_product_master.ShiftNo=receive_product_details.PoNo INNER JOIN 
		 item_information ON item_information.Code=receive_product_details.ProductCode INNER JOIN purchase_po_master ON 
		 receive_product_details.ShiftNo =purchase_po_master.PoNo INNER JOIN pur_supplier_info ON pur_supplier_info.UserName = 
		 receive_product_master.SupplierCode INNER JOIN sales_po_master  ON purchase_po_master.BuyerPoNo=sales_po_master.PoNo LEFT OUTER JOIN 
		 bank_info ON sales_po_master.BankInfo= bank_info.ID LEFT OUTER JOIN bank_info AS bank_info_1 ON purchase_po_master.BankInfo= 
		 bank_info_1.ID LEFT OUTER JOIN notify_party ON sales_po_master.NotifyParty =notify_party.Name INNER JOIN sales_buyer_info ON 
		 sales_buyer_info.UserName=sales_po_master.BuyerCode
		 WHERE receive_product_details.PoNo='".$PoNo."' ORDER BY receive_product_details.ID, receive_product_details.ShiftNo, receive_product_details.ProductCode";
		
		$oResultPO=$oProduct->SqlQuery($sql);
	
		$html="<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"en\" lang=\"en\">";
		$html.="<head>";
		$html.="</head>";
		$html.="<body>";
		$html.="<center>";
		$html.="<table width=\"540\" border=\"0\" align=\"center\" cellspacing=\"0px\" cellpadding=\"2px\">";
	    $html.="<tr>";
	    $html.="<td colspan='4' width='540' style=\"font-size:20px; font-weight:bold;\" align='center'>".$oResultPO->row['Name']."</td>";
	    $html.="</tr>";
	    $html.="<tr>";
	    $html.="<td  width='540' colspan='4' style=\"font-size:12px; font-style:italic;\" align='center'>".$oResultPO->row['Address']."</td>";
	    $html.="</tr>";
	    $html.="<tr>";
	    $html.="<td  width='540' colspan='4' style=\"font-size:14px;\" align='center'><h4><u>Commercial Invoice</u></h4></td>";
	    $html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td width=\"135\" height=\"10\" style=\"background: #CCC; border-top:solid 1px #666; border-left:solid 1px #666; font-size:8px;\"><b>Supplier/ Exporter:</b></td>";
		$html.="<td width=\"135\" style=\"border-right:solid 1px #666; border-top:solid 1px #666;\">&nbsp;</td>";
		$html.="<td width=\"135\" style=\"background:#CCC; border-top:solid 1px #666; font-size:8px;\" ><b> Invoice No. &amp; Date:</b></td>";
		$html.="<td width=\"135\" style='border-top:solid 1px #666; border-left:solid 1px #666; border-right:solid 1px #666;'>&nbsp;</td>";
		$html.="</tr>";
		$html.="<tr  style=\"font-size:8px;\">";
		$html.="<td colspan=\"2\" rowspan=\"5\" style=\"border-right:solid 1px #666; border-left:solid 1px #666;\" valign=\"top\">".$oResultPO->row['Name']."<br/>";
		$html.=$oResultPO->row['Address']."<br/></td>";
		$html.="<td height=\"10\">".$oResultPO->row['ManualNo']."</td>";
		$date=new DateTime($oResultPO->row['ShipmentDate']);
		$html.="<td style='border-right:solid 1px #666;'>".$date->format('M d, Y')."</td>";
		$html.="</tr>";
		$html.="<tr  style=\"font-size:8px;\">";
		$html.="<td height=\"10\" style=\"border-top:solid 1px #666; background:#CCC;\"><b>Exp. No. &amp; Date:</b></td>";
		$html.="<td  style=\"border-top:solid 1px #666; border-right:solid 1px #666;\">&nbsp;</td>";
		$html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td height=\"10\">".$oResultPO->row['ExpNo']."</td>";
		$date=new DateTime($oResultPO->row['ExpDate']);
		$html.="<td style='border-right:solid 1px #666;'>".$date->format('M d, Y')."</td>";
		$html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td style=\"border-top:solid 1px #666; background:#CCC;\"><b>L/C or Contract No. &amp; Date:</b></td>";
		$html.="<td  style=\"border-top:solid 1px #666;  border-right:solid 1px #666;\">&nbsp;</td>";
		$html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td>".$oResultPO->row['LCNo']."</td>";
		$date=new DateTime($oResultPO->row['LcDate']);
		$html.="<td style='border-right:solid 1px #666;'>Date-".$date->format('M d, Y')."</td>";
		$html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td style=\"border-top:solid 1px #666; border-left:solid 1px #666; background:#CCC;\" height=\"10\"><b>For account & Risk:</b></td>";
		$html.="<td style=\" border-top:solid 1px #666; border-right:solid 1px #666;\">&nbsp;</td>";
		$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; background:#CCC;\"><b>Country Of Origin:</b></td>";
		$html.="<td style=\"border-top:solid 1px #666; background:#CCC; border-right:solid 1px #666;\"><b>L/C Issuing Bank:</b></td>";
		$html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td colspan=\"2\" rowspan=\"5\"  style=\"border-right:solid 1px #666; border-left:solid 1px #666;\" valign=\"top\">".$oResultPO->row['BuyerName']."<br/>";
		$html.=$oResultPO->row['BuyerAddress']."</td>";
		$html.="<td style=\"border-right:solid 1px #666;\">Bangladesh</td>";
		$html.="<td rowspan=\"9\" valign=\"top\" style='border-right: solid 1px #666;'>".$oResultPO->row['BankName']."<br/>";
		$html.=$oResultPO->row['BankAddress']."<br/>";
		$html.="A/C No.: ".$oResultPO->row['AccountNo']."<br/>";
		$html.="Swift No.: ".$oResultPO->row['SwiftNo'];
		$html.="</td>";
		$html.="</tr>";
		$html.="<tr style=\"font-size:8px;\">";
		$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; background:#CCC;\"><b>ERC No.:</b></td>";
		$html.="</tr>";
		$html.="<tr style='font-size:8px;'>";
		$html.="<td height='10' valign='top' style='border-right:solid 1px #666;'>&nbsp;</td>";
		$html.="</tr>";
		$html.="<tr style='font-size:8px;'\>";
	    $html.="<td height=\"10\" style='border-top:solid 1px #666; border-right:solid 1px #666; background:#CCC;'><b>Terms of Delivery:</b></td>";
		$html.="</tr>";
		$html.="<tr >";
		$html.="<td height=\"10\" style=\"border-right:solid 1px #666; font-size:8px;\">".$oResultPO->row['Service']."</td>";
		$html.="</tr>";
		$html.="<tr >";
		$html.="<td style=\"border-top:solid 1px #666; background:#CCC; border-left:solid 1px #666; font-size:8px;\"><b>Consignee to the Order Of :</b></td>";
		$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px;\">&nbsp;</td>";
		$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; background:#CCC; font-size:8px;\"><b>Ship Mode:</b></td>";
		$html.="</tr>";
		$html.="<tr>";
	    $html.="<td colspan=\"2\" rowspan=\"5\" style=\"border-left: solid 1px #666; border-right:solid 1px #666; font-size:8px;\" valign=\"top\">";
		$html.=$oResultPO->row['SuppBank']."<br/>".$oResultPO->row['SuppBankAddress']." <br/>"; 
		$html.="A/C No.: ".$oResultPO->row['SuppAccountNo']."<br/>";
		$html.="Swift No.: ".$oResultPO->row['SuppSwiftNo']; 
		$html.="</td>";
		$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\">Sea</td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="<td style=\"border-top:solid 1px #666; border-right:solid 1px #666; font-size:8px; background:#CCC;\"><b>Port Of Loading:</b></td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\">".$oResultPO->row['LoadPort']."</td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="<td style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666; background:#CCC;\" ><b>Port Of Discharge:</b></td>";
		$html.="<td style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666; background:#CCC;\"><b>Final Destination:</b></td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="<td style=\"border-right:solid 1px #666; font-size:8px;\">".$oResultPO->row['Discharge']."</td>";
		$html.="<td style=\" font-size:8px;  border-right:solid 1px #666;\">".$oResultPO->row['Discharge']."</td>";
		$html.="</tr>";
		$html.="<tr >";
		$html.="<td td style=\"border-top:solid 1px #666; font-size:8px; border-left:solid 1px #666; background:#CCC;\"><b>Notity Party:</b></td>";
		$html.="<td style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666;\">&nbsp;</td>";
		$html.="<td style=\"border-top:solid 1px #666; font-size:8px; background:#CCC;\" ><b>Remarks:</b></td>";
		$html.="<td style=\"border-top:solid 1px #666; font-size:8px; border-right:solid 1px #666;\">&nbsp;</td>";
		$html.="</tr>";
		$html.="<tr>";
		$html.="<td colspan=\"2\" style=\"border-right:solid 1px #666; font-size:8px; border-left:solid 1px #666; border-bottom:solid 1px #666;\" valign=\"top\">";
		$html.=$oResultPO->row['NotifyParty']."<br/>";
		$html.=$oResultPO->row['NotifyAddress'];
		$html.="</td>";
		$html.="<td colspan=\"2\" valign=\"top\" style=\"font-size:8px; border-bottom:solid 1px #666; border-right:solid 1px #666;\">".$oResultPO->row['Note']."</td>";
		$html.="</tr>";
		$html.="</table>";
		$html.="<table width=\"515px\" border=\"0\" bordercolor=\"#000000\" align=\"center\" cellspacing=\"0px\" cellpadding=\"3px\" style=\"border:solid 1px #666\">";
		$html.="<tr style=\"font-size:8px; font-weight:bold;\" align=\"center\">";
		$html.="<td width=\"85\" style=\"background:#CCC; border-right:solid 1px #666;\">Marks &amp; No Shipping Marks </td>";
		$html.="<td width=\"50\" style=\"background:#CCC; border-right:solid 1px #666;\">Product Code</td>";
		$html.="<td width=\"200\" style=\"background:#CCC; border-right:solid 1px #666;\" align=\"center\">Description of Goods</td>";
		$html.="<td width=\"50\" style=\"background:#CCC; border-right:solid 1px #666;\">Color</td>";
		$html.="<td width=\"46\" style=\"background:#CCC; border-right:solid 1px #666;\" align=\"center\" >Qty Pcs</td>";
		$html.="<td width=\"40\" style=\"background:#CCC; border-right:solid 1px #666;\">Unit Price</td>";
		$html.="<td width=\"44\" style=\"background:#CCC; \" align=\"center\">TTL Amount</td>";
		$html.="</tr>";
		$CatonQty=0;
		$TotalQty=0;
		$GrossWeight=0;
		$NetWeight=0;
		$TotalCMB=0;
		for($i=0;$i<$oResultPO->num_rows;$i++)
		{
			$CatonQty+=$oResultPO->rows[$i]['CtnQty'];
			$TotalQty+=$oResultPO->rows[$i]['Qty'];
			$GrossWeight+=$oResultPO->rows[$i]['GrossWeight'];
			$NetWeight+=$oResultPO->rows[$i]['NetWeight'];
			$TotalCMB+=$oResultPO->rows[$i]['CMB'];
		}
	    $html.="<tr align=\"center\" valign=\"top\" style=\"font-size:8px;\">";
	    $html.="<td rowspan=\"".$oResultInvoicePO->num_rows."\" align=\"left\" style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\">";
		$html.=$oResultPO->row['ShippingRemarks']."</td>";
		$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\" height=\"15px\">".$oResultInvoicePO->rows[0]['ProductCode']."</td>";
		$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\"  align=\"left\" valign=\"top\">".$oResultInvoicePO->rows[0]['ProductName'].', '.$oResultInvoicePO->rows[0]['ShiftNo']."</td>";
		$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\">".$oResultInvoicePO->rows[0]['Color']."</td>";
		$TotalQty= $oResultInvoicePO->rows[0]['Qty'];
		$html.="<td align=\"right\" style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\">".number_format($oResultInvoicePO->rows[0]['Qty'],0,'.','')."</td>";
		$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\"  align=\"right\" valign=\"top\">".number_format($oResultInvoicePO->rows[0]['Price'],2,'.','')."</td>";
		$TotalAmount= $oResultInvoicePO->rows[0]['Amount'];
		$html.="<td  align=\"right\" style=\"border-top: solid 1px #666;\" valign=\"top\">".number_format($TotalAmount,2,'.','')."</td>";
	  	$html.="</tr>";
	 	for($i=1;$i<$oResultInvoicePO->num_rows;$i++) 
	  	{
	 		$html.="<tr align=\"center\" height=\"10px\" style=\"font-size:8px;\">";
			$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\" height=\"10px\">".$oResultInvoicePO->rows[$i]['ProductCode']."</td>";
			$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\"  align=\"left\" valign=\"top\">".$oResultInvoicePO->rows[$i]['ProductName'].', '.$oResultInvoicePO->rows[$i]['ShiftNo']."</td>";
			$html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\">".$oResultInvoicePO->rows[$i]['Color']."</td>";
			$TotalQty+= $oResultInvoicePO->rows[$i]['Qty'];
		    $html.="<td align=\"right\" style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" valign=\"top\">".number_format($oResultInvoicePO->rows[$i]['Qty'],0,'.','')."</td>";
		    $html.="<td style=\"border-right: solid 1px #666; border-top: solid 1px #666;\" align=\"right\" valign=\"top\">".$oResultInvoicePO->rows[$i]['Price']."</td>";
			$TotalAmount+= $oResultInvoicePO->rows[$i]['Amount'];
		    $html.="<td  align=\"right\" style=\"border-top: solid 1px #666;\" valign=\"top\">".number_format($oResultInvoicePO->rows[$i]['Amount'],2,'.','')."</td>";
	  		$html.="</tr>";
	  }
	 
	  $html.="<tr style=\"font-size:8px;\">";
	  $html.="<td align=\"center\" colspan=\"4\" style=\"border-top:solid 1px #666;  border-right:solid 1px #666; \">Total</td>";
	  $html.="<td align=\"right\" style=\"border-top:solid 1px #666; border-right:solid 1px #666;\"><b>".number_format($TotalQty,0,'.','')."</b></td>";
	  $html.="<td align=\"center\" style=\"border-top:solid 1px #666; border-right:solid 1px #666;\">&nbsp;</td>";
	  $html.="<td style=\"border-top:solid 1px #666;\" align=\"right\"><b>".number_format($TotalAmount,2,'.','')."</b></td>";
	  $html.="</tr>";
	  
	  $Currency = "USD";
	  
	  $sql="SELECT * FROM sales_invoice_charge WHERE PoNo='$PoNo'";
	  $oResultAmount=$oProduct->SqlQuery($sql);
	  if($oResultAmount->num_rows>0)
	  {
	  	  for($i=0;$i<$oResultAmount->num_rows;$i++)
		  {
			  $html.="<tr style=\"font-size:8px;\">";
              $html.="<td align=\"center\" style=\"border-top:solid 1px #666;\">&nbsp;</td>";
              $html.="<td align=\"right\"  style=\"border-top:solid 1px #666;\">&nbsp;</td>";
			  if($oResultAmount->rows[$i]['Qty']==0)
			  {
					$html.="<td align=\"left\" colspan=\"4\" style=\"border-top:solid 1px #666;  border-right:solid 1px #666;\" >".$oResultAmount->rows[$i]['Details']."</td>";
			  }
			  else
			  {
				 $html.="<td align=\"left\" colspan=\"2\" style=\"border-top:solid 1px #666;  border-right:solid 1px #666;\">".$oResultAmount->rows[$i]['Details']."</td>";
				 $html.="<td align=\"right\" style=\"border-top:solid 1px #666;  border-right:solid 1px #666;\">".number_format($oResultAmount->rows[$i]['Qty'],0,'.','')."</td>";
				 $html.="<td align=\"right\" style=\"border-top:solid 1px #666;  border-right:solid 1px #666;\" >".number_format($oResultAmount->rows[$i]['Price'],2,'.','')."</td>";
			  }
			  $TotalAmount+= $oResultAmount->rows[$i]['Amount'];
			  $html.="<td style=\"border-top:solid 1px #666;\" align=\"right\">".number_format($oResultAmount->rows[$i]['Amount'],2,'.','')."</td>";
			  $html.="</tr>";
		  }
		  $html.="<tr style=\"font-size:8px;\">";
		  $html.="<td align=\"center\" colspan=\"4\" style=\"border-top:solid 1px #666; border-right:solid 1px #666;\"><b>Grand Total</b></td>";
		  $html.="<td align=\"right\" style=\"border-top:solid 1px #666; border-right:solid 1px #666;\">&nbsp;</td>";
		  $html.="<td align=\"center\" style=\"border-top:solid 1px #666; border-right:solid 1px #666;\">&nbsp;</td>";
		  $html.="<td style=\"border-top:solid 1px #666;\" align=\"right\"><b>".number_format($TotalAmount,2,'.','')."</b></td>";
		  $html.="</tr>";
	  }
	  $html.="<tr style=\"font-size:8px;\">";
      $html.="<td align=\"left\" colspan=\"7\" style=\"border-top:solid 1px #666; border-right:solid 1px #666;\"><strong>In Words:</strong>"; 
	  $number = number_format($TotalAmount, 2, '.', '');
	  $html.=ucwords($oCommon->NumberToWord($number,$Currency))." Only";
      $html.="</td>";
      $html.="</tr>";
      $html.="</table>";
	  
	  $html.="<table border=\"0\" width=\"550px\">";
	  $html.="<tr style=\"font-size:8px;\">";
	  $html.="<td align=\"left\" style=\"border:none; font-size:8px\" valign='top'>";
	  $html.="COUNTRY OF ORGIN<br/>TOTAL GROSS WEIGHT<br/>TOTAL NET WEIGHT<br/>TOTAL CARTON<br/>TOTAL CBM</td>";
	  $html.="<td width=\"200\" style=\"padding-left:3px; border:none\" valign='top'>";
	  $html.="Bangladesh<br/>".$GrossWeight." Kgs<br/>".$NetWeight." Kgs<br/>".$CatonQty." Cartons<br/>".$TotalCMB." CMB ";
	  $html.="</td>";
	  $html.="</tr>";
	  $html.="</table>";
	  $html.="</center>";
      $html.="</body>";
	  return $html;
   }
}
?>