<?php
include "connection/db_conn.php";
session_start(); 
if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sqluser ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";
	$sqlresultuser = mysqli_query($conn, $sqluser);
	if (mysqli_num_rows($sqlresultuser)==0){
		$costumerprofile_id = "";
	}else{
		while($row = mysqli_fetch_assoc($sqlresultuser)){
			$costumerprofile_id = $row['CostumerProfile_ID'];
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
			}

			$costumerdefaultaddress = $costumer_province." (".$costumer_city.")";
	}

	if ( (isset($_GET['product'])) && (isset($_GET['costumerpurchase'])) && (isset($_GET['search'])) ) {
		$product = $_GET['product'];
		$costumerpurchase = $_GET['costumerpurchase'];
		$search = $_GET['search'];

		#FOR SHIPPING FEE VALUE
		$sqlshippingfee="SELECT * FROM `shippingfee` WHERE Location = '$costumerdefaultaddress'";
		$resultshippingfee = mysqli_query($conn, $sqlshippingfee);
			while ($rows = $resultshippingfee->fetch_assoc()) {
				$shippingfeeid= $rows['ShippingFee_ID'];
	   			$location= $rows['Location'];
	   			$fee= $rows['Fee'];
	   			$deliverydays= $rows['DeliveryDays'];
			}

		#CASH ON DELIVERY
		if(isset($_POST['cashondelivery'])){
			$sqlpaymentcashondelivery = "UPDATE `costumerspurchase` SET `Payment_Method`='Cash on Delivery', `Fee`='$fee', `DateReceive`=NOW() + INTERVAL '$deliverydays' DAY WHERE CostumerPurchase_ID = '$costumerpurchase'";
			if($resultpaymentcashondelivery = mysqli_query($conn, $sqlpaymentcashondelivery)){
				header("Location: relevance_products_checkout.php?product=$product&costumerproductpurchase=$costumerpurchase&search=$search");
			}else{
				header("Location: relevance_products_paymentmethod.php?product=$product&costumerpurchase=$costumerpurchase&search=$search");
			}
		}

		#OVER THE COUNTER
		if(isset($_POST['overthecounter'])) {
			$sqlpaymentoverthecounter = "UPDATE `costumerspurchase` SET `Payment_Method`='Over the Counter', `Fee`='0', `DateReceive`=0000-00-00 WHERE CostumerPurchase_ID = '$costumerpurchase'";
			if($resultpaymentoverthecounter = mysqli_query($conn, $sqlpaymentoverthecounter)){
				header("Location: relevance_products_checkout.php?product=$product&costumerproductpurchase=$costumerpurchase&search=$search");
			}else{
				header("Location: relevance_products_paymentmethod.php?product=$product&costumerpurchase=$costumerpurchase&search=$search");
			}
		}
	}	
}
?>