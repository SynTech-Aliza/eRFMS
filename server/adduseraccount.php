<?php 
session_start(); 
include "connection/db_conn.php";

if (isset($_POST['submit'])) {

	$username = $_POST['username'];
	$password = $_POST['password'];
	$useraccountlevel = $_POST['useraccountlevel'];
	
	$encrypt = md5($_POST['password']);
	
	$sql = "SELECT * FROM useraccount WHERE Username='$username'";
	$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result)>0) {
			header("Location: ../forms/admin/adduseraccount.php?notification=UsernameExist");
			exit();
		}elseif($useraccountlevel =="Select User Type"){
			header("Location: ../forms/admin/adduseraccount.php?notification=SelectUserAccountLevel");
			exit();
		}
		else{
			$sqlalter ="ALTER TABLE useraccount AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO useraccount (Profile, Username, Password, Status, UserAccountLevel_ID) VALUES ('avatar.png','$username','$encrypt', 'Activate', '$useraccountlevel')";
				$result = mysqli_query($conn, $sql);
				header("Location: ../forms/admin/adduseraccount.php?notification=UserAccountSubmitted");
				exit();
			}else{
				header("Location: ../forms/admin/adduseraccount.php?notification=ErrorAlter");
				exit();
			}
		}

}elseif(isset($_POST['cancel'])){
	header("Location: ../forms/admin/adduseraccount.php");
	exit();
}

