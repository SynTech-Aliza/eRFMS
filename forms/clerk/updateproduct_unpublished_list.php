<?php
session_start();
include "../../server/connection/db_conn.php";
include "../../server/updateproduct_unpublished_list.php";

$sql = "SELECT * FROM `productcategories`";

$result = mysqli_query($conn, $sql);

?>

<!DOCTYPE html>
<html>
<head>
  <title>Rose Furniture</title>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
  <script src="../../style/javascript/DisplayProductImage.js"></script>
  <script src="../../style/javascript/InputCount.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="stylesheet" type="text/css" href="../../style/css/clerk/updateproduct.css">
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
      <li><a>Update Product</a></li>
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
              <td colspan="2">*Product Category
                <select name="product_category" id="product_category" class="product_category" >
                  <option value="<?php echo $productcategory_id ?>"><?php echo $productcategory ?></option>
                  <?php  while ($row = mysqli_fetch_array($result)):;   ?>
                  <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                  <?php endwhile;?>
                  <small class="error"></small>
                </select>
              </td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="2">*Product Name <input type="text" name="product_name"  id="product_name" value="<?php echo $productname ?>"class="product_name count-chars" autocomplete="off"  maxlength="100" data-max-chars="100"><span class="counter">100</span><small class="error"></small></td>
              <td>*Product Price <input type="number" name="price" id="price" value="<?php echo $price ?>" class="price" autocomplete="off"><small class="error"></small></td>
              <td>*Stocks <input type="number" name="stocks" id="stocks" value="<?php echo $stocks ?>" class="stocks" autocomplete="off"><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td>*Brand <input type="text" name="brand" id="brand" value="<?php echo $brand ?>" class="brand" autocomplete="off" ><small class="error"></small></td>
              <td>*Materials <input type="text" name="materials" id="materials" value="<?php echo $materials ?>" class="materials" autocomplete="off" ><small class="error"></small></td>
              <td>*Furniture Type <input type="text" name="furniture_type" id="furniture_type" value="<?php echo $furnituretype ?>" class="furniture_type" autocomplete="off" ><small class="error"></small></td>
              <td>*Style <input type="text" name="style" id="style" value="<?php echo $style ?>" class="style" autocomplete="off" ><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td>*Color <input type="text" name="color" id="color" value="<?php echo $color ?>" class="color" autocomplete="off" ><small class="error"></small></td>
              <td>*Height <input type="number" name="height" id="height" value="<?php echo $height ?>" class="height" autocomplete="off"  placeholder="m"><small class="error"></small></td>
              <td>*Width <input type="number" name="width" id="width" value="<?php echo $width ?>" class="width" autocomplete="off"  placeholder="m"><small class="error"></small></td>
              <td>*Weight <input type="number" name="weight" id="weight" value="<?php echo $weight ?>" class="weight" autocomplete="off"  placeholder="kg"><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="2">*Model <input type="text" name="model" id="model" value="<?php echo $model ?>" class="model" autocomplete="off" ><small class="error"></small></td>
              <td colspan="2">*Pattern <input type="text" name="pattern" id="pattern" value="<?php echo $pattern ?>" class="pattern" autocomplete="off" ><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="4" class="description_label">*Descriptions<br/><textarea class="description" id="description"  name="description" autocomplete="off" ><?php echo $description ?></textarea></td>
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
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickCover()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/products/<?php echo $coverphoto ?>" onClick="triggerClickCover()" id="coverDisplay">
              </span>
              <div class="form-control">
              <input type="text" name="OldImageCover" value="<?php echo $coverphoto ?>" style="display: none;"> 
              <input type="file" name="CoverImage" onChange="displayImageCover(this)" id="coverImage" class="form-control" style="display: none;" > 
              <small class="error"></small> 
              </div>
              </div>
              *Cover Photo</td>
              <!--COVER IMAGE END-->
              <!--IMAGE ONE START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageOne()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/products/<?php echo $image1 ?>" onClick="triggerClickImageOne()" id="ImageOneDisplay">
              </span>
              <div class="form-control">
              <input type="text" name="OldImageOne" value="<?php echo $image1 ?>" style="display: none;"> 
              <input type="file" name="ImageOne" onChange="displayImageOne(this)" id="ImageOne" class="form-control" style="display: none;" >
              <small class="error"></small> 
              </div>
              </div>
              *Image One</td>
              <!--IMAGE ONE END-->
              <!--IMAGE TWO START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageTwo()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/products/<?php echo $image2 ?>" onClick="triggerClickImageTwo()" id="ImageTwoDisplay">
              </span>
              <div class="form-control">
              <input type="text" name="OldImageTwo" value="<?php echo $image2 ?>" style="display: none;"> 
              <input type="file" name="ImageTwo" onChange="displayImageTwo(this)" id="ImageTwo" class="form-control" style="display: none;" >
              <small class="error"></small> 
              </div>
              </div>
              *Image Two</td>
              <!--IMAGE TWO END-->
            </tr>
            <tr>
              <!--IMAGE THREE START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageThree()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/products/<?php echo $image3 ?>" onClick="triggerClickImageThree()" id="ImageThreeDisplay">
                </span>
              </span>
              <div class="form-control">
              <input type="text" name="OldImageThree" value="<?php echo $image3 ?>" style="display: none;"> 
              <input type="file" name="ImageThree" onChange="displayImageThree(this)" id="ImageThree" class="form-control" style="display: none;" >
              <small class="error"></small> 
              </div>
              </div>
              *Image Three</td>
              <!--IMAGE THREE END-->
              <!--IMAGE FOUR START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageFour()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/products/<?php echo $image4 ?>" onClick="triggerClickImageFour()" id="ImageFourDisplay">
              </span>
              <div class="form-control">
              <input type="text" name="OldImageFour" value="<?php echo $image4 ?>" style="display: none;"> 
              <input type="file" name="ImageFour" onChange="displayImageFour(this)" id="ImageFour" class="form-control" style="display: none;" >
              <small class="error"></small> 
              </div>
              </div>
              *Image Four</td>
              <!--IMAGE FOUR END-->
              <!--IMAGE FIVE START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageFive()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/products/<?php echo $image5 ?>" onClick="triggerClickImageFive()" id="ImageFiveDisplay">
              </span>
              <div class="form-control">
              <input type="text" name="OldImageFive" value="<?php echo $image5 ?>" style="display: none;"> 
              <input type="file" name="ImageFive" onChange="displayImageFive(this)" id="ImageFive" class="form-control" style="display: none;" >
              <small class="error"></small> 
              </div>
              </div>
              *Image Five</td>
              <!--IMAGE FIVE END-->
            </tr>
          </table>
        </div>
      </section>
      <section class="options">
        <div class="btn_options">
          <button type="cancel" value="cancel" name="cancel">Cancel</button>
          <button type="submit" value="submit" id="saveanddelist" name="saveanddelist">Save and Delist</button>
          <button class="publish" value="submit" type="submit" id="saveandpublish" name="saveandpublish" >Save and Publish</button>
        </div>
      </section>
    </form>
  </div>
</div>
<!--MAIN CONTAINER END-->

<!--NOTIFICATIONS START-->
<?php
  $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
#Add New Products
  #Success
    #Delist
  if($notification=='SubmittedUpdatedDelist'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Updated Delisted",
    showConfirmButton: false,
    timer: 1500
  }).then(function() {
    window.location = "myproducts_unpublished_list.php";
  });
    </script>';
  }elseif($notification=='ErrorUpdatedDelist'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Unsuccessfully Updated Delisted",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorData'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Data Image",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorImageSize'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Image Size",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorFileType'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error File Type",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorRemoveImage'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Error Remove Image in File",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorCategory'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Please Choose Category",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }

  elseif($notification=='SubmittedUpdatedPublished'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Updated Published",
    showConfirmButton: false,
    timer: 1500
  }).then(function() {
    window.location = "myproducts_unpublished_list.php";
  });
    </script>';
  }elseif($notification=='ErrorUpdatedPublished'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Unsuccessfully Updated Published",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }
  ?>
<!--NOTIFICATIONS END-->

<?php
}else{
  header("Location:../login.php");
  exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>