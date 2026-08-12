<?php

include "connection/db_conn.php";
$sqlregion = "SELECT * FROM `region`";

$resultregion = mysqli_query($conn, $sqlregion);


$sqlprovince = "SELECT * FROM `province`";

$resultprovince = mysqli_query($conn, $sqlprovince);

$sqlcity = "SELECT * FROM `city`";

$resultcity = mysqli_query($conn, $sqlcity);

$sqlbarangay = "SELECT * FROM `barangay`";

$resultbarangay = mysqli_query($conn, $sqlbarangay);

if ( (isset($_GET['profile']))& (isset($_GET['address']))   ){
	$profile = $_GET['profile'];
	$address = $_GET['address'];

	$sql ="SELECT * FROM `costumersaddress` WHERE `CostumerAddress_ID` = '$address'";

	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){
		  $region = $row['Region'];
		  $province = $row['Province'];
		  $city = $row['City'];
		  $barangay = $row['Barangay'];
		  $postal_code = $row['Postal_Code'];
		  $detailed_address = $row['Detailed_Address'];
	}
}


if (isset($_POST['save'])) {
	$region = $_POST['region'];
	$province = $_POST['province'];
	$city = $_POST['city'];
	$barangay = $_POST['barangay'];
	$postal_code = $_POST['postal_code'];
	$detailed_address = $_POST['detailed_address'];

	$sql="UPDATE `costumersaddress` SET `Region`= '$region',`Province`= '$province',`City`= '$city',`Barangay`= '$barangay',`Postal_Code`= '$postal_code',`Detailed_Address`= '$detailed_address' WHERE CostumerAddress_ID = '$address'";
	if($result = mysqli_query($conn, $sql)){
		header("Location: ../costumer/update_address.php?profile=$profile&address=$address");
	}else{
		header("Location: ../costumer/update_address.php?profile=$profile&address=$address");
	}
}
?>