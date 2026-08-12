<?php
include "../server/update_forgot_password.php";

?>

<!DOCTYPE html>
<html>
<head>
  <title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="../style/css/update_forgot_password.css">
</head>
<body>
<div class="log">
    <form class="update_form" id="update_form" method="post">
		<img src ="../style/assets/img/logo.png" class ="image">
		<?php if (isset($_GET['error'])) { ?>
     		<p class="error"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		<div class="input">
     	<input type="password" name="newpassword" autocomplete="off" id="newpassword" placeholder="Enter New Password" required=""><i class="fa fa-eye eyebutton" aria-hidden="true" id="toggleNew_password"></i><br>
      <input type="password" name="retypenewpassword" autocomplete="off" id="retypenewpassword" placeholder="Retype New Password" required=""><i class="fa fa-eye eyebutton" aria-hidden="true" id="toggleRetype_password"></i><br>
		</div>
		
		<button class ="btn-submit" type="submit" name="submit">Submit</button>

     </form>
</div>
<script type="text/javascript">
  const toggleNew_password = document.querySelector('#toggleNew_password');
  const newpassword = document.querySelector('#newpassword');
 
  toggleNew_password.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = newpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    newpassword.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });

  const toggleRetype_password = document.querySelector('#toggleRetype_password');
  const retypenewpassword = document.querySelector('#retypenewpassword');
 
  toggleRetype_password.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = retypenewpassword.getAttribute('type') === 'password' ? 'text' : 'password';
    retypenewpassword.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
  });
</script>
<?php
    $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Update Password
    #Success
    if($notification=='Updated'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "success",
      title: "Successfully Updated.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "login.php";
    });
      </script>';
    }elseif($notification=='Error'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "update_recover_password.php";
    });
      </script>';
    }elseif($notification=='PasswordNotMatch'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error",
      text: "Two Passwords did not match. Please try it again.",
      showConfirmButton: false,
      timer: 5000
    }).then(function() {
      window.location = "login.php";
    });
      </script>';
    }elseif($notification=='RequestError'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      title: "Error",
      text: "Your request has been expired. Please request another link to the system and check your email again for the link to update your new password.",
      showConfirmButton: false,
      timer: 5000
    }).then(function() {
      window.location = "login.php";
    });
      </script>';
    }
 ?>
</body>
</html>