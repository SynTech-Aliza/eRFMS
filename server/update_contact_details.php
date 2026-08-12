<?php

include "connection/db_conn.php";

if ( (isset($_GET['profile']))& (isset($_GET['address']))   ){
	$profile = $_GET['profile'];
	$address = $_GET['address'];

	$sql ="SELECT * FROM `costumersaddress` WHERE `CostumerAddress_ID` = '$address'";

	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){
		  $contact_number = $row['Contact_Number'];
		  $email_address = $row['Email_Address'];
	}
}


if (isset($_POST['save'])) {
	$contact_number = $_POST['contact_number'];
	$email_address = $_POST['email_address'];

	$sql="UPDATE `costumersaddress` SET `Contact_Number`= '$contact_number',`Email_Address`= '$email_address' WHERE CostumerAddress_ID = '$address'";

	if($result = mysqli_query($conn, $sql)){
		header("Location: ../costumer/update_address.php?profile=$profile&address=$address");
	}else{
		header("Location: ../costumer/update_address.php?profile=$profile&address=$address");
	}
}
?>