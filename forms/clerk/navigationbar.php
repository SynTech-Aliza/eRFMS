<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../style/css/clerk/navigationbar.css">
</head>
<body>

	<!---Wrapper start-->
	<div class="wrapper">
		<!--Header Menu start-->
		<div class="header">
			<div class="header-menu">
					<div class="title">Rose <span>Furniture</span></div>
					<div class="image_icon">
						<img src="../../style/assets/img/chair.png">
					</div>
					<ul>
						<li><a href="#">	
						<div class='icon_nav settings'>
						<span><i class='fa fa-gear' aria-hidden='true'></i></span>
						<div class='tooltip'>Settings</div>
						</div>
						</a></li>
						<li><a href="#">
						<div class='icon_nav notification'>
						<span><i class='fa fa-bell' aria-hidden='true'></i></span>
						<div class='tooltip'>Notifications</div>
						</div>
						</a></li>

						<li><a href="../../server/logout.php">
						<div class='icon_nav logout'>
						<span><i class='fa fa-power-off' aria-hidden='true'></i></span>
						<div class='tooltip'>Log Out</div>
						</div>
						</a></li>
					</ul>
			</div>
		</div>
		<!--Header Menu end-->
		<!--Sidebar start-->
			<div class="sidebar">
				<div class="sidebar-menu">
					<center class="profile">
					<img src="../../style/assets/profiles/<?php echo $_SESSION['Profile'];  ?>" alt=""> 
					<p><?php echo $_SESSION['Username'];  ?></p>
					</center>
					<!--DASHBOARD START-->
					<li class="item">
						<a href="dashboard.php" class="menu-btn">
							<i class="fa fa-bar-chart-o" aria-hidden="true"></i><span>Dashboard</span>
						</a>
					</li>
					<!--DASHBOARD END-->
					<!--PRODUCTS START-->
					<li class="item" id="products">
						<a href="#products" class="menu-btn">
							<i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Products<i class="fa fa-caret-down drop-down" aria-hidden="true"></i>
						</a>
						<div class="sub-menu">
							<a href="addnewproducts.php"><span>Add New Products</span></a>
							<a href="myproducts_all_list.php"><span>My Products</span></a>
						</div>
					</li>
					<!--PRODUCTS END-->
					<!--SHIPPING FEE START-->
					<li class="item" id="shippingfee">
						<a href="#shippingfee" class="menu-btn">
							<i class="fa fa-money" aria-hidden="true"></i><span>Shipping Fee<i class="fa fa-caret-down drop-down" aria-hidden="true"></i></span>
						</a>
						<div class="sub-menu">
							<a href="addnewshippingfee.php"><span>Add New Shipping Fee</span></a>
							<a href="viewshippingfee.php"><span>View Shipping Fees</span></a>
						</div>
					</li>
					<!--SHIPPING FEE END-->
					<!--COSTUMER ORDERS START-->
					<li class="item">
						<a href="shop_orders_all.php" class="menu-btn">
							<i class="fa fa-file-text-o" aria-hidden="true"></i><span>Shop Orders</span>
						</a>
					</li>
					<!--COSTUMER ORDERS END-->
					<!--REPORTS START-->
					<li class="item" id="reports">
						<a href="#reports" class="menu-btn">
							<i class="fa fa-folder" aria-hidden="true"></i><span>Reports<i class="fa fa-caret-down drop-down" aria-hidden="true"></i>
						</a>
						<div class="sub-menu">
							<a href="#.php"><span>Stocks Report</span></a>
							<a href="#.php"><span>Inventory Report</span></a>
						</div>
					</li>
					<!--REPORTS END-->
				</div>
			</div>
		<!--Sidebar end-->
		
	</div>
	<!---Wrapper end-->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".sidebar-btn").click(function(){
				$(".wrapper").toggleClass("collapse");
			});
		});
	</script>
</body>
</html>