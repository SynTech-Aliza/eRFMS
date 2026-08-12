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
	
	#DISPLAY COUNT OF TO PAY PRODUCTS
	$sqltopay="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as ToPay FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerproductorders.Order_Status ='Pending'";
	$resulttopay = mysqli_query($conn, $sqltopay);
	while($row = mysqli_fetch_assoc($resulttopay)){
		$topayresult = $row['ToPay'];
	}

	#DISPLAY COUNT OF TO DELIVER PRODUCTS
	$sqltodeliver="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as ToDeliver FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerproductorders.Order_Status ='Arrange Delivery' OR costumerproductorders.Order_Status ='Prepare Package' OR costumerproductorders.Order_Status ='Request for Cancelling Order'";
	$resulttodeliver = mysqli_query($conn, $sqltodeliver);
	while($row = mysqli_fetch_assoc($resulttodeliver)){
		$todeliverresult = $row['ToDeliver'];
	}

	#DISPLAY COUNT OF TO RECEIVE PRODUCTS
	$sqltoreceive="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as ToReceive FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerproductorders.Order_Status ='Out For Delivery'";
	$resulttoreceive = mysqli_query($conn, $sqltoreceive);
	while($row = mysqli_fetch_assoc($resulttoreceive)){
		$toreceiveresult = $row['ToReceive'];
	}

	#DISPLAY COMPLETE PRODUCTS
	$sqlcompleteproduct = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Cover_Photo FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerproductorders.Order_Status = 'Completed' GROUP BY products.Product_ID LIMIT 10";
	$resultcompleteproduct = mysqli_query($conn, $sqlcompleteproduct);

	#DISPLAY COUNT OF TO RATE PRODUCTS
	$sqltorate="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as ToRate FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerproductorders.Order_Status ='Completed'";
	$resulttorate = mysqli_query($conn, $sqltorate);
	while($row = mysqli_fetch_assoc($resulttorate)){
		$torateresult = $row['ToRate'];
	}

}
?>