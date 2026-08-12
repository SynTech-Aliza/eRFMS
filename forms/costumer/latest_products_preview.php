<?php
session_start(); 
include "../../server/latest_products_preview.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/product_preview_te.css">
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
		<!--SECTION PRODUCTS START-->
			<section class="products">
				<!--SEARCH FUNCTION START-->
				<form method="post">
					<a href="latest_products.php?search=<?php echo $search; ?>" class="back"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
					<input class="search" type="text" name="product" value="" autocomplete="off" placeholder="Search">
					<button class="search-btn" type="submit" name="search"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>	
				</form>
				<!--SEARCH FUNCTION END-->
				<!--VIEW SECTION START-->
				<div class="view-section">
				<!--IMAGE SLIDER START-->
					<div class="slider">
						<div class="slides">
							<!--RADIO BUTTON START-->
					        <input type="radio" name="radio-btn" id="radio1">
					        <input type="radio" name="radio-btn" id="radio2">
					        <input type="radio" name="radio-btn" id="radio3">
					        <input type="radio" name="radio-btn" id="radio4">
					        <input type="radio" name="radio-btn" id="radio5">
					        <input type="radio" name="radio-btn" id="radio6">
			          		<!--RADIO BUTTON END-->
					        <!--SLIDE IMAGES START-->
					        <div class="slide first">
					          <img src="../../style/assets/products/<?php echo $cover_photo?>" alt="">
					        </div>
					        <div class="slide">
					          <img src="../../style/assets/products/<?php echo $image1?>" alt="">
					        </div>
					        <div class="slide">
					          <img src="../../style/assets/products/<?php echo $image2?>" alt="">
					        </div>
					        <div class="slide">
					          <img src="../../style/assets/products/<?php echo $image3?>" alt="">
					        </div>
					        <div class="slide">
					          <img src="../../style/assets/products/<?php echo $image4?>" alt="">
					        </div>
					        <div class="slide">
					          <img src="../../style/assets/products/<?php echo $image5?>" alt="">
					        </div>
					        <!---SLIDE IMAGES END-->
				        	<!---AUTOMATIC NAVIGATION START-->
				          	<div class="navigation-auto">
						        <div class="auto-btn1"></div>
						        <div class="auto-btn2"></div>
						        <div class="auto-btn3"></div>
						        <div class="auto-btn4"></div>
						        <div class="auto-btn5"></div>
						        <div class="auto-btn6"></div>
				          	</div>
				          	<!---AUTOMATIC NAVIGATION END-->
			          	</div>  
			          	<!----MANUAL NAVIGATION START-->
			            <div class="navigation-manual">
				            <label for="radio1" class="manual-btn"></label>
				            <label for="radio2" class="manual-btn"></label>
				            <label for="radio3" class="manual-btn"></label>
				            <label for="radio4" class="manual-btn"></label>
				            <label for="radio5" class="manual-btn"></label>
				            <label for="radio6" class="manual-btn"></label>
			            </div>
			            <!----MANUAL NAVIGATION END-->
			        </div>
			        <!--IMAGE SLIDER END-->
					<!--PRODUCT DETTAILS START-->
					<div class="details">
					  <p class="content name"><?php echo $product_name?></p>
					  <p class="content price">₱<?php echo $price?></p>
					  <!--RATING START-->
					  <p class="content">
					    <table class="rating_table">
					     	<tr>
					        <td class="rating">
					          <?php
					          	echo "<i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i><i class='fa fa-star' aria-hidden='true'></i>";
					          ?>
					        </td>
					        <!--SOLD START-->
					        <td class="sold"><?php echo "1K Sold (Testing)"; ?></td>
					        <!--SOLD END-->
					        <!--MY LIKE START-->
					        <td class="like"><a href="../../server/costumer_like_product.php?product=<?php echo $product; ?>&searchlatestproductspreview=<?php echo $search; ?>">
					        <?php
					          if (isset($_SESSION['UserAccount_ID'])){
											$useraccount_id = $_SESSION['UserAccount_ID'];

											$sqluser ="SELECT `CostumerProfile_ID` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";
											$resultuser = mysqli_query($conn, $sqluser);
										
											while ($rows = $resultuser->fetch_assoc()) {
   											$costumerprofileid= $rows['CostumerProfile_ID'];
												}												
										}

										$sql ="SELECT * FROM `costumerslike` WHERE `Product_ID` = '$product_id' AND CostumerProfile_ID = '$costumerprofileid'";
										$sqlresult = mysqli_query($conn, $sql);

										if (mysqli_num_rows($sqlresult)> 0) {
											$resultlike = '<i class="fa fa-heart wish" aria-hidden="true"></i>';
										}else{
											$resultlike = '<i class="fa fa-heart-o wish" aria-hidden="true"></i>';
										}
										echo $resultlike
					         ?>
					         	</a></td>
					          <!--MY LIKE END-->
					          <!--SHARE START-->
					          <td class="share"><a href="latest_products_preview.php?product=<?php echo $product ?>&search=<?php echo $search?>&notification=Share"><i class="fa fa-share" aria-hidden="true"></i></a></td>
					          <!--SHARE START-->
					          <!--MESSAGE START-->
					          <td class="message"><a href="#message"><i class="fa fa-commenting" aria-hidden="true"></i></a></td>
					          <!--MESSAGE END-->
					        </tr>
					      </table>
					    </p>
					    <!--RATING END-->
					    <p class="content">
					        <table class="stocks_table">
					          	<tr>
					          	 	<td class="product">
					          	 		<!--STOCKS START-->
													<?php
													if($stocks == 0){
														echo '<span>Sold out</span>';
													}else{
														echo $stocks;
													}
													?>	
													<!--STOCKS END-->
													<br><p>Products</p>
												</td>
					          	 	<!--RATING START-->	
					          	 	<td class="ratings">
						          	 	<?php
						          	 		echo "5.0"
						          	 	?>
													<br>
													<p>Rating</p>
					          	 	</td>
					          	 	<!--RATING END-->
					          	 	<td>100% <br> <p>Quality</p></td>
					          	</tr>
					        </table>
					    </p>
					    <p class="content product_label">Product Details</p>
					    <p class="content">
					      <table class="product_details_table">
					        <tr>
					          <td class="product_label_details">Stocks</td>
					          <td class="display_details"><?php echo $stocks?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Ships From</td>
					          <td class="display_details">Anywhere in the Philippines</td>
					        </tr>
					        <tr>
					         	<td class="product_label_details">Brand</td>
					          <td class="display_details"><?php echo $brand?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Materials</td>
					          <td class="display_details"><?php echo $materials?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Furniture Type</td>
					          <td class="display_details"><?php echo $furniture_type?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Style</td>
					          <td class="display_details"><?php echo $style?></td>
					        </tr>
					        <tr>
					         	<td class="product_label_details">Color</td>
					          <td class="display_details"><?php echo $color?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Height</td>
					          <td class="display_details"><?php echo $height?>m</td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Width</td>
					          <td class="display_details"><?php echo $width?>m</td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Weight</td>
					          <td class="display_details"><?php echo $weight?>kg</td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Model</td>
					         	<td class="display_details"><?php echo $model?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details">Pattern</td>
					          <td class="display_details"><?php echo $pattern?></td>
					        </tr>
					        <tr>
					          <td class="product_label_details description">Description</td>
					          <td class="display_details"><div class="description_text" style=""><?php echo $description ?></div></td>
					        </tr>
					     </table>
					  </p>	
					</div>
					<!--PRODUCT DETAILS END-->
					<!--RATINGS START-->
					<div>
					  <p class="content rating_label">Product Ratings & Comments</p>
					   	<table class="table_product_ratings">
					      <tr>
					       	<td class="rating_result">
							      <?php
							        echo "<i class='fa fa-star wish' aria-hidden='true'></i><i class='fa fa-star wish' aria-hidden='true'></i><i class='fa fa-star wish' aria-hidden='true'></i><i class='fa fa-star wish' aria-hidden='true'></i><i class='fa fa-star wish' aria-hidden='true'></i> 3.0/5 <label class='reviews'>(Number who Reviews)</label>";
										?>
							    </td>
							    <!--SEE ALL START-->
							    <td class="seeall_rating">
							      <a href="#seellrating">See All<i class="arrow"></i></a>
							    </td>
							    <!--SEE ALL END-->
					      </tr>
					    </table>
						  <!--RATINGS END-->
					    <!--COMMENTS DISPLAY START-->
					 		<table class="comments_table">
					 		<?php
								#echo '<p class="empty">Empty</p>';
							?>
					      <tr>
					       	<td class="profile_picture"><img src="../../style/assets/profiles/avatar.png"><span class="username"> <?php echo "Testing user"; ?></span></td>
					    	</tr>
					    	<tr>
							   	<td class="rating_table_four rates">
							    <?php
							    	echo '<i class="fa fa-star wish" aria-hidden="true"></i><i class="fa fa-star wish" aria-hidden="true"></i><i class="fa fa-star wish" aria-hidden="true"></i><i class="fa fa-star wish" aria-hidden="true"></i><i class="fa fa-star wish" aria-hidden="true"></i>';
							    ?>
							    </td>
					      </tr>
					      <tr>
							   	<td class="comment"><div class="costumer_comment"><?php echo "Testing"; ?></div></td>
								</tr>
								<tr>
							   	<td class="costumers_media">
							   		<?php 
							   			$media = "5";

							   			if($media == 5){
							   				echo "<img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'>";
							   			}elseif($media == 4){
							   				echo "<img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'>";
							   			}elseif($media == 3){
							   				echo "<img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'>";
							   			}elseif($media == 2){
							   				echo "<img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'>";
							   			}elseif($media == 1){
							   				echo "<img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'><img src='../../style/assets/profiles/avatar.png'>";
							   			}else{
							   				echo "";
							   			}
							   		?></td>
								</tr>
							<?php
							?>
					    </table>
					    <!--COMMENTS DISPLAY END-->
					    <!--SEE ALL START-->
					    <div class="seeall_comments">
					       	<a href="#seeallcomments"><p>See All <i class="arrow"></i></p></a>
					    </div>
					    <!--SEE ALL END-->
					</div>
					<!--COMMENTS DISPLAY END--> 
				</div>
				<!--VIEW SECTION END-->
			</section>
				<!--SECTION PRODUCTS END-->
				<!--BUTTON OPTIONS START-->
				<div class="button_options">
					<table class="buttons_table" >
						<tr>
							<!--CHAT START-->
						    <td class="chat"><a href="#message"><i class="fa fa-commenting" aria-hidden="true"></i><br>Chat Now</a></td>
						    <!--CHAT END-->
						    <!--CART START-->
						    <td class="cart"><a href="../../server/costumer_addtocart_product.php?latestproduct=<?php echo $product; ?>&searchlatestaddtocartproduct=<?php echo $search; ?>"><i class="fa fa-cart-plus" aria-hidden="true"></i><br>Add to Cart</a></td>
						    <!--CART END-->
								<!--PURCHASING FORM START-->
								<form method="post">
									<div class="popup" id="popup-1">
			  							<div class="overlay"></div>
			  							<div class="content">
				    						<div class="close-btn" onclick="togglePopup()">×</div>
				    						<div class="product_image"><img src="../../style/assets/products/<?php echo $cover_photo?>"></div>
				    						

				    						<div class="product_name"><?php echo $product_name?></div>
				    						<div class="product_price">₱<?php echo $price?></div>
				    						<div class="product_stock">Stocks: <?php echo $stocks?></div>
				    						<div class="quantity">Quantity<input type="number" name="quantity" required=""></div>

				    						<button class="btn_buynow" type="submit" name="buy_now">Buy Now</button>
			  							</div>
									</div>
								</form>
								<!--PURCHASING FORM END-->
							<!--BUY START-->
						    <td class="buy_now">
						    	<button onclick="togglePopup()"><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>Buy Now</button>
						    </td>
						    <!--BUY END-->
						</tr>
					</table>
				</div>
			<!--BUTTON OPTIONS END-->
		</div>
	</div>
	<!---MAIN CONTAINER END-->
<script type="text/javascript">
  function togglePopup(){
  document.getElementById("popup-1").classList.toggle("active");
}
</script>
	<script type="text/javascript">
    var counter = 1;
    setInterval(function(){
      document.getElementById('radio' + counter).checked = true;
      counter++;
      if(counter > 6){
        counter = 1;
      }
    }, 5000);
  </script>

<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
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
  }elseif($notification=='Share'){
  	echo '<script type="text/javascript">
	  Swal.fire({
	  text: "Shares",
	  showConfirmButton: false,
	  showCloseButton: true,
	  input: "text",
	  inputValue: "http://localhost/RoseFurnitureSystem/forms/costumer/relevance_products_preview.php?product='.$product.'&search='.$search.'",
		})
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
  }elseif($notification=='EmptyStocks'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Sorry this Product is out of Stocks.",
    showConfirmButton: false,
    timer: 1500
  });
    </script>';
  }elseif($notification=='OverlyQuantity'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "The amount that you entered is overly to our stocks. Please try it again.",
    showConfirmButton: false,
    timer: 2500
  });
    </script>';
  }elseif($notification=='PlaceOrder'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Place Order.",
    showConfirmButton: false,
    timer: 2500
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