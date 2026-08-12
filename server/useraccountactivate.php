<?php 

include "connection/db_conn.php";

if (isset($_GET['activate'])){
	$id = $_GET['activate'];

	$sql="UPDATE `useraccount` SET Status ='Activate' WHERE UserAccount_ID = '$id'";
	$result = mysqli_query($conn, $sql);
		header("Location: ../forms/admin/viewuseraccount.php?notification=Activate");
}else{
		header("Location: ../forms/admin/viewuseraccount.php");
		exit();
}
?>