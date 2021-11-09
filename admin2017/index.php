

<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Admin Dashboard - <?php echo $siteTitle; ?></title>
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

<?php


	//$countMembers = mysqli_result(mysqli_query($conn, "SELECT count(*) from members"),0);
	$countMembers = mysqli_query($conn,"SELECT * FROM members ",0);


	//count completed donations
	$countDonations = mysqli_query( $conn,"SELECT * FROM donations where status='completed' ",0);


	// $countDonations = mysqli_result(mysqli_query($conn, "SELECT count(*) from donations where status='completed'"),0);
	
	//count bank accounts
	$countBankAcc= mysqli_query($conn,"SELECT * FROM bank_accounts ",0);



	//$countBankAcc = mysqli_result(mysqli_query($conn, "SELECT count(*) from bank_accounts"),0);
	
	//count deactivated members
	//$countMembersDeactivated = mysqli_query($conn,"SELECT * FROM members  where status='deactivated'",0);


	$countMembersDeactivated = mysqli_query($conn, "SELECT count(*) from members where status='blocked'",0);
	
	//count packages
	$countPackages =mysqli_query($conn,"SELECT * FROM packages ",0);


	//$countPackages = mysqli_result(mysqli_query($conn, "SELECT count(*) from packages"),0);
?>
<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
		<div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Site Overview</h3>
        </div><!-- row -->
        <div class="row" style="padding-top:20px; overflow:hidden;">
        	<div class="stats" style="background:#00a65a; color:#FFF; overflow:hidden;">
                <?php echo $countMembers; ?><br /><font style="font-size:22px; line-height:25px;">Registered Members</font>
            </div><!-- stats -->
            
            <div class="stats" style="background:#f39c12; color:#FFF; overflow:hidden;">
                <?php echo $countDonations; ?><br /><font style="font-size:22px; line-height:25px;">Total Completed Donations</font>
            </div><!-- stats -->
            
            <div class="stats" style="background:#0080C0; color:#FFF; overflow:hidden;">
                <?php echo $countBankAcc; ?><br /><font style="font-size:22px; line-height:25px;">Bank Accounts Submitted</font>
            </div><!-- stats -->
            
            <div class="stats" style="background:#dd4b39; color:#FFF; overflow:hidden;">
                <?php echo $countMembersDeactivated; ?><br /><font style="font-size:22px; line-height:25px;">Deactivated Members</font>
            </div><!-- stats -->
            
            <div class="stats" style="background:#00c0ef; color:#FFF; overflow:hidden;">
                <?php echo $countPackages; ?><br /><font style="font-size:22px; line-height:25px;">Total Donation Packages</font>
            </div><!-- stats -->
        </div><!-- row -->
    </div><!-- .container -->
</div><!-- .main -->
</body>
</html>