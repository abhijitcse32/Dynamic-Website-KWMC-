<?php
	include_once ('../library/Session.php');
	$oSession=new Session();
	include_once ('../model/CResult.php');
	include_once('../bll/CBasic.php');
	include_once('../bll/CConManager.php');
	
	$oResult=new CResult();
	$oConmanager=new CConManager;
	$oBasic=new CBasic();
	
	if($oSession->IsSession())
	{
		include_once ('gui/website/selectpage.php');
	}
	else
	{
		include_once ('gui/website/login.php');
	}
?> 