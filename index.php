<?php include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title><?php echo $siteTitle; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" />
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
<style class="cp-pen-styles">
#shiva
{
	width: 200px;
	height: 200px;
	background: #222;
	border-radius: 100%;
	margin:10px auto 10px;
	font-family: 'Raleway';
	text-align:center;
}
#shiva h3 {
	margin-top:-45px;
	color:#f7f7f7;
	font-weight: bold;
	font-size:18px;
}
.count
{
  line-height: 160px;
  color:white;
  font-size:36px;
}
.count2
{
  line-height: 160px;
  color:white;
  font-size:36px;
}
</style>

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

<div class="slider">
	  <div class="callbacks_container">
	      <ul class="rslides" id="slider">
            <li><img src="img/load1.jpg" class="img-responsive" alt=""/></li>
            <li><img src="img/ban.jpg" class="img-responsive" alt=""/></li>
            <!--<li><img src="<?php echo $siteUrl; ?>img/banner2.jpg" class="img-responsive" alt=""/></li>-->
	      </ul>
	  </div><!-- callbacks_container -->
</div><!-- .slider -->

<div class="main" style="background:#f7f7f7;">
    <div class="container">
        <h1 style="color:#333">About Bloomearners</h1>
        <div class="row" style="margin-top:20px;">
        	<p>
            Bloomearners was founded by a team of financial specialists and enthusiastic humanitarians, who craved to establish financial freedom in developing countries by creating a financial community put in place for money to circulate freely. Bloomearners is a community where members can easily help each other financially, by providing financial help, thus empowering participants, growing businesses and attaining financial freedom. 
            </p>
        </div><!-- row -->
	</div><!-- container -->
</div><!-- main -->

<a name="how-it-works"></a>
<div class="main" style="background:#fff;">
    <div class="container">
        <h1 style="color:#333">HOW IT WORKS</h1>
        <div class="row" style="margin-top:40px;">
        	<div class="col-md-3" id="idea">
            	<h3>1 <br /> Register</h3>
            	<p>
                	Get registered today by clicking on the Register button. Ensure you submit valid and complete details especially your name and your contact details.
                    <br />
                    <a href="<?php echo $siteUrl; ?>register.php">
                    	<center>
                            <div class="btn btn-success btn-lg" id="btn-success">
                                <font color="#fff">Register</font>
                            </div>
                        </center>
                    </a>
                </p>
            </div><!-- col-md-3 -->
            <div class="col-md-3" id="idea">
            	<h3>2 <br /> Make Payment</h3>
            	<p>
                	Send your payment to your match within 24hrs. NOTE: Failure to send your payment within 24hrs will result to your account being deleted from the platform.
                    <br />
                    <a href="<?php echo $siteUrl; ?>login.php">
                    	<center>
                            <div class="btn btn-success btn-lg" id="btn-success">
                                <font color="#fff">Get Started</font>
                            </div>
                        </center>
                    </a>
                </p>
            </div><!-- col-md-3 -->
            <div class="col-md-3" id="idea">
            	<h3>3 <br /> Upload Proof</h3>
            	<p>
                	After successfully making the payment to the account provided to you, kindly upload the proof of the payment (which can possibly be a screenshot of the transaction or a snapshot of the teller)
                </p>
            </div><!-- col-md-3 -->
            <div class="col-md-3" id="idea">
            	<h3>4 <br /> Get Paid Back</h3>
            	<p>
                	Once your payment is confirmed, two members will be assigned to pay you each of the amount you just paid out. Which means you just earned a double of what you gave.
                </p>
            </div><!-- col-md-3 -->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->

<div class="naira">
	<div class="container">
    	<h1>Packages</h1>
        <div class="row">
        	<div class="col-md-3">
                <div class="packages">
                    <h3>GRADE A</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;5,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;8,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>GRADE B</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;10,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;16,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                	<div class="ribbon-wrapper-green"><div class="ribbon-green">POPULAR</div></div>
                    <h3>GRADE C</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;20,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;32,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>GRADE D</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;50,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;81,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>GRADE E</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;100,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;163,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                    <h3>GRADE F</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;200,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;332,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
            
            <div class="col-md-3">
                <div class="packages">
                	<div class="ribbon-wrapper-green"><div class="ribbon-green">LATEST</div></div>
                    <h3>GRADE G</h3>
                    <div class="ic">
                        <div class="icon">
                            <img src="img/icon.png" />
                        </div><!-- icon -->
                    </div><!-- ic -->
                    <div class="price">
                        &#8358;300,000
                    </div><!-- price -->
                    <div class="text">
                        <p><i class="ion-checkmark"></i> &nbsp; 2:1 Matrix</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Auto Assign</p>
                        <p><i class="ion-checkmark"></i> &nbsp; Receive <strong>&#8358;555,000</strong></p>
                    </div><!-- text -->
                    <div class="button">
                        <a href="<?php echo $siteUrl; ?>register.php">
                            <div class="btn">
                                SELECT
                            </div><!-- btn -->
                        </a>
                    </div><!-- button -->
                </div><!-- packages -->
            </div><!-- col-md-3 -->
        </div><!-- row -->
    </div><!-- container -->
</div><!-- naira -->

<div class="main">
    <div class="container">
        <div class="p col-lg-12">
            <div id="shiva">
                <span class="count">6895</span>
                <h3>Users</h3>
            </div>
        </div><!-- col-md-3 -->
        
        
        </div><!-- col-md-3 -->
        
       
        </div><!-- col-md-3 -->
        
        <div class=" col-lg-12">
            <div id="shiva">
                <span class="count2">&#8358;</span>
                <span class="count">218000</span>
                <h3>Amount Donated</h3>
            </div>
        </div><!-- col-md-3 -->
    </div><!-- container -->
</div><!-- main -->
<?php include("includes/footer.php"); ?>

<script>$('.count').each(function () {
    $(this).prop('Counter',0).animate({
        Counter: $(this).text()
    }, {
        duration: 10000,
        easing: 'swing',
        step: function (now) {
            $(this).text(Math.ceil(now));
        }
    });
});
//# sourceURL=pen.js
</script>
</body>
</html>