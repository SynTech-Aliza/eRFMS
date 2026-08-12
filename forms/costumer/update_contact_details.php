<?php
session_start(); 
include "../../server/update_contact_details.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_contact_details.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST" enctype="multipart/form-data">
					<!--EDIT NAME SECTION START-->
					<section class="edit_name">
						<!--BACK SECTION START-->
						<p><a href="update_address.php?profile=<?php echo $profile?>&address=<?php echo $address?>"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Contact Details</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_details">
							<input type="text" name="contact_number" value="<?php echo $contact_number?>"maxlength="11" class="contact_number" placeholder="Contact Number" autocomplete="off" required="">
							<input type="text" name="email_address" value="<?php echo $email_address?>" class="email_address" autocomplete="off" placeholder="Email Address" required="">
						</div>
					</section>
					<!--EDIT NAME SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->


	<script type="text/javascript">
		
	</script>

<?php

}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>
