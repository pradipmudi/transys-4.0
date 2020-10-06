<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta charset="utf-8">
<title>Invoice Results</title>
</head>

<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br>
<br>
<?php
require_once("dbcon/dbcon.php");
$term = $_POST['search_query'];

$query = mysqli_query( $dbhandle,"select * from invoice where  concat(invoiceNo,dateTime,serialNos) like '%$term%' order by invoiceNo asc");
$string = '';
$num=mysqli_num_rows($query);

$i=0;
if ($num>0){
while($row = mysqli_fetch_assoc($query)){
	$i++;
	if($i%2==0)
	  $color="white";
	  else
	  $color="#F2F2F2";
	$id=$i." .   ";
	$invoiceNo=$row['invoiceNo'];
	$customerId=$row['creditCustomerId'];
	if($customerId!="")
	{
		$sql1="select * from customer where id='$customerId'";
		$query1=mysqli_query($dbhandle,$sql1);
	}
	else
	{
		$sql1="select * from fullpaidcustomer where invoiceNo='".$row['invoiceNo']."'";
		$query1=mysqli_query($dbhandle,$sql1);
	}
	while($row1 = mysqli_fetch_array($query1))
	{
	$name=$row1['name'];
	$phone=$row1['phone'];
	$email=$row1['email'];
	$address=$row1['address'];
	$invoiceNo=$row1['invoiceNo'];
	$balanceDue=$row1['balance']." /-";
	}
if($balanceDue==" /-") $balanceDue="No dues.";
$string .= "<tr bgcolor=\"$color\">";
$string .= "<td align=\"left\">&nbsp;&nbsp;<font color=\"#000000\">".$id."</font></td>";
$string .="<td align=\"left\"><b><a href=\"oldInvoiceGenerate.php?customerId=".$customerId."&invoiceNo=".$row['invoiceNo']."\" style=\"text-decoration:none;\">".strtoupper($row['invoiceNo'])."</a></b> </td>";
$string .= "<td align=\"left\"><font color=\"#000000\">".strtoupper($name)."</font></td>";
$string .= "<td align=\"left\">&nbsp;&nbsp;<font color=\"#000000\">".$phone."</font></td>";
$string .= "<td align=\"left\"><font color=\"#000000\">".$email."</font></td>";
$string .= "<td align=\"left\"><font color=\"#000000\">".strtoupper($address)."</font></td>";
$string .= "<td align=\"right\"><font color=\"#000000\">".$balanceDue."</font></td>";
$string .= "\n</tr>";


}
}else{
	$string = "<tr bgcolor=\"#EAEAEA\"><td colspan=\"7\" align=\"center\"><b><font color=\"#FF0000\">No Records Found</font></b> </td>";
}
echo "<table bgcolor=\"#FFFFFF\" width=\"90%\" cellpadding=\"2\" cellspacing=\"2\" border=\"0\" align=\"center\">";
echo "<tr bgcolor=\"#616161\">";
echo "<td><font color=\"white\" width=\"3%\"><b>Sl. No.</b></font></td>";
echo "<td><font color=\"white\"><b>Invoice No</b></font></td>";
echo "<td><font color=\"white\"><b>Name</b></font></td>";
echo "<td><font color=\"white\"><b>Phone</b></font></td>";
echo "<td><font color=\"white\"><b>Email</b></font></td>";
echo "<td><font color=\"white\"><b>Address</b></font></td>";
echo "<td><font color=\"white\"><b>Current Due(₹)</b></font></td>";
echo "</tr>";
echo $string;

echo "</table>";
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
