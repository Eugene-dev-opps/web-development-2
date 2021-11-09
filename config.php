<?php

//We start sessions
//ini_set('display_errors',1);
//error_reporting(E_ALL);

session_set_cookie_params(time()+321140800,"/");
session_start();

//configuration
$siteTitle = "Bloomearners";
$siteUrl = "";

//Site Administators
$adminEmail = "bloomearners@gmail.com";

//MySQL Connection
//$conn= mysqli_connect("rs2.noc254.com","bloomear_cashdptk_twin", "WHfj7-HQ*02de5", "bloomear");
//$result= mysqli_select_db($conn,"bloomear_cashdptk_twin1");

$conn= mysqli_connect ("localhost","root", "", "cashdptk_twin");

$result= mysqli_select_db($conn,"cashdptk_twin");

//$con= mysqli_connect("localhost","root", "", "cashdptk_twin") or die(mysqli_error);

//$result=  mysqli_select_db($con,"cashdptk_twin");





?>




