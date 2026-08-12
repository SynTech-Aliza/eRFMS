<?php
session_start(); 
include "../../server/myprofile_costumer.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="../../style/javascript/DisplayProfileImage.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/myprofile.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST" enctype="multipart/form-data">
					<!--EDIT PROFILE SECTION START-->
					<section class="edit_profile">
						<!--BACK SECTION START-->
						<p><a href="settings.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Edit Profile</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<!--PROFILE IMAGE START-->
						<div class="profile_image">
							<div class="image" style="position: relative;" >
	              				<span class="img-div">
	              					<div class="img-placeholder"  onClick="triggerClickProfileImage()"></div>
	              					<img src="../../style/assets/profiles/<?php echo $profile ?>" onClick="triggerClickProfileImage()" id="ProfileImageDisplay">
	              				</span>
	              				<div class="form-control">
	              					<input type="text" name="OldProfile" value="<?php echo $profile ?>" style="display: none;"> 
	              					<input type="file" name="NewProfile" onChange="displayProfileImage(this)" id="ProfileImage" class="form-control" style="display: none;">
	             					<small class="error"></small> 
	              				</div>
	             			</div>
	             			<p>Click to change profile</p>	
						</div>
						<!--PROFILE IMAGE END-->
					</section>
					<!--EDIT PROFILE SECTION END-->
					<!--USER DETAILS SECTION START-->
					<section class="user_details">
						<table class="form1">
							<tr>
								<td class="left">Fullname</td>
								<td class="right"><?php echo $first_name ." ". $middle_name ." ". $last_name  ?><a href="update_name.php"><i class="arrow"></i></a></td>
							</tr>
							<tr>
								<td class="left">Username</td>
								<td class="right"><?php echo $_SESSION['Username'] ?></td>
							</tr>
							<tr>
								<td class="left">Bio</td>
								<td class="right"><div style="width: 730px; word-wrap: break-word; text-align: right;"><?php echo $bio ?><a href="update_bio.php"><i class="arrow"></i></a></div></td>
							</tr>
						</table>

						<table class="form2">
							<tr>
								<td class="left">Gender</td>
								<td class="right"><?php echo $gender ?><a href="update_gender.php"><i class="arrow"></i></a></td>
							</tr>
							<tr>
								<td class="left">Birthday</td>
								<td class="right"><?php echo $birthday ?><a href="update_birthday.php"><i class="arrow"></i></a></td>
							</tr>
							<tr>
								<td class="left">Contact Number</td>
								<td class="right"><?php echo $contact_number ?><a href="update_contact_number.php"><i class="arrow"></i></a></td>
							</tr>
							<tr>
								<td class="left">Email Address</td>
								<td class="right"><?php echo $email_address ?><a href="update_email_address.php"><i class="arrow"></i></a></td>
							</tr>
						</table>

						<table class="form3">
							<tr>
								<td class="left">Change Password</td>
								<td class="right"><a href="change_password.php"><i class="arrow"></i></a></td>
							</tr>
						</table>
					</section>
					<!--USER DETAILS SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->


	<script type="text/javascript">
		
	</script>

<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');

  #Add User Account
    #Success
    if($notification=='ErrorUserProfile'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error User Profile. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "myprofile.php";
    });
      </script>';
    }elseif($notification=='Error'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Unknow Error.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "myprofile.php";
    });
      </script>';
    }elseif($notification=='ErrorImageSize'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error image size.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "myprofile.php";
    });
      </script>';
    }elseif($notification=='ErrorFileType'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error file type.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "myprofile.php";
    });
      </script>';
    }elseif($notification=='ErrorUpdateProfile'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error update profile. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "myprofile.php";
    });
      </script>';
    }

}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>
