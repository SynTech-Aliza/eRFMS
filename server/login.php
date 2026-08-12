<?php 
session_start(); 
include "connection/db_conn.php";

if (isset($_POST['username']) && isset($_POST['password'])) {

	function validate($data){
       $data = trim($data);
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	}

	$username = validate($_POST['username']);
	$password = validate($_POST['password']);
	
	$encrypt = md5(validate($_POST['password']));
	
		$sql = "SELECT * FROM useraccount WHERE Username='$username' AND Password='$encrypt'";

		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			
			$_SESSION['UserAccount_ID'] = $row['UserAccount_ID'];
			$_SESSION['Username'] = $row['Username'];
			$_SESSION['Profile'] = $row['Profile'];
			$_SESSION['UserAccountLevel_ID'] = $row['UserAccountLevel_ID'];

				if ($row['Status'] === "Activate" ) {

					$sqluser = "UPDATE `useraccount` SET `Deletion_Request`= 0000-00-0 WHERE Username = '$username'";
					if($result = mysqli_query($conn, $sqluser)){
						$useraccount_Id = $row['UserAccount_ID'];
						$sqltrash = "DELETE FROM useraccountdeletion WHERE UserAccount_ID = '$useraccount_Id'";
						$results = mysqli_query($conn, $sqltrash);
						header("Location:usercontrol.php");
						exit();
					}else{
						header("Location: ../forms/login.php");
						exit();
					}
				}else{
					header("Location: ../forms/login.php?notification=AccountDeactivate");
			    	exit();
				}
		}else{
			header("Location: ../forms/login.php?notification=AccountNotExist");
			exit();
		}
}else{
	header("Location: ../forms/login.php");
	exit();
}