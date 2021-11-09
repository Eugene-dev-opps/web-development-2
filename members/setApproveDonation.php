<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>

<?php
	$q = intval($_GET['q']);
	//set value to approved
	
	if(mysqli_query($conn, "UPDATE merge SET status = 'approved' where id = '".$q."'")) {
		//send mail function
		$mergeInfo = mysqli_query($conn, 'select * from merge where id="'.$q.'"');
		$mergeInfo2 = mysqli_fetch_array($mergeInfo);
		
		$getUser = mysqli_query($conn, 'select * from members where id="'.$mergeInfo2["donor_uid"].'"');
		$getUser2 = mysqli_fetch_array($getUser);
		
		//update to_receive in members table
		$updateToReceive = mysqli_query($conn, "UPDATE members SET to_receive = 'yes2' where id = '".$mergeInfo2["donor_uid"]."'");
		
		//update to_receive in members table
		$updateMergeStatus = mysqli_query($conn, "UPDATE members SET merge_s = 'no' where id = '".$mergeInfo2["donor_uid"]."'");
		
		//set status as complete in donations table
		//check merge status
		$checkDonationStatus = mysqli_query($conn, "SELECT * FROM donations where id='".$mergeInfo2['donation_id']."'");
		$donationStatus = mysqli_fetch_array($checkDonationStatus);
		
		$updateDonationsStatus = mysqli_query($conn, "UPDATE donations SET status = 'completed' where id = '".$mergeInfo2['donation_id']."'");
		$updateToDonate = mysqli_query($conn, "UPDATE members SET to_donate = 'no' where id = '".$mergeInfo2["donor_uid"]."'");
		
		//update receive_merge value in members
		$getReceiversMerge = mysqli_fetch_array(mysqli_query($conn, "select * from members where id='".$mergeInfo2["donor_uid"]."'"));
		if($getReceiversMerge["receive_merge"]=='no') {
			$updateReceiversMerge = mysqli_query($conn, "UPDATE members SET receive_merge = 'yes2' where id='".$merge_uid."'");
		}
		else {
			$updateReceiversMerge = mysqli_query($conn, "UPDATE members SET receive_merge = 'no' where id='".$merge_uid."'");
		}
		
		if($updateToReceive) {
			//get receivers details
			$receiver =  mysqli_query($conn, 'select * from members where id="'.$mergeInfo2["merged_uid"].'"');
			$receiver2 = mysqli_fetch_array($receiver);
			if($receiver2["to_receive"] == "yes2") {
				$updateReceiver = mysqli_query($conn, "UPDATE members SET to_receive = 'yes1' where id = '".$mergeInfo2["merged_uid"]."'");
			}
			else if ($receiver2["to_receive"] == "yes1") {
				$updateReceiver = mysqli_query($conn, "UPDATE members SET to_receive = 'no' where id = '".$mergeInfo2["merged_uid"]."'");
			}
			else {
				
			}
			
		$to = $getUser2["email"];
		$donorName = $getUser2["name"];
		$getApprName = $dnnUsers["name"];
		$subject = "Congrats! Your Proof Has Just Been Approved!";
		$message = "<html>
<head>
<title></title>
</head>
<body>
<table align='center' style='border:#CCC 1px solid; border-radius: 5px; overflow:hidden; width:750px; margin:0 auto 0; color: #666; line-height:25px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;'>
<tr>
<td style='padding:20px; background:#fff; width: auto;'>
<h2>Congrats! Your Proof Has Just Been Approved!</h2>
<p>
Dear $donorName,
<br><br>
<strong>$getApprName</strong> just approved your payment proof. Now you are a step ahead of getting paid back double of what you have donated. Kindly login to your dashboard for more details.
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
	}
	else {
		echo "failed";
	}
	header("Location:donations.php");
?>