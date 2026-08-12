<?php
include "connection/db_conn.php";
session_start();

if ( (isset($_GET['profile']))& (isset($_GET['address']))   ){
	$profile = $_GET['profile'];
	$address = $_GET['address'];


	$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$profile'";

	if($result = mysqli_query($conn, $sqlcostumername)){
		$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerAddress_ID` = '$address'";
		if($result = mysqli_query($conn, $sqlcostumeraddress)){
			header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address&notification=NonDefault");
		}else{
			header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address&notification=ErrorNonDefault");
		}
	}else{
		header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address&notification=ErrorNonDefault");
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

#TO PAY START
	if ( (isset($_GET['topaycostumerproductorder'])) && (isset($_GET['costumeraddress']))   ){
		$topaycostumerproductorder = $_GET['topaycostumerproductorder'];
		$costumeraddress = $_GET['costumeraddress'];


		$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$costumerprofile_id'";

		if($result = mysqli_query($conn, $sqlcostumername)){
			$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerAddress_ID` = '$costumeraddress'";
			if($result = mysqli_query($conn, $sqlcostumeraddress)){
				header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=NonDefault");
			}else{
				header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorNonDefault");
			}
		}else{
			header("Location: ../forms/costumer/orderdetails_topay_updateaddress.php?costumerproductorder=$topaycostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorNonDefault");
		}
	}
#TO PAY END
#TO DELIVER START
	if ( (isset($_GET['todelivercostumerproductorder'])) && (isset($_GET['costumeraddress']))   ){
		$todelivercostumerproductorder = $_GET['todelivercostumerproductorder'];
		$costumeraddress = $_GET['costumeraddress'];


		$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$costumerprofile_id'";

		if($result = mysqli_query($conn, $sqlcostumername)){
			$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerAddress_ID` = '$costumeraddress'";
			if($result = mysqli_query($conn, $sqlcostumeraddress)){
				header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$todelivercostumerproductorder&costumeraddress=$costumeraddress&notification=NonDefault");
			}else{
				header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$todelivercostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorNonDefault");
			}
		}else{
			header("Location: ../forms/costumer/orderdetails_todeliver_updateaddress.php?costumerproductorder=$todelivercostumerproductorder&costumeraddress=$costumeraddress&notification=ErrorNonDefault");
		}
	}
#TO DELIVER END
?>