<?php
include("../config.php");
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
	//merge details
	$getMerge = mysqli_fetch_array(mysqli_query($conn, "select * from merge where id = '".$_POST["users"][$i]."'"));
	if($getMerge) {
		//donation status
		$getDonations = mysqli_fetch_array(mysqli_query($conn, "select * from donations where id='".$getMerge["donation_id"]."'"));
		$updateStatus = mysqli_query($conn, "update donations set status='pending' where id='".$getMerge["donation_id"]."'");
		
		if($updateStatus){
			$updateDonorMergeS = mysqli_query($conn, "update members set merge_s='no' where id='".$getMerge["donor_uid"]."'");
			//$updateDonorMergeS = mysql_query("update members set merge_s='no' where id='".$getMerge["donor_uid"]."'");
			
			//get receivers merge status
			$getReceiver = mysqli_fetch_array(mysqli_query($conn, "select * from members where id='".$getMerge["merged_uid"]."'"));
			
			if($getReceiver["receive_merge"]=="yes1"){
				$updateReceiverMerge = mysqli_query($conn, "update members set receive_merge='yes2' where id='".$getMerge["merged_uid"]."'");
			}
			else if($getReceiver["receive_merge"]=="no"){
				$updateReceiverMerge = mysqli_query($conn, "update members set receive_merge='yes1' where id='".$getMerge["merged_uid"]."'");
			}			
			
			$deleteMerge = mysqli_query($conn, "DELETE FROM merge where id = '".$_POST["users"][$i]."'");
		}
	}
	else {
		echo "failed";
	}
}
header("Location:donationStatus.php");
?>