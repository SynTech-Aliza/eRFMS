<?php
include "connection/db_conn.php";

if (isset($_GET['search'])){
	$search = $_GET['search'];
	$sql ="SELECT products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Description, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5, products.DelistOrListed, products.UnpublishedOrPublished, productcategories.Product_Category FROM `products` INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE `DelistOrListed` = 'Listed' AND `UnpublishedOrPublished` = 'Published' AND  Product_Category LIKE '%$search%' OR `DelistOrListed` = 'Listed' AND `UnpublishedOrPublished` = 'Published' AND Product_Name LIKE '%$search%' ORDER BY Price ASC";
	$result = mysqli_query($conn, $sql);
}

if(isset($_POST['product'])){
		$searchKeywordproductname = $_POST['product'];
		if($searchKeywordproductname == ""){
			header("Location: ../costumer/dashboard.php");
		}else{
			$sql ="SELECT `Product_ID`, `Product_Name`, `Price`, `Stocks`, `Brand`, `Materials`, `Furniture_Type`, `Style`, `Color`, `Height`, `Width`, `Weight`, `Model`, `Pattern`, `Description`, `Cover_Photo`, `Image1`, `Image2`, `Image3`, `Image4`, `Image5`, `Delist/Listed`, `Unpublished/Published`, `Product_Category_ID` FROM `product` WHERE`Delist/Listed` ='Listed' AND `Unpublished/Published` ='Publish' AND Product_Name LIKE '%$searchKeywordproductname%' ORDER BY Price ASC";
			$result = mysqli_query($conn, $sql);
			header("Location: ../costumer/relevance_products.php?search=$searchKeywordproductname");
		}
		
}

?>