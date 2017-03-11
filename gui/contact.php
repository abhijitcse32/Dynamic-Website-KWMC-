<?php  
 if (isset($_POST["message"]))
 {	 
 	$subject = 'Feedback from '.$_POST["name"];
	$msg = $_POST["message"];
    mail("info@kwmcbd.org",$subject,$msg);
	echo ("<script>window.alert('Your feedback message has been successfully submitted. Thanks!!!');</script>");
	echo "<script>window.location='?Page=Contact'</script>";
 }
?>
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
   
    <img src="images/contact_us_1.jpg" width="360" height="240"/> <h1>KUMUDINI WOMEN'S MEDICAL COLLEGE (KWMC) </h1>
<strong>Contact Us:</strong><br />
Kumudini Womens' Medical College (Dhaka Office)<br />
74 Gulshan Avenue, Gulshan-1, Dhaka 1212, Bangladesh.<br />
Tel: 880-2-9842778, 9849637<br />
Email: kwtdhaka@kumudini.org.bd<br /><br />

<!--
<form id="form" action="" method="post">
<table width="450px">
<tr>
 <td valign="top">
  <label for="first_name">First Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="first_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="last_name">Last Name *</label>
 </td>
 <td valign="top">
  <input  type="text" name="last_name" maxlength="50" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="email">Email Address *</label>
 </td>
 <td valign="top">
  <input  type="text" name="email" maxlength="80" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="telephone">Telephone Number</label>
 </td>
 <td valign="top">
  <input  type="text" name="telephone" maxlength="30" size="30">
 </td>
</tr>
<tr>
 <td valign="top">
  <label for="comments">Comments *</label>
 </td>
 <td valign="top">
  <textarea  name="comments" maxlength="1000" cols="25" rows="6"></textarea>
 </td>
</tr>
<tr>
 <td colspan="2" style="text-align:center">
  <input type="submit" value="Submit">   <a href="http://www.freecontactform.com/email_form.php">Email Form</a>
 </td>
</tr>
</table>
</form>
-->
<form id="form" action="" method="post">
	<table width="450px">
		<tr>
			 <td valign="top">
			  <label for='name' style="color:#003eff">Name<span class='required'>(required)</span></label>
			 </td>
			 <td valign="top">
			  <input type='text' name='name' required />
			 </td>
		</tr>
		
		<tr>
			 <td valign="top">
			  <label for='email' style="color:#003eff">Email <span class='required'>(required)</span></label>
			 </td>
			 <td valign="top">
			  <input type='email' name='email' required />
			 </td>
		</tr>
		
		<tr>
			 <td valign="top">
			  <label for='message' style="color:#003eff">Message <span class='required'>(required)</span></label>
			 </td>
			 <td valign="top">
			  <textarea name='message' required></textarea>
			 </td>
		</tr>
		
		<tr>
			<td colspan="2" style="text-align:center">
			<input type="submit" value="Send" id="submit" name="submit" class="submit_btn float_l" style="color:#003eff" />
			</td>
		</tr>
	
	</table>

</form>

</div>
</div>
</div>

<div id="footer_bg"></div>
</div>
<div id="footer">
<?php include('footer.php');?>
</div>
</div>

</body>
</html>