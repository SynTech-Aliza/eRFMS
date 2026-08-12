<?php
include('connection/db_connect.php');

$query = $mysqli->query("SELECT * FROM region ORDER BY Region_ID ASC");// select all country from database 
$rowCount = $query->num_rows;

    if($rowCount > 0){
		echo '<option value="">Select Region</option>';
        while($row = $query->fetch_assoc()){
        	echo '<option value="'.$row['Region_ID'].'">'.$row['Region'].'</option>';
        }
    }else{
        echo '<option value="">Country Not Available</option>';
	}



?>
