<?php
include "connection/db_conn.php";
if(isset($_GET['productorderid'])){
	$productorderid = $_GET['productorderid'];

	#DISPLAY PRODUCT ORDERS
	$sqlproductorders = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerspurchase.Total_Quantity,costumerspurchaseproduct.Quantity,  products.Product_ID, products.Product_Name, products.Cover_Photo, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.CostumerProductOrder_ID = '$productorderid'";
	$resultproductorders = mysqli_query($conn, $sqlproductorders);

	if(isset($_POST['prepaprepackage'])){
	$orderdeliverydetailsid = $_POST['orderdeliverydetailsid'];
		$sqlalter ="ALTER TABLE ordertrackingdetails AUTO_INCREMENT = 1;";
		if($resultalter = mysqli_query($conn, $sqlalter)){
		$sqlinsetordertrackingdetails  ="INSERT INTO `ordertrackingdetails`(`OrderDeliveryDetails_ID`, `OrderTrackingStatus`, `OrderTrackingDate`) VALUES ('$orderdeliverydetailsid','Your order is preparing to be delivered.',NOW())";
			if($resultinsetordertrackingdetails = mysqli_query($conn, $sqlinsetordertrackingdetails)){
				$sqlupdateorderstatus = "UPDATE `costumerproductorders` SET `Order_Status` = 'Prepared Package' WHERE `CostumerProductOrder_ID` = '$productorderid'";
				if($resultupdateorderstatus = mysqli_query($conn, $sqlupdateorderstatus)){
					header("Location: shop_orders_preparepackage.php?notification=SuccessfullyPreparedPackage");
				}else{
					header("Location: preparepackage.php?productorderid=$productorderid&notification=Error");
				}
			}else{
				header("Location: preparepackage.php?productorderid=$productorderid&notification=Error");
			}
		}else{
			header("Location: preparepackage.php?productorderid=$productorderid&notification=Error");
		}
	}elseif(isset($_POST['cancel'])){
		header("Location: shop_orders_preparepackage.php");
	}
}
?>