<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>My Profile - <?php echo $siteTitle; ?></title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $siteUrl; ?>ionicons/css/ionicons.min.css" type="text/css" />
<script src="<?php echo $siteUrl; ?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>bootstrap/js/bootstrap.min.js"></script>
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
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
		
		window.location.assign("donateAdd.php?q="+str,true);

    }
}
</script>
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>

<div class="main">
    <div class="container">
        <h2>My Profile</h2>

        <div class="row" style="padding-top:20px;">
             <div class="col-sm-3"></div>
             <div class="col-sm-6">
                <div class="panel panel-primary">
                <div class="panel-heading">
                	<h3 class="panel-title">Profile Information</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered">
                    <tbody>
                      <tr>
                        <td><strong>Name</strong></td>
                        <td><?php echo $dnnUsers['name']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Username</strong></td>
                        <td><?php echo $dnnUsers['username']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Email</strong></td>
                        <td><?php echo $dnnUsers['email']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Phone</strong></td>
                        <td><?php echo $dnnUsers['phone']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Location</strong></td>
                        <td><?php echo $dnnUsers['city']; ?>, <?php echo $dnnUsers['state']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Role</strong></td>
                        <td style="color:#F00; text-transform:capitalize;"><?php echo $dnnUsers['role']; ?></td>
                      </tr>
                      <tr>
                        <td><strong>Date of Reg.</strong></td>
                        <td><?php echo date('d/M/Y',$dnnUsers['reg_date']); ?></td>
                      </tr>
                    </tbody>
                    </table>
                    
                    <center>
                        <a href="<?php echo $siteUrl; ?>members/profileEdit.php">
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
</body>
</html>