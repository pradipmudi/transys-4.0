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
<title>Purchase Records</title>
</head>
<body style="margin:0px;"><body>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<?php


$output=mysqli_query($dbhandle,"Select * From purchase order by entryDate desc");

$no=mysqli_num_rows($output);

//$fetch=mysqli_fetch_array($output);


echo "<table border='0'  align=\"center\"width=\"95%\" cellpadding=\"2\" cellspacing=\"2\" bgcolor=\"#FFFFFF\">
";
if($no>0)
{
echo "<tr bgcolor=\"#CCCCCC\"><td align=\"center\" colspan=\"10\"><font size=\"+1\" face=\"Courier New, Courier, monospace\"><b>Purchase details are as follows : <font color=\"#0000FF\">(Total <font color=\"#FF0000\">$no</font> records found)</font></font></b></td></tr>";

//echo "<th align=\"center\">&nbsp;</th>"; 
echo "<tr bgcolor=\"#000000\">
<th width=\"3%\" align=\"center\"><font color=\"#FFFFFF\">ID</font></th>
<th width=\"14%\" align=\"center\"><font color=\"#FFFFFF\">Product Name</font></th>
<th width=\"10%\" align=\"center\"><font color=\"#FFFFFF\">Date of Purchase</font></th>
<th width=\"10%\" align=\"center\"><font color=\"#FFFFFF\">Price of Product(₹)</font></th>
<th width=\"5.5%\" align=\"center\"><font color=\"#FFFFFF\">Quantity </font></th>
<th width=\"10%\" align=\"center\"><font color=\"#FFFFFF\">Total Amount(₹)</font></th>
<th width=\"13%\" align=\"center\"><font color=\"#FFFFFF\">Dealer Name</font></th>
<th width=\"14.5%\" align=\"center\"><font color=\"#FFFFFF\">Data Entered by </font></th>
<th width=\"10%\" align=\"center\"><font color=\"#FFFFFF\">Data Entered on </font></th>
<th width=\"10%\" align=\"center\"><font color=\"#FFFFFF\">Bill </font></th>
</tr>";
echo "</table>";
echo "<div style=\"height:400px;overflow-y:auto\">";
echo "<table border='0'  align=\"center\"width=\"95%\" cellpadding=\"2\" cellspacing=\"2\" bgcolor=\"#FFFFFF\">";
$i=0;
while($op = mysqli_fetch_array($output))
  {
	  $i=$i+1;
	  if($i%2==0)
	  $color="white";
	  else
	  $color="#F2F2F2";
  echo "<tr bgcolor=\"$color\">";
  echo "<td width=\"3%\" align=\"left\" size=\"+1\"><b><font color=\"#0000FF\">&nbsp;$i.</font></b></td>";
  echo "<td width=\"14%\" align=\"left\" size=\"+1\">" . strtoupper($op['name']) . "</td>";
 
  echo "<td width=\"10%\" align=\"center\" size=\"+1\">" . $op['purchaseDate'] . "</td>";
  echo "<td width=\"10%\" align=\"right\" size=\"+1\">" . number_format((float)$op['price'], 2, '.', '') . "</td>";
   echo "<td width=\"5.5%\" align=\"center\" size=\"+1\">" . $op['quantity'] . "</td>";
   number_format((float)$foo, 2, '.', '');
   $totalPrice=$op['price']*$op['quantity'];
    echo "<td width=\"10%\" align=\"right\" size=\"+1\">".number_format((float)$totalPrice, 2, '.', '')."&nbsp;&nbsp;</td>";
	echo "<td width=\"13%\" align=\"left\" size=\"+1\">" . $op['dealer'] . "</td>";
	
//----------------------------------------------------------------
	$out=mysqli_query($dbhandle,"Select name From admin where username='".$op['username']."'");

$no=mysqli_num_rows($out);

$fetch=mysqli_fetch_array($out);
//----------------------------------------------------------------
	echo "<td width=\"14.5%\" align=\"left\" size=\"+1\">" . $fetch['name'] . "</td>";
	echo "<td width=\"10%\" align=\"left\" size=\"+1\">" . $op['entryDate'] . "</td>";
	echo "<td width=\"10%\" align=\"center\">";?>
<a href="/tranSys2/viewBill.php?bill=<?php echo $op['id'];?>"
   onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=950,height=650'); return false;">
View Bill</a>
<?php
  echo "</td></tr>";
  }
  }
  if($no<1)
  {
echo "<tr><td colspan=\"10\" align=\"center\" size=\"+1\"><font color=\"red\"><b>No Records Found</b></font></td></tr>";
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