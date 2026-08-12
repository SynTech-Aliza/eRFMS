<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	if (isset($_POST['continue_account_deletion'])) {
		header("Location: ../costumer/confirm_account_deletion.php");
	}if (isset($_POST['cancel'])) {
		header("Location: ../costumer/settings.php");
	}
}

?>