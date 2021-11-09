<?php
include('config.php');
 
if(isset($_POST['email'])) {
 
     
 
    // EDIT THE 2 LINES BELOW AS REQUIRED
 
    $email_to = $adminEmail;
 
    $email_subject = "Contact Form Submitted";
 
     
 
     
 
    function died($error) {
 
        // your error code can go here
 
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
 
        echo "These errors appear below.<br /><br />";
 
        echo $error."<br /><br />";
 
        echo "Please go back and fix these errors.<br /><br />";
 
        die();
 
    }
 
     
 
    // validation expected data exists
 
    if(!isset($_POST['name']) ||
 
        !isset($_POST['email']) ||
 
        !isset($_POST['phone']) ||
 
        !isset($_POST['message'])) {
 
        died('We are sorry, but there appears to be a problem with the form you submitted.');       
 
    }
 
     
 
    $name = $_POST['name']; // required
 
    $email_from = $_POST['email']; // required
 
    $phone = $_POST['phone']; // not required
 
    $message = $_POST['message']; // required
 
     
 
    $error_message = "";
 
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
 
  if(!preg_match($email_exp,$email_from)) {
 
    $error_message .= 'The Email Address you entered does not appear to be valid.<br />';
 
  }
 
    $string_exp = "/^[A-Za-z .'-]+$/";
 
  if(!preg_match($string_exp,$name)) {
 
    $error_message .= 'The Name you entered does not appear to be valid.<br />';
 
  }

 
  if(strlen($message) < 2) {
 
    $error_message .= 'The message you entered do not appear to be valid.<br />';
 
  }
 
  if(strlen($error_message) > 0) {
 
    died($error_message);
 
  }
 
    $email_message = "
	<html>
<head>
  <title>Contact Form Submitted!</title>
</head>
<body>
		<table align='center' style='border:#CCC 1px solid; border-radius: 5px; overflow:hidden; width:750px; margin:0 auto 0; color: #666; line-height:25px; font-family:'Trebuchet MS', Arial, Helvetica, sans-serif;'>
<tr>
<td style='padding:20px; background:#fff; width: auto;'>
<h2>Contact Form Submitted!</h2>
<p>
Dear Administrator, a form has just being submitted. The details are below:
<br />
Name: $name
 <br />
Email: $email_from
 <br />
Telephone: $phone
 <br />
Comments: $message
</p>
</td>
</tr>
</table>
</body>
</html>
	";
 
     
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
 

// create email headers
 
$headers = 'From: admin124 <'.$email_to.">\r\n".
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
'Reply-To: '.$email_from."\r\n" .
 
'X-Mailer: PHP/' . phpversion();
 
@mail($email_to, $email_subject, $email_message, $headers);  
 
?>
 
 
 
<!-- include your own success html here -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>Contact Us - <?php echo $siteTitle; ?></title>
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
</head>

<body>
<?php include("includes/header.php"); ?>

<div class="main">
    <div class="container">
        <h1>CONTACT FORM SUBMITTED!</h1>
        <div class="row">
        	<p align="center" style="font-size:18px;">
            	Dear <?php echo $name; ?>,
                <br />
                Your form was submitted successfully, kindly hold on while we attend to your request.
                <br /><br />
                Thank you!
            </p>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->


<?php include("includes/footer.php"); ?>
</body>
</html>
<?php
 
}
 
?>