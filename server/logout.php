<?php
session_start();
if(isset($_SESSION['Username'])){
	session_destroy();
	header("Location: ../forms/login.php");
	exit();
}else{
	header("Location: ../forms/login.php");
	exit();
}

?>