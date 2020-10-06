<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
	  error_reporting(0);
	  require_once("dbcon/dbcon.php");
    $productName=$_GET['productName'];
    $deletion=$_GET['deletion'];
    if ($productName=="") {
      $productName=$_POST['productName'];
    }
	  if(isset($_POST['update']))
	  {
		  $vat=$_POST['vat'];
		  $price=$_POST['price'];
      $categorySubCategory=$_POST['cat'];
		  $sql2="UPDATE `serialno` SET `price` = '$price',`vat`='$vat',`categorySubCategory`='$categorySubCategory' WHERE productName='$productName' and soldStatus='no'";
		  $sql3="UPDATE `sellingprice` SET `price` = '$price',`vat`='$vat',`categorySubCategory`='$categorySubCategory' WHERE productName='$productName' and status='no'";
      $sql9="UPDATE `stock` SET `categorySubCategory`='$categorySubCategory' WHERE name='$productName'";
		 $query2=mysqli_query($dbhandle,$sql2);
		 $query3=mysqli_query($dbhandle,$sql3);
     $query9=mysqli_query($dbhandle,$sql9);
		 header('location:productStock.php?success=1');
	  }
    if(isset($_POST['deletion'])){
      $productName=$_POST['productName'];
      $serialNo=$_POST['serialNo'];
      $sql5="delete from serialno where productName='$productName' and serialNo='$serialNo' and soldStatus='no' limit 1";
      $query5=mysqli_query($dbhandle,$sql5);
      $sql6="delete from sellingprice where productName='$productName' and serialNo='$serialNo' and status='no' limit 1";
      $query6=mysqli_query($dbhandle,$sql6);
      $sql7="select * from stock where name='$productName'";
      $query7=mysqli_query($dbhandle,$sql7);
      while($op=mysqli_fetch_assoc($query7)){
        $quantity=$op['quantity']; 
      }
      
      $quantity=$quantity-1;
      $sql8="update stock set quantity='$quantity' where name='$productName'";
      $query8=mysqli_query($dbhandle,$sql8);
      header('location:editAndUpdateProduct.php?deletion=1&productName='.$productName.'');
    }

	  
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Update Product Details</title>
</head>

<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<?php 
    if(isset($_POST['save']))
    {
		//$productName=$_GET['productName'];
		$sql1="Select sum(price)'totalPrice',count(productName)'stock',productName,price,categorySubCategory,vat From serialno  where productName='". $productName."' and soldStatus='no'";
		 $query1=mysqli_query($dbhandle,$sql1);
		 $no=mysqli_num_rows($query1);
     //echo "No of rows returned : ".$no."<br />";  
		 $fetch=mysqli_fetch_array($query1);

		 $val2=explode("//",strtoupper($fetch['categorySubCategory'])); 
?>
      <?php

  $selectedTableName="cat_".strtolower($val2['0']);
  $selectedSubCategory=strtolower($val2['1']);

?>
<form action="editAndUpdateProduct.php" method="post" enctype="multipart/form-data">
<table width="40%" border="1" cellspacing="0" cellpadding="1" align="center">
  <tr bgcolor="#999999">
    <th colspan="2" scope="col">Product Information</th>
  </tr>
  <tr>
    <th scope="row" align="left" width="50%">&nbsp; Product Name </th>
    <td align="left" width="50%">&nbsp;<input type="text" name="price" value="<?php echo strtoupper($productName);?>">
      <input type="hidden" name="productName" value="<?php echo $productName;?>"></td>
  </tr>
  <tr>
    <th scope="row" align="left">&nbsp;Category  </th>
   <td align="left">
    <?php 

$query1 = mysqli_query( $dbhandle,"select table_name from information_schema.tables where table_schema = '$db' and TABLE_NAME like '%cat_%' order by table_name");
$num=mysqli_num_rows($query1);
//echo "no=".$num;

?>
   <select name="cat" required>

     <?php  if($num>0)
    {
  ?>
    
      <?php
while($row = mysqli_fetch_row($query1)){
  $val=explode("_",$row['0']);
  $tableName=$row['0'];

?>

      <option disabled>&nbsp;&nbsp;</option>
      <option label="<?php echo strtoupper($val[1]);?>" value="-1" disabled><?php echo strtoupper($val[1])?></option>
      <option disabled>-------------------------------------</option>
      <?php
$query2 = mysqli_query( $dbhandle,"select * from $tableName order by subCategory asc");
$number=mysqli_num_rows($query2);
//echo $number;
if($number>0)
{
while($fetch2=mysqli_fetch_array($query2))
{
  
?>
      <option value="<?php echo strtoupper($val[1])."//".$fetch2['subCategory'];?>" 

      <?php if(strtolower($fetch2['subCategory'])==$selectedSubCategory)
  {
    echo " selected";
    
  }
  else
  {
    echo "";
  } ?> 

  >
      <?php echo strtoupper($fetch2['subCategory']);?>        
      </option>
      <?php }//end of while
}//end of if
}//end of while
}//end of if
else
{
  
?>
      <option value="-1" disabled selected><?php echo 'No Category are added';}?></option>
      <?php //}?>
    </select>
    </td>
  </tr>
  
  <tr>
    <th scope="row" align="left">&nbsp;VAT (%)</th>
    <td align="left">&nbsp;<input type="text" name="vat" value="<?php echo $fetch['vat'];?>"></td>
  </tr>
  <tr>
    <th scope="row" align="left">&nbsp;Price(per unit) </th>
    <td align="left">&nbsp;<input type="text" name="price" value="<?php echo $fetch['price'];?>"></td>
  </tr>
  <tr>
    <th scope="row" align="left">&nbsp;Available </th>
    <td align="left">&nbsp;<?php echo $fetch['stock'];?></td>
  </tr>
  <tr>
    <th scope="row" align="right">Total Price : &nbsp;</th>
    <td align="left">&nbsp;<?php echo number_format((float)$fetch['totalPrice'], 2, '.', '');?></td>
  </tr>
  <tr>
    <th colspan="2" align="center" scope="row"><br>
<input type="submit" name="update" value="Update" ><br>
<br>
</th>
  </tr>
</table>
</form>

</body>
</html>

<?php
} 
if(isset($_POST['delete']) || $deletion==1)
    {

      $productName=$_GET['productName'];
?>
<!-- Write the code for the deletion of the required field -->


<table align="center" width="70%" cellspacing="4">
<tr bgcolor="#c3f867">
<td>ID</td>
<td>Product Name</td>
<td>Serial No</td>
<td>Price</td>
<td>Category</td>
<td>Sub-category</td>
<td>Dealer</td>
<td>Entry by</td>
<td>Delete</td>
</tr>

<?php
      $sql4="select * from serialno where productName='$productName' and soldStatus='no'";
      $query4=mysqli_query($dbhandle,$sql4);
      $num2=mysqli_num_rows($query4);
      $i=1;
      if($num2>0)
      {
      while ($fetch=mysqli_fetch_assoc($query4)) {
        
      
echo "<form enctype=\"multipart/form-data\" name=\"f".$i."\" action=\"editAndUpdateProduct.php\" method=\"post\">";
?>
<tr>
<td><?php echo $i;?></td>
<td><?php echo $fetch['productName'];?><input type="hidden"  name="productName" value="<?php echo $fetch['productName'];?>" ></td>
<td><?php echo $fetch['serialNo'];?><input type="hidden"  name="serialNo" value="<?php echo $fetch['serialNo'];?>" ></td>
<td><?php echo $fetch['price'];?></td>
<?php
  $val=explode("//",strtoupper($fetch['categorySubCategory'])); 
?>
<td><?php echo $val[0] ;?></td>
<td><?php echo $val[1] ;?></td>
<td><?php echo $fetch['dealer'];?></td>
<td><?php echo $fetch['entryBy'];?></td>
<td><input type="submit" name="deletion" value="X" style="font-weight:bolder;font-size:22px;color:red;height:30px;width:70px;"></td>
</tr>
<?php
echo "</form>";
    }
  }
  else
  {
?>
<tr>
<td colspan="9" align="center">
<font color="red">
No records found.
</font>  

</td>
</tr>
<?php
  }

?>
</table>

<!-- Write the code for the deletion of the required field -->
<?php
    }

}else{
	header('location:index.php');
}
 ?>