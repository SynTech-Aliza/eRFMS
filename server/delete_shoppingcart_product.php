<?php
include "connection/db_conn.php";

if(isset($_GET['productremove'])){
	$productremove = $_GET['productremove'];

	$sqlproductremove="DELETE FROM `costumersshoppingcart` WHERE `Product_ID` = '$productremove' ORDER BY CostumerShoppingCart_ID DESC";
	if($resultproductremove = mysqli_query($conn, $sqlproductremove)){
		header("Location: ../forms/costumer/shopping_cart.php?notification=Remove");
	}else{
		header("Location: ../forms/costumer/shopping_cart.php?error");
	}	
}
?>