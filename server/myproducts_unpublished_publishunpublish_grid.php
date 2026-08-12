<?php
include "connection/db_conn.php";

if (isset($_GET['productpublish'])){
	$productpublish = $_GET['productpublish'];

	$sql ="SELECT products.`Product_ID`, products.`Product_Name`, products.`Price`, products.`Stocks`, products.`Brand`, products.`Materials`, products.`Furniture_Type`, products.`Style`, products.`Color`, products.`Height`, products.`Width`, products.`Weight`, products.`Model`, products.`Pattern`, products.`Description`, products.`Cover_Photo`, products.`Image1`, products.`Image2`, products.`Image3`, products.`Image4`, products.`Image5`, products.`DelistOrListed`, products.`UnpublishedOrPublished`, productcategories.`Product_Category`, productcategories.`ProductCategory_ID` FROM products INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE `Product_ID` = '$productpublish'";
	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){

	$productid =$row['Product_ID'];
	$productname = $row['Product_Name'];
	$price = $row['Price'];
	$stocks = $row['Stocks'];
	$brand = $row['Brand'];
	$materials = $row['Materials'];
	$furnituretype = $row['Furniture_Type'];
	$style = $row['Style'];
	$color = $row['Color'];
	$height = $row['Height'];
	$width = $row['Width'];
	$weight = $row['Weight'];
	$model = $row['Model'];
	$pattern = $row['Pattern'];
	$description = $row['Description'];
	$coverphoto = $row['Cover_Photo'];
	$image1 = $row['Image1'];
	$image2 = $row['Image2'];
	$image3 = $row['Image3'];
	$image4 = $row['Image4'];
	$image5 = $row['Image5'];
	$productcategory_id = $row['ProductCategory_ID'];
	$productcategory = $row['Product_Category'];
	}

	$updateproductpublish = "UPDATE `products` SET `UnpublishedOrPublished`='Published' WHERE Product_ID ='$productpublish'";
	if($resultproductpublish = mysqli_query($conn, $updateproductpublish)){
		header("Location: ../forms/clerk/myproducts_unpublished_grid.php?notification=Publish");
	}else{
		header("Location: ../forms/clerk/myproducts_unpublished_grid.php?notification=ErrorPublish");
	}
}


if (isset($_GET['productunpublish'])){
	$productunpublish = $_GET['productunpublish'];

	$sql ="SELECT products.`Product_ID`, products.`Product_Name`, products.`Price`, products.`Stocks`, products.`Brand`, products.`Materials`, products.`Furniture_Type`, products.`Style`, products.`Color`, products.`Height`, products.`Width`, products.`Weight`, products.`Model`, products.`Pattern`, products.`Description`, products.`Cover_Photo`, products.`Image1`, products.`Image2`, products.`Image3`, products.`Image4`, products.`Image5`, products.`DelistOrListed`, products.`UnpublishedOrPublished`, productcategories.`Product_Category`, productcategories.`ProductCategory_ID` FROM products INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE `Product_ID` = '$productunpublish'";
	$sqlresult = mysqli_query($conn, $sql);

	while($row = mysqli_fetch_assoc($sqlresult)){

	$productid =$row['Product_ID'];
	$productname = $row['Product_Name'];
	$price = $row['Price'];
	$stocks = $row['Stocks'];
	$brand = $row['Brand'];
	$materials = $row['Materials'];
	$furnituretype = $row['Furniture_Type'];
	$style = $row['Style'];
	$color = $row['Color'];
	$height = $row['Height'];
	$width = $row['Width'];
	$weight = $row['Weight'];
	$model = $row['Model'];
	$pattern = $row['Pattern'];
	$description = $row['Description'];
	$coverphoto = $row['Cover_Photo'];
	$image1 = $row['Image1'];
	$image2 = $row['Image2'];
	$image3 = $row['Image3'];
	$image4 = $row['Image4'];
	$image5 = $row['Image5'];
	$productcategory_id = $row['ProductCategory_ID'];
	$productcategory = $row['Product_Category'];
	}

	$updateproductunpublish = "UPDATE `products` SET `UnpublishedOrPublished`='Unpublished' WHERE Product_ID ='$productunpublish'";
	if($resultproductunpublish = mysqli_query($conn, $updateproductunpublish)){
		header("Location: ../forms/clerk/myproducts_unpublished_grid.php?notification=Unpublish");
	}else{
		header("Location: ../forms/clerk/myproducts_unpublished_grid.php?notification=ErrorUnpublish");
	}
}
?>