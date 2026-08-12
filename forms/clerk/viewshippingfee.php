<?php
session_start();
include "../../server/viewshippingfee.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<!-- Include the Borderless theme -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/clerk/viewshippingfee.css">
</head>
<body>

<!--PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!--NAVIGATION BAR START-->
	<?php include 'navigationbar.php'; ?>
	<!--NAVIGATION BAR END-->

	<!--MAIN CONTAINER START-->
	<div class="main-container">
		<!--SUB MENU NAVIGATION START-->
		<div class="sub-header-menu">
			<ul>
				<li><a>View Shipping Fees</a></li>
			</ul>
		</div>
			<!--SUB MENU NAVIGATION END-->
		<div class="card">
			<!--FORM SEARCH START-->
			<form action="" method="post">
				<h2>VIEW SHIPPING FEES</h2>
					<input class="search" type="text" name="search" placeholder="Search Location" autocomplete="off">
					<button class="buttons"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			<!--FORM SEARCH END-->

			<!--VIEW USER ACCOUNT START-->
			<div class="table">
				<table class="table_view">
					<thead>
						<th>Location</th>
						<th>Fee</th>
						<th>Delivery Days</th>
						<th colspan="3">Options</th>
					</thead>
					<?php
					if(mysqli_num_rows($nquery) == 0){

					    echo '<tbody>
											<tr>
					    				<td colspan="4" class="error">Empty</td>
					    			</tr>
					    			</tbody>';
					}else{
						while($row = mysqli_fetch_array($nquery)){
					?>
					<tbody>
						<tr>
							<td><?php echo $row['Location']; ?></td>
							<td><?php echo $row['Fee']; ?></td>
							<td><?php echo $row['DeliveryDays']; ?></td>
							<td><?php echo "<a href='updateshippingfee.php?update=".$row["ShippingFee_ID"]."'><div class='icon account'>
								<div class='tooltip'>Update Fee</div>
								<span><i class='fa fa-pencil' aria-hidden='true'></i></span>
								</div></a> "?></td>

						</tr>
					</tbody>
					<?php
							}
						}
					?>
				</table>
				<!--PAGE NUMBER START-->
				<div class="controls" id="pagination_controls"><?php echo $paginationCtrls; ?></div>
				<!--PAGE NUMBER END-->
			</div>
			<!--VIEW USER ACCOUNT END-->
		</div>
	</div>



<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
#Activated and Deactivated Account
  #Success
  if($notification=='Activate'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "User Account Activate",
    showConfirmButton: false,
    timer: 1500
  }).then(function() {
    window.location = "viewuseraccount.php";
  });
    </script>';
  }elseif($notification=='Deactivate'){
  echo '<script type="text/javascript">
    swal.fire({
    position: "top-end",
    icon: "warning",
    text: "User Account Deactivate",
    showConfirmButton: false,
    timer: 1500
  }).then(function() {
    window.location = "viewuseraccount.php";
  });
    </script>';
   }elseif($notification=='ShippingFeeUpdated'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Shipping Fee Successfully Updated.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "viewshippingfee.php";
    });
      </script>';
    }
    #Warning
    elseif($notification=='ErrorUpdating'){
      echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Updating.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "viewshippingfee.php";
    });
      </script>';
    }
    #Warning
    elseif($notification=='Error'){
      echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "viewshippingfee.php";
    });
      </script>';
    }
?>

<?php 
}else{
  header("Location:../login.php");
  exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>