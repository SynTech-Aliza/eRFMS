<?php
session_start();
include "../../server/viewuseraccount.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<!-- Include the Borderless theme -->
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/admin/viewuseraccount.css">
</head>
<body>

<!--PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!--NAVIGATION BAR START-->
	<?php include 'navigationbar.php'; ?>
	<!--NAVIGATION BAR END-->

	<!--MAIN CONTAINER START-->
	<div class="main-container">
		<!--SUB MENU NAVIGATION START-->
		<div class="sub-header-menu">
			<ul>
				<li><a>View User Accounts</a></li>
			</ul>
		</div>
			<!--SUB MENU NAVIGATION END-->
		<div class="card">
			<!--FORM SEARCH START-->
			<form action="" method="post">
				<h2>VIEW USER ACCOUNTS</h2>
					<input class="search" type="text" name="search" placeholder="Search Username" autocomplete="off">
					<button class="buttons"><i id="navbtn" class="fa fa-search" aria-hidden="true"></i></button>
			</form>
			<!--FORM SEARCH END-->

			<!--VIEW USER ACCOUNT START-->
			<div class="table">
				<table class="table_view">
					<thead>
						<th>Username</th>
						<th>Password</th>
						<th>Status</th>
						<th colspan="3">Options</th>
					</thead>
					<?php
					if(mysqli_num_rows($nquery) == 0){

					    echo '<tbody>
											<tr>
					    				<td colspan="4" class="error">Empty</td>
					    			</tr>
					    			</tbody>';
					}else{
						while($row = mysqli_fetch_array($nquery)){
					?>
					<tbody>
						<tr>
							<td><?php echo $row['Username']; ?></td>
							<td><?php echo $row['Password']; ?></td>
							<td id="status">
								<?php
								if($row['Status'] == "Activate"){

									echo '<span style="color:green">Activate</span>'; 
								}else{
									echo '<span style="color:red">Deactivate</span>'; 
								}
								?>
								
							</td>
							<td><?php echo "<a href='updatepassword.php?update=".$row["UserAccount_ID"]."'><div class='icon account'>
								<div class='tooltip'>Update Password</div>
								<span><i class='fa fa-lock' aria-hidden='true'></i></span>
								</div></a> "?></td>
							<td><?php echo "<a href='../../server/useraccountactivate.php?activate=".$row["UserAccount_ID"]."'><div  class='icon activate'>
								<div class='tooltip'>Activate</div>
								<span><i class='fa fa-toggle-on' aria-hidden='true'></i></span>
								</div></a> "?></td>
							<td><?php echo "<a href='../../server/useraccountdeactivate.php?deactivate=".$row["UserAccount_ID"]."'><div class='icon deactivate'>
								<div class='tooltip'>Deactivate</div>
								<span><i class='fa fa-toggle-off' aria-hidden='true'></i></span>
								</div></a> "?></td>
						</tr>
					</tbody>
					<?php
							}
						}
					?>
				</table>
				<!--PAGE NUMBER START-->
				<div class="controls" id="pagination_controls"><?php echo $paginationCtrls; ?></div>
				<!--PAGE NUMBER END-->
			</div>
			<!--VIEW USER ACCOUNT END-->
		</div>
	</div>



<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
#Activated and Deactivated Account
  #Success
  if($notification=='Activate'){
  echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "User Account Activate",
    showConfirmButton: false,
    timer: 1500
  }).then(function() {
    window.location = "viewuseraccount.php";
  });
    </script>';
  }elseif($notification=='Deactivate'){
  echo '<script type="text/javascript">
    swal.fire({
    position: "top-end",
    icon: "warning",
    text: "User Account Deactivate",
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
<!---PHP SESSION END-->
</body>
</html>