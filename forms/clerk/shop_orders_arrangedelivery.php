<?php
session_start();
include "../../server/connection/db_conn.php";
include "../../server/shop_orders_arrangedelivery.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/clerk/shop_orders_arrangedelivery.css">
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
		<!---SUB MENU NAVIGATION START-->
		<div class="sub-header-menu">
			<ul>
				<li><a>Shop Orders</a></li>
				<li><a>To Arrange Delivery</a></li>
			</ul>
		</div>
		<!---SUB MENU NAVIGATION END-->
		<div class="card">
			<section class="table-menu" >
				<div>
					<ul>
						<li><a href="shop_orders_all.php">All</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_unpaidproducts.php">Unpaid Products</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_arrangedelivery.php" class="active">To Arrange Delivery</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_preparepackage.php">To Prepare Package</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_todeliver.php">To Deliver</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_outfordelivery.php">Out for Delivery</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_cancellationrequest.php">Cancellation Request</a></li>
						<li><span></span></li>
						<li><a href="shop_orders_cancelled.php">Cancelled</a></li>
					</ul>
				</div>
			</section>
			<!--VIEWING PAGE START-->
			<section class="viewall">

				<form action="" class="search_form" method="post">
					<input class="search" type="text" name="search" placeholder="Search Product Order ID" autocomplete="off">
					<button class="buttons"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>
				</form>
				<div class="menu_tab">
					<table class="data_list" border="0">
						<tr>
						<th class="products_label" colspan="2">Products</th>
						<th class="total_label" >Order Total</th>
						<th class="status_label">Status</th>
						<th class="courier_label">Courier</th>
						<th>Purchase Date</th>
						<th>Ship By Date</th>
						<th class="process_label">Process</th>
					</tr>
					</table>
				</div>
				<!--VIEWING LIST START-->
				<div class="wrapper">
					<div class="view_main">
						<div class="view_wrap list-view" style="display: block;">
							<?php if(mysqli_num_rows($nquery) == 0){?>
								<div class="vi_left">
									<h2 class="empty" style="text-align: center;color: #f4623a;">List is empty</h2>
								</div>
							<?php
							}else{
								while($row = mysqli_fetch_array($nquery)){
							?>

							<div class="view_item">
								<div>
									<p class="product_id"><?php echo $row['PlatformProductOrder_ID']; ?></p>
								
									<div class="grid-container">
										<div class="grid-item productorder_details">
										  	<div class="grid-productdetails" >
										  	<?php 
											#SELECT PRODUCT IMAGES START
											$costumerpurchase_id = $row['CostumerPurchase_ID'];
											$sqlshoporders = "SELECT costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumerspurchaseproduct.Quantity, products.Product_ID, products.Cover_Photo, products.Product_Name, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern FROM costumerspurchaseproduct INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerspurchaseproduct.CostumerPurchase_ID = '$costumerpurchase_id'";
											$resultshoporder = mysqli_query($conn, $sqlshoporders);
												while($row = mysqli_fetch_assoc($resultshoporder)){

											#SELECT PRODUCT IMAGES START
											?>
												<p style="padding-left: 10px"><img src='../../style/assets/products/<?php echo $row['Cover_Photo']; ?>'></p>
												<p style="word-break:break-all; width: 180px; padding-left: 10px;"><span class="product_name" style=""><?php echo $row['Product_Name'];?></span><br/><span class="product_details"><?php echo $row['Brand'].",".$row['Materials'].",".$row['Furniture_Type'].",".$row['Style'].",".$row['Color'].",".$row['Height']."m,".$row['Width']."m,".$row['Weight']."kg,".$row['Model'].",".$row['Pattern'];?></span></p>
												<p class="product_quantity" style="word-break:break-all; padding-right: 15px;"><span class="">x<?php echo $row['Quantity'] ?></span></p>
										  	<?php 
										  		}
										  	?>
										  	</div>
									  	</div>
									  	<div class="grid-item productorder_total">
									  	<?php 

									  	#GET PRODUCT PRICE & PAYMENT METHOD START
										#COSTUMER FEE
										$sqlcheckcostumerpurchase ="SELECT * FROM `costumerspurchase` WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
											$resultcostumerpurchase = mysqli_query($conn, $sqlcheckcostumerpurchase);
										while($row = mysqli_fetch_assoc($resultcostumerpurchase)){
											$costumer_fee = $row['Fee'];
										}

										$sqlshoporders = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, costumerspurchase.Payment_Method, costumerspurchase.DateOfPurchase,products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID GROUP BY costumerproductorders.CostumerProductOrder_ID DESC";
										$resultshoporder = mysqli_query($conn, $sqlshoporders);
											while($row = mysqli_fetch_assoc($resultshoporder)){
												$costumerproductorder_id = $row['CostumerProductOrder_ID'];
												$paymentmethod = $row['Payment_Method'];
												$dateofpurchase = $row['DateOfPurchase'];
											}

										#SELECT COSTUMER PURCHASE
										$sqlcheckcostumerpurchase ="SELECT * FROM `costumerspurchase` WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
										$resultcostumerpurchase = mysqli_query($conn, $sqlcheckcostumerpurchase);
											while($row = mysqli_fetch_assoc($resultcostumerpurchase)){
												$costumer_purchasetype = $row['Purchase_Type'];
												$costumer_totalquantity = $row['Total_Quantity'];
												$costumer_fee = $row['Fee'];
												$receivingdate = $row['DateReceive'];
												$datereceive = strtotime($row['DateReceive']);
												$costumer_datereceive = date('F j, Y', $datereceive);
												$costumer_paymentmethod = $row['Payment_Method'];
											}

										#GET TOTAL_PAYMENT
										$sqlgettotalpayment ="SELECT products.Price * costumerspurchaseproduct.Quantity as Total_Payment FROM `costumerspurchaseproduct` INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
										$resulttotalpayment = mysqli_query($conn, $sqlgettotalpayment);
											while($row = mysqli_fetch_assoc($resulttotalpayment)){
												$costumer_totalpayment = $row['Total_Payment'];
											}

										#GET OVERALL TOTAL_PAYMENT
										$sqlgetoveralltotalpayment ="SELECT products.Price * costumerspurchaseproduct.Quantity + costumerspurchase.Fee as OverallTotal_Payment, costumerspurchase.Payment_Method FROM `costumerspurchaseproduct` INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID WHERE costumerspurchase.CostumerPurchase_ID ='$costumerpurchase_id'";
										$resultoveralltotalpayment = mysqli_query($conn, $sqlgetoveralltotalpayment);
											while($row = mysqli_fetch_assoc($resultoveralltotalpayment)){
												$costumer_overalltotalpayment = $row['OverallTotal_Payment'];
											}
										#GET PRODUCT PRICE & PAYMENT METHOD END
										?><p style="word-break:break-all; width: 105px; ; padding-left: 10px;"><span class="product_price">₱<?php echo $costumer_overalltotalpayment;?></span><br/><span class="product_paymentmenthod"><?php echo $costumer_paymentmethod;?></span></p>
										</div>
										<div class="grid-item product_status">
										<?php 
										#GET PRODUCT STATUS START
										$sqlshoporders = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, costumerspurchase.Payment_Method, costumerspurchase.DateOfPurchase,products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity 
											FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.CostumerProductOrder_ID ='$costumerpurchase_id' GROUP BY costumerproductorders.CostumerPurchase_ID DESC ";
										$resultshoporder = mysqli_query($conn, $sqlshoporders);
										while($row = mysqli_fetch_assoc($resultshoporder)){
											$order_status = $row['Order_Status'];
											}
										#GET PRODUCT STATUS END
										?><p style="word-break:break-all;width: 81px;padding-left: 10px; width: 114px; "><?php echo $order_status ?></p>
										</div>
										<div class="grid-item product_courier">
										<p style="word-break:break-all; width: 90px; padding-left: 10px; width: 115px; ">RFOSS <br/>Express</p></div>
										<div class="grid-item product_purchasedate">
										<?php
										#GET PURCHASE DATE START
										$sqlshoporders = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, costumerspurchase.Payment_Method, costumerspurchase.DateOfPurchase,products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.CostumerProductOrder_ID ='$costumerpurchase_id' GROUP BY costumerproductorders.CostumerPurchase_ID DESC ";
										$resultshoporder = mysqli_query($conn, $sqlshoporders);
											while($row = mysqli_fetch_assoc($resultshoporder)){
											$costumer_dateofpurchase = $row['DateOfPurchase'];
											}
										#GET PURCHASE DATE START
										?><p style="word-break:break-all; padding-left: 10px; width: 140px; "><?php echo $costumer_dateofpurchase; ?></p>
										</div>
										<div class="grid-item products_shipdate">
										<p style="word-break:break-all; width: 123px; padding-left: 10px; ">---- -- --</p>
										</div>
										<div class="grid-item product_process">
											<p style="word-break:break-all; width: 154px; padding-left: 10px;"><a href="arrangedelivery.php?productorderid=<?php echo $costumerpurchase_id; ?>">Arrange Delivery</a></p>
											<div class="dropdown">
												<button class="dropbtn">More</button>
								  				<div class="dropdown-content">
													 <nav class="more-options">
														<ul>
															<li class="dropdownprint"><a><i class="arrow"></i>Print</a>
																<ul class="sub_menu print">
																	<li><a href="#">Print Picklist</a></li>
																	<li><a href="#">Print Packing List (PDF)</a></li>
																	<li><a href="#">Print Packing List (EXCEL)</a></li>
																</ul>
															</li>
															<li><a>Deliver Directly</a></li>
															<li><a>Cancel Order</a></li>
															<li><a>View Details</a></li>
														</ul>
													</nav>
												  </div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<?php
								}
							}
							?>
						<div class="controls" id="pagination_controls"><?php echo $paginationCtrls; ?></div>	
						</div>
					</div>
				</div>
				<!--VIEWING LIST END-->
			</section>
			<!--VIEWING PAGE END-->
		</div>
	</div>
	<!---MAIN CONTAINER END-->
	<!---NOTIFICATION START-->
	<!---NOTIFICATION END-->
<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  if($notification=='SuccessfullyArrangeDelivery'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Successfully Arrange Delivery.",
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