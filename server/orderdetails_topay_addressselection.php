<?php
session_start(); 
include "connection/db_conn.php";


if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sqlcostumer ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";

	$resultcostumer = mysqli_query($conn, $sqlcostumer);

	if (mysqli_num_rows($resultcostumer)==0){
		$costumerprofile_id ="";
	}else{
		while($row = mysqli_fetch_assoc($resultcostumer)){
		 $costumerprofile_id = $row['CostumerProfile_ID'];
		 $first_name = $row['First_Name'];
		 $middle_name = $row['Middle_Name'];
		 $last_name = $row['Last_Name'];
		}
	}
	

	$sqlcostumeraddress="SELECT * FROM `costumersaddress` WHERE CostumerProfile_ID = '$costumerprofile_id' ORDER BY CostumerAddress_ID DESC ";

	$resultcostumeraddress = mysqli_query($conn, $sqlcostumeraddress);
	

}

	if(isset($_GET['costumerproductorder'])){
		$costumerproductorder = $_GET['costumerproductorder'];
	}


?>