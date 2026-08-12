<?php
session_start();
include "../../server/my_purchases_completed.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/my_purchases_completed.css">
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
				<section class="my_purchase">
					<p><a href="my_purchases.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>My Purchases</p>
					<!--MENU TAB START-->
					<table class="menu_tab" border="0">
						<tr>
							<td><a href="my_purchases_topay.php">To Pay</a></td>
							<td><a href="my_purchases_todeliver.php">To Deliver</a></td>
							<td><a href="my_purchases_toreceive.php">To Receive</a></td>
							<td class="active"><a href="my_purchases_completed.php" >Completed</a></td>
							<td><a href="my_purchases_cancelled.php">Cancelled</a></td>
							<td><a href="#">Refund</a></td>
						</tr>
					</table>
					<!--MENU TAB END-->
					<div class="data_list">
					<?php 
					if(mysqli_num_rows($resultcompleteproduct) == 0){
						echo '<table class="data_complete" border="0">
							  </table>';
					}else{
						while ($row = $resultcompleteproduct->fetch_assoc()) {
					?>
					<!--LINK TO ORDER DETAILS START-->
					<a href="#orderdetails?costumerproductorder=<?php echo $row['CostumerProductOrder_ID']?>">
						<table class="data_complete" border="0">
							
							<tr>
								<td colspan="3" class="status_label"><i class="fa fa-check-circle-o check" aria-hidden="true"></i> Completed</td>
							</tr>
							<tr>
								<td rowspan="3" class="product_image"><a href="#"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a></td>
								<td colspan="2" class="product_name"><?php echo $row['Product_Name']; ?></td>
							</tr>
							<tr>
								<td class="product_details"><?php echo $row['Brand'].", ".$row['Materials'].", ".$row['Furniture_Type'].", ".$row['Style'].", ".$row['Color'].", ".$row['Height'].", ".$row['Width'].", ".$row['Weight'].", ".$row['Model'].", ".$row['Pattern']?></td>
								<td  class="product_quantity">x<?php echo $row['Quantity']; ?></td>
							</tr>
							<tr>

								<td colspan="2" class="product_price">₱<?php echo $row['Price']; ?></td>
							</tr>
							<tr>
								
							</tr>
							<tr>
								<td colspan="" class="product_items"><?php if($row['Total_Quantity'] == 1){
									echo $row['Total_Quantity']." Item";
								}else{
									echo $row['Total_Quantity']." Items";
								}?></td>
								<td colspan="2" class="product_total">
								<?php
									$costumerproductorder_id =$row['CostumerProductOrder_ID'];
									$costumerpurchase_id =$row['CostumerPurchase_ID'];

									#SELECT COSTUMER PURCHASE
									$sqlcheckcostumerpurchase ="SELECT * FROM `costumerspurchase` WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
									$resultcostumerpurchase = mysqli_query($conn, $sqlcheckcostumerpurchase);
									while($row = mysqli_fetch_assoc($resultcostumerpurchase)){
										$costumer_fee = $row['Fee'];
									}
									#GET TOTAL_PAYMENT
									$sqlgettotalpayment ="SELECT SUM(products.Price * costumerspurchaseproduct.Quantity)as Total_Payment FROM `costumerspurchaseproduct` INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
									$resulttotalpayment = mysqli_query($conn, $sqlgettotalpayment);
									while($row = mysqli_fetch_assoc($resulttotalpayment)){
										$costumer_totalpayment = $row['Total_Payment'];
									}

									$costumer_overalltotalpayment  = $costumer_totalpayment + $costumer_fee;
									
									echo "Total: <a class='overall_payment'>₱".$costumer_overalltotalpayment."</a>";

									#GET QUANTITY IN COSTUMER PURCHASE
									$sqlcountquantityproduct = "SELECT COUNT(costumerspurchaseproduct.CostumerPurchaseProduct_ID) as Quantity FROM costumerspurchaseproduct WHERE costumerspurchaseproduct.CostumerPurchase_ID = '$costumerpurchase_id'";
									$resultquantityproduct = mysqli_query($conn, $sqlcountquantityproduct);
									while($row = mysqli_fetch_assoc($resultquantityproduct)){
										$quantity = $row['Quantity'];
									}
								?>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="view_more">
								<?php 
								if($quantity == 1){
									echo "";
								}else{
									echo "<a href='#orderdetails?costumerproductorder=$costumerproductorder_id'>View More</a>";
								}?>
								</td>
							</tr>
							<tr>
								<td colspan="3" class="product_statuslabel"><i class="fa fa-truck truck" aria-hidden="true"></i> Your order has been succesfully delivered. <a href="#"><i class="arrow_option"></i></a></td>
							</tr>
							<tr>
								<td colspan="2"  class="product_rating">Rating (NO DATABASE YET)</td>
								<td class="btn_buyagain"><a href="#"><button>Buy Again</button></a></td>
							</tr>
						
						</table>
					</a>
					<!--LINK TO ORDER DETAILS END-->
					<?php
						}
					}
					?>
					</div>
				</section>
				<!--SECTION MY PURCHASE COMPLETE END-->
			</div>
		</div>
	<!---MAIN CONTAINER END-->
<?php	
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>