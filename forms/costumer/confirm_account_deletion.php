<?php
session_start(); 
include "../../server/confirm_account_deletion.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/confirm_account_deletion.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST">
					<!--EDIT DETAILED ADDRESS SECTION START-->
					<section class="account_deletion">
						<!--BACK SECTION START-->
						<p><a href="request_account_deletion.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Confirm Deletion</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<!--SUBMIT SECTION END-->
            <div class="form_account_deletion">
            	<p><b>Enter your password to confirm that this is your Account</b></p>
              <p>Before you permanently delete your account, please enter your password.</p>
              <input type="password" name="password" required="">
              <div class="error_notification">
              <?php if (isset($_GET['error'])) { ?>
     					<p class="error"><?php echo $_GET['error']; ?></p>
     					<?php } ?>
     					</div>
              <button type="submit" class="delete" name="continue">Continue</button>
							<button type="submit" class="cancel" name="cancel"><a href="request_account_deletion.php">Cancel</a></button>
            </div>
					</section>
					<!--EDIT DETAILED ADDRESS SECTION END-->
				</form>
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
