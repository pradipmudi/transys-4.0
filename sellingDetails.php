<?php
ob_start();
session_start();
error_reporting(0);
if(isset($_SESSION['user']))
  {
	  
?>
<?php
// Ajax calls this NAME CHECK code to execute
require_once("dbcon/dbcon.php");
if(isset($_POST["std_id_check"]))
	{

$serialNo = preg_replace('#[^a-z0-9]#i', ' ', $_POST['std_id_check']);

$sql3 = "SELECT * FROM serialno WHERE serialNo='$serialNo' and soldStatus='no' LIMIT 1";

 $query3 = mysqli_query($dbhandle,$sql3); 
    $sid_check = mysqli_num_rows($query3);
	while($op=mysqli_fetch_array($query3))
	{
		$productName=strtoupper($op['productName']);
	}
$sql8="select * from stock where name='$productName'";
		$query8=mysqli_query($dbhandle,$sql8);
		while($fetch=mysqli_fetch_array($query8))
		{
			$quantity=$fetch['quantity'];
		}

	if ($sid_check > 0)
	{
		//echo "stock=".$quantity;
   echo '<strong style="color:#F00;"><font color=\"#009900\">"'.$productName.'"</font> of this serial no.<font color=\"#009900\"> ' . $serialNo . '</font> is not sold.</strong><input type="hidden" value="'.$quantity.'" name="stockArray[]">';
   exit();
    }
    else 
	{
   echo '<strong style="color:#009900;">S/N : <font color="#FF0000"> ' . $serialNo . '</font> is not available.</strong>';
   exit();
    } 
}
//---------------------------------------

?>
<?php

if(isset($_POST['save']))
{
	$quantity=$_POST['quantity'];
	$customerType=$_POST['customerType'];
	$name=$_POST['name'];
	$address=$_POST['address'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$sellingDate=$_POST['dob'];

// <!-- Renaming the profile pic name of the credit customer ---> //		
				

$imageName=$_POST['imageName'];

$filename = $_FILES["file"]["name"];
	$file_basename = substr($filename, 0, strripos($filename, '.')); // get file extention
	$file_ext = substr($filename, strripos($filename, '.')); // get file name
	$filesize = $_FILES["file"]["size"];
	//$random_digit=rand(0000,9999);
	//$newfilename=$random_digit.$file_basename.$file_ext;
	$newfilename=$imageName.$file_ext;
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
    
  	  $newfilename="dummyProfilePic/dummy.jpg";
  }
  // <!-- Renaming the profile pic name of the credit customer ---> //
	?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Invoice Details</title>
</head>

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
	
	  
	  

      </script>
      
<!--\\\\\\\\\\\\\\\\\\\\\\\############ check no or not ##############/////////////////////////////-->
<script type="text/javascript">
/*function validate()
{
	<?php 
  for($i=0;$i<$quantity;$i++){
  ?>
	if(document.getElementById('serialArray<?php echo $i;?>').checked=="")
	{
			  alert("Enter the serial no!!");
			  document.sellingDetails.serialArray<?php echo $i;?>.focus() ;
			  return false;
	}
	if(document.getElementById('priceArray<?php echo $i;?>').checked=="")
	{
			  alert("Enter the price!!");
			  document.sellingDetails.priceArray<?php echo $i;?>.focus() ;
			  return false;
	}
	<?php }?>
	else
	return( true );
}*/
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\\Serial no validation/////////////////////////////////////////-->


<script src="js/main.js"></script>
<script src="js/ajax.js"></script>
<script>
  <?php 
  for($i=0;$i<$quantity;$i++){
  ?>

function checkusername<?php echo $i;?>()
{

var s = _("serialArray<?php echo $i;?>").value;
if(s != "")
	{
_("std_id_status<?php echo $i;?>").innerHTML = 'checking ...';
var ajax = ajaxObj("POST", "sellingDetails.php");
        ajax.onreadystatechange = function() 
			{
       if(ajaxReturn(ajax) == true)
				{
           _("std_id_status<?php echo $i;?>").innerHTML = ajax.responseText;
		   if(ajax.responseText.search("is not available.")!=-1)
		  _("serialArray<?php echo $i;?>").value="";
				}
			}
        ajax.send("std_id_check="+s);
	}
}
<?php }?>
</script>
<?php
$existing=$_GET['existing'];
$id=$_GET['id'];

$sql2="select * from profitmultiyear order by period desc limit 1";
$query2=mysqli_query($dbhandle,$sql2);
while($fetch=mysqli_fetch_array($query2))
{
	$profitMultiyear=$fetch['profit'];
}
$sql4="select * from profitsingleyear order by period desc limit 1";
$query4=mysqli_query($dbhandle,$sql4);
while($fetch=mysqli_fetch_array($query4))
{
	$profitSingleyear=$fetch['profit'];
}
$sql5="select * from profitmonth order by period desc limit 1";
$query5=mysqli_query($dbhandle,$sql5);
while($fetch=mysqli_fetch_array($query5))
{
	$profitMonth=$fetch['profit'];
	$dateProfit=$fetch['period'];
}
$sql6="select * from customer where id='$id'";
$query6=mysqli_query($dbhandle,$sql6);
while($fetch=mysqli_fetch_array($query6))
{
	$previousBalanceDue=$fetch['balance'];
}
?>
<?php 
$date=date('d-M-Y');
?>
<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############/////////////////////////////-->

<script language="javascript" type="text/javascript" src="cal/datetimepicker.js">
</script>

<!--\\\\\\\\\\\\\\\\\\\\\\\############ add calender here ##############//////////////////////////// -->
<script type="text/javascript">
function validate()
{



	var dob1=document.sellingDetails.dob.value	;   
   if( document.sellingDetails.dob.value == "" )
   {
     alert( "Please provide purchase Date !!" );
     document.sellingDetails.dob.focus() ;
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
	//alert(actualday);
	document.sellingDetails.dob.value=actualday;
		/* var today = new Date();
         var dd = today.getDate();
	     var mm = today.getMonth()+1;
	     var yyyy = today.getFullYear();
	     var today = dd+'-'+mm+'-'+yyyy;
		// alert(today);
		 var def= yyyy - res[2];
		 if(def<16)
	      {
	       alert("The date of birth you are typing is not valid!!!!");
	       document.reg.dob.value="" ;
	       document.reg.dob.focus() ;
	       return false;
	        }*/
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

<form name="sellingDetails" action="saveSellingDetails.php?existing=<?php echo $existing;?>&id=<?php echo $id;?>" enctype="multipart/form-data" method="post" onsubmit="return(validate());">
<table width="45%" border="0" cellspacing="4" cellpadding="0" bgcolor="#FFFFFF" align="center" >
 <tr bgcolor="#CCCCCC">
   <td colspan="3" align="center"><font size="+1" face="Courier New, Courier, monospace"><b>Enter the serial no of the products:</b></font></td></tr>
  <tr bgcolor="#000000">
    <td align="center"><font size="3" color="#FFFFFF" face="Rockwell"><b>ID</b></font></td>
    <td  align="center"><font size="3" color="#FFFFFF" face="Rockwell"><b>Serial No</b></font></td>
    <td  align="center"><font size="3" color="#FFFFFF" face="Rockwell"><b>Price </b></font></td>
    </tr>
  <?php 
  for($i=0;$i<$quantity;$i++){
  ?>
  
  <tr>
  	<td  align="center"><?php echo $i+1;?></td>
    <td  align="center"><input type="text" name="serialNoArray[]" id="serialArray<?php echo $i;?>" placeholder="Enter Serial No."  onkeyup="restrict('serialArray')" onChange="checkusername<?php echo $i;?>()" required autofocus >
    
    </td>

    <td  align="center"><input type="text" name="priceArray[]" id="priceArray<?php echo $i;?>" placeholder="Enter the price" onkeypress="return isNumberKey(event)" required></td>
    
   
  </tr>
  <tr>
     <td align="center" colspan="3"><span id="std_id_status<?php echo $i;?>"></span>&nbsp;</td>
  </tr>
  <?php }?>
  <?php if($customerType=="creditCustomer")
		{  
  ?>
<tr>
  <td colspan="2"><b>&nbsp;Initial Downpayment :</b></td>
  <td align="left"><input type="text" name="credit" placeholder="Initially paid amount " required></td>
</tr>
<tr><td colspan="2"><b>&nbsp;Payment Description :</b></td>
  <td align="left"><textarea placeholder="Enter Payment Description Here(example: by cash,by cheque)" id="description" name="description" rows="3" cols="30"   required></textarea></td>
</tr>
<tr>
  <td colspan="2"><b>&nbsp;Next Installment Date :</b></td>
  <td align="left"><input type="text" name="dob"   id="date" placeholder="Next Installment Date"  required />
    <a href="javascript:NewCal('date','ddmmmyyyy')"><img src="cal/cal.gif" width="16" height="16" border="0" alt="Pick a date"></a></td>
</tr>
<?php }?>
  <tr><td colspan="3" align="center"><input type="hidden" name="sellingDate" value="<?php echo $sellingDate;?>">
    <input type="hidden" name="profitMultiyear" value="<?php echo $profitMultiyear;?>">
  <input type="hidden" name="profitSingleyear" value="<?php echo $profitSingleyear;?>">
  <input type="hidden" name="profitMonth" value="<?php echo $profitMonth;?>">
  <input type="hidden" name="profitDate" value="<?php echo $dateProfit;?>">
    <input type="hidden" name="productQuantity" value="<?php echo $quantity;?>">
      <input type="hidden" name="previousBalanceDue" value="<?php echo $previousBalanceDue;?>">
<input type="hidden" name="name" value="<?php echo $name;?>">
<input type="hidden" name="file" value="<?php echo $newfilename;?>">
    <input type="hidden" name="address" value="<?php echo $address;?>">
    <input type="hidden" name="phone" value="<?php echo $phone;?>">
    <input type="hidden" name="email" value="<?php echo $email;?>"><input type="hidden" name="customerType" value="<?php echo $customerType;?>"><br>
<input type="submit" name="save" value="Save all details"  /></td></tr>
</table>
</form>
</body>
</html>
<?php
}
  }
else
{
	header('location:index.php');
}
?>