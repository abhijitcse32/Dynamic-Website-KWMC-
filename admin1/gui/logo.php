<?php
	$oBasic=new CBasic();
	$oResult=new CResult();

	if (isset($_POST['btnSave']))
	{ 
		$allowed_filetypes = array('.jpg','.jpeg','.png','.gif','.JPG','.JPEG','.PNG','.GIF');
		$max_filesize = 10485760;
		$target = "../images/"; 
		$target = $target . basename( $_FILES['photo']['name']);
		$pic =trim(addslashes($_POST['prephoto']));
		$picpre=$pic;
		if($_FILES['photo']['tmp_name']!='')
		{
			$pic =($_FILES['photo']['name']);
			$ext = substr($pic, strpos($pic,'.'), strlen($pic)-1);
			if (file_exists('../images/'.$pic)) 
			{
				echo ("<script>window.alert('The file ". basename( $_FILES['photo']['name']). " already exists.');</script>");
			}
			
			if(!in_array($ext,$allowed_filetypes))
				die('The file you attempted to upload is not allowed.');
			@unlink('../images/'.$picpre);
			move_uploaded_file($_FILES['photo']['tmp_name'], $target) ;
		}
		
		$sql="UPDATE logo SET Image='$pic' WHERE ID=1";
		$oResult=$oBasic->SqlQuery($sql);
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
					window.location="?Basic=Logo&Delete="+ID;
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> LOGO</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					<?php 
						$sql="SELECT * FROM logo WHERE ID=1";
						$oResultUp=$oBasic->SqlQuery($sql);
                    ?>
					
					<script language="javascript">
						function checkValid(){
							if(registerform.txtShortID.value == ""){
							window.alert("Please Enter Ordere no.");
							registerform.txtShortID.focus();
							return false;
							}
						}
					
					</script>
					
					
					 <form style="margin-bottom:40px;" method="post" action="?Basic=Logo" enctype="multipart/form-data" id="registerform">
                    
                    		<div class="form-group">
                            	<label>Logo:</label>
                                <input type="file" name="photo" id="photo">
                            	<input type="hidden" name="prephoto" id="prephoto" value="<?php echo $oResultUp->row['Image']; ?>" ><b>Uploading Image Size must be 958x128 px</b>
                            </div>
                            
                            <div class="form-group">
                            	<label style="font-weight:bold">&nbsp;</label>
                            	<input type="submit" value="Update" id="btnSave" name="btnSave" class="btn btn-success" onClick="return checkValid();" style="background:#003eff" />
                            </div>
                     </form>
					 
					 <?php 
						$sql="SELECT * FROM logo WHERE ID=1";
						$oResultUp=$oBasic->SqlQuery($sql);
                     ?>
					 <b>Your Update image is:</b><br>
					 <img src="../images/<?php echo $oResultUp->row['Image']; ?>" class="teacher_img" style="height:100% width:100%"/>

		
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