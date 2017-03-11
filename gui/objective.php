<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('meta.php');?>
</head>

<body>
<div id="body_container">
<div id="header">
<div id="header_logo">
<?php include('logo.php');?>
 </div>
<div id="header_btn">

  <?php //include('rightlogo.php');?>
 
</div>
</div>


  <div id="top_menu">
    <?php include('menu.php');?>
  </div>





<div id="header_top_bg"></div>
<div id="middle_bg">
<div id="middle_contant">



<div id="moddle_banner">
    <?php include('slide.php');?>
</div>
<!--<div id="semi_moddle_banner">
		<ul id="semi_moddle_banner">
			<li class="twitter">
				<a href="#"><h1>Our Popular Products</h1> on Twitter for news and updates.</a>
			</li>
			<li class="help">
				<a href="#"><h1>Quality Policy:</h1> page.
                <p>The Management of Kumudini Pharma Ltd. Is committed to:I.Follow cGMP as recommended by WHO and ISO 9001:2008 Quality Management System (QMS) to produce high quality pharmaceutical products to satisfy customersâ€™ requirements. The company will also follow all regulatory requirements;</p></a>

			</li>
			<li class="press">
				<a href="#"><h1>ISO Certification:</h1>.
             <p>Kumudini Pharma has been re-audited and obtained renewed and updated Certificate of Registration for ISO 9001:2008 </p>.</a>
			</li>
			
		</ul>
	</div>
    
   -->
   <div id="moddle_text">
    <?php 
		$sql="SELECT * FROM home WHERE ID=2";
		$oResultUp=$oBasic->SqlQuery($sql);
	?>
    <img src="images/<?php echo $oResultUp->row['Photo']?>" width="357" height="239"/> <h1><?php echo $oResultUp->row['HeadLine']?></h1>
    <div style="width:580px; float:right; overflow:hidden;">
    <?php echo $oResultUp->row['Message']?>

</div>

</div>
    
    

</div>
</div>

<div id="footer_bg"></div>
</div>
<div id="footer">
<?php include('footer.php');?>
</div>



<script language="VBScript">
</body></html>