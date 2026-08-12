<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$sqlresult = mysqli_query($conn, $sql);

	#FOR EMPTY VALUE
	if (mysqli_num_rows($sqlresult)==0){
		$first_name = "";
		$middle_name = "";
		$last_name = "";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresult)){
		  $useraccount_id = $row['UserAccount_ID'];
		  $first_name = $row['First_Name'];
		  $middle_name = $row['Middle_Name'];
		  $last_name = $row['Last_Name'];
		}
	}


	if (isset($_POST['save'])) {

		$useraccount_id=$_SESSION['UserAccount_ID'];
		$first_name = $_POST['first_name'];
		$middle_name = $_POST['middle_name'];
		$last_name = $_POST['last_name'];

		$sqlexist = "SELECT * FROM costumersprofile WHERE UserAccount_ID='$useraccount_id'";
		$result = mysqli_query($conn, $sqlexist);
	
		if (mysqli_num_rows($result)>0) {

			$sql="UPDATE `costumersprofile` SET `First_Name`= '$first_name',`Middle_Name`= '$middle_name',`Last_Name`= '$last_name' WHERE UserAccount_ID = '$useraccount_id'";

			if($result = mysqli_query($conn, $sql)){
			header("Location: ../costumer/myprofile.php");
			}else{
			header("Location: ../supplier/myprofile.php");
			}

		}else{
			$sqlalter ="ALTER TABLE costumersprofile AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sql="INSERT INTO `costumersprofile`(UserAccount_ID, First_Name, Middle_Name, Last_Name) VALUES ('$useraccount_id','$first_name', '$middle_name', '$last_name')";
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../costumer/myprofile.php");
				}else{
					header("Location: ../supplier/myprofile.php");
				}
			}else{
				header("Location: ../supplier/myprofile.php?notification=ErrorAlter");
			}
		}
	}
}

?>