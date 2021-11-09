<?php include("../config.php");
?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Mass Mail Members - <?php echo $siteTitle; ?></title>
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
	
?>

<div class="main">
    <div class="container">
        <div class="row" style="padding:10px 0px;">
            <h2 style="float:left; margin:0;">Admin Dashboard</h2>
            <h2 style="float:right; margin:0; color:#666; text-transform:capitalize;"><?php echo $dnnUsers["name"]; ?></h2>
        </div><!-- row -->
        <div class="row" style="padding:10px 0px;">
            <h3 style="margin:0; padding-bottom:10px; font-weight:bold; border-bottom:#ccc solid thin;">Mass Mail Members</h3>
        </div><!-- row -->
        <div class="row">
        	<div class="panel panel-primary">
                <div class="panel-heading">
                	<h3 class="panel-title">Send Mass Mail To All Members</h3>
                </div>
                <div class="panel-body">
<?php
if(isset($_POST['send']))
{
$subject = $_POST['subject'];
$message = $_POST['message'];
// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
// More headers
$headers .= 'From: '.$siteTitle.' <'.$adminEmail.'>' . "\r\n";

$result = mysqli_query($conn, "SELECT email FROM members");

if(mysqli_num_rows($result) > 0)
{
$count = 0;
while ($row = mysqli_fetch_array ($result))
{

$to = $row['email'];
mail($to, $subject, $message, $headers);
$count++;
}
?>
<div class="alert alert-success" role="alert">
<?php echo "$count Emails Sent. Done."; ?>
</div>
<?php
}
else
{
	?>
<div class="alert alert-success" role="alert">
    <?php echo "myResult=Email Submissions Failed."; ?>
</div>
<?php
}

}
?>

<form class="form" id="massmail" name="massmail" method="post" action="#" enctype="multipart/form-data">
<label>Subject</label>
<br />
<input type="text" id="subject" name="subject" />
<br />
<label>Message</label>
<br />
<textarea id="message" name="message" style="height:150px;"></textarea>
<br />
<input type="submit" id="send" name="send" value="Send Mail" class="btn btn-primary" onclick="return confirm('This cannot be undone! Are you sure you want to send?')" />
</form>
                </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- /.col-sm-4 -->
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