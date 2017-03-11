<?php 
	include_once ('../bll/CConManager.php');
	include_once ('../bll/CBasic.php');
	include_once ('../library/Session.php');
	include_once ('../model/CResult.php');
	$oSession=new Session();
	$oConmanager=new CConManager;
	$oBasic=new CBasic;
	$oResult=new CResult;
	$flag = false;
	if (isset($_POST['btnLogin']))
	{ 
	    $username = $_POST['username'];
	    $password = md5($_POST['password']);
		$sql = "SELECT * FROM user WHERE username= '$username' AND password='$password'";
		$oResult=$oBasic->SqlQuery($sql);
		if($oResult->IsSuccess)
		{
			if($oResult->num_rows==1)
			{
				$_SESSION['SESS_USERNAME']=$oResult->row['username'];
				$_SESSION['SESS_PASSWORD']=$oResult->row['password'];
				$_SESSION['SESS_ID']=$oResult->row['id'];
				echo "<script>window.location='index.php'</script>";
				exit;
			}
			else
			{
				$flag = true;
			}
			
		}
		else
				echo "<script>window.location='index.php'</script>";	
	}//echo '---';exit;
?>    

<!DOCTYPE html>
<html lang="en">

	<head>
        <meta charset="UTF-8" />
        <!-- <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">  -->
        <title>Kumudini Women's Medical College</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <meta name="description" content="Abhijit Chanda" />
        <meta name="keywords" content="KWMC, Kumudini Women's Medical College, Abhijit Chanda" />
        <meta name="author" content="Abhijit Chanda" />
        <link rel="shortcut icon" href="../images/kumu_logo.jpg"> 
        <link rel="stylesheet" type="text/css" href="css/demo.css" />
        <link rel="stylesheet" type="text/css" href="css/style.css" />
		<link rel="stylesheet" type="text/css" href="css/animate-custom.css" />
    </head>
    <body>
        <div class="container">
            <!-- Codrops top bar -->
            
            
            <section>				
                <div id="container_demo" >
                    <!-- hidden anchor to stop jump http://www.css3create.com/Astuce-Empecher-le-scroll-avec-l-utilisation-de-target#wrap4  -->
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form" style="width:70%; height:60%; margin-top:10px; margin-left:10px">
						
							<form class="form-horizontal" name="form1" id="form1" action="" method="post" enctype="multipart/form-data" autocomplete="on"> 
								<center><img src="../images/kumu_logo.jpg" style="width:20%; height:10%"/></center>
                                <p style="text-align:center; font-size:25px">Kumudini Women's Medical College Admin Panel</p> 
                                <p> 
                                    <center><label for="username" class="uname">Your Username</label></center>
                                    <input id="username" name="username" required="required" type="text" placeholder="USERNAME"/>
                                </p>
                                <p> 
                                    <center><label for="password" class="youpasswd"> Your Password </label></center>
                                    <input id="password" name="password" required="required" type="password" placeholder="PASSWORD" /> 
                                </p>
								
								
								
								<?php
									if($flag){?>
									<div class="clearfix"></div>
									<script>
										function blinker() {
											$('.blink_me').fadeOut(500);
											$('.blink_me').fadeIn(500);
										}
										setInterval(blinker, 1000);
									</script>
									<span class="blink_me" style="color:red">INVALID USERNAME OR PASSWORD....</span>
								<?php }?>
                                
                                <p class="login button" style="text-align:center"> 
                                    <input type="submit" value="Login" id="btnLogin" name="btnLogin" /> 
								</p>
                                
                            </form>
                        </div>

                       <!-- <div id="register" class="animate form">
                            <form  action="mysuperscript.php" autocomplete="on"> 
                                <h1> Sign up </h1> 
                                <p> 
                                    <label for="usernamesignup" class="uname" data-icon="u">Your username</label>
                                    <input id="usernamesignup" name="usernamesignup" required="required" type="text" placeholder="mysuperusername690" />
                                </p>
                                <p> 
                                    <label for="emailsignup" class="youmail" data-icon="e" > Your email</label>
                                    <input id="emailsignup" name="emailsignup" required="required" type="email" placeholder="mysupermail@mail.com"/> 
                                </p>
                                <p> 
                                    <label for="passwordsignup" class="youpasswd" data-icon="p">Your password </label>
                                    <input id="passwordsignup" name="passwordsignup" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p> 
                                    <label for="passwordsignup_confirm" class="youpasswd" data-icon="p">Please confirm your password </label>
                                    <input id="passwordsignup_confirm" name="passwordsignup_confirm" required="required" type="password" placeholder="eg. X8df!90EO"/>
                                </p>
                                <p class="signin button"> 
									<input type="submit" value="Sign up"/> 
								</p>
                                <p class="change_link">  
									Already a member ?
									<a href="#tologin" class="to_register"> Go and log in </a>
								</p>
                            </form>
                        </div>-->
						
                    </div>
                </div>  
            </section>
        </div>
    </body>

</html>