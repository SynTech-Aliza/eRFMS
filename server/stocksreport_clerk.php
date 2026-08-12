<?php  
//export.php    
include "connection/db_conn.php";
$output = '';

$output = '';
if(isset($_POST["export"]))
{
 $query = "SELECT products.`Product_ID`, products.`Product_Name`, products.`Price`, products.`Stocks`, products.`Brand`, products.`Materials`, products.`Furniture_Type`, products.`Style`, products.`Color`, products.`Height`, products.`Width`, products.`Weight`, products.`Model`, products.`Pattern`, products.`Description`, products.`Cover_Photo`, products.`Image1`, products.`Image2`, products.`Image3`, products.`Image4`, products.`Image5`, products.`DelistOrListed`, products.`UnpublishedOrPublished`, productcategories.`Product_Category` FROM products INNER JOIN productcategories ON productcategories.ProductCategory_ID = products.ProductCategory_ID ORDER BY Product_ID ASC";
 $result = mysqli_query($connect, $query);
 if(mysqli_num_rows($result) > 0)
 {
  $output .= '
   <table border="0" width="1520">
      <tr>
         <td colspan ="22" style="text-align:center; font-size:50px;"><b>Stocks Report</b></td>
      </tr>
      <tr>
         <td></td>
      </tr>
      <tr>
         <td colspan ="22" style="text-align:center; font-size:30px;"><b>Rose Furniture</b></td>
      </tr>
      <tr>
         <td colspan ="22" style="text-align:center; font-size:20px;">Gov. Villavert, San Jose, Antique</td>
      </tr>
      <tr>
         <td colspan ="22" style="text-align:center; font-size:20px;">09123456789</td>
      </tr>
      <tr>
         <td></td>
         </tr>
   </table>

   <table border="0" width="1520">
      <tr>
         <td colspan="22">Report By:</td>
      </tr>
      <tr>
         <td colspan="22">Date: <b style="text-decoration: underline;">'.date("l jS \of F Y h:i:s A").'</b></td>
      </tr>
      <tr>
         <td></td>
      </tr>
   </table>
  <table class="table" border="1">  
    <tr>  
       <th style="width:100px;">No.</th>
       <th style="width:500px;">Product Name</th>
       <th style="width:500px;">Price</th>
       <th style="width:100px;">Stocks</th>
       <th style="width:100px;">Brand</th>
       <th style="width:100px;">Materials</th>
       <th style="width:100px;">Furniture Type</th>
       <th style="width:100px;">Style</th>
       <th style="width:100px;">Color</th>
       <th style="width:100px;">Height</th>
       <th style="width:100px;">Width</th>
       <th style="width:100px;">Weight</th>
       <th style="width:100px;">Model</th>
       <th style="width:100px;">Pattern</th>
       <th style="width:500px;">Description</th>
       <th style="width:300px;">Cover Photo</th>
       <th style="width:300px;">Image1</th>
       <th style="width:300px;">Image2</th>
       <th style="width:300px;">Image3</th>
       <th style="width:300px;">Image4</th>
       <th style="width:300px;">Image5</th>
       <th style="width:200px;">Category</th>
    </tr>
  ';
  while($row = mysqli_fetch_array($result))
  {
   $output .= '
    <tr>  
      <td style="text-align:left"></td>  
      <td style="text-align:left">'.$row["Product_Name"].'</td>   
      <td style="text-align:left">'.$row["Price"].'</td> 
      <td style="text-align:left">'.$row["Stocks"].'</td>
      <td style="text-align:left">'.$row["Brand"].'</td>
      <td style="text-align:left">'.$row["Materials"].'</td>
      <td style="text-align:left">'.$row["Furniture_Type"].'</td>
      <td style="text-align:left">'.$row["Style"].'</td>
      <td style="text-align:left">'.$row["Color"].'</td>
      <td style="text-align:left">'.$row["Height"].'</td>
      <td style="text-align:left">'.$row["Width"].'</td>
      <td style="text-align:left">'.$row["Weight"].'</td>
      <td style="text-align:left">'.$row["Model"].'</td>
      <td style="text-align:left">'.$row["Pattern"].'</td>
      <td style="text-align:left">'.$row["Description"].'</td>
      <td style="text-align:left">'.$row["Cover_Photo"].'</td>
      <td style="text-align:left">'.$row["Image1"].'</td>
      <td style="text-align:left">'.$row["Image2"].'</td>
      <td style="text-align:left">'.$row["Image3"].'</td>
      <td style="text-align:left">'.$row["Image4"].'</td>
      <td style="text-align:left">'.$row["Image5"].'</td>
      <td style="text-align:left">'.$row["Product_Category"].'</td>    
    </tr>
   ';
  }
  $output .= '
    <tr>
    </tr>
    <tr>
       <td colspan="2">Total</td>
       <td></td>
       <td></td>
       <td colspan="18"></td>
    </tr>  
  </table>';
  header('Content-Type: application/xls');
  header('Content-Disposition: attachment; filename=stocksreport.xls');
  echo $output;
 }
}
?>