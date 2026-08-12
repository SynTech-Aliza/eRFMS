<?php

session_start(); 
include "connection/db_conn.php";

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
		header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorCategory");
	}else{
		if ($data_error[0] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[1] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[2] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[3] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[4] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[5] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}else{
			if ($data_img_size[0] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=CoverImage");
			}elseif ($data_img_size[1] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageOne");
			}elseif ($data_img_size[2] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageTwo");
			}elseif ($data_img_size[3] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageThree");
			}elseif ($data_img_size[4] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageFour");
			}elseif ($data_img_size[5] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageFive");
			}else{
				$imageCover_ex = pathinfo($imageCover, PATHINFO_EXTENSION);
				$imageOne_ex = pathinfo($imageOne, PATHINFO_EXTENSION);
				$imageTwo_ex = pathinfo($imageTwo, PATHINFO_EXTENSION);
				$imageThree_ex = pathinfo($imageThree, PATHINFO_EXTENSION);
				$imageFour_ex = pathinfo($imageFour, PATHINFO_EXTENSION);
				$imageFive_ex = pathinfo($imageFive, PATHINFO_EXTENSION);

				$imageCover_ex_lc = strtolower($imageCover_ex);
				$imageOne_ex_lc = strtolower($imageOne_ex);
				$imageTwo_ex_lc = strtolower($imageTwo_ex);
				$imageThree_ex_lc = strtolower($imageThree_ex);
				$imageFour_ex_lc = strtolower($imageFour_ex);
				$imageFive_ex_lc = strtolower($imageFive_ex);

				$allowed_exs = array("jpg", "jpeg", "png"); 

				if ((in_array($imageCover_ex_lc,$allowed_exs))&&(in_array($imageOne_ex_lc,$allowed_exs))&&(in_array($imageTwo_ex_lc,$allowed_exs))&&(in_array($imageThree_ex_lc,$allowed_exs))&&(in_array($imageFour_ex_lc,$allowed_exs))&&(in_array($imageFive_ex_lc,$allowed_exs))){

					$new_imageCover_name = uniqid("IMG-", true).'.'.$imageCover_ex_lc;
					$new_imageOne_name = uniqid("IMG-", true).'.'.$imageOne_ex_lc;
					$new_imageTwo_name = uniqid("IMG-", true).'.'.$imageTwo_ex_lc;
					$new_imageThree_name = uniqid("IMG-", true).'.'.$imageThree_ex_lc;
					$new_imageFour_name = uniqid("IMG-", true).'.'.$imageFour_ex_lc;
					$new_imageFive_name = uniqid("IMG-", true).'.'.$imageFive_ex_lc;

					$upload_path = "../style/assets/products/";
					move_uploaded_file($data_tmp_name[0], $upload_path.$new_imageCover_name);
					move_uploaded_file($data_tmp_name[1], $upload_path.$new_imageOne_name);
					move_uploaded_file($data_tmp_name[2], $upload_path.$new_imageTwo_name);
					move_uploaded_file($data_tmp_name[3], $upload_path.$new_imageThree_name);
					move_uploaded_file($data_tmp_name[4], $upload_path.$new_imageFour_name);
					move_uploaded_file($data_tmp_name[5], $upload_path.$new_imageFive_name);

					$sqlalter ="ALTER TABLE products AUTO_INCREMENT = 1;";
					if($resultalter = mysqli_query($conn, $sqlalter)){
						$sql ="INSERT INTO `products`(`Product_Name`, `Price`, `Stocks`, `Brand`, `Materials`, `Furniture_Type`, `Style`, `Color`, `Height`, `Width`, `Weight`, `Model`, `Pattern`, `Description`, `Cover_Photo`, `Image1`, `Image2`, `Image3`, `Image4`, `Image5`, `DelistOrListed`, `UnpublishedOrPublished`, `ProductCategory_ID`) 
								VALUES('$productname', '$price', '$stocks', '$brand', '$materials', '$furnituretype', '$style', '$color', '$height', '$width', '$weight', '$model', '$pattern', '$description', '$new_imageCover_name', '$new_imageOne_name', '$new_imageTwo_name','$new_imageThree_name', '$new_imageFour_name', '$new_imageFive_name', 'Delist','Unpublished', '$productcategory' )";

						if($result = mysqli_query($conn, $sql)){
							header("Location: ../forms/clerk/addnewproducts.php?notification=SubmittedPublish");
						}else{
							header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorSubmittedPublish");
						}
					}else{
						header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorAlter");
					}
				}else{
					header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorFileType");
				}
			}

		}
	}
}elseif (isset($_POST['saveandpublish'])) {
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
		header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorCategory");
	}else{
		if ($data_error[0] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[1] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[2] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[3] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[4] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}elseif ($data_error[5] < 0) {
			header("Location: ../forms/clerk/addnewproducts.php?notification=Error");
		}else{
			if ($data_img_size[0] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=CoverImage");
			}elseif ($data_img_size[1] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageOne");
			}elseif ($data_img_size[2] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageTwo");
			}elseif ($data_img_size[3] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageThree");
			}elseif ($data_img_size[4] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageFour");
			}elseif ($data_img_size[5] > 8000000) {
				header("Location: ../forms/clerk/addnewproducts.php?notification=ImageFive");
			}else{
				$imageCover_ex = pathinfo($imageCover, PATHINFO_EXTENSION);
				$imageOne_ex = pathinfo($imageOne, PATHINFO_EXTENSION);
				$imageTwo_ex = pathinfo($imageTwo, PATHINFO_EXTENSION);
				$imageThree_ex = pathinfo($imageThree, PATHINFO_EXTENSION);
				$imageFour_ex = pathinfo($imageFour, PATHINFO_EXTENSION);
				$imageFive_ex = pathinfo($imageFive, PATHINFO_EXTENSION);

				$imageCover_ex_lc = strtolower($imageCover_ex);
				$imageOne_ex_lc = strtolower($imageOne_ex);
				$imageTwo_ex_lc = strtolower($imageTwo_ex);
				$imageThree_ex_lc = strtolower($imageThree_ex);
				$imageFour_ex_lc = strtolower($imageFour_ex);
				$imageFive_ex_lc = strtolower($imageFive_ex);

				$allowed_exs = array("jpg", "jpeg", "png"); 

				if ((in_array($imageCover_ex_lc,$allowed_exs))&&(in_array($imageOne_ex_lc,$allowed_exs))&&(in_array($imageTwo_ex_lc,$allowed_exs))&&(in_array($imageThree_ex_lc,$allowed_exs))&&(in_array($imageFour_ex_lc,$allowed_exs))&&(in_array($imageFive_ex_lc,$allowed_exs))){

					$new_imageCover_name = uniqid("IMG-", true).'.'.$imageCover_ex_lc;
					$new_imageOne_name = uniqid("IMG-", true).'.'.$imageOne_ex_lc;
					$new_imageTwo_name = uniqid("IMG-", true).'.'.$imageTwo_ex_lc;
					$new_imageThree_name = uniqid("IMG-", true).'.'.$imageThree_ex_lc;
					$new_imageFour_name = uniqid("IMG-", true).'.'.$imageFour_ex_lc;
					$new_imageFive_name = uniqid("IMG-", true).'.'.$imageFive_ex_lc;

					$upload_path = "../style/assets/products/";
					move_uploaded_file($data_tmp_name[0], $upload_path.$new_imageCover_name);
					move_uploaded_file($data_tmp_name[1], $upload_path.$new_imageOne_name);
					move_uploaded_file($data_tmp_name[2], $upload_path.$new_imageTwo_name);
					move_uploaded_file($data_tmp_name[3], $upload_path.$new_imageThree_name);
					move_uploaded_file($data_tmp_name[4], $upload_path.$new_imageFour_name);
					move_uploaded_file($data_tmp_name[5], $upload_path.$new_imageFive_name);

					$sqlalter ="ALTER TABLE products AUTO_INCREMENT = 1;";
					if($resultalter = mysqli_query($conn, $sqlalter)){
						$sql ="INSERT INTO `products`(`Product_Name`, `Price`, `Stocks`, `Brand`, `Materials`, `Furniture_Type`, `Style`, `Color`, `Height`, `Width`, `Weight`, `Model`, `Pattern`, `Description`, `Cover_Photo`, `Image1`, `Image2`, `Image3`, `Image4`, `Image5`, `DelistOrListed`, `UnpublishedOrPublished`, `ProductCategory_ID`) 
								VALUES('$productname', '$price', '$stocks', '$brand', '$materials', '$furnituretype', '$style', '$color', '$height', '$width', '$weight', '$model', '$pattern', '$description', '$new_imageCover_name', '$new_imageOne_name', '$new_imageTwo_name','$new_imageThree_name', '$new_imageFour_name', '$new_imageFive_name', 'Listed','Published', '$productcategory' )";

						if($result = mysqli_query($conn, $sql)){
							header("Location: ../forms/clerk/addnewproducts.php?notification=SubmittedDelist");
						}else{
							header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorSubmittedDelist");
						}
					}else{
						header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorAlter");
					}
				}else{
					header("Location: ../forms/clerk/addnewproducts.php?notification=ErrorFileType");
				}
			}

		}
	}
}elseif (isset($_POST['cancel'])) {
	header("Location: ../forms/clerk/addnewproducts.php");
}
?>