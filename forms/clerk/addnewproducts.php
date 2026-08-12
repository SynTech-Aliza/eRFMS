<?php
session_start();
include "../../server/connection/db_conn.php";

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
  <link rel="stylesheet" type="text/css" href="../../style/css/clerk/addnewproducts.css">
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
      <li><a>Add New Products</a></li>
    </ul>
  </div>
  <!--SUB MENU NAVIGATION BAR END-->

  <div class="card">
    <!--FORM START-->
     <form action="../../server/addnewproducts.php" method="post" enctype="multipart/form-data" name="form" onsubmit="return validationForm()" onsubmit="return validateForm()" required>
      <section class="product_information">
        <div class="border">
          <p>PRODUCT INFORMATION</p>
          <table border="0">
            <tr>
            <div class="form-control">
              <td colspan="2">*Product Category
                <select name="product_category" id="product_category" class="product_category" required>
                  <option value="">Choose Category</option>
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
              <td colspan="2">*Product Name <input type="text" name="product_name"  id="product_name" class="product_name count-chars" autocomplete="off" required="yes" maxlength="100" data-max-chars="100"><span class="counter">100</span><small class="error"></small></td>
              <td>*Product Price <input type="number" name="price" id="price" class="price" autocomplete="off"><small class="error"></small></td>
              <td>*Stocks <input type="number" name="stocks" id="stocks" class="stocks" autocomplete="off"><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td>*Brand <input type="text" name="brand" id="brand" class="brand" autocomplete="off" required="yes"><small class="error"></small></td>
              <td>*Materials <input type="text" name="materials" id="materials" class="materials" autocomplete="off" required="yes"><small class="error"></small></td>
              <td>*Furniture Type <input type="text" name="furniture_type" id="furniture_type" class="furniture_type" autocomplete="off" required="yes"><small class="error"></small></td>
              <td>*Style <input type="text" name="style" id="style" class="style" autocomplete="off" required="yes"><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td>*Color <input type="text" name="color" id="color" class="color" autocomplete="off" required="yes"><small class="error"></small></td>
              <td>*Height <input type="number" name="height" id="height" class="height" autocomplete="off" required="yes" placeholder="m"><small class="error"></small></td>
              <td>*Width <input type="number" name="width" id="width" class="width" autocomplete="off" required="yes" placeholder="m"><small class="error"></small></td>
              <td>*Weight <input type="number" name="weight" id="weight" class="weight" autocomplete="off" required="yes" placeholder="kg"><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="2">*Model <input type="text" name="model" id="model" class="model" autocomplete="off" required="yes"><small class="error"></small></td>
              <td colspan="2">*Pattern <input type="text" name="pattern" id="pattern" class="pattern" autocomplete="off" required="yes"><small class="error"></small></td>
            </div>
            </tr>
            <tr>
            <div class="form-control">
              <td colspan="4" class="description_label">*Descriptions<br/><textarea class="description" id="description" name="description" autocomplete="off" required="yes"></textarea></td>
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
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/img/background.png" onClick="triggerClickCover()" id="coverDisplay">
              </span>
              <div class="form-control">
              <input type="file" name="CoverImage" onChange="displayImageCover(this)" id="coverImage" class="form-control" style="display: none;" required> 
              <small class="error"></small> 
              </div>
              </div>
              *Cover Photo</td>
              <!--COVER IMAGE END-->
              <!--IMAGE ONE START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageOne()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/img/background.png" onClick="triggerClickImageOne()" id="ImageOneDisplay">
              </span>
              <div class="form-control">
              <input type="file" name="ImageOne" onChange="displayImageOne(this)" id="ImageOne" class="form-control" style="display: none;" required="yes">
              <small class="error"></small> 
              </div>
              </div>
              *Image One</td>
              <!--IMAGE ONE END-->
              <!--IMAGE TWO START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageTwo()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/img/background.png" onClick="triggerClickImageTwo()" id="ImageTwoDisplay">
              </span>
              <div class="form-control">
              <input type="file" name="ImageTwo" onChange="displayImageTwo(this)" id="ImageTwo" class="form-control" style="display: none;" required="yes">
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
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/img/background.png" onClick="triggerClickImageThree()" id="ImageThreeDisplay">
              </span>
              <div class="form-control">
              <input type="file" name="ImageThree" onChange="displayImageThree(this)" id="ImageThree" class="form-control" style="display: none;" required="yes">
              <small class="error"></small> 
              </div>
              </div>
              *Image Three</td>
              <!--IMAGE THREE END-->
              <!--IMAGE FOUR START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageFour()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/img/background.png" onClick="triggerClickImageFour()" id="ImageFourDisplay">
              </span>
              <div class="form-control">
              <input type="file" name="ImageFour" onChange="displayImageFour(this)" id="ImageFour" class="form-control" style="display: none;" required="yes">
              <small class="error"></small> 
              </div>
              </div>
              *Image Four</td>
              <!--IMAGE FOUR END-->
              <!--IMAGE FIVE START-->
              <td><div class="image" style="position: relative;" >
              <span class="img-div">
              <div class="img-placeholder"  onClick="triggerClickImageFive()"></div>
              <i class="fa fa-plus-circle"></i><img src="../../style/assets/img/background.png" onClick="triggerClickImageFive()" id="ImageFiveDisplay">
              </span>
              <div class="form-control">
              <input type="file" name="ImageFive" onChange="displayImageFive(this)" id="ImageFive" class="form-control" style="display: none;" required="yes">
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
  if($notification=='SubmittedDelist'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Delisted",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }
    #Publish
  elseif($notification=='SubmittedPublish'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "success",
    text: "Successfully Publish",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
    }

  #Warning
  elseif($notification=='ErrorCategory'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Choose Category",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='Error'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Data Error.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='CoverImage'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Cover image size is too large.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ImageOne'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Image one size is too large..",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ImageTwo'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Image two size is too large.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ImageThree'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Image three size is too large.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ImageFour'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Image four size is too large.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ImageFive'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Image five size is too large.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorSubmittedDelist'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Unsuccessfully Submitted",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorFileType'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "There was an error in your file type.",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
  }elseif($notification=='ErrorSubmittedPublish'){
    echo '<script type="text/javascript">
  Swal.fire({
    position: "top-end",
    icon: "warning",
    text: "Unsuccessfully Submitted",
    showConfirmButton: false,
    timer: 1500
  })
    </script>';
    }
?>
<!--NOTIFICATIONS END-->
<script type="text/javascript">
document.getElementById("saveanddelist").onclick = function(e) {
  if (document.getElementById("coverImage").value == "") {
    e.preventDefault();
    alert("Please insert Cover Photo.");
  }
  else if (document.getElementById("ImageOne").value == "") {
    e.preventDefault();
    alert("Please insert Image One.");
  }
  else if (document.getElementById("ImageTwo").value == "") {
    e.preventDefault();
    alert("Please insert Image Two.");
  }
  else if (document.getElementById("ImageThree").value == "") {
    e.preventDefault();
    alert("Please insert Image Three.");
  }
  else if (document.getElementById("ImageFour").value == "") {
    e.preventDefault();
    alert("Please insert Image Four.");
  }
  else if (document.getElementById("ImageFive").value == "") {
    e.preventDefault();
    alert("Please insert Image Five.");
  }
}
document.getElementById("saveandpublish").onclick = function(e) {
  if (document.getElementById("coverImage").value == "") {
    e.preventDefault();
    alert("Please insert Cover Photo.");
  }
  else if (document.getElementById("ImageOne").value == "") {
    e.preventDefault();
    alert("Please insert Image One.");
  }
  else if (document.getElementById("ImageTwo").value == "") {
    e.preventDefault();
    alert("Please insert Image Two.");
  }
  else if (document.getElementById("ImageThree").value == "") {
    e.preventDefault();
    alert("Please insert Image Three.");
  }
  else if (document.getElementById("ImageFour").value == "") {
    e.preventDefault();
    alert("Please insert Image Four.");
  }
  else if (document.getElementById("ImageFive").value == "") {
    e.preventDefault();
    alert("Please insert Image Five.");
  }
}
</script>
<?php
}else{
  header("Location:../login.php");
  exit();
}
?>
<!---PHP SESSION END-->
</body>
</html>