<?php
	include("../config.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<?php
//get merge details
$getMerge = mysqli_query($conn, "SELECT * FROM merge where proof_date='' and status='in progress' order by date asc");
?>
<table align="center">
<thead>
    <tr>
    	<th>S/N</th>
    </tr>
</thead>

<tbody>
<?php
$i=1;
while($getMerge2 = mysqli_fetch_array($getMerge)) {
?>
<tr>
    <td>
    	<?php
			// request event time from mysql generate current time and calculate the diff
			$event_time = $getMerge2["date"]  + (1 * 24 * 60 * 60);
			$current_time = time();
			$timeLeft = $event_time-$current_time;
		?>
        <?php
			if($timeLeft <= 0) {
				$getMemId = mysqli_fetch_array(mysqli_query($conn, "select * from merge where date='".$getMerge2["date"]."'"));
				$update = mysqli_query($conn, "update members set status='blocked' where id='".$getMemId["donor_uid"]."'");
				
				//get receivers merge status
				$getReceiver = mysqli_fetch_array(mysqli_query($conn, "select * from members where id='".$getMerge2["merged_uid"]."'"));
				
				if($getReceiver["receive_merge"]=="yes1"){
					$updateReceiverMerge = mysqli_query($conn, "update members set receive_merge='yes2' where id='".$getMerge2["merged_uid"]."'");
				}
				else if($getReceiver["receive_merge"]=="no"){
					$updateReceiverMerge = mysqli_query($conn, "update members set receive_merge='yes1' where id='".$getMerge2["merged_uid"]."'");
				}
				
				if($update) {
					$deleteMerge = mysqli_query($conn, "DELETE FROM merge where id='".$getMerge2["id"]."'");
					$updateStatus = mysqli_query($conn, "update donations set status='pending' where id='".$getMerge2["donation_id"]."'");
				}
			}
		?>
        <div style="width: 320px; overflow:auto; background: none repeat scroll 0 0 #DCE1E9;text-align:center;padding: 35px; margin:0 auto 0;">
            <div id=wrap_timer>
                <div id="timer" class="countdown"><?php echo $timeLeft; ?></div>
            </div>
        </div>
	</td>
</tr>
<?php
$i++;
}
?>
</tbody>
</table>