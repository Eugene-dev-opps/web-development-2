<?php include("config.php"); ?>
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
        <h1>CONTACT US</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="register-form">
                	<br />
                	<p>
                    	<strong>Kindly fill the contact form on this page to contact us or send a mail to the address below</strong>
                	</p>
                    <p>
                    	<i class="ion-email"></i> &nbsp; <?php echo $adminEmail; ?>
                    </p>
                </div><!-- .register-form -->
            </div>
            <div class="col-md-6">
                <form class="contact" method="post" action="send_mail.php">
                	<label>Name</label>
                    <input type="text" name="name" />
                    <label>Email</label>
                    <input type="text" name="email" />
                    <label>Phone</label>
                    <input type="text" name="phone" />
                    <label>Message/Description</label>
                    <textarea name="message"></textarea>
                    <input type="submit" value="Submit" class="btn btn-primary" id="btn-pink" />
                </form>
            </div>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->


<?php include("includes/footer.php"); ?>
</body>
</html>