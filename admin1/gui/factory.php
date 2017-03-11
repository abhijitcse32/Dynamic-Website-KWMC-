<?php
	if (isset($_POST['btnSave']))
	{
		$HeadLine =trim(addslashes($_POST['HeadLine']));
		$Add1 =trim(addslashes($_POST['Add1']));
		$Add2 =trim(addslashes($_POST['Add2']));
		$Phone =trim(addslashes($_POST['Phone']));
		$Fax =trim(addslashes($_POST['Fax']));
		$Email =trim(addslashes($_POST['Email']));
		
		$sql="UPDATE contact SET HeadLine='$HeadLine', Add1='$Add1', Add2='$Add2', Phone='$Phone', Fax='$Fax', Email='$Email' WHERE ID=2";
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
					window.location="?Basic=COE&Delete="+ID;
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
                <h2><i class="glyphicon glyphicon-info-sign"></i> Factory</h2>

                <div class="box-icon">
                    
                    <a href="#" class="btn btn-minimize btn-round btn-default"><i
                            class="glyphicon glyphicon-chevron-up"></i></a>
                    
                </div>
            </div>
            <div class="box-content row">
                <div class="col-lg-7 col-md-12">
                    
					<?php 
                            $sql="SELECT * FROM contact WHERE ID=2";
                            $oResultUp=$oBasic->SqlQuery($sql);
                        ?>
                    	<form name="form1" method="post" action="" enctype="multipart/form-data" id="registerform">
                	
                    
					<table>
				<tr>
					<div class="form-group">
						<td>Haed Line: </td>
						<td>:</td>
						<td><input type="text" class="form-control" name="HeadLine" id="HeadLine" required="required" style="min-width:300px" value="<?php echo $oResultUp->row['HeadLine']; ?>"  /></td>
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<td>Address 1: </td>
						<td>:</td>
						<td><input type="text" class="form-control" name="Add1" id="Add1" required="required" style="min-width:300px" value="<?php echo $oResultUp->row['Add1']; ?>"  /></td>
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<td>Address 2: </td>
						<td>:</td>
						<td><input type="text" class="form-control" name="Add2" id="Add2" required="required" style="min-width:300px" value="<?php echo $oResultUp->row['Add2']; ?>"  /></td>
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<td>Phone: </td>
						<td>:</td>
						<td><input type="text" class="form-control" name="Phone" id="Phone" required="required" style="min-width:300px" value="<?php echo $oResultUp->row['Phone']; ?>"  /></td>
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<td>Fax: </td>
						<td>:</td>
						<td><input type="text" class="form-control" name="Fax" id="Fax" required="required" style="min-width:300px" value="<?php echo $oResultUp->row['Fax']; ?>"  /></td>
					</div>
				</tr>
				
				<tr>
					<div class="form-group">
						<td>Email: </td>
						<td>:</td>
						<td><input type="email" class="form-control" name="Email" id="Email" required="required" style="min-width:300px" value="<?php echo $oResultUp->row['Email']; ?>"  /></td>
					</div>
				</tr>
				
				
				
			</table>
					
					
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