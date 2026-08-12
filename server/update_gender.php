<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$sqlresult = mysqli_query($conn, $sql);

	#FOR EMPTY VALUE
	if (mysqli_num_rows($sqlresult)==0){
		$gender = "";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresult)){
		  $costumer_id = $row['CostumerProfile_ID'];	
		  $useraccount_id = $row['UserAccount_ID'];
		  $gender = $row['Gender'];
		}
	}


	if (isset($_POST['save'])) {

		$useraccount_id=$_SESSION['UserAccount_ID'];
		$gender = $_POST['gender'];

		if($costumer_id == 0){
			$sqlalter ="ALTER TABLE costumersprofile AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersprofile`(UserAccount_ID,Gender) VALUES ('$useraccount_id','$gender')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../costumer/myprofile.php");
				}else{
					header("Location: ../supplier/myprofile.php");
				}
			}else{
				header("Location: ../supplier/myprofile.php?notication=ErrorAlter");
			}
		}else{
			$sql="UPDATE `costumersprofile` SET `Gender`= '$gender' WHERE UserAccount_ID = '$useraccount_id'";

			if($result = mysqli_query($conn, $sql)){
			header("Location: ../costumer/myprofile.php");
			}else{
			header("Location: ../supplier/myprofile.php");
			}
		}

	}
}

?>