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


	if (isset($_GET['costumerproductorder'])) {
		$costumerproductorder = $_GET['costumerproductorder'];
		#DELIVERY ADDRESS 
		$sqldeliveryaddress = "SELECT `CostumerProductOrder_ID`, `CostumerPurchase_ID`, `Costumer_Default_First_Name`, `Costumer_Default_Middle_Name`, `Costumer_Default_Last_Name`, `Costumer_Default_Contact_Number`, `Costumer_Default_Email_Address`, `Costumer_Default_Region`, `Costumer_Default_Province`, `Costumer_Default_City`, `Costumer_Default_Barangay`, `Costumer_Default_Postal_Code`, `Costumer_Default_Detailed_Address` FROM `costumerproductorders` WHERE CostumerProductOrder_ID ='$costumerproductorder'";
		$resultdeliveryaddress = mysqli_query($conn, $sqldeliveryaddress);
			while($row = mysqli_fetch_assoc($resultdeliveryaddress)){
				$costumerproductorder_id = $row['CostumerProductOrder_ID'];
				$costumerpurchase_id = $row['CostumerPurchase_ID'];
				$costumer_firstname = $row['Costumer_Default_First_Name'];
				$costumer_middlename = $row['Costumer_Default_Middle_Name'];
				$costumer_lastname = $row['Costumer_Default_Last_Name'];
				$costumer_contactnumber = $row['Costumer_Default_Contact_Number'];
				$costumer_emailaddress = $row['Costumer_Default_Email_Address'];
				$costumer_region = $row['Costumer_Default_Region'];
				$costumer_province = $row['Costumer_Default_Province'];
				$costumer_city = $row['Costumer_Default_City'];
				$costumer_barangay = $row['Costumer_Default_Barangay'];
				$costumer_postalcode = $row['Costumer_Default_Postal_Code'];
				$costumer_detailedaddress = $row['Costumer_Default_Detailed_Address'];
			}
			
		#GET SHIP DATE
		$sqlshippingdate = "SELECT * FROM `orderdeliverydetails` WHERE CostumerProductOrder_ID ='$costumerpurchase_id'";
		$resultshippingdate = mysqli_query($conn, $sqlshippingdate);
			while($row = mysqli_fetch_assoc($resultshippingdate)){
				$date = strtotime($row['ShipByDate']);
		  		$shipbydate = date('F j, Y', $date);
		  		$trackingnumber = $row['TrackingNumber'];
		  		$orderdeliverydetails_id = $row['OrderDeliveryDetails_ID'];
			}

		#GET TRACKING DELIVERY DETAILS
		$sqltrackingdetails = "SELECT * FROM `ordertrackingdetails` WHERE OrderDeliveryDetails_ID ='$orderdeliverydetails_id' ORDER BY OrderTrackingDetail_ID DESC LIMIT 1";
		$resulttrackingdetails = mysqli_query($conn, $sqltrackingdetails);
			


		#PAYMENT METHOD
		$sqlpaymentmethod = "SELECT * FROM `costumerspurchase` WHERE `CostumerPurchase_ID` = '$costumerpurchase_id'";
		$resultpaymentmethod = mysqli_query($conn, $sqlpaymentmethod);
			while($row = mysqli_fetch_assoc($resultpaymentmethod)){
				$paymentmethod = $row['Payment_Method'];
			}

		#MY PURCHASE TO PAY 
		$sqlpurchaseproducts = "SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity, costumerspurchase.Fee
		FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumersprofile.CostumerProfile_ID = '$costumerprofile_id' AND costumerspurchase.CostumerPurchase_ID = '$costumerpurchase_id' GROUP BY products.Product_ID DESC";
		$resultpurchaseproducts = mysqli_query($conn, $sqlpurchaseproducts);

		#COSTUMER FEE
		$sqlcheckcostumerpurchase ="SELECT * FROM `costumerspurchase` WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
		$resultcostumerpurchase = mysqli_query($conn, $sqlcheckcostumerpurchase);
			while($row = mysqli_fetch_assoc($resultcostumerpurchase)){
				$costumer_fee = $row['Fee'];
			}

		#GET TOTAL_PAYMENT
		$sqlgettotalpayment ="SELECT SUM(products.Price * costumerspurchaseproduct.Quantity)as Total_Payment FROM `costumerspurchaseproduct` INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
		$resulttotalpayment = mysqli_query($conn, $sqlgettotalpayment);
			while($row = mysqli_fetch_assoc($resulttotalpayment)){
				$costumer_totalpayment = $row['Total_Payment'];
			}

		$costumer_overalltotalpayment  = $costumer_totalpayment + $costumer_fee;
									
		
		#GET PRODUCT ORDER DETAILS
		$sqlproductpurchaseorderdetails ="SELECT `CostumerPurchase_ID`, `Purchase_Type`, `CostumerProfile_ID`, `Total_Quantity`, `Fee`, `DateOfPurchase`, `DateReceive`, `Payment_Method` FROM `costumerspurchase` WHERE `CostumerPurchase_ID` ='$costumerpurchase_id'";
		$resultproductpurchaseorderdetails = mysqli_query($conn, $sqlproductpurchaseorderdetails);
			while($row = mysqli_fetch_assoc($resultproductpurchaseorderdetails)){
					$costumer_purchaseid = $row['CostumerPurchase_ID']; 
					$number = $costumer_purchaseid;
					$costumer_purchasenewid = str_pad($number, 10, '0', STR_PAD_LEFT);
					$dateofpurchase = strtotime($row['DateOfPurchase']);
		  			$costumer_dateofpurchase = date('F j, Y H:i:s', $dateofpurchase);
					$costumer_datereceive = $row['DateReceive'];
				}
	}

	if(isset($_POST['confirm'])){
		$reason = $_POST['reason'];
		$sqlcancelorder ="UPDATE `costumerproductorders` SET `Order_Status`='Request for Cancelling Order', `Cancellation_Reason` ='$reason' WHERE `CostumerProductOrder_ID` = '$costumerproductorder'";
		if($resultcancelorder = mysqli_query($conn, $sqlcancelorder)){
			header("Location: ../costumer/my_purchases_todeliver.php?notification=Cancelled");
		}else{
			header("Location: ../costumer/my_purchases_todeliver.php?notification=ErrorCancelled");
		}
	}
}

	
?>