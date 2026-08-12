<?php
include "connection/db_conn.php";

#FOR TOP PRODUCTS DISPLAY
$sqltopproducts = "SELECT COUNT(costumerproductorders.CostumerProductOrder_ID) as TopProducts, COUNT(costumerproductorders.CostumerProductOrder_ID) as Sold, costumerproductorders.CostumerProductOrder_ID, costumerproductorders.Order_Status, costumerspurchase.CostumerPurchase_ID, costumerspurchaseproduct.CostumerPurchaseProduct_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Cover_Photo FROM costumerproductorders INNER JOIN costumerspurchase ON costumerspurchase.CostumerPurchase_ID = costumerproductorders.CostumerPurchase_ID INNER JOIN costumerspurchaseproduct ON costumerspurchase.CostumerPurchase_ID = costumerspurchaseproduct.CostumerPurchase_ID INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerspurchase.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerspurchaseproduct.Product_ID WHERE costumerproductorders.Order_Status = 'Completed' GROUP BY products.Product_ID ORDER BY TopProducts DESC LIMIT 10";
$resulttopproducts = mysqli_query($conn, $sqltopproducts);



#FOR PRODUCT CATEGORIES DISPLAY

$sqlcategory = "SELECT * FROM `productcategories`";

$resultcategory = mysqli_query($conn, $sqlcategory);


#FOR SEARCH PRODUCT
if (isset($_POST['search'])) {
		$productname = $_POST['product'];
		if($productname ==""){
		header("Location: ../costumer/dashboard.php");	
		}else{
		header("Location: ../costumer/relevance_products.php?search=$productname");
		exit();
		}
}

?>