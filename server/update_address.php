<?php

include "connection/db_conn.php";

if (isset($_GET['profile'])){
	$profile = $_GET['profile'];

	$sqlcostumername ="SELECT * FROM `costumersprofile` WHERE `CostumerProfile_ID` = '$profile'";

	$sqlresultcostumername = mysqli_query($conn, $sqlcostumername);

	#FOR VALUE TO DISPLAY
	while($row = mysqli_fetch_assoc($sqlresultcostumername)){
		$first_name = $row['First_Name'];
		$middle_name = $row['Middle_Name'];
		$last_name = $row['Last_Name'];
	}
}

if (isset($_GET['address'])){
	$address = $_GET['address'];

	$sqlcostumername ="SELECT * FROM `costumersaddress` WHERE `CostumerAddress_ID` = '$address'";

	$sqlresultcostumername = mysqli_query($conn, $sqlcostumername);

	#FOR VALUE TO DISPLAY
	while($row = mysqli_fetch_assoc($sqlresultcostumername)){
		$cotumeraddress_id = $row['CostumerAddress_ID'];
		$cotumerprofile_id = $row['CostumerProfile_ID'];
		$contact_number = $row['Contact_Number'];
		$email_address = $row['Email_Address'];
		$region = $row['Region'];
		$province = $row['Province'];
		$city = $row['City'];
		$barangay = $row['Barangay'];
		$postal_code = $row['Postal_Code'];
		$detailed_address = $row['Detailed_Address'];
		$status = $row['Status'];
	}
}

if (isset($_POST['save'])) {
	header("Location: ../costumer/myaddress.php");
}

?>