<?php 
	$sql="SELECT * FROM logo WHERE ID=1";
	$oResultUp=$oBasic->SqlQuery($sql);
?>
<h1><a href="./"><img src="images/<?php echo $oResultUp->row['Image']?>" border="0" height="89" width="377"></a></h1>