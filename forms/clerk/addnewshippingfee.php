<?php
session_start();
include "../../server/connection/db_conn.php";

$sqllocation = "SELECT province.Province, city.City FROM `city` INNER JOIN province ON province.Province_ID = city.Province_ID";

$resultlocation = mysqli_query($conn, $sqllocation);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/clerk/addnewshippingfee.css">
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
  		<li><a>Add New Shipping Fee</a></li>
  		</ul>
  	</div>
  	<!---SUB MENU NAVIGATION BAR END-->
    <!---ADD USER ACCOUNT FORM START-->
  	<div class="card">
  		<form class="form" action="../../server/addnewshippingfee.php" method="post">
  			<h2>ADD NEW SHIPPING FEE</h2>
        <input list="location" name="location" placeholder="Location">

        <datalist id="location" class="selectoption">
        <?php
          while ($row = mysqli_fetch_array($resultlocation)):;   
        ?>
          <option><?php echo $row['Province']." (".$row['City'].")";?></option>
        <?php 
          endwhile;
        ?>
        </datalist>
       	<input type="number" name="fee" required="" autocomplete="off" placeholder="Fee">
        <input type="number" name="deliverydays" required="" autocomplete="off" placeholder="No of Delivery Days"><br>
       	
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

    if($notification=='ExistLocation'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Data Already Exist.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='Success'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Data Successfully Submitted.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='Error'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Data Unsuccessfully Submitted.",
      showConfirmButton: false,
      timer: 1500
    })
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