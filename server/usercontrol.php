<?php
session_start();

if($_SESSION['UserAccountLevel_ID'] == 1){
	header("Location: ../forms/admin/dashboard.php");
	exit();
}elseif($_SESSION['UserAccountLevel_ID'] == 2){
	header("Location: ../forms/clerk/dashboard.php");
	exit();
}elseif($_SESSION['UserAccountLevel_ID'] == 3){
	header("Location: ../forms/costumer/dashboard.php");
	exit();
}else{
	header("Location: ../forms/login.php");
	exit();
}
?>