<?php
session_start();
include "../../server/connection/db_conn.php";
include "../../server/dashboard_costumer.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/dashboard.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!--NAVIGATION BAR START-->
	<?php include 'navigationbar.php'; ?>
	<!---NAVIGATION BAR END-->
	<!--MAIN CONTAINER START-->
	<div class="main-container">
		<!---SUB MENU NAVIGATION START-->
		<div class="card">
			<section class="feeds">
				<!--SEARCH BAR START-->
				<form method="post">
					<input class="search" type="text" name="product" autocomplete="off" placeholder="Search">
					<button class="search-btn" type="submit" name="search"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>	
				</form>
				<!--SEARCH BAR END-->
					<!--SLIDER SECTION START-->
					<div class="slider">
						<div class="slides">
					    	<!--RADIO BUTTON START-->
					      	<input type="radio" name="radio-btn" id="radio1">
					      	<input type="radio" name="radio-btn" id="radio2">
					      	<input type="radio" name="radio-btn" id="radio3">
					      	<input type="radio" name="radio-btn" id="radio4">
					 		<input type="radio" name="radio-btn" id="radio5">
					 		<input type="radio" name="radio-btn" id="radio6">
					 		<input type="radio" name="radio-btn" id="radio7">
					 		<input type="radio" name="radio-btn" id="radio8">
					 		<input type="radio" name="radio-btn" id="radio9">
					 		<input type="radio" name="radio-btn" id="radio10">
					      	<!--RADIO BUTTON END-->
					      	<!---SLIDE IMAGES START-->
					      	<div class="slide first">
				          		<img class="slide-img" src="../../style/assets/posters/Slide1.jpg" alt="">
				        	</div>
				        	<div class="slide">
				          		<img class="slide-img" src="../../style/assets/posters/Slide2.jpg" alt="">
				        	</div>
				        	<div class="slide">
				          		<img class="slide-img" src="../../style/assets/posters/Slide3.jpg" alt="">
				        	</div>
				       		<div class="slide">
				         		<img class="slide-img" src="../../style/assets/posters/Slide4.jpg" alt="">
				        	</div>
				        	<div class="slide">
				          		<img class="slide-img" src="../../style/assets/posters/Slide5.jpg" alt="">
				        	</div>
				        	<div class="slide">
				          		<img class="slide-img" src="../../style/assets/posters/Slide6.jpg" alt="">
				       	 	</div>
				        	<div class="slide">
				          		<img class="slide-img" src="../../style/assets/posters/Slide7.jpg" alt="">
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
							    <div class="auto-btn7"></div>
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
				          	<label for="radio7" class="manual-btn"></label>
						</div>
	          			<!----MANUAL NAVIGATION END-->
	        	</div>
	       		<!--SLIDER SECTION END-->
	       		<!--TOP PRODUCTS SECTION START-->
	        	<div class="top-products">
	        		<h3>TOP PRODUCTS SOLD</h3>
	        		<!--WRAPPER START-->
	        		<div class="wrapper-feeds">
	        		<?php
					if (mysqli_num_rows($resulttopproducts)==0){
						echo '';
					}else{
						while ($row = mysqli_fetch_array($resulttopproducts)){
					?>
						<div class="item">
							<div class="view_main">
								<div class="view_wrap grid-view" style="display: block;">
									<div class="view_item">
										<div class="logo">
											<p>TOP</p>
										</div>
											<div class="vi_left">
												<!----DISPLAY TOP IMAGES START-->
												<a href="top_products_sold.php"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
												<!----DISPLAY TOP IMAGES END-->
											</div>
											<div class="vi_right">
												<p class="content name"><?php echo $row['Product_Name']; ?></p>
												<!---DETAILS SOLD START-->
												<p class="content sold">
												<?php 
												if($row['Sold'] > 1000){
													echo "1K+ Sold";
												}elseif($row['Sold'] > 2000){
													echo "2K+ Sold";
												}elseif($row['Sold'] > 3000){
													echo "3K+ Sold";
												}elseif($row['Sold'] > 4000){
													echo "4K+ Sold";
												}elseif($row['Sold'] > 5000){
													echo "5K+ Sold";
												}else{
													echo $row['Sold']." Sold";
												}
													 ?></p>
												<!---DETAILS SOLD END-->
											</div>
									</div>
								</div>
							</div>
						</div>
					<?php
						}
					}
					?>
						<div class="item">
							<div class="view_main">
								<div class="view_wrap grid-view" style="display: block;">
									<div class="view_item">
										<div class="vi_right see_more_opt">
											<a href="top_products_sold.php"><i class="fa fa-arrow-right arrow" aria-hidden="true"></i>
											<p class="see_more_name">See More</p></a>
										</div>
									</div>
								</div>
							</div>	
						</div>			
	        		</div>
					<!--WRAPPER END-->
	        	</div>
	        	<!--TOP PRODUCTS SECTION END-->
	        	<!--CATEGORY SECTION START-->
	        	<div class="categories">
	        		<h3>CATEGORIES</h3>
	        		<div class="wrapper-category">
						<div class="view_main-category">
							<div class="view_wrap grid-view" style="display: block;">
								<?php
									while ($row = mysqli_fetch_array($resultcategory)):;
								?>
								<div class="view_item category_details">
									<div class="btn-category">
										<a href="relevance_products.php?search=<?php echo $row['Product_Category']; ?>"><button><?php echo $row['Product_Category']; ?></button></a>
									</div>
								</div>
								<?php
									endwhile;
								?>
							</div>
						</div>
					</div>
	        	</div>
	        	<!--CATEGORY SECTION END-->
			</section>
		</div>
	</div>
	<!--MAIN CONTAINER END-->
	<script type="text/javascript">
	  var counter = 1;
	  setInterval(function(){
	    document.getElementById('radio' + counter).checked = true;
	    counter++;
	    if(counter >7){
	      counter = 1;
	    }
	  },5000);
	</script>
<?php	
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>