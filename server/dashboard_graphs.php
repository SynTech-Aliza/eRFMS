<?php
	$host = 'localhost';
	$user = 'root';
	$pass = '';
	$db = 'serverrfoos';
	$mysqli = new mysqli($host,$user,$pass,$db) or die($mysqli->error);

	$admin	 = '';
	$cashier = '';
	$costumer = '';
	$supplier = '';
	$inventory_clerk = '';
	$numberofcostumers = '';
	$numberofusers = '';

//FOR USERS GRAPH 
	//query to get data from the table
	$sqlusers = "SELECT COUNT(CASE WHEN UserAccountLevel_ID = '1' THEN 1 END) AS 'Admin',
	COUNT(CASE WHEN UserAccountLevel_ID = '2' THEN 1 END) AS 'Inventory Clerk',
	COUNT(CASE WHEN UserAccountLevel_ID = '3' THEN 1 END) AS 'Costumer'
	FROM useraccount";
    $resultusers = mysqli_query($mysqli, $sqlusers);

	//loop through the returned data
	while ($row = mysqli_fetch_array($resultusers)) {

		$admin = $admin . '"'. $row['Admin'].'",';
		$inventory_clerk = $inventory_clerk . '"'. $row['Inventory Clerk'] .'",';
		$costumer = $costumer . '"'. $row['Costumer'] .'",';
	}

	$admin = trim($admin,",");
	$costumer = trim($costumer,",");
	$inventory_clerk = trim($inventory_clerk,",");


//FOR COSTUMERS GRAPH
	//query to get data from the table
	$sqlcostumers = "SELECT COUNT(UserAccount_ID)as NumberofCostumers FROM useraccount WHERE UserAccountLevel_ID = 3 "; //CHANGE TO COSTUMERS
    $resultcostumers = mysqli_query($mysqli, $sqlcostumers);

	//loop through the returned data
	while ($row = mysqli_fetch_array($resultcostumers)) {

		$numberofcostumers = $numberofcostumers . '"'. $row['NumberofCostumers'].'",';
	}

	$numberofcostumers = trim($numberofcostumers,",");

//FOR MONTHLY GRAPH

	//query to get data from the table
	$sqlusers = "SELECT COUNT(*) as NumberofUsers FROM `useraccount`"; //CHANGE TO SALES FROM PRODUCT
    $resultusers = mysqli_query($mysqli, $sqlusers);

	//loop through the returned data
	while ($row = mysqli_fetch_array($resultusers)) {

		$numberofusers = $numberofusers . '"'. $row['NumberofUsers'].'",';
	}

	$numberofusers = trim($numberofusers,",");

//FOR YEARLY GRAPH

	
?>


