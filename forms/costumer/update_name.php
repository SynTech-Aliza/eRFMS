<?php
session_start(); 
include "../../server/update_name.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_name.css">
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
						<p><a href="myprofile.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Name</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_name">
							<input type="text" name="first_name" value="<?php echo $first_name ?>" class="f_name" autocomplete="off" placeholder="First Name" required="">
							<input type="text" name="middle_name" value="<?php echo $middle_name ?>" class="m_name" autocomplete="off" placeholder="Middle Name" required="">
							<input type="text" name="last_name" value="<?php echo $last_name ?>" class="l_name" autocomplete="off" placeholder="Last Name" required=""><br>
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
