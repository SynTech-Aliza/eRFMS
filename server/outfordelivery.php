<?php
include "connection/db_conn.php";
if(isset($_GET['productorderid'])){
	$productorderid = $_GET['productorderid'];

	$sqlproductorders = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerspurchase.Total_Quantity,costumerspurchaseproduct.Quantity,  products.Product_ID, products.Product_Name, products.Cover_Photo, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.CostumerProductOrder_ID = '$productorderid'";
	$resultproductorders = mysqli_query($conn, $sqlproductorders);
	while($row = mysqli_fetch_assoc($resultproductorders)){
		$costumerproductorderid = $row['CostumerProductOrder_ID'];
	}
	
	$sqlgetdeliveryorderid = "SELECT * FROM `orderdeliverydetails` WHERE CostumerProductOrder_ID = '$costumerproductorderid'";
	$resultdeliveryorderid = mysqli_query($conn, $sqlgetdeliveryorderid);
	while($row = mysqli_fetch_assoc($resultdeliveryorderid)){
		$orderdeliverydetailsid = $row['OrderDeliveryDetails_ID'];
	}
	
	$sqlalter ="ALTER TABLE ordertrackingdetails AUTO_INCREMENT = 1;";
		if($resultalter = mysqli_query($conn, $sqlalter)){
		$sqlinsetordertrackingdetails  ="INSERT INTO `ordertrackingdetails`(`OrderDeliveryDetails_ID`, `OrderTrackingStatus`, `OrderTrackingDate`) VALUES ('$orderdeliverydetailsid','Your order is out for delivery.',NOW())";
			if($resultinsetordertrackingdetails = mysqli_query($conn, $sqlinsetordertrackingdetails)){
				$sqlupdateorderstatus = "UPDATE `costumerproductorders` SET `Order_Status` = 'Prepared Package' WHERE `CostumerProductOrder_ID` = '$productorderid'";
				if($resultupdateorderstatus = mysqli_query($conn, $sqlupdateorderstatus)){
					$sqlupdateorderstatus = "UPDATE `costumerproductorders` SET `Order_Status` = 'Out For Delivery' WHERE `CostumerProductOrder_ID` = '$productorderid'";
					if($resultupdateorderstatus = mysqli_query($conn, $sqlupdateorderstatus)){
						header("Location: ../forms/clerk/shop_orders_todeliver.php?notification=SuccessfullyOutForDelivery");
					}else{
						header("Location: ../forms/clerk/shop_orders_todeliver.php?notification=Error");
					}
				}else{
					header("Location: ../forms/clerk/shop_orders_todeliver.php?notification=Error");
				}
			}else{
				header("Location: ../forms/clerk/shop_orders_todeliver.php?notification=Error");
			}
		}else{
			header("Location: ../forms/clerk/shop_orders_todeliver.php?notification=Error");
		}
}
?>