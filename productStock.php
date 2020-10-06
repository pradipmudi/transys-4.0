<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {
	  error_reporting(0);
	  require_once("dbcon/dbcon.php");
	  
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Stock of the Product</title>
</head>

<body style="margin:0px; background-color:  #edfad8 ;" >
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<?php 
	  $success=$_GET['success'];	
?>
<?php

$output=mysqli_query($dbhandle,"Select distinct(name),stock.categorySubCategory From stock,serialno where stock.name=serialno.productName and serialno.soldStatus='no' ");
$no=mysqli_num_rows($output);

//$fetch=mysqli_fetch_array($output);

$totalStockPrice=0;
echo "<table border='0'  align=\"center\"width=\"70%\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">
";
if($no>0)
{
echo "<tr bgcolor=\"#999999\"><td align=\"center\" colspan=\"8\"><font size=\"+1\" face=\"Courier New, Courier, monospace\"><b>Product Stock details are as follows : <font color=\"#0000FF\">(Total <font color=\"#FF0000\">$no</font> records found)</font></font></b>";
if($success==1)
	{
		echo "<br /><font color=\"#00FF00\">The details of purchase has been successfully saved!</font>";
	}
echo "</td></tr>";

//echo "<th align=\"center\">&nbsp;</th>"; 
echo "<tr bgcolor=\"#900C3F\">
<th width=\"6%\" align=\"center\"><font color=\"#c3f867 \">ID</font></th>
<th width=\"20%\" align=\"center\"><font color=\"#c3f867\">Product Name</font></th>
<th width=\"16%\" align=\"center\"><font color=\"#c3f867\">Category</font></th>
<th width=\"16%\" align=\"center\"><font color=\"#c3f867\">Sub-category</font></th>

<th width=\"14%\" align=\"center\"><font color=\"#c3f867\">Available(in total) </font></th>
<th width=\"14%\" align=\"center\"><font color=\"#c3f867\">Total Amount </font></th>
<th width=\"14%\" align=\"center\"><font color=\"#c3f867\">DELETE</font></th>
<th width=\"14%\" align=\"center\"><font color=\"#c3f867\">EDIT</font></th>
 

</tr>";
echo "</table>";
echo "<div style=\"height:400px;overflow-y:auto\">";
echo "<table border='0'  align=\"center\"width=\"70%\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">";
$i=0;
while($op = mysqli_fetch_array($output))
  {
	  
	  
	  $out=mysqli_query($dbhandle,"Select sum(price)'totalPrice',count(productName)'stock',productName From serialno  where productName='". $op['name']."' and soldStatus='no'");
	  //echo "sql="."Select sum(price)'totalPrice',count(productName)'stock',productName From serialno  where productName='". $op['name']."' and soldStatus='no'"."<br />";
	  $no=mysqli_num_rows($out);
	  $fetch=mysqli_fetch_array($out);
	  $i=$i+1;
	  if($i%2==0)
	  $color="white";
	  else
	  $color="#F2F2F2";

  echo "<form enctype=\"multipart/form-data\" name=\"f".$i."\" action=\"editAndUpdateProduct.php?productName=".$fetch['productName']."\" method=\"post\">";
  echo "<tr bgcolor=\"$color\">";
  echo "<td width=\"6%\" align=\"center\" size=\"+1\"><b><font color=\"#0000FF\">$i</font></b></td>";
  echo "<td width=\"20%\" align=\"left\" size=\"+1\">" . strtoupper($op['name']) . "</td>";
$val=explode("//",strtoupper($op['categorySubCategory'])); 
echo "<td width=\"16%\" align=\"left\" size=\"+1\">" . $val[0] . "</td>";
echo "<td width=\"16%\" align=\"left\" size=\"+1\">" . $val[1] . "</td>";
//$out=mysqli_query($dbhandle,"Select sum(price)'totalPrice',count(productName)'stock' From serialno  where productName='". $op['name']."' and soldStatus='no'");
//
//$no=mysqli_num_rows($out);

   echo "<td width=\"14%\" align=\"center\" size=\"+1\">" . $fetch['stock'] . "</td>";


	echo "<td width=\"14%\" align=\"right\" size=\"+1\">".number_format((float)$fetch['totalPrice'], 2, '.', '')."</td>";
$totalStockPrice+=$fetch['totalPrice'];

echo "<td width=\"14%\" align=\"center\" size=\"+1\"><input type=\"submit\" name=\"delete\" value=\"Delete\" style=\"width:80px;\"></td>";

  echo "<td width=\"14%\" align=\"center\" size=\"+1\"><input type=\"submit\" name=\"save\" value=\"Edit\" style=\"width:80px;\"></td>";
 echo "</tr>";
 echo "</form>";
//----------------------------------------------------------------
	

	
  }
  echo "<tr bgcolor=\"#c3f867\"><td colspan=\"7\" align=\"right\">Total Product Stock Price : </td><td colspan=\"1\" align=\"left\">&nbsp;<b><font color=\"#0000FF\"> ₹<font color=\"#FF0000\">&nbsp;$totalStockPrice&nbsp;</font>/-</font></b></td></tr>";	
  }
  if($no<1)
  {
echo "<tr><td colspan=\"8\" align=\"center\" size=\"+1\"><font color=\"red\"><b>No Records Found</b></font></td></tr>";
  }
echo "</table>";
  echo "</div>";
mysql_close($dbhandle);
?>
</body>
</html>

<?php 
}else{
	header('location:index.php');
}
 ?>