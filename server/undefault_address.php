<?php

include "connection/db_conn.php";

if ( (isset($_GET['profile']))& (isset($_GET['address']))   ){
	$profile = $_GET['profile'];
	$address = $_GET['address'];


	$sqlcostumername ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerProfile_ID` = '$profile'";

	if($result = mysqli_query($conn, $sqlcostumername)){
		$sqlcostumeraddress ="UPDATE `costumersaddress` SET `Status`='' WHERE `CostumerAddress_ID` = '$address'";
		if($result = mysqli_query($conn, $sqlcostumeraddress)){
			header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address");
		}else{
			header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address");
		}
	}else{
		header("Location: ../forms/costumer/update_address.php?profile=$profile&address=$address");
	}
}


?>