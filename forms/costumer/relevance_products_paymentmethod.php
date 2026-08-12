<?php 
include "../../server/relevance_products_paymentmethod.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/relevance_product_paymentmethod.css">
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
				<section class="payment_option">
					<!--BACK SECTION START-->
					<p><a href="relevance_products_checkout.php?product=<?php echo $product;?>&costumerproductpurchase=<?php echo $costumerpurchase;?>&search=<?php echo $search;?>"><i class="fa fa-arrow-left back" aria-hidden="true"></i></a>Payment Method</p>
					<!--BACK SECTION END-->
					<!--PAYMENT OPTION START-->
					<div class="payment_choice">
						<table>
							<tr>
								<td class="button_option"><button type="submit" name="cashondelivery"><i class="fa fa-truck icon-truck" aria-hidden="true"></i> Cash on Delivery </button></td>
							</tr>
							<tr>
								<td class="button_option"><button type="submit" name="creditcard"><i class="fa fa-credit-card-alt icon-creditcard" aria-hidden="true"></i> Credit Card</button></td>
							</tr>
							<tr>
								<td class="button_option"><button type="submit" name="onlinepayment"><i class="fa fa-mobile icon-mobile" aria-hidden="true"></i> Online Payment</button></td>
							</tr>
							<tr>
								<td class="button_option"><button type="submit" name="overthecounter"><i class="fa fa-money icon-money" aria-hidden="true"></i> Over the Counter</button></a></td>
							</tr>
						</table>
					</div>
					<!--PAYMENT OPTION END-->
				</section>
			</form>
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
