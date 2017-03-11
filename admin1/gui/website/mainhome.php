<?php
$page=false;
if(isset($_GET['Page']))
{
	$page=$_GET['Page']; 
}
?>
<a href="home.php?Page=Login" title="login">Login</a>