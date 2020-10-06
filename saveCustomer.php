<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']))
{

$name = $_POST['name'];
$address=$_POST['address'];
$phone=$_POST['phone'];
$email=$_POST['email'];
date_default_timezone_set("Asia/Kolkata");
$entryDate=date('Y-m-d H:i:s');
$billDate=date("UYmjHis");

$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	//$random_digit=rand(0000,9999);
	//$newfilename=$random_digit.$file_basename.$file_ext;
	$newfilename=$billDate.$file_ext;
$allowedExts = array("gif", "jpeg", "jpg", "png", "JPEG", "JPG");
$temp = explode(".", $newfilename);
$extension = end($temp);
/////////////////<!--############### image extensions ###############-->\\\\\\\\\\\\\\\\\\\\
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png")
|| ($_FILES["file"]["type"] == "image/JPEG")
|| ($_FILES["file"]["type"] == "image/JPG")
|| ($_FILES["file"]["type"] == "image/bmp"))
&& ($_FILES["file"]["size"] < 2000000)
&& in_array($extension, $allowedExts))
/////////////////<!--############### image extensions ###############-->\\\\\\\\\\\\\\\\\\\\
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
   
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "custProfilePic/" . $newfilename);
	  
	}
  }
else
  {
    
  	  $newfilename="dummy.jpg";
  }


$query1 = "INSERT INTO customer "."VALUES('','$name','$address','$phone','$newfilename','0','$email')";
		
		$saveval1 = mysqli_query($dbhandle,$query1);
		
$query2 = "select * from customer order by id desc limit 1";
		
		$saveval2 = mysqli_query($dbhandle,$query2);
$num=mysqli_num_rows($query2);
if($num>0)
{
	
}
else
{
	while($fetch=mysqli_fetch_array($saveval2))
	{
		$id=$fetch['id'];
	}
	$tableName="cust".$id;
	
	$saveval3 = mysqli_query( $dbhandle,"CREATE TABLE `".$db."`.`".$tableName."` ( `dateTime` datetime NOT NULL, `description` varchar(150) NOT NULL,  `debit` double NOT NULL,  `credit` double NOT NULL, PRIMARY KEY (`dateTime`))");
}

		mysqli_close($dbhandle);

//-------------------------------------------------------
     header('location:creditCustomer.php?success=1');
      
    }
   



//////////// <!-- ######################## image upload ######################## --> /////////////







//end if
?>

