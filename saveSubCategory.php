<?php
ob_start();
session_start();
if(isset($_SESSION['user']))
  {

	error_reporting(0);
	require_once("dbcon/dbcon.php");
	$categoryTable=$_POST['categoryTable'];
	$subCategory=$_POST['subCategory'];
	$sql="select * from  ".$categoryTable." where subCategory='".$subCategory."' limit 1";
	$query=mysqli_query($dbhandle,$sql);
  	$num=mysqli_num_rows($query);
  	if($num>0)
	  {
		  header('location:addSubCategory.php?cid='.$categoryTable.'&error_code=1');
	  }
  	else
	  {
		  $sql1="INSERT INTO $categoryTable "."VALUES('','$subCategory')";;
		  $query1=mysqli_query($dbhandle,$sql1);
		  header('location:addSubCategory.php?cid='.$categoryTable.'&success=1');
	  }
  	mysql_close($dbhandle);
  
  
}

else{
	header('location:index.php');
}
 ?>