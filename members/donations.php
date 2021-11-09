<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Donations Received - <?php echo $siteTitle; ?></title>
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $siteUrl; ?>ionicons/css/ionicons.min.css" type="text/css" />
<script src="<?php echo $siteUrl; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $siteUrl; ?>js/jquery-1.9.1.min.js"></script>

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

<script>
	$(function(){
       $('.all').click(function(){
          if($(this).is(':checked')) {
          	$("input[name='users[]']").prop('checked', true);
          } else {
          	$("input[name='users[]']").prop('checked', false);
          }
       });
	});
</script>
<script language="javascript" src="../js/users.js" type="text/javascript"></script>
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>

<div class="main">
    <div class="container">
        <h2>Donations Received</h2>
        <div class="row" style="padding-top:20px;">
<?php
	//get donations
	$result = mysqli_query($conn, "SELECT * FROM merge where merged_uid = '" .$dnnUsers["id"]. "' order by id desc");
?>
        	<form name="frmUser" method="post" action="">
<table id="stdcode" class="table table-striped table-bordered dataTable" cellspacing="0"  role="grid" aria-describedby="example_info" style="width: 100%; border-bottom: none;">
<thead>
    <tr align="left">
    	<th>S/N</th>
    	<th>Donor Name</th>
    	<th>Donor Phone</th>
    	<th>Amount</th>
        <th>Proof</th>
        <th>Message</th>
        <th>Status</th>
        <th>Date</th>
        <th>Approve</th>
        <th>Disapprove</th>
    </tr>
</thead>

<tbody>
<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
	$donorDetails = mysqli_query($conn, "SELECT * FROM members where id = '" .$row['donor_uid']. "'");
	$donorDetails2 = mysqli_fetch_array($donorDetails);
	
	//packages
	$getPackage = mysqli_query($conn,"SELECT * FROM packages where id = '" .$row['package_id']. "'");
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
            <a href="<?php echo $siteUrl; ?>../members/proof/<?php echo htmlentities($row['proof'], ENT_QUOTES, 'UTF-8'); ?>" rel="prettyPhoto[gallery1]">
            	<img src="<?php echo $siteUrl; ?>../members/proof/<?php echo htmlentities($row['proof'], ENT_QUOTES, 'UTF-8'); ?>" width="100px" />
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
        <td class="left" style="text-transform:capitalize;"><br />
        
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
        <td style="text-align:center; font-size:14px;">
        <?php
			if($row["status"]=="approved") {
		?>
        	<i class="ion-checkmark-circled" style="font-size:36px; color:#777;"></i><br />Approve
        <?php
			}
			else {
		?>
			<a href="setApproveDonation.php?q=<?php echo $row['id']; ?>" title="Approve"><i class="ion-checkmark-circled" style="font-size:36px; color:#060;"></i><br />Approve</a>
		<?php
			}
		?>
        </td>
        <td style="text-align:center; font-size:14px;">
        	<?php
			if($row["status"]=="approved") {
		?>
        	<i class="ion-android-cancel" style="font-size:36px; color:#777;"></i><br />Disapprove
        <?php
			}
			else {
		?>
			<a href="setDisapproveDonation.php?q=<?php echo $row['id']; ?>" title="Reject" onclick="disapproveDonation();"><i class="ion-android-cancel" style="font-size:36px; color:#F00;"></i><br />Disapprove</a>
		<?php
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
</form>

<!-- FORM TO SEND THE SELECTED OPTION. -->
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