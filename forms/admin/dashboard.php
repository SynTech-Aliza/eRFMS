<?php
session_start();
include ('../../server/dashboard_graphs.php');
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" type="text/css" href="../../style/css/admin/dashboard.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!--NAVIGATION BAR START-->
	<?php include 'navigationbar.php'; ?>
	<!---NAVIGATION BAR END-->
	<!--MAIN CONTAINER START-->
	<div class="main-container">
		<!---SUB MENU NAVIGATION START-->
		<div class="sub-header-menu">
			<ul>
				<li><a>Dashboard</a></li>
			</ul>
		</div>
		<!---SUB MENU NAVIGATION START-->
		<div class="card">
			<!--DISPLAY GRAPH AND CHART START-->
			<div class="chart1">
            	<div class="chart_1">
            		<!--GRAPH 1 START-->
					<canvas id="chart1" width="540" height="300"></canvas>
					<!--GRAPH 1 START-->
				</div>
			</div>
			<div class="chart2">
            	<div class="chart_2">
            		<!--GRAPH 2 START-->
					<canvas id="chart2" width="560" height="300"></canvas>
					<!--GRAPH 2 END-->
				</div>	
			</div>

			<div class="chart3">
				<div class="chart_3">
					<!--GRAPH 3 START-->
					<canvas id="chart3" width="1133" height="500"></canvas>
					<!--GRAPH 3 END-->
				</div>
			</div>
			<div class="chart4">
				<div class="chart_4">
					<!--GRAPH 4 START-->
					<canvas id="chart4" width="1133" height="500"></canvas>
					<!--GRAPH 4 END-->
				</div>
			</div>
			<!--DISPLAY GRAPH AND CHART END-->
		</div>
	</div>
	<!--MAIN CONTAINER END-->
	<script>
		/*GRAPH FOR COSTUMER AND USERS START */
		var ctx = document.getElementById("chart1").getContext('2d');
	    var myChart = new Chart(ctx, {
	    type: 'doughnut',
		data: {
			labels: ['Costumers', 'Users'],
			datasets: [{
			    data: [<?php echo $numberofcostumers;?>,<?php echo $numberofusers;?>],
				backgroundColor: [
	            'rgba(27, 79, 114)',
	            'rgba(235, 152, 78)',
	            ],
	            borderColor: [
	            'rgba(27, 79, 114)',
	            'rgba(235, 152, 78)',
	            ],
			}],
		},
		options: {
			scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
			tooltips:{mode: 'index'},
			legend:{display: true, position: 'chartArea', labels: {fontColor: 'rgb(0,0,0)', fontSize: 15}}
		}
		});
	    /*GRAPH FOR COSTUMER AND USERS END */
	    /*GRAPH FOR ADMIN, CASHIER, COSTUMER, SUPPLIER AND INVENTORY CLERK START */
	    var ctx = document.getElementById("chart2").getContext('2d');
	    var myChart = new Chart(ctx, {
	    type: 'bar',
		data: {
			labels: ['Admin', 'Inventory Clerk', 'Costumer'],
			datasets:[{
			    label: 'Users',
			    data: [<?php echo $admin;?>,<?php echo $inventory_clerk;?>,<?php echo $costumer;?>],
	    		backgroundColor: [
	            'rgba(27, 79, 114)',
	            'rgba(235, 152, 78)',
	            'rgba(246, 221, 204)',,
	            ],
			}],
		},
		options: {
			scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
			tooltips:{mode: 'index'},
			legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 15}}
		}
		});
		/*GRAPH FOR ADMIN, CASHIER, COSTUMER, SUPPLIER AND INVENTORY CLERK END */
		/*GRAPH FOR MONTHLY START */
		var ctx = document.getElementById("chart3").getContext('2d');
	    var myChart = new Chart(ctx, {
	    type: 'line',
		data: {
			labels: ['2021','2222', '2222','2222','21312'],
			datasets:[{
			    label: 'Product Sales Monthly',
			    data:[ <?php echo $admin;?>,<?php echo $inventory_clerk;?>, <?php echo $costumer;?>],
			        fill: false,
	    			backgroundColor: 'rgba(27, 79, 114)',
	    			borderColor:'rgba(27, 79, 114)',
	    			tension: 0.4
			    }],
			},
			     
		options: {
			scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
			tooltips:{mode: 'index'},
			legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 15}}
		}
		});
		/*GRAPH FOR MONTHLY END */
	    /*GRAPH FOR YEARLY START */
		var ctx = document.getElementById("chart4").getContext('2d');
	    var myChart = new Chart(ctx, {
	    type: 'line',
		data: {
		labels: ['2021','2222', '2222','2222','21312'],
		datasets:[{
			label: 'Product Sales Yearly',
			data: [ <?php echo $admin;?>,<?php echo $inventory_clerk;?>, <?php echo $costumer;?>],
			fill: false,
	    	backgroundColor: 'rgba(27, 79, 114)',
	    	borderColor:'rgba(27, 79, 114)',
	    	tension: 0.4
		}],
		},
			     
		options: {
			scales: {scales:{yAxes: [{beginAtZero: false}], xAxes: [{autoskip: true, maxTicketsLimit: 20}]}},
			tooltips:{mode: 'index'},
			legend:{display: true, position: 'top', labels: {fontColor: 'rgb(0,0,0)', fontSize: 15}}
		}
		});     		
	</script>
<?php	
}else{
	header("Location:../login.php");
	exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>