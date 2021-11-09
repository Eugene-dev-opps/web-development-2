<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Member's Area - <?php echo $siteTitle; ?></title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="../ionicons/css/ionicons.min.css" type="text/css" />
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
	//check bank accounts
    $countBankAcc=mysqli_query($conn, "SELECT count(*) from bank_accounts where uid='".$dnnUsers['id']."'> =1");


	//$countBankAcc = mysqli_result (mysqli_query($conn, "SELECT count(*) from bank_accounts where uid='".$dnnUsers['id']."'"),0);
	//count completed donations made
    $countDonations=mysqli_query($conn, "SELECT count(*) from donations where donor_id='".$dnnUsers['id']."' and status='completed'> =1");


	//$countDonations = mysqli_result(mysqli_query($conn, "SELECT count(*) from donations where donor_id='".$dnnUsers['id']."' and status='completed'"),0);
	
	//count completed donations received
	$getMerged = mysqli_fetch_array(mysqli_query($conn, "SELECT * from merge where merged_uid='".$dnnUsers['id']."' and status='approved'"));
	
	//$countReceived = mysqli_result(mysqli_query($conn, "SELECT count(*) from donations where id='".$getMerged['donation_id']."' and status='completed'"),0);
    $countReceived=mysqli_query($conn, "SELECT count(*) from donations where id='".$getMerged['donation_id']."' and status='completed'> =1");

   
	//check merge status
	$checkStatus = mysqli_query($conn, "SELECT * FROM donations where donor_id='".$dnnUsers['id']."' order by id desc");
	$status = mysqli_fetch_array($checkStatus);
?>
<div class="main">
    <div class="container">
    	<div class="row" style="padding:20px 10px;">
            <h2 style="float:left;">Member's Dashboard</h2>
            <h2 style="float:right; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="margin-top:20px; padding:20px;">
            <div class="col-md-3">
            	<div class="members-tab">
                	<div class="padding">
                    	<h1>Bank Account Details</h1>
                        <h2>
							<?php
								if($countBankAcc >= 1) {
                        			echo "YES";
								}
								else {
									echo "No account added yet!";
								}
							?>
                        </h2>
                    </div><!-- padding -->
                    <a href="<?php echo $siteUrl; ?>../members/bankAccount.php">
                        <div class="link">
                            Manage Bank Account <i class="ion-arrow-right-c"></i>
                        </div><!-- link -->
                    </a>
                </div><!-- members-tab -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
            	<div class="members-tab" style="background:#00a65a;">
                	<div class="padding">
                        <h1>Donations Made</h1>
                        <h2><?php echo $countDonations; ?></h2>
                    </div><!-- padding -->
                    <a href="#donations">
                        <div class="link" style="background:#008d4d;">
                            Make Donation Now <i class="ion-arrow-right-c"></i>
                        </div><!-- link -->
                    </a>
                </div><!-- members-tab -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
            	<div class="members-tab" style="background:#f39c12;">
                	<div class="padding">
                        <h1>Received Donations</h1>
                        <h2><?php echo $countReceived; ?></h2>
                    </div><!-- padding -->
                    <a href="<?php echo $siteUrl; ?>../members/donations.php">
                        <div class="link" style="background:#cf850f;">
                            More Info <i class="ion-arrow-right-c"></i>
                        </div><!-- link -->
                    </a>
                </div><!-- members-tab -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
            	<div class="members-tab" style="background:#dd4b39;">
                	<div class="padding">
                        <h1>Merge Status</h1>
                        <h2 style="font-weight:lighter; text-transform:capitalize;">
							<?php
								if($status["status"]=="completed") {
									echo "None";
								}
								else {
									echo $status["status"];
								}
							?>
                        </h2>
                    </div><!-- padding -->
                    <a href="mergeStatus.php">
                        <div class="link" style="background:#c64333;">
                            Click Here <i class="ion-arrow-right-c"></i>
                        </div><!-- link -->
                    </a>
                </div><!-- members-tab -->
            </div><!-- col-md-3 -->
        </div><!-- .row -->
        
        <div class="row" style="padding-top:10px;">
        	<a name="donations"></a>
        	<h2 style="text-align:center; padding-bottom:20px;">Make Donations</h2>
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>Grade A</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;5,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;10,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=1">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>Grade B</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;10,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;20,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=2">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                	<div class="ribbon-wrapper-green"><div class="ribbon-green">POPULAR</div></div>
                    <h3>Grade C</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;20,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;40,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=3">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>Grade D</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;50,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;100,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=4">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>Grade F</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;100,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;200,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=5">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>Grade G</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;200,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;400,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=6">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                	<div class="ribbon-wrapper-green"><div class="ribbon-green">LATEST</div></div>
                    <h3>Grade H</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="<?php echo $siteUrl; ?>img/icon.png" />

                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;250,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;500,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="donateAdd.php?q=7">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
        </div><!-- row -->
    </div><!-- .container -->
</div><!-- .main -->
</body>
</html>