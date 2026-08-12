<?php
include "connection/db_conn.php";
session_start();

if ( (isset($_GET['profile']))& (isset($_GET['address']))   ){
	$profile = $_GET['profile'];
	$address = $_GET['address'];


	$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$profile'";

	if($result = mysqli_query($conn, $sqlcostumername)){
		$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='Default' WHERE `CostumerAddress_ID` = '$address'";
		if($result = mysqli_query($conn, $sqlcostumeraddress)){
			header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address&notification=Default");
		}else{
			header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address&notification=ErrorDefault");
		}
	}else{
		header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address&notification=ErrorDefault");
	}
}

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sqlcostumer ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$resultcostumer = mysqli_query($conn, $sqlcostumer);

	if (mysqli_num_rows($resultcostumer)==0){
		$costumerprofile_id ="";
	}else{
		while($row = mysqli_fetch_assoc($resultcostumer)){
		 $costumerprofile_id = $row['CostumerProfile_ID'];
		 $first_name = $row['First_Name'];
		 $middle_name = $row['Middle_Name'];
		 $last_name = $row['Last_Name'];
		}
	}
}
	#TO PAY UPDATE DEFAULT ADDRESS
	if ( (isset($_GET['topaycostumerproductorder']))& (isset($_GET['costumeraddress']))   ){
		$topaycostumerproductorder = $_GET['topaycostumerproductorder'];
		$costumeraddress = $_GET['costumeraddress'];


		$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$costumerprofile_id'";

		if($result = mysqli_query($conn, $sqlcostumername)){
			$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='Default' WHERE `CostumerAddress_ID` = '$costumeraddress'";
			if($result = mysqli_query($conn, $sqlcostumeraddress)){

				$sqlcheckaddress="SELECT * FROM `costumersaddress` WHERE `Status` = 'Default' AND `CostumerProfile_ID` ='$costumerprofile_id'";
				$resultcheckaddress = mysqli_query($conn, $sqlcheckaddress);
					while($row = mysqli_fetch_assoc($resultcheckaddress)){
						$contactnumber = $row['Contact_Number'];
						$emailaddress = $row['Email_Address'];
						$region = $row['Region'];
						$province = $row['Province'];
						$city = $row['City'];
						$barangay = $row['Barangay'];
						$postalcode = $row['Postal_Code'];
						$detailedaddress = $row['Detailed_Address'];
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

				$sqlselectcostumerpurchaseid ="SELECT * FROM costumerproductorders WHERE CostumerProductOrder_ID ='$topaycostumerproductorder'";
				$resultcostumerpurchaseid = mysqli_query($conn, $sqlselectcostumerpurchaseid);
					while($row = mysqli_fetch_assoc($resultcostumerpurchaseid)){
						$costumerpurchase_id = $row['CostumerPurchase_ID'];
					}

				$sqlupdatecostumerpurchase ="UPDATE `costumerspurchase` SET `Fee`='$fee',`DateReceive`=NOW() + INTERVAL '$deliverydays' DAY WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
				if($result = mysqli_query($conn, $sqlupdatecostumerpurchase)){
					$sqlupdatedefaultaddress ="UPDATE `costumerproductorders` SET `Costumer_Default_Contact_Number`='$contactnumber',`Costumer_Default_Email_Address`='$emailaddress',`Costumer_Default_Region`='$region',`Costumer_Default_Province`='$province',`Costumer_Default_City`='$city',`Costumer_Default_Barangay`='$barangay',`Costumer_Default_Postal_Code`='$postalcode',`Costumer_Default_Detailed_Address`='$detailedaddress' WHERE CostumerProductOrder_ID ='$topaycostumerproductorder'";
					if($result = mysqli_query($conn, $sqlupdatedefaultaddress)){
						header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=Default");
					}else{
						header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
					}
				}else{
					header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
				}
			}else{
				header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
			}
		}else{
			header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
		}
	}

	#TO DELIVER UPDATE DEFAULT ADDRESS
	if ( (isset($_GET['todelivercostumerproductorder']))& (isset($_GET['costumeraddress']))   ){
		$todelivercostumerproductorder = $_GET['todelivercostumerproductorder'];
		$costumeraddress = $_GET['costumeraddress'];


		$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$costumerprofile_id'";

		if($result = mysqli_query($conn, $sqlcostumername)){
			$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='Default' WHERE `CostumerAddress_ID` = '$costumeraddress'";
			if($result = mysqli_query($conn, $sqlcostumeraddress)){

				$sqlcheckaddress="SELECT * FROM `costumersaddress` WHERE `Status` = 'Default' AND `CostumerProfile_ID` ='$costumerprofile_id'";
				$resultcheckaddress = mysqli_query($conn, $sqlcheckaddress);
					while($row = mysqli_fetch_assoc($resultcheckaddress)){
						$contactnumber = $row['Contact_Number'];
						$emailaddress = $row['Email_Address'];
						$region = $row['Region'];
						$province = $row['Province'];
						$city = $row['City'];
						$barangay = $row['Barangay'];
						$postalcode = $row['Postal_Code'];
						$detailedaddress = $row['Detailed_Address'];
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

				$sqlselectcostumerpurchaseid ="SELECT * FROM costumerproductorders WHERE CostumerProductOrder_ID ='$todelivercostumerproductorder'";
				$resultcostumerpurchaseid = mysqli_query($conn, $sqlselectcostumerpurchaseid);
					while($row = mysqli_fetch_assoc($resultcostumerpurchaseid)){
						$costumerpurchase_id = $row['CostumerPurchase_ID'];
					}

				$sqlupdatecostumerpurchase ="UPDATE `costumerspurchase` SET `Fee`='$fee',`DateReceive`=NOW() + INTERVAL '$deliverydays' DAY WHERE CostumerPurchase_ID ='$costumerpurchase_id'";
				if($result = mysqli_query($conn, $sqlupdatecostumerpurchase)){
					$sqlupdatedefaultaddress ="UPDATE `costumerproductorders` SET `Costumer_Default_Contact_Number`='$contactnumber',`Costumer_Default_Email_Address`='$emailaddress',`Costumer_Default_Region`='$region',`Costumer_Default_Province`='$province',`Costumer_Default_City`='$city',`Costumer_Default_Barangay`='$barangay',`Costumer_Default_Postal_Code`='$postalcode',`Costumer_Default_Detailed_Address`='$detailedaddress' WHERE CostumerProductOrder_ID ='$todelivercostumerproductorder'";
					if($result = mysqli_query($conn, $sqlupdatedefaultaddress)){
						header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$todelivercostumerproductorder&costumeraddress=$costumeraddress&notification=Default");
					}else{
						header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$todelivercostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
					}
				}else{
					header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$todelivercostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
				}
			}else{
				header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$costumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
			}
		}else{
			header("Location: ../forms/costumer/orderdetails_deliver_updateaddress.php?costumerproductorder=$costumerproductorder&costumeraddress=$costumeraddress&notification=ErrorDefault");
		}
	}

?>