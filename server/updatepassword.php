<?php
include "connection/db_conn.php";

if (isset($_GET['update'])){
	$id = $_GET['update'];

	$sql ="SELECT useraccount.UserAccount_ID ,useraccount.Username, useraccount.Password, useraccountlevel.UserAccountLevel_ID, useraccountlevel.AccountDescription FROM useraccount INNER JOIN useraccountlevel ON useraccountlevel.UserAccountLevel_ID = useraccount.UserAccountLevel_ID WHERE useraccount.UserAccount_ID = '$id'";
	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){

	  $useraccount_ID = base64_encode($row['UserAccount_ID']);
	  $user_ID = $row['UserAccount_ID'];
	  $username = $row['Username'];
	  $useraccountlevelid = $row['UserAccountLevel_ID'];
	  $useraccountleveldescription = $row['AccountDescription'];
	}

	if (isset($_POST['submit'])) {

		$uname = $_POST['username'];
		$newpassword = $_POST['newpassword'];
	
		$encrypt2 =md5($_POST['newpassword']);

		$sql = "SELECT * FROM useraccount WHERE Username='$uname'";
		$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result)>0) {
			$sqlupdate = "UPDATE `useraccount` SET `Password`='$encrypt2' WHERE Username ='$uname'";
			$sqlresult = mysqli_query($conn, $sqlupdate);
			header("Location: ../../forms/admin/updatepassword.php?notification=PasswordUpdated");
			exit();
			}else{
			header("Location: ../../forms/admin/updatepassword.php?notification=ErrorUpdating");
			exit();
			}
	}elseif(isset($_POST['cancel'])){
	header("Location:../../forms/admin/viewuseraccount.php");
	exit();
	}
}
?>