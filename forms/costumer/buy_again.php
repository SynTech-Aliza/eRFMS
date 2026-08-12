<?php
session_start(); 
include "../../server/buy_again.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/buy_again.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>
	
	<!---NAVIGATION BAR START-->
	<?php include 'navigationbar.php'; ?>
	<!---NAVIGATION BAR END-->

	<!---MAIN CONTAINER START-->
	<div class="main-container">
		<div class="card">
			<form method="POST">
				<!--EDIT BIO SECTION START-->
				<section class="buy_again">
					<p class="label"><a href="my_purchases.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Buy Again</p>
					<!--DISPLAY DATA START-->
					<div class="view-section">
						<div class="wrapper">
							<div class="view_main">
								<div class="view_wrap grid-view" style="display: block;">
									<?php 
									if (mysqli_num_rows($resultbuyagainproducts)==0){
										echo '<h2 style="color:#f4623a;">Result Not Found</h2>';
									}else{
										while($row = mysqli_fetch_array($resultbuyagainproducts)){
									?>
									<div class="view_item">
										<div class="vi_left">
											<!-- PRODUCT IMAGE START-->
											<a href="buy_again_preview.php?product=<?php echo $row['Product_ID']; ?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
											<!--PRODUCT IMAGE END-->
										</div>
										<div class="vi_right">
											<p class="content name"><?php echo $row['Product_Name']; ?></p>
											<p class="content price"><i class="fa fa-tag" aria-hidden="true"></i> ₱<?php echo $row['Price']; ?></p>
											<p class="content">
												<table border="0">
													<tr>
														<td class="buy_status">
														<?php if($row['Buy'] == 1){
															echo "Buy ".$row['Buy']. " time";
														}else{
															echo "Buy ".$row['Buy']. " times";
														} ?></p></td>
														<td class="cart"><a href="../../server/costumer_addtocart_product.php?costumerbuyagainproduct=<?php echo $row['Product_ID'] ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a></td>
													</tr>
												</table>
											</p>
											
										</div>
									</div>
									<?php
									}
									}		
									?>
								</div>
							</div>
						</div>
					</div>
					<!--DISPLAY DATA END-->
				</section>
			</form>
		</div>
	</div>
	<!---MAIN CONTAINER END-->
<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
if($notification=='AddToCart'){
	  echo '<script type="text/javascript">
	  Swal.fire({
	    position: "top-end",
	    icon: "success",
	    text: "Added to Shopping Cart.",
	    showConfirmButton: false,
	    timer: 1500
	  })
	  </script>';
  }
 elseif($notification=='EmptyStocks'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Sorry this Product is out of Stocks.",
    showConfirmButton: false,
    timer: 1500
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
