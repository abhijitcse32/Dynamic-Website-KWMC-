<?php
	$oCommon=new CCommon();
	$ID=FALSE;
	if(isset($_GET['ID']))
	{
		$ID= base64_decode($_GET['ID']);
	}

	if (isset($_POST['btnSave']))
	{
		$Name = trim(addslashes($_POST['Name']));
		$Heading = trim(addslashes($_POST['Heading']));
		$Company = trim(addslashes($_POST['Company']));
		$Address = trim(addslashes($_POST['Address']));
		$SortID = trim(addslashes($_POST['SortID']));
		$email = trim(addslashes($_POST['email']));
		$CreatedBy=$oSession->getUserName();
		$CreateDate=date('Y-m-d H:i:s');
		$UpdateBy=$oSession->getUserName();
		$UpdateDate=date('Y-m-d H:i:s');
		//$createdate = date('Y-M-d');
	
	
		if($_POST['btnSave']=='Save')
		{
			$sql="INSERT INTO depot (Name, Heading, Company, Address, SortID, email, CreatedBy, CreateDate) 
				  VALUES ('$Name', '$Heading', '$Company', '$Address', '$SortID', '$email', '$CreatedBy', '$CreateDate')";
			$oResult=$oBasic->SqlQuery($sql);
			//print_r($oResult);
			
			echo "<script>alert('Insert Depot Successfully');</script>";
			echo "<script>window.location='?Basic=AllDepot'</script>";
		}
		
		elseif($_POST['btnSave']=='Update')
		{
			$sql="UPDATE depot SET Name='$Name', Heading='$Heading', Company='$Company', Address='$Address'
				, SortID='$SortID', email='$email', UpdateBy='$UpdateBy', UpdateDate='$UpdateDate' WHERE ID = '$ID'";
			$oResult=$oBasic->SqlQuery($sql);
			echo "<script>alert('Update Perform Successfully');</script>";
			echo "<script>window.location='?Basic=AllDepot'</script>";
		}
	}
	if(isset($_GET['Delete']))
	{
		$Delete=$_GET['Delete'];
		$sql="DELETE FROM depot WHERE ID=$Delete";
		$oBasic->SqlQuery($sql);
		$oResult=$oBasic->SqlQuery($sql);
		if($oResult->IsSuccess)
		{
			echo ("<script>window.alert('Delete Successfully!!!');</script>");
			echo ("<script>window.location='?Basic=AllDepot';</script>");
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
					window.location="?Basic=AllDepot&Delete="+ID;
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> All Depot info</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					<?php 
						$sql="SELECT * FROM depot WHERE ID = $ID";
						$oResultUp=$oBasic->SqlQuery($sql);
					?>
					
					
					<form method="post" action="" enctype="multipart/form-data" id="registerform">
			<table>
				<tr>
				<div class="form-group">
					<td>Depot Name: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="Name" id="Name" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Name']:''); ?>" /></td>
				</div>
					</tr>
				
				<tr>
					<td>Heading: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="Heading" id="Heading" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Heading']:''); ?>"/></td>
				</tr>
				
				<tr>
					<td>Company: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="Company" id="Company" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Company']:''); ?>"  /></td>
				</tr>
				
				<tr>
					<td>Address: </td>
					<td>:</td>
					<td><input type="text" class="form-control" name="Address" id="Address" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['Address']:''); ?>" /></td>
				</tr>
				
				<tr>
					<td>Order By</td>
					<td>:</td>
					<td><input type="text" class="form-control" name="SortID" id="SortID" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['SortID']:''); ?>"/></td>
				</tr>
				
				<tr>
					<td>Email</td>
					<td>:</td>
					<td><input type="text" class="form-control" name="email" id="email" required="required" style="min-width:300px" value="<?php echo ($ID?$oResultUp->row['email']:''); ?>"/></td>
				</tr>
				
			</table>
			<input type="submit" value="<?php if($ID) echo "Update"; else echo "Save";?>" id="btnSave" name="btnSave"  style="margin-right:10px; background:#003eff" class="btn btn-success" onClick="return checkValid();"/>
			<input type="reset" value="Reset" id="reset" name="reset" style="background:#003eff" class="btn btn-success" onClick="?Basic=AllDepot"  />
		
		</form>
		<br>
		<p><b>ALL DEPOT LIST</b></p>
                    <div class="box-inner-right" style="overflow-y : scroll; height: 355px; min-height:398px; min-width:1050px; margin-right:0px; width:100%">	
            	<table width="100%" cellpadding="1" cellspacing="1" style="margin-top:10px">
                    <tr style="color:#000000;">
                        
						<td width="10%"><b>SL#</b></td>
						<td width="10%"><b>Name</b></td>
                        <td width="10%"><b>Heading</b></td>
						<td width="10%"><b>Company</b></td>
						<td width="10%"><b>Address</b></td>
                        <td width="10%"><b>Email</b></td>
						
						<?php if($oSession->getUserName()=='admin')?>
						<td width="10%" align="center"><b>Actions</b></td>
                    </tr>
                    
                    <?php
                        $sql="SELECT * FROM depot ORDER BY SortID"; //Data Query 
                        $oResult=$oBasic->SqlQuery($sql); //Paging  Create  
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
                        
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['SortID'];?></p></td>
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['Name'];?></p></td>
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['Heading'];?></p></td>
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['Company'];?></p></td>
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['Address'];?></p></td>
						<td width="10%" valign="middle" bgcolor="<?php echo $bgcol;?>"><p><?php echo $oResult->rows[$i]['email'];?></p></td>
						
						<td width="10%" bgcolor="<?php echo $bgcol;?>" align="center"><a href='<?php echo "?Basic=AllDepot&ID=".base64_encode($oResult->rows[$i]['ID'])?>'><img width="20" height="20" border="0" src="img/edit_icon2.png"></a>  
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


</body>
</html>