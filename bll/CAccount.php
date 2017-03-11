<?php
class CAccount
{
	private $oConnManager;
    public function __construct()
    {
        $this->oConnManager = new CConManager();
    }
	
	//Create Chart Of Accounts
	public function CreateCOA(CCOA $oCoa)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO acc_coa (HeadCode,HeadName,PHeadName,HeadLevel,IsActive,IsTransaction, IsGL,HeadType,IsBudget,IsDepreciation,DepreciationRate,CreateBy,CreateDate) VALUES ('$oCoa->HeadCode','$oCoa->HeadName','$oCoa->PHeadName','$oCoa->HeadLevel',$oCoa->IsActive,$oCoa->IsTransaction,$oCoa->IsGL,'$oCoa->HeadType',$oCoa->IsBudget,$oCoa->IsDepreciation,$oCoa->DepreciationRate,'$oCoa->CreateBy','$oCoa->CreateDate')";
			$oResult=$this->oConnManager->query($sql);

			if($oCoa->HeadType=="I"&&$oCoa->IsTransaction==1)
			{
				$sql="ALTER TABLE `acc_student_income` ADD `$oCoa->HeadName` DECIMAL( 10, 2 ) NOT NULL ";
				$oResult=$this->oConnManager->query($sql);
			}
			elseif($oCoa->HeadType=="E"&&$oCoa->IsTransaction==1&&$oCoa->PHeadName=="Academic Expenses")
			{
				$sql="ALTER TABLE `acc_student_income` ADD `$oCoa->HeadName` DECIMAL( 10, 2 ) NOT NULL ";
				$oResult=$this->oConnManager->query($sql);
			}
			
			
			$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Chart Of Accounts','Accounts Head Entry','HeadCode-$oCoa->HeadCode','$oCoa->CreateBy','$oCoa->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	
	public function UpdateCOA(CCOA $oCoa)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT HeadName FROM acc_coa WHERE HeadCode='$oCoa->HeadCode'";
			$oResult=$this->oConnManager->query($sql);
			$PHeadName=$oResult->row['HeadName'];
			
			$sql="UPDATE acc_coa SET HeadName='$oCoa->HeadName',PHeadName='$oCoa->PHeadName',HeadLevel='$oCoa->HeadLevel',IsActive=$oCoa->IsActive,IsTransaction=$oCoa->IsTransaction, IsGL=$oCoa->IsGL,HeadType='$oCoa->HeadType',IsBudget=$oCoa->IsBudget,IsDepreciation=$oCoa->IsDepreciation,DepreciationRate=$oCoa->DepreciationRate, UpdateBy='$oCoa->CreateBy',UpdateDate='$oCoa->CreateDate' WHERE HeadCode='$oCoa->HeadCode'";
			$oResult=$this->oConnManager->query($sql);
			$sql="UPDATE acc_coa SET PHeadName='$oCoa->HeadName' WHERE PHeadName='$PHeadName'";
			$oResult=$this->oConnManager->query($sql);
			
			if($oCoa->HeadType=="I"&&$oCoa->IsTransaction==1)
			{
				$sql="ALTER TABLE `acc_student_income` CHANGE `$PHeadName` `$oCoa->HeadName` DECIMAL( 10, 2 ) NOT NULL ";
				$oResult=$this->oConnManager->query($sql);
			}
			elseif($oCoa->HeadType=="E"&&$oCoa->IsTransaction==1&&$oCoa->PHeadName=="Academic Expenses")
			{
				$sql="ALTER TABLE `acc_student_income` CHANGE `$PHeadName` `$oCoa->HeadName` DECIMAL( 10, 2 ) NOT NULL ";
				$oResult=$this->oConnManager->query($sql);
			}
			$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Chart Of Accounts','Accounts Head Update','HeadCode-$oCoa->HeadCode','$oCoa->CreateBy','$oCoa->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;
	}
	//end Chart Of Accounts
	public function CreateAdmission(CAdmission $oAdmission)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Admission','Addmission Entry','Voucher No-$oAdmission->VNo SemID-$oAdmission->SemesterID StdID-$oAdmission->StudentID PayMode-$oAdmission->PayMode','$oAdmission->CreateBy','$oAdmission->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO acc_admission (VNo, SemesterID, Date, StudentID, Amount,Vat,Waiver,PayMode ,BankCode,BankName,BranchName, ChequeNo, ChequeDate, Remarks, CreateBy, CreateDate)
			VALUES ('$oAdmission->VNo','$oAdmission->SemesterID','$oAdmission->Date','$oAdmission->StudentID','$oAdmission->Amount','$oAdmission->Vat','$oAdmission->Waiver','$oAdmission->PayMode' ,'$oAdmission->BankCode','$oAdmission->BankName','$oAdmission->BranchName', '$oAdmission->ChequeNo', '$oAdmission->ChequeDate','$oAdmission->Remarks','$oAdmission->CreateBy', '$oAdmission->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			if($oAdmission->PayMode=='Cheque')
			{
				$sql="INSERT INTO cheque_status (VNo, Student_Id, BankCode, CheckPerpose, BankName, BranchName, ChequeNo, ChequeDate, Amount, Status, Remarks) VALUES ('$oAdmission->VNo','$oAdmission->StudentID', '$oAdmission->BankCode','Admission', '$oAdmission->BankName','$oAdmission->BranchName', '$oAdmission->ChequeNo','$oAdmission->ChequeDate','$oAdmission->Amount','', '')";
				$oResultNew=$this->oConnManager->query($sql);
			}
			
			
		}
		return $oResult;
	}
	//end Admission
	//Registration
	public function CreateRegistrationInvoice(CAdmission $oRegistration)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Admission','Addmission Entry','Voucher No-$oRegistration->VNo SemID-$oRegistration->SemesterID StdID-$oRegistration->StudentID PayMode-$oRegistration->PayMode','$oRegistration->CreateBy','$oRegistration->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="INSERT INTO acc_registration (VNo, SemesterID, Date, StudentID,COAID, Amount, Remarks, CreateBy, CreateDate)
			VALUES ('$oRegistration->VNo','$oRegistration->SemesterID','$oRegistration->Date','$oRegistration->StudentID','$oRegistration->Code', '$oRegistration->Amount','$oRegistration->Remarks','$oRegistration->CreateBy', '$oRegistration->CreateDate')";
			$oResult=$this->oConnManager->query($sql);
			
		}
		return $oResult;
	}
	//Money Receipt
	public function CreateMoneyReceipt(CMoneyReceipt $oMoneyReceipt)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="INSERT INTO acc_moneyreceipt (InvoiceNo, InvDate, StdID, SemID, PaymentAmount, PayMode, BankCode, BankName, BranchName, ChequeNo, ChequeDate, PaymentPurpose,Discount, Remarks, CreateBy, CreateDate)
			VALUES ('$oMoneyReceipt->InvoiceNo','$oMoneyReceipt->InvDate','$oMoneyReceipt->StdID','$oMoneyReceipt->SemID','$oMoneyReceipt->PaymentAmount','$oMoneyReceipt->PayMode', '$oMoneyReceipt->BankCode','$oMoneyReceipt->BankName','$oMoneyReceipt->BranchName','$oMoneyReceipt->ChequeNo','$oMoneyReceipt->ChequeDate','$oMoneyReceipt->PaymentPurpose','$oMoneyReceipt->Discount','$oMoneyReceipt->Remarks','$oMoneyReceipt->CreateBy','$oMoneyReceipt->CreateDate')";			
			
			$oResult=$this->oConnManager->query($sql);
			
			if($oMoneyReceipt->PayMode=='Cheque')
			{
				$sql="INSERT INTO cheque_status (VNo,Student_Id, BankCode, CheckPerpose, BankName, BranchName, ChequeNo, ChequeDate, Amount, Status, Remarks)
				VALUES ('$oMoneyReceipt->InvoiceNo','$oMoneyReceipt->StdID', '$oMoneyReceipt->BankCode','Money Receipt', '$oMoneyReceipt->BankName','$oMoneyReceipt->BranchName', '$oMoneyReceipt->ChequeNo','$oMoneyReceipt->ChequeDate','$oMoneyReceipt->PaymentAmount','', '')";
				$oResultNew=$this->oConnManager->query($sql);
			}
		}
		return $oResult;
	}
	
	public function UpdateMoneyReceipt(CMoneyReceipt $oMoneyReceipt)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="UPDATE acc_moneyreceipt SET InvDate='$oMoneyReceipt->InvDate', StdID='$oMoneyReceipt->StdID', SemID='$oMoneyReceipt->SemID', PaymentAmount='$oMoneyReceipt->PaymentAmount', PayMode='$oMoneyReceipt->PayMode', BankCode='$oMoneyReceipt->BankCode', BankName= '$oMoneyReceipt->BankName', BranchName='$oMoneyReceipt->BranchName' ChequeNo='$oMoneyReceipt->ChequeNo',ChequeDate='$oMoneyReceipt->ChequeDate', Remarks='$oMoneyReceipt->Remarks', PaymentPurpose='$oMoneyReceipt->PaymentPurpose',Discount='$oMoneyReceipt->Discount', UpdateBy='$oMoneyReceipt->CreateBy',UpdateDate='$oMoneyReceipt->CreateDate'
			 WHERE InvoiceNo='$oMoneyReceipt->InvoiceNo";
			$oResult=$this->oConnManager->query($sql);
			
			$sql="DELETE FROM cheque_status WHERE VNo='$oMoneyReceipt->InvoiceNo'";
			$oResultNew=$this->oConnManager->query($sql);
			if($oMoneyReceipt->PayMode=='Cheque')
			{
				$sql="INSERT INTO cheque_status (VNo, Student_Id, BankCode, CheckPerpose, BankName, BranchName, ChequeNo, ChequeDate, Amount, Status, Remarks)
				VALUES ('$oMoneyReceipt->InvoiceNo','$oMoneyReceipt->StdID', '$oMoneyReceipt->BankCode','Money Receipt', '$oMoneyReceipt->BankName','$oMoneyReceipt->BranchName', '$oMoneyReceipt->ChequeNo','$oMoneyReceipt->ChequeDate','$oMoneyReceipt->PaymentAmount','', '')";
				$oResultNew=$this->oConnManager->query($sql);
			}
		}
		return $oResult;
	}
	//end Money receipt
	//Transaction Entry
	public function CreateTransaction(CAccTransaction $oTransaction)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			foreach($oTransaction->DetialList as $oTransactionDetails)
			{
				$sql="INSERT INTO acc_transaction (VNo,Vtype,VDate,COAID,Narration,Debit,Credit,SemesterID,DepartmentID,IsPosted, CreateBy,CreateDate,IsAppove)
				VALUES ('$oTransactionDetails->VNo','$oTransactionDetails->Vtype','$oTransactionDetails->VDate','$oTransactionDetails->COAID','$oTransactionDetails->Narration',$oTransactionDetails->Debit,$oTransactionDetails->Credit,'$oTransactionDetails->SemesterID','$oTransactionDetails->DepartmentID','$oTransactionDetails->IsPosted','$oTransactionDetails->CreateBy','$oTransactionDetails->CreateDate','$oTransactionDetails->IsAppove')";
				$oResult=$this->oConnManager->query($sql);
				
				$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Account Transaction','Accounts Trasation Entry','Voucher No-$oTransactionDetails->VNo Debit- $oTransactionDetails->Debit Credit-$oTransactionDetails->Credit','$oTransactionDetails->CreateBy','$oTransactionDetails->CreateDate')";
				$oResult=$this->oConnManager->query($sql);
			}
		}
		return $oResult;
	}
	
	public function UpdateTransaction(CAccTransaction $oTransaction)
	{
		$oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="DELETE FROM acc_transaction WHERE VNo='$oTransaction->VNo'";
			$oResult=$this->oConnManager->query($sql);
			foreach($oTransaction->DetialList as $oTransactionDetails)
			{
				$sql="INSERT INTO acc_transaction (VNo,Vtype,VDate,COAID,Narration,Debit,Credit,SemesterID,DepartmentID,IsPosted, CreateBy,CreateDate,IsAppove) 
				VALUES ('$oTransactionDetails->VNo','$oTransactionDetails->Vtype','$oTransactionDetails->VDate','$oTransactionDetails->COAID','$oTransactionDetails->Narration',$oTransactionDetails->Debit,$oTransactionDetails->Credit,'$oTransactionDetails->SemesterID','$oTransactionDetails->DepartmentID','$oTransactionDetails->IsPosted','$oTransactionDetails->CreateBy','$oTransactionDetails->CreateDate','$oTransactionDetails->IsAppove')";
				$oResult=$this->oConnManager->query($sql);
				$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Account Transaction','Accounts Trasation Update','Voucher No-$oTransactionDetails->VNo Debit- $oTransactionDetails->Debit Credit-$oTransactionDetails->Credit','$oTransactionDetails->CreateBy','$oTransactionDetails->CreateDate')";
				$oResult=$this->oConnManager->query($sql);
			}
		}
		return $oResult;
	}
	//end Transaction
	
	//Approve Voucher
	public function ApproveVoucher($VNo,$Check,$CreateBy)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$n=count($VNo);
			$CreateDate=date('Y-m-d H:i:s');
			for($i=0;$i<$n;$i++)
			{
				if(isset($Check[$i]))
				{
					$sql="UPDATE acc_transaction SET IsAppove=1,UpdateBy='$CreateBy', UpdateDate='$CreateDate' WHERE VNo='$VNo[$i]'";
					$oResult=$this->oConnManager->query($sql);
					
					$sql="UPDATE acc_income_expence SET IsAppove=1 WHERE VNo='$VNo[$i]'";
					$oResult=$this->oConnManager->query($sql);
					
					$sql="INSERT INTO accesslog (ActionPage, ActionDone,Remarks, UserName, EntryDate) VALUES ('Voucher Approve','Voucher Approve Entry','Voucher No- $VNo[$i]','$CreateBy','$CreateDate')";
					$oResult=$this->oConnManager->query($sql);
				}
			}
		}
		return $oResult;        
    }
	// Voucher
	
	//DropDown List
	public function ReadAllCountry()  //Read all Country For Drowdownlist 
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM country WHERE status=1";
			
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;        
    }
	
	public function ReadAllCatagory()  //Read all Catagory For Drowdownlist 
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM  item_catagory WHERE IsActive=1";
			
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;        
    }
	
	
	public function SqlQuery($sql)  //Read all Catagory For Drowdownlist 
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{			
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;        
    }
	
	public function SelectDepartment()  //Read all Department For Drowdownlist 
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$sql="SELECT * FROM department";
			
			$oResult=$this->oConnManager->query($sql);
		}
		return $oResult;        
    }
};
?>