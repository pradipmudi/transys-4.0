<?php
error_reporting(0);
require_once("dbcon/dbcon.php");
$term = strip_tags(substr($_POST['searchit'],0, 100));
$term = mysqli_real_escape_string($dbhandle,$term); // Attack Prevention

if($term=="")
echo "<center> Enter Something to search</center>";
else{
$term="cat_".$term;
$query = mysqli_query( $dbhandle,"select table_name from information_schema.tables where table_schema = '$db' and TABLE_NAME like '%$term%' order by table_name");
$string = '';
$num=mysqli_num_rows($query);
$i=0;
if ($num>0){
while($row = mysqli_fetch_row($query)){
	$i++;
	$id=$i." .   ";
	$val=explode("_",$row['0']);
	//$row['0']=str_repeat('&nbsp;', 80).$id.strtoupper($row['0']);
	$val[1]=str_repeat('&nbsp;', 80).$id.strtoupper($val[1]);
$string .= "<tr><td><b><a href=\"addSubCategory.php?id=".$row['0']."\" style=\"text-decoration:none;\">".$val[1]."</a></b> </td>";

}
}else{
	$val=explode("_",$term);
	//$row['0']=str_repeat('&nbsp;', 80).$id.strtoupper($row['0']);
	$val[1]=str_repeat('&nbsp;', 40).strtoupper($val[1]);
$string = "<tr><td><b><a href=\"addSubCategory.php?id=".$term."\" style=\"text-decoration:none;\"><font color=\"#FF0000\">No category found of this name(Click on this link to create this category). </font>".$val[1]." </a></b> </td>";
}
echo "<table bgcolor=\"#CCCCCC\" width=\"100%\" cellpadding=\"0\" cellspacing=\"3\">";
echo "<tr><td colspan=\"7\" align=\"center\">".$string."</td></tr>";
}
echo "</table>";
?>
