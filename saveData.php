<?php
ob_start();
session_start();
error_reporting(0);
require_once("dbcon/dbcon.php");
if(isset($_POST['save']))
{

$name = $_POST['name'];
$purchaseDate=$_POST['purchaseDate'];
date_default_timezone_set("Asia/Kolkata");
$entryDate=date('Y-m-d H:i:s');

$serialNoArray=$_POST['serialNoArray'];
$serialNos="";
foreach($serialNoArray as $value)
	{
		$serialNos.=$value."/";
	}
echo $serialNos."<br><br>";	
$categorySubCategory=$_POST['cat'];
$dealer=$_POST['dealer'];
$price=$_POST['price'];
$newfilename=$_POST['fileName'];
$quantity=$_POST['qty'];
$productTypeQuantity=$_POST['productTypeQuantity'];
$vat=$_POST['vat'];
?>
  <?php 
 		$val1=explode("/",$name);	 
  		$val2=explode("^",$categorySubCategory);
		$val3=explode("/",$price);
		$val4=explode("/",$quantity);
		$val5=explode("/",$vat);
		$val6=explode("/",$serialNos);
		$k=0;
		$sp=0; // sp = position of the serail no array
  		for($i=0;$i<$productTypeQuantity;$i++)
  		{
			$name2=$val1[$i];
			if($i==0)
			{
				$productName=$name2;
				$entryDate=date('Y-m-d H:i:s');
			}
			if($i!=0 && $name2!=$productName)
			{
				$duration = 1;
				$currentEntryDate=date("Y-m-d H:i:s", strtotime("+$duration sec"));
				$entryDate = date("Y-m-d H:i:s", strtotime("+$duration sec"));;				
				//echo "<br>currentEntryDate=".$currentEntryDate;				 	
			}
			
			$categorySubCategory2=$val2[$i];
			//$val=explode("//",$val2[$i]);
			//$category=strtoupper($val[0]);
			//$subCategory=strtoupper($val[1]);
			$price2=$val3[$i];
			$quantity2=$val4[$i];
			$vat2=$val5[$i];
			//$serialNos2=$val6[$i];
			if($i!=0)			
				$prevQuantity=$val4[$i-1];			
			else
			    $prevQuantity=0;
			  
			
  ?>
<?php
 $query0="select * from stock where name='$name2'";
 
 $query1 = "INSERT INTO purchase "."VALUES('','$name2','$dealer','$price2','$quantity2','$purchaseDate','$entryDate','$newfilename','".$_SESSION['user']."','$categorySubCategory2')";

 echo "query0=".$query0."<br><br>";
  echo "query1=".$query1."<br><br>";
 $query2 = "INSERT INTO stock "."VALUES('$name2','$quantity2','$categorySubCategory2')";	
		$saveval0 = mysqli_query($dbhandle,$query0);
		$saveval1 = mysqli_query($dbhandle,$query1);
  echo "query2=".$query2."<br><br>";
 $no=mysqli_num_rows($saveval0);
 if($no>0)
 {
	 $currentQuantity=0;
	 while($op = mysqli_fetch_array($saveval0))
  {
	  $currentQuantity=$op['quantity']+$quantity2; 
  }
	 $query5="UPDATE `stock` SET `quantity` = '$currentQuantity' WHERE `stock`.`name` = '$name2';";
	 $saveval5 = mysqli_query($dbhandle,$query5);
 }
 else
 {
	 $saveval2 = mysqli_query($dbhandle,$query2);
 }
 
?>
<?php 
  for($j=$prevQuantity;$j<$quantity2+$prevQuantity;$j++){

?>
<?php
$serialNos2=$val6[$sp];
$value=$serialNos2;
//foreach($serialNoArray as $value)
//{
//--------------------------------------	  
	  $query3 = "INSERT INTO serialno (`id`,`productName`,`serialNo`,`soldStatus`,`price`,`dealer`,`entryDate`,`entryBy`,`categorySubCategory`,`vat`) "."VALUES('','$name2','$value','no','$price2','$dealer2','$entryDate','".$_SESSION['user']."','$categorySubCategory2','$vat2')";

	 $query4 = "INSERT INTO sellingprice (`id`,`productName`,`serialNo`,`status`,`price`,`categorySubCategory`,`vat`) "."VALUES('','$name2','$value','no','$price2','$categorySubCategory2','$vat2')";	
		//execute query
	 //echo "query3=".$query3."<br><br>";
	 //echo "query4=".$query4."<br><br>";	
	$saveval3 = mysqli_query($dbhandle,$query3);
	$saveval4 = mysqli_query($dbhandle,$query4);
	$sp++;
		
//}
?>
<?php }
  
?>
<?php }
  
  ?>
<?php		
mysqli_close($dbhandle);

//-------------------------------------------------------
    header('location:purchasedProductInfo.php?success=1');
      



//////////// <!-- ######################## image upload ######################## --> /////////////







}//end if
else
{
	header('location:index.php');
}
?>


