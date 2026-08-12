<?php

include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sql ="SELECT * FROM `costumersprofile` WHERE `UserAccount_ID` = '$useraccount_id'";


	$sqlresult = mysqli_query($conn, $sql);

	#FOR EMPTY VALUE
	if (mysqli_num_rows($sqlresult)==0){
		$first_name = "Set Full Name";
		$middle_name = "";
		$last_name = "";
		$bio = "Set Bio";
		$gender = "Set Gender";
		$birthday = "Set Birthday";
		$contact_number = "Set Contact Number";
		$email_address = "Set Email Address";
	}else{
		#FOR VALUE TO DISPLAY
		while($row = mysqli_fetch_assoc($sqlresult)){

		  $useraccount_id = $row['UserAccount_ID'];
		  
		  if((($row['First_Name']) && ($row['Middle_Name']) && ($row['Last_Name'])) == ""){
		 	$first_name = "Set Full Name";
		 	$middle_name = "";
		  	$last_name = "";
		  }else{
		  	$first_name = $row['First_Name'];
		  	$middle_name = $row['Middle_Name'];
		  	$last_name = $row['Last_Name'];
		  }

		  if($row['Bio'] == ""){
		  	$bio="Set Bio";
		  }else{
		  	 $bio = $row['Bio'];
		  }

		  if($row['Gender'] == ""){
		  	$gender="Set Gender";
		  }else{
		  	$gender = $row['Gender'];
		  }

		  if($row['Birthday'] == "0000-00-00"){
		  	$birthday="Set Birthday";
		  }else{
		  	$date = strtotime($row['Birthday']);
		  	$birthday = date('F j, Y', $date);
		  }

		  if($row['Contact_Number'] == ""){
		  	$contact_number="Set Contact Number";
		  }else{
		  	$contact_number = $row['Contact_Number'];
		  }

		  if($row['Email'] == ""){
		  	$email_address="Set Email Address";
		  }else{
		  	$email_address = $row['Email'];
		  }

		}
	}

	$sql ="SELECT * FROM `useraccount` WHERE `UserAccount_ID` = '$useraccount_id'";

	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){

		  $useraccount_id = $row['UserAccount_ID'];
		  $profile = $row['Profile'];
	}

	if (isset($_POST['save'])) {

		$username=$_SESSION['Username'];
		$oldprofile = $_POST['OldProfile'];

		$imageProfile=$_FILES['NewProfile']['name'];
		$imageProfile_tmp=$_FILES['NewProfile']['tmp_name'];
		$imageProfile_size=$_FILES['NewProfile']['size'];
		$imageProfile_error=$_FILES['NewProfile']['error'];

		if(empty($imageProfile)){
			$sqlupdate ="UPDATE `useraccount` SET `Profile`='$oldprofile' WHERE Username = '$username'";
			
				if($resultupdate = mysqli_query($conn, $sqlupdate)){
					header("Location: ../costumer/settings.php");
				}else{
					header("Location: ../costumer/settings.php");
				}
		}else{
			if ($imageProfile_error[0] < 0) {
				header("Location: ../costumer/myprofile.php?notification=Error");
			}else{
				if ($data_img_size[0] > 8000000) {
					header("Location: ../costumer/myprofile.php?notification=ErrorImageSize");
				}else{
					$imageProfile_ex = pathinfo($imageProfile, PATHINFO_EXTENSION);

					$imageProfile_ex_lc = strtolower($imageProfile_ex);

					$allowed_exs = array("jpg", "jpeg", "png");

					if (in_array($imageProfile_ex_lc,$allowed_exs)){

						$new_imageCover_name = uniqid("IMG-", true).'.'.$imageProfile_ex_lc;

						$upload_path = "../../style/assets/profiles/";

						move_uploaded_file($imageProfile_tmp, $upload_path.$new_imageCover_name);

						$sqlupdate ="UPDATE `useraccount` SET `Profile`='$new_imageCover_name' WHERE Username = '$username'";

						if($result = mysqli_query($conn, $sqlupdate)){

							#REMOVING EXISTING IMAGE
							$deletepath = "../../style/assets/profiles/$oldprofile";

							if(!unlink($deletepath)){
								header("Location: ../costumer/myprofile.php?notification=ErrorUpdateProfile");
							}else{
								header("Location: ../costumer/myprofile.php");
							}

						}else{
							header("Location: ../costumer/myprofile.php?notification=ErrorUpdateProfile");
						}
					}else{
						header("Location: ../costumer/myprofile.php?notification=ErrorFileType");
					}
				}
			}
		}
	}
}

?>