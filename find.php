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
if ($num>0){
while($row = mysqli_fetch_assoc($query)){
$string .= "<tr><td><b><a href=\"adm_student_details.php?id=".$row['std_id']."\" style=\"text-decoration:none;\">".$row['std_id']."</a></b> </td>";
$string .= "<td align=\"left\">&nbsp;&nbsp;".$row['name']."</td>";
$string .= "\n</tr>";
}

}else{
$string = "No matches found!";
}
echo "<table bgcolor=\"#CCCCCC\" width=\"100%\" cellpadding=\"0\" cellspacing=\"3\">";
if($num>0)
{
echo "<tr bgcolor=\"#000000\"><td width=\"18.28%\"><font color=\"#FFFFFF\"><b>&nbsp;Name</b></font></td></tr>
";
}
echo "<tr><td colspan=\"7\" align=\"center\"><select><option value='".$string."'>".$string."</option></select></td></td>";
}
echo "</table>";
?>
