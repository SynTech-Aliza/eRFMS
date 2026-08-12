<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$sqlresult = mysqli_query($conn, $sql);

	#FOR EMPTY VALUE
	if (mysqli_num_rows($sqlresult)==0){
		$contact_number = "";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresult)){
		  $costumer_id = $row['CostumerProfile_ID'];	
		  $useraccount_id = $row['UserAccount_ID'];
		  $contact_number = $row['Contact_Number'];
		}
	}

	if (isset($_POST['save'])) {
		$useraccount_id=$_SESSION['UserAccount_ID'];
		$contact_number = $_POST['contact_number'];

			if($costumer_id == 0){
				$sqlcontactnumber ="SELECT * FROM `costumersprofile` WHERE Contact_Number = '$contact_number'";
				$sqlresultcontactnumber = mysqli_query($conn, $sqlcontactnumber);
				if (mysqli_num_rows($sqlresultcontactnumber)==0){
					$sqlalter ="ALTER TABLE costumersprofile AUTO_INCREMENT = 1;";
					if($resultalter = mysqli_query($conn, $sqlalter)){	
						$sql="INSERT INTO `costumersprofile`(UserAccount_ID,Contact_Number) VALUES ('$useraccount_id','$contact_number')";
						if($result = mysqli_query($conn, $sql)){
							header("Location: ../costumer/myprofile.php");
						}else{
							header("Location: ../supplier/myprofile.php");
						}
					}else{
						header("Location: ../supplier/myprofile.php?notification=ErrorAlter");
					}
				}else{
					header("Location: ../costumer/update_contact_number.php?notification=ContactNumberExist");
				}
			}else{
				$sqlcontactnumber ="SELECT * FROM `costumersprofile` WHERE Contact_Number = '$contact_number'";
				$sqlresultcontactnumber = mysqli_query($conn, $sqlcontactnumber);
				if (mysqli_num_rows($sqlresultcontactnumber)==0){
					$sql="UPDATE `costumersprofile` SET `Contact_Number`= '$contact_number' WHERE UserAccount_ID = '$useraccount_id'";

					if($result = mysqli_query($conn, $sql)){
						header("Location: ../costumer/myprofile.php");
					}else{
						header("Location: ../supplier/myprofile.php");
					}
				}else{
					header("Location: ../costumer/update_contact_number.php?notification=ContactNumberExist");
				}
			}
			
		}
}

?>