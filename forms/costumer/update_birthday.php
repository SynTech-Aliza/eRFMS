<?php
session_start(); 
include "../../server/update_birthday.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_birthday.css">
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
					<!--EDIT BIRTHDAY SECTION START-->
					<section class="edit_birthday">
						<!--BACK SECTION START-->
						<p><a href="myprofile.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Birthday</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_birthday">
							<input type="date" name="birthday" value="<?php echo $birthday ?>" placeholder="Gender" autocomplete="off" required="">
						</div>
					</section>
					<!--EDIT BIRTHDAY SECTION END-->
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
