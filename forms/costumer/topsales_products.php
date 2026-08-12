<?php
session_start(); 
include "../../server/topsales_products.php";

?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/topsales_products.css">
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
				<section class="products">
					<!--SEARCH FUNCTION START-->
					<form method="post">
						<input class="search" type="text" name="product" value="<?php echo $search; ?>" autocomplete="off" placeholder="Search" >
						<button class="search-btn" type="submit" name="search"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>	
					</form>
					<!--SEARCH FUNCTION END-->
					<!--TABLE MENU START-->
					<div class="table-menu">
					<ul>
						<li><a href="relevance_products.php?search=<?php echo $search; ?>">Relevance</a></li>
						<li><span></span></li>
						<li><a href="latest_products.php?search=<?php echo $search; ?>">Latest</a></li>
						<li><span></span></li>
						<li><a href="topsales_products.php?search=<?php echo $search; ?>"  class="active">Top Sales</a></li>
					</ul>
					</div>
					<!--TABLE MENU END-->
					<!--DISPLAY DATA START-->
					<div class="view-section">
						<div class="wrapper">
							<div class="view_main">
								<div class="view_wrap grid-view" style="display: block;">
									<?php 
									if (mysqli_num_rows($result)==0){
										echo '<h2 style="color:#f4623a;">Result Not Found</h2>';
									}else{
										while($row = mysqli_fetch_array($result)){
									?>
									<div class="view_item">
										<div class="vi_left">
											<!-- PRODUCT IMAGE START-->
											<a href="topsales_products_preview.php?product=<?php echo $row['Product_ID']; ?>&search=<?php echo $search ?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
											<!--PRODUCT IMAGE END-->
										</div>
										<div class="vi_right">
											<p class="content name"><?php echo $row['Product_Name']; ?></p>
											<p class="content price"><i class="fa fa-tag" aria-hidden="true"></i> ₱<?php echo $row['Price']; ?></p>
											<!--RATING START-->
											<p class="content rating">
												<?php
													echo "<i class='fa fa-star' aria-hidden='true'></i>";
												?>
											</p>
											<!--RATING END-->
											<!--STOCKS START-->
												<?php if($row['Stocks'] == 0){
													echo '<p class="content" style="color:red; font-size:17px;">Sold out</p>';
												}else{
													echo '<p class="content" style="color:gray; font-size:17px;">Stocks:'.$row['Stocks'].'</p>';
												}
												?>	
											<!--STOCKS END-->
											<p class="content">
												<table>
													<tr>
														<!--MY LIKES START-->
														<td class="wishlist"><a href="../../server/costumer_like_product.php?searchtopsalesproduct=<?php echo $search ?>&product=<?php echo $row['Product_ID'] ?>">
															<?php
															if (isset($_SESSION['UserAccount_ID'])){
															$useraccount_id = $_SESSION['UserAccount_ID'];

															$sqluser ="SELECT `CostumerProfile_ID` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";

															$resultuser = mysqli_query($conn, $sqluser);
															
															while ($rows = $resultuser->fetch_assoc()) {
	   												 		$costumerprofileid= $rows['CostumerProfile_ID'];
															}												
															}

															$product_id=$row['Product_ID'];

															$sql ="SELECT * FROM `costumerslike` WHERE `Product_ID` = '$product_id' AND CostumerProfile_ID = '$costumerprofileid'";
															$sqlresult = mysqli_query($conn, $sql);

																if (mysqli_num_rows($sqlresult)> 0) {
																$resultlike = '<i class="fa fa-heart wish" aria-hidden="true"></i>';
																
																}else{
																	$resultlike = '<i class="fa fa-heart-o wish" aria-hidden="true"></i>';
																}
																echo $resultlike  
															?></a> Like</td>
														<!--MY LIKES END-->
														<!--SOLD START-->
														<td class="sold"><?php echo $row['Sold']." Sold"?></td>
														<!--SOLD END-->
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
			</div>
		</div>
	<!---MAIN CONTAINER END-->
<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
    #Success
    if($notification=='Like'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      iconHtml: "♥",
      iconColor: "#f4623a",
      text: "Added to My Likes.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='Unlike'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      iconHtml: "♡",
      iconColor: "#f4623a",
      text: "Remove to My Likes.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='Error'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error",
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