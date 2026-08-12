<?php

include "../../server/orderdetails_todeliver_addressselection.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/costumer/orderdetails_topay_addressselection.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST">
					<!--EDIT MY ADDRESS SECTION START-->
					<section class="add_address">
						<!--BACK SECTION START-->
						<p><a href="orderdetails_todeliver.php?costumerproductorder=<?php echo $costumerproductorder; ?>"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Address Selection</p>
						<!--BACK SECTION END-->
						<!--ADD NEW ADDRESS SECTION START-->
						
						<!--ADD NEW ADDRESS SECTION END-->
					</section>
          <section class="view_address">
            <!--DISPLAY DATA START-->
            <div class="view-section">
              <div class="wrapper">
                <div class="view_main">
                  <div class="view_wrap grid-view" style="display: block;">
                    <?php 
										if (mysqli_num_rows($resultcostumeraddress)==0){
											echo '<h2 style="color:#f4623a; text-align:center"></h2>';
										}else{
											while($row = mysqli_fetch_array($resultcostumeraddress)){
										?>
                   	<div class="view_list"><a href="orderdetails_todeliver_updateaddress.php?costumerproductorder=<?php echo $costumerproductorder ?>&costumeraddress=<?php echo $row['CostumerAddress_ID']; ?>">	
                    		<p class="content name"><?php echo $first_name." ".$middle_name." ".$last_name ?></p>
                    		<p class="content status"><?php if($row['Status'] == "Default"){
                    			echo "[Default Address]";
                    		}else{
                    			echo "";
                    		}?></p>
                    		<p class="content address"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo "(+63)".$row['Contact_Number']; ?></p>
                    		<p class="content address"><i class="fa fa-envelope" aria-hidden="true"></i> <?php echo $row['Email_Address']; ?></p>
                        <p class="content address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo $row['Region'].", ".$row['Province'].", ".$row['City'].", ".$row['Barangay'] ?></p>
                        <p class="content address"><i class="fa fa-home" aria-hidden="true"></i> <?php echo $row['Postal_Code']; ?></p>
                        <p class="content address"><i class="fa fa-info" aria-hidden="true"></i> <?php echo $row['Detailed_Address']; ?></p>
                   	</a></div>
                    <?php
											}
										}		
										?>
										<p class="addnewaddress"><a href="orderdetails_todeliver_addnewaddress.php?costumerproductorder=<?php echo $costumerproductorder?>"><i class="fa fa-plus" aria-hidden="true"></i> Add New Address</a></p>
                  </div>
                </div>
              </div>
            </div>
            <!--DISPLAY DATA END-->
          </section>
					<!--EDIT MY ADDRESS SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END--> 

<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Add User Account
    #Success
    if($notification=='Delete'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Address Succesfully Deleted.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='ErrorDelete'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Address Deleted.",
      showConfirmButton: false,
      timer: 1500
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
