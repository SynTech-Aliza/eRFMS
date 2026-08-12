<?php
session_start(); 
include "../../server/update_address_details.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/update_address_details.css">
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
						<p><a href="update_address.php?profile=<?php echo $profile?>&address=<?php echo $address?>"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Address Details</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_details">
							<input list="region" class="region" name="region" value="<?php echo $region ?>" placeholder="Region" autocomplete="off" required="">
							<datalist  id="region" class="select_option">
								<?php
          							while ($row = mysqli_fetch_array($resultregion)):;   
        						?>
								<option><?php echo $row["Region"]." (".$row["Administrative_Region"].")";?></option>
								<?php 
						          endwhile;
						        ?>
							</datalist >

							<input list="province" class="province" name="province" value="<?php echo $province ?>" placeholder="Province" autocomplete="off" required="">
							<datalist id="province" class="select_option">
								<?php
          							while ($row = mysqli_fetch_array($resultprovince)):;   
        						?>
								<option><?php echo $row["Province"];?></option>
								<?php 
						          endwhile;
						        ?>
							</datalist>

							<input list="city" class="city" name="city" value="<?php echo $city ?>" placeholder="City" autocomplete="off" required="">
							<datalist id="city" class="select_option">
								<?php
          							while ($row = mysqli_fetch_array($resultcity)):;   
        						?>
								<option><?php echo $row["City"];?></option>
								<?php 
						          endwhile;
						        ?>
							</datalist>

							<input list="barangay" class="barangay" name="barangay" value="<?php echo $barangay ?>" placeholder="Barangay" autocomplete="off" required="">
							<datalist id="barangay" class="select_option">
								<?php
          							while ($row = mysqli_fetch_array($resultbarangay)):;   
        						?>
								<option><?php echo $row["Barangay"];?></option>
								<?php 
						          endwhile;
						        ?>
							</datalist>

							<input type="number" name="postal_code" value="<?php echo $postal_code ?>" class="postal_code" autocomplete="off" placeholder="Postal Code" required="">
							<textarea class="detailed_address" placeholder="Detailed Address" name="detailed_address" required=""><?php echo $detailed_address ?></textarea>
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
