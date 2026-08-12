<?php
session_start(); 
include "../../server/account_deleted_costumer.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/account_deleted.css">
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
						<p><a href="confirm_account_deletion.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Confirm Account Deletion</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<!--SUBMIT SECTION END-->
            <div class="form_account_deletion">
            	<p><b>Note!</b></p>
              <p>Closing your account means permanently deleting your profile and removing all access to your information in our website within 30 days. Once the deletion process has begun you won't be able to retrieve your profile and other information but you can cancel the deletion process of your account by log in to our website before the due date. After 30 days your account will be deleted in this site and you won't be able to retrieve any of your information you've added. </p>

              <button type="submit" class="delete" name="continue_delete_account"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Delete Account</button>
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
