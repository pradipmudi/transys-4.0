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
<title>Customer Details</title>
</head>

<body style="margin:0px;"><body>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<?php


$output=mysqli_query($dbhandle,"Select * From customer");

$no=mysqli_num_rows($output);

//$fetch=mysqli_fetch_array($output);


//echo "</table>";
echo "<div style=\"height:400px;overflow-y:auto\">";
echo "<table border='1'  align=\"center\"width=\"80%\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">";
if($no>0)
{
echo "<tr bgcolor=\"#CCCCCC\"><td align=\"center\" colspan=\"7\"><font size=\"+1\" face=\"Courier New, Courier, monospace\"><b>Purchase details are as follows : <font color=\"#0000FF\">(Total <font color=\"#FF0000\">$no</font> records found)</font></font></b></td></tr>";

//echo "<th align=\"center\">&nbsp;</th>"; 
echo "<tr bgcolor=\"#000000\">
<th width=\"7.01%\" align=\"center\"><font color=\"#FFFFFF\">ID</font></th>
<th width=\"15.67%\" align=\"center\"><font color=\"#FFFFFF\">Customer Name</font></th>
<th width=\"13%\" align=\"center\"><font color=\"#FFFFFF\">Email</font></th>
<th width=\"13%\" align=\"center\"><font color=\"#FFFFFF\">Phone</font></th>
<th width=\"15.67%\" align=\"center\"><font color=\"#FFFFFF\">Balance Due</font></th>
<th width=\"20%\" align=\"center\"><font color=\"#FFFFFF\">Address</font></th>
<th width=\"15.67%\" align=\"center\"><font color=\"#FFFFFF\">Photo</font></th>

</tr>";

$i=0;
while($op = mysqli_fetch_array($output))
  {
	  $i=$i+1;
  echo "<tr>";
  echo "<td width=\"7.01%\" align=\"center\" size=\"+1\"><b><font color=\"#0000FF\">$i</font></b></td>";
  echo "<td width=\"15.67%\" align=\"center\" size=\"+1\">" . $op['name'] . "</td>";
 
  echo "<td width=\"13%\" align=\"center\" size=\"+1\">" . $op['email'] . "</td>";
  echo "<td width=\"13%\" align=\"center\" size=\"+1\">" .$op['phone'] . "</td>";
  echo "<td width=\"15.67%\" align=\"center\" size=\"+1\">" . $op['balance'] . "</td>";
   echo "<td width=\"20%\" align=\"center\" size=\"+1\">" . $op['address'] . "</td>";
   
    echo "<td width=\"15.67%\" align=\"center\" size=\"+1\">";?>
    <img height="120" width="90" src="custProfilePic/<?php echo $op['photo'];?>"/>
<?php
echo "</td></tr>";
  }
  }
  if($no<1)
  {
echo "<tr><td colspan=\"7\" align=\"center\" size=\"+1\"><font color=\"red\"><b>No Records Found</b></font></td></tr>";
  
echo "</table>";
  echo "</div>";
  ?>
</body>
</html>
<?php
  }
  mysql_close($dbhandle);
}else{
	header('location:index.php');
}
 ?>