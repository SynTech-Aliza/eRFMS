
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../style/css/costumer/nav_t.css">
</head>
<body>

	<!---WRAPPER START-->
	<div class="wrapper">
		<!--HEADER MENU START-->
		<div class="header">
			<div class="header-menu">
				<div class="title">Rose <span>Furniture</span></div>
				<div class="image_icon">
					<img src="../../style/assets/img/chair.png">
				</div>
				<ul>
					<li><a href="settings.php">	
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
		<!--HEADER MENU END-->
		<!--SIDE BAR START-->
		<div class="sidebar">
			<div class="sidebar-menu">
				<center class="profile">
				<img src="../../style/assets/profiles/<?php echo $_SESSION['Profile'];  ?>" alt=""> 
				<p><?php echo $_SESSION['Username'];  ?></p>
				</center>
				<!--DASHBOARD START-->
				<li class="item">
					<a href="dashboard.php" class="menu-btn">
						<i class="fa fa-home" aria-hidden="true"></i><span>Dashboard</span>
					</a>
				</li>
				<!--DASHBOARD END-->
				<!--MY LIKES START-->
				<li class="item">
					<a href="my_likes.php" class="menu-btn">
							<i class="fa fa-heart" aria-hidden="true"></i><span>My Likes</span>
							<?php  
							if (isset($_SESSION['UserAccount_ID'])){
								$useraccount_id = $_SESSION['UserAccount_ID'];

								$sqluser ="SELECT `CostumerProfile_ID` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";

								$resultuser = mysqli_query($conn, $sqluser);
								
								if (mysqli_num_rows($resultuser)==0){
									$costumerprofileid = "";
								}else{					
									while ($rows = $resultuser->fetch_assoc()) {
	   								$costumerprofileid= $rows['CostumerProfile_ID'];
									}
								}												
							}

							$sqllike ="SELECT COUNT(`Product_ID`) as costumerlikes FROM `costumerslike` WHERE CostumerProfile_ID = '$costumerprofileid'";
							$sqlresultlike = mysqli_query($conn, $sqllike);

								while ($rows = $sqlresultlike->fetch_assoc()) {
   									$resultlike= $rows['costumerlikes'];
								}
							if($resultlike == 0 ){
								$costumerlike ="";
							}else{
								$costumerlike = $resultlike;
							}

							?>
							<span class="count" style="color:#f4623a;"><?php echo $costumerlike; ?></span>
						</a>
				</li>
				<!--MY LIKES END-->
				<!--MY SHOPPING CART START-->
				<li class="item">
					<a href="shopping_cart.php" class="menu-btn">
						<i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Shopping Cart</span>
							<?php  
							if (isset($_SESSION['UserAccount_ID'])){
								$useraccount_id = $_SESSION['UserAccount_ID'];

								$sqluser ="SELECT `CostumerProfile_ID` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";

								$resultuser = mysqli_query($conn, $sqluser);
								
								if (mysqli_num_rows($resultuser)==0){
									$costumerprofileid = "";
								}else{						
									while ($rows = $resultuser->fetch_assoc()) {
	   								$costumerprofileid= $rows['CostumerProfile_ID'];
									}											
								}
							}

							$sqlshoppingcart ="SELECT COUNT(DISTINCT products.Product_ID) as costumercart FROM `costumersshoppingcart` INNER JOIN products ON products.Product_ID = costumersshoppingcart.Product_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumersshoppingcart.CostumerProfile_ID WHERE products.Stocks !=0 AND  costumersprofile.CostumerProfile_ID = '$costumerprofileid'";
							$resultshoppingcart = mysqli_query($conn, $sqlshoppingcart);

								while ($rows = $resultshoppingcart->fetch_assoc()) {
   									$resultcostumercart= $rows['costumercart'];
								}
							if($resultcostumercart == 0 ){
								$costumercart ="";
							}else{
								$costumercart = $resultcostumercart;
							}

							?>
						<span class="count" style="color:#f4623a;"><?php echo $costumercart; ?></span>
					</a>
				</li>
				<!--MY SHOPPING CART END-->
				<!--MY PURCHASED START-->
				<li class="item">
					<a href="my_purchases.php" class="menu-btn">
						<i class="fa fa-file-text" aria-hidden="true"></i><span>My Purchases</span>
							<?php  
							if (isset($_SESSION['UserAccount_ID'])){
								$useraccount_id = $_SESSION['UserAccount_ID'];

								$sqluser ="SELECT `CostumerProfile_ID` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";

								$resultuser = mysqli_query($conn, $sqluser);
								
								if (mysqli_num_rows($resultuser)==0){
									$costumerprofileid = "";
								}else{						
									while ($rows = $resultuser->fetch_assoc()) {
	   								$costumerprofileid= $rows['CostumerProfile_ID'];
									}											
								}
							}

							$sqlpurchase ="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as CostumerPurchase, costumersprofile.CostumerProfile_ID FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofileid' AND costumerproductorders.Order_Status !='Completed'";
							$resultpurchase = mysqli_query($conn, $sqlpurchase);

								while ($rows = $resultpurchase->fetch_assoc()) {
   									$resultcostumerpurchase= $rows['CostumerPurchase'];
								}
							if($resultcostumerpurchase == 0 ){
								$costumerpurchase ="";
							}else{
								$costumerpurchase = $resultcostumerpurchase;
							}

							?>
							<span class="count" style="color:#f4623a;"><?php echo $costumerpurchase; ?></span>
					</a>
				</li>
				<!--MY PURCHASED END-->
			</div>
		</div>
		<!--SIDE BAR END-->
	</div>
	<!---WRAPPER END-->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".sidebar-btn").click(function(){
				$(".wrapper").toggleClass("collapse");
			});
		});
	</script>
</body>
</html>