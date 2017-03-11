<?php
class CConManager
{
	private $DataBase='kwmc';
	private $Host='localhost';
	private $User='root';
	private $Password='';
	
	private $conn;
	
	public function __construct()
	{
		$this->conn=mysql_connect($this->Host,$this->User,$this->Password) or die( "Unable to Connect: ".mysql_error()); 
	}
	
	public function Open()
	{
		if(!mysql_select_db($this->DataBase,$this->conn))
			exit('Error: Could not connect to database ' . $this->DataBase); 
		mysql_query("SET NAMES 'utf8'", $this->conn);
		mysql_query("SET CHARACTER SET utf8", $this->conn);
		mysql_query("SET CHARACTER_SET_CONNECTION=utf8", $this->conn);
		mysql_query("SET SQL_MODE = ''", $this->conn);
		mysql_query("SET SQL_SIGHTc= ''");
		return TRUE;
	}
	
	public function getLastId()
	{
    	return mysql_insert_id($this->conn);
  	}
	
	public function query($sql) 
	{
		try
		{	
			$resource = mysql_query($sql, $this->conn);
			if ($resource)
			{
				if (is_resource($resource))
				{
					$i = 0;
					$data = array();
					while ($result = mysql_fetch_assoc($resource))
					{
						$data[$i] = $result;
						$i++;
					}
					mysql_free_result($resource);
					$oResult = new CResult();
					$oResult->row = isset($data[0]) ? $data[0] : array();
					$oResult->rows = $data;
					$oResult->num_rows = $i;
					$oResult->IsSuccess=TRUE;
					unset($data);
					return $oResult;	
				}
				else  
				{
					$oResult = new CResult();
					$oResult->effected_row=mysql_affected_rows();
					$oResult->IsSuccess=TRUE;					
					return $oResult;
				}
			}
			else 
			{
				$oResult=new CResult();
				$oResult->message=mysql_error($this->conn);
				$oResult->error=mysql_errno($this->conn);
				$oResult->IsSuccess=FALSE;
				return $oResult;
			}
		}
		catch (Exception $e)
		{
			$oResult=new CResult();
			$oResult->message=$e->getMessage();
			$oResult->error=$e->getCode();
			$oResult->IsSuccess=FALSE;
			$oResult->show();
			return $oResult;
		}
  	}
	
	public function Close()
	{
		mysql_close($this->conn);
	}
};
?>