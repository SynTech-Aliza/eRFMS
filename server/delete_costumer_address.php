<?php

include "connection/db_conn.php";

if (isset($_GET['address'])){
	$address = $_GET['address'];

	$sqladdressdelete ="DELETE FROM `costumersaddress` WHERE `CostumerAddress_ID`= '$address' ORDER BY CostumerAddress_ID DESC LIMIT 1";

	if($result = mysqli_query($conn, $sqladdressdelete)){
		header("Location: ../forms/costumer/myaddress.php?notification=Delete");
	}else{
		header("Location: ../forms/costumer/myaddress.php?notification=ErrorDelete");
	}
}

if ( (isset($_GET['costumerproductorder']))& (isset($_GET['costumeraddress']))   ){
		$costumerproductorder = $_GET['costumerproductorder'];
		$costumeraddress = $_GET['costumeraddress'];

		$sqladdressdelete ="DELETE FROM `costumersaddress` WHERE `CostumerAddress_ID`= '$costumeraddress' ORDER BY CostumerAddress_ID DESC LIMIT 1";

		if($result = mysqli_query($conn, $sqladdressdelete)){
			header("Location: ../forms/costumer/orderdetails_topay_addressselection.php?costumerproductorder=$costumerproductorder&notification=Delete");
		}else{
			header("Location: ../forms/costumer/orderdetails_topay_addressselection.php?costumerproductorder=$costumerproductorder&notification=ErrorDelete");
		}
}

?>