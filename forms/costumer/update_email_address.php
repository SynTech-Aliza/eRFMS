<?php
session_start(); 
include "../../server/update_email_address.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_email_address.css">
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
					<!--EDIT EMAIL ADDRESS SECTION START-->
					<section class="edit_email_address">
						<!--BACK SECTION START-->
						<p><a href="myprofile.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Email Address</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_email_address">
							<input type="text" name="email_address" value="<?php echo $email_address ?>" placeholder="Email Address" autocomplete="off" required="">
						</div>
					</section>
					<!--EDIT EMAIL ADDRESS SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->


	<script type="text/javascript">
		
	</script>

<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
    #Success
    if($notification=='EmailExist'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Email Already Exist. Please try another one.",
      showConfirmButton: false,
      timer: 1500
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
