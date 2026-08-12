<?php

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

	if( (isset($_GET['costumeraddress'])) && (isset($_GET['costumerproductorder'])) ){
	$costumeraddress = $_GET['costumeraddress'];
	$costumerproductorder = $_GET['costumerproductorder'];

	$sqlcostumername ="SELECT * FROM `costumersaddress` WHERE `CostumerAddress_ID` = '$costumeraddress'";

	$sqlresultcostumername = mysqli_query($conn, $sqlcostumername);
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresultcostumername)){
			$cotumeraddress_id = $row['CostumerAddress_ID'];
			$cotumerprofile_id = $row['CostumerProfile_ID'];
			$contact_number = $row['Contact_Number'];
			$email_address = $row['Email_Address'];
			$region = $row['Region'];
			$province = $row['Province'];
			$city = $row['City'];
			$barangay = $row['Barangay'];
			$postal_code = $row['Postal_Code'];
			$detailed_address = $row['Detailed_Address'];
			$status = $row['Status'];
		}

		if (isset($_POST['save'])) {
			header("Location: ../costumer/orderdetails_topay_addressselection.php?costumerproductorder=$costumerproductorder");
		}
	}

	
}

?>