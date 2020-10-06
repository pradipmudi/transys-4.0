<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']) && isset($_SESSION['user']))
{

$id=$_GET['id'];
$dealerName=$_POST['dealerName'];
$billingAmount = $_POST['billingAmount'];
$pastBalanceDue= $_POST['balanceDue'];
$currentBalanceDue=$pastBalanceDue-$billingAmount;

	
///////// <!-- ######################## image upload ######################## --> ////////////
	$filename = $_FILES["file"]["name"];
	date_default_timezone_set("Asia/Kolkata");
$dateTime=date('Y-m-d H:i:s');
$dateTimeFile=date("UYmjHis");
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	//$random_digit=rand(0000,9999);
	//$newfilename=$random_digit.$file_basename.$file_ext;
	$newfilename=$dateTimeFile.$file_ext;
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
|| ($_FILES["file"]["type"] == "image/JPG"))
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
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
    //echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br>";
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "receipt/" . $newfilename);
      //echo "Stored in: " . "receipt/" . $newfilename. "<br>";
//-------------------------------------------------------	  
	 
      
    }
  }
else
{
	$newfilename='noReceipt/noReceipt.png';
}
 $query = "INSERT INTO payment "."VALUES('','$dateTime','$dealerName','$billingAmount','$newfilename','".$_SESSION['user']."','$id')";
 $sql="UPDATE `dealer` SET `balance` = '$currentBalanceDue' WHERE `dealer`.`id` = '$id';";
		echo $query;
		
		//execute query
		
		$saveval1 = mysqli_query($dbhandle,$query);
		$saveval2 = mysqli_query($dbhandle,$sql);
		

		mysqli_close($dbhandle);

//-------------------------------------------------------
     header('location:dealerDetails.php?success=1&id='.$id.'');


//////////// <!-- ######################## image upload ######################## --> /////////////







}//end if
?>