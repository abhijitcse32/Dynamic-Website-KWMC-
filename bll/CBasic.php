<?php
class CBasic
{
	private $oConnManager;
    public function __construct()
    {
        $this->oConnManager = new CConManager();
    }
	
	//Create Chart Of Accounce
	
	//SqlQuery Common
	public function SqlQuery($Sql)
    {
        $oResult =new CResult();
        if($this->oConnManager->Open())
		{
			$oResult=$this->oConnManager->query($Sql);
		}
		return $oResult;        
    }
	//end SqlQuery Common
};		
?>