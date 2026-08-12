<?php
session_start(); 
include "../../server/my_likes.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/my_likes.css">
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
			<section class="my_likes">
				<!--SEARCH FUNCTION START-->
				<form method="post">
					<p class="label"><i class="fa fa-heart" aria-hidden="true"></i> My Likes</p>

					<input class="search" type="text" value="<?php if(empty($search)){
						echo "";
					}else{
						echo $search;
					} ?>"name="searchmylike" autocomplete="off" placeholder="Search">
					<button class="search-btn" type="submit" name="search"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>	
				</form>
				<!--SEARCH FUNCTION END-->
				<!--DISPLAY DATA START-->
				<div class="view-section">
					<div class="wrapper">
						<div class="view_main">
							<div class="view_wrap grid-view" style="display: block;">
							<?php 
							if(mysqli_num_rows($sqlresultcostumerlike) == 0){
								echo '<h2 style="color:#f4623a;">Empty</h2>';
							}else{
								while ($row = $sqlresultcostumerlike->fetch_assoc()) {
							?>
								<div class="view_item">
									<div class="vi_left">
										<!-- PRODUCT IMAGE START-->
										<a href="my_likes_preview.php?product=<?php echo $row['Product_ID']; ?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
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
										<!--MY LIKES START-->
										<p class="content">
											<table>
												<tr>
													<!--MY LIKES START-->
													<td class="wishlist"><a href="../../server/costumer_like_product.php?costumerlikeproduct=<?php echo $row['Product_ID'] ?>">
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
													echo $resultlike  ?></a> Like</td>
													<!--MY LIKES END-->
													<!--SOLD START-->
													<td class="sold">5K Sold</td>
													<!--SOLD END-->
												</tr>
											</table>
										</p>
										<!--MY LIKES END-->
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
    if($notification=='Unlike'){
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
