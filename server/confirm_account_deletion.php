<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$username = $_SESSION['Username'];


	if (isset($_POST['continue'])) {
		$password = md5($_POST['password']);

		$sql = "SELECT * FROM useraccount WHERE Username='$username' AND Password ='$password'";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			header("Location: ../costumer/account_deleted.php");
		}else{
			header("Location: ../costumer/confirm_account_deletion.php?error=Incorrect Password. Please try it again.");
		}

	}if (isset($_POST['cancel'])) {
		header("Location: ../costumer/request_account_deletion.php");
	}
}

?>