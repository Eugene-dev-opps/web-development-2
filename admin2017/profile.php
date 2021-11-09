<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<?php
	$id = intval($_GET['id']);
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Profile - <?php echo $siteTitle; ?></title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $siteUrl; ?>ionicons/css/ionicons.min.css" type="text/css" />
<script src="<?php echo $siteUrl; ?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
	$("a[rel^='prettyPhoto']").prettyPhoto({
	theme: 'dark_rounded'
	});
	});
</script>
<link rel="stylesheet" href="../js/prettyPhoto.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-prettyPhoto.js"></script>

<script type="text/javascript">
    function htmlbodyHeightUpdate(){
		var height3 = $( window ).height()
		var height1 = $('.nav').height()+50
		height2 = $('.main').height()
		if(height2 > height3){
			$('html').height(Math.max(height1,height3,height2)+10);
			$('body').height(Math.max(height1,height3,height2)+10);
		}
		else
		{
			$('html').height(Math.max(height1,height3,height2));
			$('body').height(Math.max(height1,height3,height2));
		}
		
	}
	$(document).ready(function () {
		htmlbodyHeightUpdate()
		$( window ).resize(function() {
			htmlbodyHeightUpdate()
		});
		$( window ).scroll(function() {
			height2 = $('.main').height()
  			htmlbodyHeightUpdate()
		});
	});
</script>

<script>
	$(function(){
       $('.all').click(function(){
          if($(this).is(':checked')) {
          	$("input[name='users[]']").prop('checked', true);
          } else {
          	$("input[name='users[]']").prop('checked', false);
          }
       });
	});
</script>
<script language="javascript" src="../js/users.js" type="text/javascript"></script>
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>
<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Member's Profile</h3>
        </div><!-- row -->
        <div class="row" style="padding-top:10px;">
			<div class="col-sm-3"></div>
             <div class="col-sm-6">
             <?php
			 	$getUserDetails = mysqli_fetch_array(mysqli_query($conn, "select * from members where id='".$id."'"));
			 ?>
                <div class="panel panel-primary">
                <div class="panel-heading">
                	<h3 class="panel-title">Profile Information</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td><strong>Name</strong></td>
                        <td><?php echo $getUserDetails['name']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Username</strong></td>
                        <td><?php echo $getUserDetails['username']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><?php echo $getUserDetails['email']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Phone</strong></td>
                        <td><?php echo $getUserDetails['phone']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Location</strong></td>
                        <td><?php echo $getUserDetails['city']; ?>, <?php echo $getUserDetails['state']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Role</strong></td>
                        <td style="color:#F00; text-transform:capitalize;"><?php echo $getUserDetails['role']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Status</strong></td>
                        <?php if($getUserDetails['status']=="active") { ?>
                        <td style="color:#0C0; text-transform:capitalize; font-weight:bold;"><?php echo $getUserDetails['status']; ?></td>
                        <?php } else {?>
                        <td style="color:#F00; text-transform:capitalize;"><?php echo $getUserDetails['status']; ?></td>
                        <?php }?>
                      </tr>
                      <tr>
                        <td><strong>Date of Reg.</strong></td>
                        <td><?php echo date('d/M/Y',$getUserDetails['reg_date']); ?></td>
                      </tr>
                    </tbody>
                    </table>
                    
                    <center>
                        <a href="profileEdit.php?id=<?php echo $getUserDetails['id']; ?>">
                            <div class="btn btn-primary btn-lg">
                               <i class="ion-android-settings"></i> &nbsp; Edit Profile
                            </div>
                        </a>
                    </center>
                </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- /.col-sm-6 -->
            <div class="col-sm-3"></div>
        </div><!-- row -->
    </div><!-- .container -->
</div><!-- .main -->


<script src="<?php echo $siteUrl; ?>js/jquery.dataTables.min.js"></script>
<script src="<?php echo $siteUrl; ?>js/dataTables.bootstrap.min.js"></script>

<script>
$(function(){
$('#stdcode').DataTable();
});
</script>
<script>
$(function(){
$('#stdcode2').DataTable();
});
</script>
</body>
</html>