<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
// request event time from mysql generate current time and calculate the diff
$event_time = 1487611182;
$end_time = 1487611182  + (1 * 24 * 60 * 60);
$current_time = time();
$timeLeft = $event_time-$current_time;
$new_time = "";
echo $event_time."<br>".$current_time;
?>
</body>
</html>