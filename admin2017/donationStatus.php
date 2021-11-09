<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Donations Status - <?php echo $siteTitle; ?></title>
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $siteUrl; ?>ionicons/css/ionicons.min.css" type="text/css" />
<script src="<?php echo $siteUrl; ?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>bootstrap/js/bootstrap.min.js"></script>

<script type="text/javascript">
	$(document).ready(function () {
	$("a[rel^='prettyPhoto']").prettyPhoto({
	theme: 'dark_rounded'
	});
	});
</script>
<link rel="stylesheet" href="../js/prettyPhoto.css" type="text/css" />
<script type="text/javascript" src="../js/jquery-prettyPhoto.js"></script>

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
<script language="javascript" src="actions.js" type="text/javascript"></script>
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>
<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Donations' Status</h3>
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
	$result = mysqli_query($conn, "SELECT * FROM merge order by date desc");
?>

<br />
<div class="row">
With Selected:
<button type="button" class="btn btn-success" onClick="approveTransact();">Approve Transaction</button>
<button type="button" class="btn btn-warning" onClick="cancelTransact();">Cancel Transaction</button>
<button type="button" class="btn btn-danger" onClick="cancelTransactBlock();">Cancel And Block Donor</button>
</div><!-- row -->

<br />
<form name="frmUser" method="post" action="">
<table id="stdcode" class="table table-striped table-bordered dataTable" cellspacing="0"  role="grid" aria-describedby="example_info" style="width: 100%; border-bottom: none;">
<thead>
    <tr align="left">
    	<th style="text-align:center; padding:20px;"><input type="checkbox" class="all"></th>
    	<th>S/N</th>
        <th>Donor's Name/Username</th>
    	<th>Receiver's Name/Username</th>
    	<th>Amount</th>
        <th>Proof</th>
        <th>Proof Message</th>
    	<th>Status</th>
        <th>Date</th>
    </tr>
</thead>

<tbody>
<?php
$i=1;
while($row = mysqli_fetch_array($result)) {
	$donorDetails = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM members where id='" .$row['donor_uid']. "' "));
	$recDetails = mysqli_fetch_array(mysqli_query($conn,"SELECT * FROM members where id='" .$row['merged_uid']. "'"));
	
	//packages
	$getPackage = mysqli_query($conn, "SELECT * FROM packages where id = '" .$row['package_id']. "'");
	$getPackage2 = mysqli_fetch_array($getPackage);
?>

<tr>
		<td style="text-align:center;"><input type="checkbox" name="users[]" value="<?php echo $row['id']; ?>" ></td>
    	<td class="left" style="text-align:center;"><?php echo $i; ?></td>
        <td class="left"><a href="profile.php?id=<?php echo htmlentities($donorDetails['id'], ENT_QUOTES, 'UTF-8'); ?>" target="new"><?php echo htmlentities($donorDetails['name'], ENT_QUOTES, 'UTF-8'); ?> (<?php echo htmlentities($donorDetails['username'], ENT_QUOTES, 'UTF-8'); ?>)</a></td>
    	<td class="left"><a href="profile.php?id=<?php echo htmlentities($recDetails['id'], ENT_QUOTES, 'UTF-8'); ?>" target="new"><?php echo htmlentities($recDetails['name'], ENT_QUOTES, 'UTF-8'); ?> (<?php echo htmlentities($recDetails['username'], ENT_QUOTES, 'UTF-8'); ?>)</a></td>
    	<td style="font-weight:bold; text-align:center; font-size:24px;">&#8358;<?php echo htmlentities($getPackage2['amt_pay'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td style="font-weight:bold; text-align:center; font-size:16px;">
        	<?php
				if($row["proof"]!="") {
			?>
            <a href="<?php echo $siteUrl; ?>members/proof/<?php echo htmlentities($row['proof'], ENT_QUOTES, 'UTF-8'); ?>" rel="prettyPhoto[gallery1]" target="new">
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
        <td class="left" style="text-transform:capitalize; padding-top:20px; text-align:center;">
        
        <?php
			if($row["status"]=="approved") {
		?>
			<span class="label label-success"><?php echo $row["status"]; ?></span>
		<?php
			}
			else if($row["status"]=="in progress"){
		?>
			<span class="label label-warning"><?php echo $row["status"]; ?></span>
		<?php
			}
			else if($row["status"]=="waiting for approval") {
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