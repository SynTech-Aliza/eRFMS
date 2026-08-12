<?php
session_start(); 
include "../../server/update_gender.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_gender.css">
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
					<!--EDIT GENDER SECTION START-->
					<section class="edit_gender">
						<!--BACK SECTION START-->
						<p><a href="myprofile.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Gender</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_gender">
							<input type="text" name="gender" value="<?php echo $gender ?>" placeholder="Gender" autocomplete="off" required="">
						</div>
					</section>
					<!--EDIT GENDER SECTION END-->
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
