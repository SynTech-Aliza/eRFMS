<?php
session_start(); 
include "../../server/update_contact_number.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_contact_number.css">
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
					<!--EDIT CONTACT NUMBER SECTION START-->
					<section class="edit_contact_number">
						<!--BACK SECTION START-->
						<p><a href="myprofile.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Contact Number</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_contact_number">
							<input type="text" name="contact_number" maxlength="11" value="<?php echo $contact_number ?>" placeholder="Contact Number" autocomplete="off" required="">
						</div>
					</section>
					<!--EDIT CONTACT NUMBER SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->


	<script type="text/javascript">
		
	</script>

<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
    #Success
    if($notification=='ContactNumberExist'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Contact Number Already Exist. Please try another one.",
      showConfirmButton: false,
      timer: 3500
    })
      </script>';
    }
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>
