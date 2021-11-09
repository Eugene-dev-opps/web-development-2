<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Add Bank Account - <?php echo $siteTitle; ?></title>
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
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>
<div class="main">
    <div class="container">
        <h2>Add Bank Account</h2>
        <div class="row" style="padding-top:20px;">
        	<div class="col-sm-3">
            </div>
            <div class="col-sm-6">
                <div class="panel panel-success">
                    <div class="panel-heading">
                    	<h3 class="panel-title">Add Your Bank Account</h3>
                    </div><!-- panel-heading -->
                    <div class="panel-body">
                    
<?php
if(isset($_POST['add']))
{
$bank_name = $_POST['bank_name'];
$uid = $dnnUsers['id'];
$acc_name = $_POST['acc_name'];
$acc_number = $_POST['acc_number'];
$acc_type = $_POST['acc_type'];

if($acc_name!="")
	{
		$create_invoice = "INSERT INTO bank_accounts(uid,bank_name,acc_name,acc_number,acc_type,reg_date) VALUES ('$uid','$bank_name','$acc_name','$acc_number','$acc_type',curdate())";
		if(mysqli_query($conn, $create_invoice))
		{
?>       
    <div class="alert alert-success" role="alert">
        <strong>Success!</strong> Your Bank Account was added successfully!
        <br />
        <center>
        	<a href="bankAccount.php"><font style="color:#060; font-weight:bold"><i class="ion-arrow-left-c"></i> Click here</font></a>
        </center>
    </div>
<?php
}
else
{
	?>
    <div class="alert alert-danger" role="alert">
        <strong>Failed!</strong> An Error Occured!!
    </div>
<?php
}
	}
}
?>
<form class="login-form" action="addBank.php" name="add" id="add" method="post">
    <table width="100%">
        <tr>
            <td><label>Bank Name:</label></td>
            <td><input type="text" name="bank_name" id="bank_name"  /></td>
        </tr>
        <tr>
            <td><label>Account Name:</label></td>
            <td><input type="text" name="acc_name" id="acc_name" /></td>
        </tr>
        <tr>
            <td><label>Account Number:</label></td>
            <td><input type="text" name="acc_number" id="acc_number" /></td>
        </tr>
        <tr>
            <td><label>Account Type:</label></td>
            <td>
                <select name="acc_type" id="acc_type">
                    <option value="">Choose Option</option>
                    <option value="Savings Account">Savings Account</option>
                    <option value="Current Account">Current Account</option>
                    <option value="Others">Others</option>
                </select>
            </td>
        </tr>
    </table>
    <center>
        <input name="add" type="submit" id="add" value="Submit" class="btn btn-success" />
    </center>
</form>
                    </div><!-- panel-body -->
                </div><!-- panel -->
            </div><!-- col-sm-6 -->
            <div class="col-sm-3">
            </div>
		</div><!-- .row -->
    </div><!-- .container -->
</div><!-- .main -->
</body>
</html>