<?php
session_start(); 
include "../../server/shopping_cart.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/shopping_cart.css">
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
				<section class="shopping_cart">
					<p class="label"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Shopping Cart</p>
					<!--DISPLAY DATA START-->
					<div class="view-section">
						<div class="wrapper">
							<div class="view_main">
								<div class="view_wrap list-view" style="display: block;">
								<?php 
								if(mysqli_num_rows($sqlresultshoppingcart) == 0){
								echo '<h2 style="text-align:center; color:#f4623a;">Empty</h2>';
								}else{
									while ($row = $sqlresultshoppingcart->fetch_assoc()) {
								?>
									<a class="remove_link" href="../../server/delete_shoppingcart_product.php?productremove=<?php echo $row['Product_ID'];?>"><i class="fa fa-close remove" aria-hidden="true"></i></a>
									<div class="view_item">
										<!--CHECKBOX START-->
										<input class="checkitem" type="checkbox" name="product[]" value="<?php echo $row['Product_ID'];?>">
										<!--CHECKBOX END-->
										<div class="vi_left">
											<!-- PRODUCT IMAGE START-->
											<a href="shopping_cart_preview.php?product=<?php echo $row['Product_ID']; ?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
											<!--PRODUCT IMAGE END-->
										</div>
										<div class="vi_right">
											<p class="content name"><?php echo $row['Product_Name'];?></p>
											<p class="content price" ><i class="fa fa-tag" aria-hidden="true"></i> ₱<?php echo $row['Price'];?></p>
											<p class="content details"><?php echo $row['Brand'].", ".$row['Materials'].", ".$row['Furniture_Type'].", ".$row['Style'].", ".$row['Color'].", ".$row['Height']."m, ".$row['Width']."m, ".$row['Weight']."kg, ".$row['Model'].", ".$row['Pattern'];?></p>
											<p class="content stocks">Stocks: <?php if($row['Stocks']== 0){
												echo "<span>Sold Out</span>";
											}else{
												echo $row['Stocks'];
											} ?></p>
											<p><div class="quantity">
												<!--REMOVE QUANTITY START-->
												<a href="../../server/shopping_cart.php?productminus=<?php echo $row['Product_ID'];	 ?>"><i class="fa fa-minus minus" aria-hidden="true"></i></a>
												<!--REMOVE QUANTITY END-->
												<input type="text" class="totalquantity" name="quantity" value="<?php echo $row['Quantity'];?>" readonly="yes">
												<!--ADD QUANTITY START-->
												<a href="../../server/shopping_cart.php?productplus=<?php echo $row['Product_ID'];	 ?>"><i class="fa fa-plus plus" aria-hidden="true"></i></a>
												<!--ADD QUANTITY END-->
											</div></p>
										</div>
									</div>
									<?php 
										}
									}
									?>
								<!--INVALID LIST START-->
								<div class="invalid_list">
								<?php 
								if(mysqli_num_rows($sqlresultinvalidshoppingcartlist) == 0){
									echo '<h2 style="text-align:center; color:#f4623a;"></h2>';
								}else{
									while ($row = $sqlresultinvalidshoppingcartlist->fetch_assoc()) {
								?>
									<p><i class="fa fa-list" aria-hidden="true"></i><i class="fa fa-close close" aria-hidden="true"></i> Invalid Products</p>
									<a class="remove_link" href="../../server/delete_shoppingcart_product.php?productremove=<?php echo $row['Product_ID'];?>"><i class="fa fa-close remove" aria-hidden="true"></i></a>
									<div class="view_item">
										<div class="vi_left">
											<!-- PRODUCT IMAGE START-->
											<a href="shopping_cart_preview.php?product=<?php echo $row['Product_ID']; ?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
											<!--PRODUCT IMAGE END-->
										</div>
										<div class="vi_right">
											<p class="content name"><?php echo $row['Product_Name'];?></p>
											<p class="content price" ><i class="fa fa-tag invalid_tag" aria-hidden="true"></i> ₱<?php echo $row['Price'];?></p>
											<p class="content details"><?php echo $row['Brand'].", ".$row['Materials'].", ".$row['Furniture_Type'].", ".$row['Style'].", ".$row['Color'].", ".$row['Height'].", ".$row['Width'].", ".$row['Weight'].", ".$row['Model'].", ".$row['Pattern'];?></p>
											<p class="content stocks">
											<?php if($row['Stocks']== 0){
												echo "<span>Out of stock</span>";
											}else{
												echo $row['Stocks'];
											} ?></p>
											<p><div class="quantity">
												<!--REMOVE QUANTITY START-->
												<i class="fa fa-minus minus" aria-hidden="true"></i>
												<!--REMOVE QUANTITY END-->
												<input type="text" class="totalquantity" name="quantity" value="<?php echo $row['Quantity'];?>" readonly="yes">
												<!--ADD QUANTITY START-->
												<i class="fa fa-plus plus" aria-hidden="true"></i>
												<!--ADD QUANTITY END-->
											</div></p>
										</div>
									</div>
									<?php 
										}
									}
									?>
									</div>
									<!--INVALID LIST END-->
								</div>
							</div>
						</div>
					</div>
					<!--DISPLAY DATA END-->
					<div class="checkout">
						<table>
							<tr>
								<td class="checkall">
									<input type="checkbox" id="checkAll"> Check all
								</td>
								<td rowspan="2" class="button_checkout">
									<button type="submit" class="check_out" name="checkout">Check Out (<span id="selected">0</span>)</button>
								</td>
							</tr>
						</table>
					</div>
				</section>
			</form>
		</div>
	</div>
	<!---MAIN CONTAINER END-->
	<script>
	const selectedElm = document.getElementById('selected');
	$("#checkAll").click(function () {
		$('input:checkbox').not(this).prop('checked', this.checked);

		selectedElm.innerHTML = document.querySelectorAll("input[name='product[]']:checked").length;
 	});
	function showChecked(){
	  selectedElm.innerHTML = document.querySelectorAll("input[name='product[]']:checked").length;
	}
	document.querySelectorAll("input[name='product[]']").forEach(i=>{
	 i.onclick = () => showChecked();
	});
  </script>

<?php
$notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Success
  if($notification=='Remove'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Remove from Shopping Cart",
    showConfirmButton: false,
    timer: 2500
  });
    </script>';
  }elseif($notification=='EmptyCostumerProfile'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Empty Costumer Profile.",
    showConfirmButton: false,
    timer: 1500
  });
    </script>';
  }elseif($notification=='EmptyDefaultAddress'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Empty Default Address.",
    showConfirmButton: false,
    timer: 1500
  });
    </script>';
  }elseif($notification=='Error'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error.",
    showConfirmButton: false,
    timer: 1500
  });
    </script>';
  }elseif($notification=='Checkout'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Check Out Order.",
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
