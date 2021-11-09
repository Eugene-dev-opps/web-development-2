<?php include("../config.php");
	error_reporting(0);
?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Merge Members - <?php echo $siteTitle; ?></title>
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
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
		
		window.location.assign("mergeMembers.php?q="+str,true);

    }
}
</script>
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>
<?php
	$q = intval($_GET['q']);
	//get donations
	$getDonations = mysqli_fetch_array(mysqli_query($conn, 'select * from donations where package_id="'.$q.'"'));
?>

<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Merge Members</h3>
        </div><!-- row -->
        
        <?php
if(isset($_POST['add']))
{
	$package_id = $q;
	$donor_id = $_POST['donor_id'];
	$merge_uid = $_POST['merged_uid'];
	
	$checkPendingDonations = mysqli_query($conn, 'select * from donations where status="pending" and package_id="'.$package_id.'" and donor_id="'.$donor_id.'"');
	$pendingDonations = mysqli_fetch_array($checkPendingDonations);
	

	//merge selected members
	$merge = mysqli_query($conn, "INSERT INTO merge(donation_id,merged_uid,donor_uid,package_id,status,message,proof,date,proof_date) VALUE('".$pendingDonations["id"]."','".$merge_uid."','".$donor_id."','".$package_id."','in progress','','','".time()."','')");
	
	if($merge) {
		$updateDonStatus = mysqli_query($conn, "UPDATE donations SET status = 'merged' where id='".$pendingDonations["id"]."'");
		$updateMemMerge = mysqli_query($conn, "UPDATE members SET merge_s = 'yes' where id='".$donor_id."'");
		$getReceiversMerge = mysqli_fetch_array(mysqli_query($conn, "select * from members where id='".$merge_uid."'"));
		if($getReceiversMerge["receive_merge"]=='yes2') {
			$updateReceiversMerge = mysqli_query($conn, "UPDATE members SET receive_merge = 'yes1' where id='".$merge_uid."'");
		}
		else {
			$updateReceiversMerge = mysqli_query($conn, "UPDATE members SET receive_merge = 'no' where id='".$merge_uid."'");
		}
?>
	<div class="alert alert-success" role="alert">
        <strong>Success!</strong> Dear <?php echo $dnnUsers["name"]; ?>, you have sucessfully merged the two selected members together manually! An email notification has been sent to both members.
    </div>        
<?php
	}
	else {
		echo "error";
	}
	
}//end
?>
        
        <form class="form" action="mergeMembers.php?q=<?php echo $q; ?>" name="add" id="add" method="post">
            <div class="row" style="padding-top:0;">
                <div class="col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="ion-android-settings"></i> &nbsp; Account To Donate</h3>
                        </div>
                        <div class="panel-body">
                        	<label>Select Package:</label>
                            <select style="text-transform:capitalize;" name="package" id="package" onchange="showUser(this.value)">
								<?php       
                                    $cdquery="SELECT * FROM packages where status='active' and id!='".$q."'";
                                    $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
                                    
                                    while ($cdrow=mysqli_fetch_array($cdresult)) {
										$name=$cdrow["name"];
										$idS=$cdrow["id"];
										$amt_p=$cdrow["amt_pay"];
										echo "<option value='$idS'>$name (&#8358;$amt_p)</option>";
                                    }
                                ?>
                                <?php
                                      
                                    $cdquery="SELECT * FROM packages where id='".$q."'";
                                    $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
                                    
                                    while ($cdrow=mysqli_fetch_array($cdresult)) {
										$name=$cdrow["name"];
										$idS=$cdrow["id"];
										$amt_p=$cdrow["amt_pay"];
										echo "<option value='$name' selected='selected'>$name (&#8358;$amt_p)</option>";
                                    }
                                    
                                ?>
                            </select>
                            <label>Select Donor's Account:</label>
                            <select style="text-transform:capitalize;" name="donor_id" id="donor_id">
                                <?php       
                                $getCancelled = mysqli_query($conn, "select * from donations where status='pending'");   
                                while ($getCC= mysqli_fetch_array($getCancelled)){  
                                    $cdquery="SELECT * FROM members where package_id='".$q."' and to_donate='yes' and merge_s='no' and id='".$getCC["donor_id"]."' order by name asc";
                                    $cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
                                    
										while ($cdrow=mysqli_fetch_array($cdresult)) {
										$name=$cdrow["name"];
										$idS=$cdrow["id"];
										echo "<option value='$idS'>$name</option>";
                                    }
                                    }
                                ?>
                            </select>
                        </div><!-- panel-body -->
                    </div><!-- panel -->
                </div><!-- col-md-6 -->
                
                <div class="col-md-6">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title"><i class="ion-android-settings"></i> &nbsp; Account To Receive</h3>
                        </div>
                        <div class="panel-body">
                            <label>Select Receiver's Account:</label>
                            <select style="text-transform:capitalize;" name="merged_uid" id="merged_uid">
                                <?php   
		$cdquery="select * from members where (status='active' and to_receive='yes2' and package_id='".$q."' and (receive_merge = 'no' or receive_merge = 'yes1')) or (status='active' and to_receive='yes1' and package_id='".$q."' and (receive_merge = 'no' or receive_merge = 'yes1')) or (status='active' and role='admin') or (status='active' and m_merge='yes') order by name asc";
		$cdresult=mysqli_query($conn, $cdquery) or die ("Query to get data from firsttable failed: ".mysqli_error($conn));
	
	while ($cdrow=mysqli_fetch_array($cdresult)) {
		$name=$cdrow["name"];
		$idS=$cdrow["id"];
		$amt_don=$cdrow["package_id"];
		$getAmount = mysqli_fetch_array(mysqli_query($conn, "select * from packages where id='".$amt_don."'"));
		$amt_pay = $getAmount["amt_pay"];  
		echo "<option value='$idS'>$name (&#8358;$amt_pay)</option>";
	}
?>
                            </select>
                        </div><!-- panel-body -->
                    </div><!-- panel -->
                </div><!-- col-md-6 -->
            </div><!-- row -->
            <div class="row" style="padding-top:0;">
                <center>
                    <input type="submit" class="btn btn-lg btn-primary" name="add" value="Merge Selected" />
                </center>
            </div><!-- row -->
        </form>
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