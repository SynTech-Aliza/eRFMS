<?php

include "connection/db_conn.php";
	if (isset($_POST['save'])) {
		$username=$_SESSION['Username'];
		$currentpassword = md5($_POST['current_password']);
		$new_password = $_POST['new_password'];
		$encrypt_new_password = md5($_POST['new_password']);
		$confirm_password = $_POST['confirm_password'];

		$sql = "SELECT * FROM useraccount WHERE Username='$username' AND Password='$currentpassword'";

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			if($new_password == $confirm_password){
				$sql="UPDATE `useraccount` SET `Password`='$encrypt_new_password' WHERE Username ='$username'";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../costumer/change_password.php?notification=Updated");
				}else{
					header("Location: ../costumer/change_password.php?notification=ErrorPasswordUpdated");
				}
			}else{
				header("Location: ../costumer/change_password.php?notification=NotMatch");
			}
		}else{
			header("Location: ../costumer/change_password.php?notification=ErrorPassword");
		}
	}
?>