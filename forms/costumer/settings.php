<?php
session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/settings.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<!--SECTION SETTINGS START-->
				<section class="account_setting">
					<p><a href="dashboard.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>Account Setting</p>
					<div class="my_account">
						<p class="label">My Account</p>
						<p><a href="myprofile.php"> My Profile</a></p>
						<p><a href="myaddress.php"> My Addresses</a></p>
					</div>
					<div class="support">
						<p class="label">Support</p>
						<p><a href="#">Help Center</a></p>
						<p><a href="#">Community Rules</a></p>
						<p><a href="#">Rose Furniture Policies</a></p>
						<p><a href="#">About</a></p>
						<p><a href="request_account_deletion.php">Request Account Deletion</a></p>
					</div>
				</section>
				<!--SECTION SETTINGS END-->
			</div>
		</div>
	<!---MAIN CONTAINER END-->
	

<?php	
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>