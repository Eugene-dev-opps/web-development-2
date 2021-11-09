<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Merge Details - <?php echo $siteTitle; ?></title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $siteUrl; ?>ionicons/css/ionicons.min.css" type="text/css" />
<script src="<?php echo $siteUrl; ?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript" src="../js/jquery-1.4.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function () {
	$("a[rel^='prettyPhoto']").prettyPhoto({
	theme: 'dark_rounded'
	});
	});
</script>
<link rel="stylesheet" href="../js/prettyPhoto.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-prettyPhoto.js"></script>

<link rel="stylesheet" href="<?php echo $siteUrl; ?>css/jquery.dataTables.min.css">
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
	//check merge status
	$checkStatus = mysqli_query($conn, "SELECT * FROM donations where donor_id='".$dnnUsers['id']."' order by date desc");
	$status = mysqli_fetch_array($checkStatus);
	
	//get merge details
	$getMerge = mysqli_query($conn, "SELECT * FROM merge where donor_uid = '".$dnnUsers['id']."' order by date desc");
	$getMerge2 = mysqli_fetch_array($getMerge);
	
	//get members
	$getMembers = mysqli_query($conn, "SELECT * FROM members where id='".$getMerge2["merged_uid"]."'");
	$getMembers2 = mysqli_fetch_array($getMembers);
	
	$getBank = mysqli_query($conn, "SELECT * FROM bank_accounts where uid='".$getMerge2["merged_uid"]."'");
	$getBank2 = mysqli_fetch_array($getBank);
?>
<div class="main">
    <div class="container">
    	<div class="row">
            <h2 style="float:left;">Merge Details</h2>
            <h2 style="float:right; text-transform: capitalize;">
            	<?php
					if($status["status"]=="merged") {
				?>
                	<span class="label label-success"><?php echo $status["status"]; ?></span>
                <?php
					}
					else if($status["status"]=="pending"){
				?>
                	<span class="label label-warning"><?php echo $status["status"]; ?></span>
                <?php
					}
					else if($status["status"]=="completed"){
					}
					else {
                ?>
                	<span class="label label-warning"><?php echo $status["status"]; ?></span>
                <?php
					}
				?>
            </h2>
        </div><!-- row -->

        	
<?php
	if($getMerge2["status"] == "approved" or $getMerge2["status"] == "") {
?>
	
<?php
	}
	else {
?>

<div class="row" style="padding-top:20px;">
        	<div class="alert alert-warning">
            	<i class="ion-android-alert" style="font-size:34px; vertical-align:bottom;"></i> Dear <strong><?php echo $dnnUsers["name"]; ?></strong>, kindly donate to the member whose details/info appears below only. You can contact the person before making the payment to avoid errors. You must make the payment before your time runs out!
            </div>
</div><!-- row -->

<div class="row" style="padding-top:20px; overflow:auto;">
	<div style="width: 320px; height:80px; overflow:auto; line-height: 15px; background: none repeat scroll 0 0 #DCE1E9;text-align:center;padding: 5px; margin:0 auto 0;">
        <div class="cd-tab">
            <div class="cd-intab">DAYS</div>
            <div class="cd-intab">HRS</div>
            <div class="cd-intab">MIN</div>
            <div class="cd-intab">SEC</div>
        </div>
        <div id=wrap_timer>
            <div id="timer" class="countdown"></div>
            <div id="sync"></div>
        </div>
	</div>
<!-- <input type="button" value="Reload Page" onClick="window.location.reload()"> -->
<?php
// request event time from mysql generate current time and calculate the diff
$event_time = $getMerge2["date"]  + (1 * 24 * 60 * 60);
$current_time = time();
$timeLeft = $event_time-$current_time;
?>
<script type="text/javascript">

//initiate the same vars as in php with the same values
var eventtime = <?php echo $event_time?>;
var timeLeft = <?php echo $timeLeft?>;

//ajax call to the server to get new current time
function get_time() {
    // 1. Instantiate XHR - Start
    var xhr;
	var newtime;
    if (window.XMLHttpRequest) 
        xhr = new XMLHttpRequest();
    else if (window.ActiveXObject) 
        xhr = new ActiveXObject("Msxml2.XMLHTTP");
    else 
        throw new Error("Your browser does not support Ajax. What a shame...");
    // 1. Instantiate XHR - End

    // 2. Handle Response from Server - Start
    xhr.onreadystatechange = function () {
        if (xhr.readyState < 4)
            document.getElementById('sync').style.display = "block";
        else if (xhr.readyState === 4) {
            if (xhr.status == 200 && xhr.status < 300) 
                document.getElementById('sync').style.display = "none";
				//ajax response is the new current time
				var newtime = xhr.responseText;
				//calc new diff and how many total seconds are left
				var timeLeft = eventtime - newtime;
        }
    }
    // 2. Handle Response from Server - End

    // 3. Specify your action, location and Send to the server - Start    
    xhr.open('POST', 'servertime.php');
    xhr.send(null);
    // 3. Specify your action, location and Send to the server - End
}

//pad digits with extra 0 if below 10
function pad(value) {
    if(value < 10) {
        return '0' + value;
    } else {
        return value;
    }
}

//countdown
var timer = setInterval(function() {
    timeLeft--;
	var hrs = 3600;
	var mins = 60;
	var sec = 1;

	/*only min and sec
    var minutesLeft = Math.floor(timeLeft / 60);
    var secondsLeft = timeLeft % 60;
	document.getElementById('timer').innerHTML = "00 : 00 : " + pad(minutesLeft) + " : " + pad(secondsLeft);
    console.log('Time left: '00 : 00 : ' + ':' + minLeft + ':' + secLeft);
	*/

	//hrs, min and sec
	var hrsLeft = Math.floor(timeLeft / hrs);
	var minLeft = Math.floor((timeLeft % hrs) / mins);
	var secLeft = Math.floor(timeLeft % mins);
	document.getElementById('timer').innerHTML = "00 : " + pad(hrsLeft) + " : " + pad(minLeft) + " : " + pad(secLeft);
	console.log('Time left: ' + pad(hrsLeft) + ':' + pad(minLeft) + ':' + pad(secLeft));
	

    if (timeLeft <= 0) {
		<?php
			$ender = "<font color='#FF0000'>LATE</font>";
		?>
        clearInterval(timer);
		clearInterval(mytime);
		document.getElementById('timer').innerHTML = "<?php echo $ender; ?>";
    }
}, 1000);


function synctime(){
var refresh=10000; // Refresh rate in milliseconds
mytime=setInterval('get_time();',refresh)
}

var sync = synctime();
</script>
</div><!-- row -->

<div class="row" style="padding-top:20px;">
        	<div class="col-md-6">
            	<div class="panel panel-primary">
                    <div class="panel-heading">
                    	<h3 class="panel-title">Contact Details</h3>
                    </div><!-- panel-heading -->
                    <div class="panel-body">
                        <table width="100%">
                        	<tr>
								<td>Name:</td>
								<td style="font-weight:bold; text-transform:capitalize;"><?php echo $getMembers2["name"]; ?></td>
                            </tr>
                            <tr>
								<td>Phone:</td>
								<td style="font-weight:bold;"><?php echo $getMembers2["phone"]; ?></td>
                            </tr>
                            <tr>
								<td>City:</td>
								<td style="font-weight:bold;"><?php echo $getMembers2["city"]; ?></td>
                            </tr>
                            <tr>
								<td>State:</td>
								<td style="font-weight:bold;"><?php echo $getMembers2["state"]; ?></td>
                            </tr>
                        </table>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-6 -->
            <div class="col-md-6">
            	 <div class="panel panel-danger">
                    <div class="panel-heading">
                    	<h3 class="panel-title">Bank Account Details</h3>
                    </div><!-- panel-heading -->
                    <div class="panel-body">
                        <table width="100%">
                        	<tr>
								<td>Account Name:</td>
								<td style="font-weight:bold; text-transform:capitalize;"><?php echo $getBank2["acc_name"]; ?></td>
                            </tr>
                            <tr>
								<td>Account Number:</td>
								<td style="font-weight:bold;"><?php echo $getBank2["acc_number"]; ?></td>
                            </tr>
                            <tr>
								<td>Account Type:</td>
								<td style="font-weight:bold;"><?php echo $getBank2["acc_type"]; ?></td>
                            </tr>
                            <tr>
								<td>Bank Name:</td>
								<td style="font-weight:bold;"><?php echo $getBank2["bank_name"]; ?></td>
                            </tr>
                        </table>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-md-6 -->
        </div><!-- row -->
<?php
	if($status["status"]=="merged"){
?>
<div class="row" style="padding-top:20px;">
	<h2 style="text-align:center;" align="center">Upload Payment Proof</h2>
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
<?php
	if(isset($_POST['add']))
	{
		$message = $_POST['message'];
		$date = time();
		
		$uploadDir = $siteUrl.'members/proof/'; 
		$fileName = $_FILES['image']['name'];
		$random_digit=rand(1,99999);
		$new_file_name=$random_digit.$fileName;
		
		if($message!="")
			{
				//moves upload file to folder "uploads"
				$uploadStatus = move_uploaded_file($_FILES["image"]["tmp_name"], "proof/".$new_file_name);
				if ($uploadStatus)
				{
					$filePath = $new_file_name;	
				}
				
				else {
					$filePath = "";
				}

				$submit_form = "UPDATE merge SET status = 'waiting for approval', proof = '".$filePath."', message = '".$message."', proof_date = '".$date."' where donor_uid = '".$dnnUsers['id']."'";
				if(mysqli_query($conn, $submit_form))
				{
//send email function

$to = $getMembers2["email"];
$getMergeName = $getMembers2["name"];
$getPayerName = $dnnUsers["name"];
$subject = "Congrats! A proof of Payment Has Been Uploaded!";
$message = "<html>
<head>
<title></title>
</head>
<body>
<table align='center' style='border:#CCC 1px solid; border-radius: 5px; overflow:hidden; width:750px; margin:0 auto 0; color: #666; line-height:25px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;'>
<tr>
<td style='padding:20px; background:#fff; width: auto;'>
<h2>Congrats! A proof of Payment Has Been Uploaded!</h2>
<p>
Dear $getMergeName,
<br><br>
$getPayerName just uploaded a payment proof. Kindly login to your portal to confirm/approve the payment proof.
<br><br>
Thanks,
<br>
$siteTitle Support.
</p>
</td>
</tr>
</table>
</body>
</html>";
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// More headers
$headers .= 'From: '.$siteTitle.'<'.$adminEmail.'>' . "\r\n";
$mail=mail($to,$subject,$message,$headers);
?>       
    <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Your proof has been uploaded successfully! Kindly hold on while you're being approved by <font style="text-transform:capitalize;"><?php echo $getMembers2["name"]; ?>!</font>
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
	}
?>
            	<form class="form" name="add" id="add" method="post" action="mergeStatus.php" enctype="multipart/form-data">
                	<table width="100%">
                        <tr>
                            <td><label>Upload Proof:</label></td>
                       	</tr>
                        <tr>
                            <td><input name="image" type="file" id="file" /></td>
                        </tr>
                        <tr>
                            <td><label>Message</label></td>
                        </tr>
                        <tr>
                        	<td><textarea name="message" id="message" required="required"></textarea></td>
                        </tr>
                    </table>
                    <input name="add" type="submit" id="add" value="Upload Proof" class="btn btn-primary" style="margin-top:20px;" />
           </form>
  				</div><!-- col-sm-6 -->
            <div class="col-sm-3"></div>
            </div><!-- row -->
<?php
	}
?>
<?php
	}
?>

<div class="row" style="padding-top:20px;">
    	<h3>Your Donation History</h3>    
<?php
	//get donations
	$result = mysqli_query($conn, "SELECT * FROM merge where donor_uid = '" .$dnnUsers["id"]. "' order by date desc");
?>
        	<form name="frmUser" method="post" action="">
<table id="stdcode" class="table table-striped table-bordered dataTable" cellspacing="0"  role="grid" aria-describedby="example_info" style="width: 100%; border-bottom: none;">
<thead>
    <tr align="left">
    	<th>S/N</th>
    	<th>Receiver's Name</th>
    	<th>Receiver's Phone</th>
    	<th>Amount</th>
        <th>Proof</th>
        <th>Message</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
</thead>

<tbody>
<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
	$donorDetails = mysqli_query($conn, "SELECT * FROM members where id = '" .$row['merged_uid']. "'");
	$donorDetails2 = mysqli_fetch_array($donorDetails);
	
	//packages
	$getPackage = mysqli_query($conn, "SELECT * FROM packages where id = '" .$row['package_id']. "'");
	$getPackage2 = mysqli_fetch_array($getPackage);
?>

<tr>
    	<td class="left" style="text-align:center;"><?php echo $i; ?></td>
    	<td class="left"><?php echo htmlentities($donorDetails2['name'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td class="left"><?php echo htmlentities($donorDetails2['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td style="font-weight:bold; text-align:center; font-size:24px;">&#8358;<?php echo htmlentities($getPackage2['amt_pay'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td style="text-align:center;">
        	<?php
				if($row["proof"]!="") {
			?>
            <a href="<?php echo $siteUrl; ?>members/proof/<?php echo htmlentities($row['proof'], ENT_QUOTES, 'UTF-8'); ?>" rel="prettyPhoto[gallery1]">
            	<img src="<?php echo $siteUrl; ?>members/proof/<?php echo htmlentities($row['proof'], ENT_QUOTES, 'UTF-8'); ?>" width="100px" />
                <br /><font style="font-size:14px; font-weight:bold;">View Proof</font>
            </a>
            <?php
				}
				else {
					echo "No Proof Uploaded";
				}
			?>
        </td>
        <td class="left"><?php echo htmlentities($row['message'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td class="left" style="text-transform:capitalize; padding:20px;">        
			<?php
                if($row["status"]=="approved") {
            ?>
                <span class="label label-success"><?php echo $row["status"]; ?></span>
            <?php
                }
                else if($row["status"]=="waiting for approval"){
            ?>
                <span class="label label-warning"><?php echo $row["status"]; ?></span>
            <?php
                }
                else {
            ?>
                <span class="label label-danger"><?php echo $row["status"]; ?></span>
            <?php
                }
            ?>
        </td>
        <td class="left"><?php echo date('d M, Y', $row['date']); ?></td>
    </tr>
<?php
$i++;
}
?>
</tbody>
</table>
</form>
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
</body>
</html>