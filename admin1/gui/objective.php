<?php
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
		
		$HeadLine =trim(addslashes($_POST['txtHead']));
		$Message =trim(addslashes($_POST['txtMessage']));
		$sql="UPDATE home SET Message='$Message', HeadLine='$HeadLine', Photo='$pic' WHERE ID=2";
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
					window.location="?Basic=Details&Delete="+ID;
				}
			}
	</script>
	<script language="javascript" src="../tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
	<script language="javascript" src="../js/scripts.js"></script>

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
                <h2><i class="glyphicon glyphicon-info-sign"></i> KWMC Objective</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					<?php 
                            $sql="SELECT * FROM home WHERE ID=2";
                            $oResultUp=$oBasic->SqlQuery($sql);
                        ?>
                    	<form name="form1" method="post" action="" enctype="multipart/form-data" id="registerform">
                	<div class="form-group">
							<label>Photo:</label>
                            <input type="file" name="photo" id="photo">
                            <input type="hidden" name="prephoto" id="prephoto" value="<?php echo $oResultUp->row['Photo']; ?>">
					</div>
                    
                    
                    <div class="form-group">
							<label>Haed Line:</label><input type="text" id="txtHead" name="txtHead" class="form-control" style="width:300px" value="<?php echo $oResultUp->row['HeadLine']; ?>" />
					</div>
                    
                    
                    <div class="form-group">
							<label class="admin_text">Message:</label><textarea type="text" class="form-control" name="txtMessage" id="txtMessage" style="width:50%;height:140px"><?php echo $oResultUp->row['Message']; ?></textarea>
							
					</div>
                    
                    <div class="form-group">
                    <label style="font-weight:bold">&nbsp;</label>
							<input class="btn btn-success" type="submit" value="Update" id="btnSave" name="btnSave"  onClick="return checkValid();" style="background:#003eff"/>
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
<script>WeSeeTextArea()</script>
</body>