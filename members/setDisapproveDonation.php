<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>

<?php
	$q = intval($_GET['q']);
	//set value to approved
	
	if(mysqli_query($conn, "UPDATE merge SET status = 'disapproved' where id = '".$q."'")) {
		//send mail function
		$mergeInfo = mysqli_query($conn, 'select * from merge where id="'.$q.'"');
		$mergeInfo2 = mysqli_fetch_array($mergeInfo);
		
		$getUser = mysqli_query($conn,'select * from members where id="'.$mergeInfo2["donor_id"].'"');
		$getUser2 = mysqli_fetch_array($getUser);
		
		$to = $getMembers2["email"];
		$donorName = $getUser2["name"];
		$getApprName = $dnnUsers["name"];
		$subject = "NOTICE! Your Proof Was Disapproved!";
		$message = "<html>
<head>
<title></title>
</head>
<body>
<table align='center' style='border:#CCC 1px solid; border-radius: 5px; overflow:hidden; width:750px; margin:0 auto 0; color: #666; line-height:25px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;'>
<tr>
<td style='float:left; padding:15px; background:#F9F9F9; width: 100%; border-bottom:#CCC 1px solid; margin-bottom:15px;'><a href='http://unitydonor.com'><img src='http://unitydonor.com/img/logo.png' height='50' /></a></td>
</tr>
<tr>
<td style='padding:20px; background:#fff; width: auto;'>
<h2>NOTICE! Your Proof Was Disapproved!</h2>
<p>
Dear $donorName,
<br><br>
<strong>$getApprName</strong> disapproved your payment proof. Kindly upload a valid proof or contact the customer support for help. Login to your dashboard for more details.
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
	}
	else {
		echo "failed";
	}
	header("Location:donations.php");
?>