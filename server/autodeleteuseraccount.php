<?php
include "connection/db_conn.php";

	$sqldeletion="SELECT * FROM `useraccountdeletion` WHERE `Delete_At` = CURRENT_DATE()";

	$resultdeletion = mysqli_query($conn, $sqldeletion);

	if (mysqli_num_rows($resultdeletion)==0){
		$useraccountdeletion_id ="";
  		$user_id ="";
  		$delete_at ="";
	}else{
		while($rowdeletion = mysqli_fetch_assoc($resultdeletion)){
  		$useraccountdeletion_id =$rowdeletion['UserAccountDeletion_ID'];
  		$user_id =$rowdeletion['UserAccount_ID'];
  		$delete_at =$rowdeletion['Delete_At'];
  		}
	}
	
	$sqluseraccount="SELECT * FROM useraccount WHERE `Deletion_Request` = CURRENT_DATE() - INTERVAL 30 DAY";
	$resultuseraccount = mysqli_query($conn, $sqluseraccount);
	if (mysqli_num_rows($resultuseraccount)==0){
		$useraccount_id ="";
  		$profile ="";
	}else{
		while($rowuseraccount = mysqli_fetch_assoc($resultuseraccount)){
  		$useraccount_id =$rowuseraccount['UserAccount_ID'];
  		$profile =$rowuseraccount['Profile'];
  		}
	}
  	#DELETING IMAGE IN FOLDER
	$deletepath = "../style/assets/profiles/$profile";
	if($profile == ""){
	}else{
		if(!unlink($deletepath)){
		}else{	
		}
	}
	

	#FOR AUTO DELETE USER ACCOUNT FOR 30 DAYS IN USERACCOUNTDELETION
  	$sqldeleteuser="DELETE FROM useraccountdeletion WHERE Delete_At = CURRENT_DATE()";
	$resultdeleteuser = mysqli_query($conn, $sqldeleteuser);
	
	#FOR AUTO DELETE USER ACCOUNT FOR 30 DAYS IN USERACCOUNT
	$sqluser="DELETE FROM `useraccount` WHERE `Deletion_Request` = CURRENT_DATE() - INTERVAL 30 DAY";
	$resultuser = mysqli_query($conn, $sqluser);
  	
?>