<?php include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>How It Works - <?php echo $siteTitle; ?></title>
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
        <h1>HOW IT WORKS</h1>
        <div class="row">
        	<p>
            	Bloom is a platform were donors provide help in the following manner ₦5,000 (Starter), ₦10,000 (Basic), ₦20,000 (Classic), ₦50,000 (Standard), ₦100,000 (Premium),₦200,000 (Advanced) or ₦250,000 (Ultimate) to a fellow participant assigned by the system and the member will then confirm your donations. The system will automatically assign two or more other participants who will also pay you the amount invested, thus giving you 100% of your investment. (i.e. 100% of ₦5,000 is ₦10,000 100% of ₦10,000 is ₦20,000 100% of ₦20,000 is ₦40,000 100% of ₦50,000 is ₦100,000, 100% of ₦100,000 is ₦200,000 100% of ₦200,000 is ₦400,000 and 100% of ₦250,000 is ₦500,000). Return on investment is on or before 2-5days from the date of confirmation of payment. 
            </p>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->

<div class="main" style="background:#f7f7f7;">
    <div class="container">
        <h1>RECOMMITMENT</h1>
        <div class="row">
        	<p>
            	Bloom is here to Change Lives. It is designed to last forever; we understand that everyone will love to earn money every few days. We like to inform you that this Community can be sustained only if everyone makes a New Pledge after they must have Received Help. This will keep the community running forever. |Bloom implemented some features to make the platform strong, secured, last long and beneficial to all concerned. 
            </p>
            <ol type="a">
                <li>After receiving Help, a Participant is given a maximum of (two) 2days or 48hours to make another Pledge of Providing Help. If no new pledge is made after 2 days or 48hours from receiving help, the system will commence suspension. All we need in this community are people who are active and have the Mindset to Give and in turn receive.</li>
                <li>When a Participant makes a Pledge to Provide Help of N10000 for Example; he/she will not pledge an amount lesser than what was initially provided. This will keep the Community Growing instead of being in setback by people who will give help of N10000 for example and after Getting Help of N20000 they decide to Provide Help of N5000 in their next pledge. </li>
                <li>Feel the joy of giving when you read the comments of Successful participants</li>
            </ol>
            <p>
            	All donations are made directly to participants, we do not run a central account; this is a community of mutual help. 
Bloom thrives with the influx of new members in the community, we encourage participants to use their referral links to earn more money and also invite friends and family to our community. 
            </p>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->

<div class="main">
    <div class="container">
        <h1>Important rules of participation</h1>
        <div class="row">
        	<p>
            	All participants must recommit i.e. provide help again within 2days or 48hours of getting help, to continue as members of the community. There are different packages for donation i.e. ₦5,000, ₦10,000, ₦20,000, ₦50,000, ₦100,000, ₦200,000, and ₦250,000. 
            </p>
            <ul>
            	<li>Pledges can be paired at any moment.</li>
                <li>Please do not participate if you do not have the money readily available</li>
                <li>Please participate only with spare money. Pledges cannot be cancelled after pairing has occurred.</li>
                <li>Sender will be given 24hrs to make payment to the other participant assigned to him/her.</li>
                <li>Confirmation must be made within 12 hours of receiving payment from a sender; otherwise your account will be deleted from Bloom.</li>
                <li>There is no refund of payment.</li>
                <li>The payment methods involved are mainly through bank deposits, mobile, internet and ATM transfers.</li>
                <li>In the case of cash at hand, the receiver and sender should agree on how to complete transaction.</li>
                <li>All disagreements and problems will be manually handled by support team. Submit a support ticket or chat with an online consultant to report any serious issue.</li>
            </ul>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->

<?php include("includes/footer.php"); ?>
</body>
</html>