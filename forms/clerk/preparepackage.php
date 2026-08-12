<?php
session_start();
include "../../server/preparepackage.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/clerk/preparepackage.css">
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
					<p class="content_label">Prepare Package</p>
					<form method="post">
						<div class="delivery_details">
							<p class="content">* Order Details</p>
							<table border="0">
								<tr>
									<th>Order ID</th>
									<th>Product</th>
									<th>Details</th>
									<th>Quantity</th>
								</tr>
							<?php 
							if(mysqli_num_rows($resultproductorders) == 0){
								echo "Empty";
							}else{
								while ($row = $resultproductorders->fetch_assoc()) {
							?>
								<tr>
									<td><?php echo $row['PlatformProductOrder_ID']; ?></td>
									<td><img src='../../style/assets/products/<?php echo $row['Cover_Photo']; ?>'></td>
									<td><p style="word-break:break-all;"><span class="product_name" style=""><?php echo $row['Product_Name'];?></span><br/><span class="product_details"><?php echo $row['Brand'].",".$row['Materials'].",".$row['Furniture_Type'].",".$row['Style'].",".$row['Color'].",".$row['Height']."m,".$row['Width']."m,".$row['Weight']."kg,".$row['Model'].",".$row['Pattern'];?></span></p></td>
									<td><?php echo $row['Quantity']."/".$row['Quantity']; ?><i class="fa fa-check-circle" aria-hidden="true"></i></td>
									<?php 
										$costumerproductorderid = $row['CostumerProductOrder_ID'];

										$sqlgetdeliveryorderid = "SELECT * FROM `orderdeliverydetails` WHERE CostumerProductOrder_ID = '$costumerproductorderid'";
										$resultdeliveryorderid = mysqli_query($conn, $sqlgetdeliveryorderid);
										while($row = mysqli_fetch_assoc($resultdeliveryorderid)){
											$orderdeliverydetailsid = $row['OrderDeliveryDetails_ID'];
										}

									?>
									<td style="display: none;"><input type="text" name="orderdeliverydetailsid" value="<?php echo $orderdeliverydetailsid;?>"></td>
								</tr>
							<?php 
								}
							}
							?>
							</table>
							<div class="button_options">
								<button type="submit" name="cancel">Cancel</button>
								<button type="submit" name="prepaprepackage" class="arrange_delivery">Prepare Package</button>
							</div>
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
  if($notification=='Error'){
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