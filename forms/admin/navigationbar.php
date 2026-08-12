
<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="../../style/css/admin/navigationbar.css">
</head>
<body>

	<!---WRAPPER START-->
	<div class="wrapper">
		<!--HEADER MENU START-->
		<div class="header">
			<div class="header-menu">
				<div class="title">Rose <span>Furniture</span></div>
				<div class="image_icon">
					<img src="../../style/assets/img/chair.png">
				</div>
				<ul>
					<li><a href="#">	
					<div class='icon_nav settings'>
						<span><i class='fa fa-gear' aria-hidden='true'></i></span>
						<div class='tooltip'>Settings</div>
					</div>
					</a></li>

					<li><a href="#">
					<div class='icon_nav notification'>
						<span><i class='fa fa-bell' aria-hidden='true'></i></span>
						<div class='tooltip'>Notifications</div>
					</div>
					</a></li>

					<li><a href="../../server/logout.php">
						<div class='icon_nav logout'>
							<span><i class='fa fa-power-off' aria-hidden='true'></i></span>
							<div class='tooltip'>Log Out</div>
						</div>
					</a></li>
				</ul>
			</div>
		</div>
		<!--HEADER MENU END-->
		<!--SIDE BAR START-->
		<div class="sidebar">
			<div class="sidebar-menu">
				<center class="profile">
				<img src="../../style/assets/profiles/<?php echo $_SESSION['Profile'];  ?>" alt=""> 
				<p><?php echo $_SESSION['Username'];  ?></p>
				</center>
				<!--DASHBOARD START-->
				<li class="item">
					<a href="dashboard.php" class="menu-btn">
						<i class="fa fa-bar-chart-o" aria-hidden="true"></i><span>Dashboard</span>
					</a>
				</li>
				<!--DASHBOARD END-->
				<!--ACCOUNTS START-->
				<li class="item" id="accounts">
					<a href="#accounts" class="menu-btn">
						<i class="fa fa-user-circle" aria-hidden="true"></i><span>Accounts<i class="fa fa-caret-down drop-down" aria-hidden="true"></i></span>
					</a>
					<div class="sub-menu">
						<a href="adduseraccount.php"><span>Add New User</span></a>
						<a href="viewuseraccount.php"><span>View User Accounts</span></a>
					</div>
				</li>
				<!--ACCOUNTS END-->
				<!--REPORTS START-->
				<li class="item" id="reports">
					<a href="#reports" class="menu-btn">
						<i class="fa fa-folder" aria-hidden="true"></i><span>Reports<i class="fa fa-caret-down drop-down" aria-hidden="true"></i></span>
					</a>
					<div class="sub-menu">
						<a href="#.php"><span>User Reports</span></a>
						<a href="#.php"><span>Stocks Report</span></a>
						<a href="#.php"><span>Inventory Report</span></a>
					</div>
				</li>
				<!--REPORTS END-->
			</div>
		</div>
		<!--SIDE BAR END-->
		
	</div>
	<!---WRAPPER END-->
	<script type="text/javascript">
		$(document).ready(function(){
			$(".sidebar-btn").click(function(){
				$(".wrapper").toggleClass("collapse");
			});
		});
	</script>
</body>
</html>