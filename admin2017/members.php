<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Members - <?php echo $siteTitle; ?></title>
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
    $countMembers=mysqli_query($conn, "SELECT * FROM members > =0");

    
	//$countMembers =mysqli_query($conn, "SELECT count(*) from members",0);
	
	//count completed donations
    $countDonations =mysqli_query($conn, "SELECT * FROM donations where status='completed' > =0");


	//$countDonations = mysqli_query($conn, "SELECT count(*) from donations where status='completed'" ,0);
	
	//count bank accounts
    $countBankAcc =mysqli_query($conn, "SELECT * FROM bank_accounts > =0");


   
	//$countBankAcc = mysqli_query($conn, "SELECT count(*) from bank_accounts",0);
	
	//count deactivated members
    $countMembersDeactivated =mysqli_query($conn, "SELECT * FROM members where status='deactivated' > =0");

    
	//$countMembersDeactivated = mysqli_query($conn, "SELECT count(*) from members where status='deactivated'",0);
	
	//count packages
    $countPackages =mysqli_query($conn, "SELECT * FROM packages > =0");

    
	//$countPackages = mysqli_query($conn, "SELECT count(*) from packages",0);
?>
<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Manage Members</h3>
        </div><!-- row -->
        <div class="row" style="padding-top:0;">

<?php
$result2 = mysqli_query($conn, "SELECT * FROM members order by id desc");
?>

<div class="row">
<script>
   $(function() {
        $('#rowsector').change(function(){
            $('.rows').hide();
            $('#' + $(this).val()).show();
        });
    });
</script>


<br />
<div style="float:right;">
<label>Copy/Export Row:</label>
<Select id="rowsector" style="width:150px;" class="form">
	<option value="">Select Choice</option>
   <option value="email">Email</option>
   <option value="phone">Phone</option>
</Select>
</div>

<?php
$result = mysqli_query($conn, "SELECT * FROM members");	
?>
<div id="email" class="rows" style="display:none">
<?php
	$req = mysqli_query($conn, "select distinct email from members");
?>

<textarea style="width:100%; line-height:20px; font-size:14px;" rows="10" class="form">
<?php
while($dnn4 = mysqli_fetch_array($req))
{
echo $dnn4['email'];
?>

<?php
}
?>
</textarea>
<br /><br />
</div>

<div id="phone" class="rows" style="display:none">
<?php
	$req = mysqli_query($conn, "select distinct phone from members");
?>

<textarea style="width:100%;  line-height:20px; font-size:14px;" rows="10" class="form">
<?php
while($dnn4 = mysqli_fetch_array($req))
{
echo $dnn4['phone'];
?>

<?php
}
?>
</textarea>
<br /><br />
</div>
</div>

<script>
//setUserSubAdmin
function setReceiveAlways() {
if(confirm("Are you sure you want to continue?")) {
document.frmUser.action = "setReceiveAlways.php";
document.frmUser.submit();
}
}
</script>

<div class="row">
With Selected:
<button type="button" class="btn btn-primary" onClick="activateUser();">Activate</button>
<button type="button" class="btn btn-danger" onClick="blockUser();">Block</button>
<button type="button" class="btn btn-success" onClick="setUserAdmin();">Make Admin</button>
<button type="button" class="btn btn-success" onClick="setUserSubAdmin();">Make Sub Admin</button>
<button type="button" class="btn btn-warning" onClick="setUserUsr();">Make User</button>
<button type="button" class="btn btn-primary" onClick="setReceiveAlways();">Always Receive Donations (On/Off)</button>
</div><!-- row -->

<br />
<form name="frmUser" method="post" action="">
<table id="stdcode" class="table table-striped table-bordered dataTable" cellspacing="0"  role="grid" aria-describedby="example_info" style="width: 100%; border-bottom: none;">
<thead>
    <tr align="left">
    	<th style="text-align:center;"><input type="checkbox" class="all"></th>
    	<th>S/N</th>
        <th>Username</th>
        <th>Name</th>
        <th>Email</th>
        <th style="text-align:center;">Phone Number</th>
        <th style="text-align:center;">State</th>
        <th>Location</th>
        <th style="text-align:center;">Role</th>
        <th style="text-align:center;">Status</th>
        <th style="text-align:center;">Reg. Date</th>
        <th style="text-align:center;">Flagged</th>
    </tr>
</thead>

<tbody>
<?php
$i=1;
while($row2 = mysqli_fetch_array($result2)) {
?>

<tr>    
		<td style="text-align:center;"><input type="checkbox" name="users[]" value="<?php echo $row2['id']; ?>" ></td>
    	<td class="left" style="text-align:center;"><?php echo $i; ?></td>
        <td class="left"><a href="profile.php?id=<?php echo $row2['id']; ?>"><?php echo htmlentities($row2['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
        <td class="left"><a href="profile.php?id=<?php echo $row2['id']; ?>"><?php echo htmlentities($row2['name'], ENT_QUOTES, 'UTF-8'); ?></a></td>
        <td class="left"><?php echo htmlentities($row2['email'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td class="left" style="text-align:center;"><?php echo htmlentities($row2['phone'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td class="left" style="text-align:center; text-transform:capitalize;"><?php echo htmlentities($row2['state'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td class="left"><?php echo htmlentities($row2['city'], ENT_QUOTES, 'UTF-8'); ?></td>
        <td class="left" style="text-align:center; text-transform:capitalize;"><?php echo htmlentities($row2['role'], ENT_QUOTES, 'UTF-8'); ?></td>
        <?php if($row2['status']=="active"){ ?>
        <td class="left" style="text-transform:uppercase; color:#090; font-weight:bold; text-align:center;"><?php echo $row2['status']; ?></td>
        <?php } else {?>
        <td class="left" style="text-transform:uppercase; color:#F00; font-weight:bold; text-align:center;"><?php echo $row2['status']; ?></td>
        <?php } ?>
        <td class="left" style="text-align:center; text-transform:capitalize;"><?php echo date("d/M/Y",$row2['reg_date']); ?></td>
        
        <?php if($row2['m_merge']=="yes"){ ?>
        <td class="left" style="text-transform:uppercase; color:#090; font-weight:bold; text-align:center;"><img src="<?php echo $siteUrl; ?>img/star_2.png" width="40px" /></td>
        <?php } else {?>
        <td class="left" style="text-transform:uppercase; color:#F00; font-weight:bold; text-align:center;"><img src="<?php echo $siteUrl; ?>img/star_1.png" width="40px" /></td>
        <?php } ?>
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