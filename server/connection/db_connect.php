<?php
//Page from where the database is connected using the config page.
define("HOST", "localhost");      // The host you want to connect to.
define("USER", "root");         // The database username. 
define("PASSWORD", "");  // The database password. 
define("DATABASE", "serverrfoos");

$mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>