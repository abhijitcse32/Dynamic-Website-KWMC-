<?php
	$GLOBALS["url"]=""; //LT
	ini_set('max_execution_time', 1000);
	date_default_timezone_set('Asia/Dhaka');
	define('CREATE_DATE',date('Y-m-d H:i:s'));
	include_once ('../library/CCommon.php');
	include_once ('../library/Session.php');
	$oSession=new Session();   
	include_once ('../model/CResult.php');
	include_once ('../bll/CConManager.php');//Session Ojbect Create
	include_once ('../bll/CBasic.php');
	$oBasic=new CBasic();
	
	if(isset($_GET['Page']))
	{
		$System=$_GET["Page"];
		if($System=='Login')
		{
			include('gui/website/login.php');
		}
		
	}
	elseif(isset($_GET['Basic']))
	{
		$Basic=$_GET["Basic"];
		if($Basic=='Slide')
		{
			include('gui/slide.php');
		}
		
		elseif($Basic=='Logo')
		{
			include('gui/logo.php');
		}
		
		elseif($Basic=='Details')
		{
			include('gui/details.php');
		}
		
		elseif($Basic=='Objective')
		{
			include('gui/objective.php');
		}
		
		elseif($Basic=='Faculty')
		{
			include('gui/faculty.php');
		}
		
		elseif($Basic=='PSW')
		{
			include('gui/changepassword.php');
		}
		
	}
	
	else
	{
		include_once('gui/main.php');
	}
?>