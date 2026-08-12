<?php
include "connection/db_conn.php";

if (isset($_GET['search'])){
	$search = $_GET['search'];
	$sql ="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as Sold,  products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Description, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5, products.DelistOrListed, products.UnpublishedOrPublished, productcategories.Product_Category FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE products.DelistOrListed = 'Listed' AND products.UnpublishedOrPublished = 'Published' AND costumerproductorders.Order_Status = 'Completed' AND products.Product_Name LIKE '%$search%' OR products.DelistOrListed = 'Listed' AND products.UnpublishedOrPublished = 'Published' AND costumerproductorders.Order_Status = 'Completed' AND productcategories.Product_Category LIKE '%$search%' GROUP BY products.Product_ID ORDER BY Sold DESC";
	$result = mysqli_query($conn, $sql);
}

if(isset($_POST['product'])){
		$searchKeywordproductname = $_POST['product'];
		if($searchKeywordproductname == ""){
			header("Location: ../costumer/dashboard.php");
		}else{
			$sql ="SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as Sold,  products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Brand, products.Materials, products.Furniture_Type, products.Style, products.Color, products.Height, products.Width, products.Weight, products.Model, products.Pattern, products.Description, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5, products.DelistOrListed, products.UnpublishedOrPublished, productcategories.Product_Category FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE products.DelistOrListed = 'Listed' AND products.UnpublishedOrPublished = 'Published' AND costumerproductorders.Order_Status = 'Completed' AND products.Product_Name LIKE '%$searchKeywordproductname%' GROUP BY products.Product_ID ORDER BY Sold DESC";
			$result = mysqli_query($conn, $sql);
			header("Location: ../costumer/topsales_products.php?search=$searchKeywordproductname");
		}
}

?>