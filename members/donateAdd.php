<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Donate - <?php echo $siteTitle; ?></title>
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

<?php if (isset($_POST['q'])) {
	$q = intval($_GET['q']);
	//get all payment gateway details
	$getPackages = mysqli_query($conn, 'select * from packages where id="'.$q.'"');
	$packages = mysqli_fetch_array($getPackages);
}
?>

<div class="main">
    <div class="container">
        <h2><?php if (isset($_POST['packages'])) {
             echo $packages["name"]; 
        }
        ?> Donation <font color="#000000">(&#8358;<?php  if (isset($_POST['packages'])){ echo $packages["amt_pay"]; } ?>)</font></h2>
<?php
	//check merge status
	$checkStatus = mysqli_query($conn, "SELECT * FROM donations where donor_id='".$dnnUsers['id']."' order by date desc");
	$status = mysqli_fetch_array($checkStatus);
	
	//check bank accounts

    
	$countBankAcc = mysqli_query($conn, "SELECT count(*) from bank_accounts where uid='".$dnnUsers['id']."'",0);
    

	if($countBankAcc >= 1) {
	
	if($status["status"]=="pending" or $status["status"]=="merged") {
?>
	<div class="alert alert-danger" role="alert">
        <strong>Error!</strong> You cannot make a new donation until you have completed the previous donation. Kindly complete your last donation or contact support. <?php echo $checkUserPriv2["status"]; ?>
    </div>
<?php
	}
	else
	{
?>

<?php
if(isset($_POST['add']))
{
$donor_id = $dnnUsers['id'];
$package_id = $q;
$bank_id = $_POST['bank_id'];
$status = "pending";
$date = time();

//Check User Eligibility
$checkUserPriv = mysqli_query($conn, 'select * from donations where donor_id="'.$dnnUsers['id'].'" order by date desc');
$checkUserPriv2 = mysqli_fetch_array($checkUserPriv);

	if($donor_id!="" and $dnnUsers["to_receive"]=="no")
	{
		$create_invoice = "INSERT INTO donations(donor_id,package_id,bank_id,status,date) VALUES ('$donor_id','$package_id','$bank_id','$status','$date')";
		if(mysqli_query($conn, $create_invoice))
		{
			//update package_id on members table
				$updatePackageID = mysqli_query($conn, "UPDATE members SET package_id = '".$package_id."', to_donate = 'yes' where id='".$dnnUsers['id']."'");
				//mail function
	$to = $dnnUsers["email"];
	$accName = $dnnUsers["name"];
    $subject = "You Have Made a Donation";
    $content = "Dear <strong>$accName</strong>,
	<br /><br />
 You have successfully requested to make a donation, kindly hold on as you will be merged within the next 12 hours. <strong>NOTE:</strong> donate only to the account that appears on your portal.
 <br/>
 <br />

    Regards.
	<br />
	$siteTitle";
    // Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		// More headers
		$headers .= 'From: '.$siteTitle.'<'.$adminEmail.'>' . "\r\n";
		$mail=mail($to,$subject,$content,$headers);
    if($mail)   
    {
		$to = "$adminEmail";
		//$to = "haraprasad@lemonpeak,rohith@lemonpeak.com";
		$subject = "Donation Request Submitted";
		$content = "Dear Admin, a member has requested to make a donation. Kindly login for more info.<br/>
		Thanks <br />";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		// More headers
		$headers .= 'From: '.$siteTitle.'<'.$adminEmail.'>' . "\r\n";
		$mail=mail($to,$subject,$content,$headers);
    }
?>
	
   <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Kindly hold on or check back later as you will be merged within the next <strong>24 hours</strong>! Ensure you pay only to the person merged to you on this portal!
        <br />
        <center>
        	<a href="mergeStatus.php"><font style="color:#060; font-weight:bold"><i class="ion-arrow-left-c"></i> Click here to check your merge status</font></a>
        </center>
    </div>
<?php
}
else
{
	?>
    <div class="alert alert-danger" role="alert">
        <strong>Failed!</strong> An Error Occured!!
    </div>
<?php
}
	}
?> 
   
<?php
	} //end
?>

        <div class="row" style="padding-top:20px;">
            <form class="form" action="donateAdd.php?q=<?php echo $q; ?>" name="add" id="add" method="post">
                <div class="col-md-6">
                	<h3 style="font-weight:bold;">Donation Details</h3>
                    <hr style="border-top:1px solid #ccc;" />
                    <table width="100%">
                        <tr>
                            <td><label>Your Name:</label></td>
                      	</tr>
                        <tr>
                          <td><input type="text" name="member_name" id="member_name" readonly="readonly" value="<?php echo $dnnUsers["name"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Phone:</label></td>
                        </tr>
                        <tr>
                            <td><input type="text" name="member_phone" id="member_phone" readonly="readonly" value="<?php echo $dnnUsers["phone"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Email:</label></td>
                       	</tr>
                        <tr>
                            <td><input type="text" name="member_email" id="member_email" readonly="readonly" value="<?php echo $dnnUsers["email"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Donation Package</label></td>
                        </tr>
                        <tr>
                            <td>
                              <select style="text-transform:capitalize;" name="package" id="package" onchange="showUser(this.value)">
                                    <?php       
                                        $cdquery="SELECT * FROM packages where status='active' and id!='".$q."'";
                                        $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
                                        
                                        while ($cdrow=mysqli_fetch_array($cdresult)) {
                                        $name=$cdrow["name"];
                                        $idS=$cdrow["id"];
                                        $amt_p=$cdrow["amt_pay"];
                                        echo "<option value='$idS'>$name (&#8358;$amt_p)</option>";
                                        
                                        }
                                    ?>
                                    <?php       
                                        $cdquery="SELECT * FROM packages where id='".$q."'";
                                        $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
                                        
                                        while ($cdrow=mysqli_fetch_array($cdresult)) {
                                        $name=$cdrow["name"];
                                        $idS=$cdrow["id"];
                                        $amt_p=$cdrow["amt_pay"];
                                        echo "<option value='$name' selected='selected'>$name (&#8358;$amt_p)</option>";
                                        
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div><!-- col-md-6 -->
                
              	<div class="col-md-6">
                	<?php
						$getBank = mysqli_query($conn, 'select * from bank_accounts where uid="'.$dnnUsers['id'].'"');
						$bankInfo = mysqli_fetch_array($getBank);
					?>
                	<h3 style="font-weight:bold;">Bank Details</h3>
                    <hr style="border-top:1px solid #ccc;" />
                    <table width="100%">
                        <tr>
                            <td><label>Account Name:</label></td>
                       	</tr>
                        <tr>
                            <td>
                            <input type="text" name="member_name" id="member_name" readonly="readonly" value="<?php echo $bankInfo["acc_name"]; ?>" />
                            <input type="hidden" name="bank_id" id="bank_id" value="<?php echo $bankInfo["id"]; ?>" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>Account Number:</label></td>
                       	</tr>
                        <tr>
                            <td><input type="text" name="member_phone" id="member_phone" readonly="readonly" value="<?php echo $bankInfo["acc_number"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Account Type:</label></td>
                      	</tr>
                        <tr>
                            <td><input type="text" name="member_email" id="member_email" readonly="readonly" value="<?php echo $bankInfo["acc_type"]; ?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Bank Name:</label></td>
                      	</tr>
                        <tr>
                            <td><input type="text" name="member_email" id="member_email" readonly="readonly" value="<?php echo $bankInfo["bank_name"]; ?>" /></td>
                        </tr>
                    </table>
                </div><!-- col-md-6 -->
            <center>
                <input name="add" type="submit" id="add" value="Make Donation" class="btn btn-success" />
            </center>
            </form>
<?php
	}
	}
	else {
?>
	<div class="alert alert-warning" role="alert">
        <i class="ion-alert-circled" style="font-size:34px; vertical-align:bottom;"></i> <strong>Notice!</strong> You must add a bank account before you can make a donation! <a href="addBank.php">Click here</a> to continue.
    </div>
<?php
	}
?>
      </div><!-- row -->
    </div><!-- .container -->
</div><!-- .main -->
</body>
</html>