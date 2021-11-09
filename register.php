<?php include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Register - <?php echo $siteTitle; ?></title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $siteUrl; ?>css/carousel.css" rel="stylesheet">
<link href="<?php echo $siteUrl; ?>bootstrap/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $siteUrl; ?>ionicons/css/ionicons.min.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo $siteUrl; ?>font-awesome/css/font-awesome.min.css" />
<script src="<?php echo $siteUrl; ?>js/jquery-1.9.1.min.js"></script>
<script src="<?php echo $siteUrl; ?>bootstrap/js/bootstrap.min.js"></script>
<script src="js/responsiveslides.min.js"></script>
<script>
    $(function () {
      $("#slider").responsiveSlides({
      	auto: true,
      	nav: true,
      	speed: 500,
        namespace: "callbacks",
        pager: true,
      });
    });
</script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-2X64QSE3WM"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2X64QSE3WM');
</script>
</head>

<body>
<?php include("includes/header.php"); ?>

<div class="main">
    <div class="container">
        <h1>REGISTER</h1>
        <div class="row">
        	<div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="register-form">
<?php

if(isset($_POST["ref"])){
	$ref = $_GET['ref'];
	//get all payment gateway details
	$getRef = mysqli_query($conn, 'select * from members where username="'.$ref.'"');
	$getRef2 = mysqli_fetch_array($getRef);
}
?>

<?php
//$dn2 = mysql_query('select id from members order by id desc limit 1');
//$id = $dn2+1;

if(isset($_POST['add']))
{
$username = $_POST['username'];
$password = $_POST['password'];
$name = $_POST['name'];
$email = $_POST['email'];
$state = $_POST['state'];
$city = $_POST['city'];
$role = "user";
$status = "active";
$reg_date = time();

$phone1 = mysqli_real_escape_string($conn, $_POST['phone']);
$ptn = "/^0/";  // Regex
$str = $phone1; //Your input, perhaps $_POST['textbox'] or whatever
$rpltxt = "234";  // Replacement string
$phone = preg_replace($ptn, $rpltxt, $str);

//We check if there is no other user using the same username
$dn = mysqli_num_rows(mysqli_query($conn,'select id from members where username="'.$username.'"'));
if($dn==0)
{
	//We check if the two passwords are identical
    if($_POST['password']==$_POST['passverif'])
    {
		//We check if the password has 6 or more characters
        if(strlen($_POST['password'])>=6)
        {
			//We check if the email form is valid
            if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
            {	
			//insert data into database
			$add = "INSERT INTO members(username, password, name, email, phone, state, city, role, status, reg_date) VALUES ('$username','$password','$name','$email','$phone','$state','$city','$role','$status','$reg_date')";
		if(mysqli_query($conn,$add))
			{
//referral activities
if($_POST['ref']){
	$ref = $_POST['ref'];
	$getWallet = mysqli_fetch_array(mysqli_query($conn,"select * from members where username='".$_POST['ref']."'"));
	$insertRef = mysqli_query($conn,"insert into referrals(uid,ref_id,date) values('".$id."','".$getWallet["id"]."','".time()."')");
	if($insertRef) {
		$creditWallet = mysqli_query($conn,"update members set wallet=wallet + 500 where username='".$_POST['ref']."'");	
	}
}
else {
	echo "";
}


	//mail function
	$to = "$email";
    $subject = "Welcome to $siteTitle";
    $content = " Hi <strong>$username</strong>,
	<br /><br />
 Welcome to $siteTitle, thanks for signing up with us! Our joy is your happiness, don't forget to contact the support team in case you need any help. <br />
<br />
 <h3>Your Login Details</h3>
 <br />
 Username: $username
 <br />
 Password: $password
 <br/>
 <br />

    Thanks for signing up.
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
		$to = "$adminEmail";
		//$to = "haraprasad@lemonpeak,rohith@lemonpeak.com";
		$subject = "New Member Registered on $siteTitle";
		$content = " $username,just signed up with us,<br /><br />
		Member's Details:<br/>Name:$name<br/>Email:$email<br/>
		Thanks <br />";
		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		// More headers
		$headers .= 'From: '.$siteTitle.'<'.$adminEmail.'>' . "\r\n";
		$mail=mail($to,$subject,$content,$headers);
    }
?>       
    <div class="alert alert-success" role="alert"><strong>Your Registration was Successful!</strong> A mail has been sent to <strong><?php echo $email; ?></strong></div>
<?php
	}
	else {
		?>
        <div class="alert alert-danger" role="alert"><strong>Failed!</strong> An error occured</div>
        <?php
	}//end $add..
			}
			else {
				 $message = 'The email you entered is not valid.';
			}//end
		}
		else {
			$message = 'Your password must contain at least 6 characters.';
		}// end password length
	}
	else {
		$message = 'The passwords you entered are not identical.';
	}//end check identical password
}
else {
		$message = 'The username you want to use is not available, please choose another one.';
	}//check username message
}

if(isset($message))
         {
        echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
    }
?>
                
<form action="register.php" method="post">
<h3>User Login Details</h3>
<hr style="border-top:3px #dbab18 solid; border-bottom:0; padding-bottom:-5px;" />
<label>Username:</label>
<input type="text" placeholder="Username" name="username" id="username" required="required" />
<label>Password:</label>
<input type="password" placeholder="Password" name="password" id="password" required="required" />
<label>Confirm Password:</label>
<input type="password" placeholder="Confirm Password" name="passverif" id="passverif" required="required" />
<label>Email:</label>
<input type="text" placeholder="Email" name="email" id="email" />
<h3>Personal Details</h3>
<hr style="border-top:3px #dbab18 solid; border-bottom:0; padding-bottom:-5px;" />
<label>Full Name:</label>
<input type="text" placeholder="Surname Firstname Middlename" name="name" id="name" required="required" />
<label>Phone:</label>
<input type="text" placeholder="Phone" name="phone" id="phone" required="required" />
<label>State:</label>
<select name="state" id="state">
<option selected="selected">- Select -</option>
<option value="Abuja FCT">Abuja FCT</option>
<option value="Abia">Abia</option>
<option value="Adamawa">Adamawa</option>
<option value="Akwa Ibom">Akwa Ibom</option>
<option value="Anambra">Anambra</option>
<option value="Bauchi">Bauchi</option>
<option value="Bayelsa">Bayelsa</option>
<option value="Benue">Benue</option>
<option value="Borno">Borno</option>
<option value="Cross River">Cross River</option>
<option value="Delta">Delta</option>
<option value="Ebonyi">Ebonyi</option>
<option value="Edo">Edo</option>
<option value="Ekiti">Ekiti</option>
<option value="Enugu">Enugu</option>
<option value="Gombe">Gombe</option>
<option value="Imo">Imo</option>
<option value="Jigawa">Jigawa</option>
<option value="Kaduna">Kaduna</option>
<option value="Kano">Kano</option>
<option value="Katsina">Katsina</option>
<option value="Kebbi">Kebbi</option>
<option value="Kogi">Kogi</option>
<option value="Kwara">Kwara</option>
<option value="Lagos">Lagos</option>
<option value="Nassarawa">Nassarawa</option>
<option value="Niger">Niger</option>
<option value="Ogun">Ogun</option>
<option value="Ondo">Ondo</option>
<option value="Osun">Osun</option>
<option value="Oyo">Oyo</option>
<option value="Plateau">Plateau</option>
<option value="Rivers">Rivers</option>
<option value="Sokoto">Sokoto</option>
<option value="Taraba">Taraba</option>
<option value="Yobe">Yobe</option>
<option value="Zamfara">Zamfara</option>
<option value="Outside Nigeria">Outside Nigeria</option>
</select>
<label>City:</label>
<input type="text" placeholder="City" name="city" id="city" required="required" />

<?php
	if(isset($getRef2["username"])){
?>
	<input type="text" name="ref" id="ref" value="<?php echo $getRef2["username"]; ?>" />
	<div class="alert alert-warning" role="alert">
		Referred by: <font style="text-transform:capitalize;"><strong><?php echo $getRef2["username"]; ?></strong></font>
	</div>
<?php
}
	else {
		echo "";
	}
?>
<center>
	<input type="submit" value="Register" class="btn btn-lg btn-primary" name="add" id="btn-success" />
</center>
</form>
              </div><!-- .register-form -->
            </div>
            <div class="col-md-3">
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->


<?php include("includes/footer.php"); ?>
</body>
</html>