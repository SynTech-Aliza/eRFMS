<?php
include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sqluser ="SELECT `CostumerProfile_ID`, `UserAccount_ID` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";

	$resultuser = mysqli_query($conn, $sqluser);
	
	if (mysqli_num_rows($resultuser)==0){
		$costumerprofile_id = "";
	}else{													
		while ($row = $resultuser->fetch_assoc()) {
	   		$costumerprofile_id = $row['CostumerProfile_ID'];
			$useraccountid = $row['UserAccount_ID'];
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

	#LIST ADD TO CART PRODUCTS
	$sqlshoppingcart ="SELECT COUNT(costumersshoppingcart.CostumerShoppingCart_ID) as Quantity, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price,products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style,  products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern,  products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5 FROM costumersshoppingcart INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumersshoppingcart.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumersshoppingcart.Product_ID
	WHERE costumersprofile.CostumerProfile_ID =  '$costumerprofile_id' AND products.Stocks !=0 AND products.`DelistOrListed` = 'Listed' AND products.`UnpublishedOrPublished` = 'Published' GROUP BY products.Product_ID ORDER BY costumersshoppingcart.CostumerShoppingCart_ID DESC";
		$sqlresultshoppingcart = mysqli_query($conn, $sqlshoppingcart);	

	#LIST OF INVALID ADD TO CART PRODUCTS
	$sqlinvalidshoppingcartlist ="SELECT COUNT(costumersshoppingcart.CostumerShoppingCart_ID) as Quantity, costumersshoppingcart.CostumerShoppingCart_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5 FROM costumersshoppingcart INNER JOIN products ON products.Product_ID = costumersshoppingcart.Product_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumersshoppingcart.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND products.Stocks = 0 AND products.UnpublishedOrPublished = 'Published' GROUP BY products.Product_ID";
	$sqlresultinvalidshoppingcartlist = mysqli_query($conn, $sqlinvalidshoppingcartlist);
}

#REMOVE QUANTITY PRODUCT IN SHOPPING CART
if(isset($_GET['productminus'])){
	$productminus = $_GET['productminus'];

	#CHECK DATA FROM SHOPPING CART TABLE
	$sqlcheckproduct="SELECT `CostumerShoppingCart_ID`, `CostumerProfile_ID`, `Product_ID` FROM `costumersshoppingcart` WHERE Product_ID = '$productminus'";
	$resultcheckproduct = mysqli_query($conn, $sqlcheckproduct);
	#FOR VALUE TO DISPLAY												
	while ($rows = $resultcheckproduct->fetch_assoc()) {
   		$costumershoppingcartid= $rows['CostumerShoppingCart_ID'];
   		$costumerprofileid= $rows['CostumerProfile_ID'];
   		$productid= $rows['Product_ID'];
	}

	#CHECK FOR STOCKS IN PRODUCT TABLE
	$sqlcheckstocks ="SELECT `Stocks` FROM `products` WHERE `Product_ID` = '$productid'";
	$sqlresultstocks = mysqli_query($conn, $sqlcheckstocks);

	#FOR VALUE TO DISPLAY
	while($row = mysqli_fetch_assoc($sqlresultstocks)){
		$stocks=$row['Stocks'];
	}

	#CHECK FOR QUANTITY OF THE COSTUMER IN COSTUMERSCART TABLE
	$sqlquantity ="SELECT COUNT(costumersshoppingcart.CostumerShoppingCart_ID) as Quantity FROM costumersshoppingcart INNER JOIN products ON products.Product_ID = costumersshoppingcart.Product_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumersshoppingcart.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID =  '$costumerprofileid' AND costumersshoppingcart.Product_ID = '$productid' AND `Stocks`!= 0 GROUP BY products.Product_ID ORDER BY costumersshoppingcart.CostumerShoppingCart_ID DESC";
	$sqlresultquantity = mysqli_query($conn, $sqlquantity);

	#FOR VALUE TO DISPLAY
	while ($rows = $sqlresultquantity->fetch_assoc()) {
   		 $quantity = $rows['Quantity'];
   	}

   	if($quantity == 1){
			header("Location: ../forms/costumer/shopping_cart.php");
	}elseif($stocks > 1){
   		$sqlremoveshoppingcart="DELETE FROM `costumersshoppingcart` WHERE Product_ID = '$productid' ORDER BY CostumerShoppingCart_ID DESC LIMIT 1";
		if($resultremoveshoppingcart = mysqli_query($conn, $sqlremoveshoppingcart)){
			header("Location: ../forms/costumer/shopping_cart.php");
		}else{
			header("Location: ../forms/costumer/shopping_cart.php");
		}
	}	

}

#ADD QUANTITY PRODUCT IN SHOPPING CART
if(isset($_GET['productplus'])){
	$productplus = $_GET['productplus'];

	#CHECK DATA FROM SHOPPING CART TABLE
	$sqlcheckproduct="SELECT `CostumerShoppingCart_ID`, `CostumerProfile_ID`, `Product_ID` FROM `costumersshoppingcart` WHERE Product_ID = '$productplus'";
	$resultcheckproduct = mysqli_query($conn, $sqlcheckproduct);
	#FOR VALUE TO DISPLAY												
	while ($rows = $resultcheckproduct->fetch_assoc()) {
   		$costumershoppingcartid= $rows['CostumerShoppingCart_ID'];
   		$costumerprofileid= $rows['CostumerProfile_ID'];
   		$productid= $rows['Product_ID'];

	}

	#CHECK FOR STOCKS IN PRODUCT TABLE
	$sqlcheckstocks ="SELECT `Stocks` FROM `products` WHERE `Product_ID` = '$productid'";
	$sqlresultstocks = mysqli_query($conn, $sqlcheckstocks);

	#FOR VALUE TO DISPLAY
	while($row = mysqli_fetch_assoc($sqlresultstocks)){
		$stocks=$row['Stocks'];
	}

	#CHECK FOR QUANTITY OF THE COSTUMER IN COSTUMERSCART TABLE
	$sqlquantity ="SELECT COUNT(costumersshoppingcart.CostumerShoppingCart_ID) as Quantity FROM costumersshoppingcart INNER JOIN products ON products.Product_ID = costumersshoppingcart.Product_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumersshoppingcart.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID =  '$costumerprofileid' AND costumersshoppingcart.Product_ID = '$productid' AND `Stocks`!= 0 GROUP BY products.Product_ID ORDER BY costumersshoppingcart.CostumerShoppingCart_ID DESC";
	$sqlresultquantity = mysqli_query($conn, $sqlquantity);

	#FOR VALUE TO DISPLAY
	while ($rows = $sqlresultquantity->fetch_assoc()) {
   		 $quantity = $rows['Quantity'];
   	}
   	
   	if($stocks == $quantity){
   		header("Location: ../forms/costumer/shopping_cart.php");
	}else{
		$sqlalter ="ALTER TABLE costumersshoppingcart AUTO_INCREMENT = 1;";
		if($resultalter = mysqli_query($conn, $sqlalter)){
			$sqladdshoppingcart="INSERT INTO `costumersshoppingcart`(`CostumerProfile_ID`, `Product_ID`) VALUES  ('$costumerprofileid','$productid')";
			if($resultaddshoppingcart = mysqli_query($conn, $sqladdshoppingcart)){
				header("Location: ../forms/costumer/shopping_cart.php");
			}else{
				header("Location: ../forms/costumer/shopping_cart.php?error");
			}
		}else{
			header("Location: ../forms/costumer/shopping_cart.php");
		}
	}	

}	


#CHECK OUT PRODUCTS
if(isset($_POST['checkout'])){
 	if(empty($_POST['product'])){
		header("Location:shopping_cart.php");
	}else{
		$product = $_POST['product'];
		$checkoutproduct = implode('',$product);
		$checkoutproductcount = count($product);
		#CHECK NUMBER OF PRODUCTS THAT CHECK OUT
		#SINGLE ITEM
		if($checkoutproductcount == 1){
			if($costumerprofile_id == ""){
				header("Location: shopping_cart.php?notification=EmptyCostumerProfile");
			}elseif($province == "" && $city == ""){
				header("Location: shopping_cart.php?notification=EmptyDefaultAddress");
			}else{
				#CHECK QUANTITY PRODUCT IN COSTUMER SHOPPING CART
				$sqlcheckcostumerquantityproduct ="SELECT COUNT(CostumerShoppingCart_ID) as Quantity, CostumerShoppingCart_ID FROM costumersshoppingcart WHERE CostumerProfile_ID =  '$costumerprofile_id' AND Product_ID = '$checkoutproduct'";
				$sqlresultostumerquantityproduct = mysqli_query($conn, $sqlcheckcostumerquantityproduct);
					while($row = mysqli_fetch_assoc($sqlresultostumerquantityproduct)){
						$quantity = $row['Quantity'];
					}

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
							#ADD TO COSTUMER PRODUCT PURCHASE
							$sqlinsertcostumerpurchaseproduct="INSERT INTO `costumerspurchaseproduct`(`CostumerProfile_ID`, `Product_ID`, `Quantity`, `DateOfPurchase`,`CostumerPurchase_ID`) VALUES ('$costumerprofile_id','$checkoutproduct', '$quantity', NOW(), '$costumerpurchaselastid')";
							if($resultcostumerpurchaseproduct = mysqli_query($conn, $sqlinsertcostumerpurchaseproduct)){
								#UPDATE STOCKS IN PRODUCTS
								$sqlsumquantity="SELECT Stocks - '$quantity' as Quantity FROM products WHERE Product_ID = '$checkoutproduct'";
								$resultsumquantity = mysqli_query($conn, $sqlsumquantity);

									while($row = mysqli_fetch_assoc($resultsumquantity)){
										$sumquantity = $row['Quantity'];
									}

								$sqlupdatestocks="UPDATE `products` SET `Stocks`='$sumquantity' WHERE Product_ID='$checkoutproduct'";
									if($resultupdatestocks = mysqli_query($conn, $sqlupdatestocks)){
										header("Location: shopping_cart_singleitemcheckout.php?costumersingleitemcheckout=$costumerpurchaselastid");
									}else{
										header("Location: shopping_cart.php?notification=Error");
									}
							}else{
								header("Location: shopping_cart.php?notification=Error");
							}
						}else{
							header("Location: shopping_cart.php?notification=ErrorAlter");
						}
					}else{
						header("Location: shopping_cart.php?notification=Error");
					}
				}else{
					header("Location: shopping_cart.php?notification=ErrorAlter");
				}

			}
		}
		#MULTIPLE ITEMS
		else{
			if($costumerprofile_id == ""){
				header("Location: shopping_cart.php?notification=EmptyCostumerProfile");
			}elseif($province == "" && $city == ""){
				header("Location: shopping_cart.php?notification=EmptyDefaultAddress");
			}else{
				#FOR COSTUMERPURCHASE
				$sqlalter ="ALTER TABLE costumerspurchase AUTO_INCREMENT = 1;";
				if($resultalter = mysqli_query($conn, $sqlalter)){
					#ADD TO COSTUMERPURCHASE
					$sqlinsertcostumerpurchase="INSERT INTO `costumerspurchase`(`Purchase_Type`, `CostumerProfile_ID`, `Total_Quantity`, `Fee`, `DateOfPurchase`, `DateReceive`) VALUES ('Multiple-Items', '$costumerprofile_id','','$fee', NOW(), NOW() + INTERVAL '$deliverydays' DAY)";
					if($resultcostumerpurchase = mysqli_query($conn, $sqlinsertcostumerpurchase)){
						$costumerpurchaselastid = $conn ->insert_id;
						#START FOREACH
						$totalquantityofproducts = 0;
						foreach ($product as $checkoutproduct) {
							#CHECK QUANTITY PRODUCT IN COSTUMER SHOPPING CART
							$sqlcheckcostumerquantityproduct ="SELECT COUNT(CostumerShoppingCart_ID) as Quantity, CostumerShoppingCart_ID FROM costumersshoppingcart WHERE CostumerProfile_ID =  '$costumerprofile_id' AND Product_ID = '$checkoutproduct'";
							$sqlresultostumerquantityproduct = mysqli_query($conn, $sqlcheckcostumerquantityproduct);
								while($row = mysqli_fetch_assoc($sqlresultostumerquantityproduct)){
									$quantity = $row['Quantity'];
								}
								$totalquantityofproducts+= $quantity;

							$sqlalter ="ALTER TABLE costumerspurchaseproduct AUTO_INCREMENT = 1;";
							if($resultalter = mysqli_query($conn, $sqlalter)){

								#ADD TO COSTUMER PRODUCT PURCHASE
								$sqlinsertcostumerpurchaseproduct="INSERT INTO `costumerspurchaseproduct`(`CostumerProfile_ID`, `Product_ID`, `Quantity`, `DateOfPurchase`,`CostumerPurchase_ID`) VALUES ('$costumerprofile_id','$checkoutproduct', '$quantity', NOW(), '$costumerpurchaselastid')";
								if($resultcostumerpurchaseproduct = mysqli_query($conn, $sqlinsertcostumerpurchaseproduct)){
									#UPDATE STOCKS IN PRODUCTS
									$sqlsumquantity="SELECT Stocks - '$quantity' as Quantity FROM products WHERE Product_ID = '$checkoutproduct'";
									$resultsumquantity = mysqli_query($conn, $sqlsumquantity);

									while($row = mysqli_fetch_assoc($resultsumquantity)){
										$sumquantity = $row['Quantity'];
									}
									$sqlupdatestocks="UPDATE `products` SET `Stocks`='$sumquantity' WHERE Product_ID='$checkoutproduct'";
									if($resultupdatestocks = mysqli_query($conn, $sqlupdatestocks)){
										header("Location: shopping_cart_multipleitemscheckout.php?costumermultipleitemscheckout=$costumerpurchaselastid");
									}else{
										header("Location: shopping_cart.php?notification=Error");
									}
								}else{
									header("Location: shopping_cart.php?notification=Error");
								}
							}else{
								header("Location: shopping_cart.php?notification=ErrorAlter");
							}
						}
						#END FOREACH
						$sqlupdateproductstocks="UPDATE `costumerspurchase` SET `Total_Quantity`='$totalquantityofproducts' WHERE CostumerPurchase_ID = '$costumerpurchaselastid'";
						$resultupdateproductstocks = mysqli_query($conn, $sqlupdateproductstocks);

					}else{
						header("Location: shopping_cart.php?notification=Error");
					}
				}else{
					header("Location: shopping_cart.php?notification=ErrorAlter");
				}
			}
		}
	}
}
?>