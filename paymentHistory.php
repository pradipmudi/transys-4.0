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
<title>Payment History</title>
</head>

<body style="margin:0px;"><body>
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<?php
$id=$_GET['id'];
$dealerName=$_GET['dealer'];

$output=mysqli_query($dbhandle,"Select * From payment where username='$id' and dealerId='$dealerName' order by entryDate desc");
//echo "Select * From payment where username=$id and dealerName=$dealerName order by dateTime desc";
$no=mysqli_num_rows($output);

//$fetch=mysqli_fetch_array($output);
//echo "no=".$no;

echo "<table border='1'  align=\"center\"width=\"88%\" cellpadding=\"1\" cellspacing=\"1\" bgcolor=\"#FFFFFF\">
";
if($no>0)
{
echo "<tr bgcolor=\"#CCCCCC\"><td align=\"center\" colspan=\"5\"><font size=\"+1\" face=\"Courier New, Courier, monospace\"><b>Payment History details are as follows :</font></b></td></tr>";

//echo "<th align=\"center\">&nbsp;</th>"; 
echo "<tr bgcolor=\"#000000\">
<th width=\"20%\" align=\"center\"><font color=\"#FFFFFF\">Date and Time</font></th>
<th width=\"20%\" align=\"center\"><font color=\"#FFFFFF\">Dealer Name</font></th>
<th width=\"20%\" align=\"center\"><font color=\"#FFFFFF\">Balance Due to this dealer</font></th>
<th width=\"20%\" align=\"center\"><font color=\"#FFFFFF\">Data entered by</font></th>
<th width=\"20%\" align=\"center\"><font color=\"#FFFFFF\">Cash Receipt</font></th>
</tr>";
echo "</table>";

echo "<div style=\"height:300px;overflow-y:auto\">";
echo "<table border='1'  align=\"center\"width=\"88%\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">";

while($op = mysqli_fetch_array($output))
  {
  echo "<tr>";
  echo "<td width=\"20%\" align=\"center\" size=\"+1\">" . $op['entryDate'] . "</td>";
  echo "<td width=\"20%\" align=\"center\" size=\"+1\">" . $op['dealerName'] . "</td>";
  echo "<td width=\"20%\" align=\"center\" size=\"+1\">" . $op['billingAmount'] . "</td>";
  echo "<td width=\"20%\" align=\"center\" size=\"+1\">" . $op['username'] . "</td>";
  echo "<td width=\"20%\" align=\"center\" size=\"+1\">"; ?>
<a href="/tranSys2/viewReceipt.php?bill=<?php echo $op['id'];?>"
   onclick="window.open(this.href,'targetWindow','toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,width=950,height=650'); return false;">
View Cash Receipt</a>
<?php
  echo "</td></tr>";
  
  
//----------------------------------------------------------------
  }
}
  if($no<1)
  {
echo "<tr><td colspan=\"5\" align=\"center\" size=\"+1\"><font color=\"red\"><b>No Records Found</b></font></td></tr>";
  }
 
  echo "<tr><td width=\"100%\" align=\"center\" size=\"+1\" colspan=\"5\"><u><b><a href=\"dealerDetails.php?id=$dealerName\" style=\"text-decoration:none;\">Click here to go back</a></b></u></td></tr>";
echo "</table>";
  echo "</div>";



?>
</body>
</html>
<?php
  
  mysql_close($dbhandle);
}else{
	header('location:index.php');
}
 ?>