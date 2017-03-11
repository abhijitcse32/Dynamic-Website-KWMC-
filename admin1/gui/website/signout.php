<?php
	include ('../library/Session.php');
	$oSession=new Session();
	$oSession->SessionClose();
	echo ("<script>window.location='../index.php';</script>");
?>