<?php
//fetch all country data from database
//Include database configuration file
include('include/db_connect.php');

    $query = $mysqli->query("SELECT * FROM region ORDER BY Region_ID ASC");// select all country from database 

    //Count total number of rows
    $rowCount = $query->num_rows;

    //Display states list
    if($rowCount > 0)
		
		{
	echo '<option value="">Select Country</option>';// initial message display{  
	//echo '<input type="text" >';// initial message display
        
        while($row = $query->fetch_assoc())
		{
            echo '<option value="'.$row['Region_ID'].'">'.$row['Region'].'</option>';// select country id & name from country table
        }
    }
	else
	{
        echo '<option value="">Country Not Available</option>'; //display when no data!
	}



?>
