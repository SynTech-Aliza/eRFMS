<?php 
session_start(); 
include "connection/db_conn.php";

#ADD NEW SHIPPING FEE
if(isset($_POST['submit'])){
	$location = $_POST['location'];
	$fee = $_POST['fee'];
	$deliverydays = $_POST['deliverydays'];

	$sqlcheckshippingfee = "SELECT * FROM shippingfee WHERE Location='$location' AND Fee ='$fee' AND DeliveryDays ='$deliverydays'";
	$resultshippingfee = mysqli_query($conn, $sqlcheckshippingfee);
		if (mysqli_num_rows($resultshippingfee)>0) {
			header("Location: ../forms/clerk/addnewshippingfee.php?notification=ExistLocation");
		}else{
			$sqlalter ="ALTER TABLE shippingfee AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sqlinsertshippingfee="INSERT INTO `shippingfee`(`Location`, `Fee`, `DeliveryDays`) VALUES ('$location','$fee', '$deliverydays')";
				if($resultshippingfee = mysqli_query($conn, $sqlinsertshippingfee)){
					header("Location: ../forms/clerk/addnewshippingfee.php?notification=Success");
				}else{
					header("Location: ../forms/clerk/addnewshippingfee.php?notification=Error");
				}
			}else{
				header("Location: ../forms/clerk/addnewshippingfee.php?notification=ErrorAlter");
			}
		}
	
}elseif(isset($_POST['cancel'])){
	header("Location: ../forms/clerk/addregionaddress.php");
}

?>