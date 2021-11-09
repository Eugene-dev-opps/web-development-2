<?php include("config.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width; initial-scale=1.0">
<title>FAQs - <?php echo $siteTitle; ?></title>
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
        <h1>FAQs</h1>
        <div class="row">
        	<h3>What is Cashkas?</h3>
        	<p>
            	Bloom is a peer to peer donation community where members can help each other’s financially. Bloom provides a system where members can freely give and receive financial donations from each other.
            </p>
            
            <h3>Do I need referrals to get paid? </h3>
        	<p>
            	Members are not forced to bring referrals to get paid.
            </p>
            
            <h3>Why are there different packages? </h3>
        	<p>
            	The different packages where created to entertain specific amounts of donations, so users can conveniently choose between lower and higher packages to provide help according to their financial capacity.
            </p>
            
            <h3>Is it possible to have multiple accounts?</h3>
        	<p>
            	Yes, but you will be required to provide a different phone number, email and bank account details for each new account.
            </p>
            
            <h3>How long does it take to receive help after providing help? </h3>
        	<p>
            	Members get help within ten days, but this time frame is dependent on the influx of new members in the community. i.e it can be less than ten days.
            </p>
            
            <h3>Can I provide help twice on the same account?</h3>
        	<p>
            	You can only provide help once for a particular selected package on the same account.
            </p>
            
            <h3>How do I provide help? </h3>
        	<p>
            	After registration, click on the provide help button and select the desired package. Confirm and wait to be matched with another member of the community who is eligible to get help.
            </p>
            
            <h3>How do I get help?</h3>
        	<p>
            	After providing help to another participant you will be automatically paired to get help within ten days form the date of confirmation of your payment.
            </p>
            
            <h3>Why can't I see a get help button?</h3>
        	<p>
            	This is not necessary as get help is automatic.
            </p>
            
            <h3>I provided help, but I wasn't confirmed. What do I do? </h3>
        	<p>
            	When you provide help, you are required to upload a proof of payment, you will not be blocked if you do this, make sure the other participant is reachable before you provide help and write to support if the other participant bluntly refuses to confirm the donation after receiving it.
            </p>
            
            <h3>What happens if the participant assigned to me doesn't pay? </h3>
        	<p>
            	If the participant matched to you fails to pay within 24hrs, the system will remove and block the participant and automatically match another participant to pay you.
            </p>
            
            <h3>The participant matched to pay me uploaded a fake proof of payment, what do I do?</h3>
        	<p>
            	If this happens, a user can write to support immediately and after proper investigation it will be rectified. Confirm that the user did not make payment or the user has declined to payment after uploading a proof before writing to support.
            </p>
            
            <h3>I do not use mobile banking, how do I participate on weekends?</h3>
        	<p>
            	It is advisable to use ATM transfers, or mobile and internet banking on weekends. Users who do not use such methods of payment are advised to request to provide help only on week days using bank deposit.
            </p>
            
            <h3>Is Bloom legal?</h3>
        	<p>
            	Bloom is community of mutual financial help and does not take money from its members, members freely help each other by donating a specific amount of their choice, and this is not illegal as giving a fellow participant financial assistance is not prohibited by international or local constitutions or legal systems.
            </p>
        </div><!-- row -->
    </div><!-- container -->
</div><!-- main -->

<?php include("includes/footer.php"); ?>
</body>
</html>