<?php

#Search Engine Start
	if(isset($_POST['search'])){
	$searchProductOrderID = $_POST['search'];
	if(empty($searchProductOrderID)){
		header("Location: ../../forms/clerk/shop_orders_preparepackage.php");
	}else{
	$query=mysqli_query($conn,"SELECT COUNT(CostumerProductOrder_ID) as total FROM costumerproductorders ORDER BY CostumerProductOrder_ID DESC");
	$row = mysqli_fetch_row($query);
	$rows = $row[0];
	
	$page_rows = 10;

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	$nquery=mysqli_query($conn,"SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, costumerspurchase.Payment_Method, costumerspurchase.DateOfPurchase,products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity 
	FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.Order_Status ='Request for Cancelling Order' AND costumerproductorders.PlatformProductOrder_ID LIKE '%$searchProductOrderID%' GROUP BY costumerproductorders.CostumerProductOrder_ID ASC");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a> ';
    }
	}
	}
}
#Search Engine End

#Pagination Start
	else{
	$query=mysqli_query($conn,"SELECT COUNT(CostumerProductOrder_ID) as total FROM costumerproductorders WHERE Order_Status ='Request for Cancelling Order' ORDER BY CostumerProductOrder_ID DESC");
	$row = mysqli_fetch_row($query);
	$rows = $row[0];
	
	$page_rows = 5;

	$last = ceil($rows/$page_rows);

	if($last < 1){
		$last = 1;
	}

	$pagenum = 1;
	if(isset($_GET['pn'])){
		$pagenum = preg_replace('#[^0-9]#', '', $_GET['pn']);
	}

	if ($pagenum < 1) { 
		$pagenum = 1; 
	} 
	else if ($pagenum > $last) { 
		$pagenum = $last; 
	}

	$limit = 'LIMIT ' .($pagenum - 1) * $page_rows .',' .$page_rows;
	
	$nquery=mysqli_query($conn,"SELECT costumerproductorders.CostumerProductOrder_ID, costumerproductorders.PlatformProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, costumerspurchase.Payment_Method, costumerspurchase.DateOfPurchase,products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Cover_Photo, costumerspurchase.Total_Quantity, costumerspurchaseproduct.Quantity 
	FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.Order_Status ='Request for Cancelling Order' GROUP BY costumerproductorders.CostumerProductOrder_ID ASC $limit");

	$paginationCtrls = '';

	if($last != 1){
		
	if ($pagenum > 1) {
        $previous = $pagenum - 1;
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'" class="btn btn-default">Previous</a> &nbsp; &nbsp; ';
		
		for($i = $pagenum-4; $i < $pagenum; $i++){
			if($i > 0){
		        $paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
			}
	    }
    }
	
	$paginationCtrls .= ''.$pagenum.' &nbsp; ';
	
	for($i = $pagenum+1; $i <= $last; $i++){
		$paginationCtrls .= '<a href="'.$_SERVER['PHP_SELF'].'?pn='.$i.'" class="btn btn-default">'.$i.'</a> &nbsp; ';
		if($i >= $pagenum+4){
			break;
		}
	}

    if ($pagenum != $last) {
        $next = $pagenum + 1;
        $paginationCtrls .= ' &nbsp; &nbsp; <a href="'.$_SERVER['PHP_SELF'].'?pn='.$next.'" class="btn btn-default">Next</a> ';
    }
	}
#Pagination End
}
?>