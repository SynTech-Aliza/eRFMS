<?php
session_start();
include "../../server/connection/db_conn.php";
include "../../server/myproducts_viewmoredetails.php";

$sql = "SELECT * FROM `productcategories`";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Rose Furniture</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="../../style/css/clerk/myproducts_viewmore_list.css">
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

<!--NAVIGATION BAR START-->
<?php include 'navigationbar.php'; ?>
<!--NAVIGATION BAR END-->

<!--MAIN CONTAINER START-->
<div class="main-container">
  <!--SUB MENU NAVIGATION BAR START-->
  <div class="sub-header-menu">
    <ul>
      <li><a>Product Details</a></li>
    </ul>
  </div>
  <!--SUB MENU NAVIGATION BAR END-->

  <div class="card">
    <!--FORM START-->
     <form method="post" enctype="multipart/form-data" name="form" onsubmit="return validationForm()" onsubmit="return validateForm()" >
      <section class="product_information">
        <div class="border">
          <p>PRODUCT INFORMATION</p>
          <table border="0">
            <tr>
            <div class="form-control">
              <td colspan="2">*Product Category <input type="text" name="product_name"  id="product_name" value="<?php echo $productcategory ?>"class="product_name count-chars"  readonly="yes">
              </td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="2">*Product Name <input type="text" name="product_name"  id="product_name" value="<?php echo $productname ?>"class="product_name count-chars" readonly="yes"></td>
              <td>*Product Price <input type="text" name="price" id="price" value="<?php echo "₱".$price ?>" class="price" readonly="yes"></td>
              <td>*Stocks <input type="text" name="stocks" id="stocks" value="<?php echo $stocks ?>" class="stocks" readonly="yes"></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td>*Brand <input type="text" name="brand" id="brand" value="<?php echo $brand ?>" class="brand" readonly="yes"></td>
              <td>*Materials <input type="text" name="materials" id="materials" value="<?php echo $materials ?>" class="materials" readonly="yes"></td>
              <td>*Furniture Type <input type="text" name="furniture_type" id="furniture_type" value="<?php echo $furnituretype ?>" class="furniture_type" readonly="yes"></td>
              <td>*Style <input type="text" name="style" id="style" value="<?php echo $style ?>" class="style" readonly="yes"></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td>*Color <input type="text" name="color" id="color" value="<?php echo $color ?>" class="color" readonly="yes"></td>
              <td>*Height <input type="text" name="height" id="height" value="<?php echo $height." m" ?>" class="height" readonly="yes"></td>
              <td>*Width <input type="text" name="width" id="width" value="<?php echo $width. " m" ?>" class="width" readonly="yes"></td>
              <td>*Weight <input type="text" name="weight" id="weight" value="<?php echo $weight. " kg" ?>" class="weight" readonly="yes"></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="2">*Model <input type="text" name="model" id="model" value="<?php echo $model ?>" class="model"  readonly="yes"></td>
              <td colspan="2">*Pattern <input type="text" name="pattern" id="pattern" value="<?php echo $pattern ?>" class="pattern" readonly="yes"></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="4" class="description_label">*Descriptions<br/><textarea class="description" id="description"  name="description" readonly="yes"><?php echo $description ?></textarea></td>
            </div>
            </tr>
          </table>
        </div>
      </section>
      <section class="media_management">
        <div class="border">
          <p>MEDIA MANAGEMENT</p>
          <table border="0">
            <tr>
              <!--COVER IMAGE START-->
              <td>
                <div class="image" style="position: relative;" >
                <span class="img-div">
                <div class="img-placeholder"  onClick="triggerClickCover()"></div>
                <img src="../../style/assets/products/<?php echo $coverphoto ?>" onClick="triggerClickCover()" id="coverDisplay">
                </span>
                </div>
              *Cover Photo</td>
              <!--COVER IMAGE END-->
              <!--IMAGE ONE START-->
              <td>
                <div class="image" style="position: relative;" >
                <span class="img-div">
                <div class="img-placeholder"  onClick="triggerClickImageOne()"></div>
                <img src="../../style/assets/products/<?php echo $image1 ?>" onClick="triggerClickImageOne()" id="ImageOneDisplay">
                </span>
                </div>
              *Image One</td>
              <!--IMAGE ONE END-->
              <!--IMAGE TWO START-->
              <td>
                <div class="image" style="position: relative;" >
                <span class="img-div">
                <div class="img-placeholder"  onClick="triggerClickImageTwo()"></div>
                <img src="../../style/assets/products/<?php echo $image2 ?>" onClick="triggerClickImageTwo()" id="ImageTwoDisplay">
                </span>
                </div>
              *Image Two</td>
              <!--IMAGE TWO END-->
            </tr>
            <tr>
              <!--IMAGE THREE START-->
              <td>
                <div class="image" style="position: relative;" >
                <span class="img-div">
                <div class="img-placeholder"  onClick="triggerClickImageThree()"></div>
                <img src="../../style/assets/products/<?php echo $image3 ?>" onClick="triggerClickImageThree()" id="ImageThreeDisplay">
                </span>
                </div>
              *Image Three</td>
              <!--IMAGE THREE END-->
              <!--IMAGE FOUR START-->
              <td>
                <div class="image" style="position: relative;" >
                <span class="img-div">
                <div class="img-placeholder"  onClick="triggerClickImageFour()"></div>
                <img src="../../style/assets/products/<?php echo $image4 ?>" onClick="triggerClickImageFour()" id="ImageFourDisplay">
                </span>
                </div>
              *Image Four</td>
              <!--IMAGE FOUR END-->
              <!--IMAGE FIVE START-->
              <td>
                <div class="image" style="position: relative;" >
                <span class="img-div">
                <div class="img-placeholder"  onClick="triggerClickImageFive()"></div>
                <img src="../../style/assets/products/<?php echo $image5 ?>" onClick="triggerClickImageFive()" id="ImageFiveDisplay">
                </span>
                </div>
              *Image Five</td>
              <!--IMAGE FIVE END-->
            </tr>
          </table>
        </div>
      </section>
      <section class="options">
        <div class="btn_options">
          <button><a href="myproducts_unlisted_list.php">Back</a></button>
          <button class="publish" ><a href="updateproduct_unlisted_list.php?product=<?php echo $productid; ?>">Update</a></button>
        </div>
      </section>
    </form>
  </div>
</div>
<?php
}else{
  header("Location:../login.php");
  exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>