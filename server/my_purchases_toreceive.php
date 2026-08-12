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


	
	#MY PURCHASE COMPLETED 
	$sqltoreceive = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID,costumerspurchase.DateReceive, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity 
	FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerproductorders.Order_Status = 'Out For Delivery' GROUP BY costumerproductorders.CostumerProductOrder_ID DESC";
	$resulttoreceive = mysqli_query($conn, $sqltoreceive);
	
}
?>