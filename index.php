<?php
	include('library/Session.php');
	$oSession=new Session();
	date_default_timezone_set('Asia/Dhaka');
	define('CREATEDATE',date('Y-m-d H:i:s'));
	
	include ('model/CResult.php');
	include ('library/CCommon.php');
	include ('library/Mail.php');
	include ('library/Paging.php');
	include ('bll/CConManager.php');
	include ('bll/CBasic.php');
	$oResult=new CResult();
	$oBasic=new CBasic();
	$oCommon=new CCommon();
	
	include ('gui/selectpage.php');
?>