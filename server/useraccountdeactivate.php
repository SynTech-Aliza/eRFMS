<?php 

include "connection/db_conn.php";

if (isset($_GET['deactivate'])){
	$id = $_GET['deactivate'];

	$sql="UPDATE `useraccount` SET Status ='Deactivate' WHERE UserAccount_ID = '$id'";
	$result = mysqli_query($conn, $sql);
		header("Location: ../forms/admin/viewuseraccount.php?notification=Deactivate");
}else{
		header("Location: ../forms/admin/viewuseraccount.php");
		exit();
}
?>