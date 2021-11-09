<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Bank Account - <?php echo $siteTitle; ?></title>
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
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>
<div class="main">
    <div class="container">
        <h2>Bank Account</h2>
        <div class="row" style="padding-top:20px;">
        	<div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                    	<h3 class="panel-title">Your Account Details</h3>
                    </div><!-- panel-heading -->
                    <div class="panel-body">
						<?php
                        	$result = mysqli_query($conn, "SELECT * FROM bank_accounts where uid='".$dnnUsers['id']."' order by id desc");
							$row = mysqli_fetch_array($result);
                        ?>
                        <table width="100%">
                        	<tr>
								<td>Bank Name:</td>
								<td style="font-weight:bold;">
									<?php
										if($row['bank_name']==""){
									?>
											<font color="#FF0000" style="font-weight:bold;">&nbsp; NIL</font>
									<?php
                                        }
										else {
                                    		echo htmlentities($row['bank_name'], ENT_QUOTES, 'UTF-8');
										}
									?>
                                </td>
                            </tr>
                            <tr>
								<td>Account Name:</td>
								<td style="font-weight:bold;">
									<?php
										if($row['acc_name']==""){
									?>
											<font color="#FF0000" style="font-weight:bold;">&nbsp; NIL</font>
									<?php
                                        }
										else {
                                    		echo htmlentities($row['acc_name'], ENT_QUOTES, 'UTF-8');
										}
									?>
                                </td>
                            </tr>
                            <tr>
								<td>Account Number:</td>
								<td style="font-weight:bold;">
									<?php
										if($row['acc_number']==""){
									?>
											<font color="#FF0000" style="font-weight:bold;">&nbsp; NIL</font>
									<?php
                                        }
										else {
                                    		echo htmlentities($row['acc_number'], ENT_QUOTES, 'UTF-8');
										}
									?>
                                </td>
                            </tr>
                            <tr>
								<td>Account Type:</td>
								<td style="font-weight:bold;">
									<?php
										if($row['acc_type']==""){
									?>
											<font color="#FF0000" style="font-weight:bold;">&nbsp; NIL</font>
									<?php
                                        }
										else {
                                    		echo htmlentities($row['acc_type'], ENT_QUOTES, 'UTF-8');
										}
									?>
                                </td>
                            </tr>
                        </table>
                        <br />
                        <?php
							if($row['id']!=""){
						?>
                        <center>
                            <a href="#">
                                <div class="btn btn-primary btn-lg">
                                	Update Account Details
                                </div>
                            </a>
                        </center>
                        <?php
							}
							else{
						?>
                        <center>
                        	<p style="color:#f00;">No Bank Account added yet! Please add your bank account.</p>
                            <a href="addBank.php">
                                <div class="btn btn-primary btn-lg">
                                	Add Bank Account
                                </div>
                            </a>
                        </center>
                        <?php
							}
						?>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
            </div>
		</div><!-- .row -->
    </div><!-- .container -->
</div><!-- .main -->
</body>
</html>