<?php
include("../config.php");
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
	$getMembers = mysqli_fetch_array(mysqli_query($conn, "select * from members where id = '" . $_POST["users"][$i] . "'"));
	if($getMembers["m_merge"]=="no"){
		mysqli_query($conn, "UPDATE members set m_merge='yes' WHERE id='" . $_POST["users"][$i] . "'");
	}
	else {
		mysqli_query($conn, "UPDATE members set m_merge='no' WHERE id='" . $_POST["users"][$i] . "'");
	}
}
header("Location:members.php");
?>