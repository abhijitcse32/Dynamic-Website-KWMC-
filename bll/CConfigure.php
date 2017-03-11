<?php
class CConfigure
{
	private $oConnManager;
    public function __construct()
    {
        $this->oConnManager = new CConManager();
    }
	public function CreateCompany($oCompany)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{ 
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				  VALUES ('Company','Company Entry','Company Name- $oCompany->Name Type- $oCompany->Type','$oCompany->CreateBy','$oCompany->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_company (Prefix, Name, CompanyType, GroupID, WebAddress, SuppTypeID, Address, Address1, Address2, BussinssType, Country, StateID, DistrictID, FirstName, SecondName, Saluation, PersonType, Middle, Suffix, Gender, ContactNo, FaxNo, ISDNNo, BEmail, SalesEmail, SupporteEmail, HeadCode, IsActive, CreateBy, CreateDate) 
			   VALUES ('$oCompany->Prefix','$oCompany->Name','$oCompany->Type','$oCompany->groupID', '$oCompany->WebAddress', '$oCompany->typeID', '$oCompany->Address', '$oCompany->Address1', '$oCompany->Address2', '$oCompany->BussinssType', '$oCompany->Country', '$oCompany->StateID', '$oCompany->DistrictID', '$oCompany->FirstName', '$oCompany->SecondName', '$oCompany->Saluation', '$oCompany->PersonType', '$oCompany->Middle', '$oCompany->Suffix', '$oCompany->Gender', '$oCompany->ContactNo', '$oCompany->FaxNo', '$oCompany->ISDNNo', '$oCompany->BEmail', '$oCompany->SalesEmail', '$oCompany->SupporteEmail', '$oCompany->HeadCode', '$oCompany->IsActive', '$oCompany->CreateBy', '$oCompany->CreateDate')";
			 $oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateCompany($oCompany)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{ 
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				  VALUES ('Company','Company Entry','Company Name- $oCompany->Name Type- $oCompany->Type','$oCompany->CreateBy','$oCompany->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			//CompanyType='$oCompany->Type'
			$sql="UPDATE cm_company SET Prefix='$oCompany->Prefix', Name='$oCompany->Name', GroupID='$oCompany->groupID', WebAddress='$oCompany->WebAddress',SuppTypeID='$oCompany->typeID', Address='$oCompany->Address', Address1='$oCompany->Address1', Address2='$oCompany->Address2', BussinssType='$oCompany->BussinssType', Country='$oCompany->Country', StateID='$oCompany->StateID', DistrictID='$oCompany->DistrictID', FirstName='$oCompany->FirstName', SecondName='$oCompany->SecondName', Saluation='$oCompany->Saluation', PersonType= '$oCompany->PersonType', Middle='$oCompany->Middle', Suffix='$oCompany->Suffix', Gender='$oCompany->Gender', ContactNo='$oCompany->ContactNo', FaxNo='$oCompany->FaxNo', ISDNNo='$oCompany->ISDNNo', BEmail='$oCompany->BEmail', SalesEmail='$oCompany->SalesEmail', SupporteEmail='$oCompany->SupporteEmail', HeadCode='$oCompany->HeadCode', IsActive='$oCompany->IsActive', UpdateBy='$oCompany->CreateBy', UpdateDate='$oCompany->CreateDate' WHERE ID='$oCompany->ID'";
			 $oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	//Create Buyer Group
	public function CreateBuyerGroup($oBuyerGroup)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadCode LIKE '102030%'";
			$oResult=$this->oConnManager->query($sql);
			if(isset($oResult->row['HeadCode']))
				$HeadCode=$oResult->row['HeadCode']+1;
			else
				$HeadCode="10203001";
	
			$sql="INSERT INTO cm_buyergroup (Prefix, Name, Address, Email,HeadCode, IsActive, CreateBy, CreateDate) 
			          VALUES ('$oBuyerGroup->Prefix','$oBuyerGroup->Name','$oBuyerGroup->Address','$oBuyerGroup->Email','$HeadCode','$oBuyerGroup->IsActive','$oBuyerGroup->CreateBy','$oBuyerGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate) VALUES ('$HeadCode','$oBuyerGroup->Name','Account Receivable','3','$oBuyerGroup->IsActive',0,1,'A',0,0,0,'$oBuyerGroup->CreateDate','$oBuyerGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				  VALUES ('Buyer Group','Buyer Group Entry','$oBuyerGroup->Prefix','$oBuyerGroup->CreateBy','$oBuyerGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateBuyerGroup($oBuyerGroup)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM cm_buyergroup WHERE ID='$oBuyerGroup->ID'";
			$oResultGp=$this->oConnManager->query($sql);
			$HeadName=$oResultGp->row['Name'];
			$HeadCode=$oResultGp->row['HeadCode'];
			
			$sql="UPDATE cm_buyergroup SET Prefix='$oBuyerGroup->Prefix', Name='$oBuyerGroup->Name', Address='$oBuyerGroup->Address', Email='$oBuyerGroup->Email', IsActive='$oBuyerGroup->IsActive',
			    UpdateBy='$oBuyerGroup->CreateBy', UpdateDate='$oBuyerGroup->CreateDate' WHERE ID='$oBuyerGroup->ID'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE acc_coa SET HeadName='$oBuyerGroup->Name', IsActive='$oBuyerGroup->IsActive' WHERE HeadCode='$HeadCode'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE acc_coa SET PHeadName='$oBuyerGroup->Name' WHERE PHeadName='$HeadName'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate)
				  VALUES ('Buyer Group','Buyer Group Update','$oBuyerGroup->Prefix','$oBuyerGroup->CreateBy','$oBuyerGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	//Create Supplier Type
	public function CreateSuppType($oSuppType)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_suptype ( Name, IsActive, CreateBy, CreateDate) 
			      VALUES ('$oSuppType->Name', '$oSuppType->IsActive','$oSuppType->CreateBy','$oSuppType->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				  VALUES ('Supplier Type','Supplier Type Entry',' $oSuppType->Name','$oSuppType->CreateBy','$oSuppType->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateSuppType($oSuppType)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="UPDATE cm_suptype SET Name='$oSuppType->Name', IsActive='$oSuppType->IsActive', UpdateBy='$oSuppType->CreateBy', UpdateDate='$oSuppType->CreateDate'
			      WHERE ID='$oSuppType->ID'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate)
				  VALUES ('Supplier Type','Supplier Type Update ',' $oSuppType->Name','$oSuppType->CreateBy','$oSuppType->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	// Create Supplier Group
	public function CreateSuppGroup($oSuppGroup)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadCode LIKE '2010%'";
			$oResult=$this->oConnManager->query($sql);
			if(isset($oResult->row['HeadCode']))
				$HeadCode=$oResult->row['HeadCode']+1;
			else
				$HeadCode="201001";
	
			$sql="INSERT INTO cm_supgroup (Prefix, Name, Address, Email,HeadCode, IsActive, CreateBy, CreateDate) 
			      VALUES ('$oSuppGroup->Prefix','$oSuppGroup->Name','$oSuppGroup->Address','$oSuppGroup->Email','$HeadCode','$oSuppGroup->IsActive','$oSuppGroup->CreateBy','$oSuppGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate)
				  VALUES ('$HeadCode','$oSuppGroup->Name','Account Payable','2','$oSuppGroup->IsActive',0,1,'A',0,0,0,'$oSuppGroup->CreateDate','$oSuppGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				  VALUES ('Supplier Group','Supplier Group Entry','$oSuppGroup->Prefix','$oSuppGroup->CreateBy','$oSuppGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateSuppGroup($oSuppGroup)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM cm_supgroup WHERE ID='$oSuppGroup->ID'";
			$oResultGp=$this->oConnManager->query($sql);
			$HeadName=$oResultGp->row['Name'];
			$HeadCode=$oResultGp->row['HeadCode'];
			
			$sql="UPDATE cm_supgroup SET Prefix='$oSuppGroup->Prefix', Name='$oSuppGroup->Name', Address='$oSuppGroup->Address', Email='$oSuppGroup->Email', IsActive='$oSuppGroup->IsActive',
			      UpdateBy='$oSuppGroup->CreateBy', UpdateDate='$oSuppGroup->CreateDate' WHERE ID='$oSuppGroup->ID'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE acc_coa SET HeadName='$oSuppGroup->Name', IsActive='$oSuppGroup->IsActive' WHERE HeadCode='$HeadCode'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE acc_coa SET PHeadName='$oSuppGroup->Name' WHERE PHeadName='$HeadName'";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate)
				  VALUES ('Supplier Group','Supplier Group Update','$oSuppGroup->Prefix','$oSuppGroup->CreateBy','$oSuppGroup->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	// Create Buyer	
	public function CreateBuyer($oBuyer)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM cm_buyergroup WHERE ID='$oBuyer->groupID'";
			$oResultGp=$this->oConnManager->query($sql);
			$HeadNameG=$oResultGp->row['Name'];
			$HeadCodeG=$oResultGp->row['HeadCode'];
			
			$sql="SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadCode LIKE '$HeadCodeG"."0%'";
			$oResult=$this->oConnManager->query($sql);
			if(isset($oResult->row['HeadCode']))
				$HeadCode=$oResult->row['HeadCode']+1;
			else
				$HeadCode= $HeadCodeG."0001";
				
			$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate) 
			      VALUES ('$HeadCode','$oBuyer->Name','$HeadNameG','4','$oBuyer->IsActive',1,0,'A',0,0,0,'$oBuyer->CreateBy','$oBuyer->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		$oResult->HeadCode=$HeadCode;
		return $oResult;
	}
	
	public function UpdateBuyer($oBuyer)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM cm_buyer WHERE ID='$oBuyer->ID'";
			$oResultBu=$this->oConnManager->query($sql);
			$GroupID=$oResultBu->row['groupID'];
			$HeadCode=$oResultBu->row['HeadCode'];
			if($GroupID==$oBuyer->groupID)
			{
				$sql="UPDATE acc_coa SET HeadName='$oBuyer->Name', IsActive='$oBuyer->IsActive' WHERE HeadCode='$HeadCode'";
				$oResult=$this->oConnManager->query($sql);
			}
			else
			{
				$sql="SELECT * FROM cm_buyergroup WHERE ID='$oBuyer->groupID'";
				$oResultGp=$this->oConnManager->query($sql);
				$HeadNameG=$oResultGp->row['Name'];
				$HeadCodeG=$oResultGp->row['HeadCode'];
			
				$sql="SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadCode LIKE '$HeadCodeG"."0%'";
				$oResult=$this->oConnManager->query($sql);
				if(isset($oResult->row['HeadCode']))
					$HeadCodeNew=$oResult->row['HeadCode']+1;
				else
					$HeadCodeNew= $HeadCodeG."0001";
				
				$sql="DELETE FROM acc_coa WHERE HeadCode='$HeadCode'";
				$oResult=$this->oConnManager->query($sql);
				$HeadCode=$HeadCodeNew;
				$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate) 
			      VALUES ('$HeadCode','$oBuyer->Name','$HeadNameG','4','$oBuyer->IsActive',1,0,'A',0,0,0,'$oBuyer->CreateBy','$oBuyer->CreateDate')";
				$oResult=$this->oConnManager->query($sql);
				
			}
		}
		$oResult->HeadCode=$HeadCode;
		return $oResult;
	}
	
	// Create Supplier	
	public function CreateSupplier($oSupplier)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM cm_supgroup WHERE ID='$oSupplier->groupID'";
			$oResultGp=$this->oConnManager->query($sql);
			$HeadNameG=$oResultGp->row['Name'];
			$HeadCodeG=$oResultGp->row['HeadCode'];
			
			$sql="SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadCode LIKE '$HeadCodeG"."0%'";
			$oResult=$this->oConnManager->query($sql);
			if(isset($oResult->row['HeadCode']))
				$HeadCode=$oResult->row['HeadCode']+1;
			else
				$HeadCode= $HeadCodeG."0001";
			
			$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate) 
			      VALUES ('$HeadCode','$oSupplier->Name','$HeadNameG','3','$oSupplier->IsActive',1,0,'L',0,0,0,'$oSupplier->CreateBy','$oSupplier->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		$oResult->HeadCode=$HeadCode;
		return $oResult;
	}
	
	public function UpdateSupplier($oSupplier)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM cm_supplier WHERE ID='$oSupplier->ID'";
			$oResultBu=$this->oConnManager->query($sql);
			$GroupID=$oResultBu->row['groupID'];
			$HeadCode=$oResultBu->row['HeadCode'];
			if($GroupID==$oSupplier->groupID)
			{
				$sql="UPDATE cm_supplier SET Prefix= '$oSupplier->Prefix', Name= '$oSupplier->Name', groupID='$oSupplier->groupID', typeID='$oSupplier->typeID',ContactPerson= '$oSupplier->ContactPerson', ContactNo= '$oSupplier->ContactNo',
			      	  Address= '$oSupplier->Address', Email= '$oSupplier->Email', Country='$oSupplier->Country', WebAddress='$oSupplier->WebAddress', IsActive='$oSupplier->IsActive',StateID='$oSupplier->StateID',
					  DistrictID= '$oSupplier->DistrictID', UpdateBy='$oSupplier->CreateBy', UpdateDate='$oSupplier->CreateDate' WHERE ID='$oSupplier->ID'";
				$oResult=$this->oConnManager->query($sql);
				
				$sql="UPDATE acc_coa SET HeadName='$oSupplier->Name', IsActive='$oSupplier->IsActive' WHERE HeadCode='$HeadCode'";
				$oResult=$this->oConnManager->query($sql);
			}
			else
			{
				$sql="SELECT * FROM cm_supgroup WHERE ID='$oSupplier->groupID'";
				$oResultGp=$this->oConnManager->query($sql);
				$HeadNameG=$oResultGp->row['Name'];
				$HeadCodeG=$oResultGp->row['HeadCode'];
				$sql="SELECT MAX(HeadCode) as HeadCode FROM acc_coa WHERE HeadCode LIKE '$HeadCodeG"."0%'";
				$oResult=$this->oConnManager->query($sql);
				if(isset($oResult->row['HeadCode']))
					$HeadCodeNew=$oResult->row['HeadCode']+1;
				else
					$HeadCodeNew= $HeadCodeG."0001";

				$sql="DELETE FROM acc_coa WHERE HeadCode='$HeadCode'";
				$oResult=$this->oConnManager->query($sql);
				$HeadCode=$HeadCodeNew;
				$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate) 
			          VALUES ('$HeadCode','$oSupplier->Name','$HeadNameG','3','$oSupplier->IsActive',1,0,'L',0,0,0,'$oSupplier->CreateBy','$oSupplier->CreateDate')";
				$oResult=$this->oConnManager->query($sql);
			}
		}
		$oResult->HeadCode=$HeadCode;
		return $oResult;
	}
	
	//State
	public function CreateState($oState)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				VALUES ('State Setup','State Entry','Country-$oState->Country Name-$oState->Name','$oState->CreateBy','$oState->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			$sql="INSERT INTO cm_state (Country,Name,IsActive, CreateBy,CreateDate) VALUES ('$oState->Country','$oState->Name', '$oState->IsActive','$oState->CreateBy','$oState->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateState($oState)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				VALUES ('State Setup','State Update','ID-$oState->ID Country-$oState->Country Name-$oState->Name','$oState->CreateBy','$oState->CreateDate')";
			$oResult=$this->oConnManager->query($sql);	
			
			$sql="UPDATE cm_state SET Country='$oState->Country', Name='$oState->Name', IsActive='$oState->IsActive',
			      UpdateBy='$oState->CreateBy', UpdateDate='$oState->CreateDate' WHERE ID='$oState->ID'";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}

	//District
	public function CreateDistrict($oDistrict)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
			VALUES ('District Setup','District Entry','Country-$oDistrict->Country StateID-$oDistrict->StateID Name-$oDistrict->Name ','$oDistrict->CreateBy','$oDistrict->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_district (Country, StateID, Name, IsActive, CreateBy, CreateDate) VALUES ('$oDistrict->Country', '$oDistrict->StateID', '$oDistrict->Name', '$oDistrict->IsActive', '$oDistrict->CreateBy', '$oDistrict->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateDistrict($oDistrict)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) 
				VALUES ('District Setup','District Update','ID-$oDistrict->ID Country-$oDistrict->Country Name-$oDistrict->Name','$oDistrict->CreateBy','$oDistrict->CreateDate')";
			$oResult=$this->oConnManager->query($sql);	
			
			$sql="UPDATE cm_district SET Country='$oDistrict->Country', StateID='$oDistrict->StateID', Name='$oDistrict->Name', IsActive='$oDistrict->IsActive',
			      UpdateBy='$oDistrict->CreateBy', UpdateDate='$oDistrict->CreateDate' WHERE ID='$oDistrict->ID'";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	//Currency
	public function CreateCurrency($oCurrency)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			if($oCurrency->IsDefault==1)
			{
				$sql="UPDATE cm_currency SET IsDefault=0";
				$oResult=$this->oConnManager->query($sql);
			}
			$sql="INSERT INTO cm_currency (Code,Name,ShortName,Symbol,IsPreFix,IsActive,IsDefault,CreateBy,CreateDate) VALUES ('$oCurrency->Code','$oCurrency->Name','$oCurrency->ShortName','$oCurrency->Symbol',$oCurrency->IsPreFix,$oCurrency->IsActive,$oCurrency->IsDefault,'$oCurrency->CreateBy','$oCurrency->CreateDate')";
			//echo $sql; exit;
			$oResult=$this->oConnManager->query($sql);
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Currency','Currency Entry',' Name-$oCurrency->Name ','$oCurrency->CreateBy','$oCurrency->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;        
    }
	
	public function UpdateCurrency($oCurrency)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			if($oCurrency->IsDefault==1)
			{
				$sql="UPDATE cm_currency SET IsDefault=0";
				$oResult=$this->oConnManager->query($sql);
			}
			$sql="UPDATE cm_currency SET Code='$oCurrency->Code', Name='$oCurrency->Name', ShortName='$oCurrency->ShortName', Symbol='$oCurrency->Symbol', IsPreFix=$oCurrency->IsPreFix, IsActive=$oCurrency->IsActive, IsDefault=$oCurrency->IsDefault, UpdateBy='$oCurrency->CreateBy', UpdateDate='$oCurrency->CreateDate' WHERE ID=$oCurrency->ID";
			//echo $sql; exit;
			$oResult=$this->oConnManager->query($sql);
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Currency','Currency Update',' Name-$oCurrency->Name  ID-$oCurrency->ID', '$oCurrency->CreateBy', '$oCurrency->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;        
    }
	
	//Currency Convert
	public function CreateCurrencyRate($Rate,$CurrencyID,$CreateBy,$CreateDate)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="DELETE FROM cm_currency_rate";
			$oResult=$this->oConnManager->query($sql);
			$n=count($Rate);
			for($i=0;$i<$n;$i++)
			{
				$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Currency Setup','Currency Setup Entry','ID- $CurrencyID[$i] Reae- $Rate[$i] ','$CreateBy','$CreateDate')";
				$oResult=$this->oConnManager->query($sql);
				
				$sql="INSERT INTO cm_currency_rate (CurrencyID,Rate,CreateBy,CreateDate) VALUES ($CurrencyID[$i],$Rate[$i],'$CreateBy','$CreateDate')";
				$oResult=$this->oConnManager->query($sql);
			}
		}
		return $oResult;        
    }
	
	//Revenue
	public function CreateRevenue($oRevenue)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone, Remarks, UserName, EntryDate) VALUES ('Revenue Setup','Revenue Entry',' GroupID-$oRevenue->GroupID FromAmount- $oRevenue->FromAmount ToAmount-$oRevenue->ToAmount Revenue-$oRevenue->Revenue','$oRevenue->CreateBy','$oRevenue->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_revenue (GroupID, FromAmount, ToAmount, Revenue, IsPercent, CreateBy, CreateDate)
			      VALUES ('$oRevenue->GroupID','$oRevenue->FromAmount','$oRevenue->ToAmount','$oRevenue->Revenue','$oRevenue->IsPercent','$oRevenue->CreateBy','$oRevenue->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
    }

	public function UpdateRevenue($oRevenue)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone, Remarks, UserName, EntryDate) VALUES ('Revenue Setup','Revenue Update','ID=$oRevenue->ID GroupID-$oRevenue->GroupID FromAmount- $oRevenue->FromAmount ToAmount-$oRevenue->ToAmount Revenue-$oRevenue->Revenue','$oRevenue->CreateBy','$oRevenue->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE cm_revenue SET GroupID='$oRevenue->GroupID', FromAmount='$oRevenue->FromAmount', ToAmount='$oRevenue->ToAmount', Revenue='$oRevenue->Revenue', IsPercent='$oRevenue->IsPercent', UpdateBy='$oRevenue->CreateBy', UpdateDate='$oRevenue->CreateDate' WHERE ID='$oRevenue->ID' ";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
    }
	
	//Bank Grantee
	public function CreateBankGrante($oBankgrantee)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone, Remarks, UserName, EntryDate) VALUES ('Bank Guarantee Setup','Bank Guarantee Entry',' Name-$oBankgrantee->Name SwiftNo-$oBankgrantee->SwiftNo ContactPerson-$oBankgrantee->ContactPerson GroupID-$oBankgrantee->GroupID BuyerID-$oBankgrantee->BuyerID  IssueDate- $oBankgrantee->IssueDate ExpireDate-$oBankgrantee->ExpireDate Email-$oBankgrantee->Email Address-$oBankgrantee->Address Country-$oBankgrantee->Country StateID-$oBankgrantee->StateID DistrictID-$oBankgrantee->DistrictID ContactNo-$oBankgrantee->ContactNo WebAddress-$oBankgrantee->WebAddress IsActive-$oBankgrantee->IsActive','$oBankgrantee->CreateBy','$oBankgrantee->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO cm_bankgrantee (Name, SwiftNo, ContactPerson, GroupID, BuyerID, IssueDate, ExpireDate, Email, Address, Country, StateID, DistrictID, ContactNo, WebAddress, IsActive, CreateBy, CreateDate)
			      VALUES ('$oBankgrantee->Name','$oBankgrantee->SwiftNo','$oBankgrantee->ContactPerson','$oBankgrantee->GroupID','$oBankgrantee->BuyerID','$oBankgrantee->IssueDate','$oBankgrantee->ExpireDate','$oBankgrantee->Email', '$oBankgrantee->Address','$oBankgrantee->Country','$oBankgrantee->StateID','$oBankgrantee->DistrictID','$oBankgrantee->ContactNo','$oBankgrantee->WebAddress','$oBankgrantee->IsActive','$oBankgrantee->CreateBy','$oBankgrantee->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
    }
	
	public function UpdateBankGrante($oBankgrantee)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone, Remarks, UserName, EntryDate) VALUES ('Bank Guarantee Setup','Bank Guarantee Update',' Name-$oBankgrantee->Name SwiftNo-$oBankgrantee->SwiftNo ContactPerson-$oBankgrantee->ContactPerson GroupID-$oBankgrantee->GroupID BuyerID-$oBankgrantee->BuyerID  IssueDate- $oBankgrantee->IssueDate ExpireDate-$oBankgrantee->ExpireDate Email-$oBankgrantee->Email Address-$oBankgrantee->Address Country-$oBankgrantee->Country StateID-$oBankgrantee->StateID DistrictID-$oBankgrantee->DistrictID ContactNo-$oBankgrantee->ContactNo WebAddress-$oBankgrantee->WebAddress IsActive-$oBankgrantee->IsActive','$oBankgrantee->CreateBy','$oBankgrantee->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE cm_bankgrantee 
SET Name = '$oBankgrantee->Name',
SwiftNo = '$oBankgrantee->SwiftNo',
ContactPerson = '$oBankgrantee->ContactPerson',
GroupID = '$oBankgrantee->GroupID',
BuyerID = '$oBankgrantee->BuyerID',
IssueDate = '$oBankgrantee->IssueDate',
ExpireDate = '$oBankgrantee->ExpireDate',
Email = '$oBankgrantee->Email',
Address = '$oBankgrantee->Address',
Country = '$oBankgrantee->Country',
StateID = '$oBankgrantee->StateID',
DistrictID = '$oBankgrantee->DistrictID', 
ContactNo = '$oBankgrantee->ContactNo', 
WebAddress = '$oBankgrantee->WebAddress', 
IsActive = '$oBankgrantee->IsActive', 
CreateBy = '$oBankgrantee->CreateBy', 
CreateDate = '$oBankgrantee->CreateDate'
WHERE ID = '$oBankgrantee->ID' ";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
    }

	/*public function UpdateRevenue($oRevenue)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO cm_accesslog (ActionPage, ActionDone, Remarks, UserName, EntryDate) VALUES ('Revenue Setup','Revenue Update','ID=$oRevenue->ID GroupID-$oRevenue->GroupID FromAmount- $oRevenue->FromAmount ToAmount-$oRevenue->ToAmount Revenue-$oRevenue->Revenue','$oRevenue->CreateBy','$oRevenue->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="UPDATE cm_revenue SET GroupID='$oRevenue->GroupID', FromAmount='$oRevenue->FromAmount', ToAmount='$oRevenue->ToAmount', Revenue='$oRevenue->Revenue', IsPercent='$oRevenue->IsPercent', UpdateBy='$oRevenue->CreateBy', UpdateDate='$oRevenue->CreateDate' WHERE ID='$oRevenue->ID' ";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
    }*/
};
?>