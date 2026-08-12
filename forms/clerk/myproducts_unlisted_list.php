<?php
session_start();
include "../../server/connection/db_conn.php";
include "../../server/myproducts_unlisted_list.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<link rel="stylesheet" type="text/css" href="../../style/css/clerk/myproducts_list.css">
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
		<!---SUB MENU NAVIGATION START-->
		<div class="sub-header-menu">
			<ul>
				<li><a>My Products</a></li>
				<li><a>Unlisted</a></li>
			</ul>
		</div>
		<!---SUB MENU NAVIGATION END-->
		<div class="card">
			<section class="table-menu">
				<div>
					<ul>
						<li><a href="myproducts_all_list.php">All</a></li>
						<li><span></span></li>
						<li><a href="myproducts_soldout_list.php">Sold out<div class="totalnotifysoldout">
						<?php if($soldoutresult == 0){
							echo "";
						}else{
							echo "<span class='label'>".$soldoutresult. "</span>";
						}?></div></a></li>
						<li><span></span></li>
						<li><a href="myproducts_unlisted_list.php" class="active">Unlisted</a></li>
						<li><span></span></li>
						<li><a href="myproducts_unpublished_list.php">Unpublished<div class="totalnotifyunpublish">
						<?php if($unpublishresult == 0){
							echo "";
						}else{
							echo "<span class='label'>".$unpublishresult. "</span>";
						}?></div></a></li>
					</ul>
				</div>
			</section>
			<!---VIEWING PAGE START-->
			<section class="viewing-page">
				<!---SEARCH FORM START-->
				<form method="post">
					<table class="search">
						<tr>
							<td class="label">Product Name:<input autocomplete="off" type="text" name="productname" required=""></td>
							<td class="label">Category: 
								<select name="productcategory" id="productcategory" class="selectoption" required>
			                  	<option value="">Choose Category</option>
			                  	<?php  while ($row = mysqli_fetch_array($result)):;   ?>
			                  	<option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
			                  	<?php endwhile;?>
               				 	</select> 
							</td>
						</tr>
					</table>
					<!---BUTTON SEARCH AND RESET START--->
					<button class="search-btn" name="search">Search</button>
					<button class="reset-btn" name="reset">Reset</a></button>
				</form>
				<!---SEARCH FORM END-->
				<!---BUTTON SEARCH AND RESET END-->
				<div class="display">
					<p><?php echo "Total Products: $total"; ?></p>
					<button class="btn-add"><a href="addnewproducts.php"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add New Products</a></button>
					<!---DOWNLOAD EXCEL STOCKS REPORT START--->
					<form method="post" action="../../server/stocksreport_clerk.php">
						<button class="btn-re" type="submit" name="export"><i class="fa fa-download" aria-hidden="true"></i> Stocks Report</button>
					</form>
					<!---DOWNLOAD EXCEL STOCKS REPORT END--->
					<!---BUTTON LIST AND GRID START--->
						<button class="list active"><a href="myproducts_unlisted_list.php"><i class="fa fa-list" aria-hidden="true"></i></a></button>
						<button class="grid"><a href="myproducts_unlisted_grid.php"><i class="fa fa-th" aria-hidden="true"></i></a></button>
					<!---BUTTON LIST AND GRID END--->
				</div>
				<!--VIEWING LIST START-->
				<div class="wrapper">
					<div class="view_main">
						<div class="view_wrap list-view" style="display: block;">
							<?php if(mysqli_num_rows($nquery) == 0){?>
								<div class="vi_left">
									<h2 class="empty">List is empty</h2>
								</div>
							<?php
							}else{
								while($row = mysqli_fetch_array($nquery)){
							?>
						<div class="view_item">
						<div class="vi_left">
							<!----UPDATE PRODUCT START-->
							<a href="updateproduct_unlisted_list.php?product=<?php echo $row['Product_ID']; ?>"><img src="../../style/assets/products/<?php echo $row['Cover_Photo']; ?>"></a>
							<!----UPDATE PRODUCT END-->
						</div>
						<div class="vi_right">
							<p class="content"><b><?php echo $row['Product_Name']; ?></b></p>

							<nav class="more-options">
								<ul>
									<li class="dropdown"><a href="#"><i class="fa fa-circle dot" aria-hidden="true"></i><i class="fa fa-circle dot" aria-hidden="true"></i><i class="fa fa-circle dot" aria-hidden="true"></i></a>
										<ul class="sub_menu">
								        	<li>
												<a href="updateproduct_unlisted_list.php?product=<?php echo $row['Product_ID']; ?>">Edit</a>
											</li>
											<li>
								        	<?php 
								        	if($row['DelistOrListed'] ==  "Delist"){
												echo "<a href='../../server/myproducts_unlisted_delistlisted_list.php?productlisted=".$row['Product_ID']."'>Listed</a>";
											}else{
												echo "<a href='../../server/myproducts_unlisted_delistlisted_list.php?productdelist=".$row['Product_ID']."'>Delist</a>";
											}
											?>
											</li>
							      </ul>
							    </li>
							  </ul>
							</nav>

							<p class="content">Price: <b class="price">₱<?php echo $row['Price']; ?></b></p>
							<p class="content">Stocks: 
							<?php if($row['Stocks'] == 0){
								echo "<b class='soldout'>Sold Out</b>";
							}else{
								echo "<b class='stocks'>".$row['Stocks']."</b>";
							} ?></p>
							<p class="content">Unlisted/Listed: <b><?php echo $row['DelistOrListed']; ?></b></p>
							<p class="content">Status: <b><?php echo $row['UnpublishedOrPublished']; ?></b></p>
							<!--VIEW MORE BUTTON START-->
							<div class="btn"><a href="myproducts_unlisted_viewmore_list.php?product=<?php echo $row['Product_ID']; ?>">View More</a></div>
							<!--VIEW MORE BUTTON END-->
						</div>
						</div>
							<?php
								}
							}
							?>
						<div class="controls" id="pagination_controls"><?php echo $paginationCtrls; ?></div>	
						</div>
					</div>
				</div>
				<!--VIEWING LIST END-->
			</section>
			<!---VIEWING PAGE END-->
		</div>
	</div>
	<!---MAIN CONTAINER END-->
	<!---NOTIFICATION START-->
	<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #SUCCESS
  if($notification=='Publish'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Publish Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='Unpublish'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Unpublish Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='Listed'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Listed Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='Delist'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Delist Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }
	
	#ERROR
	elseif($notification=='ErrorPublish'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Publish Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorUnpublish'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Unpublish Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorListed'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Listed Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorDelist'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Delist Product",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }
	?>
	?>
	<!---NOTIFICATION END-->

<?php	
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>