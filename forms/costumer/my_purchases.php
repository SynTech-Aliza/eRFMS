<?php
session_start(); 
include "../../server/my_purchases.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/my_purchases.css">
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
				<section class="my_purchase">
					<p class="label"><i class="fa fa-file-text" aria-hidden="true"></i> My Purchases</p>
					<!--DISPLAY DATA START-->
					<table class="table_one" border="0">
						<tr>
							<td>List of Purchases</td>
							<td class="purchase_history"><a href="my_purchases_completed.php">View Purchase History<i class="arrow"></i></a></td>
						</tr>
					</table>
					<table class="table_two" border="0">
						<tr>
							<td><a href="my_purchases_topay.php"><i class="fa fa-credit-card credit-card" aria-hidden="true"></i><br/>To Pay
								<?php
									if($topayresult == 0){
										echo "";
									}else{
										echo "<span class='notification_topay'>".$topayresult."</span>";
									}
								?></a></td>
							<td><a href="my_purchases_todeliver.php"><i class="fa fa-truck truck" aria-hidden="true"></i><br/>To Deliver
								<?php
									if($todeliverresult == 0){
										echo "";
									}else{
										echo "<span class='notification_todeliver'>".$todeliverresult."</span>";
									}
								?></a></td>
							<td><a href="my_purchases_toreceive.php"><i class="fa fa-handshake-o hand" aria-hidden="true"></i><br/>To Receive
								<?php
									if($toreceiveresult == 0){
										echo "";
									}else{
										echo "<span class='notification_toreceive'>".$toreceiveresult."</span>";
									}
								?></a></td>
							<td><a href="my_purchases_completed.php"><i class="fa fa-star star" aria-hidden="true"></i><br/>To Rate
								<?php
									if($torateresult == 0){
										echo "";
									}else{
										echo "<span class='notification_torate'>".$torateresult."</span>";
									}
								?></a></td>
						</tr>
					</table>
					<table class="table_three" border="0">
						<tr>
							<td><i class="fa fa-shopping-bag" aria-hidden="true"></i> Buy Again</td>
							<!--LINK TO LIST OF BUY AGAIN PRODUCTS START-->
							<td class="see_more"><a href="buy_again.php">See More<i class="arrow"></i></a></td>
							<!--LINK TO LIST OF BUY AGAIN PRODUCTS END-->
						</tr>
					</table>

					<!--BUY AGAIN START-->
			    <div class="buy_again">
			      <!--WRAPPER START-->
			      	<div class="wrapper-feeds">
			        <?php
			        if (mysqli_num_rows($resultcompleteproduct)==0){
								echo '';
							}else{
								while ($row = mysqli_fetch_array($resultcompleteproduct)){
							?>
							<div class="item">
								<div class="view_main">
									<div class="view_wrap grid-view" style="display: block;">
										<div class="view_item">
											<div class="vi_left">
											<!----DISPLAY TOP IMAGES START-->
												<img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>">
											<!----DISPLAY TOP IMAGES END-->
											</div>
											<div class="vi_right">
												<p class="price">₱<?php echo $row['Price']; ?></p>
												<p class="cart"><a href="../../server/costumer_addtocart_product.php?mypurchaseproduct=<?php echo $row['Product_ID'] ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i></a></p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
								}
							}
							?>		
			        	</div>
						<!--WRAPPER END-->
			        </div>
			        <!--BUY AGAIN END-->
					<!--DISPLAY DATA END-->
					
				</section>
			</form>
		</div>
	</div>
	<!---MAIN CONTAINER END-->

<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  if($notification=='EmptyStocks'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Sorry this Product is out of Stocks.",
    showConfirmButton: false,
    timer: 1500
  });
    </script>';
  }elseif($notification=='AddToCart'){
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
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>
