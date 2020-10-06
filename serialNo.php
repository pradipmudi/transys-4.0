<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']))
{
	$name = $_POST['name'];
	$value1="";
	foreach($name as $v1)
	{
		$value1.=$v1."/";
	}
	
	$purchaseDate=$_POST['dob'];
	date_default_timezone_set("Asia/Kolkata");
	$entryDate=date('Y-m-d H:i:s');
	
	$categorySubCategory=$_POST['cat'];
	$value2="";
	foreach($categorySubCategory as $v2)
	{
		$value2.=$v2."^";
	}
	
	$dealer=$_POST['dealer'];
	
	$price=$_POST['price'];
	$value3="";
	foreach($price as $v3)
	{
		$value3.=$v3."/";
	}
	
	$quantity=$_POST['qty'];
	$value4="";
	foreach($quantity as $v4)
	{
		$value4.=$v4."/";
	}
	echo $productTypeQuantity;
	$vat=$_POST['vat'];
	$value5="";
	foreach($vat as $v5)
	{
		$value5.=$v5."/";
	}
	
	$productTypeQuantity=$_POST['productTypeQuantity'];
	$newfilename=$_POST['file'];
	$sql1=mysqli_query($dbhandle,"select balance from dealer where name='".$dealer."'");
while($op = mysqli_fetch_array($sql1))
  {
	  $prevBalance=$op['balance'];
  }
  $currentbalance=0;
  for($i=0;$i<$productTypeQuantity;$i++)
  $currentbalance+=$prevBalance+($price[$i]*$quantity[$i]);
  $sql2=mysqli_query($dbhandle," UPDATE `dealer` SET `balance` = '".$currentbalance."' WHERE `dealer`.`name` = '".$dealer."';");
  mysqli_close($dbhandle);
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Product Serial No</title>
</head>

<body style="margin:0px auto;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("top_header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<form name="serialNo" action="saveData.php" enctype="multipart/form-data" method="post">
<table width="80%" border="1" cellspacing="6" cellpadding="2" align="center">
<tr bgcolor="#666666">
  <td colspan="3" align="center"><b><font size="+3"> Purchased Products Information</font></b></td>  
</tr>
<tr>
  <td colspan="3" align="left"><br>
    <font size="3" color="" face="Rockwell"><b>Date of Purchase :</b> <?php echo $purchaseDate;?></font><br>
      <font size="3" color="" face="Rockwell"><b>Dealer name :</b> <?php echo $dealer;?><br>
        <br>
      </font></td> 
</tr>    
<tr bgcolor="#CCCCCC">
  <td colspan="1" align="center">
  Sl No.
  </td>
  <td colspan="1" align="center"><font size="+1" face="Courier New, Courier, monospace"><b>Product Details</b></font></td><td colspan="1" align="center"><font size="+1" face="Courier New, Courier, monospace"><b>Enter the serial no of the products</b></font>
  </td>
  </tr>
  <?php 
 		$val1=explode("/",$value1);	 
  		$val2=explode("^",$value2);
		$val3=explode("/",$value3);
		$val4=explode("/",$value4);
		$val5=explode("/",$value5);
  		for($i=0;$i<$productTypeQuantity;$i++)
  		{
			$name2=$val1[$i];
			$val=explode("//",$val2[$i]);
			$category=strtoupper($val[0]);
			$subCategory=strtoupper($val[1]);
			$price2=$val3[$i];
			$quantity2=$val4[$i];
			$vat2=$val5[$i];
			
  ?>
  <tr>
  <td valign="top"><b><font size="+2"><?php echo ($i+1).".";?></font></b></td>
    <td align="left" width="70%"><font size="3" color="" face="Rockwell"><b> Product Name :</b> <?php echo strtoupper($name2);?></font>
    <br>
    <font size="3" color="" face="Rockwell"><b> Category : </b> <?php echo $category;?></font>     <font size="3" color="" face="Rockwell"><b><br>
    Sub-category</b></font><font size="3" face="Rockwell"><b> :</b><?php echo $subCategory;?> </font><br>
	<font size="3" color="" face="Rockwell"><b> Price :</b> <?php echo $price2;?></font>
	<br>
	<font size="3" color="" face="Rockwell"><b> VAT on product(%) :</b> <?php echo $vat2;?></font>
	<br></td>
    <td width="30%">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <?php 
  for($j=0;$j<$quantity2;$j++){
  ?>
  <tr>
    <td align="center"><?php echo ($j+1).". ";?><input type="text" name="serialNoArray[]" autofocus required ></td>
  </tr>
  <?php }
  
  ?>
	</table>
</td>
  </tr>
 <?php }
  
  ?>
  <tr>
    <td colspan="3" align="center"><br>
      <input type="hidden" name="cat" value="<?php echo $value2;?>" readonly>
      <!--sending file name,i.e. bill name -->
      <input type="hidden" name="fileName" value="<?php echo $newfilename;?>"   >
      <!--sending file name,i.e. bill name -->
      <!--sending quantity value -->
      <input type="hidden" name="qty" value="<?php echo $value4;?>"   >
      <!--sending quantity value -->
      <!--sending vat value -->
      <input type="hidden" name="vat" value="<?php echo $value5;?>"   >  
      <input type="submit" name="save" value="Save Product Purchase details" style="height:40px" />
      <input type="hidden" name="name" value="<?php echo $value1;?>" readonly>
      <input type="hidden" name="dealer" value="<?php echo $dealer;?>" readonly>
      <input type="hidden" name="price" value="<?php echo $value3;?>" readonly>
      <input type="hidden" name="purchaseDate" value="<?php echo $purchaseDate;?>" readonly>
      <input type="hidden" name="productTypeQuantity" value="<?php echo $productTypeQuantity;?>" />
      <br>
      <br></td>
    </tr>
</table>
</form>
</body>
</html>
<?php 
	



}
else
{
	header('location:index.php');
}
 ?>
