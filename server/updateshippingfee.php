<?php
include "connection/db_conn.php";

if (isset($_GET['update'])){
	$id = $_GET['update'];

	$sql ="SELECT `ShippingFee_ID`, `Location`, `Fee`, `DeliveryDays` FROM `shippingfee` WHERE ShippingFee_ID = '$id'";
	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){

	  $shippingfee_id = $row['ShippingFee_ID'];
	  $location = $row['Location'];
	  $fee = $row['Fee'];
	  $deliverydays = $row['DeliveryDays'];
	}

	if (isset($_POST['submit'])) {

		$location = $_POST['location'];
		$fee = $_POST['fee'];
		$deliverydays = $_POST['deliverydays'];

		$sql = "SELECT * FROM shippingfee WHERE ShippingFee_ID='$id'";
		$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {
				$sqlupdate = "UPDATE `shippingfee` SET `Location`='$location', `Fee`='$fee',`DeliveryDays`='$deliverydays' WHERE ShippingFee_ID ='$id'";
				if($resultupdate = mysqli_query($conn, $sqlupdate)){
					header("Location: ../../forms/clerk/viewshippingfee.php?notification=ShippingFeeUpdated");
				}else{
					header("Location: ../../forms/clerk/viewshippingfee.php?notification=ErrorUpdating");
				}
			}else{
				header("Location: ../../forms/clerk/viewshippingfee.php?notification=Error");
				exit();
			}
	}elseif(isset($_POST['cancel'])){
	header("Location:../../forms/clerk/viewshippingfee.php");
	exit();
	}
}
?>