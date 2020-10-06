<?php
error_reporting(0);
require_once("dbcon/dbcon.php");
$term = strip_tags(substr($_POST['searchit'],0, 100));
$term = mysqli_real_escape_string($dbhandle,$term); // Attack Prevention
$existing=$_GET['existing'];
if($term=="")
echo "<center> Enter Something to search</center>";
else{
$query = mysqli_query( $dbhandle,"select * from customer where  lower(concat(name,address,phone,email)) like '%$term%' order by name asc");
$string = '';
$num=mysqli_num_rows($query);
//echo "num=".$num;
$i=0;
if ($num>0){
while($row = mysqli_fetch_assoc($query)){
	$i++;
	if($i%2==0)
	  $color="white";
	  else
	  $color="#F2F2F2";
	$id=$i." .   ";
	$val=$row['name'];	
	if($existing==1) $existing=1;
	else $existing=0;
	if($existing==1)  $url="addCreditCustomer"; //for existing credit customers new purchase
	else  $url="showTransactionDetails";
$string .= "<tr bgcolor=\"$color\">";
$string .= "<td align=\"left\">&nbsp;&nbsp;<font color=\"#000000\">".$id."</font></td>";
$string .="<td align=\"left\"><b><a href=\"$url.php?id=".$row['id']."&existing=$existing\" style=\"text-decoration:none;\">".$val."</a></b> </td>";
$string .= "<td align=\"left\">&nbsp;&nbsp;<font color=\"#000000\">".$row['phone']."</font></td>";
$string .= "<td align=\"center\"><font color=\"#000000\">".$row['email']."</font></td>";
$string .= "<td align=\"left\"><font color=\"#000000\">".$row['address']."</font></td>";
$string .= "<td align=\"right\"><font color=\"#000000\">".$row['balance']."</font></td>";
$string .= "\n</tr>";


}
}else{
	$string = "<tr><td colspan=\"5\"><b><font color=\"#FF0000\">No Customer record found on this <font color=\"blue\">'".$term."'</font> query.</font></b> </td>";
}
echo "<table bgcolor=\"#FFFFFF\" width=\"100%\" cellpadding=\"2\" cellspacing=\"2\" border=\"0\">";
echo "<tr bgcolor=\"#616161\">";
echo "<td><font color=\"white\"><b>Sl. No.</b></font></td>";
echo "<td><font color=\"white\"><b>Name</b></font></td>";
echo "<td><font color=\"white\"><b>Phone</b></font></td>";
echo "<td><font color=\"white\"><b>Email</b></font></td>";
echo "<td><font color=\"white\"><b>Address</b></font></td>";
echo "<td><font color=\"white\"><b>Current Due</b></font></td>";
echo "</tr>";
echo "<tr><td colspan=\"5\" align=\"center\">".$string."</td></tr>";
}
echo "</table>";
?>
