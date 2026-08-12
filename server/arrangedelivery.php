<?php
include "connection/db_conn.php";
if(isset($_GET['productorderid'])){
	$productorderid = $_GET['productorderid'];

	#DISPLAY PRODUCT ORDERS
	$sqlproductorders = "SELECT * FROM `costumerproductorders` WHERE `CostumerProductOrder_ID` = '$productorderid'";
	$resultproductorders = mysqli_query($conn, $sqlproductorders);

	#DISPLAY PICK UP TIME
	$sqlproductorderspickupdate = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerspurchase.DateReceive FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID WHERE costumerproductorders.CostumerProductOrder_ID = '$productorderid'";
	$resultproductorderspickupdate = mysqli_query($conn, $sqlproductorderspickupdate);
		while($row = mysqli_fetch_assoc($resultproductorderspickupdate)){
			$datereceive = $row['DateReceive'];
		}

	if(isset($_POST['arrangedelivery'])){
		$deliverypickupstatus = $_POST['deliverypickupstatus'];
		if(empty($deliverypickupstatus)){
			header("Location: arrangedelivery.php?productorderid=$productorderid&notification=Empty");
		}else{
			$sqlupdateorderstatus = "UPDATE `costumerproductorders` SET `Order_Status` = 'Arrange Delivery' WHERE `CostumerProductOrder_ID` = '$productorderid'";
			if($resultupdateorderstatus = mysqli_query($conn, $sqlupdateorderstatus)){
				$sqlalter ="ALTER TABLE orderdeliverydetails AUTO_INCREMENT = 1;";
				if($resultalter = mysqli_query($conn, $sqlalter)){
					$trackingno = mt_rand( 000000000000 , 999999999999 );
					$trackingnumber = 'RFOOS'.$trackingno;
					$sqlinsertdeliverydetails="INSERT INTO `orderdeliverydetails`(`CostumerProductOrder_ID`, `TrackingNumber`, `PickUp/DropOff`, `ShipByDate`) VALUES ('$productorderid','$trackingnumber','$deliverypickupstatus',NOW() + INTERVAL 5 DAY)";
					if($resultinsertdeliverydetails = mysqli_query($conn, $sqlinsertdeliverydetails)){
						$orderdeliverydetailslastid = $conn ->insert_id;
						$sqlalter ="ALTER TABLE ordertrackingdetails AUTO_INCREMENT = 1;";
						if($resultalter = mysqli_query($conn, $sqlalter)){
							$sqlinsetordertrackingdetails  ="INSERT INTO `ordertrackingdetails`(`OrderDeliveryDetails_ID`, `OrderTrackingStatus`, `OrderTrackingDate`) VALUES ('$orderdeliverydetailslastid','Your order has been arrange to delivery.',NOW())";
							if($resultinsetordertrackingdetails = mysqli_query($conn, $sqlinsetordertrackingdetails)){
								header("Location: shop_orders_arrangedelivery.php?notification=SuccessfullyArrangeDelivery");
							}else{
								header("Location: arrangedelivery.php?productorderid=$productorderid&notification=Error");
							}
						}else{
							header("Location: arrangedelivery.php?productorderid=$productorderid&notification=Error");
						}
					}else{
						header("Location: arrangedelivery.php?productorderid=$productorderid&notification=Error");
					}
				}else{
					header("Location: arrangedelivery.php?productorderid=$productorderid&notification=Error");
				}
			}else{
				header("Location: arrangedelivery.php?productorderid=$productorderid&notification=Error");
			}
		}
	}elseif(isset($_POST['cancel'])){
		header("Location: shop_orders_arrangedelivery.php");
	}
}
?>