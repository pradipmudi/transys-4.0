<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']))
{
$return_here=$_GET['return_here'];
$bankName=$_POST['bankName'];
$name = $_POST['name'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$account=$_POST['account'];
$balance=$_POST['balance'];
$query = "INSERT INTO dealer "."VALUES('','$bankName','$account','$name','$address','$phone','0')";
		
		$saveval1 = mysqli_query($dbhandle,$query);
		

		mysqli_close($dbhandle);

//-------------------------------------------------------
	if($return_here==1)
	{
		header('location:addDealer.php?return_here=2&success=1');
		echo $query;
	}
	else
     header('location:addDealer.php?success=1');
      
    }
  
else
  {
  	  header('location:purchase.php');
  }



//////////// <!-- ######################## image upload ######################## --> /////////////







//end if
?>