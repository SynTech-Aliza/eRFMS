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


	#RELEVANCE PRODUCTS PREVIEW
	if( (isset($_GET['relevenaceproduct'])) && (isset($_GET['searchrelevanceaddtocartproduct'])) ){
		$relevenaceproduct = $_GET['relevenaceproduct'];
		$searchrelevanceaddtocartproduct = $_GET['searchrelevanceaddtocartproduct'];
		
		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$relevenaceproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}

		if($stocks == 0){
			header("Location: ../forms/costumer/relevance_products_preview.php?product=$relevenaceproduct&search=$searchrelevanceaddtocartproduct&notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
			$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$relevenaceproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/relevance_products_preview.php?product=$relevenaceproduct&search=$searchrelevanceaddtocartproduct&notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/relevance_products_preview.php?product=$relevenaceproduct&search=$searchrelevanceaddtocartproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/relevance_products_preview.php?product=$relevenaceproduct&search=$searchrelevanceaddtocartproduct&notification=ErrorAlter");
			}
		}
	}

	#LATEST PRODUCTS PREVIEW
	if( (isset($_GET['latestproduct'])) && (isset($_GET['searchlatestaddtocartproduct'])) ){
		$latestproduct = $_GET['latestproduct'];
		$searchlatestaddtocartproduct = $_GET['searchlatestaddtocartproduct'];
		
		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$latestproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}

		if($stocks == 0){
			header("Location: ../forms/costumer/latest_products_preview.php?product=$latestproduct&search=$searchlatestaddtocartproduct&notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
			$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$latestproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/latest_products_preview.php?product=$latestproduct&search=$searchlatestaddtocartproduct&notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/latest_products_preview.php?product=$latestproduct&search=$searchlatestaddtocartproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/latest_products_preview.php?product=$latestproduct&search=$searchlatestaddtocartproduct&notification=ErrorAlter");
			}
		}
	}



	#MY PURCHASES
	if(isset($_GET['mypurchaseproduct'])){
		$mypurchaseproduct = $_GET['mypurchaseproduct'];

		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$mypurchaseproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}
		if($stocks == 0){
			header("Location: ../forms/costumer/my_purchases.php?notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$mypurchaseproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/my_purchases.php?product=$mypurchaseproduct&notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/my_purchases.php?product=$mypurchaseproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/my_purchases.php?product=$mypurchaseproduct&notification=ErrorAlter");
			}
		}
	}

	#TOP PRODUCTS PREVIEW
	if(isset($_GET['topproduct'])){
		$topproduct = $_GET['topproduct'];

		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$topproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}
		if($stocks == 0){
			header("Location: ../forms/costumer/top_products_sold_preview.php?notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$topproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/top_products_sold_preview.php?product=$topproduct&notification=ErrorAlter");
			}
		}
	}

	#MY LIKES PREVIEW
	if(isset($_GET['mylikesproduct'])){
		$mylikesproduct = $_GET['mylikesproduct'];

		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$mylikesproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}
		if($stocks == 0){
			header("Location: ../forms/costumer/my_likes_preview.php?notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$mylikesproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikesproduct&notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikesproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/my_likes_preview.php?product=$mylikesproduct&notification=ErrorAlter");
			}
		}
	}

	#SHOPPING CART PREVIEW
	if(isset($_GET['shoppingcartproduct'])){
		$shoppingcartproduct = $_GET['shoppingcartproduct'];

		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$shoppingcartproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}
		if($stocks == 0){
			header("Location: ../forms/costumer/shopping_cart_preview.php?notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$shoppingcartproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/shopping_cart_preview.php?product=$shoppingcartproduct&notification=AddToCart");
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

		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$buyagainproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}
		if($stocks == 0){
			header("Location: ../forms/costumer/buy_again_preview.php?notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$buyagainproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/buy_again_preview.php?product=$buyagainproduct&notification=ErrorAlter");
			}
		}
	}

	#BUY AGAIN 
	if(isset($_GET['costumerbuyagainproduct'])){
		$costumerbuyagainproduct = $_GET['costumerbuyagainproduct'];

		$sqlcheckstocks ="SELECT * FROM products WHERE Product_ID ='$costumerbuyagainproduct'";
		$resultstocks = mysqli_query($conn, $sqlcheckstocks);
			while($row = mysqli_fetch_assoc($resultstocks)){
				$stocks = $row['Stocks'];
			}
		if($stocks == 0){
			header("Location: ../forms/costumer/buy_again.php?notification=EmptyStocks");
		}else{
			$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersshoppingcart` (`CostumerProfile_ID`, `Product_ID`) VALUES ('$costumerprofile_id','$costumerbuyagainproduct')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../forms/costumer/buy_again.php?notification=AddToCart");
				}else{
					header("Location: ../forms/costumer/buy_again.php?notification=Error");
				}
			}else{
				header("Location: ../forms/costumer/buy_again.php?notification=ErrorAlter");
			}
		}
	}
}
?>