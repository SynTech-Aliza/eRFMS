<?php
session_start(); 
include "../../server/update_address.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_address.css">
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
						<p><a href="myaddress.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Address</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_name">
							<!--USER DETAILS SECTION START-->
							<div class="form_details">
								<table border="0" class="form_table1">
									<p class="edit_details1"><a href="update_contact_details.php?profile=<?php echo $cotumerprofile_id ?>&address=<?php echo $cotumeraddress_id ?>">Edit</a></p>
									<tr>
										<td class="label">Fullname</td>
										<td class="data"><?php echo $first_name ." ". $middle_name ." ". $last_name  ?></td>
									</tr>
									<tr>
										<td class="label">Contact Number</td>
										<td class="data"><?php echo "(+63)".$contact_number  ?></td>
									</tr>
									<tr>
										<td class="label">Email Address</td>
										<td class="data"><?php echo $email_address  ?></td>
									</tr>
								</table>

								<table border="0" class="form_table2">
									<p class="edit_details2"><a href="update_address_details.php?profile=<?php echo $cotumerprofile_id ?>&address=<?php echo $cotumeraddress_id ?>">Edit</a></p>
									<tr>
										<td class="label">Region</td>
										<td class="data"><?php echo $region  ?></td>
									</tr>
									<tr>
										<td class="label">Province</td>
										<td class="data"><?php echo $province  ?></td>
									</tr>
									<tr>
										<td class="label">City</td>
										<td class="data"><?php echo $city  ?></td>
									</tr>
									<tr>
										<td class="label">Barangay</td>
										<td class="data"><?php echo $barangay  ?></td>
									</tr>
									<tr>
										<td class="label">Postal Code</td>
										<td class="data"><?php echo $postal_code  ?></td>
									</tr>
									<tr>
										<td class="label">Detailed Address</td>
										<td class="data"><?php echo $detailed_address  ?></td>
									</tr>
								</table>

								<table border="0" class="form_table3">
									<tr>
										<td class="label">Set as Default Address</td>
										<td class="data">
										<?php if($status == "Default"){
											echo "<a href='../../server/nondefault_address.php?profile=$cotumerprofile_id&address=$cotumeraddress_id'><i class='fa fa-toggle-on default_switch' aria-hidden='true'></i></a>";
										}else{
											echo "<a href='../../server/default_address.php?profile=$cotumerprofile_id&address=$cotumeraddress_id'><i class='fa fa-toggle-off default_switch' aria-hidden='true'></i></a>";
										}

										?></td>
									</tr>
								</table>

								<table border="0" class="form_table4">
									<tr>
										<td class="label"><a href="../../server/delete_costumer_address.php?address=<?php echo $cotumeraddress_id; ?>">Delete Address</a></td>
									</tr>
									
								</table>
							</div>
							<!--USER DETAILS SECTION END-->
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
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Add User Account
    #Success
    if($notification=='Default'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Set Default Address Succesfully.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='ErrorDefault'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Set Default Address.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='NonDefault'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Set Non-Default Address Succesfully.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='ErrorNonDefault'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Set Non-Default Address.",
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
