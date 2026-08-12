<?php
session_start(); 
include "../../server/change_password_costumer.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/change_password.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST" name="form" onsubmit="return validationForm()">
					<!--EDIT NAME SECTION START-->
					<section class="change_password">
						<!--BACK SECTION START-->
						<p><a href="myprofile.php"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Change Password</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_change_password">
							<input type="password" name="current_password" placeholder="Current Password" id="current_password" autocomplete="off" required=""><i class="fa fa-eye eyebutton" aria-hidden="true" id="toggleCurrent_password"></i><br/>
							<input type="password" name="new_password" placeholder="New Password" id="new_password" autocomplete="off" required=""><i class="fa fa-eye eyebutton" aria-hidden="true" id="toggleNew_password"></i><br/>
							<input type="password" name="confirm_password" placeholder="Confirm Password" id="retype_password" autocomplete="off" required=""><i class="fa fa-eye eyebutton" aria-hidden="true" id="toggleRetype_password"></i><br/>
						</div>
					</section>
					<!--EDIT NAME SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->
  <script>

  const toggleCurrent_password = document.querySelector('#toggleCurrent_password');
  const current_password = document.querySelector('#current_password');
 
  toggleCurrent_password.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = current_password.getAttribute('type') === 'password' ? 'text' : 'password';
    current_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });

  const toggleNew_password = document.querySelector('#toggleNew_password');
  const new_password = document.querySelector('#new_password');
 
  toggleNew_password.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = new_password.getAttribute('type') === 'password' ? 'text' : 'password';
    new_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });

  const toggleRetype_password = document.querySelector('#toggleRetype_password');
  const retype_password = document.querySelector('#retype_password');
 
  toggleRetype_password.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = retype_password.getAttribute('type') === 'password' ? 'text' : 'password';
    retype_password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });

  </script>
<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Add User Account
    #Success
    if($notification=='ErrorPassword'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Password. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "change_password.php";
    });
      </script>';
    }elseif($notification=='NotMatch'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Passwords do not match. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "change_password.php";
    });
      </script>';
    }elseif($notification=='ErrorPasswordUpdated'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Password Updating. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "change_password.php";
    });
      </script>';
    }elseif($notification=='ErrorPassword'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Password. Please try it again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "change_password.php";
    });
      </script>';
    }elseif($notification=='Updated'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      text: "Password Updated. Do you want to log out?",
      showDenyButton: true,
      confirmButtonText: "Yes",
      confirmButtonColor: "#f4623a",
      denyButtonText: "No",
      denyButtonColor: "#4e4239",

    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        window.location = "../../server/logout.php";
      } else if (result.isDenied) {
        window.location = "myprofile.php";
      }
    })
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
