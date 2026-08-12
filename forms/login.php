<?php
#include "../server/autodeleteuseraccount.php";
?>

<!DOCTYPE html>
<html>
<head>
  <title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../style/css/login.css">
</head>
<body>
<div class="log">
     <form action="../server/login.php" class="log_form" id="loginForm" method="post">
		<img src ="../style/assets/img/logo.png" class ="image">
		<?php if (isset($_GET['error'])) { ?>
     		<p class="error" style="margin-left: 30px"><?php echo $_GET['error']; ?></p>
     	<?php } ?>
		<div class="input">
     	<input type="text" id="username" name="username" autocomplete="off" placeholder="Username"><br>
     	<input type="password" id="password" name="password" autocomplete="off" placeholder="Password"><br>
		</div>
		
		<button class ="btn-log" type="submit"  disabled="disabled" id="loginButton" >Login</button>

		<div class="forgot_password">
		<a href="../forms/forgot_password.php">Forgot password?</a>
		</div>

		<div class="signup_link">
		Not a member?
		<a href="../forms/signup.php">Signup here</a>
		</div>
     </form>
	<script type="text/javascript">
		loginForm.addEventListener('input', () =>{
			if (username.value.length > 0 && password.value.length > 0){
				loginButton.removeAttribute('disabled');
			}else{
				loginButton.setAttribute('disabled', 'disabled');
			}
		});
	</script>
</div>
<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
    #Success
    if($notification=='AccountDeactivate'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      text: "Sorry, your account has been deactivate. Please contact the costumer service.",
      showConfirmButton: false,
      timer: 2500
    })
      </script>';
    }elseif($notification=='AccountNotExist'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "center",
      icon: "warning",
      text: "Username and Password is Incorrect. Please sign up or try it again.",
      showConfirmButton: false,
      timer: 2500
    })
      </script>';
    }
   ?>
</body>
</html>