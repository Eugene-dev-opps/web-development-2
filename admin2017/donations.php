<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Members Donations - <?php echo $siteTitle; ?></title>
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

<?php

	//count members
	//$countMembers=mysqli_query($conn, "SELECT * FROM members > =0");


	$countMembers = mysqli_query($conn, "SELECT count(*) from members",0);
	
	//count completed donations
	//$countDonations=mysqli_query("SELECT * FROM donations where status='completed' > =0");


	$countDonations =mysqli_query ($conn,"SELECT count(*) from donations where status='completed'",0);
	
	//count bank accounts
	//$countBankAcc=mysqli_query($conn, "SELECT * FROM bank_accounts > =0");


	$countBankAcc = mysqli_query($conn, "SELECT count(*) from bank_accounts",0);
	
	//count deactivated members
	//$countMembersDeactivated=mysqli_query($conn, "SELECT * FROM members  where status='deactivated'> =0");


	$countMembersDeactivated = mysqli_query ($conn, "SELECT count(*) from members where status='deactivated'",0);
	
	//count packages
	//$countPackages=mysqli_query($conn, "SELECT * FROM packages > =0");

	$countPackages = mysqli_query ($conn, "SELECT count(*) from packages",0);
?>
<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Members Donations</h3>
        </div><!-- row -->
        <div class="row" style="padding-top:0;">
<script>
   $(function() {
        $('#rowsector').change(function(){
            $('.rows').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>

<?php
	//get donations
	$result = mysqli_query($conn, "SELECT * FROM donations order by date desc");
?>
        	<form name="frmUser" method="post" action="">
<table id="stdcode" class="table table-striped table-bordered dataTable" cellspacing="0"  role="grid" aria-describedby="example_info" style="width: 100%; border-bottom: none;">
<thead>
    <tr align="left">
    	<th>S/N</th>
        <th>Username</th>
    	<th>Name</th>
    	<th>Phone</th>
    	<th>Package</th>
        <th>Status</th>
        <th>Date</th>
    </tr>
</thead>

<tbody>
<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
	$donorDetails = mysqli_query($conn, "SELECT * FROM members where id = '".$row["donor_id"]."'");
	$donorDetails2 = mysqli_fetch_array($donorDetails);
	
	//packages
	$getPackage = mysqli_query($conn, "SELECT * FROM packages where id = '" .$row['package_id']. "'");
	$getPackage2 = mysqli_fetch_array($getPackage);
?>

<tr>
    	<td class="left" style="text-align:center;"><?php echo $i; ?></td>
        <td class="left"><?php echo htmlentities($donorDetails2['username'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td class="left"><?php echo htmlentities($donorDetails2['name'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td class="left"><?php echo htmlentities($donorDetails2['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
    	<td style="font-weight:bold; text-align:center; font-size:24px;"><?php echo htmlentities($getPackage2['name'], ENT_QUOTES, 'UTF-8'); ?> (&#8358;<?php echo htmlentities($getPackage2['amt_pay'], ENT_QUOTES, 'UTF-8'); ?>)</td>
        <td class="left" style="text-transform:capitalize; padding-top:20px; text-align:center;">
        
        <?php
			if($row["status"]=="completed") {
		?>
			<span class="label label-success"><?php echo $row["status"]; ?></span>
		<?php
			}
			else if($row["status"]=="pending"){
		?>
			<span class="label label-warning"><?php echo $row["status"]; ?></span>
         <?php
			}
			else if($row["status"]=="merged"){
		?>
			<span class="label label-primary"><?php echo $row["status"]; ?></span>
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
<script>
$(function(){
$('#stdcode2').DataTable();
});
</script>
</body>
</html>