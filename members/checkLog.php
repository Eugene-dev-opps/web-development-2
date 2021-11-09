<?php
if(isset($_SESSION['username']))
{
	$selectRole = mysqli_query($conn, 'select * from members where username="'.$_SESSION['username'].'"');
	$selectRoleUser = mysqli_fetch_array($selectRole);

	$dnUsers = mysqli_query($conn, 'select * from members where username="'.$_SESSION['username'].'"');
	$dnnUsers = mysqli_fetch_array($dnUsers);
	
	if($dnnUsers["status"]=="blocked"){
		?>
        <script>
			window.location.assign('../login.php');
		</script>
        <?php
	}
}

else {
?>
<script>
window.location.assign('../login.php');
</script>
<?php
}
?>