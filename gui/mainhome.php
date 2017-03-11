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
   <style>
   .blink_me {
  animation: blinker 1s linear infinite;
}

@keyframes blinker {  
  50% { opacity: 0; }
}
   </style>
   <p style="text-align:center"><span class="blink_me" style="color:red; font-size:20px;"><a href="index.php?Page=Result">MBBS Admission 2016-2017 Main Result</a></span></p>
   <p style="text-align:center"><span class="blink_me" style="color:red; font-size:20px;"><a href="index.php?Page=Waiting">MBBS Admission 2016-2017 Waiting List</a></span></p>
   <p style="text-align:center"><span class="blink_me" style="color:red; font-size:20px;"><a href="index.php?Page=BDSResult">BDS Admission 2016-2017 Main List</a></span></p>
   
   <div id="moddle_text">
   <?php 
		$sql="SELECT * FROM home WHERE ID=1";
		$oResultUp=$oBasic->SqlQuery($sql);
	?>
    <img src="images/<?php echo $oResultUp->row['Photo']?>" height="260" width="360"> <h1><?php echo $oResultUp->row['HeadLine']?></h1>
	<?php echo $oResultUp->row['Message']?><br><br>
	<a href="index.php?Page=RPS"><button>More About RP Shaha</button></a>
</div>
<p style="text-align:center; ">
	<a href="index.php?Page=Admission">
		<button style="font-size:20px; color:red">
			Students Fees & Charges for MBBS Course(Session 2016-2017)
		</button>
	</a>
</p>
    <div id="main_con">
<div id="customer_success">
<h2>Objective </h2>
<div id="customer_success_image"><img src="images/cell_cenetr.jpg" height="82" width="75"></div>
<div id="customer_success_text">
<strong>The main objectives of KWMC are to materialize the dream of the founder of Kumudini Welfare Trust</strong>
<ul>

<li>To Allow a large number of female students to </li>


</ul>
<a href="index.php?Page=Objective"><p></p></a>
</div>

</div>
<div id="carrer_with_us">
<h2> M.B.B.S. course</h2>
<div id="carrer_with_image"><img src="images/product.jpg" height="82" width="75"></div>
<div id="carrer_with_text">
<strong>M.B.B.S. course is of 5 years duration plus 1 year internship training</strong>
<div style="text-align:center; line-height:14px; color:#069;">
In<br>
1st week of January<br>
And<br>
1st week of July
</div>
<a href="#"><p></p></a>
</div></div>
<div id="contact_us">
<h2>Admission</h2>
<div id="contact_us_image"><img src="images/quality_icon.jpg" height="82" width="75"></div>
<div id="contact_us_text">
<strong>Eligibility for Admission</strong>
Candidates who have passed SSC and HSC examination in science group with
 physics, chemistry and Biology from any recognized Board/ University of
 Bangladesh with a total grade point average of 8.00 
<a href="index.php?Page=Admission"><p></p></a>
</div></div>
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