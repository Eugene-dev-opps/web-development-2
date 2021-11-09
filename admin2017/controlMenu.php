
<nav class="navbar navbar-inverse sidebar" role="navigation" id="control-menu">
    <div class="container-fluid">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header" style="color:#FFF;">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-sidebar-navbar-collapse-1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">Main Menu</a>
		</div>
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse" id="bs-sidebar-navbar-collapse-1">
			<ul class="nav navbar-nav">
				<li><a href="<?php echo $siteUrl; ?>../admin2017/">Dashboard<span style="font-size:16px;" class="pull-right hidden-xs showopacity glyphicon glyphicon-home"></span></a></li>
                <li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">Profile Management <span class="caret"></span><i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-ios-contact"></i></a>
					<ul class="dropdown-menu forAnimate" role="menu">
						<li><a href="<?php echo $siteUrl; ?>../admin2017/profile.php?id=<?php echo $dnnUsers["id"]; ?>">My Profile</a></li>
						<li><a href="<?php echo $siteUrl; ?>../admin2017/profileEdit.php?id=<?php echo $dnnUsers["id"]; ?>">Edit Profile</a></li>
					</ul>
				</li>
                <li ><a href="<?php echo $siteUrl; ?>../admin2017/members.php">Manage Members<i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-android-alert"></i></a></li>
                <li ><a href="<?php echo $siteUrl; ?>../admin2017/mergeMembers.php?q=1">Merge Members<i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-merge"></i></a></li>
                <li ><a href="<?php echo $siteUrl; ?>../admin2017/donations.php">Donations<i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-ios-filing"></i></a></li>
                <li ><a href="<?php echo $siteUrl; ?>../admin2017/donationStatus.php">Donations Status<i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-ios-filing"></i></a></li>
                <li ><a href="<?php echo $siteUrl; ?>../admin2017/massMail.php">Mass Mail<i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-email"></i></a></li>
                <li ><a href="<?php echo $siteUrl; ?>../login.php">Logout<i style="font-size:22px;" class="pull-right hidden-xs showopacity icon ion-log-out"></i></a></li>
			</ul>
		</div>
	</div>
</nav>