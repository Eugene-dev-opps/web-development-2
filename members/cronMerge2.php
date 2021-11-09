<?php
	include("../config.php");
?>

<?php
	//cron job to automatically merge like members
	$checkPendingDonations = mysqli_query($conn,'select * from donations where status="pending" order by date asc');
?>

<table align="center">
<tbody>
<?php
$i=1;
while($pendingDonations = mysqli_fetch_array($checkPendingDonations)) {
?>
<tr>
    <td>
    	<?php echo $pendingDonations["id"]; ?>
        <?php
			if($pendingDonations["status"]=="pending") {
				$checkUserReceiving = mysqli_query($conn, 'select * from members where to_receive != "no" and package_id="'.$pendingDonations["package_id"].'" and merge_s="no" order by reg_date limit 1');
				//$userReceiving = mysql_fetch_array($checkUserReceiving);
				while($userReceiving = mysqli_fetch_array($checkUserReceiving)){
					if($userReceiving["to_receive"]=="yes2" or $userReceiving["to_receive"]=="yes1") {
						//insert into merge
						$query = mysqli_query($conn,"INSERT INTO merge(donation_id,merged_uid,donor_uid,package_id,status,message,proof,date,proof_date) VALUE('".$pendingDonations["id"]."','".$userReceiving["id"]."','".$pendingDonations["donor_id"]."','".$pendingDonations["package_id"]."','in progress','','','".time()."','')");
						
						if($query) {
							$updateDonStatus = mysqli_query($conn, "UPDATE donations SET status = 'merged' where id='".$pendingDonations["id"]."'");
							$updateMemMerge = mysqli_query($conn, "UPDATE members SET merge_s = 'yes' where id='".$pendingDonations["donor_id"]."'");
							
							$getReceiversMerge = mysqli_fetch_array(mysqli_query($conn, "select * from members where id='".$userReceiving["id"]."'"));
							if($getReceiversMerge["receive_merge"]=='yes2') {
								$updateReceiversMerge = mysqli_query($conn, "UPDATE members SET receive_merge = 'yes1' where id='".$userReceiving["id"]."'");
							}
							else {
								$updateReceiversMerge = mysqli_query($conn, "UPDATE members SET receive_merge = 'no' where id='".$userReceiving["id"]."'");
							}
		
							//mail function
	$getDonorEmail = mysqli_fetch_array(mysqli_query($conn, 'select * from members where id="'.$pendingDonations["donor_id"].'"'));
	$to = $getDonorEmail["email"];
	$accName = $getDonorEmail["name"];
    $subject = "Great News! You Have Been Merged";
    $content = "Dear <strong>$accName</strong>,
	<br /><br />
 You have merged to make a donation. kindly login to your portal to see who you've been merged to. <strong>NOTE:</strong> Donate only to the account that appears on your portal.
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
		$to = $userReceiving["email"];
		$accName = $userReceiving["name"];
		$subject = "Congrats! A Member Has Been Merged To Pay You";
		$content = "Dear $accName, a member has been merged to pay you. Kindly login for more info.<br/>
		Regards <br />";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		// More headers
		$headers .= 'From: '.$siteTitle.'<'.$adminEmail.'>' . "\r\n";
		$mail=mail($to,$subject,$content,$headers);
    }
						}
						else {
							echo $dn2;
						}
					}
					else {
						echo $userReceiving["to_receive"];
					}
				}//while
			}
			else {
				echo "Impossible!";
			}
		?>
    </td>
</tr>
<?php
$i++;
}
?>
</tbody>
</table>