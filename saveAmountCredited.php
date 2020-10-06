<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']))
{
	$transactionTableName="cust".$_GET['id'];
	$sql1="select * from customer where id='".$_GET['id']."'";
	$query1=mysqli_query($dbhandle,$sql1);
	while($op=mysqli_fetch_assoc($query1))
	{
		$previousBalanceDue=$op['balance'];
	}
	$description=$_POST['description'];
	$creditedAmount=abs($_POST['credit']);
	$currentBalanceDue=$previousBalanceDue-$creditedAmount;
	$nextInstallmentDate=$_POST['dob'];
	
	date_default_timezone_set("Asia/Kolkata");
	$todayDateTime=date('Y-m-d H:i:s');
	
	$sql2="update `customer` set balance='".$currentBalanceDue."',nextInstallmentDate='".$nextInstallmentDate."' where id='".$_GET['id']."'";
	$query2=mysqli_query($dbhandle,$sql2);
	$sql3="INSERT INTO $transactionTableName "."VALUES('','$todayDateTime','$description','0','$creditedAmount')";
	$query3=mysqli_query($dbhandle,$sql3);
	mysqli_close($dbhandle);
	header('location:showTransactionDetails.php?id='.$_GET['id'].'&success=1');
}
else
{
	header('location:index.php');
}
?>
