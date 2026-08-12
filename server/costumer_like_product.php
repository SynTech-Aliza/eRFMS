<?php
include "connection/db_conn.php";
session_start();

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$resultcostumer = mysqli_query($conn, $sql);
	if (mysqli_num_rows($resultcostumer)==0){
		$costumerprofile_id ="";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($resultcostumer)){
			$costumerprofile_id = $row['CostumerProfile_ID'];
		}
	}


	#RELEVANCE PRODUCTS
	if( (isset($_GET['searchrelevanceproduct'])) && (isset($_GET['product'])) ){
		$searchrelevanceproduct = $_GET['searchrelevanceproduct'];
		$product = $_GET['product'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$product' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$product' ";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/relevance_products.php?search=$searchrelevanceproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/relevance_products.php?search=$searchrelevanceproduct&notification=Error");
			}
		}else{
			$sqlalert ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalert)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$product')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/relevance_products.php?search=$searchrelevanceproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/relevance_products.php?search=$searchrelevanceproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/all_products.php?search=$searchallproducts&notification=ErrorAlter");
			}
		}
	}

	#LATEST PRODUCTS
	if( (isset($_GET['searchlatestproduct'])) && (isset($_GET['product'])) ){
		$searchlatestproduct = $_GET['searchlatestproduct'];
		$product = $_GET['product'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$product' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$product' ";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/latest_products.php?search=$searchlatestproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/latest_products.php?search=$searchlatestproduct&notification=Error");
			}
		}else{
			$sqlalert ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalert)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$product')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/latest_products.php?search=$searchlatestproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/latest_products.php?search=$searchlatestproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/all_products.php?search=$searchallproducts&notification=ErrorAlter");
			}
		}
	}

	#TOPSALES PRODUCTS
	if( (isset($_GET['searchtopsalesproduct'])) && (isset($_GET['product'])) ){
		$searchtopsalesproduct = $_GET['searchtopsalesproduct'];
		$product = $_GET['product'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$product' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$product' ";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/topsales_products.php?search=$searchtopsalesproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/topsales_products.php?search=$searchtopsalesproduct&notification=Error");
			}
		}else{
			$sqlalert ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalert)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$product')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/topsales_products.php?search=$searchtopsalesproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/topsales_products.php?search=$searchtopsalesproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/all_products.php?search=$searchallproducts&notification=ErrorAlter");
			}
		}
	}

	#MY LIKES 
	if(isset($_GET['costumerlikeproduct'])){
	$costumerlikeproduct = $_GET['costumerlikeproduct'];

	$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$costumerlikeproduct' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$costumerlikeproduct' ";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/my_likes.php?notification=Unlike");
			}else{
				header("Location: ../forms/costumer/my_likes.php?notification=Error");
			}
		}else{
			header("Location: ../forms/costumer/my_likes.php?notification=Error");
		}
	}


	#RELEVANCE PRODUCTS PREVIEW
	if( (isset($_GET['searchrelevanceproductspreview'])) && (isset($_GET['product'])) ){
		$searchrelevanceproductspreview = $_GET['searchrelevanceproductspreview'];
		$product = $_GET['product'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$product' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$product' ";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchrelevanceproductspreview&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchrelevanceproductspreview&notification=Error");
			}
		}else{
			$sqlalter ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$product')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchrelevanceproductspreview&notification=Like");
				}else{
					header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchrelevanceproductspreview&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchrelevanceproductspreview&notification=ErrorAlter");
			}
		}
	}

	#LATEST PRODUCTS PREVIEW
	if( (isset($_GET['searchlatestproductspreview'])) && (isset($_GET['product'])) ){
		$searchlatestproductspreview = $_GET['searchlatestproductspreview'];
		$product = $_GET['product'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$product' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$product' ";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchlatestproductspreview&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchlatestproductspreview&notification=Error");
			}
		}else{
			$sqlalter ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$product')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchlatestproductspreview&notification=Like");
				}else{
					header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchlatestproductspreview&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$product&search=$searchlatestproductspreview&notification=ErrorAlter");
			}
		}
	}

	#TOP PRODUCTS PREVIEW
	if(isset($_GET['topproduct'])){
		$topproduct = $_GET['topproduct'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$topproduct' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$topproduct'";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=Error");
			}
		}else{
			$sqlalter ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$topproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=ErrorAlter");
			}
		}
	}

	#MY LIKES PREVIEW
	if(isset($_GET['mylikeproduct'])){
		$mylikeproduct = $_GET['mylikeproduct'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$mylikeproduct' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$mylikeproduct'";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikeproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikeproduct&notification=Error");
			}
		}else{
			$sqlalter ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$mylikeproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikeproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikeproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikeproduct&notification=ErrorAlter");
			}
		}
	}

	#SHOPPING CART PREVIEW
	if(isset($_GET['shoppingcartproduct'])){
		$shoppingcartproduct = $_GET['shoppingcartproduct'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$shoppingcartproduct' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$shoppingcartproduct'";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/shopping_cart_preview.php?product=$shoppingcartproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/shopping_cart_preview.php?product=$shoppingcartproduct&notification=Error");
			}
		}else{
			$sqlalter ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$shoppingcartproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/shopping_cart_preview.php?product=$shoppingcartproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/shopping_cart_preview.php?product=$shoppingcartproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/shopping_cart_preview.php?product=$shoppingcartproduct&notification=ErrorAlter");
			}
		}
	}

	#BUY AGAIN PREVIEW
	if(isset($_GET['buyagainproduct'])){
		$buyagainproduct = $_GET['buyagainproduct'];

		$sqlcheck= "SELECT * FROM costumerslike WHERE Product_ID = '$buyagainproduct' AND CostumerProfile_ID = '$costumerprofile_id'";

		$resultcheck = mysqli_query($conn, $sqlcheck);
		if (mysqli_num_rows($resultcheck)>0) {
			$sql="DELETE FROM `costumerslike` WHERE CostumerProfile_ID  = '$costumerprofile_id' AND Product_ID = '$buyagainproduct'";
			if($result = mysqli_query($conn, $sql)){
				header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=Unlike");
			}else{
				header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=Error");
			}
		}else{
			$sqlalter ="ALTER TABLE costumerslike AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumerslike` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$buyagainproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=Like");
				}else{
					header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=ErrorAlter");
			}
		}
	}
}

?>