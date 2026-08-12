<?php
include "connection/db_conn.php";

#START
if (isset($_GET['product'])) {
	$product = $_GET['product'];

	$sql ="SELECT `Product_ID`, `Product_Name`, `Price`, `Stocks`, `Brand`, `Materials`, `Furniture_Type`, `Style`, `Color`, `Height`, `Width`, `Weight`, `Model`, `Pattern`, `Description`, `Cover_Photo`, `Image1`, `Image2`, `Image3`, `Image4`, `Image5` FROM `products` WHERE `Product_ID` = '$product'";

	$sqlresult = mysqli_query($conn, $sql);

	#FOR VALUE TO DISPLAY
	while($row = mysqli_fetch_assoc($sqlresult)){
		$product_id = $row['Product_ID'];
		$product_name = $row['Product_Name'];
		$price = $row['Price'];
		$stocks = $row['Stocks'];
		$brand = $row['Brand'];
		$materials = $row['Materials'];
		$furniture_type = $row['Furniture_Type'];
		$style = $row['Style'];
		$color = $row['Color'];
		$height = $row['Height'];
		$width = $row['Width'];
		$weight = $row['Weight'];
		$model = $row['Model'];
		$pattern = $row['Pattern'];
		$description = $row['Description'];
		$cover_photo = $row['Cover_Photo'];
		$image1 = $row['Image1'];
		$image2 = $row['Image2'];
		$image3 = $row['Image3'];
		$image4 = $row['Image4'];
		$image5 = $row['Image5'];
	}

	#SEARCH PRODUCT
	if (isset($_POST['search'])) {
		$productsearch = $_POST['product'];
		
		if($productsearch ==""){
			header("Location: ../costumer/relevance_products_preview.php?product=$product");	
		}else{
			header("Location: ../costumer/relevance_products.php?search=$productsearch");
		}
	}

	if (isset($_SESSION['Username'])){
		$useraccount_id = $_SESSION['UserAccount_ID'];

		#SELECT COSTUMER PROFILE INFORMATION
		$sqlcostumer ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";
		$resultcostumer = mysqli_query($conn, $sqlcostumer);

		if (mysqli_num_rows($resultcostumer)==0){
			$costumerprofile_id ="";
		}else{
			while($row = mysqli_fetch_assoc($resultcostumer)){
			$costumerprofile_id = $row['CostumerProfile_ID'];
			}
		}

		#SELECT COSTUMER DEFAULT ADDRESS
		$sqlcostumeraddress ="SELECT * FROM `costumersaddress` WHERE `CostumerProfile_ID` = '$costumerprofile_id' AND Status = 'Default'";
		$resultcostumeraddress = mysqli_query($conn, $sqlcostumeraddress);

		if (mysqli_num_rows($resultcostumeraddress)==0){
			$region="";
			$city ="";
		}else{
			while($row = mysqli_fetch_assoc($resultcostumeraddress)){
			$province = $row['Province'];
			$city = $row['City'];
			}
		}

		$costumerdefaultaddress = $province." (".$city.")";
		
		#SELECT SHIPPING FEE
		$sqlshippingfee ="SELECT * FROM `shippingfee` WHERE `Location` = '$costumerdefaultaddress'";
		$resultshippingfee = mysqli_query($conn, $sqlshippingfee);

		while($row = mysqli_fetch_assoc($resultshippingfee)){
			$location = $row['Location'];
			$fee = $row['Fee'];
			$deliverydays = $row['DeliveryDays'];
		}

		#BUY PRODUCTS
		if(isset($_POST['buy_now'])) {
			$quantity = $_POST['quantity'];

			if($costumerprofile_id == ""){
				header("Location: ../costumer/buy_again_preview.php?product=$product&notification=EmptyCostumerProfile");
			}elseif($province == "" && $city == ""){
				header("Location: ../costumer/buy_again_preview.php?product=$product&notification=EmptyDefaultAddress");
			}else{
				#CHECK STOCKS
				$sqlcheckstocks="SELECT * FROM `products` WHERE Product_ID ='$product_id'";
				$resultstocks = mysqli_query($conn, $sqlcheckstocks);
				while($row = mysqli_fetch_assoc($resultstocks)){
					$stocks = $row['Stocks'];
				}

				if($stocks == 0){
					header("Location: ../costumer/buy_again_preview.php?product=$product&notification=EmptyStocks");
				}elseif($stocks < $quantity){
					header("Location: ../costumer/buy_again_preview.php?product=$product&notification=OverlyQuantity");
				}else{	
					#FOR COSTUMERPURCHASE
					$sqlalter ="ALTER TABLE costumerspurchase AUTO_INCREMENT = 1;";
					if($resultalter = mysqli_query($conn, $sqlalter)){
					#ADD TO COSTUMERPURCHASE
					$sqlinsertcostumerpurchase="INSERT INTO `costumerspurchase`(`Purchase_Type`, `CostumerProfile_ID`, `Total_Quantity`, `Fee`, `DateOfPurchase`, `DateReceive`) VALUES ('Single-Item', '$costumerprofile_id','$quantity','$fee', NOW(), NOW() + INTERVAL '$deliverydays' DAY)";
						if($resultcostumerpurchase = mysqli_query($conn, $sqlinsertcostumerpurchase)){
							$costumerpurchaselastid = $conn ->insert_id;
							#FOR COSTUMERPURCHASEPRODUCT
							$sqlalter ="ALTER TABLE costumerspurchaseproduct AUTO_INCREMENT = 1;";
							if($resultalter = mysqli_query($conn, $sqlalter)){
								$sqlinsertcostumerpurchaseproduct="INSERT INTO `costumerspurchaseproduct`(`CostumerProfile_ID`, `Product_ID`, `Quantity`, `DateOfPurchase`,`CostumerPurchase_ID`) VALUES ('$costumerprofile_id','$product_id', '$quantity', NOW(), '$costumerpurchaselastid')";
								if($resultcostumerpurchaseproduct = mysqli_query($conn, $sqlinsertcostumerpurchaseproduct)){
									#UPDATE STOCKS IN PRODUCTS
									$sqlsumquantity="SELECT Stocks - '$quantity' as Quantity FROM products WHERE Product_ID = '$product'";
									$resultsumquantity = mysqli_query($conn, $sqlsumquantity);

									#FOR VALUE TO DISPLAY
									while($row = mysqli_fetch_assoc($resultsumquantity)){
										$sumquantity = $row['Quantity'];
									}
									$sqlupdatestocks="UPDATE `products` SET `Stocks`='$sumquantity' WHERE Product_ID='$product'";
									if($resultupdatestocks = mysqli_query($conn, $sqlupdatestocks)){
										header("Location: ../costumer/buy_again_checkout.php?product=$product&costumerproductpurchase=$costumerpurchaselastid");
									}else{
										header("Location: ../costumer/buy_again_preview.php?product=$product&notification=Error");
									}
								}else{
									header("Location: ../costumer/buy_again_preview.php?product=$product&notification=Error");
								}
							}else{
								header("Location: ../costumer/buy_again_preview.php?product=$product&notification=ErrorAlter");
							}
						}else{
							header("Location: ../costumer/buy_again_preview.php?product=$product&notification=Error");
						}
					}else{
						header("Location: ../costumer/buy_again_preview.php?product=$product&notification=ErrorAlter");
					}
				}	
			}
		}
	}
#END	
}
#END


?>