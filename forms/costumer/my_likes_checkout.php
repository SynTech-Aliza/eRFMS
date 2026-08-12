<?php
include "../../server/my_likes_checkout.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/my_likes_checkout.css">
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
				<!--EDIT BIO SECTION START-->
				<section class="check_out">
					<!--BACK SECTION START-->
					<button type="submit" name="back" class="back"><i class="fa fa-arrow-left" aria-hidden="true"></i></button><p>Check Out</p>
					<!--BACK SECTION END-->
					<!--COSTUMER DETAILS START-->
					<div class="costumer_contactdetails">
						<table border="0">
							<tr>
								<td class="contactdetails_label"><i class="fa fa-map-marker" aria-hidden="true"></i> Delivery Details </td>
							</tr>
							<tr>
								<td class="name"><?php echo $costumer_firstname." ".$costumer_middlename." ".$costumer_lastname;?></td>
							</tr>
							<tr>
								<td class="contactnumber"><?php echo $costumer_contactnumber;?></td>
							</tr>
							<tr>
								<td class="emailaddress"><?php echo $costumer_emailaddress;?></td>
							</tr>
							<tr>
								<td class="address"><?php echo $costumer_region.", ".$costumer_province.", ".$costumer_city.", ".$costumer_barangay?></td>
							</tr>
							<tr>
								<td class="postal_code"><?php echo $costumer_postalcode;?></td>
							</tr>
						</table>
					</div>
					<!--COSTUMER DETAILS END-->
					
					<!--PRODUCT DETAILS START-->
					<div class="product_details">
						<table border="0">
							<tr>
								<td rowspan="3" class="product_image"><img src="../../style/assets/products/<?php echo $product_coverphoto; ?>"></td>
								<td colspan="3" class="product_name"><?php echo $product_productname?></td>

							</tr>
							<tr>
								<td colspan="3" class="product_alldetails"><?php echo $product_brand.", ".$product_materials.", ".$product_furnituretype.", ".$product_style.", ".$product_color.", ".$product_height.", ".$product_width.", ".$product_weight.", ".$product_model.", ".$product_pattern;?></td>
							</tr>
							<tr>
								<td class="product_price">₱<?php echo $product_price;?></td>
								<td class="product_quantity">x<?php echo $costumerproductpurchase_quantity?></td>
							</tr>
						</table>
					</div>
					<!--PRODUCT DETAILS END-->
					
					<!--SHIPPING DETAILS START-->
					<div class="shipping_details">
						<table>
							<tr>
								<td class="shipping_label" colspan="2">Shipping Option</td>
							</tr>
							<tr>
								<td class="standard_local">Standard Local Delivery</td>

								<td class="fee">₱<?php echo $costumer_fee; ?></td>
							</tr>
							<tr>
								<td class="received_date">
									<?php 
									if($receivingdate == "0000-00-00"){
										echo "Date Purchased: ".$costumer_dateofpurchase;
									}else{
										echo "Receiving Date: ".$costumer_dateofpurchase." - ".$costumer_datereceive;
									}
									?>
								</td>
							</tr>
						</table>
					</div>
					<!--SHIPPING DETAILS END-->
					<!--MORE DETAILS START-->
					<div class="more_details">
						<table>
							<tr>
								<td class="order_label">Order Total (<?php echo $costumer_totalquantity; ?> product):</td>
								<td class="total_price">₱<span><?php echo $costumer_totalpayment;?></span></td>
								
							</tr>
						</table>
					</div>
					<!--MORE DETAILS END-->
					<div class="border_one">
					</div>
					<!--PAYMENT DETAILS START-->
					<div class="payment_details">
						<table>
							<tr>
								<td class="payment_option"><i class="fa fa-dollar" aria-hidden="true"></i> Payment Option</td>
								<td class="payment">
									<?php if($costumer_paymentmethod == ""){
										echo "Payment Method";
									}else{
										echo $costumer_paymentmethod;
									}?>
								<a href="my_likes_paymentmethod.php?product=<?php echo $product;?>&costumerpurchase=<?php echo $costumerpurchase_id;?>"><i class="arrow"></i></a></td>
							</tr>
						</table>
					</div>
					<!--PAYMENT DETAILS END-->

					<!--SHIPMENT DETAILS START-->
					<div class="shipment_details">
						<table border="0">
							<tr>
								<td class="shipping_total">Merchandise Subtotal</td>
								<td class="shipping_fee">₱<span><?php echo $costumer_totalpayment;?></span></td>
							</tr>
							<tr>
								<td class="shipping_total">Shipping Fee</td>
								<td class="shipping_fee">₱<?php echo $costumer_fee; ?></td>
							</tr>
							<tr>
								<td class="total_payment_label">Total Payment</td>
								<td class="total_payment">₱<span><?php echo $costumer_overalltotalpayment; ?></span></td>
							</tr>

						</table>
					</div>
					<!--SHIPMENT DETAILS END-->
					<!--TOTAL DETAILS START-->
					<div class="total_details">
						<table border="0">
							<tr>
								<td class="payment_total">Total Payment</td>
								<td rowspan="2" class="button_order">
									<button class="place_order" type="submit" name="place_order">Place Order</button>
								</td>
							</tr>
							<tr>
								<td class="total_price">₱<span><?php echo $costumer_overalltotalpayment; ?></span></td>
							</tr>

						</table>
					</div>
					<!--TOTAL DETAILS END-->
				</section>
				<!--EDIT BIO SECTION END-->
			</form>
		</div>
	</div>
	<!---MAIN CONTAINER END-->
<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  if($notification=='PaymentMethod'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Please choose Payment Method",
    showConfirmButton: false,
    timer: 2500
  });
    </script>';
  }elseif($notification=='Error'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error",
    showConfirmButton: false,
    timer: 2500
  });
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
