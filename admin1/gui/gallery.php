<?php
	include_once ('../library/Session.php');
	include_once ('../model/CResult.php');
	include_once('../bll/CBasic.php');
	include_once('../bll/CConManager.php');
	$oSession=new Session();
	$oResult=new CResult();
	$oConmanager=new CConManager;
	$oBasic=new CBasic();
	if (isset($_POST['btnSave']))
	{
		$flag=true;
		if($_FILES['imageUpload']['tmp_name']!='')
		{
		$dest="../images/";
		$rp=array(" ","%20");
		$file=$_FILES['imageUpload']['name'];
		$file=str_replace($rp,"_",$file);
		$dest.= $file;
		$Image = $file;
		$TempFile= $_FILES['imageUpload']['tmp_name'];
		$FileSize= round(($_FILES['imageUpload']['size'])/1024,3);
		$Photosize=getimagesize($_FILES['imageUpload']['tmp_name']);
		$Photowidth=$Photosize[0];
		$Photoheight=$Photosize[1];
		$FileType= $_FILES['imageUpload']['type'];
	    //------------------ Check FILE TYPE ---------------------------------------
		if (($FileType!= "image/jpeg") && ($FileType!= "image/pjpeg") && ($FileType!= "image/jpg") && ($FileType!= "image/png") && ($FileType!= "image/gif")&&$flag)
		{
			echo ("<script>window.alert('Your File is in an incorrect format! Only JPG, GIF or PNG file format is allowed!!!');</script>");
			$flag=false;
		}
		//----------------- All OK, Then UPLOAD FILE --------------------------------;
		if($flag)
		{
			@unlink($preImage);
			move_uploaded_file($TempFile,$dest);
		}
	}
	
	
	$SortID=$_POST['txtShortID'];
	$CreateBy=$oSession->getUserName();
	$CreateDate=date('Y-m-d H:i:s');
	
	$sql="INSERT INTO gallery (Image,SortID,CreateBy,CreateDate) VALUES ('$Image','$SortID','$CreateBy','$CreateDate')";
	if($flag)
	{
		$oResult=$oBasic->SqlQuery($sql);
		if($oResult->IsSuccess)
		{
			echo ("<script>window.alert('New Image Upload Successfully!!!');</script>");
			echo ("<script>window.location='?Basic=Gallery';</script>");
		}
		else
		{
			echo ("<script>window.alert(\"Error-".$oResult->message." ".$oResult->error."\");</script>");
		}
	}
}
elseif(isset($_POST['btnUpdate']))
{
	$ID=$_POST['ID'];
	$SortID=$_POST['SortID'];
	//$HeadLine=$_POST['HeadLine'];
	for($i=0;$i<count($ID);$i++)
	{
		$CreateBy=$oSession->getUserName();
		$IDN=$ID[$i];
		$SortIDN=$SortID[$i];
		//$HeadLineN=$HeadLine[$i];
		$sql="UPDATE gallery SET SortID='$SortIDN' WHERE ID=$IDN";
		$oResult=$oBasic->SqlQuery($sql);
	}
	if($oResult->IsSuccess)
	{
		echo ("<script>window.alert('New Image Update Successfully!!!');</script>");
		echo ("<script>window.location='?Basic=Gallery';</script>");
	}
}

if(isset($_GET['Delete']))
{
	$Delete=base64_decode($_GET['Delete']);
	$sql="DELETE FROM gallery WHERE ID=$Delete";
	$oBasic->SqlQuery($sql);
	$oResult=$oBasic->SqlQuery($sql);
	if($oResult->IsSuccess)
	{
		echo ("<script>window.alert('New Image Delete Successfully!!!');</script>");
		echo ("<script>window.location='?Basic=Gallery';</script>");
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
					window.location="?Basic=Gallery&Delete="+ID;
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Gallery</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					<?php 
						$sql="SELECT * FROM gallery WHERE ID=1";
						$oResultUp=$oBasic->SqlQuery($sql);
                    ?>
					
					<script language="javascript">
						function checkValid()
						{
							if(registerform.imageUpload.value == "")
							{
							window.alert("Please Upload Image.");
							registerform.imageUpload.focus();
							return false;
							}
							
							if(registerform.txtShortID.value == "")
							{
							window.alert("Enter Order No.");
							registerform.txtShortID.focus();
							return false;
							}
						}
					
					</script>
               <form style="margin-bottom:40px;" method="post" action="?Basic=Gallery" enctype="multipart/form-data" id="registerform">
							<div class="form-group">
								<label class="admin_text" for="imageUpload">Image:</label>
                                <input type="file"  name="imageUpload" id="imageUpload" />
                             </div>
							
							<div class="form-group">
                                <label class="admin_text" for="txtShortID">Order No:</label>
                                <input type="text" class="form-control" name="txtShortID" id="txtShortID" value="" size="35" style="width:30%"/>
							</div>                            
							
                            <div class="form-group">
                                <label style="font-weight:bold">&nbsp;</label>
                                <input type="submit" name="btnSave" id="btnSave" value="Save" class="btn btn-success" onClick="return checkValid();" style="background:#003eff"/>
                            </div>
				</form>
				
				<div class="box-inner" style="width:900px">	
				<div class="box-header well" data-original-title="">
					<h2><i class="glyphicon glyphicon-edit"></i>Update Image</h2>
				</div>
                <form id="formupdate" action="" enctype="multipart/form-data" method="post">
                         <table cellspacing="2"  cellpadding="1" border="0" width="870px">
                         <tr>
                            <?php
                                 $sql="SELECT * FROM gallery ORDER BY SortID";
                                 $oResult=$oBasic->SqlQuery($sql);
                                 for($i=0;$i<$oResult->num_rows;$i++)
                                 { ?>
                                    <td align="center">
                                    
                                    <div class="form-group">
                                        <img src="../images/<?php echo $oResult->rows[$i]['Image'];?>" alt="<?php echo $i+1; ?>"  height="80px" width="150px"/> 
                                        <input type="hidden" id="ID[<?php echo $i?>]" name="ID[<?php echo $i?>]" value="<?php echo $oResult->rows[$i]['ID'];?>">
                                     </div>
                                    
                                    <div class="form-group">
                                    	<label style="font-weight:bold;">Order No.</label> <input type="text" id="SortID[<?php echo $i?>]" name="SortID[<?php echo $i?>]" class="form-control1" style="width:30px" value="<?php echo $oResult->rows[$i]['SortID'];?>" size="10">
                                     </div>
                                     
                             <!--        <div class="form-group">
										<label style="font-weight:bold;">HeadLine</label> <input type="text" id="HeadLine[<?php echo $i?>]" name="HeadLine[<?php echo $i?>]" class="form-control1" value="<?php echo $oResult->rows[$i]['HeadLine'];?>" size="35px">
                                    </div> -->
									<input type="button" value="Delete" id="btnDelete" name="btnDelete" align="middle"  class="btn btn-success" onClick="deletecheck('<?php echo base64_encode($oResult->rows[$i]['ID']);?>')" style="background:#003eff">
									</td>
									<?php
										if($i%3==2)
										{
											echo "</tr><tr>";
										}
									}
									?>
									</tr>
									<tr>
									<td colspan="3">
										<input type="submit" name="btnUpdate" id="btnSave"  value="Update" class="btn btn-success" style="background:#003eff" />
									</td>
									<tr>
							</table>
                         </form>
                
                
            </div>
			

		
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
        <p class="col-md-9 col-sm-9 col-xs-12 copyright">&copy; <a href="./" target="_blank">Kumudini Pharma Limited</a> 2012 - 2015</p>

       
    </footer>

</div><!--/.fluid-container-->

<!-- external javascript -->

<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- library for cookie management -->
<script src="js/jquery.cookie.js"></script>
<!-- calender plugin -->
<script src='bower_components/moment/min/moment.min.js'></script>
<script src='bower_components/fullcalendar/dist/fullcalendar.min.js'></script>
<!-- data table plugin -->
<script src='js/jquery.dataTables.min.js'></script>

<!-- select or dropdown enhancer -->
<script src="bower_components/chosen/chosen.jquery.min.js"></script>
<!-- plugin for gallery image view -->
<script src="bower_components/colorbox/jquery.colorbox-min.js"></script>
<!-- notification plugin -->
<script src="js/jquery.noty.js"></script>
<!-- library for making tables responsive -->
<script src="bower_components/responsive-tables/responsive-tables.js"></script>
<!-- tour plugin -->
<script src="bower_components/bootstrap-tour/build/js/bootstrap-tour.min.js"></script>
<!-- star rating plugin -->
<script src="js/jquery.raty.min.js"></script>
<!-- for iOS style toggle switch -->
<script src="js/jquery.iphone.toggle.js"></script>
<!-- autogrowing textarea plugin -->
<script src="js/jquery.autogrow-textarea.js"></script>
<!-- multiple file upload plugin -->
<script src="js/jquery.uploadify-3.1.min.js"></script>
<!-- history.js for cross-browser state change on ajax -->
<script src="js/jquery.history.js"></script>
<!-- application script for Charisma demo -->
<script src="js/charisma.js"></script>


</body>
<