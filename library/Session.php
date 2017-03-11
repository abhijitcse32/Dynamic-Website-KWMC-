<?php
final class Session
{
  	public function __construct()
	{
		@session_start();
		//echo session_id();
		if (!session_id())
		{
			ini_set('session.gc_maxlifetime',1200);
			ini_set('session.use_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');
			session_set_cookie_params(0, '/');
		}
	}
	
	public function SessionClose()
	{
		if (session_id())
		{
			session_destroy();
		}
	}
	
	public function IsSession()
	{
		if(isset($_SESSION['SESS_ID']))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	public function getUserID()
	{
		if(isset($_SESSION['SESS_ID']))
		{
			return $_SESSION['SESS_ID'];
		}
		else
		{
			return FALSE;
		}
	}

	public function getPassWord()
	{
		if(isset($_SESSION['SESS_PASSWORD']))
		{
			return $_SESSION['SESS_PASSWORD'];
		}
		else
		{
			return FALSE;
		}
	}
	
	public function getUserName()
	{
		if(isset($_SESSION['SESS_USERNAME']))
		{
			return $_SESSION['SESS_USERNAME'];
		}
		else
		{
			return FALSE;
		}
	}
	
	public function getLimit()
	{
		if(isset($_SESSION['SESS_PAGELIMIT']))
		{
			return $_SESSION['SESS_PAGELIMIT'];
		}
		else
		{
			return FALSE;
		}
	}
	
	public function getPageNo()
	{
		if(isset($_SESSION['SESS_PAGEING']))
		{
			return $_SESSION['SESS_PAGEING'];
		}
		else
		{
			return FALSE;
		}
	}
}
?>