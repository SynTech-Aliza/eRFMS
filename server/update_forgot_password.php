<?php
include "connection/db_conn.php";
if (isset($_GET['encrypt'])){
	$decryptemail = base64_decode($_GET['encrypt']);

	$sql = "SELECT * FROM costumersprofile WHERE Email='$decryptemail' LIMIT 1";
	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){
	$useraccount_id = $row['UserAccount_ID'];
	$email = $row['Email'];
	}


	if (isset($_POST['submit'])) {
		$newpassword = $_POST['newpassword'];
		$retypenewpassword = $_POST['retypenewpassword'];
		$encryptnewpassword = md5($_POST['retypenewpassword']);
	
		if($newpassword == $retypenewpassword){
			$sql ="SELECT * FROM useraccount WHERE `Update_Request` = CURRENT_DATE() AND `UserAccount_ID` = '$useraccount_id'";
		
		$sqlresult = mysqli_query($conn, $sql);
		if (mysqli_num_rows($sqlresult) == 1) {
			$sqlupdate = "UPDATE `useraccount` SET `Password`='$encryptnewpassword', `Update_Request` = '0000-00-00' WHERE `UserAccount_ID` ='$useraccount_id'";
			if($sqlresult = mysqli_query($conn, $sqlupdate)){
				header("Location: ../forms/update_forgot_password.php?notification=Updated");
				exit();
			}else{
				header("Location: ../forms/update_forgot_password.php?notification=Error");
				exit();
			}
		}else{
			header("Location: ../forms/update_forgot_password.php?notification=RequestError");
			exit();
		}
		}else{
			header("Location: ../forms/update_forgot_password.php?notification=PasswordNotMatch");
			exit();
		}
	}
}
?>