<?php
session_start();
include "../../server/arrangedelivery.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/clerk/arrangedelivery.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<!--SECTION MY PURCHASE COMPLETE START-->
				<section class="arrange_delivery">
					<p class="content_label">Arrange Delivery</p>
					<form method="post">
						<div class="deliveryoption_btn">
							<label class="container"><i class="fa fa-user" aria-hidden="true"></i>Pick Up
								<input type="checkbox"  class="radio" name="deliverypickupstatus" value="Pick Up"><span class="checkmark"><i class="fa fa-check" aria-hidden="true"></i></span>
							</label>
							<label class="container"><i class="fa fa-truck truck" aria-hidden="true"></i>Drop Off
								<input type="checkbox"  class="radio" name="deliverypickupstatus" value="Drop Off"><span class="checkmark"><i class="fa fa-check check" aria-hidden="true"></i></span>
							</label>
						</div>
						<div class="delivery_details">
							<p class="content">* Pick Up Address</p>
							<table border="0">
								<tr>
									<th>Detailed Address</th>
									<th>Region</th>
									<th>Province</th>
									<th>City</th>
									<th>Barangay</th>
									<th>Postal Code</th>
									<th>Country</th>
								</tr>
							<?php 
							if(mysqli_num_rows($resultproductorders) == 0){
								echo "Empty";
							}else{
								while ($row = $resultproductorders->fetch_assoc()) {
							?>
								<tr>
									<td><?php echo $row['Costumer_Default_Detailed_Address']; ?></td>
									<td><?php echo $row['Costumer_Default_Region']; ?></td>
									<td><?php echo $row['Costumer_Default_Province']; ?></td>
									<td><?php echo $row['Costumer_Default_City']; ?></td>
									<td><?php echo $row['Costumer_Default_Barangay']; ?></td>
									<td><?php echo $row['Costumer_Default_Postal_Code']; ?></td>
									<td>PH</td>
								</tr>
							<?php 
								}
							}
							?>
							</table>

							<p class="content">* Pick Up Time</p>
							<input type="text" class="pickuptime" name="pickuptime" value="<?php echo $datereceive;?>"readonly>
						</div>
						<div class="button_options">
							<button type="submit" name="cancel">Cancel</button>
							<button type="submit" name="arrangedelivery" class="arrange_delivery">Arrange Delivery</button>
						</div>
					</form>
				</section>
				<!--SECTION MY PURCHASE COMPLETE END-->
			</div>
		</div>
	<!---MAIN CONTAINER END-->
<script type="text/javascript">
	$("input:checkbox").on('click', function() {
  // in the handler, 'this' refers to the box clicked on
  var $box = $(this);
  if ($box.is(":checked")) {
    // the name of the box is retrieved using the .attr() method
    // as it is assumed and expected to be immutable
    var group = "input:checkbox[name='" + $box.attr("name") + "']";
    // the checked state of the group/box on the other hand will change
    // and the current value is retrieved using .prop() method
    $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
</script>
<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  if($notification=='Empty'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Please choose pick up option.",
      showConfirmButton: false,
      timer: 1500
    })
    </script>';
  }elseif($notification=='Error'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error",
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