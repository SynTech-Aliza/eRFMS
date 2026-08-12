<?php
include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$sqlresult = mysqli_query($conn, $sql);

	#FOR EMPTY VALUE
	if (mysqli_num_rows($sqlresult)==0){
		$birthday = "";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresult)){
		  $costumer_id = $row['CostumerProfile_ID'];
		  $useraccount_id = $row['UserAccount_ID'];
		  $birthday = $row['Birthday'];
		}
	}


	if (isset($_POST['save'])) {

		$useraccount_id=$_SESSION['UserAccount_ID'];
		$birthday = $_POST['birthday'];

		if($costumer_id == 0){
			$sqlalter ="ALTER TABLE costumersprofile AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersprofile`(UserAccount_ID,Birthday) VALUES ('$useraccount_id','$birthday')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../costumer/myprofile.php");
				}else{
					header("Location: ../supplier/myprofile.php");
				}
			}else{
				header("Location: ../supplier/myprofile.php?notification=ErrorAlter");
			}
		}else{
			$sql="UPDATE `costumersprofile` SET `Birthday`= '$birthday' WHERE UserAccount_ID = '$useraccount_id'";

			if($result = mysqli_query($conn, $sql)){
			header("Location: ../costumer/myprofile.php");
			}else{
			header("Location: ../supplier/myprofile.php");
			}
		}
	}
}

?>