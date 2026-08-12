<?php
session_start();
include "../../server/connection/db_conn.php";

$sql = "SELECT * FROM `useraccountlevel`";

$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/admin/adduseraccount.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

  <!---NAVIGATION BAR START-->
  <?php include 'navigationbar.php'; ?>
  <!---NAVIGATION BAR END-->

  <!---MAIN CONTAINER START-->
  <div class="main-container">
  	<!---SUB MENU NAVIGATION BAR START-->
  	<div class="sub-header-menu">
  		<ul>
  		<li><a>Add User Account</a></li>
  		</ul>
  	</div>
  	<!---SUB MENU NAVIGATION BAR END-->
    <!---ADD USER ACCOUNT FORM START-->
  	<div class="card">
  		<form class="form" action="../../server/adduseraccount.php" method="post">
  			<h2>ADD USER ACCOUNT</h2>
       	<?php if (isset($_GET['error'])) { ?>
       	<p class="error"><?php echo $_GET['error']; ?></p>
       	<?php } ?>
       	<input type="text" name="username" required="" autocomplete="off" placeholder="Enter Username"><br>
       	<input type="password" name="password"  required="" autocomplete="off" placeholder="Enter Password"><br>
       	<select class="selectoption" required="required" name ="useraccountlevel">
  			<option>Select User Type</option>
  			<?php
          while ($row = mysqli_fetch_array($result)):;   
        ?>
  			<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
  			<?php 
          endwhile;
        ?>
  			</select>
        <!--SUBMIT AND CANCEL BUTTON START-->
  			<div class="btns">
       		<button id="btn_submit" type="submit" name="submit">Submit</button>
       		<button id="btn_cancel" type="submit" name="cancel">Cancel</button>
       	</div>
        <!--SUBMIT AND CANCEL BUTTON END-->
      </form>
  	</div>
    <!---ADD USER ACCOUNT FORM END-->
  </div>
  <!---MAIN CONTAINER START-->

  <?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');

  #Add User Account
    #Success
    if($notification=='UserAccountSubmitted'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "User Account Successfully Submitted.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "adduseraccount.php";
    });
      </script>';
    }
    elseif($notification=='UsernameExist'){
      echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      background: "#fff",
      icon: "warning",
      text: "Username Already Exist. Please try again.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "adduseraccount.php";
    });
      </script>';
    }
    elseif($notification=='SelectUserAccountLevel'){
      echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      background: "#fff",
      icon: "warning",
      text: "Please Select User Account Type.",
      showConfirmButton: false,
      timer: 1500
    }).then(function() {
      window.location = "adduseraccount.php";
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
<!---PHP SESSION END-->
</body>
</html>