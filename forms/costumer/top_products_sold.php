<?php
session_start(); 
include "../../server/top_products_sold.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/top_products_sold.css">
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
				<section class="top_products">
					<p class="label"><a href="dashboard.php"><i class="fa fa-arrow-left" aria-hidden="true"></i></a> Top Products Sold</p>
					<!--DISPLAY DATA START-->
					<div class="view-section">
						<div class="wrapper">
							<div class="view_main">
								<div class="view_wrap list-view" style="display: block;">
								<?php 
								if(mysqli_num_rows($resulttopproducts) == 0){
								echo '<h2 style="text-align:center; color:#f4623a;">Empty</h2>';
								}else{
									while ($row = $resulttopproducts->fetch_assoc()) {
								?>
									<div class="view_item">
										<div class="vi_left">
											<!-- PRODUCT IMAGE START-->
											<a href="top_products_sold_preview.php?product=<?php echo $row['Product_ID']?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
											<!--PRODUCT IMAGE END-->
										</div>
										<div class="vi_right">
											<p class="content name"><?php echo $row['Product_Name'];?></p>
											<p class="content details"><?php echo $row['Brand'].", ".$row['Materials'].", ".$row['Furniture_Type'].", ".$row['Style'].", ".$row['Color'].", ".$row['Height']."m, ".$row['Width']."m, ".$row['Weight']."kg, ".$row['Model'].", ".$row['Pattern'];?></p>
											<p class="content details"><?php echo $row['Sold'];?> Sold</p>
											<p class="content price" ><a class="price_details"><i class="fa fa-tag tag" aria-hidden="true"></i> ₱<?php echo $row['Price'];?></a></p>

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

}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>
