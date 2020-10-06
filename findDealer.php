<?php
error_reporting(0);
require_once("dbcon/dbcon.php");
$term = strip_tags(substr($_POST['searchit'],0, 100));
$term = mysqli_real_escape_string($dbhandle,$term); // Attack Prevention
if($term=="")
echo "<center> Enter Something to search</center>";
else{
$query = mysqli_query( $dbhandle,"select * from dealer where lower(concat(address,phone,name,account)) like '%{$term}%'");
$string = '';
$num=mysqli_num_rows($query);
$i=0;
if ($num>0){
while($row = mysqli_fetch_assoc($query)){
	$i++;
	if($i%2==0)
	  $color="#F2F2F2";
	  else
	  $color="white";
$string .= "<tr bgcolor=\"$color\"><td><b><a href=\"dealerDetails.php?id=".$row['id']."\" style=\"text-decoration:none;\">".$row['name']."</a></b> </td>";
$string .= "<td align=\"left\">&nbsp;&nbsp;".$row['phone']."</td>";
}
}else{
$string = "No matches found!";
}
echo "<table bgcolor=\"#CCCCCC\" width=\"100%\" cellpadding=\"2\" cellspacing=\"2\" border=\"0\">";
if($num>0)
{
echo "<tr bgcolor=\"#000000\"><td width=\"18.28%\"><font color=\"#FFFFFF\"><b>&nbsp;Name</b></font></td><td width=\"18.28%\"><font color=\"#FFFFFF\"><b>&nbsp;Phone</b></font></td></tr>
";
}
echo "<tr><td colspan=\"7\" align=\"center\">".$string."</td></td>";
}
echo "</table>";
?>
