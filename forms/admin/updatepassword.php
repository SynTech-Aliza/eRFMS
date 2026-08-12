<?php 
session_start();
include "../../server/updatepassword.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/admin/updatepassword.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

  <!---Navigation Bar Start-->
  <?php include 'navigationbar.php'; ?>
  <!---End Navigation Bar-->

  <!---Main container start-->
  	<div class="main-container">
  		<!---Sub Menu Navigation Start-->
  		<div class="sub-header-menu">
  			<ul>
  			<li><a>Update Password</a></li>
  			</ul>
  		</div>
  		<!---Sub Menu Navigation End-->
  		<div class="card">
  				<form method="post">
  		
  				<h2>UPDATE PASSWORD</h2>
  		
       			<?php if (isset($_GET['error'])) { ?>
       			<p class="error"><?php echo $_GET['error']; ?></p>
       			<?php } ?>
       			<input type="text" name="username" value="<?php echo $username ?>" readonly="yes" placeholder="Enter Username"><br>
       			<input type="text" name="newpassword" value="<?php echo $useraccount_ID ?>" readonly="yes"><br>

  				<div class="btns">
       			<button id="btn_submit" type="submit" name="submit">Submit</button>
       			<button id="btn_cancel"  type="cancel" name="cancel">Cancel</button>
       			</div>
      			</form>
  		</div>
  	</div>
  <?php
    $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Update Password
    #Success
    if($notification=='PasswordUpdated'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Password Successfully Updated.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "viewuseraccount.php";
    });
      </script>';
    }
    #Warning
    elseif($notification=='ErrorUpdating'){
      echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Updating.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "viewuseraccount.php";
    });
      </script>';
    }

  ?>
<?php 
}else{
  header("Location:../login.php");
  exit();
}
?>
</body>
</html>