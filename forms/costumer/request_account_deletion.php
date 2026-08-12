<?php
session_start(); 
include "../../server/request_account_deletion.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/request_account_deletion.css">
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
						<p><a href="settings.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Request Account Deletion</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<!--SUBMIT SECTION END-->
            <div class="form_account_deletion">
              <p>We'll be sorry to see you go. We have know why you're deleting your account, as we may be able to support you with common issues. You can now proceed to delete this.</p>

              <button type="submit" class="delete" name="continue_account_deletion">Continue Delete Account</button>
							<button type="submit" class="cancel" name="cancel">Cancel</button>
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
