<?php 
session_start(); 
include "connection/db_conn.php";

if (isset($_SESSION['Username'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sqluser ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";
	$sqlresultuser = mysqli_query($conn, $sqluser);
	if (mysqli_num_rows($sqlresultuser)==0){
		$costumerprofile_id = "";
	}else{
		while($row = mysqli_fetch_assoc($sqlresultuser)){
			$costumerprofile_id = $row['CostumerProfile_ID'];
		}
	}

	if(isset($_GET['costumerproductorder'])){
			$costumerproductorder = $_GET['costumerproductorder'];

		if (isset($_POST['save'])) {
			$region = $_POST['region'];
			$province = $_POST['province'];
			$city = $_POST['city'];
			$barangay = $_POST['barangay'];
			$postal_code = $_POST['postal_code'];
			$contact_number = $_POST['contact_number'];
			$email_address = $_POST['email_address'];
			$detailed_address = $_POST['detailed_address'];

			#CHECK REGION
			$sqlregion = "SELECT * FROM region WHERE Region_ID='$region'";
			$resultregion = mysqli_query($conn, $sqlregion);
			while($row = mysqli_fetch_assoc($resultregion)){
				$region_name = $row['Region'];
				$addministrative_region = $row['Administrative_Region'];
			}
			$dataregion = $region_name." (".$addministrative_region.")";

			#CHECK PROVINCE
			$sqlprovince = "SELECT * FROM province WHERE Province_ID='$province'";
			$resultprovince = mysqli_query($conn, $sqlprovince);
			while($row = mysqli_fetch_assoc($resultprovince)){
				$province_name = $row['Province'];
			}

			#CHECK CITY
			$sqlcity = "SELECT * FROM city WHERE City_ID='$city'";
			$resultcity = mysqli_query($conn, $sqlcity);
			while($row = mysqli_fetch_assoc($resultcity)){
				$city_name = $row['City'];
			}

			#CHECK BARANGAY
			$sqlbarangay = "SELECT * FROM barangay WHERE Barangay_ID='$barangay'";
			$resultbarangay = mysqli_query($conn, $sqlbarangay);
			while($row = mysqli_fetch_assoc($resultbarangay)){
				$barangay_name = $row['Barangay'];
			}

			$sqlalter ="ALTER TABLE costumersaddress AUTO_INCREMENT = 1;";
			if($resultalter = mysqli_query($conn, $sqlalter)){
				$sqlinsertaddress="INSERT INTO `costumersaddress`(`CostumerProfile_ID`, `Contact_Number`, `Email_Address`, `Region`, `Province`, `City`, `Barangay`, `Postal_Code`, `Detailed_Address`) VALUES ('$costumerprofile_id','$contact_number', '$email_address', '$dataregion', '$province_name', '$city_name', '$barangay_name', '$postal_code', '$detailed_address')";
					
					if($result = mysqli_query($conn, $sqlinsertaddress)){
						header("Location: ../costumer/orderdetails_topay_addnewaddress.php?notification=SuccesfullySubmit&costumerproductorder=$costumerproductorder");
					}else{
						header("Location: ../costumer/orderdetails_topay_addnewaddress.php?notification=ErrorSubmit&costumerproductorder=$costumerproductorder");
					}
			}else{
				header("Location: ../costumer/orderdetails_topay_addnewaddress.php.php?notification=Error&costumerproductorder=$costumerproductorder");
			}
		}
}
}
?>