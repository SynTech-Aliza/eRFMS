<?php
include "connection/db_conn.php";
session_start(); 
if ( (isset($_GET['product'])) && (isset($_GET['costumerproductpurchase'])) && (isset($_GET['search'])) ) {
	$product = $_GET['product'];
	$costumerproductpurchase = $_GET['costumerproductpurchase'];
	$search = $_GET['search'];


	#SELECT COSTUMER PRODUCT PURCHASE
	$sqlcheckcostumerproductpurchase ="SELECT costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, costumersprofile.First_Name, costumersprofile.Middle_Name, costumersprofile.Last_Name, products.Product_ID, products.Product_Name, products.Price, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern , products.Cover_Photo, costumerspurchaseproduct.Quantity, costumerspurchase.CostumerPurchase_ID FROM costumerspurchaseproduct INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchaseproduct.CostumerProfile_ID INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID WHERE costumerspurchaseproduct.CostumerPurchase_ID = '$costumerproductpurchase' ";
	$resultcostumerproductpurchase = mysqli_query($conn, $sqlcheckcostumerproductpurchase);
	if (mysqli_num_rows($resultcostumerproductpurchase)==0){
		$costumerprofile_id ="";
	}else{
		while($row = mysqli_fetch_assoc($resultcostumerproductpurchase)){
			$costumerpurchasedproduct_id = $row['CostumerPurchaseProduct_ID'];
			$costumerprofile_id = $row['CostumerProfile_ID'];
			$costumer_firstname = $row['First_Name'];
			$costumer_middlename = $row['Middle_Name'];
			$costumer_lastname = $row['Last_Name'];
			$product_id = $row['Product_ID'];
			$product_productname = $row['Product_Name'];
			$product_price = $row['Price'];
			$product_brand = $row['Brand'];
			$product_materials = $row['Materials'];
			$product_furnituretype = $row['Furniture_Type'];
			$product_style = $row['Style'];
			$product_color = $row['Color'];
			$product_height = $row['Height'];
			$product_width = $row['Width'];
			$product_weight = $row['Weight'];
			$product_model = $row['Model'];
			$product_pattern = $row['Pattern'];
			$product_coverphoto = $row['Cover_Photo'];
			$costumerproductpurchase_quantity = $row['Quantity'];
			$costumerpurchase_id = $row['CostumerPurchase_ID'];
		}
	}


	#SELECT COSTUMER DEFAULT ADDRESS
	$sqlcostumeraddress ="SELECT * FROM `costumersaddress` WHERE `CostumerProfile_ID` = '$costumerprofile_id' AND `Status` = 'Default'";
	$resultcostumeraddress = mysqli_query($conn, $sqlcostumeraddress);

	if (mysqli_num_rows($resultcostumeraddress)==0){
		$costumerprofile_idaddress ="";
	}else{
		while($row = mysqli_fetch_assoc($resultcostumeraddress)){
			$costumerprofile_idaddress = $row['CostumerProfile_ID'];
			$costumer_contactnumber = $row['Contact_Number'];
			$costumer_emailaddress = $row['Email_Address'];
			$costumer_region = $row['Region'];
			$costumer_province = $row['Province'];
			$costumer_city = $row['City'];
			$costumer_barangay = $row['Barangay'];
			$costumer_postalcode = $row['Postal_Code'];
			$costumer_detailedaddress = $row['Detailed_Address'];
			}
	}



	#SELECT COSTUMER PURCHASE
	$sqlcheckcostumerpurchase ="SELECT * FROM `costumerspurchase` WHERE CostumerPurchase_ID ='$costumerproductpurchase'";
	$resultcostumerpurchase = mysqli_query($conn, $sqlcheckcostumerpurchase);
	while($row = mysqli_fetch_assoc($resultcostumerpurchase)){
		$costumer_purchasetype = $row['Purchase_Type'];
		$costumer_totalquantity = $row['Total_Quantity'];
		$costumer_fee = $row['Fee'];
		$dateofpurchase = strtotime($row['DateOfPurchase']);
		$costumer_dateofpurchase = date('F j, Y', $dateofpurchase);
		$receivingdate = $row['DateReceive'];
		$datereceive = strtotime($row['DateReceive']);
		$costumer_datereceive = date('F j, Y', $datereceive);
		$costumer_paymentmethod = $row['Payment_Method'];
	}

	#GET TOTAL_PAYMENT
	$sqlgettotalpayment ="SELECT products.Price * costumerspurchaseproduct.Quantity as Total_Payment FROM `costumerspurchaseproduct` INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE CostumerPurchase_ID ='$costumerproductpurchase'";
	$resulttotalpayment = mysqli_query($conn, $sqlgettotalpayment);
	while($row = mysqli_fetch_assoc($resulttotalpayment)){
		$costumer_totalpayment = $row['Total_Payment'];
	}

	#GET OVERALL TOTAL_PAYMENT
	$sqlgetoveralltotalpayment ="SELECT products.Price * costumerspurchaseproduct.Quantity + costumerspurchase.Fee as OverallTotal_Payment FROM `costumerspurchaseproduct` INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID WHERE CostumerPurchaseProduct_ID ='$costumerpurchasedproduct_id'";
	$resultoveralltotalpayment = mysqli_query($conn, $sqlgetoveralltotalpayment);
	while($row = mysqli_fetch_assoc($resultoveralltotalpayment)){
		$costumer_overalltotalpayment = $row['OverallTotal_Payment'];
	}
	#BACK TO RELEVANCE PRODUCT VIEW
	if(isset($_POST['back'])){
		#CHECK QUANTITY IN PRODUCTS
		$sqlcheckquantity="SELECT Stocks + '$costumer_totalquantity' as Quantity FROM products WHERE Product_ID = '$product_id'";
		$resultquantity = mysqli_query($conn, $sqlcheckquantity);
			while($row = mysqli_fetch_assoc($resultquantity)){
				$quantity = $row['Quantity'];
			}

			#DELETE COSTUMER PRODUCT PURCHASE
			$sqldeletecostumerproductpurchase ="DELETE FROM `costumerspurchaseproduct` WHERE CostumerPurchase_ID ='$costumerproductpurchase' LIMIT 1";
			if($resultdeletecostumerproductpurchase = mysqli_query($conn, $sqldeletecostumerproductpurchase)){

				#DELETE COSTUMER PURCHASE
				$sqldeletecostumerpurchase ="DELETE FROM `costumerspurchase` WHERE CostumerPurchase_ID ='$costumerproductpurchase' LIMIT 1";
				if($resultdeletecostumerpurchase = mysqli_query($conn, $sqldeletecostumerpurchase)){

					#UPDATE PRODUCT STOCKS
					$sqlupdateproductstocks ="UPDATE `products` SET `Stocks`='$quantity' WHERE Product_ID = '$product_id' LIMIT 1";
					if($resultupdateproductstocks = mysqli_query($conn, $sqlupdateproductstocks)){
						header("Location: latest_products_preview.php?product=$product&search=$search");
					}else{
						header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=Error");
					}
				}else{
					header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=Error");
				}
			}else{
				header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=Error");
			}
		
	}

	#PLACE ORDER
	if(isset($_POST['place_order'])) {
		if($costumer_paymentmethod == ""){
			header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=PaymentMethod");
		}else{
			$sqlalter ="ALTER TABLE costumerproductorders AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sqlplaceorder ="INSERT INTO `costumerproductorders`(`CostumerPurchase_ID`, `Costumer_Default_First_Name`, `Costumer_Default_Middle_Name`, `Costumer_Default_Last_Name`, `Costumer_Default_Contact_Number`, `Costumer_Default_Email_Address`, `Costumer_Default_Region`, `Costumer_Default_Province`, `Costumer_Default_City`, `Costumer_Default_Barangay`, `Costumer_Default_Postal_Code`, `Costumer_Default_Detailed_Address`, `Order_Status`,`Payment_Status`) VALUES ('$costumerproductpurchase','$costumer_firstname', '$costumer_middlename', '$costumer_lastname', '$costumer_contactnumber', '$costumer_emailaddress', '$costumer_region', '$costumer_province', '$costumer_city', '$costumer_barangay', '$costumer_postalcode', '$costumer_detailedaddress','Pending','To Pay')";
					if($resultplaceorder = mysqli_query($conn, $sqlplaceorder)){

						########################
						$costumerproductorderslastid = $conn ->insert_id; 
						$costumerlast_id = $costumerproductorderslastid;
						$number = str_pad($costumerlast_id, 10, '0', STR_PAD_LEFT);
						$newcostumerproductorderid = "RFOOS". $number;

						$sqlupdateproductorder="UPDATE `costumerproductorders` SET `PlatformProductOrder_ID`='$newcostumerproductorderid' WHERE CostumerProductOrder_ID = '$costumerproductorderslastid'";
						if($resultupdateproductorder = mysqli_query($conn, $sqlupdateproductorder)){
							header("Location: latest_products_preview.php?product=$product&search=$search&notification=PlaceOrder");
						}else{
							header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=Error");
						}
						########################
					}else{
						header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=Error");
					}
			}else{
				header("Location: latest_products_checkout.php?product=$product&costumerproductpurchase=$costumerproductpurchase&search=$search&notification=ErrorAlter");
			}
		}
	}
}
?>