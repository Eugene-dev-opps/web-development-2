<?php include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Login - <?php echo $siteTitle; ?></title>
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
        <h1>LOGIN</h1>
        <div class="row">
        	<div class="col-md-3">
            </div>
            <div class="col-md-6">
<?php
//ini_set('display_errors',1);
//error_reporting(E_ALL);
//If the user is logged, we log him out
if(isset($_SESSION['username']))
{
	//We log him out by deleting the email and userid sessions
	unset($_SESSION['username'], $_SESSION['userid']);
?>
    <div class="alert alert-warning" role="alert">
    	<strong>Bye!</strong> You just logged out.
    </div>
    <script>
	window.location.assign('login.php');
	</script>
<?php
}
else
{
	$ousername = '';
	//We check if the form has been sent
	if(isset($_POST['username'], $_POST['password']))
	{
		//We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$ousername = stripslashes($_POST['username']);
			$username = mysqli_real_escape_string($conn, stripslashes( $_POST['username']));
			$password = stripslashes($_POST['password']);
		}
		else
		{
			$username = mysqli_real_escape_string($conn, $_POST['username']);
			$password = $_POST['password'];
		}
		//We get the password of the user
		$req = mysqli_query($conn, 'select password,id,status,role from members where username="'.$username.'"');
		$dn = mysqli_fetch_array($req, );
		//We compare the submited password and the real one, and we check if the user exists
		if($dn['password']==$password and mysqli_num_rows($req)>0)
		{
			if($dn['status']=="blocked") {
				$form = true;
				$message = "";
				$message2 = 'Your Account has been <strong>Deactivated</strong>! Kindly contact our support team for more info.';
			}
			else {
//If the password is good, we dont show the form
$form = false;

//We save the user name in the session email and the user Id in the session userid
$_SESSION['username'] = $_POST['username'];
$_SESSION['userid'] = $dn['id'];

if($dn['role']=="admin") {
?>

<script>
	window.location.assign('admin2017/index.php');
</script>
<?php
}
else {
?>

<script>
	window.location.assign('members/index.php');
</script>
    
<?php
}
			}
}
else
{
//Otherwise, we say the password is incorrect.
$form = true;
$message = "";
$message2 = 'Wrong Username or Password Combination!';
}
}
else
{
$form = true;
}
if($form)
{
//We display a message if necessary
if(isset($message))
{
?>
        <?php echo $message; ?>
		<div class="alert alert-danger" role="alert"><?php echo $message2; ?></div>
	<?php }
	//We display the form
?>
                <form class="login-form" action="login.php" method="post">
                    <label>Username:</label>
                    <input type="text" placeholder="Username" id="username" name="username" />
                    <label>Password:</label>
                    <input type="password" placeholder="Password" id="password" name="password" />
                    <input type="submit" value="Login" class="btn btn-lg btn-primary" />
            	</form>
                
<?php
	}
}
?>
            </div>
            <div class="col-md-3">
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->


<?php include("includes/footer.php"); ?>
</body>
</html>