<?php
include('connection/db_connect.php');

#FOR PROVINCE
if(isset($_POST["region_id"]) && !empty($_POST["region_id"])){
    $query = $mysqli->query("SELECT * FROM province WHERE Region_ID = ".$_POST['region_id']." ORDER BY Province_ID ASC");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">Select Province</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['Province_ID'].'">'.$row['Province'].'</option>';
        }
    }else{
        echo '<option value="">State not available</option>';
    }
}

#FOR CITY
if(isset($_POST["province_id"]) && !empty($_POST["province_id"])){
    $query = $mysqli->query("SELECT * FROM city WHERE Province_ID = ".$_POST['province_id']." ORDER BY City_ID ASC");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">Select City</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['City_ID'].'">'.$row['City'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}

#FOR CITY
if(isset($_POST["city_id"]) && !empty($_POST["city_id"])){
    $query = $mysqli->query("SELECT * FROM barangay WHERE City_ID = ".$_POST['city_id']." ORDER BY Barangay_ID ASC");
    $rowCount = $query->num_rows;
    if($rowCount > 0){
        echo '<option value="">Select Barangay</option>';
        while($row = $query->fetch_assoc()){
            echo '<option value="'.$row['Barangay_ID'].'">'.$row['Barangay'].'</option>';
        }
    }else{
        echo '<option value="">Barangay not available</option>';
    }
}




?>
