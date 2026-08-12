<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$username = $_SESSION['Username'];


	if (isset($_POST['continue_delete_account'])) {
		$useraccount_id=$_SESSION['UserAccount_ID'];

		$sqlupdate="UPDATE `useraccount` SET `Deletion_Request`= NOW() WHERE UserAccount_ID = '$useraccount_id'";

		if($result = mysqli_query($conn, $sqlupdate)){
			$sqlinsert="INSERT INTO `useraccountdeletion`(`UserAccount_ID`, `Delete_At`) VALUES ($useraccount_id, NOW() + INTERVAL 30 DAY)";

			if($result = mysqli_query($conn, $sqlinsert)){
				header("Location: ../../server/logout.php");
			}else{
				header("Location: ../costumer/account_deleted.php");
			}

		}else{
			header("Location: ../costumer/account_deleted.php");
		}

	}if (isset($_POST['cancel'])) {
		header("Location: ../costumer/confirm_account_deletion.php");
	}
}

?>