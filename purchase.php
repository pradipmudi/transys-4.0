<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']) && isset($_POST['save']))
  {
	  require_once("dbcon/dbcon.php");
	  $dealer=$_POST['dealer'];
	  $quantity=$_POST['quantity'];
	  $purchaseDate=$_POST['dob'];
	  $billDate=$_POST['billDate'];
	  
	  
	  
	  
	  ///////// <!-- ------------------------------------------------ image upload ------------------------------------------------ --> ////////////
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
/////////////////<!-------------------------------- image extensions -------------------------------->\\\\\\\\\\\\\\\\\\\\
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
/////////////////<!-------------------------------- image extensions -------------------------------->\\\\\\\\\\\\\\\\\\\\
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
    }
  else
    {
   
      move_uploaded_file($_FILES["file"]["tmp_name"],
      "uploads/" . $newfilename);
     }
  }
  else
{
	$newfilename='noBill/noBill.png';
}
?>





<!doctype html>
<html>
<head>
<meta charset="utf-8">

<!--\\\\\\\\\\\\\\\\\\\\\\\############ check no or not ##############/////////////////////////////-->

<script language="javascript">
      <!--
      function isNumberKey(evt)
      {
          var charCode = (evt.which) ? evt.which : evt.keyCode;
          if (charCode != 46 && charCode > 31 
            && (charCode < 48 || charCode > 57))
             return false;

          return true;
      }
      //-->
	  function isNumberKey2(evt)
      {
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
	  
	  

      </script>
      
<!--\\\\\\\\\\\\\\\\\\\\\\\############ check no or not ##############/////////////////////////////-->



<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->

  <script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<!-- ############## image preview ############### -->


<script src="js/jquery.min.js"></script>
<script>
function readURL(input) {
if (input.files && input.files[0]) {
var reader = new FileReader();

reader.onload = function (e) {
$('#img_prev')
.attr('src', e.target.result)
.width(75)
.height(75);
};

reader.readAsDataURL(input.files[0]);
}
}
</script>

<!-- ############## image preview ############### -->
<title>Purchase Details</title>
</head>

<script type="text/javascript">
function validate()
{



	var dob1=document.pur.dob.value	;   
   if( document.pur.dob.value == "" )
   {
     alert( "Please provide purchase Date !!" );
     document.pur.dob.focus() ;
     return false;

   }else
   {
  // alert(dob1);
   var res = dob1.split("-"); 
  //  alert(res[0]);
	 if(res[1]=="Jan")
     {
	  month = 01;
	  }
	  else if( res[1]=="Feb")
	     {
		  month =02;
		 }
		 else if( res[1]=="Mar")
	     {
		  month = 03;
		 }
		 else if( res[1]=="Apr")
	     {
		  month = 04;
		 }
		 else if( res[1]=="May")
	     {
		  month = 05;
		 }
		 else if( res[1]=="Jun")
	     {
		  month = 06;
		 }
		 else if( res[1]=="Jul")
	     {
		  month = 07;
		 }
		 else if( res[1]=="Aug")
	     {
		  month = 08;
		 }
		 else if( res[1]=="Sep")
	     {
		  month = 09;
		 }
		 else if( res[1]=="Oct")
	     {
		  month = 10;
		 }
		 else if( res[1]=="Nov")
	     {
		  month = 11;
		 }
		 else if( res[1]=="Dec")
	     {
		  month = 12;
		 }
		var actualday =  res[2]+"-"+month+"-"+res[0];

	document.pur.dob.value=actualday;

    }
}
</script>



<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  Textbox based Search scripts and css ////////////////////////////////////////// -->

<meta http-equiv="Content-Language" content="en-us">
    <link href="search/bootstrap.min.css" rel="stylesheet">
    <script src="search/jquery-2.1.4.min.js"></script>
    <script src="search/bootstrap.min.js"></script>
    <script src="search/typeahead.js"></script>
    <style>      

        .tt-hint,
        .productName {
            border: 2px solid #CCCCCC;
            //border-radius: 8px 8px 8px 8px;
            font-size: 16px;
            height: 25px;
            line-height: 30px;
            outline: medium none;
            padding: 8px 12px;
            width: 200px;
        }

        .tt-dropdown-menu {
            width: 200px;
            margin-top: 5px;
            padding: 8px 12px;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            //border-radius: 8px 8px 8px 8px;
            font-size: 14px;
            color: #111;
            background-color: #F1F1F1;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('input.productName').typeahead({
                name: 'name',
                remote: 'search.php?query=%QUERY'

            });

        })
    </script>

<!-- \\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\  Textbox based Search scripts and css ////////////////////////////////////////// -->



<?php require_once('backButton.php');?>
<body style="margin:0px;">






<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here/////////////////////////////////////////-->

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td width="100%">
 <?php include("header.php"); ?></td></tr>
</table>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\add header here////////////////////////////////////////--><br/><br/>
<?php 
error_reporting(0);
$invalid_file=$_GET['invalid_file'];
$success=$_GET['success'];
if($dealer=="") $dealer="No Dealer";

?>

<form name="pur" enctype="multipart/form-data" method="post" action="serialNo.php" onsubmit="return(validate());"> 

<table width="80%" border="0" cellspacing="2" cellpadding="2" align="center">
  <tr bgcolor="#000000">
    <th colspan="6" scope="col"><font color="#FFFFFF"><h3>Product Details</h3></font>
    </th>
  </tr>
  <tr>
    <td colspan="6">
    Date of Purchase :<b> <?php echo $purchaseDate;?></b><br>
	Dealer Name : <b><?php  echo $dealer;?></b>
	<br>
	<br>
    <input name="file" type='hidden' value="<?php echo $newfilename;?>" />
    <input type="hidden" name="dob" value="<?php echo $purchaseDate;?>"   />
    <input type="hidden" name="dealer" value="<?php echo $dealer;?>" />
    <input type="hidden" name="productTypeQuantity" value="<?php echo $quantity;?>" />
    </td>
  </tr>
  <tr bgcolor="#999999">
    <th scope="col" width="3%">Sl. No.</th>
    <th scope="col">Product Name</th>
    <th scope="col">Category</th>
    <th scope="col">Price(₹)</th>
    <th scope="col">Quantity</th>
    <th scope="col">VAT</th>
  </tr>
 <?php 
  for($i=0;$i<$quantity;$i++){
  ?>
  <?php 

$query1 = mysqli_query( $dbhandle,"select table_name from information_schema.tables where table_schema = '$db' and TABLE_NAME like '%cat_%' order by table_name");
$num=mysqli_num_rows($query1);
//echo "no=".$num;

?>
  <tr>
    <td><?php echo ($i+1).". ";?></td>
    <td align="left">
    <input type="text" name="name[]" id="name"  size="30" class="productName" placeholder="Enter the product name" required/>
    </td>
    <td align="center"><select name="cat[]" required>
      <?php 	if($num>0)
		{
	?>
      <option label="Select" value="-1" disabled selected>&nbsp;&nbsp;&nbsp;&nbsp;Select&nbsp;&nbsp;</option>
      <?php
while($row = mysqli_fetch_row($query1)){
	$val=explode("_",$row['0']);
	$tableName=$row['0'];

?>
      <!-- <option disabled>_____________________</option> -->
      <option disabled>&nbsp;&nbsp;</option>
      <option label="<?php echo strtoupper($val[1]);?>" value="-1" disabled><?php echo strtoupper($val[1])?></option>
      <option disabled>-------------------------------------</option>
      <?php
$query2 = mysqli_query( $dbhandle,"select * from $tableName order by subCategory asc");
$number=mysqli_num_rows($query2);
//echo $number;
if($number>0)
{
while($fetch2=mysqli_fetch_array($query2))
{
?>
      <option value="<?php echo strtoupper($val[1])."//".$fetch2['subCategory'];?>"><?php echo strtoupper($fetch2['subCategory']);?></option>
      <?php }//end of while
}//end of if
}//end of while
}//end of if
else
{
	
?>
      <option value="-1" disabled selected><?php echo 'No Category are added';}?></option>
      <?php //}?>
    </select></td>
    <td align="center"><input type="text" placeholder="Price" name="price[]" id="price" onkeypress="return isNumberKey(event)"  required/></td>
    <td align="center"><input type="text" placeholder="Quantity" id="qty" name="qty[]" onkeypress="return isNumberKey2(event)"  required/></td>
    <td align="center"><input type="text" placeholder="Enter VAT here" id="vat" name="vat[]" onkeypress="return isNumberKey(event)" onChange="pamt()" required/></td>
  </tr>
    <?php }?>
  <tr>
    <td colspan="6" align="center"><br>
<input type="submit" name="save" value="Save"  />&nbsp;<button onclick="goBack()  ;">Back </button></td></tr>
</table>
</form>
<br>
<br>




</body>
</html>
  <?php 
  
  mysql_close($dbhandle);

   
?>
<?php 
}
else
{
	header('location:index.php');
}
 ?>
 
 
 
