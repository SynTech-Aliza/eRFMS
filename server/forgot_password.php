<?php

include "connection/db_conn.php";

if (isset($_POST['submit'])) {

	$email = $_POST['email'];
	
	$sql = "SELECT * FROM costumersprofile WHERE Email='$email' LIMIT 1";
	$result = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($result)){
		$useraccount_id = $row['UserAccount_ID'];
		$email = $row['Email'];
	}
	if (mysqli_num_rows($result)> 0) {
		$sqlupdate = "UPDATE `useraccount` SET `Update_Request`=NOW() WHERE UserAccount_ID = '$useraccount_id'";
		$sqlresult = mysqli_query($conn, $sqlupdate);
		header("Location: ../server/send_email.php?email=$email");
	}else{
		header("Location: ../forms/forgot_password.php?notification=ErrorEmail");
	}
}

if (isset($_POST['cancel'])) {
	header("Location: ../forms/login.php");
}

?>