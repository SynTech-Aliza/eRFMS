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
	}else{
		while($row = mysqli_fetch_assoc($resultcostumeraddress)){
			$region = $row['Region'];
		}
	}

	#SELECT SHIPPING FEE
	$sqlshippingfee ="SELECT * FROM `shippingfee` WHERE `Location` = '$region'";
	$resultshippingfee = mysqli_query($conn, $sqlshippingfee);
	while($row = mysqli_fetch_assoc($resultshippingfee)){
		$location = $row['Location'];
		$fee = $row['Fee'];
		$deliverydays = $row['DeliveryDays'];
	}

	#TOP PRODUCTS LIST
	$sqlbuyagainproducts ="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as BuyAgain, COUNT(costumerproductorders.CostumerProductOrder_ID) as Buy, costumerproductorders.CostumerProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.Order_Status = 'Completed' AND costumersprofile.CostumerProfile_ID ='$costumerprofile_id' GROUP BY products.Product_ID ORDER BY BuyAgain DESC LIMIT 10";
		$resultbuyagainproducts = mysqli_query($conn, $sqlbuyagainproducts);	

}
	

?>