<?php

$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "serverrfoos";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}
?>

<?php
//MySQLi Procedural
$conn = mysqli_connect("localhost","root","","serverrfoos");
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}
?>

<?php 
//MYSQL CONNECTION REPORT
$connect = mysqli_connect("localhost", "root", "", "serverrfoos");
?>

<?php


$mysqli = new mysqli($sname, $unmae, $password, $db_name);
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
?>
