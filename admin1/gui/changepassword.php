<?php
	include_once ('../library/Session.php');
	include_once ('../model/CResult.php');
	include_once('../bll/CBasic.php');
	include_once('../bll/CConManager.php');
	$oSession=new Session();
	$oResult=new CResult();
	$oConmanager=new CConManager;
	$oBasic=new CBasic();
	if(isset($_POST['btnSave']))
	{
		$OldPass=md5(trim($_POST['txtOldPass']));
		$NewPass=trim($_POST['Password']);
		$Confirm=trim($_POST['ConPassword']);
		$Pa=$oSession->getPassWord();
		
		if($OldPass!=$Pa)
		{
			echo "<script>alert('Your Old Password is Worng')</script>";
			echo "<script>window.location='?Basic=PSW';</script>";
		}
		else if($Confirm!=$NewPass)
		{
			echo "<script>alert('New Password and Confirm Password are not same')</script>";
			echo "<script>window.location='?Basic=PSW';</script>";
		}
		else
		{
			$UserName=$oSession->getUserName();
			$NewPass=md5($NewPass);
			$sql="UPDATE user SET Password='$NewPass' WHERE UserName='$UserName'";
			$oResult=$oBasic->SqlQuery($sql);
	
			if($oResult->IsSuccess)
			{
				$_SESSION['SESS_CICPASSWORD']=$NewPass;
				echo "<script>alert('Your Password Change Successfully')</script>";
				echo "<script>window.location='?Basic=PSW';</script>";
			}
			else
			{
				echo ("<script>window.alert(\"Error-".$oResult->message." ".$oResult->error."\");</script>");
			}
		}
	}
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
	<?php include('meta.php');?>
	<script>
			function deletecheck(ID)
			{
				if(confirm("Are you sure to delete?"))
				{
					window.location="?Basic=PSW&Delete="+ID;
				}
			}
		</script>

</head>

<body>
    <!-- topbar starts -->
    <div class="navbar navbar-default" role="navigation">

        <div class="navbar-inner" style="background:#003eff">
            <?php include('header.php');?>
        </div>
    </div>
    <!-- topbar ends -->
<div class="ch-container">
    <div class="row">
        
        <!-- left menu starts -->
        <div class="col-sm-2 col-lg-2">
            <div class="sidebar-nav">
                <div class="nav-canvas">
                    <div class="nav-sm nav nav-stacked">

                    </div>
                    <?php include('menu.php');?>
                    
                </div>
            </div>
        </div>
        <!--/span-->
        <!-- left menu ends -->

        <noscript>
            <div class="alert alert-block col-md-12">
                <h4 class="alert-heading">Warning!</h4>

                <p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a>
                    enabled to use this site.</p>
            </div>
        </noscript>

        <div id="content" class="col-lg-10 col-sm-10">
            <!-- content starts -->
            <div>
    
</div>
<div class=" row">
    


</div>

<div class="row">
    <div class="box col-md-12">
        <div class="box-inner">
            <div class="box-header well">
                <h2><i class="glyphicon glyphicon-info-sign"></i> Change Password</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					
               <form method="post" action="" enctype="multipart/form-data" id="registerform">
							
					<div class="form-group">
						<label>Old Password: </label>
						<input type="password" id="txtOldPass" name="txtOldPass" class="form-control" />
					</div> 

					<div class="form-group">
                       	<label>New Password: </label>
						<input type="password" id="Password" name="Password" class="form-control" />
					</div>

					<div class="form-group">
                       	<label>Confirm Password: </label>
						<input type="password" id="ConPassword" name="ConPassword" class="form-control" onkeyup="checkPass();"/>
					</div>	
							
                    
					<div class="form-group">
						<label style="font-weight:bold">&nbsp;</label>
						<input type="submit" value="Save" id="btnSave" name="btnSave"  style="margin-right:10px; background:#003eff" class="btn btn-success" onClick="return checkValid();"/>
                        <input type="reset" value="Clear" id="btnCancel" name="btnCancel" style="background:#003eff" class="btn btn-success" onClick="return Empty_field('form1','txtOldPass,Password,ConPassword','?Basic=PassChange')"  />
                    </div>
					
				</form>
				
			</div>
        </div>
    </div>
</div>



    <!-- content ends -->
    </div><!--/#content.col-md-0-->
</div><!--/fluid-row-->

   

    <hr>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">

        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">×</button>
                    <h3>Settings</h3>
                </div>
                <div class="modal-body">
                    <p>Here settings can be configured...</p>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn btn-default" data-dismiss="modal">Close</a>
                    <a href="#" class="btn btn-primary" data-dismiss="modal">Save changes</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="row">
        <?php include('footer.php');?>
    </footer>

</div>
<?php include('external.php');?>
</body>