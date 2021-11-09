<?php
include("../config.php");
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
mysqli_query($conn, "UPDATE members set role='user' WHERE id='" . $_POST["users"][$i] . "'");
}
header("Location:members.php");
?>