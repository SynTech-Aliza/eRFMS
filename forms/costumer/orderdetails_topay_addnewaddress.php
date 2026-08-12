<?php
include "../../server/orderdetails_topay_addnewaddress.php";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Rose Furniture</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../style/css/costumer/orderdetails_topay_addnewaddress.css">
<script>
    window.load=$( document ).ready(function() {
        $.ajax({
            type:'POST',
            url:'../../server/addnewaddress_selectregion.php',
            success:function(html){
                $('#region').html(html);
                }
            }); 
	});  

	$( document ).ready(function() {
    	$('#region').on('change',function(){
        var regionID = $(this).val();
            if(regionID){
                $.ajax({
                    type:'POST',
                    url:'../../server/addnewaddress_selectdataaddress.php',
                    data:'region_id='+regionID,
                    success:function(html){
                        $('#province').html(html);
                        $('#city').html('<option value="">Select Option</option>');
                        $('#barangay').html('<option value="">Select Option</option>');  
                                            }
                        }); 
            }else{
                $('#province').html('<option value="">Select Option</option>');
                $('#city').html('<option value="">Select Option</option>');
                $('#barangay').html('<option value="">Select Option</option>');  
            }
        });
        
        $('#province').on('change',function(){//change state to display all city
        var provinceID = $(this).val();
            if(provinceID){
                $.ajax({
                    type:'POST',
                    url:'../../server/addnewaddress_selectdataaddress.php',
                    data:'province_id='+provinceID,
                    success:function(html){
                        $('#city').html(html);
                        $('#barangay').html('<option value="">Select Option</option>');  
                                            }
                        }); 
            }else{
                $('#city').html('<option value="">Select Option</option>');
                $('#barangay').html('<option value="">Select Option</option>');
            }
        });

        $('#city').on('change',function(){//change state to display all city
        var cityID = $(this).val();
            if(cityID){
                $.ajax({
                    type:'POST',
                    url:'../../server/addnewaddress_selectdataaddress.php',
                    data:'city_id='+cityID,
                    success:function(html){
                        $('#barangay').html(html);
                                            }
                        }); 
            }else{
                $('#barangay').html('<option value="">Select Option</option>'); 
            }
        });
    });
</script>
</head>
<body>

<!---PHP SESSION START-->
<?php  
if(isset($_SESSION['Username'])){
?>

	<!---MAIN CONTAINER START-->
		<div class="main-container">
			<div class="card">
				<form method="POST" enctype="multipart/form-data">
					<!--EDIT NAME SECTION START-->
					<section class="edit_name">
						<!--BACK SECTION START-->
						<p><a href="orderdetails_topay_addressselection.php?costumerproductorder=<?php echo $costumerproductorder ?>"><i class="fa fa-arrow-left edit" aria-hidden="true"></i></a>Add New Address</p>
						<!--BACK SECTION END-->
						<!--SUBMIT SECTION START-->
						<button type="submit" name="save">Save</button>
						<!--SUBMIT SECTION END-->
						<div class="form_name">
                            <select name="region" id="region" class="select_option" required>
                				<option value="">Select Region</option>
                			</select>

                            <select class="select_option" name="province" id="province"  autofocus="autofocus" required>
                                <option value="">Select Option</option>                            
                            </select>

                            <select class="select_option" name="city" id="city" autofocus="autofocus" required>
                                <option value="">Select Option</option>
                            </select>
                              
                            <select class="select_option" name="barangay" id="barangay" autofocus="autofocus" required>
                                <option value="">Select Option</option>
                            </select></br>

							<input type="number" name="postal_code" value="" class="postal_code" autocomplete="off" placeholder="Postal Code" required="">
							<input type="text" name="contact_number" class="contact_number" maxlength="11" placeholder="Contact Number" autocomplete="off" required="">
							<input type="text" name="email_address" value="" class="email_address" autocomplete="off" placeholder="Email Address" required=""><br/>
							<textarea class="detailed_address" placeholder="Detailed Address" name="detailed_address" required=""></textarea>
						</div>
					</section>
					<!--EDIT NAME SECTION END-->
				</form>
			</div>
		</div>
	<!---MAIN CONTAINER END-->
<?php
   $notification = (isset($_GET['notification']) ? $_GET['notification'] : '');
  #Add User Account
    #Success
    if($notification=='SuccesfullySubmit'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "success",
      text: "Address Succesfully Submit.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }elseif($notification=='ErrorSubmit'){
    echo '<script type="text/javascript">
    Swal.fire({
      position: "top-end",
      icon: "warning",
      text: "Error Address Submitted.",
      showConfirmButton: false,
      timer: 1500
    })
      </script>';
    }
?>

	<script type="text/javascript">
		
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
