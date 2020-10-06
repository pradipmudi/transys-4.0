
<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {

error_reporting(0);
require_once("dbcon/dbcon.php");

?>
<?php

$tableName='';
if(isset($_GET['id']))
{
	$tableName=$_GET['id'];
}
else if(isset($_GET['cid']))
{
	$tableName=$_GET['cid'];
}

$query = mysqli_query( $dbhandle,"select table_name from information_schema.tables where table_schema = '$db' and TABLE_NAME like '%$tableName%' ");

$num=mysqli_num_rows($query);
if($num>0)
{
	
}
else
{
	
	$query2 = mysqli_query( $dbhandle,"CREATE TABLE `".$db."`.`".$tableName."` ( `id` BIGINT(20) NOT NULL AUTO_INCREMENT , `subCategory` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`))");
}
$val=explode("_",$tableName);
	
	// category name
$categoryName=strtoupper($val[1]);

?>
<?php
// Ajax calls this NAME CHECK code to execute
//echo "table=".$tableName;
if(isset($_POST["std_id_check"]))
	{

//mysql_select_db('mcadept');
$subCategory = preg_replace('#[^a-z0-9]#i', ' ', $_POST['std_id_check']);
$subCategory=strtoupper($subCategory);
$sql3 = "SELECT * FROM ".$tableName." WHERE upper(subCategory)='$subCategory' LIMIT 1";
//echo $sql3;
 $query3 = mysqli_query($dbhandle,$sql3); 
    $sid_check = mysqli_num_rows($query3);

	if ($sid_check > 0)
	{
   echo '<strong style="color:#F00;"><font color=\"#009900\">' . $subCategory . '</font> is already saved.</strong>';
   exit();
    }
    else 
	{
   echo '<strong style="color:#009900;"><font color="#F00">' . $subCategory .'</font> is not added.</strong>';
   exit();
    } 
}
//---------------------------------------

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Add Category</title>
</head>
<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
function checkusername()
{
var s = _("subcat").value;
if(s != "")
	{
_("std_id_status").innerHTML = 'checking ...';
var ajax = ajaxObj("POST", "addSubCategory.php?id=<?php echo $tableName;?>");
        ajax.onreadystatechange = function() 
			{
       if(ajaxReturn(ajax) == true)
				{
           _("std_id_status").innerHTML = ajax.responseText;
				}
			}
        ajax.send("std_id_check="+s);
	}
}
</script>



<body style="margin:0px;">
<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<form name="cat" enctype="multipart/form-data" method="post" action="saveSubCategory.php" onsubmit="return(validate());">
<table border="0" align="center" width="40%">
  <tr>
     <td align="center" colspan="2"><h3><b><font color="#0000FF">Add Sub-Category</font></b></h3></td>
  </tr>
  <tr>
     <td align="center" colspan="2"><font color="#FF0000">
<?php 
$success=$_GET['success'];
$error=$_GET['error_code'];
if($error==1)
	{
	echo "The sub-category data already exists, please give another sub-category!";
	}
?>
</font>
<font color="#00FF00">
<?php if($success==1)
{
	echo "The sub-category data successfully added!";
}
?></font>
&nbsp;</td>
  </tr>
  <tr>
   <td align="left" colspan="1"><font size="3" color="black" face="Rockwell"><b>Category :</b></font></td>
    <td align="left" colspan="1"> <input type="text" value="<?php echo $categoryName;?>"  readonly><input type="hidden" value="<?php echo $tableName;?>" name="categoryTable" ></td>
  </tr>
  <tr>
     <td align="center" colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td align="left" colspan="1"><font size="3" color="black" face="Rockwell"><b>Subcategory :</b></font></td>
    <td align="left" colspan="1"><input type="text" name="subCategory" id="subcat" placeholder="Enter the subcategory" onkeyup="restrict('subcat')" onblur="checkusername()" required></td>
  </tr>
  <tr>
     <td align="center" colspan="2"><span id="std_id_status"></span>&nbsp;</td>
  </tr>
   <tr>
     <td align="center" colspan="2"><input type="submit" name="save" id="save"/></td>
   </tr>
</table>


</body>
</html>

<?php 
}else{
	header('location:index.php');
}
 ?> 