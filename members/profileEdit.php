<?php include("../config.php"); ?>
<?php include("checkLog.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Edit Profile - <?php echo $siteTitle; ?></title>
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
		
		window.location.assign("donateAdd.php?q="+str,true);

    }
}
</script>
</head>

<body>
<?php include("../includes/header2.php"); ?>
<?php include("controlMenu.php"); ?>

<div class="main">
    <div class="container">
        <h2>Edit Profile</h2>

        <div class="row" style="padding-top:20px;">
             <div class="col-sm-6">
<?php
//We check if the form has been sent
	if(isset($_POST['username'], $_POST['password'], $_POST['passverif'], $_POST['email'], $_POST['phone'], $_POST['name'], $_POST['state'], $_POST['city']))
	{
		//We remove slashes depending on the configuration
		if(get_magic_quotes_gpc())
		{
			$_POST['password'] = stripslashes($_POST['password']);
			$_POST['passverif'] = stripslashes($_POST['passverif']);
			$_POST['email'] = stripslashes($_POST['email']);
			$_POST['username'] = stripslashes($_POST['username']);
			$_POST['phone'] = stripslashes($_POST['phone']);
			$_POST['name'] = stripslashes($_POST['name']);
			$_POST['state'] = stripslashes($_POST['state']);
			$_POST['city'] = stripslashes($_POST['city']);
		}
		//We check if the two passwords are identical
		if($_POST['password']==$_POST['passverif'])
		{
			//We check if the password has 6 or more characters
			if(strlen($_POST['password'])>=6)
			{
				//We check if the email form is valid
				if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',$_POST['email']))
				{
					$password = mysqli_real_escape_string($conn, $_POST['password']);
					$email = mysqli_real_escape_string($conn, $_POST['email']);
					$username = mysqli_real_escape_string($conn, $_POST['username']);
					$phone = mysqli_real_escape_string($conn, $_POST['phone']);
					$name = mysqli_real_escape_string($conn, $_POST['name']);
					$state = mysqli_real_escape_string($conn, $_POST['state']);
					$city = mysqli_real_escape_string($conn, $_POST['city']);
					//We check if there is no other user using the same username
					$dn = mysqli_fetch_array(mysqli_query($conn, 'select count(*) as nb from members where username="'.$username.'"'));

						//We edit the user informations
						if(mysqli_query($conn, 'update members set password="'.$password.'", email="'.$email.'", phone="'.$phone.'", name="'.$name.'", state="'.$state.'", city="'.$city.'" where id="'.mysqli_real_escape_string($conn, $_SESSION['userid']).'"'))
						{
							//We dont display the form
							$form = true;     
?>
<div class="alert alert-success" role="alert" style="text-align:center;">Your details were successfully Updated.</div>
<?php
						}
						else
						{
							//Otherwise, we say that an error occured
							$form = true;
							$message = 'An error occurred while updating your informations.';
						}
				}
				else
				{
					//Otherwise, we say the email is not valid
					$form = true;
					$message = 'The email you entered is not valid.';
				}
			}
			else
			{
				//Otherwise, we say the password is too short
				$form = true;
				$message = 'Your password must contain at least 6 characters.';
			}
		}
		else
		{
			//Otherwise, we say the passwords are not identical
			$form = true;
			$message = 'The passwords you entered are not identical.';
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
			echo '<div class="alert alert-danger" role="alert">'.$message.'</div>';
		}
		//If the form has already been sent, we display the same values
		if(isset($_POST['password'],$_POST['username']))
		{
			$pseudo = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
			if($_POST['password']==$_POST['passverif'])
			{
				$password = htmlentities($_POST['password'], ENT_QUOTES, 'UTF-8');
			}
			else
			{
				$password = '';
			}
			$email = htmlentities($_POST['email'], ENT_QUOTES, 'UTF-8');
			$username = htmlentities($_POST['username'], ENT_QUOTES, 'UTF-8');
			$phone = htmlentities($_POST['phone'], ENT_QUOTES, 'UTF-8');
			$name = htmlentities($_POST['name'], ENT_QUOTES, 'UTF-8');
			$state = htmlentities($_POST['state'], ENT_QUOTES, 'UTF-8');
			$city = htmlentities($_POST['city'], ENT_QUOTES, 'UTF-8');
		}
		else
		{
			//otherwise, we display the values of the database
			$dnn = mysqli_fetch_array(mysqli_query($conn, 'select * from members where username="'.$_SESSION['username'].'"'));
			$password = htmlentities($dnn['password'], ENT_QUOTES, 'UTF-8');
			$email = htmlentities($dnn['email'], ENT_QUOTES, 'UTF-8');
			$username = htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8');
			$phone = htmlentities($dnn['phone'], ENT_QUOTES, 'UTF-8');
			$name = htmlentities($dnn['name'], ENT_QUOTES, 'UTF-8');
			$state = htmlentities($dnn['state'], ENT_QUOTES, 'UTF-8');
			$city = htmlentities($dnn['city'], ENT_QUOTES, 'UTF-8');
		}
		//We display the form
?>

<form action="profileEdit.php" method="post" class="form">
                    	<h3>User Login Details</h3>
                      <label>Username:</label>
                        <input type="text" placeholder="Username" name="username" value="<?php echo $username; ?>" readonly="readonly" />
                        <label>Password:</label>
                        <input type="password" placeholder="Password" name="password" required="required" value="<?php echo $password; ?>" />
                        <label>Confirm Password:</label>
                      <input type="password" placeholder="Confirm Password" name="passverif" value="<?php echo $password; ?>" required="required" />
                        <label>Email:</label>
                      <input type="text" placeholder="Email" name="email" value="<?php echo $email; ?>" readonly="readonly" />
                        <h3>Personal Details</h3>
                      <label>Full Name:</label>
                      <input type="text" placeholder="Surname Firstname Lastname" name="name" value="<?php echo $name; ?>" required="required" />
                      <label>Phone:</label>
                      <input type="text" placeholder="Phone" name="phone" value="<?php echo $phone; ?>" required="required" />
                        <label>State:</label>
<select name="state" id="state">
<option value="<?php echo $state; ?>" selected="selected"><?php echo $state; ?></option>
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
                      <input type="text" placeholder="City" name="city" value="<?php echo $city; ?>" required="required" />
                      <input type="submit" value="Update" class="btn btn-lg btn-primary" style="float:left;" />
                    </form>

<?php
	}
?>
				
            </div><!-- /.col-sm-6 -->
     	</div><!-- row -->
    </div><!-- .container -->
</div><!-- .main -->
</body>
</html>