<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  require_once("dbcon/dbcon.php");
	  
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Next Installment of Customers</title>
</head>

<body style="margin:0px;"><body>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>

<?php


$output=mysqli_query($dbhandle,"Select * From customer order by nextInstallmentDate desc");

$no=mysqli_num_rows($output);

//$fetch=mysqli_fetch_array($output);


echo "<table border='0'  align=\"center\"width=\"95%\" cellpadding=\"2\" cellspacing=\"2\" bgcolor=\"#FFFFFF\">
";
if($no>0)
{
echo "<tr bgcolor=\"#CCCCCC\"><td align=\"center\" colspan=\"10\"><font size=\"+1\" face=\"Courier New, Courier, monospace\"><b>Next Installment Date of customers are as follows : <font color=\"#0000FF\">(Total <font color=\"#FF0000\">$no</font> records found)</font></font></b></td></tr>";

//echo "<th align=\"center\">&nbsp;</th>"; 
echo "<tr bgcolor=\"#000000\">
<th width=\"3%\" align=\"center\"><font color=\"#FFFFFF\">ID</font></th>
<th width=\"16.17%\" align=\"center\"><font color=\"#FFFFFF\">Customer Name</font></th>
<th width=\"16.17%\" align=\"center\"><font color=\"#FFFFFF\">Address</font></th>
<th width=\"12%\" align=\"center\"><font color=\"#FFFFFF\">Phone</font></th>
<th width=\"12%\" align=\"center\"><font color=\"#FFFFFF\">Email </font></th>
<th width=\"12%\" align=\"center\"><font color=\"#FFFFFF\">Balance Due(&#x20b9;)</font></th>
<th width=\"12%\" align=\"center\"><font color=\"#FFFFFF\">Next Installment</font></th>
<th width=\"16.68%\" align=\"center\"><font color=\"#FFFFFF\">Last Call on</font></th>
</tr>";
echo "</table>";
echo "<div style=\"height:400px;overflow-y:auto\">";
echo "<table border='0'  align=\"center\"width=\"95%\" cellpadding=\"2\" cellspacing=\"2\" bgcolor=\"#FFFFFF\">";
$i=0;
while($op = mysqli_fetch_assoc($output))
  {
	  $i=$i+1;
	  if($i%2==0)
	  $color="white";
	  else
	  $color="#F2F2F2";
	  if($op['email']=="") 
	  	$email="Not available!";
	  else 
		$email=$op['email'];
	  $sql1="select * from callcustomer where customerId='".$op['id']."' order by callTime desc limit 1";
	  $query1=mysqli_query($dbhandle,$sql1);
	  $totalCall=mysqli_num_rows($query1);
	  if($totalCall>0)
	  {
	  while($fetch=mysqli_fetch_assoc($query1))
	  {
		 $lastCall=$fetch['callTime'];
	  }
	  }
	  else
	  {
		 $lastCall="No calls have been made yet!";		 
	  }
  echo "<tr bgcolor=\"$color\">";
  echo "<td width=\"3%\" align=\"left\" size=\"+1\"><b><font color=\"#0000FF\">&nbsp;$i.</font></b></td>";
  echo "<td width=\"16.17%\" align=\"left\" size=\"+1\"><a href=\"showTransactionDetails.php?id=". $op['id'] ."\">" . $op['name'] . "</a></td>";
 
  echo "<td width=\"16.17%\" align=\"left\" size=\"+1\">" . $op['address'] . "</td>";
  echo "<td width=\"12%\" align=\"right\" size=\"+1\">" . $op['phone']. "</td>";
   echo "<td width=\"12%\" align=\"right\" size=\"+1\">" . $email . "</td>";
    echo "<td width=\"12%\" align=\"right\" size=\"+1\">".number_format((float)$op['balance'], 2, '.', '')."&nbsp;&nbsp;</td>";
	echo "<td width=\"12%\" align=\"center\" size=\"+1\">" . $op['nextInstallmentDate'] . "</td>";
	echo "<td width=\"16.68%\" align=\"center\" size=\"+1\">" . $lastCall . "</td>";
	
  echo "</tr>";
  }
  }
  if($no<1)
  {
echo "<tr><td colspan=\"7\" align=\"center\" size=\"+1\"><font color=\"red\"><b>No Records Found</b></font></td></tr>";
  }
echo "</table>";
  echo "</div>";
	
mysql_close($dbhandle);

   
?>


</body>
</html>

<?php
}//end if
else
{
	header('location:index.php');
}
?>