<?php
include "connection/db_conn.php";

if (isset($_GET['productlisted'])){
	$productlisted = $_GET['productlisted'];

	$sql ="SELECT products.`Product_ID`, products.`Product_Name`, products.`Price`, products.`Stocks`, products.`Brand`, products.`Materials`, products.`Furniture_Type`, products.`Style`, products.`Color`, products.`Height`, products.`Width`, products.`Weight`, products.`Model`, products.`Pattern`, products.`Description`, products.`Cover_Photo`, products.`Image1`, products.`Image2`, products.`Image3`, products.`Image4`, products.`Image5`, products.`DelistOrListed`, products.`UnpublishedOrPublished`, productcategories.`Product_Category`, productcategories.`ProductCategory_ID` FROM products INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE `Product_ID` = '$productlisted'";
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

	$updateproductlisted = "UPDATE `products` SET `DelistOrListed`='Listed' WHERE Product_ID ='$productlisted'";
	if($resultproductlisted = mysqli_query($conn, $updateproductlisted)){
		header("Location: ../forms/clerk/myproducts_unlisted_grid.php?notification=Listed");
	}else{
		header("Location: ../forms/clerk/myproducts_unlisted_grid.php?notification=ErrorListed");
	}
}


if (isset($_GET['productdelist'])){
	$productdelist = $_GET['productdelist'];

	$sql ="SELECT products.`Product_ID`, products.`Product_Name`, products.`Price`, products.`Stocks`, products.`Brand`, products.`Materials`, products.`Furniture_Type`, products.`Style`, products.`Color`, products.`Height`, products.`Width`, products.`Weight`, products.`Model`, products.`Pattern`, products.`Description`, products.`Cover_Photo`, products.`Image1`, products.`Image2`, products.`Image3`, products.`Image4`, products.`Image5`, products.`DelistOrListed`, products.`UnpublishedOrPublished`, productcategories.`Product_Category`, productcategories.`ProductCategory_ID` FROM products INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE `Product_ID` = '$productdelist'";
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

	$updateproductdelist = "UPDATE `products` SET `DelistOrListed`='Delist' WHERE Product_ID ='$productdelist'";
	if($resultproductdelist = mysqli_query($conn, $updateproductdelist)){
		header("Location: ../forms/clerk/myproducts_unlisted_grid.php?notification=Delist");
	}else{
		header("Location: ../forms/clerk/myproducts_unlisted_grid.php?notification=ErrorDelist");
	}
}
?>