<?php
	class CResult
	{
		public $row;
		public $rows;
		public $num_rows;
		public $effected_row;
		public $message;
		public $error;
		public $IsSuccess;
		public function __construct()
		{
			$this->IsSuccess=FALSE;$this->effected_row=0;$this->rows=array();
		}
	};
?>