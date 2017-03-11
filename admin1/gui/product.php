<?php
	$oCommon=new CCommon();
	$ID=FALSE;
	if(isset($_GET['ID']))
	{
		$ID= base64_decode($_GET['ID']);
	}

	if (isset($_POST['btnSave']))
	{
		
		$allowed_filetypes = array('.jpg','.jpeg','.png','.gif','.JPG','.JPEG','.PNG','.GIF');
		$max_filesize = 10485760;
		$target = "../file1/"; 
		$target = $target . basename( $_FILES['photo']['name']);
		
		$pic =trim(addslashes($_POST['prephoto']));
		$picpre=$pic;
		if($_FILES['photo']['tmp_name']!='')
		{
			$pic =($_FILES['photo']['name']);
			$ext = substr($pic, strpos($pic,'.'), strlen($pic)-1);
			if (file_exists('../file1/'.$pic)) 
			{
				echo ("<script>window.alert('The file ". basename( $_FILES['photo']['name']). " already exists.');</script>");
			}
			
			if(!in_array($ext,$allowed_filetypes))
				die('The file you attempted to upload is not allowed.');
			@unlink('../file1/'.$picpre);
			move_uploaded_file($_FILES['photo']['tmp_name'], $target) ;
		}
		
		
		$allowed_filetypes = array('.pdf','.PDF');
		$max_filesize = 10485760;
		$target = "../file1/"; 
		$target = $target . basename( $_FILES['photo1']['name']);
		
		$pic1 =trim(addslashes($_POST['prephoto1']));
		$picpre=$pic1;
		if($_FILES['photo1']['tmp_name']!='')
		{
			$pic1 =($_FILES['photo1']['name']);
			$ext = substr($pic1, strpos($pic1,'.'), strlen($pic1)-1);
			if (file_exists('../file1/'.$pic)) 
			{
				echo ("<script>window.alert('The file ". basename( $_FILES['photo1']['name']). " already exists.');</script>");
			}
			
			if(!in_array($ext,$allowed_filetypes))
				die('The file you attempted to upload is not allowed.');
			@unlink('../file1/'.$picpre);
			move_uploaded_file($_FILES['photo1']['tmp_name'], $target) ;
		}
		
		$Name = trim(addslashes($_POST['Name']));
		$Generic_name = trim(addslashes($_POST['Generic_name']));
		$Dosage_Form = trim(addslashes($_POST['Dosage_Form']));
		$Therapeutic_Class = trim(addslashes($_POST['Therapeutic_Class']));
		$Strength = trim(addslashes($_POST['Strength']));
		$Mode = trim(addslashes($_POST['Mode']));
		$Indication = trim(addslashes($_POST['Indication']));
		$Dosage_Schedule = trim(addslashes($_POST['Dosage_Schedule']));
		$SortID = trim(addslashes($_POST['SortID']));
		$CreatedBy=$oSession->getUserName();
		$CreateDate=date('Y-m-d H:i:s');
		$UpdateBy=$oSession->getUserName();
		$UpdateDate=date('Y-m-d H:i:s');
		
	
		if($_POST['btnSave']=='Save')
		{
			$sql="INSERT INTO product (Name, Photo, Generic_name, Dosage_Form, Therapeutic_Class, Strength, Mode,
			Indication, Dosage_Schedule, PDF, SortID, CreatedBy, CreateDate) 
				  VALUES ('$Name','$pic', '$Generic_name', '$Dosage_Form', '$Therapeutic_Class', '$Strength', '$Mode',
				  '$Indication', '$Dosage_Schedule', '$pic1', '$SortID', '$CreatedBy', '$CreateDate')";
			$oResult=$oBasic->SqlQuery($sql);
			//print_r($oResult);
			
			echo "<script>alert('Insert Product Successfully');</script>";
			echo "<script>window.location='?Basic=Product'</script>";
		}
		
		elseif($_POST['btnSave']=='Update')
		{
			$sql="UPDATE product SET Name='$Name', Photo='$pic', Generic_name='$Generic_name', Dosage_Form='$Dosage_Form',
			Therapeutic_Class='$Therapeutic_Class', Strength='$Strength', Mode='$Mode', Indication='$Indication', 
			Dosage_Schedule='$Dosage_Schedule', PDF='$pic1', SortID='$SortID', UpdateBy='$UpdateBy', UpdateDate='$UpdateDate'
			WHERE ID = '$ID'";
			$oResult=$oBasic->SqlQuery($sql);
			echo "<script>alert('Update Product Successfully');</script>";
			echo "<script>window.location='?Basic=Product'</script>";
		}
	}
	if(isset($_GET['Delete']))
	{
		$Delete=$_GET['Delete'];
		$sql="DELETE FROM product WHERE ID=$Delete";
		$oBasic->SqlQuery($sql);
		$oResult=$oBasic->SqlQuery($sql);
		if($oResult->IsSuccess)
		{
			echo ("<script>window.alert('Delete Successfully!!!');</script>");
			echo ("<script>window.location='?Basic=Product';</script>");
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
					window.location="?Basic=Product&Delete="+ID;
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Product(s)</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					<?php 
						$sql="SELECT * FROM product WHERE ID = $ID";
						$oResultUp=$oBasic->SqlQuery($sql);
					?>
					
					
					<form method="post" action="" enctype="multipart/form-data" id="registerform">
			<table>
			
				<tr>
					<td>Image Upload: </td>
					<td>:</td>
					<td><input type="file" name="photo" id="photo"></td>
					<td><input type="hidden" class="form-control" name="prephoto" id="prephoto" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Photo']:''); ?>"/></td>
				</tr>
			
				<tr>
				<div class="form-group">
					<td>Product Name: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="Name" id="Name" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Name']:''); ?>" /></td>
				</div>
					</tr>
					
				<tr>
					<td>Generic Name: </td>
					<td>:</td>
					<td>
						<select id="Generic_name" name="Generic_name" class="form-control" style="min-width:300px">
                                    <?php
									$sql="SELECT * FROM generic_name ORDER BY Name";
									$oCommon->ReadAllSelectedOption($sql,'Name','Name','','')
									?>
						</select>
					
					</td>
				</tr>
				
				<tr>
					<td>Dosage Form: </td>
					<td>:</td>
					<td>
						<select id="Dosage_Form" name="Dosage_Form" class="form-control" style="min-width:300px">
                                    <?php
									$sql="SELECT * FROM dosage_form ORDER BY Name";
									$oCommon->ReadAllSelectedOption($sql,'Name','Name','','')
									?>
						</select>
					
						
					</td>
				</tr>
				
				<tr>
					<td>Therapeutic Class: </td>
					<td>:</td>
					<td>
						<select id="Therapeutic_Class" name="Therapeutic_Class" class="form-control" style="min-width:300px">
                                    <?php
									$sql="SELECT * FROM therapeutic_class ORDER BY Name";
									$oCommon->ReadAllSelectedOption($sql,'Name','Name','ANTIBIOTICS','')
									?>
						</select>
					</td>
					
					<!--
					<td><input type="text" class="form-control" name="Therapeutic_Class" id="Therapeutic_Class" required="required" style="min-width:300px" value="<?php //echo ($ID?$oResultUp->row['Therapeutic_Class']:''); ?>" /></td>-->
				</tr>
				
				<tr>
					<td>Strength: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="Strength" id="Strength" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Strength']:''); ?>" /></td>
				</tr>
				
				<tr>
					<td>Mode of Action: </td>
					<td>:</td>
					<td><textarea type="text" class="form-control" name="Mode" id="Mode" style="width:50%;height:140px"><?php echo ($ID?$oResultUp->row['Mode']:''); ?></textarea></td>
				</tr>
				
				<tr>
					<td>Indication: </td>
					<td>:</td>
					<td><textarea type="text" class="form-control" name="Indication" id="Indication" style="width:50%;height:140px"><?php echo ($ID?$oResultUp->row['Indication']:''); ?></textarea></td>
				</tr>
				
				<tr>
					<td>Dosage Schedule: </td>
					<td>:</td>
					<td><textarea type="text" class="form-control" name="Dosage_Schedule" id="Dosage_Schedule" style="width:50%;height:140px"><?php echo ($ID?$oResultUp->row['Dosage_Schedule']:''); ?></textarea></td>
				</tr>
				
				<tr>
					<td>Order By: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="SortID" id="SortID" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['SortID']:''); ?>"/></td>
				</tr>
				
				<tr>
					<td>PDF Upload: </td>
					<td>:</td>
					<td><input type="file" name="photo1" id="photo1"></td>
					<td><input type="hidden" class="form-control" name="prephoto1" id="prephoto1" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['PDF']:''); ?>"/></td>
				</tr>
				
				
			</table>
			<input type="submit" value="<?php if($ID) echo "Update"; else echo "Save";?>" id="btnSave" name="btnSave"  style="margin-right:10px; background:#003eff" class="btn btn-success" onClick="return checkValid();"/>
			<input type="reset" value="Reset" id="reset" name="reset" style="background:#003eff" class="btn btn-success" onClick="?Basic=Apro"  />
		
		</form>
		<br>
		<p><b>ALL Product(s) List</b></p>
                    <div class="box-inner-right" style="overflow-y : scroll; height: 355px; min-height:398px; min-width:1050px; margin-right:0px; width:100%">	
            	<table width="100%" cellpadding="1" cellspacing="1" style="margin-top:10px">
                    <tr style="color:#000000;">
                        
						<td width="8%"><b>Image</b></td>
						<td width="10%"><b>Name</b></td>
						<?php //if($oSession->getUserName()=='admin')?>
						<?php if($oSession->getUserName()=="admin")?>
						<td width="10%" align="center"><b><?php echo $oSession->getUserName();?></b></td>
                        
                    </tr>
                    
                    <?php
                        $sql="SELECT * FROM product ORDER BY SortID";
                        $oResult=$oBasic->SqlQuery($sql);
                        $num=$oResult->num_rows;
                        if($num>0)
                        {
                            for($i=0;$i<$oResult->num_rows;$i++)
                            {
                                if(($i%2)==0)
                                    $bgcol="#FFFFFF";
                                else
                                    $bgcol="#00BFFF";
                    ?>
                    
                    <tr class="table_data">

						<td width="8%" valign="middle" bgcolor="<?php echo $bgcol;?>"><img src="../images/<?php echo $oResult->rows[$i]['Photo'];?>" class="teacher_img" style="height:50px; width:50px"/></td>
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['Name'];?></p></td>
						<td width="10%" bgcolor="<?php echo $bgcol;?>" align="center"><a href='<?php echo "?Basic=Product&ID=".base64_encode($oResult->rows[$i]['ID'])?>'><img width="20" height="20" border="0" src="img/edit_icon2.png"></a>  
							<a href="#" onClick="deletecheck('<?php echo $oResult->rows[$i]['ID']; ?>');"><img src="img/delete_icon.png" alt="Delete" width="20" height="20" border="0"></a>
						</td>
                    </tr>            

                    <?php
                        }
                    }
                    ?>			
                  </table>
                   
                   
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
<script>WeSeeTextArea()</script>

</body>
<