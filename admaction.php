<?php
ob_start();
session_start();
//echo "ghjkl;";
require_once("dbcon/dbcon.php");
//mysqli_escape_string(
$user_id= mysqli_real_escape_string($dbhandle,$_REQUEST['user_id']);
$Password= mysqli_real_escape_string($dbhandle,$_REQUEST['Password']);

//////////////////////admin login\\\\\\\\\\\\\\\\\\\\\\\
$sql=mysqli_query($dbhandle,"Select * From admin where username='$user_id' and password='$Password'");
//$run=mysql_query($sql);
$w=mysqli_num_rows($sql);
//echo "rows=".$w;
$fetch=mysqli_fetch_array($sql);
//////////////////////admin login\\\\\\\\\\\\\\\\\\\\\\\

//////////////////////student login\\\\\\\\\\\\\\\\\\\\\\\

//////////////////////student login\\\\\\\\\\\\\\\\\\\\\\\
   if($w==1)
   {
$_SESSION['user']=$fetch['username'];
$_SESSION['type']=$fetch['type'];
header('location: admHome.php');

  } 
 else
   {
	    
	   header("location:index.php?response=1");
   }

	?>

