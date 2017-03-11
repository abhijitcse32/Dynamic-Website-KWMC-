<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include('meta.php');?>
<style>
	/*buttons*/
.buttons-grid {margin:0 auto;width:100%;text-align:left;}

a.button {display:inline-block;margin:0 5px 19px 0;}
.button {
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	behavior:url(css/PIE.htc);
	-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.25);
	color:#fff!important;
	
	display:inline-block;
	font-weight:bold;
	overflow:visible;
	padding:5px 15px 6px;
	position:relative;
	text-decoration:none;
	text-shadow:0 -1px 1px rgba(0,0,0,0.25);
	width:auto;
	font-family: Arial, Helvetica, sans-serif;
	font-size: 15px;
}
		
.orange.button {
	text-decoration:none;
	text-align:center;
	border:solid 1px #f77d49;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#e54c26;
	background-image: -moz-linear-gradient(top, #f77d49 0%, #e54c26 100%);
	background-image: -webkit-linear-gradient(top, #f77d49 0%, #e54c26 100%);
	background-image: -o-linear-gradient(top, #f77d49 0%, #e54c26 100%);
	background-image: -ms-linear-gradient(top, #f77d49 0% ,#e54c26 100%);

 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e54c26', endColorstr='#e54c26',GradientType=0 ); 
	background-image: linear-gradient(top, #f77d49 0% ,#e54c26 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #c83008;
	filter: dropshadow(color=#f77d49, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;
	behavior:url(css/PIE.htc);

}
.orange.button:hover {
	border:1px solid #f77d49;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#e54c26;
	background-image: -moz-linear-gradient(top, #e54c26 0%, #e54c26 100%);
	background-image: -webkit-linear-gradient(top, #e54c26 0%, #e54c26 100%);
	background-image: -o-linear-gradient(top, #e54c26 0%, #e54c26 100%);
	background-image: -ms-linear-gradient(top, #e54c26 0%, #e54c26 100%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e54c26', endColorstr='#e54c26',GradientType=0 ); 
	background-image: linear-gradient(top, #e54c26 0%, #e54c26 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #c83008;
	filter: dropshadow(color=#f77d49, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}

.orange.button:active {
	border:1px solid #f77d49;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#e54c26;
	background-image: -moz-linear-gradient(top, #e54c26 0%, #e54c26 100%);
	background-image: -webkit-linear-gradient(top, #e54c26 0%, #e54c26 100%);
	background-image: -o-linear-gradient(top, #e54c26 0%, #e54c26 100%);
	background-image: -ms-linear-gradient(top, #e54c26 0%, #e54c26 100%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#e54c26', endColorstr='#e54c26',GradientType=0 ); 
	background-image: linear-gradient(top, #e54c26 0% ,#e54c26 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 3px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 3px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 3px #ffffff;
	text-shadow: 1px 1px 0px #548f07;
	filter: dropshadow(color=#548f07, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}
.blue.button {text-decoration:none;
	text-align:center;
	border:solid 1px #4985c5;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#003eff;
	background-image: -moz-linear-gradient(top, #003eff 0%, #1f64ae 100%);
	background-image: -webkit-linear-gradient(top, #003eff 0%, #1f64ae 100%);
	background-image: -o-linear-gradient(top, #003eff 0%, #1f64ae 100%);
	background-image: -ms-linear-gradient(top, #003eff 0% ,#1f64ae 100%);

 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#1f64ae', endColorstr='#1f64ae',GradientType=0 ); 
	background-image: linear-gradient(top, #3c9ad5 0% ,#1f64ae 100%);
	-webkit-box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 4px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #0d55a2;
	filter: dropshadow(color=#0d55a2, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;}

.blue.button:hover {border:solid 1px #4985c5;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background:#1f64ae;
	-webkit-box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 4px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #0d55a2;
	filter: dropshadow(color=#0d55a2, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	}
	
.blue.button:active {
	border:solid 1px #4985c5;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background:#1f64ae;
	-webkit-box-shadow:0px 0px 4px #bababa, inset 0px 0px 3px #ffffff;
	-moz-box-shadow: 0px 0px 4px #bababa,  inset 0px 0px 3px #ffffff;
	box-shadow:0px 0px 4px #bababa, inset 0px 0px 3px #ffffff;
	text-shadow: 1px 1px 0px #0d55a2;
	filter: dropshadow(color=#0d55a2, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}
	
.green.button {
	text-decoration:none;
	text-align:center;
	border:solid 1px #999999;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px 6px 0px 0px;
	
	background-image: linear-gradient(top, #95c62b 0% ,#6ca023 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #548f07;
	filter: dropshadow(color=#548f07, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;
	
	background: #b4ddb4; /* Old browsers */
background: -moz-linear-gradient(top, #b4ddb4 0%, #83c783 17%, #52b152 33%, #008a00 67%, #005700 83%, #002400 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b4ddb4), color-stop(17%,#83c783), color-stop(33%,#52b152), color-stop(67%,#008a00), color-stop(83%,#005700), color-stop(100%,#002400)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* IE10+ */
background: linear-gradient(to bottom, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */
}

.green1.button {
	text-decoration:none;
	text-align:center;
	border:solid 1px #035732;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#035732;
	background-image: -moz-linear-gradient(top, #95c62b 0%, #6ca023 100%);
	background-image: -webkit-linear-gradient(top, #95c62b 0%, #6ca023 100%);
	background-image: -o-linear-gradient(top, #95c62b 0%, #6ca023 100%);
	background-image: -ms-linear-gradient(top, #95c62b 0% ,#6ca023 100%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#6ca023', endColorstr='#6ca023',GradientType=0 ); 
	background-image: linear-gradient(top, #95c62b 0% ,#6ca023 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #548f07;
	filter: dropshadow(color=#548f07, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;
}


.green2.button {
	text-decoration:none;
	text-align:center;
	border:solid 1px #999999;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 0px 0px 6px 6px;
	
	background-image: linear-gradient(top, #95c62b 0% ,#6ca023 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #548f07;
	filter: dropshadow(color=#548f07, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;
	
	background: #b4ddb4; /* Old browsers */
background: -moz-linear-gradient(top, #b4ddb4 0%, #83c783 17%, #52b152 33%, #008a00 67%, #005700 83%, #002400 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#b4ddb4), color-stop(17%,#83c783), color-stop(33%,#52b152), color-stop(67%,#008a00), color-stop(83%,#005700), color-stop(100%,#002400)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* IE10+ */
background: linear-gradient(to bottom, #b4ddb4 0%,#83c783 17%,#52b152 33%,#008a00 67%,#005700 83%,#002400 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#b4ddb4', endColorstr='#002400',GradientType=0 ); /* IE6-9 */
}



.green.button:active {
	border:solid 1px #7da943;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#82b327;
	background-image: -moz-linear-gradient(top, #82b327 0%, #649a22 100%);
	background-image: -webkit-linear-gradient(top, #82b327 0%, #649a22 100%);
	background-image: -o-linear-gradient(top, #82b327 0%, #649a22 100%);
	background-image: -ms-linear-gradient(top, #82b327 0% ,#649a22 100%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#649a22', endColorstr='#649a22',GradientType=0 ); 
	background-image: linear-gradient(top, #82b327 0% ,#649a22 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 3px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 3px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 3px #ffffff;
	text-shadow: 1px 1px 0px #548f07;
	filter: dropshadow(color=#548f07, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}
.purple.button {text-decoration:none;
	text-align:center;
	border:solid 1px #9a76b8;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#b28fcf;
	background-image: -moz-linear-gradient(top, #b28fcf 0%, #662e91 100%);
	background-image: -webkit-linear-gradient(top, #b28fcf 0%, #662e91 100%);
	background-image: -o-linear-gradient(top, #b28fcf 0%, #662e91 100%);
	background-image: -ms-linear-gradient(top, #b28fcf 0% ,#662e91 100%);

 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#662e91', endColorstr='#662e91',GradientType=0 ); 
	background-image: linear-gradient(top, #b28fcf 0% ,#662e91 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #4a0480;
	filter: dropshadow(color=#4a0480, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;}

.purple.button:hover {
	border:solid 1px #9a76b8;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#915abf;
	background-image: -moz-linear-gradient(top, #915abf 0%, #662e91 100%);
	background-image: -webkit-linear-gradient(top, #915abf 0%, #662e91 100%);
	background-image: -o-linear-gradient(top, #915abf 0%, #662e91 100%);
	background-image: -ms-linear-gradient(top, #915abf 0% ,#662e91 100%);
 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#662e91', endColorstr='#662e91',GradientType=0 ); 
	background-image: linear-gradient(top, #915abf 0% ,#662e91 100%);
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 1px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 1px #ffffff;
	text-shadow: 1px 1px 0px #4a0480;
	filter: dropshadow(color=#4a0480, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}
 
 .purple.button:active {
	border:solid 1px #9a76b8;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background:#662e91;
	-webkit-box-shadow:0px 0px 2px #bababa, inset 0px 0px 3px #ffffff;
	-moz-box-shadow: 0px 0px 2px #bababa,  inset 0px 0px 3px #ffffff;
	box-shadow:0px 0px 2px #bababa, inset 0px 0px 3px #ffffff;
	text-shadow: 1px 1px 0px #4a0480;
	filter: dropshadow(color=#4a0480, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}
 
.yellow.button {
	text-decoration:none;
	text-align:center;
	border:solid 1px #d0b52f;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background-color:#e6cd50;
	background-image: -moz-linear-gradient(top, #e6cd50 0%, #d9bf3c 100%);
	background-image: -webkit-linear-gradient(top, #e6cd50 0%, #d9bf3c 100%);
	background-image: -o-linear-gradient(top, #e6cd50 0%, #d9bf3c 100%);
	background-image: -ms-linear-gradient(top, #e6cd50 0% ,#d9bf3c 100%);

 filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#d9bf3c', endColorstr='#d9bf3c',GradientType=0 ); 
	background-image: linear-gradient(top, #e6cd50 0% ,#d9bf3c 100%);
	-webkit-box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #d9bf3c;
	-moz-box-shadow: 0px 0px 4px #bababa,  inset 0px 0px 1px #d9bf3c;
	box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #d9bf3c;
	text-shadow: 1px 1px 0px #c5aa24;
	filter: dropshadow(color=#c5aa24, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
	display: inline-block;
}
	
.yellow.button:hover {
	border:solid 1px #d0b52f;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background:#d9bf3c;
	-webkit-box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #d9bf3c;
	-moz-box-shadow: 0px 0px 4px #bababa,  inset 0px 0px 1px #d9bf3c;
	box-shadow:0px 0px 4px #bababa, inset 0px 0px 1px #d9bf3c;
	text-shadow: 1px 1px 0px #c5aa24;
	filter: dropshadow(color=#c5aa24, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
 }
	
.yellow.button:active {
	border:solid 1px #d0b52f;
	-webkit-border-radius:6px;
	-moz-border-radius:6px;
	border-radius: 6px;
	background:#d9bf3c;
	-webkit-box-shadow:0px 0px 4px #bababa, inset 0px 0px 3px #ffffff;
	-moz-box-shadow: 0px 0px 4px #bababa,  inset 0px 0px 3px #ffffff;
	box-shadow:0px 0px 4px #bababa, inset 0px 0px 3px #ffffff;
	text-shadow: 1px 1px 0px #c5aa24;
	filter: dropshadow(color=#c5aa24, offx=1, offy=1);
	filter: dropshadow(enabled=false) !important;
}
	
.button:hover {background-color:#111;}

.xlarge.button {
	font-size:30px;
	color: #FFF;
	padding-top: 15px;
	padding-right: 32px;
	padding-bottom: 15px;
	padding-left: 70px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	margin-right: 10px;
}

.large.button {
	font-size:20px;
	color: #FFF;
	padding-top: 12px;
	padding-right: 32px;
	padding-bottom: 12px;
	padding-left: 32px;
	font-weight: bold;
	font-family: Arial, Helvetica, sans-serif;
	margin-right: 10px;
}

.medium.button {
	font-size:11px;
	padding-top: 8px;
	padding-right: 12%;
	padding-bottom: 8%;
	font-weight: bold;
	color: #FFF;
	font-family: Arial, Helvetica, sans-serif;
	margin-right: -10px;
	width:94%
}


.round.button {
	-webkit-border-radius:50px;
	-moz-border-radius:50px;
	border-radius: 50px;
	margin-right: 10px;
}

.round.button:hover {
	-webkit-border-radius:50px;
	-moz-border-radius:50px;
	border-radius: 50px;
}

.rectangle.button {
	-webkit-border-radius:0px;
	-moz-border-radius:0px;
	border-radius: 0px;
	margin-right: 10px;
}

.rectangle.button:hover {
	-webkit-border-radius:0px;
	-moz-border-radius:0px;
	border-radius: 0px;
}

.button:hover,.button:active {text-decoration:none;}

.topright{
	
}
</style>
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

   <div id="moddle_text">
   
     <h1>NURSING INSTITUTE</h1>
	
		
		<h2>Application form and Notice for B.Sc and Diploma Nursing</h2>
		<hr/>
		<div style="width:100%;">
			<div style="width:33%; float:left; text-align:right">
				<a href="file/convert-jpg-to-pdf.net_2015-11-02_07-27-43.pdf" style="width:50%"><h3 class="" style="width:50%"><span class="medium blue button" style="width:50%"><span>Application Form for Diploma Nursing & Midwifery Course</span></span></h3></a>
			</div>
			<div style="width:33%; float:left; text-align:right">
				<a href="file/30003.jpg" style="width:50%"><h3 class="" style="width:50%"><span class="medium blue button" style="width:50%"><span>Notice for Admission</span></span></h3></a>
			</div>
			<div style="width:33%; float:left; text-align:right">
				<a href="file/Application.pdf" style="width:50%"><h3 class="" style="width:50%"><span class="medium blue button" style="width:50%"><span>Application Form for B.Sc Nursing</span></span></h3></a>
			</div>
		</div>
		
		<br/><br/><br/><br/><br/><br/><br/><br/>
		<h2>Rules for Kumudini Nursing Institute and College</h2>
		<hr/>
		<div style="width:100%;">
			<div style="width:50%; float:left; text-align:right">
				<a href="file/Rules_Kumudini_Nursing_Institute.pdf" style="width:50%"><h3 class="" style="width:50%"><span class="medium blue button" style="width:50%"><span>Rules - Kumudini Nursing Institute</span></span></h3></a>
			</div>
			<div style="width:50%; float:left; text-align:right">
				<a href="file/Rules_Kumudini_Nursing_College.pdf" style="width:50%"><h3 class="" style="width:50%"><span class="medium blue button" style="width:50%"><span>Rules - Kumudini Nursing College</span></span></h3></a>
			</div>
		</div>
		
		
	
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