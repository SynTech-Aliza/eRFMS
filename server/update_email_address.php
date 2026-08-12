<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$sqlresult = mysqli_query($conn, $sql);

	#FOR EMPTY VALUE
	if (mysqli_num_rows($sqlresult)==0){
		$email_address = "";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresult)){
		  $costumer_id = $row['CostumerProfile_ID'];	
		  $useraccount_id = $row['UserAccount_ID'];
		  $email_address = $row['Email'];
		}
	}

	

	if (isset($_POST['save'])) {
		$useraccount_id=$_SESSION['UserAccount_ID'];
		$email_address = $_POST['email_address'];

			if($costumer_id == 0){
				$sqlemail ="SELECT * FROM `costumersprofile` WHERE Email = '$email_address'";
				$sqlresultemail = mysqli_query($conn, $sqlemail);
				if (mysqli_num_rows($sqlresultemail)==0){
					$sqlalter ="ALTER TABLE costumersprofile AUTO_INCREMENT = 1;";
					if($resultalter = mysqli_query($conn, $sqlalter)){
						$sql="INSERT INTO `costumersprofile`(UserAccount_ID,Email) VALUES ('$useraccount_id','$email_address')";
						if($result = mysqli_query($conn, $sql)){
							header("Location: ../costumer/myprofile.php");
						}else{
							header("Location: ../supplier/myprofile.php");
						}
					}else{
						header("Location: ../supplier/myprofile.php?notification=ErrorAlter");
					}
				}else{
					header("Location: ../costumer/update_email_address.php?notification=EmailExist");
				}
			}else{
				$sqlemail ="SELECT * FROM `costumersprofile` WHERE Email = '$email_address'";
				$sqlresultemail = mysqli_query($conn, $sqlemail);
				if (mysqli_num_rows($sqlresultemail)==0){
					$sql="UPDATE `costumersprofile` SET `Email`= '$email_address' WHERE UserAccount_ID = '$useraccount_id'";
					if($result = mysqli_query($conn, $sql)){
						header("Location: ../costumer/myprofile.php");
					}else{
						header("Location: ../supplier/myprofile.php");
					}
				}else{
					header("Location: ../costumer/update_email_address.php?notification=EmailExist");
				}
			}
		}


}

?>