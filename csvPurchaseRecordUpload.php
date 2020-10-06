<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
?>

<?php 
function get_file_extension($file_name) {
return end(explode('.',$file_name));
}
if (isset($_POST['Submit'])){
// check feilds are not empty
if(get_file_extension($_FILES["csv"]["name"])!= 'csv')
{
header('location:bulkPurchaseUpload.php?invalid_file=1');
}
/* if (!$error){ */
else
{
 
		   error_reporting(0);
		   require_once("dbcon/dbcon.php");
			

            //if ($_FILES[csv][size] > 0) { 
$target_path = "purchaseCSVfile";
$target_path = $target_path . basename( $_FILES['csv']['name']);
if(move_uploaded_file($_FILES['csv']['tmp_name'], $target_path)) {
   // echo "The file ".  basename( $_FILES['uploadedfile']['name']). 
    //" has been uploaded";
	//header("location:registration.php");

//echo $target_path;
} else{
    echo "There was an error uploading the file, please try again!";
}
//die();
date_default_timezone_set("Asia/Kolkata");
$purchaseDate=date('Y-m-d');
$date=date('Y-m-d H:i:s');
$entryDate=$date;
            if (($getfile = fopen($target_path, "r")) !== FALSE) {
         $data = fgetcsv($getfile, 1000, ",");
		 $i=0;
    while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
        	$num = count($data);
            $result = $data;
        	$str = implode(",", $result);
        	$slice = explode(",", $str);
			
            //$col1 = $slice[0]; // Product Name
			if($i==0)
			{
				$productName=$slice[0];
				$col1=$productName;
			}
			else if($i!=0 && $slice[0]!="")
			{
				$productName=$slice[0];
				$col1=$productName;
			}
			
			
			if($i!=0 && $slice[0]!="")
			{
				$duration = 1;
				$currentEntryDate=date("Y-m-d H:i:s", strtotime("+$duration sec"));
				$col6 = date("Y-m-d H:i:s", strtotime("+$duration sec"));;				
				//echo "<br>currentEntryDate=".$currentEntryDate;				 	
			}
			
			
			echo "<br>currentEntryDate=".$currentEntryDate;		
			
			if($slice[1]=="")
			$col2 = "No Dealer";
			else
            $col2 = $slice[1]; // Dealer name
			
			if($i==0)
			{
				$price=$slice[2];
				$col3=$price;
			}
			else if($i!=0 && $slice[2]!="")
            $col3 = $slice[2]; // Price of each Product
			
			if($i==0)
			{
				$quantity=$slice[3];
				$col4=$quantity;
			}
			else if($i!=0 && $slice[3]!="")
			$col4 = $slice[3]; // Quantity of a product
			
			$col5 = $purchaseDate; // purchase date of a product
			
			$col7 = "noBill/noBill.png"; // Bill image name
			
			$col8 = $slice[7]; // username by whom the details have been imported
			if($i==0)
			{
				$catSubCat=$slice[8];
				$col9=$catSubCat;
			}
			else if($i!=0 && $slice[8]!="")
			$col9 = $slice[8]; // category and subcategory of the product
			$col10 = $slice[9]; // Serial No
			
			
			if($i==0)
			{
			$col11 = $slice[10]; // VAT of the product				
			}
			else if($i!=0 && $slice[10]!="")
			$col11 = $slice[10];
			// SQL Query to insert data into DataBase

			if($i==0)
			$col6 = $entryDate; // entry date and time of the purchase details
			
if($slice[0]!="")	 			
					$query0 = "INSERT INTO purchase(name,dealer,price,quantity,purchaseDate,entryDate,bill,username,categorySubCategory) VALUES('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$_SESSION['user']."','".$col9."')";
					
					 $query1 = "INSERT INTO stock (name,quantity,categorySubCategory)"."VALUES('".$col1."','".$col4."','".$col9."')";
					 $query2="select * from stock where name='".$col1."'";
		/*echo "<br><br>col10=".$col10."<br><br>";
		echo "<br><br>col11=".$col11."<br><br>";			 
		echo "<br>query0=".$query0."<br><br>";
		echo "<br>query1=".$query1."<br><br>";	
		echo "<br>query2=".$query2."<br><br>";*/
		$saveval0 = mysqli_query($dbhandle,$query0);
		$saveval2 = mysqli_query($dbhandle,$query2);
 $no=mysqli_num_rows($saveval0);
 if($no>0)
 {
	 $currentQuantity=0;
	 while($op = mysqli_fetch_array($saveval0))
  {
	  $currentQuantity=$op['quantity']+$col4; 
  }
	 $query3="UPDATE `stock` SET `quantity` = '$currentQuantity' WHERE `stock`.`name` = '".$col1."';";
	$saveval3 = mysqli_query($dbhandle,$query3);
	
	echo "<br>query3=".$query3."<br><br>";	
 }
 else
 {
	 $saveval1 = mysqli_query($dbhandle,$query1);
 }
 
echo "<br>query3=".$query3."<br><br>";				


//--------------------------------------	
 $query4 = "INSERT INTO serialno (id,productName,serialNo,soldStatus,price,dealer,entryDate,entryBy,categorySubCategory,vat)"."VALUES('','".$col1."','".$col10."','no','".$col3."','".$col2."','".$col6."','".$_SESSION['user']."','".$col9."','".$col11."')";
		//echo $query;
	 $query5 = "INSERT INTO sellingprice (id,productName,serialNo,status,price,categorySubCategory,vat)"."VALUES('','".$col1."','".$col10."','no','".$col3."','".$col9."','".$col11."')";	
		//execute query
		/*echo "<br>query4=".$query4."<br><br>";
		echo "<br>query5=".$query5."<br><br>";	*/
	$saveval4 = mysqli_query($dbhandle,$query4);
	$saveval5 = mysqli_query($dbhandle,$query5);
		
		
        
		$i=$i+1;
//		echo "<br>countNow=".$i;
       }
//echo "<br><br>total records=".$i;
	header('location:bulkPurchaseUpload.php?success=1');
	mysqli_close($dbhandle);
}

			}
}

?> 
            
<?php 
}else{
	header('location:index.php');
}
 ?>            