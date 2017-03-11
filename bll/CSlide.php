<?php
	class CSlide
	{
		public $ID;
		public $SortID;
		public $HeadLine;
		public $CreateBy;
		public $CreateDate;
		
		public function __construct()
		{
			$this->CreateDate=date('Y-m-d H:i:s');
		}
	}
 	
	

?>