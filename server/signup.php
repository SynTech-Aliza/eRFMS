<?php

include "connection/db_conn.php";

if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	
	$encrypt = md5($_POST['password']);
	
	$sql = "SELECT * FROM useraccount WHERE Username='$username'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result)>0) {
		header("Location: ../forms/signup.php?notification=UsernameAlreadyExist");
		exit();
	}else{
		$sqlalter ="ALTER TABLE useraccount AUTO_INCREMENT = 1;";
		if($resultalter = mysqli_query($conn, $sqlalter)){
			$sql="INSERT INTO useraccount (Profile, Username, Password, Status, UserAccountLevel_ID) VALUES ('avatar.png','$username','$encrypt', 'Activate', 3)";
			$result = mysqli_query($conn, $sql);
			header("Location: ../forms/login.php");
		}else{
			header("Location: ../forms/signup.php?notification=ErrorAlter");
		}
	}
}



?>