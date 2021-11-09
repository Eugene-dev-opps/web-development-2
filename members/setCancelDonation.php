<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>

<?php
	$q = intval($_GET['q']);
	//set value to approved
	
	if(mysqli_query($conn, "UPDATE donations SET status = 'cancelled' where donor_id = '".$q."'")) {
		echo "Sucess";
	}
	else {
		echo "failed";
	}
	header("Location:myDonations.php");
?>