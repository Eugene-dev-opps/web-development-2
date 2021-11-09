<?php include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>About Us - <?php echo $siteTitle; ?></title>
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
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=G-2X64QSE3WM"></script> -->
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-2X64QSE3WM');
</script>
</head>

<body>
<?php include("includes/header.php"); ?>

<div class="main" style="background: 0000;">
    <div class="container">
        <h1>About Us</h1>
        <div class="row" style="margin-top:20px;">
        	<p>
            	Senatorfunds was founded by a team of financial specialists and enthusiastic humanitarians, who craved to establish financial freedom in developing countries by creating a financial community put in place for money to circulate freely. Senatorfunds is a community where members can easily help each other financially, by providing financial help, thus empowering participants, growing businesses and attaining financial freedom. 
            </p>
        </div><!-- row -->
	</div><!-- container -->
</div><!-- main -->

<div class="main" style="background:#f7f7f7;">
    <div class="container">
    	<div class="row">
            <div class="col-md-6">
                <h1 style="color:#333">Mission</h1>
                <p>
                    Senatorfunds seeks to promote the greatest good, with particular emphasis on helping man and its environment.
                </p>
            </div><!-- col-md-6 -->
            <div class="col-md-6">
                <h1 style="color:#333">Vision</h1>
                <p>
                    Living the SenatorFunds dream of financial emancipation
                </p>
            </div><!-- col-md-6 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-md-6">
                <h1 style="color:#333">Aim</h1>
                <p>
                    To provide the system and support needed to enable our members achieve our vision.
                </p>
            </div><!-- col-md-6 -->
            <div class="col-md-6">
                <h1 style="color:#333">Values</h1>
                <p>
                    The wellbeing of the populace is our long-term lead
                </p>
            </div><!-- col-md-6 -->
        </div><!-- row -->
	</div><!-- container -->
</div><!-- main -->


<?php include("includes/footer.php"); ?>
</body>
</html>