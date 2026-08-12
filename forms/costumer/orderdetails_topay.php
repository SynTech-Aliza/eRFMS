<?php
session_start();
include "../../server/orderdetails_topay.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/orderdetails_topay.css">
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
				<section class="order_details">
					<p><a href="my_purchases_topay.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>Order Details</p>
					
					<div class="order_informations">
						<div class="order_details_description">
							<p class="paymentpending">Pending Payment</p>
							<p class=" content">Waiting for the seller to ship out the product(s).</p>
							<img src="../../style/assets/icons/topayicon.png">
						</div>
						<!--DELIVERY DETAILS START-->
						<table class="delivery_details" border="0">
							<tr>
								<td class="delivery_details_label"><i class="fa fa-map-marker location" aria-hidden="true"></i> Delivery Address</td>
								<td class="view"><a href="orderdetails_topay_addressselection.php?costumerproductorder=<?php echo $costumerpurchase_id; ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
							</tr>
							<tr>
								<td colspan="2" class="costumer_delivery_details"><?php echo $costumer_firstname." ".$costumer_middlename." ".$costumer_lastname; ?></td>
							</tr>
							<tr>
								<td colspan="2" class="costumer_delivery_details"><?php echo "(+63) ".$costumer_contactnumber; ?></td>
							</tr>
							<tr>
								<td colspan="2" class="costumer_delivery_details"><?php echo $costumer_emailaddress; ?></td>
							</tr>
							<tr>
								<td colspan="2" class="costumer_delivery_details"><?php echo $costumer_region.", ".$costumer_province.", ".$costumer_city.", ".$costumer_barangay; ?></td>
							</tr>
							<tr>
								<td colspan="2" class="costumer_delivery_details"><?php echo $costumer_postalcode; ?></td>
							</tr>
						</table>
						<!--DELIVERY DETAILS END-->
						<!--PAYMENT METHOD START-->
						<table class="payment_method" border="0">
							<tr>
								<td class="payment_method_label">Payment Method</td>
							</tr>
							<tr>
								<td class="payment_method_detail"><?php echo $paymentmethod?></td>
							</tr>
						</table>
						<!--PAYMENT METHOD END-->
						<!--PURCHASE DETAILS START-->
						<table class="purchase_product_details" border="0">
						<?php 
						if(mysqli_num_rows($resultpurchaseproducts) == 0){
							echo "";
						}else{
							while ($row = $resultpurchaseproducts->fetch_assoc()) {
						?>
							<tr>
								<td rowspan="3" class="product_image"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></td>
								<td colspan="2" class="product_name"><?php echo $row['Product_Name']; ?></td>
							</tr>
							<tr>
								<td class="product_details"><?php echo $row['Brand'].", ".$row['Materials'].", ".$row['Furniture_Type'].", ".$row['Style'].", ".$row['Color'].", ".$row['Height'].", ".$row['Width'].", ".$row['Weight'].", ".$row['Model'].", ".$row['Pattern']?></td>
								<td class="product_quantity">x<?php echo $row['Quantity']; ?></td>
							</tr>
							<tr>
								<td colspan="2" class="product_price">₱<?php echo $row['Price']; ?></td>
							</tr>
						<?php 
							}
						}
						?>
						</table>
						<table class="purchase_payment_details" border="0">
							<tr>
								<td class="payment_label">Merchandise Subtotal</td>
								<td colspan="2" class="payment_details">₱<?php echo $costumer_totalpayment; ?></td>
							</tr>
							<tr>
								<td class="payment_label">Shipping Fee</td>
								<td colspan="2" class="payment_details">₱<?php echo $costumer_fee;?></td>
							</tr>
							<tr>
								<td class="payment_label"><b>Order Total Payment</b></td>
								<td colspan="2" class="payment_details total_payment">₱<?php echo $costumer_overalltotalpayment;?></td>
							</tr>
						</table>
						<table class="purchase_order_details">
							<tr>
								<td class="payment_label"><b>Purchase Order ID</b></td>
								<td colspan="2" class="payment_details order_id"><b><?php echo $costumer_purchasenewid;?></b></td>
							</tr>
							<tr>
								<td class="payment_label">Purchase Order Date</td>
								<td colspan="2" class="payment_details"><?php echo $costumer_dateofpurchase;?></td>
							</tr>
						</table>
						<!--PURCHASE DETAILS END-->
						
						<!--ORDER OPTIONS START-->
						<div class="order_options">
							<!--CANCELLATION REASON FORM START-->
						<form method="post">
							<div class="popup" id="popup-1">
			  					<div class="overlay"></div>
			  					<div class="content">
			  						<div class="close-btn" onclick="togglePopup()">×</div>
			  						<p class="cancel_label">Select Cancellation Reason</p>
			  						<div class="cancelation_notice">
			  							<p>Please select a cancellation reason. Take note that this order will cancel in your order list and this action cannot be undone.</p>
			  						</div>
			  						<p class="radio">
					    				<input type="radio" id="radio" name="reason" value="Cheaper alternative available for lesser price">Cheaper alternative available for lesser price.<br/>
					    				<input type="radio" id="radio" name="reason" value="Seller not able to entertain transaction faster">Seller not able to entertain transaction faster.<br/>
					    				<input type="radio" id="radio" name="reason" value="The product is taking too long to be delivered">The product is taking too long to be delivered.<br/>
					    				<input type="radio" id="radio" name="reason" value="I dont want to buy this anymore">I don't want to buy this anymore.<br/>
					    				<input type="radio" id="radio" name="reason" value="Others">Others<br/>
				    				</p>
				    				<button class="btn_confirm" type="confirm" name="confirm">CONFIRM</button>
			  					</div>
							</div>
						</form>
						<!--CANCELLATION REASON FORM START-->
							<button><i class="fa fa-commenting-o" aria-hidden="true"></i>Contact Seller</button>
							<button onclick="togglePopup()">Cancel Order</button>
						</div>
						<!--ORDER OPTIONS END-->
					</div>
				</section>
				<!--SECTION MY PURCHASE COMPLETE END-->
			</div>
		</div>
	<!---MAIN CONTAINER END-->
<script type="text/javascript">
function togglePopup(){
	document.getElementById("popup-1").classList.toggle("active");
}
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