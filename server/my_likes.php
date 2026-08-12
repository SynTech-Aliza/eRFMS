<?php
include "connection/db_conn.php";

if (isset($_SESSION['UserAccount_ID'])){
	$useraccount_id = $_SESSION['UserAccount_ID'];

	$sqluser ="SELECT `CostumerProfile_ID`, `UserAccount_ID`, `First_Name`, `Middle_Name`, `Last_Name` FROM `costumersprofile` WHERE UserAccount_ID = '$useraccount_id'";
	$resultuser = mysqli_query($conn, $sqluser);
	
	if (mysqli_num_rows($resultuser)==0){
		$costumerprofileid = "";
	}else{													
		while ($rows = $resultuser->fetch_assoc()) {
	   		$costumerprofileid= $rows['CostumerProfile_ID'];
	   		$useraccountid= $rows['UserAccount_ID'];
		}
	}

	#VIEW MYLIKE LIST
	$sqlcostumerlike ="SELECT costumerslike.CostumerLike_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5, products.DelistOrListed, products.UnpublishedOrPublished FROM `costumerslike` INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerslike.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerslike.Product_ID WHERE products.DelistOrListed = 'Listed' AND products.UnpublishedOrPublished='Published' AND costumersprofile.CostumerProfile_ID = '$costumerprofileid' ORDER BY costumerslike.CostumerLike_ID DESC";
	$sqlresultcostumerlike = mysqli_query($conn, $sqlcostumerlike);


	if(isset($_POST['searchmylike'])){
		$searchmylike = $_POST['searchmylike'];
		if($searchmylike == ""){
			header("Location: ../costumer/my_likes.php");
		}else{
			$sqlsearchmylike ="SELECT costumerslike.CostumerLike_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5, products.DelistOrListed, products.UnpublishedOrPublished FROM `costumerslike` INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerslike.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerslike.Product_ID WHERE products.DelistOrListed = 'Listed' AND products.UnpublishedOrPublished='Published' AND costumersprofile.CostumerProfile_ID = '$costumerprofileid' ORDER BY costumerslike.CostumerLike_ID DESC";
			$sqlresultsearchmylike = mysqli_query($conn, $sqlsearchmylike);
			header("Location: ../costumer/my_likes.php?search=$searchmylike");
		}
	}


	#SEARCH RESULT MYLIKE LIST
	if(isset($_GET['search'])){
		$search = $_GET['search'];
		
		$sqlcostumerlike ="SELECT costumerslike.CostumerLike_ID, costumersprofile.CostumerProfile_ID, products.Product_ID, products.Product_Name, products.Price, products.Stocks, products.Cover_Photo, products.Image1, products.Image2, products.Image3, products.Image4, products.Image5, products.DelistOrListed, products.UnpublishedOrPublished FROM `costumerslike` INNER JOIN costumersprofile ON costumersprofile.CostumerProfile_ID = costumerslike.CostumerProfile_ID INNER JOIN products ON products.Product_ID = costumerslike.Product_ID WHERE products.DelistOrListed = 'Listed' AND products.UnpublishedOrPublished='Published' AND costumersprofile.CostumerProfile_ID = '$costumerprofileid' AND products.Product_Name LIKE '%$search%' ORDER BY costumerslike.CostumerLike_ID DESC";
		$sqlresultcostumerlike = mysqli_query($conn, $sqlcostumerlike);
	}				
}
?>