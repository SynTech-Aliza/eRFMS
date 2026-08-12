<?php

#Total Products Label
#Total Sold Out
$sqlsoldout="SELECT COUNT(*) as soldout FROM products WHERE Stocks = 0";

$resultsoldout = mysqli_query($conn, $sqlsoldout);

while($row = mysqli_fetch_assoc($resultsoldout)){

  $soldout =$row['soldout'];
}
if($soldout==0){
	$soldoutresult = "";
}elseif($soldout>99){
	$soldoutresult = "99+";
}else{
	$soldoutresult = $soldout;
}

#Total Unlisted
$sqlunlisted="SELECT COUNT(*) as unlisted FROM `products` WHERE `DelistOrListed` = 'Delist'";

$resultunlisted = mysqli_query($conn, $sqlunlisted);

while($row = mysqli_fetch_assoc($resultunlisted)){

  $unlisted =$row['unlisted'];
}
if($unlisted==0){
	$unlistedresult = "";
}elseif($unlisted>99){
	$unlistedresult = "99+";
}else{
	$unlistedresult = $unlisted;
}


#Total Unpublish
$sqlunpublish="SELECT COUNT(*) as unpublish FROM `products` WHERE `DelistOrListed` = 'Listed' AND `UnpublishedOrPublished` ='Unpublished'";

$resultunpublish = mysqli_query($conn, $sqlunpublish);

while($row = mysqli_fetch_assoc($resultunpublish)){

  $unpublish =$row['unpublish'];
}
if($unpublish==0){
	$unpublishresult = "";
}elseif($unpublish>99){
	$unpublishresult = "99+";
}else{
	$unpublishresult = $unpublish;
}

#Chose Category#

$sqlchoosecategory = "SELECT * FROM `productcategories`";

$result = mysqli_query($conn, $sqlchoosecategory);

#Total Products Display#
$sqldisplaytotal="SELECT COUNT(Product_ID) as total FROM products ORDER BY Product_ID DESC";

$resultdisplaytotal = mysqli_query($conn, $sqldisplaytotal);

while($row = mysqli_fetch_assoc($resultdisplaytotal)){

  $total =$row['total'];
}

#Display Value Products#
#Search Engine Start
	if(isset($_POST['productname']) && isset($_POST['productcategory'])){
	$searchKeywordproductname = $_POST['productname'];
	$searchKeywordproductcategory = $_POST['productcategory'];


	if ((empty($searchKeywordproductname)) && (empty($searchKeywordproductcategory))){
		header("Location: ../../forms/clerk/myproducts_all_list.php");
	}elseif((empty($searchKeywordproductname))){
		header("Location: ../../forms/clerk/myproducts_all_list.php");
	}elseif((empty($searchKeywordproductcategory))){
		header("Location: ../../forms/clerk/myproducts_all_list.php");
	}else{
	$query=mysqli_query($conn,"SELECT COUNT(Product_ID) as total FROM products ORDER BY Product_ID DESC");
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
	
	$nquery=mysqli_query($conn,"SELECT * FROM products WHERE Product_Name LIKE '%$searchKeywordproductname%' AND ProductCategory_ID LIKE '%$searchKeywordproductcategory%'");

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
	$query=mysqli_query($conn,"SELECT COUNT(Product_ID) as total FROM products ORDER BY Product_ID DESC");
	$row = mysqli_fetch_row($query);
	$rows = $row[0];
	
	$page_rows = 12;

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
	
	$nquery=mysqli_query($conn,"SELECT * FROM products ORDER BY Product_ID DESC $limit");

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
}if (isset($_POST['reset'])) {
	header("Location: ../clerk/myproducts_all_grid.php");
}
?>