<?php
include "connection/db_conn.php";

if (isset($_GET['product'])){
	$product = $_GET['product'];

	$sql ="SELECT products.`Product_ID`, products.`Product_Name`, products.`Price`, products.`Stocks`, products.`Brand`, products.`Materials`, products.`Furniture_Type`, products.`Style`, products.`Color`, products.`Height`, products.`Width`, products.`Weight`, products.`Model`, products.`Pattern`, products.`Description`, products.`Cover_Photo`, products.`Image1`, products.`Image2`, products.`Image3`, products.`Image4`, products.`Image5`, products.`DelistOrListed`, products.`UnpublishedOrPublished`, productcategories.`Product_Category`, productcategories.`ProductCategory_ID` FROM products INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID WHERE `Product_ID` = '$product'";
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

#Start of Delist
if (isset($_POST['saveanddelist'])) {

	#product information
	$productname = $_POST['product_name'];
	$price = $_POST['price'];
	$stocks = $_POST['stocks'];
	$brand = $_POST['brand'];
	$materials = $_POST['materials'];
	$furnituretype = $_POST['furniture_type'];
	$style = $_POST['style'];
	$color = $_POST['color'];
	$height = $_POST['height'];
	$width = $_POST['width'];
	$weight = $_POST['weight'];
	$model = $_POST['model'];
	$pattern = $_POST['pattern'];
	$description = $_POST['description'];
	$productcategory = $_POST['product_category'];

	$oldimagecover = $_POST['OldImageCover'];
	$oldimageone = $_POST['OldImageOne'];
	$oldimagetwo = $_POST['OldImageTwo'];
	$oldimagethree = $_POST['OldImageThree'];
	$oldimagefour= $_POST['OldImageFour'];
	$oldimagefive = $_POST['OldImageFive'];

	#media management
	$imageCover=$_FILES['CoverImage']['name'];
	$imageCover_tmp=$_FILES['CoverImage']['tmp_name'];
	$imageCover_size=$_FILES['CoverImage']['size'];
	$imageCover_error=$_FILES['CoverImage']['error'];
	$imageOne=$_FILES['ImageOne']['name'];
	$imageOne_tmp=$_FILES['ImageOne']['tmp_name'];
	$imageOne_size=$_FILES['ImageOne']['size'];
	$imageOne_error=$_FILES['ImageOne']['error'];
	$imageTwo=$_FILES['ImageTwo']['name'];
	$imageTwo_tmp=$_FILES['ImageTwo']['tmp_name'];
	$imageTwo_size=$_FILES['ImageTwo']['size'];
	$imageTwo_error=$_FILES['ImageTwo']['error'];
	$imageThree=$_FILES['ImageThree']['name'];
	$imageThree_tmp=$_FILES['ImageThree']['tmp_name'];
	$imageThree_size=$_FILES['ImageThree']['size'];
	$imageThree_error=$_FILES['ImageThree']['error'];
	$imageFour=$_FILES['ImageFour']['name'];
	$imageFour_tmp=$_FILES['ImageFour']['tmp_name'];
	$imageFour_size=$_FILES['ImageFour']['size'];
	$imageFour_error=$_FILES['ImageFour']['error'];
	$imageFive=$_FILES['ImageFive']['name'];
	$imageFive_tmp=$_FILES['ImageFive']['tmp_name'];
	$imageFive_size=$_FILES['ImageFive']['size'];
	$imageFive_error=$_FILES['ImageFive']['error'];
	$data=[];
	$data_name=[$imageCover,$imageOne,$imageTwo,$imageThree,$imageFour,$imageFive];
	$data_tmp_name=[$imageCover_tmp,$imageOne_tmp,$imageTwo_tmp,$imageThree_tmp,$imageFour_tmp,$imageFive_tmp];
	$data_img_size=[$imageCover_size,$imageOne_size,$imageTwo_size,$imageThree_size,$imageFour_size,$imageFive_size];
	$data_error=[$imageCover_error,$imageOne_error,$imageTwo_error,$imageThree_error,$imageFour_error,$imageFive_error];

	if(($productcategory)=="Choose Category"){
		header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorCategory");
	}else{
		#For product information only
		if( (($_FILES['CoverImage']['name'])=="") && (($_FILES['ImageOne']['name'])=="") && (($_FILES['ImageTwo']['name'])=="") && (($_FILES['ImageThree']['name'])=="") && (($_FILES['ImageFour']['name'])=="") && (($_FILES['ImageFive']['name'])=="") ){

			$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product' ";

				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
		}else{
			#FOR COVER IMAGE START
			if( (($_FILES['CoverImage']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Cover_Photo`='$oldimagecover',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
			}else{
				if ($data_error[0] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[0] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageCover_ex = pathinfo($imageCover, PATHINFO_EXTENSION);

						$imageCover_ex_lc = strtolower($imageCover_ex);

						$allowed_exs = array("jpg", "jpeg", "png");

						if (in_array($imageCover_ex_lc,$allowed_exs)){

						$new_imageCover_name = uniqid("IMG-", true).'.'.$imageCover_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[0], $upload_path.$new_imageCover_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Cover_Photo`='$new_imageCover_name',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagecover";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
							}




						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR COVER IMAGE END
			#FOR IMAGE ONE START
			if( (($_FILES['ImageOne']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image1`='$oldimageone',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
			}else{
				if ($data_error[1] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[1] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageOne_ex = pathinfo($imageOne, PATHINFO_EXTENSION);

						$imageOne_ex_lc = strtolower($imageOne_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageOne_ex_lc,$allowed_exs)){

						$new_imageOne_name = uniqid("IMG-", true).'.'.$imageOne_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[1], $upload_path.$new_imageOne_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image1`='$new_imageOne_name',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimageone";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE ONE END
			#FOR IMAGE TWO START
			if( (($_FILES['ImageTwo']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image2`='$oldimagetwo',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
			}else{
				if ($data_error[2] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[2] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageTwo_ex = pathinfo($imageTwo, PATHINFO_EXTENSION);

						$imageTwo_ex_lc = strtolower($imageTwo_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageTwo_ex_lc,$allowed_exs)){

						$new_imageTwo_name = uniqid("IMG-", true).'.'.$imageTwo_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[2], $upload_path.$new_imageTwo_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image2`='$new_imageTwo_name',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagetwo";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE TWO END
			#FOR IMAGE THREE START
			if( (($_FILES['ImageThree']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image3`='$oldimagethree',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
			}else{
				if ($data_error[3] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[3] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageThree_ex = pathinfo($imageThree, PATHINFO_EXTENSION);

						$imageThree_ex_lc = strtolower($imageThree_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageThree_ex_lc,$allowed_exs)){

						$new_imageThree_name = uniqid("IMG-", true).'.'.$imageThree_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[3], $upload_path.$new_imageThree_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image3`='$new_imageThree_name',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagethree";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE THREE END
			#FOR IMAGE FOUR START
			if( (($_FILES['ImageFour']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image4`='$oldimagefour',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
			}else{
				if ($data_error[4] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[4] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageFour_ex = pathinfo($imageFour, PATHINFO_EXTENSION);

						$imageFour_ex_lc = strtolower($imageFour_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageFour_ex_lc,$allowed_exs)){

						$new_imageFour_name = uniqid("IMG-", true).'.'.$imageFour_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[4], $upload_path.$new_imageFour_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image4`='$new_imageFour_name',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagefour";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE FOUR END
			#FOR IMAGE FIVE START
			if( (($_FILES['ImageFive']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image5`='$oldimagefive',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
				}
			}else{
				if ($data_error[5] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[5] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageFive_ex = pathinfo($imageFive, PATHINFO_EXTENSION);

						$imageFive_ex_lc = strtolower($imageFive_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageFive_ex_lc,$allowed_exs)){

						$new_imageFive_name = uniqid("IMG-", true).'.'.$imageFive_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[5], $upload_path.$new_imageFive_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image5`='$new_imageFive_name',`DelistOrListed`='Delist',`UnpublishedOrPublished`='Unpublished',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagefive";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedDelist");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedDelist");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE FIVE END	
		}
	}
}
#End of Delist
#Start of Publish
if (isset($_POST['saveandpublish'])) {

	#product information
	$productname = $_POST['product_name'];
	$price = $_POST['price'];
	$stocks = $_POST['stocks'];
	$brand = $_POST['brand'];
	$materials = $_POST['materials'];
	$furnituretype = $_POST['furniture_type'];
	$style = $_POST['style'];
	$color = $_POST['color'];
	$height = $_POST['height'];
	$width = $_POST['width'];
	$weight = $_POST['weight'];
	$model = $_POST['model'];
	$pattern = $_POST['pattern'];
	$description = $_POST['description'];
	$productcategory = $_POST['product_category'];

	$oldimagecover = $_POST['OldImageCover'];
	$oldimageone = $_POST['OldImageOne'];
	$oldimagetwo = $_POST['OldImageTwo'];
	$oldimagethree = $_POST['OldImageThree'];
	$oldimagefour= $_POST['OldImageFour'];
	$oldimagefive = $_POST['OldImageFive'];

	#media management
	$imageCover=$_FILES['CoverImage']['name'];
	$imageCover_tmp=$_FILES['CoverImage']['tmp_name'];
	$imageCover_size=$_FILES['CoverImage']['size'];
	$imageCover_error=$_FILES['CoverImage']['error'];
	$imageOne=$_FILES['ImageOne']['name'];
	$imageOne_tmp=$_FILES['ImageOne']['tmp_name'];
	$imageOne_size=$_FILES['ImageOne']['size'];
	$imageOne_error=$_FILES['ImageOne']['error'];
	$imageTwo=$_FILES['ImageTwo']['name'];
	$imageTwo_tmp=$_FILES['ImageTwo']['tmp_name'];
	$imageTwo_size=$_FILES['ImageTwo']['size'];
	$imageTwo_error=$_FILES['ImageTwo']['error'];
	$imageThree=$_FILES['ImageThree']['name'];
	$imageThree_tmp=$_FILES['ImageThree']['tmp_name'];
	$imageThree_size=$_FILES['ImageThree']['size'];
	$imageThree_error=$_FILES['ImageThree']['error'];
	$imageFour=$_FILES['ImageFour']['name'];
	$imageFour_tmp=$_FILES['ImageFour']['tmp_name'];
	$imageFour_size=$_FILES['ImageFour']['size'];
	$imageFour_error=$_FILES['ImageFour']['error'];
	$imageFive=$_FILES['ImageFive']['name'];
	$imageFive_tmp=$_FILES['ImageFive']['tmp_name'];
	$imageFive_size=$_FILES['ImageFive']['size'];
	$imageFive_error=$_FILES['ImageFive']['error'];
	$data=[];
	$data_name=[$imageCover,$imageOne,$imageTwo,$imageThree,$imageFour,$imageFive];
	$data_tmp_name=[$imageCover_tmp,$imageOne_tmp,$imageTwo_tmp,$imageThree_tmp,$imageFour_tmp,$imageFive_tmp];
	$data_img_size=[$imageCover_size,$imageOne_size,$imageTwo_size,$imageThree_size,$imageFour_size,$imageFive_size];
	$data_error=[$imageCover_error,$imageOne_error,$imageTwo_error,$imageThree_error,$imageFour_error,$imageFive_error];

	if(($productcategory)=="Choose Category"){
		header("Location: ../forms/clerk/myproducts_all_list.php?notification=ErrorUpdatedCategory");
	}else{
		#For product information only
		if( (($_FILES['CoverImage']['name'])=="") && (($_FILES['ImageOne']['name'])=="") && (($_FILES['ImageTwo']['name'])=="") && (($_FILES['ImageThree']['name'])=="") && (($_FILES['ImageFour']['name'])=="") && (($_FILES['ImageFive']['name'])=="") ){

			$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product' ";

				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
		}else{
			#FOR COVER IMAGE START
			if( (($_FILES['CoverImage']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Cover_Photo`='$oldimagecover',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
			}else{
				if ($data_error[0] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[0] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageCover_ex = pathinfo($imageCover, PATHINFO_EXTENSION);

						$imageCover_ex_lc = strtolower($imageCover_ex);

						$allowed_exs = array("jpg", "jpeg", "png");

						if (in_array($imageCover_ex_lc,$allowed_exs)){

						$new_imageCover_name = uniqid("IMG-", true).'.'.$imageCover_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[0], $upload_path.$new_imageCover_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Cover_Photo`='$new_imageCover_name',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagecover";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR COVER IMAGE END
			#FOR IMAGE ONE START
			if( (($_FILES['ImageOne']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image1`='$oldimageone',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
			}else{
				if ($data_error[1] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[1] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageOne_ex = pathinfo($imageOne, PATHINFO_EXTENSION);

						$imageOne_ex_lc = strtolower($imageOne_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageOne_ex_lc,$allowed_exs)){

						$new_imageOne_name = uniqid("IMG-", true).'.'.$imageOne_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[1], $upload_path.$new_imageOne_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image1`='$new_imageOne_name',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimageone";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE ONE END
			#FOR IMAGE TWO START
			if( (($_FILES['ImageTwo']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image2`='$oldimagetwo',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
			}else{
				if ($data_error[2] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[2] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageTwo_ex = pathinfo($imageTwo, PATHINFO_EXTENSION);

						$imageTwo_ex_lc = strtolower($imageTwo_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageTwo_ex_lc,$allowed_exs)){

						$new_imageTwo_name = uniqid("IMG-", true).'.'.$imageTwo_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[2], $upload_path.$new_imageTwo_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image2`='$new_imageTwo_name',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagetwo";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE TWO END
			#FOR IMAGE THREE START
			if( (($_FILES['ImageThree']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image3`='$oldimagethree',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
			}else{
				if ($data_error[3] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[3] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageThree_ex = pathinfo($imageThree, PATHINFO_EXTENSION);

						$imageThree_ex_lc = strtolower($imageThree_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageThree_ex_lc,$allowed_exs)){

						$new_imageThree_name = uniqid("IMG-", true).'.'.$imageThree_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[3], $upload_path.$new_imageThree_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image3`='$new_imageThree_name',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagethree";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE THREE END
			#FOR IMAGE FOUR START
			if( (($_FILES['ImageFour']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image4`='$oldimagefour',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
			}else{
				if ($data_error[4] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[4] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageFour_ex = pathinfo($imageFour, PATHINFO_EXTENSION);

						$imageFour_ex_lc = strtolower($imageFour_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageFour_ex_lc,$allowed_exs)){

						$new_imageFour_name = uniqid("IMG-", true).'.'.$imageFour_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[4], $upload_path.$new_imageFour_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image4`='$new_imageFour_name',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagefour";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE FOUR END
			#FOR IMAGE FIVE START
			if( (($_FILES['ImageFive']['name'])=="") ){
				$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image5`='$oldimagefive',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";
				
				if($result = mysqli_query($conn, $sql)){
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
				}else{
					header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
				}
			}else{
				if ($data_error[5] < 0) {
					header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorData");
				}else{
					if ($data_img_size[5] > 8000000) {
						header("Location: ../forms/clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorImageSize");
					}else{
						$imageFive_ex = pathinfo($imageFive, PATHINFO_EXTENSION);

						$imageFive_ex_lc = strtolower($imageFive_ex);

						$allowed_exs = array("jpg", "jpeg", "png");


						if (in_array($imageFive_ex_lc,$allowed_exs)){

						$new_imageFive_name = uniqid("IMG-", true).'.'.$imageFive_ex_lc;

						$upload_path = "../../style/assets/products/";
						move_uploaded_file($data_tmp_name[5], $upload_path.$new_imageFive_name);

						$sql ="UPDATE `products` SET `Product_Name`='$productname',`Price`='$price',`Stocks`='$stocks',`Brand`='$brand',`Materials`='$materials',`Furniture_Type`='$furnituretype',`Style`='$style',`Color`='$color',`Height`='$height',`Width`='$width',`Weight`='$weight',`Model`='$model',`Pattern`='$pattern',`Description`='$description',`Image5`='$new_imageFive_name',`DelistOrListed`='Listed',`UnpublishedOrPublished`='Published',`ProductCategory_ID`='$productcategory' WHERE Product_ID ='$product'";

							if($result = mysqli_query($conn, $sql)){

								#REMOVING EXISTING IMAGE
								$deletepath = "../../style/assets/products/$oldimagefive";

								if(!unlink($deletepath)){
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorRemoveImage");
								}else{
									header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=SubmittedUpdatedPublished");
								}
							}else{
								header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorUpdatedPublished");
							}
						
						}else{
							header("Location: ../clerk/updateproduct_unlisted_list.php?product=$product&notification=ErrorFileType");
						}
					}
				}
			}
			#FOR IMAGE FIVE END			
		}
	}
}	
#End of Publish
#Start of Cancel
	elseif (isset($_POST['cancel'])) {
	header("Location: ../../forms/clerk/myproducts_unlisted_list.php");
}
#End of Cancel
}
?>